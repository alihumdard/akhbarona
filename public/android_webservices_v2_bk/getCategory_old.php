<?php

	require_once 'SQLServices.php';
	$sqlObj			=	new SQLServices();
	mysqli_query('SET CHARACTER SET utf8');

	//print_r($_POST);

	//die;

	if (isset($_POST['gcm_id'])){
		$gcm_regid		=	$_POST['gcm_id'];
		if (strlen(trim($gcm_regid))!=0){
			$querySelect	=	"SELECT * from gcm_users WHERE gcm_regid = '$gcm_regid'";
			$resultSelect	=	$sqlObj->executequery($querySelect);
			if ($sqlObj->getRowCount($resultSelect) == 0){
				$queryInsert	=	"INSERT INTO gcm_users(gcm_regid, created_at) VALUES('$gcm_regid', NOW())";
				$sqlObj->executequery($queryInsert);
			}
		}
	}

	$query			=	"select * from admob_status";
	$result			=	$sqlObj->executequery($query);
	$arrAdmob		=	$sqlObj->getAssoc($result);
	$post['admob_status']	=	$arrAdmob;

	$query 			=	"select * from categories";
	$result			=	$sqlObj->executequery($query);
	$output			=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$output[]	=	$arr;
		}
	}
	$post['category']	=	$output;
	$limitStart		=	$_POST['limit_start'];
	$limitEnd		=	$_POST['limit_end'];
	//or t.name Like '%Headline%'
	//$query 			=	"SELECT DISTINCT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id  group by art.id  order by art.id desc limit ".$limitStart." , ".$limitEnd."";
	//$query			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id IN (SELECT DISTINCT art.id FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id)  or art.category_id=32  group by art.id order by art.created  desc limit ".$limitStart." , ".$limitEnd."";
	$query				=	"select art.*,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat from articles art,categories cat where (art.id IN (SELECT DISTINCT art.id FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id) or art.category_id=32) and cat.id=art.category_id  group by art.id order by art.created  desc limit ".$limitStart." , ".$limitEnd."";

	$result			=	$sqlObj->executequery($query);
	$articles		=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
			$arr['image']		=	$filePath."files/".$arr['image'];
			if ($arr['parent_cat']==7){
				$arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
			}else{
				$arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
			}

			$queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
			$commentResult	=	$sqlObj->executequery($queryComment);
			if ($sqlObj->getRowCount($commentResult) > 0){
				$arrComment		=	$sqlObj->getAssoc($commentResult);
				$arr['comments']	=	$arrComment['total_comment'];
			}else{
				$arr['comments']	=	"0";
			}

			$articles[]	=	$arr;
		}
	}
	$post['articles']	=	$articles;

	$query 			=	"SELECT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM articles art,categories cat WHERE art.category_id = 40 and art.status=1 and cat.id=art.category_id ORDER BY art.created DESC LIMIT 0 , 5 ";
	$result			=	$sqlObj->executequery($query);
	$latestNews		=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
			$arr['image']		=	$filePath."files/".$arr['image'];
			if ($arr['parent_cat']==7){
				$arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
			}else{
				$arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
			}

			$queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
			$commentResult	=	$sqlObj->executequery($queryComment);
			if ($sqlObj->getRowCount($commentResult) > 0){
				$arrComment		=	$sqlObj->getAssoc($commentResult);
				$arr['comments']	=	$arrComment['total_comment'];
			}else{
				$arr['comments']	=	"0";
			}

			$latestNews[]	=	$arr;
		}
	}
	$post['latest_news']	=	$latestNews;


	/*$query 			=	"SELECT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM articles art,categories cat WHERE art.category_id = 32 and art.status=1 and  cat.id=art.category_id ORDER BY art.created DESC LIMIT ".$limitStart." , ".$limitEnd."";
	$result			=	$sqlObj->executequery($query);
	$videoNews		=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$filePath			=	"http://" . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
			$arr['image']		=	$filePath."files/".$arr['image'];
			if ($arr['parent_cat']==7){
				$arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
			}else{
				$arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
			}

			$queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
			$commentResult	=	$sqlObj->executequery($queryComment);
			if ($sqlObj->getRowCount($commentResult) > 0){
				$arrComment		=	$sqlObj->getAssoc($commentResult);
				$arr['comments']	=	$arrComment['total_comment'];
			}else{
				$arr['comments']	=	"0";
			}

			$videoNews[]	=	$arr;
		}
	}
	$post['video_news']	=	$videoNews;*/


	/*$query 			=	"SELECT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM articles art,categories cat WHERE `category_id` = 57 and  cat.id=art.category_id ORDER BY `created` DESC LIMIT ".$limitStart." , ".$limitEnd."";
	$result			=	$sqlObj->executequery($query);
	$sportsTV		=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$filePath			=	"http://" . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
			$arr['image']		=	$filePath."files/".$arr['image'];
			if ($arr['parent_cat']==7){
				$arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
			}else{
				$arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
			}

			$queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
			$commentResult	=	$sqlObj->executequery($queryComment);
			if ($sqlObj->getRowCount($commentResult) > 0){
				$arrComment		=	$sqlObj->getAssoc($commentResult);
				$arr['comments']	=	$arrComment['total_comment'];
			}else{
				$arr['comments']	=	"0";
			}

			$sportsTV[]	=	$arr;
		}
	}
	$post['sports_tv']	=	$sportsTV;*/


	header('Content-type: application/json');
	echo json_encode($post);


?>
