<?php
namespace App\Repositories\Article;
interface ArticleRepository {
    function getList($params);
    function getListFromTags($params);
    function getListWithBody($params);
    function getListByCat($catId,$currentPage,$perPage=18,$tagList=[]);
    function getById($id,$createSecurity=false);
    function getRelated($id,$limit=5);
    function getBreadcrumb($article,$categories);
    function getComments($articleId,$currentPage,$perPage);
    function voteComment($commentId,$vote);
    function reportComment($commentId);
    function addComment($arrays);
    function vote($id,$vote);
    function isVoted($articleId);
    function search($arrays);
    function siteMap();
}
