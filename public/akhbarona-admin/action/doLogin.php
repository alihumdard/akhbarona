<?php
	session_start();
	require_once 'SQLServices.php';
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$sqlObj			=	new SQLServices();
		$userName		=	addslashes($_POST['username']);
		$userPassword	=	addslashes($_POST['password']);
		$result			=	$sqlObj->executequery("select * from tbl_admin_login where username='".$userName."' and password='".$userPassword."'");
		if ($sqlObj->getRowCount($result) > 0) {
			$_SESSION['username']	=	$userName;
			header("Location:../home.php");
		}else{
			$_SESSION['msgOk']		=		"Invalid username or password";
			header("Location:../index.php");
		}
	}else{
		header("Location:../index.php");
	}
?>