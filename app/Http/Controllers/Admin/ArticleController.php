<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\ArticleIAttachment;
use App\Models\ArticleImage;
use App\Models\ArticlesTag;
use App\Models\ArticleTag;
use App\Models\AssetFile;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserFilter;
use App\Repositories\File\EloquentFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class ArticleController extends Controller
{
    protected $dateFilter = [0=>'Any date',1=>'Yesterday',7=>'A week ago',14=>'2 weeks ago',30=>'A month ago',90=>'3 months ago',180=>'6 months ago',365=>'Year ago'];
    protected $arrStatus = [""=>'All',1=>'Active',0=>'Pending',-1=>'Archived',-2=>'Deleted'];
    protected $arrStatusAdd = [1=>'Active',0=>'Pending',-1=>'Archived'];
    protected $arrSort = [0=>"Default",1=>'Date ASC',2=>'Date DESC',3=>'Title ASC',4=>'Title DESC'];
    protected $selectAction = [];
    protected $keyCache = 'admin_article_desc';
    protected $timezone = '';
    public function __construct()
    {
        $this->middleware('auth');
        $this->selectAction = [''=>'Select Action',
            'status'=>['label'=>'Set status','child'=>['status.0'=>'Pending','status.1'=>'Active','status.-1'=>'Archived','status.-2'=>'Deleted']],
            'mark-headline' => 'Mark as Headline',
            'apply-tags' => 'Apply tags',
            'move' => ['label'=>'Move to','child'=>[]]
        ];
        $setting = \App\Models\Config::getAllValue();
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
            $this->timezone = $setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"];
        }

    }
    public function index(Request $request) {
        //return "maintain";
        $perPage = $request->per_page?$request->per_page:10;
        $orderColumn = 'articles.order_num';
        $orderByType = 'desc';
        $keyCache = $this->keyCache.$perPage;
        $noCache = false;
        if($request->page > 1) {
            $noCache = true;
            $keyCache .= 'no';
        }
        switch ($request->sort_by) {
            case 1:
                $orderColumn = 'articles.created';
                $keyCache .= "no";
                $noCache = true;
                $orderByType = 'asc';
                break;
            case 2:
                $orderColumn = 'articles.created';
                $keyCache .= "no";
                $noCache = true;
                $orderByType = 'desc';
                break;
            case 3:
                $orderColumn = 'articles.title';
                $keyCache .= "no";
                $noCache = true;
                $orderByType = 'asc';
                break;
            case 4:
                $orderColumn = 'articles.title';
                $keyCache .= "no";
                $noCache = true;
                $orderByType = 'desc';
                break;
        }
        $articles = Article::join('categories as c','c.id','=','articles.category_id')->orderBy($orderColumn,$orderByType);
        if($request->tag_id) {
            $keyCache .= "no";
            $noCache = true;
            $articles->join('articles_tags as at','at.article_id','=','articles.id');
        }
        if($request->keyword) {
            $keyCache .= "no";
            $noCache = true;
            $articles->where('articles.title','like','%'.$request->keyword.'%');
        }
        if($request->author) {
            $keyCache .= "no";
            $noCache = true;
            $articles->where('articles.author',$request->author);
        }
        if($request->user_id) {
            $keyCache .= "no";
            $noCache = true;
            $articles->where('articles.user_id',$request->user_id);
        }
        $arrSeachCid = $request->search_cid;
        if(!is_array($arrSeachCid)) {
            $arrSeachCid = [];
        } else if($arrSeachCid && $arrSeachCid[0]) {
            $keyCache .= "no";
            $noCache = true;
            $articles->whereIn('articles.category_id',$arrSeachCid);
        }

        if($request->post_date) {
            $keyCache .= "no";
            $noCache = true;
            $created = strtotime('-'.$request->post_date.' days');
            $articles->where('articles.created','>=',date('Y-m-d',$created));
        }
        if(is_numeric($request->status)) {
            $keyCache .= "no";
            $noCache = true;
            $articles = $articles->where('articles.status',$request->status);
        }
        $articleCache = Cache::get($keyCache);
        if(!$articleCache) {
            //dd($keyCache);
            $articles = $articles->select(['articles.id','articles.vote_sum','articles.user_id','articles.vote_num','articles.emailed','articles.order_num','articles.today_read','articles.times_read','articles.status','articles.title','articles.author','articles.created','c.category_name','articles.category_id']);
            $articles = $articles->paginate($perPage)->onEachSide(1);
            if($noCache === false) {
                Cache::forever($keyCache,$articles);
            }
        } else {
            $articles = $articleCache;
        }
        $categories = Category::getList();
        $arrFiler = request()->input();

        if(isset($arrFiler['page'])) {
            unset($arrFiler['page']);
        }
        $user = Auth::user();
        $userFilters = UserFilter::getFilter($user->userid);
        $articles->appends($arrFiler)->links();
        $isPending = false;
        if(Auth::user()->hasPermission(['article.pending'])) {
            unset($this->selectAction['status']);
            $isPending = true;
        }
        return view('admin.article.index',['articles'=>$articles,'dateFilter'=>$this->dateFilter,'arrStatus'=>$this->arrStatus,'categories'=>$categories,'arrSearchCid'=>$arrSeachCid,'per_page'=>$perPage,'arrSort'=>$this->arrSort,'arrFilter'=>$arrFiler,'selectAction'=>$this->selectAction,'userFilters'=>$userFilters,'isPending'=>$isPending]);
    }
    public function create()
    {
        $edit = false;
        $categories = Category::getList();
        $arrStatus = $this->arrStatusAdd;
        $users = User::where('status','Active')->get();
        $headTags = Tag::whereIn("name",["headlines","sportheadlines"])->pluck("name","id")->toArray();
        $fileRepo = new EloquentFile();
        $tags = null;
        return view('admin.article.add-edit', compact('edit','categories','arrStatus','users','headTags','fileRepo','tags'));
    }
    public function edit($articleId)
    {
        $edit = true;
        $article = Article::find($articleId);
        if(!$article) {
            return redirect()->route('article.index')
                ->withErrors("Article is not existing!");
        }
        if(Auth::user()->hasPermission(['article.pending']) && $article->user_id != Auth::user()->id) {
            return redirect()->route('article.index')
                ->withErrors("You don't have permission!");
        }
        $fileRepo = new EloquentFile();
        $categories = Category::getList();
        $arrStatus = $this->arrStatusAdd;
        $users = User::where('status','Active')->get();
        $headTags = Tag::whereIn("name",["headlines","sportheadlines"])->pluck("name","id")->toArray();
        $tags = $article->getTags;
        return view('admin.article.add-edit', compact('edit','article','categories','arrStatus','users','fileRepo','headTags','tags'));
    }
    public function store(Request $request,$articleId=0)
    {
        $this->delCache();
        //dd($catId);die;
        $data = $request->all();
        unset($data['_token']);
        $arrTags = [];
        if($data['tags_id']) {
            $arrTags = explode(',',trim($data['tags_id'],','));
        }
        unset($data['tags_id']);
        if(isset($data['quick_tag'])) {
            //$arrTags = array_merge($arrTags,$data['quick_tag']);
            if(in_array('1:110',$data['quick_tag'])) {
                $arrTags[] = '1:110';
            } else {
                $arrTags = array_diff($arrTags,['1:110']);
            }
            if(in_array('1:2',$data['quick_tag'])) {
                $arrTags[] = '1:2';
            } else {
                $arrTags = array_diff($arrTags,['1:2']);
            }
            unset($data['quick_tag']);
        } else {
            $arrTags = array_diff($arrTags,['1:2','1:110']);
        }

        //var_dump($data['created']);
        $data['created'] = Carbon::createFromFormat('M d, Y h:i A',$data["created"],$this->timezone)->format('Y-m-d H:i:s');
        //var_dump($data['created']);die;
        if(!isset($data["show_comment"])) {
            $data["show_comment"] = 0;
        }
        if(!isset($data["show_poll"])) {
            $data["show_poll"] = 0;
        }
        if(!isset($data["rss_feed"])) {
            $data["rss_feed"] = 0;
        }
        $data["image"] = trim($data["image"]);
        if($data["image"]) {
            $data["md5_file"] = md5($data["image"]);
        }
        /*foreach ($data as $key=>$vl) {
            $data[$key] = htmlspecialchars_decode($vl);
        }*/
        if($articleId != 0) {
            if(Auth::user()->hasPermission(['article.pending'])) {
                unset($data["status"]);
                $article = Article::find($articleId);
                if($article->user_id != Auth::user()->id) {
                    return redirect()->route('article.index')
                        ->withErrors("You don't have permission!");
                }
            }
            $this->validate($request, [
                'title' => 'required|unique:articles,title,'.$articleId,

            ]);
            $data["last_edited"] = date('Y-m-d H:i:s');
            $article = Article::where('id',$articleId)->update($data);
        } else {
            //dd($request->all());
            $this->validate($request, [
                'title' => 'required|unique:articles',

            ]);
            if(Auth::user()->hasPermission(['article.pending'])) {
                $data["status"] = 0;
                $data['user_id'] = Auth::user()->id;
            }
            $orderBy = Article::selectRaw('max(order_num) as order_num')->first();
            $data['order_num'] = $orderBy->order_num + 1;
            $article = Article::create($data);
            $articleId = $article->id;
        }
        if($article) {
            $user = Auth::user();
            $arrInsert = [];
            if($articleId) {
                $arrArticleTags = ArticleTag::where('article_id',$articleId)->get();
                $arrNewCheck = $arrCheckOld = [];
                for($i = 0; $i < count($arrTags);$i++) {
                    if(isset($arrTags[$i])) {
                        $arrNewCheck[trim($arrTags[$i])] = 1;
                    }
                }
                //dd($arrNewCheck);
                if($arrArticleTags) {
                    foreach ($arrArticleTags as $articleTag) {
                        $key = $articleTag->tags_group_id.':'.$articleTag->tag_id;
                        $arrCheckOld[$key] = 1;
                        if(!isset($arrNewCheck[$key])) {
                            $articleTag->delete();
                        }
                    }
                }
                foreach ($arrNewCheck as $tag=>$vl) {
                    if(!isset($arrCheckOld[$tag])) {
                        $arrTag = explode(':',$tag);
                        $arrInsert[] = ['tag_id'=>$arrTag[1],'article_id'=>$articleId,'tags_group_id'=>$arrTag[0],'user_id'=>$user->userid];
                    }
                }

            } else if($arrTags) {
                for($i = 0; $i < count($arrTags);$i++) {
                    $tag = trim($arrTags[$i]);
                    $arrTag = explode(':',$tag);
                    $arrInsert[] = ['tag_id'=>$arrTag[1],'article_id'=>$article->id,'tags_group_id'=>$arrTag[0],'user_id'=>$user->userid];
                }
            }
            if($arrInsert) {
                ArticleTag::insert($arrInsert);
            }
            if($articleId) {
                AdminLog::insert(['user_name'=>$user->username,'action'=>'Edited article# '.$articleId]);
            } else {
                AdminLog::insert(['user_name'=>$user->username,'action'=>'Added article# '.$articleId]);
            }
        }
        return redirect()->route('article.edit',[$articleId])
            ->withSuccess($articleId == 0?'Article created successfully!':'Article updated successfully!');
    }
    public function delete($articleId)
    {
        $this->delCache();
        if(Auth::user()->hasPermission(['article.pending'])) {
            return "You don't have permission";
        }
        $article = Article::find($articleId);
        if($article && $article->status == -2) {
            $article->delete();
            ArticleIAttachment::where('article_id',$articleId)->delete();
            ArticleImage::where('article_id',$articleId)->delete();
            ArticlesTag::where('article_id',$articleId)->delete();
        } else {
            Article::where('id',$articleId)->update(["status"=>-2]);
        }
        AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'Deleted article# '.$articleId."|title:".$article->title]);
        return redirect()->route('article.index')
            ->withSuccess("You deleted success!");
    }
    public function searchTag(Request $request) {
        $keyword = $request->keyword;
        if(!$keyword) {
            $keyword = $request->term;
        }
        $keyword = trim($keyword);
        $tags = [];
        if($keyword) {
            $tags = Tag::join('tags_to_tags_groups as tg','tg.tag_id','=','tags.id')
                ->join('tags_groups as t','t.id','=','tg.tags_group_id')
                ->select(['tags.id','tags.name','t.name as group','t.id as group_id'])
                ->where('tags.name','like','%'.$keyword.'%');
            if($request->article == 1) {
                $tags->whereNotIn("tags.name",["headlines","sportheadlines"]);
            }
            $tags = $tags->limit(50)->get();
        }
        return response()->json($tags);
    }
    public function sort(Request $request) {
        $this->delCache();
        $data = $request->all();
        if(isset($data['listId']) and $data['listId']) {
            $articles = Article::whereIn('id',$data['listId'])->orderBy('order_num','DESC')->select(['id','order_num'])->get();
            if($articles) {
                $arrOrderNum = [];
                $arrObject = [];
                foreach ($articles as $article) {
                    $arrOrderNum[] = $article->order_num;
                    $arrObject[$article->id] = $article;
                }
                //dd($arrOrderNum);
                foreach ($data['listId'] as $index=>$id) {
                    echo $index.',';
                    if(isset($arrObject[$id]) && isset($arrOrderNum[$index])) {
                        $arrObject[$id]->order_num = $arrOrderNum[$index];
                        $arrObject[$id]->save();
                    }
                }
                $logMessage = 'Reordered articles # ' . trim(implode(',',$data['listId']));
                AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>$logMessage]);
                unset($arrOrderNum);
                unset($arrObject);
                unset($articles);
            }
        }
        return response()->json('ok');
    }
    public function selectAction(Request $request) {
        try {
            $this->delCache();
            if($request->_action && $request->listId) {
                if($request->_action == 'mark-headline') {

                } else if($request->_action == 'apply-tags') {
                    $arrArticleIds = $request->listId;
                    $arrTagIds = $request->tag_ids;
                    $articleTags = ArticleTag::whereIn('article_id',$arrArticleIds)->get();
                    $arrArticleTags = [];
                    if($articleTags) {
                        foreach ($articleTags as $tag) {
                            if(!isset($arrArticleTags[$tag->tags_group_id])) {
                                $arrArticleTags[$tag->tags_group_id] = [];
                                $arrArticleTags[$tag->tags_group_id][$tag->article_id] = [];
                            }
                            $arrArticleTags[$tag->tags_group_id][$tag->article_id][] = $tag->tag_id;
                        }
                    }
                    // process insert tag id
                    $arrInsert = [];
                    $userId = Auth::user()->id;
                    foreach ($arrTagIds as $groupId =>$arrTag) {
                        foreach ($arrArticleIds as $key=>$articleId) {
                            $arrCheckTag = (isset($arrArticleTags[$groupId]) && isset($arrArticleTags[$groupId][$articleId]))?$arrArticleTags[$groupId][$articleId]:[];
                            foreach ($arrTag as $key=>$tagId) {
                                if(!in_array($tagId,$arrCheckTag)) {
                                    $arrInsert[] = ['tag_id'=>$tagId,'article_id'=>$articleId,'tags_group_id'=>$groupId,'user_id'=>$userId];
                                }
                            }
                        }
                    }
                    ArticleTag::insert($arrInsert);

                } else {
                    $arrAction = explode('.',$request->_action);
                    if(Auth::user()->hasPermission(['article.pending']) && $arrAction[0] == 'status') {
                        return "You don't have permission";
                    }
                    if(isset($arrAction[1])) {
                        Article::whereIn('id',$request->listId)->update([$arrAction[0] => $arrAction[1]]);
                    }
                    AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'edited articles # '.implode($request->listId)]);
                }

            }
            return response()->json('ok');
        } catch (\Exception $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }

    }
    public function addGallery(Request $request) {
        $ids = $request->ids;
        $arrArticleFiles = $arrOldArticleFiles = array();
        if($ids) {
            $files = AssetFile::whereIn('id',$ids)->get();
            $orderNumbers = 0;
            if($request->select_type == 'list_gallery_image') {
                $oldArticleFiles = ArticleImage::where('article_id',$request->article_id)->orderBy('order_number','ASC')->get();
                $orderNum = ArticleImage::selectRaw('max(order_number) as order_num')->first();
            } else {
                $oldArticleFiles = ArticleIAttachment::where('article_id',$request->article_id)->orderBy('order_number','ASC')->get();
                $orderNum = ArticleIAttachment::selectRaw('max(order_number) as order_num')->first();
            }
            if($orderNum) {
                $orderNumbers = $orderNum->order_num;
            }
            if($oldArticleFiles) {
                foreach ($oldArticleFiles as $file) {
                    $arrArticleFiles[] = $file;
                    $arrOldArticleFiles[$file->real_path] = 1;
                }
            }
            foreach ($files as $file) {
                $realPath = str_replace(Config::get('site.files').'/','',$file->path.$file->name.'.'.$file->extension);
                if(!isset($arrOldArticleFiles[$realPath])) {
                    if($request->select_type == 'list_gallery_image') {
                        $objFile = new ArticleImage();
                    } else {
                        $objFile = new ArticleIAttachment();
                    }
                    $objFile->real_path = $realPath;
                    $objFile->article_id = $request->article_id;
                    $orderNumbers++;
                    $objFile->order_number = $orderNumbers;
                    $objFile->save();
                    $arrArticleFiles[] = $objFile;
                }
            }
        }
        if($request->select_type == 'list_gallery_image') {
            $repoFile = new EloquentFile();
            return view('admin.article.partials.gallery', compact('arrArticleFiles','repoFile'));
        } else {
            return view('admin.article.partials.attachment', compact('arrArticleFiles'));
        }
    }
    public function applyFile(Request $request) {
        $id = (int)$request->file_id;
        $selectType = $request->select_type;
        if($selectType == 'list_gallery_image') {
            $objFile = ArticleImage::find($id);
        } else {
            $objFile = ArticleIAttachment::find($id);
        }
        if($objFile) {
            $objFile->title = $request->title;
            $objFile->description = $request->description;
            $objFile->save();
            return response()->json(["error"=>0,"message"=>"Applied is successfully!"]);
        }
        return response()->json(["error"=>1,"message"=>"Error: Applied is wrong!"]);
    }
    public function sortFile(Request $request) {
        $data = $request->all();
        $arrResult = ["error"=>0];
        if(isset($data['listId']) and $data['listId']) {
            if($data['type'] == 'gallery') {
                $articleFiles = ArticleImage::whereIn('id',$data['listId'])->where('article_id',$request->article_id)->orderBy('order_number','DESC')->select(['id','order_number'])->get();
            } else {
                $articleFiles = ArticleIAttachment::whereIn('id',$data['listId'])->where('article_id',$request->article_id)->orderBy('order_number','DESC')->select(['id','order_number'])->get();
            }
            if($articleFiles) {
                $arrOrderNum = [];
                $arrObject = [];
                foreach ($articleFiles as $article) {
                    $arrOrderNum[] = $article->order_number;
                    $arrObject[$article->id] = $article;
                }
                //dd($arrOrderNum);
                foreach ($data['listId'] as $index=>$id) {
                    echo $index.',';
                    if(isset($arrObject[$id]) && isset($arrOrderNum[$index])) {
                        $arrObject[$id]->order_number = $arrOrderNum[$index];
                        $arrObject[$id]->save();
                    }
                }
                //$logMessage = 'Reordered articles #' . trim(implode(',',$data['listId']));
                //AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>$logMessage]);
                unset($arrOrderNum);
                unset($arrObject);
                unset($articleFiles);
            }
            $arrResult["message"] = "Reorder is successfully!";
        } else {
            $arrResult["error"] = 1;
            $arrResult["message"] = "Error: Reorder is fail!";
        }
        return response()->json($arrResult);
    }
    public function delFile(Request $request) {
        try {
            if($request->select_type == 'list_gallery_image') {
                ArticleImage::where('id',$request->id)->delete();
            } else {
                ArticleIAttachment::where('id',$request->id)->delete();
            }
            return response()->json(['error'=>0,"message"=>"Deleted is successfully"]);
        } catch (\Exception $exception) {
            return response()->json(['error'=>1,"message"=>"Error: Deleted is fail"]);
        }
    }
    protected function delCache() {
        Cache::forget($this->keyCache.'10');
        Cache::forget($this->keyCache.'30');
        Cache::forget($this->keyCache.'50');
    }
}
