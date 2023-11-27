<?php

namespace App\Http\Controllers\Api;

use App\Helper\Common;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    private $timeCache = 30;
    private $connection;
    function appVersion() {
        $ios_version			        =	'1.2';
        $android_version			    =	'1.3';
        $post['version']	            =	$ios_version;
        $post['android_version']	    =	$android_version;
        return response()->json($post,200);
    }
    function checkVersion() {
        $ios_version			        =	'1.1';
        $android_version			    =	'1.2';
        $post['version']	            =	$ios_version;
        $post['android_version']	=	$android_version;
        return response()->json($post,200);
    }
    function getVersion() {
        $ios_version			        =	'1.1';
        $android_version			    =	'1.2';
        $post['version']	            =	$ios_version;
        $post['android_version']	    =	$android_version;
        return response()->json($post,200);
    }
    function doPostComment(Request $request) {
        $commentSave = new Comment();
        $commentSave->author			=	$request->name;
        $commentSave->www			    =	$request->title;
        $commentSave->description		=	$request->comment;
        $commentSave->article_id		=	$request->article_id;
        $commentSave->create_dt         =   gmdate("Y-m-d H:i:s");
        $commentSave->ip                =   $request->getClientIp();
        $commentSave->status            =   0;
        $commentSave->vote              =   0;
        $commentSave->save();
        $status['status']		=	"success";
        $posts					=	array('api_response'=>$status);
        return response()->json($posts,200);
    }
    function getCommentCounts(Request $request) {
        $articleId		=	$request->articleId;
        if(!$articleId) {
            return '';
        }
        $keyCache       = 'getCommentCounts1-'.$articleId;
        $post          = Cache::get($keyCache);
        if(!$post) {
            $total = (int)Comment::where("article_id",$articleId)->where("status","1")->count();
            $post['count']	=	$total;
            Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
        }
        return $this->json($post);
    }
    function getComments(Request $request) {
        $articleId		=	$request->articleId;
        if(!$articleId) {
            return '';
        }
        $keyCache       = 'getComments-011120'.$articleId;
        $post          = Cache::get($keyCache);
        if(!$post) {
            $post['data'] = Comment::where("article_id",$articleId)->where("status","1")->get();
            Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
        }
        return $this->json($post);
    }
    function getArticle() {
        $categoryId		=	$_GET['categoryId'];
        $limitStart		=	$_GET['limit_start'];
        $limitEnd		=	$_GET['limit_end'];
        $valueC = null;
        $keyCache = 'getArticle-011120'.$categoryId.'-'.$limitStart.'-'.$limitEnd;
        //if($limitStart < 3) {
        $valueC = Cache::get($keyCache);
        //}
        if(!$valueC) {
            $this->get_connection();
            mysqli_query($this->connection,'SET CHARACTER SET utf8');
            $query 			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.category_id=".$categoryId." and cat.id=art.category_id and art.status=1 order by art.id desc limit ".$limitStart." , ".$limitEnd."";

            if ($categoryId==7){
                $query 			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where (art.category_id=".$categoryId." or art.category_id=41 or art.category_id=50 or art.category_id=51 or art.category_id=52 or art.category_id=53 or art.category_id=54 or art.category_id=55) and cat.id=art.category_id and art.status=1 order by art.id desc limit ".$limitStart." , ".$limitEnd."";
            }


            //$query 			=	"select * from articles where category_id=".$categoryId." and created like '%2015-01-30%' order by created desc limit 0,10";
            $result			=	mysqli_query($this->connection,$query);
            $output			=	array();
            //dd($result);
            if (mysqli_num_rows($result) > 0){
                while ($arr	=	mysqli_fetch_assoc($result)) {
                    //dd($arr);
                    $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                    $arr['image']		=	$filePath."files/".$arr['image'];
                    if ($arr['parent_cat']==7){
                        $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                    }else{
                        $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                    }

                    $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status= '1'";
                    $commentResult	=	mysqli_query($this->connection,$queryComment);
                    if (mysqli_num_rows($commentResult) > 0){
                        $arrComment		=	mysqli_fetch_assoc($commentResult);
                        $arr['comments']	=	$arrComment['total_comment'];
                    }else{
                        $arr['comments']	=	"0";
                    }

                    $output[]	=	$arr;
                }
            }
            $post['data']	=	$output;
            //if($limitStart < 3) {
            Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
            //}
            mysqli_close($this->connection);
        } else {
            $post = $valueC;
        }
        header('Content-type: application/json');
        echo json_encode($post);exit();

    }
    function searchApi(Request $request) {
        $post['data']	=	array();
        return $this->json($post);
    }
    function getArticleById(Request $request) {
        $articleId		=	$request->articleId;
        if(!$articleId) {
            return '';
        }
        $keyCache = 'ID1-'.$articleId;
        $post = Cache::get($keyCache);
        if(!$post) {
            $arr = Article::join("categories as cat","cat.id","=","articles.category_id")
                        ->where("articles.id",$articleId)
                        ->selectRaw("articles.*,cat.category_name,cat.sefriendly,cat.parent_cat")->first();
            $output = array();
            if ($arr) {
                $arr['image'] = Config::get("app.cdn_url") . "files/" . $arr['image'];
                $arr['link_url'] = Common::article_link($arr);
                $arr["title"]       = htmlspecialchars($arr["title"]);
                $arr["abstract"]       = htmlspecialchars($arr["abstract"]);
                //$arr["body"]       = htmlspecialchars($arr["body"]);
                $arr["category_name"]       = htmlspecialchars($arr["category_name"]);
                $arr["author"]       = htmlspecialchars($arr["author"]);
                $arr['comments']    = Comment::where("article_id",$arr['id'])->where("status","1")->count();
                $output[] = $arr;
            }
            $post['data'] = $output;
            Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
        }
        return $this->json($post);
    }
    function search(Request $request) {
        $keyCache       = 'search_api191020';
        $value          = Cache::get($keyCache);
        if(!$value) {
            $this->get_connection();
            mysqli_query($this->connection,'SET CHARACTER SET utf8');
            //$categoryId		=	$_GET['categoryId'];
            //$query 			=	"select * from articles where title like 'بوعيدة تتباحث مع وزير شؤون خارجية لاتفيا حول سبل النهوض بالعلاقات الثنائية'";
            //$query				=	"SELECT DISTINCT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%' or art.category_id=32) and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id  order by art.id desc limit 0,10";
            //->selectRaw("articles.id,articles.category_id,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat")
            $query = "select art.id,art.image,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat
            from articles art INNER JOIN categories cat ON cat.id=art.category_id
            LEFT  JOIN articles_tags as at ON art.id = at.article_id
             WHERE art.status = 1 AND ((at.tag_id IN(1,2) AND at.tags_group_id = 1) OR art.category_id=32)
            group by art.id order by art.id desc limit 0,50";
            //IN
            $result = mysqli_query($this->connection,$query);
            $articles = array();
            if (mysqli_num_rows($result) > 0) {
                while ($arr = mysqli_fetch_assoc($result)) {
                    //dd($arr);
                    $filePath = "https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                    $arr['image'] = $filePath . "files/" . $arr['image'];
                    if ($arr['parent_cat'] == 7) {
                        $arr['link_url'] = $filePath . "sport/" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                    } else {
                        $arr['link_url'] = $filePath . "" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                    }

                    $queryComment = "select count(*) as total_comment from comments where article_id=" . $arr['id'] . " and status='1'";
                    $commentResult = mysqli_query($this->connection,$queryComment);
                    if (mysqli_num_rows($commentResult) > 0) {
                        $arrComment = mysqli_fetch_assoc($commentResult);
                        $arr['comments'] = $arrComment['total_comment'];
                    } else {
                        $arr['comments'] = "0";
                    }

                    $articles[] = $arr;
                }
            }
            $post['articles'] = $articles;
            Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
            mysqli_close($this->connection);
        } else {
            $post = $value;
        }
        header('Content-type: application/json');
        echo json_encode($post);
    }
    function getCategory() {
        $IOS_VERSION = '1.6';
        $ANDROID_VERSION = '1.9';
        $YOUTUBE_KEY = 'AIzaSyDbGaeCX3E2NqikXixgDOse86IVKbjrBfw';

        //print_r($_POST);

        //die;

        if (isset($_POST['gcm_id']) && isset($_POST['deviceId'])){
            $this->get_connection();
            mysqli_query($this->connection,'SET CHARACTER SET utf8');
            $gcm_regid		=	$_POST['gcm_id'];
            $deviceId		=	$_POST['deviceId'];
            if ( (strlen(trim($gcm_regid))!=0) && ($_POST['deviceId']!='') ){
                $querySelect	=	"SELECT * from gcm_users WHERE device_id = '$deviceId'";
                $resultSelect	=	mysqli_query($this->connection,$querySelect);
                if (mysqli_num_rows($resultSelect) == 0){
                    $queryInsert	=	"INSERT INTO gcm_users(gcm_regid,device_id, created_at) VALUES('$gcm_regid','$deviceId', NOW())";
                    mysqli_query($this->connection,$queryInsert);
                }else{
                    $queryInsert	=	"update gcm_users set gcm_regid='".$gcm_regid."' where device_id='".$deviceId."'";
                    mysqli_query($this->connection,$queryInsert);
                }
            }
        }

        if (isset($_POST['firebase_token'])){
            $this->get_connection();
            mysqli_query($this->connection,'SET CHARACTER SET utf8');
            $iphoneId		=	$_POST['firebase_token'];
            if (strlen(trim($iphoneId))!=0){
                $iphoneUdid		=	$_POST['iphone_udId'];
                $querySelect	=	"SELECT * from iphone_users WHERE iphone_udid = '$iphoneUdid' or iphone_regid='$iphoneId'";
                $resultSelect	=	mysqli_query($this->connection,$querySelect);
                if (mysqli_num_rows($resultSelect) == 0){
                    $queryInsert	=	"INSERT INTO iphone_users(iphone_udid,iphone_regid,created_at) VALUES('$iphoneUdid','$iphoneId', NOW())";
                    mysqli_query($this->connection,$queryInsert);
                }else{
                    $arr			=	mysqli_fetch_assoc($resultSelect);

                    $queryInsert	=	"update iphone_users set iphone_regid='$iphoneId' where iphone_udid='".$arr['iphone_udid']."'";
                    mysqli_query($this->connection,$queryInsert);
                }
            }
        }
        $keyCache       = 'admob_status_new_1';
        $admodValue     = Cache::get($keyCache);
        if(!$admodValue) {
            $this->get_connection();
            $query			=	"select * from admob_status";
            $result			=	mysqli_query($this->connection,$query);
            $arrAdmob		=	mysqli_fetch_assoc($result);
            //print_r($arrAdmob);die;
            Cache::set($keyCache,$arrAdmob,now()->addSeconds(86400));
        } else {
            $arrAdmob       = $admodValue;
        }
        $post['admob_status']	=	$arrAdmob;


        $post['iphone_version'] = $IOS_VERSION;
        $post['android_version'] = $ANDROID_VERSION;
        $post['youtube_key'] = $YOUTUBE_KEY;

        /*$query 			=	"select * from categories";
        $result			=	$sqlObj->executequery($query);
        $output			=	array();
        if ($sqlObj->getRowCount($result) > 0){
            while ($arr	=	$sqlObj->getAssoc($result)) {
                $output[]	=	$arr;
            }
        }
        $post['category']	=	$output;*/

        $limitStart		=	$_POST['limit_start'];
        $limitEnd		=	$_POST['limit_end'];
        $keyCache       = 'getCategory-191020-'.$limitStart.'-'.$limitEnd;
        $catValue       = null;
        if($limitStart < 600) {
            $catValue   = Cache::get($keyCache);
        }
        if(!$catValue) {
            $this->get_connection();
            mysqli_query($this->connection,'SET CHARACTER SET utf8');
            $query              = "SELECT art.*,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat
                                FROM articles as art INNER JOIN categories as cat ON art.category_id = cat.id
                                LEFT JOIN articles_tags as at ON at.article_id = art.id
                                WHERE art.status=1
                                AND ((at.tag_id IN(1,2) AND at.tags_group_id = 1) OR art.category_id=32)
                                group by art.id order by art.id  desc limit ".$limitStart." , ".$limitEnd;

            $result			=	mysqli_query($this->connection,$query);
            $articles		=	array();
            if (mysqli_num_rows($result) > 0){
                while ($arr	=	mysqli_fetch_assoc($result)) {
                    $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                    $arr['image']		=	$filePath."files/".$arr['image'];
                    if ($arr['parent_cat']==7){
                        $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                    }else{
                        $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                    }

                    $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
                    $commentResult	=	mysqli_query($this->connection,$queryComment);
                    if (mysqli_num_rows($commentResult) > 0){
                        $arrComment		=	mysqli_fetch_assoc($commentResult);
                        $arr['comments']	=	$arrComment['total_comment'];
                    }else{
                        $arr['comments']	=	"0";
                    }

                    $articles[]	=	$arr;
                }
            }
            $post['articles']	=	$articles;

            $query 			=	"SELECT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM articles art,categories cat WHERE art.category_id = 40 and art.status=1 and cat.id=art.category_id ORDER BY art.id DESC LIMIT 0 , 5 ";
            $result			=	mysqli_query($this->connection,$query);
            $latestNews		=	array();
            if (mysqli_num_rows($result) > 0){
                while ($arr	=	mysqli_fetch_assoc($result)) {
                    $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                    $arr['image']		=	$filePath."files/".$arr['image'];
                    if ($arr['parent_cat']==7){
                        $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                    }else{
                        $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                    }

                    $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
                    $commentResult	=	mysqli_query($this->connection,$queryComment);
                    if (mysqli_num_rows($commentResult) > 0){
                        $arrComment		=	mysqli_fetch_assoc($commentResult);
                        $arr['comments']	=	$arrComment['total_comment'];
                    }else{
                        $arr['comments']	=	"0";
                    }

                    $latestNews[]	=	$arr;
                }
            }
            $post['latest_news']	=	$latestNews;
            if($limitStart < 600) {
                Cache::set($keyCache,$post,now()->addMinutes($this->timeCache));
            }
        } else {
            $post = $catValue;
        }
        if($this->connection) {
            mysqli_close($this->connection);
        }
        header('Content-type: application/json');
        //return $this->json($post);
        echo json_encode($post);exit();
    }
    private function json($data,$code=200) {
        return response()->json($data,$code,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    private function get_connection(){
        $database = Config::get("database.connections.mysql");
        if(!$this->connection) {
            $this->connection = mysqli_connect($database["host"],$database["username"],$database["password"],$database["database"]);
        }
    }
}
