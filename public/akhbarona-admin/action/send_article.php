<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'SQLServices.php';
require_once 'simplepush.php';
include_once 'FCM.php';

// Report all PHP errors
error_reporting(-1);

// Using Autoload all classes are loaded on-demand
require_once '../ApnsPHP/Autoload.php';

if (isset($_GET["strId"])) {
	$sqlObj			=		new SQLServices();
    $articleId		= 		$_GET["strId"];
    $strDevice 		= 		$_GET["strDevice"];

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

    	if ($strDevice == "iphone"){


	    	///ios push notificvation
	    	$querySelect	=		"SELECT * from iphone_users";
	    	$resultSelect	=		$sqlObj->executequery($querySelect);
	    	if($sqlObj->getRowCount($resultSelect) > 0){

	    		while ($arrSelect	=	$sqlObj->getAssoc($resultSelect)) {
	    			$arrDeviceToken[]		=	$arrSelect['iphone_regid'];
	    		}
    			// Instanciate a new ApnsPHP_Push object
				$push = new ApnsPHP_Push(
					ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
					'ck_push.pem'
				);

				// Set the Root Certificate Autority to verify the Apple remote peer
				$push->setRootCertificationAuthority('entrust_root_certification_authority.pem');

				// Connect to the Apple Push Notification Service
				$push->connect();

				//$i = 1;

    			for ($i = 0; $i < count($arrDeviceToken); $i++) {

					// Instantiate a new Message with a single recipient
					$message = new ApnsPHP_Message($arrDeviceToken[$i]);

					// Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
					// over a ApnsPHP_Message object retrieved with the getErrors() message.
					$message->setCustomIdentifier(sprintf("Message-Badge-%03d", $i+1));

					// Set a simple welcome text
					$message->setText(html_entity_decode($title));
					//$message->setLocKey($title);

					// Play the default sound
					$message->setSound();

					// Set badge icon to "3"
					//$message->setBadge($i);

					$message->setCustomProperty('data', $url);


					// Add the message to the message queue
					$push->add($message);
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
    	}else{


    			//androidpush notification
		    	$querySelect	=		"SELECT gcm_regid from gcm_users";
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
		    		$dataFile['title']  =   $title;
		    		$dataFile['image']	=	$image;
		    		$dataFile['url']	=	$url;

		    		for ($i = 0; $i < count($registatoin_ids); $i++) {
		    			$arrPushTokens	= $registatoin_ids[$i];
		    			$fcm 			= 	new FCM();
		    			$result = $fcm->send_notification($arrPushTokens, $dataFile);
		    		}

		    	}
    	}
    } else {

    }

}
?>
