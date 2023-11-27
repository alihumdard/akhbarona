<?php

	require_once 'SQLServices.php';
    require_once 'file-cache/Cache.php';
	$categoryId		=	$_GET['categoryId'];
	$limitStart		=	$_GET['limit_start'];
	$limitEnd		=	$_GET['limit_end'];
    $valueC = null;
    $keyCache = 'getArticle-'.$categoryId.'-'.$limitStart.'-'.$limitEnd;
    //if($limitStart < 3) {
        $valueC = Cache::get($keyCache);
    //}
    if(!$valueC) {
        $sqlObj			=	new SQLServices();
        mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
        $query 			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.category_id=".$categoryId." and cat.id=art.category_id and art.status=1 order by art.created desc limit ".$limitStart." , ".$limitEnd."";

        if ($categoryId==7){
            $query 			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where (art.category_id=".$categoryId." or art.category_id=41 or art.category_id=50 or art.category_id=51 or art.category_id=52 or art.category_id=53 or art.category_id=54 or art.category_id=55) and cat.id=art.category_id and art.status=1 order by art.created desc limit ".$limitStart." , ".$limitEnd."";
        }


        //$query 			=	"select * from articles where category_id=".$categoryId." and created like '%2015-01-30%' order by created desc limit 0,10";
        $result			=	$sqlObj->executequery($query);
        $output			=	array();
        if ($sqlObj->getRowCount($result) > 0){
            while ($arr	=	$sqlObj->getAssoc($result)) {
                $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                $arr['image']		=	$filePath."files/".$arr['image'];
                if ($arr['parent_cat']==7){
                    $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                }else{
                    $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                }

                $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status= '1'";
                $commentResult	=	$sqlObj->executequery($queryComment);
                if ($sqlObj->getRowCount($commentResult) > 0){
                    $arrComment		=	$sqlObj->getAssoc($commentResult);
                    $arr['comments']	=	$arrComment['total_comment'];
                }else{
                    $arr['comments']	=	"0";
                }

                $output[]	=	$arr;
            }
        }
        $post['data']	=	$output;
        //if($limitStart < 3) {
            Cache::set($keyCache,$post,600);
        //}
        $sqlObj->closeConnection();
    } else {
        $post = $valueC;
    }
	header('Content-type: application/json');
	echo json_encode($post);
?>
