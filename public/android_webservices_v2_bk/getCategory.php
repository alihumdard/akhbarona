<?php
	$IOS_VERSION = '1.6';
	$ANDROID_VERSION = '1.9';
	$YOUTUBE_KEY = 'AIzaSyDbGaeCX3E2NqikXixgDOse86IVKbjrBfw';
	require_once 'SQLServices.php';
    require_once 'file-cache/Cache.php';
	$sqlObj			=	new SQLServices();
	mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');

	//print_r($_POST);

	//die;

	if (isset($_POST['gcm_id']) && isset($_POST['deviceId'])){
		$gcm_regid		=	$_POST['gcm_id'];
		$deviceId		=	$_POST['deviceId'];
		if ( (strlen(trim($gcm_regid))!=0) && ($_POST['deviceId']!='') ){
			$querySelect	=	"SELECT * from gcm_users WHERE device_id = '$deviceId'";
			$resultSelect	=	$sqlObj->executequery($querySelect);
			if ($sqlObj->getRowCount($resultSelect) == 0){
				$queryInsert	=	"INSERT INTO gcm_users(gcm_regid,device_id, created_at) VALUES('$gcm_regid','$deviceId', NOW())";
				$sqlObj->executequery($queryInsert);
			}else{
				$queryInsert	=	"update gcm_users set gcm_regid='".$gcm_regid."' where device_id='".$deviceId."'";
				$sqlObj->executequery($queryInsert);
			}
		}
	}

	if (isset($_POST['firebase_token'])){
		$iphoneId		=	$_POST['firebase_token'];
		if (strlen(trim($iphoneId))!=0){
			$iphoneUdid		=	$_POST['iphone_udId'];
			$querySelect	=	"SELECT * from iphone_users WHERE iphone_udid = '$iphoneUdid' or iphone_regid='$iphoneId'";
			$resultSelect	=	$sqlObj->executequery($querySelect);
			if ($sqlObj->getRowCount($resultSelect) == 0){
				$queryInsert	=	"INSERT INTO iphone_users(iphone_udid,iphone_regid,created_at) VALUES('$iphoneUdid','$iphoneId', NOW())";
				$sqlObj->executequery($queryInsert);
			}else{
				$arr			=	$sqlObj->getAssoc($resultSelect);

				$queryInsert	=	"update iphone_users set iphone_regid='$iphoneId' where iphone_udid='".$arr['iphone_udid']."'";
				$sqlObj->executequery($queryInsert);
			}
		}
	}
	$keyCache       = 'admob_status';
	$admodValue     = Cache::get($keyCache);
	if(!$admodValue) {
        $query			=	"select * from admob_status";
        $result			=	$sqlObj->executequery($query);
        $arrAdmob		=	$sqlObj->getAssoc($result);
        //print_r($arrAdmob);die;
        Cache::set($keyCache,$arrAdmob,86400);
    } else {
	    $arrAdmob       = $admodValue;
    }
	$post['admob_status']	=	$arrAdmob;


	$post['iphone_version'] = $IOS_VERSION;
	$post['android_version'] = $ANDROID_VERSION;
	$post['youtube_key'] = $YOUTUBE_KEY;

	/*$query 			=	"select * from categories";
	$result			=	$sqlObj->executequery($query);
	$output			=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$output[]	=	$arr;
		}
	}
	$post['category']	=	$output;*/

	$limitStart		=	$_POST['limit_start'];
	$limitEnd		=	$_POST['limit_end'];
	$keyCache       = 'getCategory-240320_1-'.$limitStart.'-'.$limitEnd;
    $catValue       = null;
	if($limitStart < 600) {
	    $catValue   = Cache::get($keyCache);
    }
    if(!$catValue) {
        //or t.name Like '%Headline%'
        //$query 			=	"SELECT DISTINCT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id  group by art.id  order by art.id desc limit ".$limitStart." , ".$limitEnd."";
        //$query			=	"select art.*,cat.category_name,cat.sefriendly,cat.parent_cat from articles art,categories cat where art.id IN (SELECT DISTINCT art.id FROM `tags` t,articles_tags at ,articles art,categories cat WHERE (t.name Like '%Homepage%') and at.tag_id=t.id and at.article_id=art.id and cat.id=art.category_id and art.status=1  group by art.id)  or art.category_id=32  group by art.id order by art.created  desc limit ".$limitStart." , ".$limitEnd."";
        /*$query				=	"select art.*,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat
                                from articles art,categories cat
                                where (art.id IN (SELECT
                                            DISTINCT art.id
                                            FROM `tags` t,articles_tags at ,articles art,categories cat
                                            WHERE (t.name Like '%Homepage%')
                                            and at.tag_id=t.id
                                            and at.article_id=art.id
                                            and cat.id=art.category_id
                                            and art.status=1  group by art.id) or art.category_id=32)
                                            and cat.id=art.category_id  group by art.id order by art.created  desc limit ".$limitStart." , ".$limitEnd."";*/
        $query              = "SELECT art.*,cat.category_name,cat.id as catid,cat.sefriendly,cat.parent_cat
                                FROM articles as art INNER JOIN categories as cat ON art.category_id = cat.id
                                INNER JOIN articles_tags as at ON at.article_id = art.id
                                WHERE art.status=1
                                AND (art.category_id=32 OR at.tag_id=1)
                                group by art.id order by art.created  desc limit ".$limitStart." , ".$limitEnd;

        $result			=	$sqlObj->executequery($query);
        $articles		=	array();
        if ($sqlObj->getRowCount($result) > 0){
            while ($arr	=	$sqlObj->getAssoc($result)) {
                $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                $arr['image']		=	$filePath."files/".$arr['image'];
                if ($arr['parent_cat']==7){
                    $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                }else{
                    $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                }

                $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
                $commentResult	=	$sqlObj->executequery($queryComment);
                if ($sqlObj->getRowCount($commentResult) > 0){
                    $arrComment		=	$sqlObj->getAssoc($commentResult);
                    $arr['comments']	=	$arrComment['total_comment'];
                }else{
                    $arr['comments']	=	"0";
                }

                $articles[]	=	$arr;
            }
        }
        $post['articles']	=	$articles;

        $query 			=	"SELECT art.*,cat.category_name,cat.sefriendly,cat.parent_cat FROM articles art,categories cat WHERE art.category_id = 40 and art.status=1 and cat.id=art.category_id ORDER BY art.created DESC LIMIT 0 , 5 ";
        $result			=	$sqlObj->executequery($query);
        $latestNews		=	array();
        if ($sqlObj->getRowCount($result) > 0){
            while ($arr	=	$sqlObj->getAssoc($result)) {
                $filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
                $arr['image']		=	$filePath."files/".$arr['image'];
                if ($arr['parent_cat']==7){
                    $arr['link_url']	=	$filePath."sport/".$arr['sefriendly']."/".$arr['id'].".html";
                }else{
                    $arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";
                }

                $queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status='1'";
                $commentResult	=	$sqlObj->executequery($queryComment);
                if ($sqlObj->getRowCount($commentResult) > 0){
                    $arrComment		=	$sqlObj->getAssoc($commentResult);
                    $arr['comments']	=	$arrComment['total_comment'];
                }else{
                    $arr['comments']	=	"0";
                }

                $latestNews[]	=	$arr;
            }
        }
        $post['latest_news']	=	$latestNews;
        if($limitStart < 600) {
            Cache::set($keyCache,$post,1800);
        }
        $sqlObj->closeConnection();
    } else {
	    $post = $catValue;
    }

	header('Content-type: application/json');
	echo json_encode($post);


?>
