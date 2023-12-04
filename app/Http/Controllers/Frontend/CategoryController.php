<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Common;
use App\Helper\CustomCache;
use App\Http\Controllers\Controller;
use App\Models\Config as CustomConfig;
use App\Repositories\Article\EloquentArticle;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\File\EloquentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    protected $categoryRepo,$articleRepo,$fileRepo;
    function _init() {
        $this->categoryRepo = new EloquentCategory();
        $this->articleRepo = new EloquentArticle();
        $this->fileRepo = new EloquentFile();
    }
    function desktopLevel2(Request $request,$parent, $slug,$page=1) {
        $mobileUrl = Common::redirectMobile();
        if($mobileUrl) {
            return redirect($mobileUrl);
        }
        return $this->desktopRender($request,$parent,$slug,$page);
    }

    //inner pages of categories render
    function desktopIndex(Request $request, $slug,$page=1) {
        $mobileUrl = Common::redirectMobile();
        if($mobileUrl) {
            return redirect($mobileUrl);
        }
        return $this->desktopRender($request,"",$slug,$page);
    }
    //inner pages of categories detail
    protected function desktopRender($request,$parent,$slug,$page) {
        if($page > 20) {
            $page = 20;
        }
        $keyCache = 'desktop_category_'.$parent.$slug."_".$page;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
		$perPage = 15;
        $this->_init();
        $category = $this->categoryRepo->getBySlug($slug);
        if(!$category) {
            abort(404);
        }
        if($category->parent_cat > 0) {
            $parentCat = $this->categoryRepo->getById($category->parent_cat);
            if(!$parentCat || $parentCat->sefriendly != $parent) {
                abort(404);
            }
        }
        $fileRepo = $this->fileRepo;
        $cdnUrl = Config::get("app.cdn_url");
        $template = "default";
        if($category->template) {
            $template = str_replace(".tpl","",$category->template);
        }
        $setting = CustomConfig::getAllValue();
        $tickers = $this->articleRepo->getList(["order_field"=>"id","order_by"=>"DESC","limit"=>30]);
        $arrTicker = [];
        if($tickers) {
            foreach ($tickers as $ticker) {
                $arrTicker[$ticker->category_id][] = $ticker;
            }
        }
        $sportHeadlines = null;
        $defaultPage = $request->page;
        if($parent) {
            if($defaultPage) {
                $canonical = route("frontend.category.level2",[$parent,$category->sefriendly,$defaultPage]);
                $alternate = route("mobile.frontend.category.level2",[$parent,$category->sefriendly,$defaultPage]);
            } else {
                $canonical = route("frontend.category.sportIndex",[$parent,$category->sefriendly]);
                $alternate = route("mobile.frontend.category.sportIndex",[$parent,$category->sefriendly]);
            }
        } else {
            if($defaultPage) {
                // menu's categories ...
                $canonical = route("frontend.category.index",[$category->sefriendly,$defaultPage]);
                $alternate = route("mobile.frontend.category.index",[$category->sefriendly,$defaultPage]);
            } else {
                $canonical = route("frontend.category.shortIndex",[$category->sefriendly]);
                $alternate = route("mobile.frontend.category.shortIndex",[$category->sefriendly]);
            }
        }
        switch ($template) {
            case "default_sport":
                $sportHeadlines = $this->articleRepo->getListFromTags(["order_field"=>"order_num","order_by"=>"DESC","tags"=>[110,113],"group_id"=>1,"limit"=>6]);
                $arrHeadlineId = [];
                if($sportHeadlines) {
                    foreach ($sportHeadlines as $sport) {
                        $arrHeadlineId[] = $sport->id;
                    }
                }
                $columnCenterSport = [
                    "setting"=>$setting,
                    "fileRepo"=>$fileRepo,
                    "slug" => $category->sefriendly,
                    "newsSportR01" => $this->articleRepo->getListFromTags(["order_field"=>"order_num","not_id"=>$arrHeadlineId,"order_by"=>"DESC","tags"=>113,"group_id"=>1,"limit"=>6]),
                    "newsSportR02" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>41,"limit"=>4]),
                    "newsSportR03" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>50,"limit"=>4]),
                    "newsSportR04" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>51,"limit"=>4]),
                    "newsSportR05" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>52,"limit"=>4]),
                    "newsSportR06" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>53,"limit"=>4]),
                    "newsSportR07" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>54,"limit"=>4]),
                    "newsSportR08" => $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>55,"limit"=>4]),
                ];
                $columnLeftSport = [
                    "setting"=>$setting,
                    "fileRepo"=>$fileRepo,
                    "newsSportL01" => $this->articleRepo->getList(["order_field"=>(isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"])?$setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]:"order_num"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>57,"limit"=>10]),
                    "newsSportL02" => $this->articleRepo->getList(["order_field"=>Config::get("app.default_order"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>56,"limit"=>3]),
                ];

                $content = view("frontend.desktop.category.".$template,compact('category','setting','sportHeadlines','fileRepo','perPage','cdnUrl','arrTicker','columnCenterSport','columnLeftSport','canonical','parent','alternate'))->render();
                unset($sportHeadlines);unset($columnCenterSport);unset($columnLeftSport);
                break;
            default:
                // dd($canonical);
                $arrData = $this->articleRepo->getListByCat($category->id,$page,$perPage);
                $popularBox = $this->articleRepo->getList(["order_field"=>"today_read","order_by"=>"DESC","limit"=>6]);
                $latestNewsSw = $this->articleRepo->getList(["order_field"=>"order_num","order_by"=>"DESC","limit"=>5,"category_id"=>[2,10,12,16,18]]);
                $numberPage = ceil($arrData["total"]/$perPage);
                if($numberPage == 0) {
                    $numberPage = 1;
                }
                if($page > $numberPage) {
                    return redirect(route("frontend.category.index",[$category->sefriendly,$numberPage]));
                }
                $content = view("frontend.desktop.category.".$template,compact('category','setting','arrData','page','fileRepo','perPage','cdnUrl','arrTicker','popularBox','latestNewsSw','canonical','parent','alternate'))->render();
                unset($arrData);unset($popularBox);unset($latestNewsSw);
                break;
        }
        if($page < 20) {
            $cache->set($keyCache,$content);
        }
        unset($fileRepo);unset($tickers);unset($arrTicker);unset($this->articleRepo);unset($this->fileRepo);
        return $content;

    }
    function desktopSearch(Request $request) {
        $data = $request->all();
        if(isset($data["page"]) && $data["page"] > 10) {
            $data["page"] = 10;
        }
        $security = $this->checkSecurity($data);
        if($security === false || (!$request->search_query && !$request->search_cid)) {
            abort(404);
        }
        $this->_init();
        $arrData = $this->articleRepo->search($data);
        $setting = CustomConfig::getAllValue();
        $cache = new CustomCache();
        // cache ticker
        $keyTicker = 'search_tickers';
        $arrTicker = $cache->get($keyTicker);
        if(!$arrTicker) {
            $tickers = $this->articleRepo->getList(["order_field"=>"id","order_by"=>"DESC","limit"=>30]);
            $arrTicker = [];
            if($tickers) {
                foreach ($tickers as $ticker) {
                    $arrTicker[$ticker->category_id][] = $ticker;
                }
            }
            $cache->set($keyTicker,$arrTicker);
        }
        $cdnUrl = Config::get("app.cdn_url");
        $perPage = 10;
        $page = isset($data['page'])?$data['page']:1;
        $numberPage = ceil($arrData["total"]/$perPage);
        if($page < 1) {
            $page = 1;
        }
        if($page > $numberPage && $numberPage > 0) {
            $page = $numberPage;
        }
        $data["page"] = $page;
        $categories = $this->categoryRepo->getAll();
        $fileRepo = $this->fileRepo;
        $keyPopular = 'search_popular';
        $arrCache = $cache->get($keyPopular);
        if($arrCache) {
            $popularBox = $arrCache['popular'];
            $latestNewsSw = $arrCache['latest'];
        } else {
            $popularBox = $this->articleRepo->getList(["order_field"=>"today_read","order_by"=>"DESC","limit"=>6]);
            $latestNewsSw = $this->articleRepo->getList(["order_field"=>"order_num","order_by"=>"DESC","limit"=>5,"category_id"=>[2,10,12,16,18]]);
            $cache->set($keyPopular,['popular'=>$popularBox,'latest'=>$latestNewsSw]);
        }
        return view("frontend.desktop.search_results.default",compact("arrData","arrTicker","setting","fileRepo","popularBox","latestNewsSw","cdnUrl","page","perPage","data","categories"));

    }
    function mobileSearch(Request $request) {
        $data = $request->all();
        if(isset($data["page"]) && $data["page"] > 10) {
            $data["page"] = 10;
        }
        //dd($data);
        $security = $this->checkSecurity($data);
        if($security === false || (!$request->search_query && !$request->search_cid)) {
            abort(404);
        }
        $this->_init();
        $arrData = $this->articleRepo->search($data);
        $setting = CustomConfig::getAllValue();
        $cdnUrl = Config::get("app.cdn_url");
        $perPage = 10;
        $page = isset($data['page'])?$data['page']:1;
        $numberPage = ceil($arrData["total"]/$perPage);
        if($page < 1) {
            $page = 1;
        }
        if($page > $numberPage && $numberPage > 0) {
            $page = $numberPage;
        }
        $data["page"] = $page;
        $fileRepo = $this->fileRepo;
        return view("frontend.mobile.search_results.default",compact("arrData","setting","fileRepo","cdnUrl","page","perPage","data"));
    }
    protected function checkSecurity($data) {
        if(!isset($data["time"]) || !isset($data["token"])) {
            return false;
        }
        $time = time();
        $token = md5(Config::get("auth.private_key").$data["time"]);
        $searchLimit = isset($_COOKIE['search_limit'])?json_decode($_COOKIE['search_limit'],true):[];

        if($time > ($data["time"] + 1200) || $token != $data["token"] || !isset($searchLimit['token']) || $searchLimit['token'] != $token) {
            return false;
        }
        //dd($searchLimit);
        if((isset($searchLimit['minute']) && $searchLimit['minute'] > 6) || (isset($searchLimit['hour']) && $searchLimit['hour'] > 20)) {
            return false;
        }
        if(isset($searchLimit['time_m'])) {
            if($searchLimit['time_m'] < (time()-300)) {
                $searchLimit['minute'] = 1;
                $searchLimit['time_m'] = time();
            } else {
                $searchLimit['minute'] += 1;
            }
            if($searchLimit['time_h'] < (time()-3600)) {
                $searchLimit['hour'] = 1;
                $searchLimit['time_h'] = time();
            } else {
                $searchLimit['hour'] += 1;
            }
        } else {
            $searchLimit = ['time_m'=>time(),'time_h'=>time(),'minute'=>1,'hour'=>1];
        }
        setcookie('search_limit',json_encode($searchLimit),time()+86400,"/");
        return true;
    }
    function postSearch(Request $request) {
        if(!$request->ajax()) {
            return "error";
        }
        $time = time();
        $token = md5(Config::get("auth.private_key").$time);
        $data = $request->all();
        $data["time"] = $time;
        $data["token"] = $token;
        $searchLimit = isset($_COOKIE['search_limit'])?json_decode($_COOKIE['search_limit'],true):[];
        $searchLimit['token'] = $token;
        setcookie('search_limit',json_encode($searchLimit),time()+86400,"/");
        $mobileUrl = Common::redirectMobile();
        if($mobileUrl) {
            return route("mobile.frontend.search",$data);
        }
        return route("frontend.desktop.search",$data);
    }
    function mobileIndex(Request $request, $slug,$page=1) {
        return $this->mobileRender($request,"",$slug,$page);
    }
    function mobileLevel2(Request $request,$parent, $slug,$page=1) {
        return $this->mobileRender($request,$parent,$slug,$page);
    }
    function mobileRender($request,$parent,$slug,$page) {
        if($page > 20) {
            $page = 20;
        }
        $keyCache = 'mobile_category_'.$parent.$slug."_".$page;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
        $this->_init();
        $category = $this->categoryRepo->getBySlug($slug);
        if(!$category) {
            abort(404);
        }
        if($category->parent_cat > 0) {
            $parentCat = $this->categoryRepo->getById($category->parent_cat);
            if(!$parentCat || $parentCat->sefriendly != $parent) {
                abort(404);
            }
        }
        $fileRepo = $this->fileRepo;
        $cdnUrl = Config::get("app.cdn_url");
        $setting = CustomConfig::getAllValue();
        $defaultPage = $request->page;
        if($parent) {
            if($defaultPage) {
                $canonical = route("frontend.category.level2",[$parent,$category->sefriendly,$defaultPage]);
            } else {
                $canonical = route("frontend.category.sportIndex",[$parent,$category->sefriendly]);
            }
        } else {
            if($defaultPage) {
                $canonical = route("frontend.category.index",[$category->sefriendly,$defaultPage]);
            } else {
                $canonical = route("frontend.category.shortIndex",[$category->sefriendly]);
            }
        }
        $perPage = 12;
        $popularBox = $this->articleRepo->getList(["order_field"=>"today_read","order_by"=>"DESC","limit"=>5]);
        if($category->id != 7) {
            $arrData = $this->articleRepo->getListByCat($category->id,$page,$perPage);
            $numberPage = ceil($arrData["total"]/$perPage);
            if($numberPage == 0) {
                $numberPage = 1;
            }
            if($page > $numberPage) {
                return redirect(route("mobile.frontend.category.index",[$category->sefriendly,$numberPage]));
            }
            $content = view("frontend.mobile.category.default",compact("fileRepo","cdnUrl","setting","category","page","canonical","arrData","perPage","popularBox","parent"))->render();
        } else {
            $arrData = $this->articleRepo->getListByCat([41,50,51,52,53,54,55],$page,$perPage,[110,113]);
            $numberPage = ceil($arrData["total"]/$perPage);
            if($numberPage == 0) {
                $numberPage = 1;
            }
            if($page > $numberPage) {
                return redirect(route("mobile.frontend.category.index",[$category->sefriendly,$numberPage]));
            }
            $cate57 = $this->articleRepo->getList(["order_field"=>(isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"])?$setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]:"order_num"),"not_tag"=>"110,113","order_by"=>"DESC","category_id"=>57,"limit"=>10]);
            $content = view("frontend.mobile.category.default",compact("fileRepo","cdnUrl","setting","category","page","canonical","arrData","perPage","popularBox","parent","cate57"))->render();
        }
        if($page < 20) {
            $cache->set($keyCache,$content);
        }
        return $content;
    }
    function feed2($parent, $slug,$page=1,$type) {
        return $this->renderFeed($parent,$slug,$page,$type);
    }
    function feed($slug,$page=1,$type) {
        return $this->renderFeed("",$slug,$page,$type);
    }
    function mobileFeed2($parent, $slug,$page=1,$type) {
        return $this->renderFeed($parent,$slug,$page,$type,'mobile');
    }
    function mobileFeed($slug,$page=1,$type) {
        return $this->renderFeed("",$slug,$page,$type,'mobile');
    }
    protected function renderFeed($parent, $slug,$page=1,$type,$mobile="") {
        $articles = [];
        $keyCache = $type.'_category_'.$parent.'_'.$slug."_".$page.$mobile;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        $setting = CustomConfig::getAllValue();
        $fileRepo = $this->fileRepo;
        if(!$content) {
            $this->_init();
            $category = $this->categoryRepo->getBySlug($slug);
            if(!$category) {
                abort(404);
            }
            if($category->parent_cat > 0) {
                $parentCat = $this->categoryRepo->getById($category->parent_cat);
                if(!$parentCat || $parentCat->sefriendly != $parent) {
                    abort(404);
                }
            }
            if($page == 1) {
                $keyData = "category_data_rss_".$category->id;
                $articles = Cache::get($keyData);
                if(!$articles) {
                    $perPage = 15;
                    $arrData = $this->articleRepo->getListByCat(($category->id == 7?[7,41,50,51,52,53,54,55]:$category->id),$page,$perPage);
                    if($arrData['data']) {
                        $articles = $arrData['data'];
                        Cache::set($keyData,$articles,now()->addMinutes(5));
                    }
                }
            }
            $fileRepo = $this->fileRepo;
            $content = view("frontend.feed_".$type,compact("setting","fileRepo","articles"))->render();
            if($page == 1) {
                Cache::put($keyCache,$content,now()->addMinutes(15));
            }
        }
        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
