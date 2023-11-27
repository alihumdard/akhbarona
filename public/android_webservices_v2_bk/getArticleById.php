<?php
	require_once 'SQLServices.php';
    require_once 'file-cache/Cache.php';
	$articleId		=	$_GET['articleId'];
    if(!$articleId) {
        return '';
    }
    $keyCache = 'ID-'.$articleId;
    $valueC = Cache::get($keyCache);
    if(!$valueC) {
        $sqlObj = new SQLServices();
        mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
        $query = "select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id=" . $articleId . " and cat.id=art.category_id";
        $result = $sqlObj->executequery($query);
        $output = array();
        if ($sqlObj->getRowCount($result) > 0) {
            while ($arr = $sqlObj->getAssoc($result)) {
                $filePath = "https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                $arr['image'] = $filePath . "files/" . $arr['image'];
                if ($arr['parent_cat'] == 7) {
                    $arr['link_url'] = $filePath . "sport/" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                } else {
                    $arr['link_url'] = $filePath . "" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                }

                $queryComment = "select count(*) as total_comment from comments where article_id=" . $arr['id'] . " and status= '1'";
                $commentResult = $sqlObj->executequery($queryComment);
                if ($sqlObj->getRowCount($commentResult) > 0) {
                    $arrComment = $sqlObj->getAssoc($commentResult);
                    $arr['comments'] = $arrComment['total_comment'];
                } else {
                    $arr['comments'] = "0";
                }

                $output[] = $arr;
            }
        }
        $post['data'] = $output;
        Cache::set($keyCache,$post);
        $sqlObj->closeConnection();
    } else {
        $post = $valueC;
    }
	header('Content-type: application/json');
	echo json_encode($post);
?>
