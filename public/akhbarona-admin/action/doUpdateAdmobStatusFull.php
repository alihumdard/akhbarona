<?php
	require_once 'SQLServices.php';
	$sqlObj			=	new SQLServices();
	$status			=	$_GET['admob_status'];
	
	$result			=	$sqlObj->executequery("update admob_status set admob_full_status='".$status."'");
	if($result){
		echo "1";
	}else{
		echo "0";
	}
?>