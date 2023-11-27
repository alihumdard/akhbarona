<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//descktop dashboard ... 
Route::get("", ['as' => "homepage", 'uses' => 'HomeController@desktop']);
// detail articals 
Route::get("/{slug}/{id}.html", ["as" => "article.detail", "uses" => "ArticleController@desktopDetail"])->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+");
Route::get("/{parent}/{slug}/{id}.html", ["as" => "article.detail.parent", "uses" => "ArticleController@desktopLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+");


Route::post("/article/vote", ['as' => "article.vote", 'uses' => 'ArticleController@vote']);
// mobile view and details...
route::group(["prefix" => "/mobile"], function () {
    Route::get("/feed/index.{type}", ["as" => "mobile.indexFeed", "uses" => "HomeController@mobileFeed"])->where('type', "rss|atom");
    Route::post("/comments", ['as' => "mobile.comment", 'uses' => 'ArticleController@desktopComment']);
    Route::post("/search.html", ["as" => "mobile.frontend.postSearch", "uses" => "CategoryController@postSearch"]);
    Route::get("/index.html", ["as" => "mobile.frontend.search", "uses" => "CategoryController@mobileSearch"]);
    Route::get("/contact/", ["as" => "mobile.frontend.contact", "uses" => "HomeController@mobileContact"]);
    Route::get('/', ['as' => "mobile.homepage", 'uses' => 'HomeController@mobile']);
    Route::get("/{slug}/{id}.html", ["as" => "mobile.article.detail", "uses" => "ArticleController@mobile"])->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+");
    Route::get("/{parent}/{slug}/{id}.html", ["as" => "mobile.article.detail.parent", "uses" => "ArticleController@mobileLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+");

    Route::get("/feed/{slug}/{id}.{type}", ["as" => "mobile.article.detail.rss", "uses" => "ArticleController@mobileFeed"])->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+")->where('type', "rss|atom");
    Route::get("/feed/{parent}/{slug}/{id}.{type}", ["as" => "mobile.article.detail.rss_parent", "uses" => "ArticleController@mobileFeed2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+")->where('type', "rss|atom");

    Route::get("/feed/{slug}/index.{page}.{type}", ["as" => "mobile.frontend.categoryFeed.index", "uses" => "CategoryController@mobileFeed"])->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+")->where('type', "rss|atom");
    Route::get("/feed/{parent}/{slug}/index.{page}.{type}", ["as" => "mobile.frontend.categoryFeed.level2", "uses" => "CategoryController@mobileFeed2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+")->where('type', "rss|atom");

    Route::get("/{slug}/index.{page}.html", ["as" => "mobile.frontend.category.index", "uses" => "CategoryController@mobileIndex"])->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9+]");
    Route::get("/{parent}/{slug}/index.{page}.html", ["as" => "mobile.frontend.category.level2", "uses" => "CategoryController@mobileLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+");
    Route::get("/{slug}", ["as" => "mobile.frontend.category.shortIndex", "uses" => "CategoryController@mobileIndex"])->where("slug", "[a-zA-Z\-0-9]+");
    Route::get("/{parent}/{slug}", ["as" => "mobile.frontend.category.sportIndex", "uses" => "CategoryController@mobileLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+");
    Route::any("/{slug}.html", ["as" => "mobile.frontend.contact", "uses" => "HomeController@mobilePage"])->where("slug", "[a-zA-Z\-0-9]+");
});
Route::get("/index.html", ["as" => "frontend.desktop.search", "uses" => "CategoryController@desktopSearch"]);

Route::post("/search.html", ["as" => "frontend.search", "uses" => "CategoryController@postSearch"]);

Route::any("/contact/", ["as" => "frontend.contact", "uses" => "HomeController@contact"]);
Route::get("/files.php", ['as' => "frontend.file", 'uses' => 'FileController@file']);
Route::get("/thumbnail.php", ['as' => "frontend.file", 'uses' => 'FileController@thumbnail']);

Route::get("/feed/{slug}/{id}.{type}", ["as" => "article.detail.rss", "uses" => "ArticleController@feed"])->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+")->where('type', "rss|atom");
Route::get("/feed/{parent}/{slug}/{id}.{type}", ["as" => "article.detail.rss_parent", "uses" => "ArticleController@feed2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("id", "[0-9]+")->where('type', "rss|atom");


Route::get("/feed/{slug}/index.{page}.{type}", ["as" => "frontend.categoryFeed.index", "uses" => "CategoryController@feed"])->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+")->where('type', "rss|atom");
Route::get("/feed/{parent}/{slug}/index.{page}.{type}", ["as" => "frontend.categoryFeed.level2", "uses" => "CategoryController@feed2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+")->where('type', "rss|atom");

Route::get("/{slug}/index.{page}.html", ["as" => "frontend.category.index", "uses" => "CategoryController@desktopIndex"])->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+");
Route::get("/{parent}/{slug}/index.{page}.html", ["as" => "frontend.category.level2", "uses" => "CategoryController@desktopLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+")->where("page", "[0-9]+");
Route::get("/{slug}", ["as" => "frontend.category.shortIndex", "uses" => "CategoryController@desktopIndex"])->where("slug", "[a-zA-Z\-0-9]+");
Route::get("/{parent}/{slug}", ["as" => "frontend.category.sportIndex", "uses" => "CategoryController@desktopLevel2"])->where("parent", "[a-zA-Z\-0-9]+")->where("slug", "[a-zA-Z\-0-9]+");
Route::get("/{slug}.html", ["as" => "frontend.page", "uses" => "HomeController@page"])->where("slug", "[a-zA-Z\-0-9]+");
Route::get("/attached-file/{pathFile}", ['as' => "attacheFile", 'uses' => 'ArticleController@attachFile']);
Route::post("/comments", ['as' => "desktop.comment", 'uses' => 'ArticleController@desktopComment']);
Route::get("/sitemap.xml", ["as" => "siteMap", "uses" => "HomeController@siteMap"]);
Route::get("/feed/index.{type}", ["as" => "indexFeed", "uses" => "HomeController@feed"])->where('type', "rss|atom");
