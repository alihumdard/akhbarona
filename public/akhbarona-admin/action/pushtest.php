<?php

require_once 'SQLServices.php';
require_once 'simplepush.php';
$sqlObj			=		new SQLServices();
	/*$sqlObj			=		new SQLServices();
	$querySelect	=		"SELECT * from iphone_users limit 0,1";
	$resultSelect	=		$sqlObj->executequery($querySelect);
	
	if($sqlObj->getRowCount($resultSelect) > 0){
		
		while ($arrSelect	=	$sqlObj->getAssoc($resultSelect)) {
			echo "TEst ".$arrSelect['iphone_regid']."<br>";
			sendIphonePush($arrSelect['iphone_regid'], 'Test Push');

		}	
	}*/

$data	=array("5b253f84e783b9c670dd4049ce845f7e9b0da8efbf7a4e803c67a8a8cff6a47d");
$url	=	$sqlObj->getFileUrl().'232093.txt';
	sendIphonePush($data, 'Test Push',$url);
?>
	
