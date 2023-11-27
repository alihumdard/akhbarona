<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Common;
use App\Helper\CustomCache;
use App\Http\Controllers\Controller;
use App\Models\ArticleIAttachment;
use App\Models\ArticleImage;
use App\Models\Comment;
use App\Models\Config as CustomConfig;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\EloquentArticle;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\File\EloquentFile;
use App\Repositories\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ArticleController extends Controller
{
    protected $fileRepo, $articleRepo, $categoryRepo;
    function _init()
    {
        $this->categoryRepo = new EloquentCategory();
        $this->articleRepo = new EloquentArticle();
        $this->fileRepo = new EloquentFile();
    }
    function desktopLevel2(Request $request, $parent, $slug, $id)
    {
        $mobileUrl = Common::redirectMobile();
        if ($mobileUrl) {
            return redirect($mobileUrl);
        }
        return $this->desktopRender($request, $parent, $slug, $id);
    }
    function desktopDetail(Request $request, $slug, $id)
    {
        $mobileUrl = Common::redirectMobile();
        if ($mobileUrl) {
            return redirect($mobileUrl);
        }
        return $this->desktopRender($request, "", $slug, $id);
    }
    protected function desktopRender($request, $parent, $slug, $id)
    {
        $keyCache = 'desktop_detail_html' . $id . rand();
        $cache    = new CustomCache();
        $content  = false; //$cache->get($keyCache);
        if ($content) {
            Common::viewCounter($id);
            //return $content;
        }
        $this->_init();
        $article = $this->articleRepo->getById($id, true);
        if (!$article || !in_array($slug, [$article->slug, 'article', 'permalink'])) {
            abort(404);
        }
        $category = $this->categoryRepo->getById($article->category_id);
        if ($category->parent_cat) {
            $parentCat = $this->categoryRepo->getById($category->parent_cat);
            if ($parentCat->sefriendly != $parent && !in_array($slug, [$article->slug, 'article', 'permalink'])) {
                abort(404);
            }
        }
        Common::viewCounter($id);
        $template = "default";
        if ($article->article_template) {
            $template = str_replace(".tpl", "", $article->article_template);
        }
        $setting = CustomConfig::getAllValue();
        $tickers = $this->articleRepo->getList(["order_field" => "id", "order_by" => "DESC", "limit" => 30]);
        $arrTicker = [];
        if ($tickers) {
            foreach ($tickers as $ticker) {
                $arrTicker[$ticker->category_id][] = $ticker;
            }
        }
        $fileRepo = $this->fileRepo;
        //dd($article);
        $metaImage = $this->fileRepo->getImage($article->image, true, $article->md5_file);
        $keywords = $article->keywords;
        if (!$keywords) {
            $title = explode(' ', $article->title);
            $title = implode(',', $title);
            $keywords = $article->category_name . ',' . $article->title . ',' . $title;
        }
        $perPage = (isset($setting["VIVVO_COMMENTS_NUM_PER_PAGE"]) ? $setting["VIVVO_COMMENTS_NUM_PER_PAGE"] : 80);
        $comments = $this->articleRepo->getComments($article->id, 1, $perPage);
        $totalPage = 0;
        if ($comments["total"]) {
            $totalPage = ceil($comments["total"] / $perPage);
        }
        $commentPages = ['currentPage' => 1, "perPage" => $perPage, "numPage" => $totalPage, "articleId" => $article->id];
        $categories = $this->categoryRepo->getAll();
        $breadcrumbs = $this->articleRepo->getBreadcrumb($article, $categories);
        $galleries = ArticleImage::where("article_id", $article->id)->orderBy("order_number", "DESC")->get();
        $attachments = ArticleIAttachment::where("article_id", $article->id)->orderBy("order_number", "DESC")->get();
        $user = Auth::guard('admin')->user();
        $isAdmin = false;
        if ($user && $user->hasPermission(['comment.manage'])) {
            $isAdmin = true;
        }
        $popularBox = $this->articleRepo->getList(["order_field" => "today_read", "order_by" => "DESC",/*"not_id"=>$article->id,*/ "limit" => 6]);
        $categoryRelated = $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "order_by" => "DESC", "category_id" => $article->category_id, "limit" => 5]);
        switch ($template) {
            case "default_sport":
                $latestNewsArtSw = $this->articleRepo->getList(["order_field" => "order_num", "order_by" => "DESC", "limit" => 5, "category_id" => [2, 10, 12, 16, 18]]);
                $newsSportL01 = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 57, "limit" => 10]);
                $newsSportL02 = $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "order_by" => "DESC", "category_id" => 56, "limit" => 3]);
                $content = view("frontend.desktop.article." . $template, compact("setting", "article", "arrTicker", "fileRepo", "metaImage", "keywords", "latestNewsArtSw", "breadcrumbs", "galleries", "attachments", "comments", "commentPages", "isAdmin", "newsSportL01", "newsSportL02", "popularBox", "categoryRelated"))->render();
                break;
            case "two_column_video":
                //$relatedNews = $this->articleRepo->getRelated($article->id);
                $newsL1 = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 32, "limit" => 12]);
                $content = view("frontend.desktop.article." . $template, compact("setting", "article", "arrTicker", "fileRepo", "metaImage", "keywords", "breadcrumbs", "galleries", "attachments", "comments", "commentPages", "isAdmin", "popularBox", "categoryRelated", "newsL1"))->render();
                break;
            case "two_column_video_sport":
                $newsSportL01 = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 57, "limit" => 10]);
                $newsSportL02 = $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "order_by" => "DESC", "category_id" => 56, "limit" => 3]);
                $content = view("frontend.desktop.article." . $template, compact("setting", "article", "arrTicker", "fileRepo", "metaImage", "keywords", "breadcrumbs", "galleries", "attachments", "comments", "commentPages", "isAdmin", "newsSportL01", "newsSportL02"))->render();
                //dd($content);
                break;
            case "writers":
                $relatedNews = $this->articleRepo->getRelated($article->id);
                $latestNewsArtSw = $this->articleRepo->getList(["order_field" => "order_num", "order_by" => "DESC", "limit" => 5, "category_id" => [2, 10, 12, 16, 18]]);
                $newL1A = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 32, "limit" => 8]);
                $content = view("frontend.desktop.article." . $template, compact("setting", "article", "arrTicker", "fileRepo", "metaImage", "keywords", "breadcrumbs", "galleries", "attachments", "comments", "commentPages", "isAdmin", "categoryRelated", "newL1A", "latestNewsArtSw", "popularBox", "relatedNews"))->render();
                break;
                /*case "image_gallery":
                $content = view("frontend.desktop.article.".$template,compact("setting","article","arrTicker","fileRepo","metaImage","keywords","breadcrumbs","galleries","attachments","comments","commentPages","isAdmin"))->render();
                break;*/
            default:
                $latestNewsArtSw = $this->articleRepo->getList(["order_field" => "order_num", "order_by" => "DESC", "limit" => 5, "category_id" => [2, 10, 12, 16, 18]]);
                $newL1A = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 32, "limit" => 8]);
                $newL2A = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_MODULES_TICKER_ORDER"]) ? $setting["VIVVO_MODULES_TICKER_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 17, "limit" => 3]);
                $relatedNews = $this->articleRepo->getRelated($article->id);
                $content = view("frontend.desktop.article." . $template, compact("setting", "article", "arrTicker", "fileRepo", "metaImage", "keywords", "latestNewsArtSw", "galleries", "attachments", "newL1A", "popularBox", "newL2A", "categoryRelated", "relatedNews", "breadcrumbs", "comments", "commentPages", "isAdmin"))->render();
                break;
        }
        // $cache->set($keyCache,$content);
        return $content;
    }
    function mobile(Request $request, $slug, $id)
    {
        return $this->mobileRender($request, '', $slug, $id);
    }
    function mobileLevel2(Request $request, $parent, $slug, $id)
    {
        return $this->mobileRender($request, $parent, $slug, $id);
    }
    protected function mobileRender($request, $parent, $slug, $id)
    {
        $keyCache = 'mobile_detail_html' . $id;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if ($content) {
            Common::viewCounter($id);
            return $content;
        }
        $this->_init();
        $article = $this->articleRepo->getById($id, true);
        if (!$article || !in_array($slug, [$article->slug, 'article', 'permalink'])) {
            abort(404);
        }
        $category = $this->categoryRepo->getById($article->category_id);
        if ($category->parent_cat) {
            $parentCat = $this->categoryRepo->getById($category->parent_cat);
            if ($parentCat->sefriendly != $parent && !in_array($slug, [$article->slug, 'article', 'permalink'])) {
                abort(404);
            }
            $category->sefriendly = $parentCat->sefriendly . '/' . $category->sefriendly;
        }
        $template = "default";
        if ($article->article_template) {
            $template = str_replace(".tpl", "", $article->article_template);
        }
        $fileRepo = $this->fileRepo;
        $setting = CustomConfig::getAllValue();
        $metaImage = $this->fileRepo->getImage($article->image, true, $article->md5_file);
        $relatedNews = $this->articleRepo->getRelated($article->id);
        $articleTags = $this->articleRepo->getListFromTags(["order_field" => "order_num", "order_by" => "DESC", "tags" => [1, 2], "group_id" => 1, "limit" => 14]);
        $popularBox = $this->articleRepo->getList(["order_field" => "today_read", "order_by" => "DESC", "limit" => 7]);
        $keywords = $article->keywords;
        if (!$keywords) {
            $title = explode(' ', $article->title);
            $title = implode(',', $title);
            $keywords = $article->category_name . ',' . $article->title . ',' . $title;
        }
        $isAdmin = false;
        $user = Auth::user();
        if ($user && $user->hasPermission(['comment.manage'])) {
            $isAdmin = true;
        }
        $perPage = 20;
        $comments = $this->articleRepo->getComments($article->id, 1, $perPage);
        $totalPage = 0;
        if ($comments["total"]) {
            $totalPage = ceil($comments["total"] / $perPage);
        }
        $articleCats = null;
        $videos = $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "order_by" => "DESC", "category_id" => 32, "limit" => 11]);
        //dd($template);
        $commentPages = ['currentPage' => 1, "perPage" => $perPage, "numPage" => $totalPage, "articleId" => $article->id];
        switch ($template) {
            case "default_sport":
                $content = view("frontend.mobile.article." . $template, compact('article', 'metaImage', 'fileRepo', 'setting', 'category', 'relatedNews', 'articleTags', 'popularBox', 'articleCats', 'keywords', 'comments', 'commentPages', 'isAdmin', 'videos'))->render();
                break;
            case "two_column_video":
                $content = view("frontend.mobile.article." . $template, compact('article', 'metaImage', 'fileRepo', 'setting', 'category', 'relatedNews', 'articleTags', 'popularBox', 'articleCats', 'keywords', 'comments', 'commentPages', 'isAdmin', 'videos'))->render();
                break;
            case "two_column_video_sport":
                $content = view("frontend.mobile.article." . $template, compact('article', 'metaImage', 'fileRepo', 'setting', 'category', 'relatedNews', 'articleTags', 'popularBox', 'articleCats', 'keywords', 'comments', 'commentPages', 'isAdmin', 'videos'))->render();
                //dd($content);
                break;
            case "writers":
                $content = view("frontend.mobile.article." . $template, compact('article', 'metaImage', 'fileRepo', 'setting', 'category', 'relatedNews', 'articleTags', 'popularBox', 'articleCats', 'keywords', 'comments', 'commentPages', 'isAdmin', 'videos'))->render();
                break;
            default:
                $content = view("frontend.mobile.article." . $template, compact('article', 'metaImage', 'fileRepo', 'setting', 'category', 'relatedNews', 'articleTags', 'popularBox', 'articleCats', 'keywords', 'comments', 'commentPages', 'isAdmin', 'videos'))->render();
                break;
        }
        $cache->set($keyCache, $content);
        Common::viewCounter($id);
        return $content;
    }
    function attachFile($pathFile)
    {
        $pathFile = base64_decode($pathFile);
        $fileConfig = Config::get("site.files");
        $realPath = public_path($fileConfig);
        if (file_exists($realPath . '/' . $pathFile)) {
            return response()->file($realPath . '/' . $pathFile);
        }
        abort(404);
    }
    function desktopComment(Request $request)
    {
        if (!$request->ajax()) {
            return "No Ajax!";
        }
        $this->_init();
        switch ($request->cmd) {
            case "proxy":
                $user = Auth::guard('admin')->user();
                $isAdmin = false;
                if ($user && $user->hasPermission(['comment.manage'])) {
                    $isAdmin = true;
                }
                $setting = CustomConfig::getAllValue();
                if ($request->article_id) {
                    $setting = CustomConfig::getAllValue();
                    $fileRepo = $this->fileRepo;
                    $perPage = (isset($setting["VIVVO_COMMENTS_NUM_PER_PAGE"]) ? $setting["VIVVO_COMMENTS_NUM_PER_PAGE"] : 80);
                    $currentTheme = 'desktop';
                    if (Common::isRedirectMobile()) {
                        $currentTheme = 'mobile';
                        $perPage = 20;
                    }

                    $comments = $this->articleRepo->getComments($request->article_id, $request->pg, $perPage);
                    $totalPage = 0;
                    if ($comments["total"]) {
                        $totalPage = ceil($comments["total"] / $perPage);
                    }
                    if ($request->pg > $totalPage) {
                        $request->pg = $totalPage;
                    }
                    if ($request->pg < 1) {
                        $request->pg = 1;
                    }
                    //echo $currentTheme;dd($totalPage);
                    $commentPages = ['currentPage' => $request->pg, "perPage" => $perPage, "numPage" => $totalPage, "articleId" => $request->article_id];
                    return view("frontend." . $currentTheme . ".box.list_comment", compact("commentPages", "comments", "fileRepo", "isAdmin", "setting"))->render();
                }
                break;
            case "vote":
                $vote = $this->articleRepo->voteComment($request->id, $request->vote);
                //return $vote;
                if (is_numeric($vote)) {
                    return $vote;
                }
                $class = "error";
                $message = "أنت فعلاً قمت بالتصويت على هذا التعليق.";
                return view("frontend.desktop.box.dump", compact("class", "message"))->render();
                break;
            case "reportInappropriateContent":
                $report = $this->articleRepo->reportComment($request->id);
                if ($report === true) {
                    $class = "info";
                    $message = Config::get("site.lang.LNG_INFO_COMMENT_REPORTING_SUCCESS");
                } else {
                    $class = "error";
                    $message = Config::get("site.lang.LNG_" . $report);
                }
                return view("frontend.desktop.box.dump", compact("class", "message"))->render();
                break;
            case "add":
                $comment = $this->articleRepo->addComment($request->all());
                //return $comment;
                $isError = 0;
                $style = 'style="margin:15px;"';
                if (is_object($comment)) {
                    $class = "info";
                    $parentClass = 'success_message';
                    $message = Config::get("site.lang.LNG_INFO_COMMENT_ADD_SUCCESS");
                } else {
                    $parentClass = 'error_message';
                    $class = "error";
                    $message = Config::get("site.lang.LNG_" . $comment);
                    $isError = 1;
                }
                $content = view("frontend.desktop.box.dump", compact("class", "message", "style", "parentClass"))->render();
                return response()->json(['isError' => $isError, 'content' => $content]);
                break;
        }
    }
    function vote(Request $request)
    {
        if (!$request->ajax()) {
            return "No Ajax!";
        }
        $this->_init();
        if ($request->cmd == 'vote') {
            $article = $this->articleRepo->vote($request->ARTICLE_id, $request->ARTICLE_vote);
            if (is_object($article) && $article->id) {
                $fileRepo = $this->fileRepo;
                $setting = CustomConfig::getAllValue();
                return view("frontend.desktop.box.article_vote", compact("article", "fileRepo", "setting"));
            } else {
                $class = "error";
                $message = Config::get("site.lang.LNG_" . $article);
                return view("frontend.desktop.box.dump", compact("class", "message", "style"))->render();
            }
        }
    }
    function feed2(Request $request, $parent, $slug, $id, $type)
    {
        return $this->feedRender($parent, $slug, $id, $type);
    }
    function feed(Request $request, $slug, $id, $type)
    {
        return $this->feedRender("", $slug, $id, $type);
    }
    function mobileFeed2(Request $request, $parent, $slug, $id, $type)
    {
        return $this->feedRender($parent, $slug, $id, $type, "mobile");
    }
    function mobileFeed(Request $request, $slug, $id, $type)
    {
        return $this->feedRender("", $slug, $id, $type, "mobile");
    }
    protected function feedRender($parent, $slug, $id, $type, $mobile = "")
    {
        $keyCache = $type . '_feedDetail' . $id . $mobile;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        $articles = [];
        if (!$content) {
            $this->_init();
            $article = $this->articleRepo->getById($id, true);
            if (!$article || !in_array($slug, [$article->slug, 'article', 'permalink'])) {
                abort(404);
            }
            $category = $this->categoryRepo->getById($article->category_id);
            if ($category->parent_cat) {
                $parentCat = $this->categoryRepo->getById($category->parent_cat);
                if ($parentCat->sefriendly != $parent && !in_array($slug, [$article->slug, 'article', 'permalink'])) {
                    abort(404);
                }
            }
            $setting = CustomConfig::getAllValue();
            $fileRepo = $this->fileRepo;
            $articles[] = $article;
            $content = view("frontend.feed_" . $type, compact("articles", "fileRepo", "setting"))->render();
            Cache::put($keyCache, $content, now()->addMinutes(15));
        }
        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
