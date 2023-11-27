<?php

require_once 'SQLServices.php';
require_once 'simplepush.php';
include_once 'FCM.php';

// Report all PHP errors
error_reporting(-1);

// Using Autoload all classes are loaded on-demand
require_once '../ApnsPHP/Autoload.php';


if (isset($_GET["device_id"])) {
	$sqlObj			=		new SQLServices();
	$deviceId			= 		$_GET["device_id"];

	$articleId		= 		"274467";


	$sqlObj->executequery('SET CHARACTER SET utf8');
	$query 				=	"select art.id,art.category_id,art.title,art.image,art.body,art.author,art.created,art.user_id,art.times_read,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id=".$articleId." and cat.id=art.category_id";
	$result				=	$sqlObj->executequery($query);
	$arr				=	$sqlObj->getAssoc($result);
	$filePath			=	"http://" . $_SERVER['SERVER_NAME'] . dirname(dirname(dirname($_SERVER['REQUEST_URI'])));
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
	$title  =   $arr['title'];
	$image  =   $arr['image'];

	$newFileName = '../articalFile/'.$articleId.".txt";
	$newFileContent = json_encode($arr);


	if (file_put_contents($newFileName, $newFileContent) !== false) {
		//echo "File created (" . basename($newFileName) . ")";
		$url	=	$sqlObj->getFileUrl().$articleId.".txt";

		//androidpush notification
		$querySelect	=		"SELECT gcm_regid from gcm_users where device_id='".$deviceId."'";
		$resultSelect	=		$sqlObj->executequery($querySelect);
		if($sqlObj->getRowCount($resultSelect) > 0){
			$registatoin_ids=	array();
			$arrPushToken	=	array();
			$totalCnt		=	0;
			$i				=	0;

			while($arrGcmId	=	$sqlObj->getAssoc($resultSelect)){
				if ($totalCnt==700){
					$totalCnt	=	0;
					$arrPushToken	=	array();
				}
				$totalCnt++;
				if ($arrGcmId['gcm_regid']!=""){
					$arrPushToken[]	=	$arrGcmId['gcm_regid'];

				}
				if ($totalCnt==700 || $sqlObj->getRowCount($resultSelect)==($i+1)){
					$registatoin_ids[]	=	$arrPushToken;
				}
				$i++;
			}

			$dataFile   =   array();
			$dataFile['id'] 	=   $articleId;
			$dataFile['title']  =   "Testing";
			$dataFile['image']	=	$image;
			$dataFile['url']	=	$url;

			for ($i = 0; $i < count($registatoin_ids); $i++) {
				$arrPushTokens	= $registatoin_ids[$i];
				$fcm 			= 	new FCM();
				$result = $fcm->send_notification($arrPushTokens, $dataFile);
			}

		}

	}else{
		echo "no_url";
	}

}
