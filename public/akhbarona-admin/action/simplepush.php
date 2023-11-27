<?php
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

	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);

	echo 'Connected to APNS' . PHP_EOL;

	sendPushUsingConnection($fp,$message,$arr,$arrDeviceToken,0);
	/* for ($i = 0; $i < count($arrDeviceToken); $i++) {
	
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
		$result = fwrite($fp, $msg, strlen($msg));
	
		if (!$result){
			echo 'Message not delivered' . PHP_EOL;
		}else{
			echo 'Message successfully delivered' . PHP_EOL;
		}
	}
	
	// Close the connection to the server
	fclose($fp); */
}

function sendPushUsingConnection($fp,$message,$arr,$arrDeviceToken,$pushCnt){
	$deviceToken 	=	$arrDeviceToken[$pushCnt];

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
	$result = fwrite($fp, $msg, strlen($msg));

	$pushCnt	=	$pushCnt+1;

	if ($pushCnt < count($arrDeviceToken)){
		if (!$result){
			//echo $deviceToken.' Message not delivered' . PHP_EOL."</br>";
			sendPushUsingConnection($fp,$message,$arr,$arrDeviceToken,$pushCnt);
		}else{
			//echo $deviceToken.' Message successfully delivered' . PHP_EOL."</br>";
			sendPushUsingConnection($fp,$message,$arr,$arrDeviceToken,$pushCnt);
		}
	}else{
		fclose($fp);
	}

}
?>