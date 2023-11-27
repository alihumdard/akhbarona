<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\UserFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CommentController extends Controller
{
    protected $dateFilter = [0=>'Any date',1=>'Yesterday',7=>'A week ago',14=>'2 weeks ago',30=>'A month ago',90=>'3 months ago',180=>'6 months ago',365=>'Year ago'];
    protected $arrStatus = [""=>'All',1=>'Active',0=>'Pending'];
    protected $arrStatusAdd = [1=>'Active',0=>'Pending'];
    protected $arrSort = [0=>"Default",1=>'Date ASC',2=>'Date DESC',3=>'Author ASC',4=>'Author DESC'];
    protected $selectAction = [];
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:comment.manage');
        $this->selectAction = [''=>'Select Action',
            'status'=>['label'=>'Set status','child'=>['status.0'=>'Pending','status.1'=>'Active']],
            'delete' => 'Delete'
        ];
        $setting = \App\Models\Config::getAllValue();
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
        }
    }
    public function index(Request $request) {
        $perPage = $request->per_page?$request->per_page:10;
        $orderColumn = 'comments.id';
        $orderByType = 'desc';
        switch ($request->sort_by) {
            case 1:
                $orderColumn = 'comments.create_dt';
                $orderByType = 'asc';
                break;
            case 2:
                $orderColumn = 'comments.create_dt';
                $orderByType = 'desc';
                break;
            case 3:
                $orderColumn = 'comments.author';
                $orderByType = 'asc';
                break;
            case 4:
                $orderColumn = 'comments.author';
                $orderByType = 'desc';
                break;
        }
        $comments = Comment::join('articles as a','a.id','=','comments.article_id')->orderBy($orderColumn,$orderByType);

        if($request->keyword) {
            $comments->where('comments.description','like','%'.$request->keyword.'%');
        }
        if($request->author) {
            $comments->where('comments.author',$request->author);
        }
        if($request->email) {
            $comments->where('comments.email',$request->email);
        }
        if($request->article_id) {
            $comments->where('comments.article_id',$request->article_id);
        }
        if($request->ip) {
            $comments->where('comments.ip',$request->ip);
        }
        if($request->post_date) {
            $created = strtotime('-'.$request->post_date.' days');
            $comments->where('comments.created_dt','>=',date('Y-m-d',$created));
        }
        if(is_numeric($request->status)) {
            $comments = $comments->where('comments.status',$request->status);
        }
        $comments = $comments->select(['a.title','comments.*']);
        $comments = $comments->paginate($perPage);
        $arrFiler = request()->input();

        if(isset($arrFiler['page'])) {
            unset($arrFiler['page']);
        }
        $user = Auth::user();
        $userFilters = UserFilter::getFilter($user->userid,'comment');
        $comments->appends($arrFiler)->links();
        //dd($articles);
        return view('admin.comment.index',['comments'=>$comments,'dateFilter'=>$this->dateFilter,'arrStatus'=>$this->arrStatus,'per_page'=>$perPage,'arrSort'=>$this->arrSort,'arrFilter'=>$arrFiler,'selectAction'=>$this->selectAction,'userFilters'=>$userFilters]);
    }
    public function store(Request $request) {
        try {
            Comment::where('id',$request->id)->update(["description"=>$request->des]);
            AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'edited comment #'.$request->id]);
        } catch (\Exception $exception) {
            return response()->json(["error"=>1,"message"=>$exception->getMessage()]);
        }
    }
    public function delete(Comment $comment) {
        $id = $comment->id;
        $articleId = $comment->article_id;
        $comment->delete();

        AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'Deleted comments # '.$id.' IN article #'.$articleId]);
        return redirect()->route('comment.index')
            ->withSuccess("You deleted success!");
    }
    public function selectAction(Request $request) {
        $user = Auth::user();
        if($request->_action == 'delete') {
            Comment::whereIn('id',$request->listId)->delete();
            AdminLog::insert(['user_name'=>$user->username,'action'=>'deleted comments # '.implode($request->listId)]);
        } else {
            $arrAction = explode('.',$request->_action);
            if(isset($arrAction[1])) {
                Comment::whereIn('id',$request->listId)->update([$arrAction[0] => $arrAction[1]]);
            }
            AdminLog::insert(['user_name'=>$user->username,'action'=>'edited comments # '.implode($request->listId)]);
        }

    }
}
