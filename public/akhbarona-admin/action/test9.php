<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

require_once 'SQLServices.php';



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
	// Put your private key's passphrase here:
	$passphrase = 'akhbarona@123';

	// Put your alert message here:
	$message = $strMsg;

	////////////////////////////////////////////////////////////////////////////////

	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_push.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

	// Open a connection to the APNS server
	$fp = stream_socket_client(
			'ssl://gateway.push.apple.com:2195', $err,
			//'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	stream_set_blocking ($fp, 0);

	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);

	echo 'Connected to APNS' . PHP_EOL;

	//sendPushUsingConnection($fp,$message,$arr,$arrDeviceToken,0);

	$result = array();

	for ($i = 0; $i < count($arrDeviceToken); $i++) {

		$deviceToken 	=	$arrDeviceToken[$i];

		// Create the payload body
		$body['aps'] = array(
				'alert' => $message,
				'sound' => 'default',
				'badge' => 0
		);
		$body['data'] =	$arr;
		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result[] = fwrite($fp, $msg, strlen($msg));

		sleep(2);

		checkAppleErrorResponse($fp);
		if (!$result){
			echo 'Message not delivered' . PHP_EOL;
		}else{
			echo 'Message successfully delivered' . PHP_EOL;
		}
	}


	usleep(500000); //Pause for half a second. Note I tested this with up to a 5 minute pause, and the error message was still available to be retrieved

    checkAppleErrorResponse($fp);

    echo 'DONE!';


	// Close the connection to the server
	fclose($fp);
}


//FUNCTION to check if there is an error response from Apple
//         Returns TRUE if there was and FALSE if there was not
function checkAppleErrorResponse($fp) {

   //byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). Should return nothing if OK.
   $apple_error_response = fread($fp, 6);
   //NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait forever when there is no response to be sent.

   echo $apple_error_response;

   if ($apple_error_response) {
        //unpack the error response (first byte 'command" should always be 8)
        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response);

        if ($error_response['status_code'] == '0') {
            $error_response['status_code'] = '0-No errors encountered';
        } else if ($error_response['status_code'] == '1') {
            $error_response['status_code'] = '1-Processing error';
        } else if ($error_response['status_code'] == '2') {
            $error_response['status_code'] = '2-Missing device token';
        } else if ($error_response['status_code'] == '3') {
            $error_response['status_code'] = '3-Missing topic';
        } else if ($error_response['status_code'] == '4') {
            $error_response['status_code'] = '4-Missing payload';
        } else if ($error_response['status_code'] == '5') {
            $error_response['status_code'] = '5-Invalid token size';
        } else if ($error_response['status_code'] == '6') {
            $error_response['status_code'] = '6-Invalid topic size';
        } else if ($error_response['status_code'] == '7') {
            $error_response['status_code'] = '7-Invalid payload size';
        } else if ($error_response['status_code'] == '8') {
            $error_response['status_code'] = '8-Invalid token';
        } else if ($error_response['status_code'] == '255') {
            $error_response['status_code'] = '255-None (unknown)';
        } else {
            $error_response['status_code'] = $error_response['status_code'] . '-Not listed';
        }

        echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';
        echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';

        return true;
   }
   return false;
}

?>
