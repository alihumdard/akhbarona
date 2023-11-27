<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::any("/app_version.php", ["as" => "appVersion", "uses" => "ApiController@appVersion"]);
Route::any("/check_version.php", ["as" => "checkVersion", "uses" => "ApiController@checkVersion"]);
Route::any("/getVersion.php", ["as" => "getVersion", "uses" => "ApiController@getVersion"]);
Route::post("/doPostComment.php", ["as" => "doPostComment", "uses" => "ApiController@doPostComment"]);
Route::get("/getCommentCounts.php", ["as" => "getCommentCounts", "uses" => "ApiController@getCommentCounts"]);
Route::get("/getComments.php", ["as" => "getComments", "uses" => "ApiController@getComments"]);
Route::any("/getArticle.php", ["as" => "getArticle", "uses" => "ApiController@getArticle"]);
Route::get("/searchApi.php", ["as" => "searchApi", "uses" => "ApiController@searchApi"]);
Route::get("/getArticleById.php", ["as" => "getArticleById", "uses" => "ApiController@getArticleById"]);
Route::any("/search.php", ["as" => "search", "uses" => "ApiController@search"]);
Route::any("/getCategory.php", ["as" => "getCategory", "uses" => "ApiController@getCategory"]);
Route::any("/getCategory 6 June.php", ["as" => "getCategory", "uses" => "ApiController@getCategory"]);
Route::any("/getCategory_old.php", ["as" => "getCategory", "uses" => "ApiController@getCategory"]);
