<?php
	require_once 'SQLServices.php';
	$sqlObj			=	new SQLServices();
	$name			=	addslashes($_POST['name']);
	$title			=	addslashes($_POST['title']);
	$comment		=	addslashes($_POST['comment']);
	$articleId		=	addslashes($_POST['article_id']);
	mysqli_query($sqlObj->connection,"SET NAMES utf8;");
	mysqli_query($sqlObj->connection,"SET CHARACTER_SET utf8;");
	$query			=	"insert into comments (article_id,description,create_dt,author,ip,status,www,vote) values(".$articleId.",'".$comment."','".gmdate("Y-m-d H:m:s")."','".$name."','50.31.98.16','0','".$title."',0)";
	$sqlObj->executequery($query);
	$status['status']		=	"success";
	$posts					=	array('api_response'=>$status);
	$sqlObj->closeConnection();
	echo json_encode($posts);

?>
