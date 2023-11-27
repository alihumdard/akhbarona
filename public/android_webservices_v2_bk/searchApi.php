<?php
	$post['data']	=	array();
	header('Content-type: application/json');
	echo json_encode($post);
	exit();
	require_once 'SQLServices.php';
	$sqlObj			=	new SQLServices();
	mysqli_query($sqlObj->connection,'SET CHARACTER SET utf8');
	$searchWord		=	$_GET['search_word'];
	$limitStart		=	$_GET['limit_start'];
	$limitEnd		=	$_GET['limit_end'];

	$query 			=	"select DISTINCT art.*,cat.category_name,cat.sefriendly from articles art,categories cat where ( art.title like '%".$searchWord."%' or art.body like '%".$searchWord."%' or art.sefriendly like '%".$searchWord."%' or art.description like '%".$searchWord."%')  and cat.id=art.category_id group by art.id limit ".$limitStart." , ".$limitEnd."";
	//echo $query;
	$result			=	$sqlObj->executequery($query);
	$output			=	array();
	if ($sqlObj->getRowCount($result) > 0){
		while ($arr	=	$sqlObj->getAssoc($result)) {
			$filePath			=	"https://www." . $_SERVER['SERVER_NAME'] . dirname(dirname($_SERVER['REQUEST_URI']));
			$arr['image']		=	$filePath."files/".$arr['image'];
			$arr['link_url']	=	$filePath."".$arr['sefriendly']."/".$arr['id'].".html";

			$queryComment	=	"select count(*) as total_comment from comments where article_id=".$arr['id']." and status= '1'";
			$commentResult	=	$sqlObj->executequery($queryComment);
			if ($sqlObj->getRowCount($commentResult) > 0){
				$arrComment		=	$sqlObj->getAssoc($commentResult);
				$arr['comments']	=	$arrComment['total_comment'];
			}else{
				$arr['comments']	=	"0";
			}

			$output[]	=	$arr;
		}
	}
	$post['data']	=	$output;
	$sqlObj->closeConnection();
	header('Content-type: application/json');
	echo json_encode($post);

?>
