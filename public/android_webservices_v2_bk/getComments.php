<?php
	require_once 'SQLServices.php';
    require_once 'file-cache/Cache.php';
	$articleId		=	$_GET['articleId'];
    if(!$articleId) {
        return '';
    }
    $keyCache       = 'getComments-'.$articleId;
    $value          = Cache::get($keyCache);
    if(!$value) {
        $sqlObj = new SQLServices();
        mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
        $query = "select * from comments where article_id=" . $articleId . " and status='1'";
        //$query 			=	"select * from articles where category_id=".$categoryId." and created like '%2015-01-30%' order by created desc limit 0,10";
        $result = $sqlObj->executequery($query);
        $output = array();
        if ($sqlObj->getRowCount($result) > 0) {
            while ($arr = $sqlObj->getAssoc($result)) {
                $output[] = $arr;
            }
        }
        $post['data'] = $output;
        Cache::set($keyCache,$post,1200);
        $sqlObj->closeConnection();
    } else {
        $post = $value;
    }
	header('Content-type: application/json');
	echo json_encode($post);
?>
