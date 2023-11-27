<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_GET["regId"]) && isset($_GET["message"])) {
    $regId = $_GET["regId"];
    $message = $_GET["message"];
    
    include_once './GCM.php';
    
    $gcm = new GCM();

    $registatoin_ids = array($regId);
    $message = array("msg" => $message,"img_url"  => "https://www.akhbarona.com/files/4511329_238517209.jpg");

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
}
?>
