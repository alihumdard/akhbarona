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

//if (isset($_GET["strId"])) {
	$sqlObj			=		new SQLServices();
    $articleId		= 		"274792";//$_GET["strId"];
    $strDevice 		= 		"android";//$_GET["strDevice"];

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

		$dataFile   =   array();
		$dataFile['id'] 	=   $articleId;
		$dataFile['title']  =   $title;
		$dataFile['image']	=	$image;
		$dataFile['url']	=	$url;
		$fcm 			= 	new FCM();

    	if ($strDevice == "iphone"){
    	    $dataFile['body'] = $title;
    	    $dataFile['title'] = "AKHBARONA";
    	    $dataFile['sound'] = "default";
    	    $result = $fcm->send_topic_notification($dataFile,"notification","iOSAkhbaronaNews");
    	}else{
	    	$result = $fcm->send_topic_notification($dataFile,"data","androidAkhbaronaNews");
    	}
    } else {

    }


    /*function send_topic_notification($message,$payloadKey,$topic) {
        // include config
      $puskKey	=	"AAAA_LyuEPE:APA91bGG1T687EHGqaIQq7egU3yt35TIXVlaJJUxE5V4FyyeUIz8ynoFbdwupRq1OsV-9kn7QYf0Xu2ep4CU42KYH61ZgNZN0xs_nO6JJabr_TXxMixD9yqodHd9FZgqxvKjEkgcfzlV";


        //echo GOOGLE_API_KEY;

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => "/topics/".$topic,
				'priority' 			=> 'high',
            $payloadKey => $message,
        );

        print_r($fields);

        $headers = array(
           'Authorization: key=' . $puskKey,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;
    }*/

//}
?>
