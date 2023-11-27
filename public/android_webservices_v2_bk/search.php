<?php
	require_once 'SQLServices.php';
    require_once 'file-cache/Cache.php';
    $keyCache       = 'search';
    $value          = Cache::get($keyCache);
    if(!$value) {
        $sqlObj = new SQLServices();
        mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
        //$categoryId		=	$_GET['categoryId'];
        //$query 			=	"select * from articles where title like 'بوعيدة تتباحث مع وزير شؤون خارجية لاتفيا حول سبل النهوض بالعلاقات الثنائية'";
        //$query				=	"SELECT DISTINCT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%' or art.category_id=32) and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id  order by art.id desc limit 0,10";
        $query = "select art.id,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat from articles art,categories cat where (art.id IN (SELECT DISTINCT art.id FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id) or art.category_id=32) and cat.id=art.category_id  group by art.id order by art.created  desc limit 0,50";
        //IN
        $result = $sqlObj->executequery($query);
        $articles = array();
        if ($sqlObj->getRowCount($result) > 0) {
            while ($arr = $sqlObj->getAssoc($result)) {
                $filePath = "https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                $arr['image'] = $filePath . "files/" . $arr['image'];
                if ($arr['parent_cat'] == 7) {
                    $arr['link_url'] = $filePath . "sport/" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                } else {
                    $arr['link_url'] = $filePath . "" . $arr['sefriendly'] . "/" . $arr['id'] . ".html";
                }

                $queryComment = "select count(*) as total_comment from comments where article_id=" . $arr['id'] . " and status='1'";
                $commentResult = $sqlObj->executequery($queryComment);
                if ($sqlObj->getRowCount($commentResult) > 0) {
                    $arrComment = $sqlObj->getAssoc($commentResult);
                    $arr['comments'] = $arrComment['total_comment'];
                } else {
                    $arr['comments'] = "0";
                }

                $articles[] = $arr;
            }
        }
        $post['articles'] = $articles;
        Cache::set($keyCache,$post,1800);
        $sqlObj->closeConnection();
    } else {
        $post = $value;
    }
	header('Content-type: application/json');
	echo json_encode($post);
?>
