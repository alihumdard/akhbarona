<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

require_once 'SQLServices.php';
/**
 * @file
 * sample_push.php
 *
 * Push demo
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://code.google.com/p/apns-php/wiki/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to aldo.armiento@gmail.com so we can send you a copy immediately.
 *
 * @author (C) 2010 Aldo Armiento (aldo.armiento@gmail.com)
 * @version $Id: sample_push.php 65 2010-12-13 18:38:39Z aldo.armiento $
 */

define('VALID_TOKEN', '1e82db91c7ceddd72bf33d74ae052ac9c84a065b35148ac401388843106a7485');
define('INVALID_TOKEN', 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff');

// Adjust to your timezone
date_default_timezone_set('Europe/Rome');

// Report all PHP errors
error_reporting(-1);

// Using Autoload all classes are loaded on-demand
require_once 'ApnsPHP/Autoload.php';


if (isset($_GET["strId"])) {
	$sqlObj			=		new SQLServices();
	$articleId		= 		$_GET["strId"];

    $sqlObj->executequery('SET CHARACTER SET utf8');
	$query 				=	"select art.id,art.category_id,art.title,art.image,art.body,art.author,art.created,art.user_id,art.times_read,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id=".$articleId." and cat.id=art.category_id";
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
	$title  =   $arr['title'];
	$image  =   $arr['image'];

	$newFileName = '../articalFile/'.$articleId.".txt";
	$newFileContent = json_encode($arr);

	if (file_put_contents($newFileName, $newFileContent) !== false) {
		//echo "File created (" . basename($newFileName) . ")";
		$url	=	$sqlObj->getFileUrl().$articleId.".txt";
		//androidpush notification

		$querySelect	=		"SELECT * from iphone_users where id = '3951'";
    	$resultSelect	=		$sqlObj->executequery($querySelect);
    	if($sqlObj->getRowCount($resultSelect) > 0){
    		while ($arrSelect	=	$sqlObj->getAssoc($resultSelect)) {
    			$arrDeviceToken[]		=	$arrSelect['iphone_regid'];
    		}
    		sendIphonePush($arrDeviceToken, html_entity_decode($title), $url);
    	}

    	//print_r($arrDeviceToken);


		/*$querySelect	=		"SELECT * from iphone_users";
    	$resultSelect	=		$sqlObj->executequery($querySelect);
    	if($sqlObj->getRowCount($resultSelect) > 0){
    		$registatoin_ids=	array();
    		$arrPushToken	=	array();
    		$totalCnt		=	0;
    		$i				=	0;

    		while ($arrSelect	=	$sqlObj->getAssoc($resultSelect)) {

    			if ($totalCnt==2000){
    				$totalCnt	=	0;
    				$arrPushToken	=	array();
    			}
    			$totalCnt++;
    			if ($arrSelect['iphone_regid']!=""){
    				$arrPushToken[]	=	$arrSelect['iphone_regid'];

    			}
    			if ($totalCnt==2000 || $sqlObj->getRowCount($resultSelect)==($i+1)){
    				$registatoin_ids[]	=	$arrPushToken;
    			}
    			$i++;

    			//$arrDeviceToken[]		=	$arrSelect['iphone_regid'];
    		}

    		for ($i = 0; $i < count($registatoin_ids); $i++) {
    			$arrPushTokens	= $registatoin_ids[$i];
    			print_r($arrPushTokens);
    			//sendIphonePush($arrPushTokens, html_entity_decode($title), $url);
    		}
    	}*/
	} else {

	}
}

function sendIphonePush($arrDeviceToken,$strMsg,$arr){


	// Instanciate a new ApnsPHP_Push object
	$push = new ApnsPHP_Push(
		ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
		'ck_push.pem'
	);

	// Set the Root Certificate Autority to verify the Apple remote peer
	$push->setRootCertificationAuthority('entrust_root_certification_authority.pem');

	// Connect to the Apple Push Notification Service
	$push->connect();

	for ($i = 0; $i < count($arrDeviceToken); $i++) {

		$deviceToken 	=	$arrDeviceToken[$i];

		// Instantiate a new Message with a single recipient
		$message = new ApnsPHP_Message($deviceToken);

		// Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
		// over a ApnsPHP_Message object retrieved with the getErrors() message.
		$message->setCustomIdentifier(sprintf("Message-Badge-%03d", $i));

		//$message->setCustomProperty('data', $arr);

		// Set badge icon to "3"
		$message->setBadge($i);

		// Add the message to the message queue
		$push->add($strMsg);
	}

	// Send all messages in the message queue
	$push->send();

	// Disconnect from the Apple Push Notification Service
	$push->disconnect();

	// Examine the error message container
	$aErrorQueue = $push->getErrors();
	if (!empty($aErrorQueue)) {
		var_dump($aErrorQueue);
	}
}

?>
