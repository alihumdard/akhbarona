<?php
require_once 'SQLServices.php';
require_once 'file-cache/Cache.php';
$articleId		=	$_GET['articleId'];
if(!$articleId) {
    return '';
}
$keyCache       = 'getCommentCounts-'.$articleId;
$value          = Cache::get($keyCache);
if(!$value) {
    $sqlObj			=	new SQLServices();
    mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
    $query 			=	"SELECT count(id) as count FROM `comments` where article_id='".$articleId."'  and status='1'";
    $result			=	$sqlObj->executequery($query);
    $output			=	array();

    if ($sqlObj->getRowCount($result) > 0){//rowCount()
        while ($arr	=	$sqlObj->getAssoc($result)) {
            $post['count']	=	$arr['count'];
        }
    }else{
        $post['count']	=	'0';
    }
    Cache::set($keyCache,$post,1200);
    $sqlObj->closeConnection();
} else {
    $post           = $value;
}
header('Content-type: application/json');
echo json_encode($post);

?>
