<?php
namespace App\Repositories\Article;
use App\Helper\Common;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EloquentArticle implements ArticleRepository {
    protected $fields = ["articles.id","articles.title","articles.today_read","articles.author","articles.image","articles.md5_file","articles.link","articles.image_caption","c.sefriendly as slug","c.category_name","articles.category_id","articles.created"];
    protected $keySession = 'akh_article_session';
    protected $timeCache = 5;
    function getList($params) {
        $keyCache = 'getList'.$this->getKeyCache($params);
        $articles = Cache::get($keyCache);
        if($articles) {
            return $articles;
        }
        $articles = Article::Join("categories as c","c.id","=","articles.category_id")
                        ->Where("status",1);
        if(isset($params["category_id"])) {
            if(is_array($params["category_id"])) {
                $articles->whereIn("articles.category_id", $params["category_id"]);
            } else {
                $articles->where("articles.category_id", $params["category_id"]);
            }
        }
        if(isset($params['not_id'])) {
            if(is_numeric($params['not_id'])) {
                $articles->where('articles.id','!=',$params['not_id']);
            } else if(count($params['not_id']) > 0) {
                $articles->whereNotIn('articles.id',$params['not_id']);
            }

        }
        /*if(isset($params['not_tag'])) {
            $articles->leftJoin("articles_tags as at","articles.id","=","at.article_id");
            $articles->whereRaw("(at.tag_id IS NULL OR at.tag_id NOT IN(".$params["not_tag"]."))");
        }*/
        $articles->select($this->fields)->orderBy("articles.".$params["order_field"],$params["order_by"]);
        $articles = $this->processQoute($articles->limit($params['limit'])->get());
        Cache::set($keyCache,$articles,now()->addMinutes($this->timeCache));
        return $articles;
    }
    function getListFromTags($params) {
        $keyCache = 'getListFromTags'.$this->getKeyCache($params);
        $articles = Cache::get($keyCache);
        if($articles) {
            return $articles;
        }
        $articles = Article::Join("articles_tags as at","articles.id","=","at.article_id")
                        ->Join("categories as c","c.id","=","articles.category_id")
                        ->Where("status",1);
        if(isset($params["category_id"])) {
            $articles->where("articles.category_id",$params["category_id"]);
        }
        if(isset($params['tags'])) {
            if(is_array($params["tags"])) {
                $articles->whereIn("at.tag_id",$params["tags"]);
            } else {
                $articles->where("at.tag_id",$params["tags"]);
            }
        }
        if(isset($params["group_id"])) {
            $articles->where("at.tags_group_id",$params["group_id"]);
        }
        if(isset($params['not_id']) && count($params['not_id']) > 0) {
            $articles->whereNotIn('articles.id',$params['not_id']);
        }
        $fields = $this->fields;
        $fields[] = "articles.abstract";
        $fields[] = "articles.body";
        $articles->select($fields)->orderBy("articles.".$params["order_field"],$params["order_by"]);
        $articles->groupBy("articles.id");
        $articles = $this->processQoute($articles->limit($params["limit"])->get());
        Cache::set($keyCache,$articles,now()->addMinutes($this->timeCache));
        return $articles;
    }
    function getListWithBody($params) {
        $keyCache = 'getListFromTags'.$this->getKeyCache($params);
        $articles = Cache::get($keyCache);
        if($articles) {
            return $articles;
        }
        $articles = Article::Join("categories as c","c.id","=","articles.category_id")
            ->Where("status",1);
        if(isset($params["category_id"])) {
            if(is_array($params["category_id"])) {
                $articles->whereIn("articles.category_id", $params["category_id"]);
            } else {
                $articles->where("articles.category_id", $params["category_id"]);
            }
        }
        /*if(isset($params['not_tag'])) {
            $articles->leftJoin("articles_tags as at","articles.id","=","at.article_id");
            $articles->whereRaw("(at.tag_id IS NULL OR at.tag_id NOT IN(".$params["not_tag"]."))");
        }*/
        $fields = $this->fields;
        $fields[] = "articles.abstract";
        $fields[] = "articles.body";
        $articles->select($fields)->orderBy("articles.".$params["order_field"],$params["order_by"]);
        $articles = $this->processQoute($articles->limit($params['limit'])->get());
        Cache::set($keyCache,$articles,now()->addMinutes($this->timeCache));
        return $articles;
    }
    function getListByCat($catId,$currentPage,$perPage=18,$tagList=[]) {
        $arrResult = ["total"=>0,"data"=>[]];
        if(is_array($catId)) {
            $cacheCat = implode($catId,'_');
        } else {
            $cacheCat = $catId;
        }
        $keyCache = "count_article_cat_".$cacheCat;
        $total = Cache::get($keyCache);
        if($total === null) {
            if(is_array($catId)) {
                $total = Article::whereIn('category_id',$catId)
                    ->where('status',1)->count();
            } else {
                $total = Article::where('category_id',$catId)
                    ->where('status',1)->count();
            }

            Cache::put($keyCache,$total,now()->addMinute(10));
        }
        if($total) {
            $field = ["articles.id","articles.title","articles.abstract","articles.body","articles.author","articles.image","articles.md5_file","articles.link","articles.image_caption","articles.category_id","articles.created"];
            $field[] = "c.category_name";
            $articles = Article::Join("categories as c","c.id","=","articles.category_id")->where('status',1);
            if(is_array($catId)) {
                $articles->whereIn('category_id', $catId);
            } else {
                $articles->where('category_id', $catId);
            }
            if($tagList) {
                $articles->Join("articles_tags as at","articles.id","=","at.article_id");
                $articles->whereIn("at.tag_id",$tagList);
                $articles->where("at.tags_group_id",1);
                $articles->groupBy("articles.id");
            }
            $articles = $articles->select($field)
                ->orderBy("id","DESC")
                ->offset(($currentPage-1)*$perPage)
                ->limit($perPage)->get();
            $arrResult["total"] = $total;
            $arrResult["data"] = $this->processQoute($articles);
        }
        return $arrResult;
    }
    function getById($id,$createSecurity=false) {
        $keyCache = 'detailData'.$id;
        $article = Cache::get($keyCache);
        if($article) {
            return $article;
        }
        $article = Article::Join("categories as c","c.id","=","articles.category_id")
                    ->where("articles.id",$id)
                    ->select(["articles.*","c.category_name","c.sefriendly as slug","c.article_template"])->first();
        if($createSecurity == true && $article) {
            $security = Str::random(8);
            /*$cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
            if(!isset($cookies['security'])) {
                $cookies['security'] = [];
            }
            $cookies['security'][$article->id] = $security;
            setcookie($this->keySession,json_encode($cookies),time()+86400);*/
            $article->security = $security;
            $article->title = htmlspecialchars_decode($article->title);
            $article->abstract = htmlspecialchars_decode($article->abstract);
            $article->body = htmlspecialchars_decode($article->body);
        }
        Cache::set($keyCache,$article,now()->addMinutes(10));
        return $article;
    }
    function getRelated($id,$limit=5) {
        $fields = $this->fields;
        return Article::Join("categories as c","c.id","=","articles.category_id")
            ->join("related as r","r.related_article_id","=","articles.id")
            ->where("r.article_id",$id)
            ->orderBy("r.relevance","DESC")
            ->limit($limit)
            ->select($fields)->get();
    }
    function getBreadcrumb($article,$categories) {
        $crumbs = [];
        foreach ($categories as $id=>$category) {
            if($article->category_id == $id) {
                if($category->parent_cat AND isset($categories[$category->parent_cat])) {
                    $category->sefriendly = $categories[$category->parent_cat]->sefriendly.'/'.$category->sefriendly;
                    $crumbs[] = $categories[$category->parent_cat];
                }
                $crumbs[] = $category;
                break;
            }
        }
        return $crumbs;
    }
    function getComments($articleId,$currentPage,$perPage) {
        $arrResult = ["total"=>0,"data"=>[]];
        $keyCache = "count_comments3_".$articleId;
        $total = Cache::get($keyCache);
        if($total === null) {
            $total = Comment::where('article_id',$articleId)
                ->where('status',"1")->count();
            Cache::put($keyCache,$total,now()->addMinute(10));
        }
        if($total) {
            $totalPage = ceil($total/$perPage);
            if($currentPage > $totalPage) {
                $currentPage = $totalPage;
            }
            if($currentPage < 1) {
                $currentPage = 1;
            }
            $setting = \App\Models\Config::getAllValue();
            $order = "DESC";
            if(isset($setting["VIVVO_COMMENTS_ORDER"]) && $setting["VIVVO_COMMENTS_ORDER"] == "ascending") {
                $order = "ASC";
            }
            $comments = Comment::where('article_id',$articleId)
                        ->where('status',"1")
                        ->orderBy("create_dt",$order)
                        ->offset(($currentPage-1)*$perPage)
                        ->limit($perPage)->get();
            $arrResult["data"] = $comments;
            $arrResult["total"] = $total;
        }
        return $arrResult;
    }
    function voteComment($commentId,$vote) {
        $cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
        //return $vote;
        if($vote != 1 AND $vote != -1) {
            return "error_vote";
        }
        if(!isset($cookies["vote_comment"])) {
            $cookies["vote_comment"] = [];
        }
        //return $cookies;
        if(!isset($cookies["vote_comment"][$commentId])) {
            $cookies["vote_comment"][$commentId] = 1;
            $comment = Comment::find((int)$commentId);
            if(!$comment) {
                return "error_comment";
            }
            $comment->vote += $vote;
            $comment->save();
            setcookie($this->keySession,json_encode($cookies),time()+86400,"/");
            return $comment->vote;
        }
        return "error_voted";
    }
    function reportComment($commentId) {
        $user = Auth::guard('admin')->user();
        if(!$user && !$user->hasPermission(['comment.manage'])) {
            return "ERROR_2220";
        }
        $setting = \App\Models\Config::getAllValue();
        if(!isset($setting["VIVVO_EMAIL_ENABLE"]) || !$setting["VIVVO_EMAIL_ENABLE"]) {
            return "ERROR_2220";
        }
        $cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
        if(!isset($cookies["report"])) {
            $cookies["report"] = [];
        }
        if(!isset($cookies["report"][$commentId])) {
            $comment = Comment::find($commentId);
            if($comment) {
                $article = $this->getById($comment->article_id);
                $body = route("article.detail",[$article->slug,$article->id]) . '#comment_' . $comment->id. "\n\n";
                $body .= Config::get("site.lang.LNG_REPORT_COMMENT_MESSAGE_2") . ':' . "\n";
                $body .= $article->title . "\n";
                $body .= route("article.detail",[$article->slug,$article->id]) . "\n\n";

                $body .= Config::get("site.lang.LNG_REPORT_COMMENT_IP_ADDRESS_AUTHOR_COMMENT") . ': ' . $comment->ip . "\n";
                $body .= Config::get("site.lang.LNG_REPORT_COMMENT_REPORTED_COMMENT_INFO") . ': ' . "\n";
                $body .= 'Guest, (IP:' . $_SERVER['REMOTE_ADDR'] . ")\n\n";
                $body .= Config::get("site.lang.LNG_REPORT_COMMENT_MESSAGE_1");
                $subject = str_replace('<WEBSITE_TITLE>' , $setting["VIVVO_WEBSITE_TITLE"], Config::get("site.lang.LNG_REPORT_COMMENT_MAIL_SUBJECT"));

                $to = $setting["VIVVO_ADMINISTRATORS_EMAIL"];
                $headers = [];
                $headers[] = 'Content-Type: text/plain; charset=UTF-8;';
                $headers[] = 'From: '.$setting["VIVVO_EMAIL_SEND_FROM"];
                if($setting["VIVVO_EMAIL_SMTP_PHP"] == 1) {
                    mail($to,$subject,$body,implode("\r\n", $headers));
                } else {
                    config([
                        "mail.mailers.smtp.transport" => "smtp",
                        "mail.mailers.smtp.host" => $setting["VIVVO_EMAIL_SMTP_HOST"],
                        "mail.mailers.smtp.port" => $setting["VIVVO_EMAIL_SMTP_PORT"],
                        "mail.mailers.smtp.username" => $setting["VIVVO_EMAIL_SMTP_USERNAME"],
                        "mail.mailers.smtp.encryption" => "tls",
                        "mail.mailers.smtp.password" => $setting["VIVVO_EMAIL_SMTP_PASSWORD"],
                        "mail.mailers.smtp.timeout" => 20,
                        "mail.from.address" => $setting["VIVVO_ADMINISTRATORS_EMAIL"],

                        "mail.host" => $setting["VIVVO_EMAIL_SMTP_HOST"],
                        "mail.port" => $setting["VIVVO_EMAIL_SMTP_PORT"],
                        "mail.username" => $setting["VIVVO_EMAIL_SMTP_USERNAME"],
                        "mail.encryption" => "tls",
                        "mail.password" => $setting["VIVVO_EMAIL_SMTP_PASSWORD"],
                    ]);
                    Mail::raw($body,        function($message) use ($to,$subject,$setting)
                    {
                        $message->to($to)
                            ->subject($subject)
                            ->from($setting["VIVVO_EMAIL_SEND_FROM"]);
                    });
                }
                $cookies["report"][$commentId] = 1;
                setcookie($this->keySession,json_encode($cookies),time()+86400,"/");
                return true;
            } else {
                return "ERROR_2219";
            }
        } else {
            return true;
        }
        return "ERROR_2219";
    }
    function addComment($arrays) {
        if(Common::bad_ip_filter()) {
            return "ERROR_2201";
        }
        $setting = \App\Models\Config::getAllValue();
        $cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
        $timeProtect = isset($setting["VIVVO_COMMENTS_FLOOD_PROTECTION"])?$setting["VIVVO_COMMENTS_FLOOD_PROTECTION"]:45;
        if(isset($cookies['add_comment']) && ($cookies['add_comment'] + $timeProtect) > time()) {
            return "ERROR_2202";
        }
        $user = Auth::guard('admin')->user();
        $article = $this->getById($arrays["article_id"]);
        if($article && $article->show_comment && isset($arrays["description"]) && $arrays["description"]) {

            $badWords = $setting["VIVVO_COMMENTS_BAD_WORDS"];
            $author = Common::bad_words_filter(strip_tags($arrays["author"]),$badWords);
            $www = Common::bad_words_filter(strip_tags($arrays["www"]),$badWords);
            if(!$www || !$author) {
                return "ERROR_2221";
            }
            $des = Common::bad_words_filter(strip_tags($arrays["description"]),$badWords);
            if(!$des) {
                return "ERROR_2221";
            }
            $lengthDes = strlen($des);
            if($lengthDes < 30 OR $lengthDes > 1000) {
                return 'ERROR_2756';
            }
            if($des) {
                $comment = new Comment();
                $comment->article_id = $arrays["article_id"];
                $comment->author = htmlspecialchars_decode($user?$user->first_name:$author);
                $comment->user_id = $user?$user->id:null;
                $comment->description = htmlspecialchars_decode($des);
                $comment->www = htmlspecialchars_decode($www);

                if($user && $user->hasPermission(['comment.manage'])) {
                    $comment->status = "1";
                }
                $comment->create_dt = date("Y-m-d H:i:s");
                $comment->ip = $_SERVER['REMOTE_ADDR'];
                $comment->save();
                $cookies['add_comment'] = time();
                setcookie($this->keySession,json_encode($cookies),time()+86400,"/");
                return $comment;
            }

        }
        return 'ERROR_2203';
    }
    function vote($id,$vote) {
        $cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
        //return $vote;
        if ($vote < 1) {
            $vote = 1;
        } elseif($vote > 5) {
            $vote = 5;
        } else {
            $vote = (int) $vote;
        }
        if(!isset($cookies["vote"])) {
            $cookies["vote"] = [];
        }
        //dd($cookies);
        if(!isset($cookies["vote"][$id])) {
            $cookies["vote"][$id] = 1;
            $article = Article::find((int)$id);
            if(!$article) {
                return "ERROR_2031";
            }
            $article->vote_num += 1;
            $article->vote_sum += $vote;
            $article->save();
            setcookie($this->keySession,json_encode($cookies),time()+86400,"/");
            $article->is_voted = true;
            return $this->processQoute($article);
        }
        return "ERROR_2030";
    }
    function isVoted($articleId) {
        $cookies = isset($_COOKIE[$this->keySession])?json_decode($_COOKIE[$this->keySession],true):[];
        return (isset($cookies["vote"]) && isset($cookies["vote"][$articleId]))?true:false;
    }
    function search($params) {
        $orderColumn = "id";
        $arrResult = ["total"=>0,"data"=>[]];
        $currentPage = isset($params['page'])?$params['page']:1;
        $keySearch = 'Elo.search_'.$currentPage.'.';
        $isNoCache = false;
        $articles = Article::Join("categories as cs","cs.id","=","articles.category_id")
            ->Where("status",1);
        $fields = "`articles`.`id`, `articles`.`title`,articles.abstract,articles.body, `articles`.`today_read`, `articles`.`author`, `articles`.`image`, `articles`.`md5_file`, `articles`.`link`, `articles`.`image_caption`, `cs`.`sefriendly` as `slug`, `cs`.`category_name`, `articles`.`category_id`, `articles`.`created`";
        if (isset($params['search_query'])){
            if (isset($params['search_title_only']) && $params['search_title_only']){
                $keySearch .= $params['search_title_only'];
                $articles = $articles->where("articles.title","like",'%'.$params['search_query'].'%');
            }else{
                $isNoCache = true;
                $articles = $articles->whereRaw("(MATCH (articles.body,articles.title,articles.abstract) AGAINST ('" . Common::secureSql($params['search_query']) . "' IN BOOLEAN MODE))");
                $fields .= ",(MATCH (articles.body,articles.title,articles.abstract) AGAINST ('" . Common::secureSql($params['search_query']) . "' IN BOOLEAN MODE)) as relevance";
                $orderColumn = "relevance";
            }
        }
        if (isset($params['search_cid']) && is_array($params['search_cid']) && $params['search_cid']){
            $articles = $articles->whereIn('articles.category_id',$params['search_cid']);
            $isNoCache = true;
        }
        if(isset($params['search_search_date']) && $params['search_search_date'] > 0 && $params['search_search_date'] <= 365) {
            $created = strtotime('-'.$params['search_search_date'].' days');
            if(isset($params['search_before_after']) && $params['search_before_after']) {
                $articles = $articles->where('articles.created','>=',date('Y-m-d',$created));
            } else {
                $articles = $articles->where('articles.created','<',date('Y-m-d',$created));
            }
            $isNoCache = true;
        }
        if(isset($params["search_author"]) && $params["search_author"]) {
            if(isset($params["search_author_exact_name"]) && $params["search_author_exact_name"]) {
                $articles = $articles->where('articles.author',$params["search_author"]);
            } else {
                $articles = $articles->where('articles.author',"like",'%'.$params["search_author"].'%');
            }
            $isNoCache = true;
        }
        if($isNoCache == false) {
            $arrCache = Cache::get($keySearch);
            if($arrCache) {
                return $arrCache;
            }
        }
        $counter = $articles;
        if($isNoCache == false) {
            $keyTotal = $keySearch.'_Total';
            $total = Cache::get($keyTotal);
            if(!$total) {
                $total = $counter->count();
                Cache::set($keyTotal,$total,now()->addMinutes(15));
            }
        } else {
            $total = $counter->count();
        }
        if($total > 0) {
            $perPage = 10;
            $numberPage = ceil($total/$perPage);

            if($currentPage < 1) {
                $currentPage = 1;
            }
            if($currentPage > $numberPage) {
                $currentPage = $numberPage;
            }
            $articles = $articles->selectRaw($fields)->orderBy($orderColumn,"DESC")
                ->offset(($currentPage-1)*$perPage)
                ->limit($perPage)->get();
            $arrResult["total"] = $total;
            $arrResult["data"] = $this->processQoute($articles);
        }
        if($isNoCache == false) {
            Cache::set($keySearch,$arrResult,now()->addMinutes(15));
        }
        return $arrResult;

    }
    function siteMap() {
        $keyCache = "site_map_rss1";
        $articles = Cache::get($keyCache);
        if($articles) {
            return $articles;
        }
        $time = date("Y-m-d H:i:s", (time() - 86400));
        $fields = ['articles.id',"articles.title","c.category_name",'articles.created','articles.last_edited','c.sefriendly','articles.category_id','articles.author','articles.body','articles.abstract','articles.image','articles.image_caption'];
        $articles = Article::Join("categories as c","c.id","=","articles.category_id")
            ->Where("status",1)
            ->where('created',">=",$time)
            ->select($fields)
            ->get();
        if(count($articles) == 0) {
            $articles = Article::Join("categories as c","c.id","=","articles.category_id")
                ->Where("status",1)
                ->orderBy("id","DESC")
                ->select($fields)
                ->limit(10)
                ->get();
        }
        $articles = $this->processQoute($articles);
        Cache::set($keyCache,$articles,now()->addMinutes(10));
        return $articles;
    }
    protected function processQoute($articles) {
        if($articles) {
            foreach ($articles as $key=>$article) {
                $article->title = htmlspecialchars_decode($article->title);
                $article->abstract = htmlspecialchars_decode($article->abstract);
                $article->body = htmlspecialchars_decode($article->body);
                $articles[$key] = $article;
            }
        }
        return $articles;
    }
    protected function getKeyCache($arr) {
        $string = '';
        foreach ($arr as $key=>$values) {
            if(is_array($values)) {
                foreach ($values as $key1=>$vl) {
                    $string .= $key1.'.'.$vl;
                }
            } else {
                $string .= $key.'.'.$values;
            }
        }
        return $string;
    }
}
