<?php
// require_once 'SQLServices.php';
// $sqlObj			=	new SQLServices();

$ios_version			        =	'1.1';
$android_version			    =	'1.2';
$post['version']	            =	$ios_version;
$post['android_version']	    =	$android_version;
header('Content-type: application/json');
echo json_encode($post);
?>
