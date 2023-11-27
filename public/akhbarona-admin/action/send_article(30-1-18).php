<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'SQLServices.php';
require_once 'simplepush.php';
include_once 'GCM.php';
if (isset($_GET["strId"])) {
	$sqlObj			=		new SQLServices();
    $articleId		= 		$_GET["strId"];
 	$querySelect	=		"SELECT gcm_regid from gcm_users";
	$resultSelect	=		$sqlObj->executequery($querySelect);
   	if($sqlObj->getRowCount($resultSelect) > 0){
   		$totalRound			=	ceil($sqlObj->getRowCount($resultSelect)/900);
   		$totalRows			=	$sqlObj->getRowCount($resultSelect);
   		$totalCnt			=	1;
   		for ($i = 1; $i <= $totalRound; $i++) {
	   		$registatoin_ids	=	array();
   			for ($j = 1; $j <= 900 && $totalCnt <= $totalRows; $j++) {
   				$arrGcmId	=	$sqlObj->getAssoc($resultSelect);
   				$registatoin_ids[]	=	$arrGcmId['gcm_regid'];
   				$totalCnt++;
   			}
   			$sqlObj->executequery('SET CHARACTER SET utf8');
	   		$query 				=	"select art.id,art.category_id,art.title,art.image,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id=".$articleId." and cat.id=art.category_id";
	   		$result				=	$sqlObj->executequery($query);
	   		$arr				=	$sqlObj->getAssoc($result);
	   		$filePath			=	"https://" . $_SERVER['SERVER_NAME'] . dirname(dirname(dirname($_SERVER['REQUEST_URI'])));
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

		    $gcm 				= 	new GCM();

		    //print_r($registatoin_ids);
		    //$registatoin_ids 	= 	array($regId);
		    //$message 			= 	array("title" => $arr['title'],"img_url"  => "https://www.akhbarona.com/files/4511329_238517209.jpg");

		    $result = $gcm->send_notification($registatoin_ids, $arr);

		    //echo $result;
   		}
   	}

   	$query 				=	"select art.id,art.category_id,art.title,art.image,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id=".$articleId." and cat.id=art.category_id";
	$result				=	$sqlObj->executequery($query);
	$arr				=	$sqlObj->getAssoc($result);

	$querySelect	=		"SELECT * from iphone_users";
	$resultSelect	=		$sqlObj->executequery($querySelect);
	if($sqlObj->getRowCount($resultSelect) > 0){
		while ($arrSelect	=	$sqlObj->getAssoc($resultSelect)) {
			sendIphonePush($arrSelect['iphone_regid'], html_entity_decode($arr['title']));
		}
	}



}
?>
