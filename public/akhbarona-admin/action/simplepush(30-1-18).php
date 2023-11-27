<?php
/*
// Put your device token here (without spaces):
$deviceToken = '8b0765aefa0889430ade1aeee539b574a8e00ac49532c4f694674ff1de9c2a4a';

// Put your private key's passphrase here:
$passphrase = 'akhbar';

// Put your alert message here:
$message = 'My first push notification!';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
	'alert' => $message,
	'sound' => 'default'
	);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);*/


function sendIphonePush($token,$strMsg){
	// Put your device token here (without spaces):
	
	$deviceToken = $token;
	
	// Put your private key's passphrase here:
	$passphrase = 'akhbar';
	
	// Put your alert message here:
	$message = $strMsg;
	
	////////////////////////////////////////////////////////////////////////////////
	
	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	
	// Open a connection to the APNS server
	$fp = stream_socket_client(
		'ssl://gateway.push.apple.com:2195', $err,
		$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	
	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);
	
	echo 'Connected to APNS' . PHP_EOL;
	
	// Create the payload body
	$body['aps'] = array(
		'alert' => $message,
		'sound' => 'default'
		);
	
	// Encode the payload as JSON
	$payload = json_encode($body);
	
	// Build the binary notification
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
	
	// Send it to the server
	$result = fwrite($fp, $msg, strlen($msg));
	
	if (!$result)
		echo 'Message not delivered' . PHP_EOL;
	else
		echo 'Message successfully delivered' . PHP_EOL;
	
	// Close the connection to the server
	fclose($fp);
}