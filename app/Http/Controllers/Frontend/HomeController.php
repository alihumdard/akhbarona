<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Common;
use App\Helper\CustomCache;
use App\Http\Controllers\Controller;
use App\Models\Config as CustomConfig;
use App\Models\Page;
use App\Repositories\Article\EloquentArticle;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\File\EloquentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;



class HomeController extends Controller
{
    protected $categoryRepo,$articleRepo,$fileRepo;
    function _init() {
        $this->categoryRepo = new EloquentCategory();
        $this->articleRepo = new EloquentArticle();
        $this->fileRepo = new EloquentFile();
    }
    function desktop(Request $request) {
        $mobileUrl = Common::redirectMobile();
        if($mobileUrl) {
            return redirect($mobileUrl);
        }

        $keyCache = 'desktop_homepage';
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
        $this->_init();
        $cdnUrl = Config::get("app.cdn_url");
        $categories = $this->categoryRepo->getAll();
        $fileRepo = $this->fileRepo;
        $latestNewsBhSw = $this->articleRepo->getList(["order_field"=>"order_num","not_tag"=>"1,2","order_by"=>"DESC","category_id"=>40,"limit"=>8]); //آخر الأخبار
        $fancyHeadlines = $this->articleRepo->getListFromTags(["order_field"=>"order_num","order_by"=>"DESC","tags"=>[1,2],"group_id"=>1,"limit"=>8]); // slider;
        $tickers = $this->articleRepo->getList(["order_field"=>"id","order_by"=>"DESC","limit"=>30]);
        $arrTicker = [];
        if($tickers) {
            foreach ($tickers as $ticker) {
                $arrTicker[$ticker->category_id][] = $ticker;
            }
        }
        $arrFancyId = [];
        if($fancyHeadlines) {
            foreach ($fancyHeadlines as $fancyHeadline) {
                $arrFancyId[] = $fancyHeadline->id;
            }
        }
        $columnCenter = [
            "fileRepo" => $fileRepo,
            "newsR00" => $this->articleRepo->getListFromTags(["order_field" => "order_num", "order_by" => "DESC", "tags" => 2, "not_id" => $arrFancyId, "group_id" => 1, "limit" => 8]), // أهم الأخبار portion...
            "newsR01n" => $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 16, "limit" => 5]), // أخبار وطنية سياسة portion ...
            "newsR02" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 10, "limit" => 5]), //سياسة protion ...
            "newsR03" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 2, "limit" => 6]), //إقتصاد 
            "newsR04" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 18, "limit" => 5]), //حوادث وقضايا
            "newsR04n" => $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 58, "limit" => 3]), //قضايا المجتمع
            "newsR05" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => [7, 41, 50, 51, 52, 53, 54, 55], "limit" => 5]), //رياضة
            "newsR06" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 12, "limit" => 5]), //دولية
            "newsR07" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 14, "limit" => 5]), //مستجدات التعليم
            "newsR08" =>  $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 5, "limit" => 4]), // deen o dunia
            "newsR09n" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 9, "limit" => 5]), //طب وصحة
            "newsR10n" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 11, "limit" => 5]), // aloomo technalogy
            "newsR11n" => $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 6, "limit" => 3]), //ثقافة وفنون
            "newsR12n" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 13, "limit" => 5]), //الأخيرة
        ];
        $setting = CustomConfig::getAllValue();
        $columnLeft = [
            "fileRepo" => $fileRepo,
            "setting" => $setting,
            "newsL1" => $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]) ? $setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"] : "order_num"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 32, "limit" => 12]), //شاشة أخبارنا
            "newsL2" => $this->articleRepo->getList(["order_field" => (isset($setting["VIVVO_MODULES_TICKER_ORDER"]) ? $setting["VIVVO_MODULES_TICKER_ORDER"] : Config::get("app.default_order")), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 17, "limit" => (isset($setting["VIVVO_MODULES_TICKER_NUMBER"]) ? $setting["VIVVO_MODULES_TICKER_NUMBER"] : 10)]), //أقلام حرة
            "newsL3" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 31, "limit" => 1]), //داءات إنسانية
            "newsL4" => $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 23, "limit" => 3]), //ركن المرأة
            "newsL8" => $this->articleRepo->getListWithBody(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 39, "limit" => 1]), //مباريات ووظائف
            "newsL5" => $this->articleRepo->getList(["order_field" => Config::get("app.default_order"), "not_tag" => "1,2", "order_by" => "DESC", "category_id" => 35, "limit" => 1]), //كاريكاتير وصورة
        ];
        //dd($arrTicker);
        $content = view("frontend.desktop.homepage.default",
            compact("categories","latestNewsBhSw","fancyHeadlines","arrTicker",
            "columnCenter","fileRepo","columnLeft","setting","cdnUrl"))->render();
        $cache->set($keyCache,$content);
        unset($categories);unset($setting);unset($latestNewsBhSw);unset($fancyHeadlines);
        unset($tickers);unset($arrTicker);unset($columnCenter);unset($columnLeft);
        unset($this->articleRepo);unset($this->fileRepo);
        return $content;
    }

    function mobile(Request $request) {
        $keyCache = 'mobile_homepage';
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
        $this->_init();
        $cdnUrl = Config::get("app.cdn_url");
        $setting = CustomConfig::getAllValue();
        $fileRepo = $this->fileRepo;
        $articleTags = $this->articleRepo->getListFromTags(["order_field"=>"order_num","order_by"=>"DESC","tags"=>[1,2],"group_id"=>1,"limit"=>20]);
        $videos = $this->articleRepo->getList(["order_field"=>(isset($setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"])?$setting["VIVVO_HOMEPAGE_ARTICLE_LIST_ORDER"]:"order_num"),"order_by"=>"DESC","category_id"=>32,"limit"=>11]);
        $sports = $this->articleRepo->getList(["order_field"=>Config::get("app.default_order"),"order_by"=>"DESC","category_id"=>[7,41,50,51,52,53,54,55],"limit"=>9]);
        $footerArticle = $this->articleRepo->getListWithBody(["order_field"=>Config::get("app.default_order"),"order_by"=>"DESC","category_id"=>[5,9,11,13],"limit"=>11]);
        $content = view("frontend.mobile.homepage.default",compact("setting","cdnUrl","fileRepo","articleTags","videos","sports","footerArticle"))->render();
        $cache->set($keyCache,$content);
        return $content;
    }
    function page($slug,$isContact=false) {
        $mobileUrl = Common::redirectMobile();
        if($mobileUrl) {
            return redirect($mobileUrl);
        }
        $keyCache = 'desktop_page_'.$slug;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
        $this->_init();
        $page = Page::where("sefriendly",$slug)->first();
        if($page) {
            $cdnUrl = Config::get("app.cdn_url");
            $tickers = $this->articleRepo->getList(["order_field"=>"id","order_by"=>"DESC","limit"=>30]);
            $arrTicker = [];
            if($tickers) {
                foreach ($tickers as $ticker) {
                    $arrTicker[$ticker->category_id][] = $ticker;
                }
            }
            $fileRepo = $this->fileRepo;
            $popularBox = $this->articleRepo->getList(["order_field"=>"today_read","order_by"=>"DESC","limit"=>6]);
            $latestNewsSw = $this->articleRepo->getList(["order_field"=>"order_num","order_by"=>"DESC","limit"=>5,"category_id"=>[2,10,12,16,18]]);
            $setting = CustomConfig::getAllValue();
            $content = view("frontend.desktop.frame.default",compact("cdnUrl","page","fileRepo","popularBox","latestNewsSw","setting","arrTicker","isContact"))->render();
            $cache->set($keyCache,$content);
            unset($popularBox);unset($fileRepo);unset($latestNewsSw);unset($setting);
            unset($tickers);unset($arrTicker);unset($this->articleRepo);unset($this->fileRepo);
            return $content;
        } else {
            abort(404);
        }
    }
    function contact(Request $request) {
        if($request->isMethod('POST')) {
            $form = \DB::table("form_builder_forms")->where("id",1)->first();
            $fields = \DB::table("form_builder_fields")->where("form_id",1)->get();
            $data = $request->all();
            $content = "";
            foreach ($fields as $field) {
                if(isset($data[$field->name]) && $data[$field->name]) {
                    $content .= $field->label.": ".$data[$field->name]."\n";
                }
            }
            $setting = \App\Models\Config::getAllValue();
            $headers = [];
            $headers[] = 'Content-Type: text/plain; charset=UTF-8;';
            $headers[] = 'From: '.$setting["VIVVO_ADMINISTRATORS_EMAIL"];
            if($setting["VIVVO_EMAIL_SMTP_PHP"] == 1) {
                mail($form->email,$form->title,$content,implode("\r\n", $headers));
            } else {
                config([
                    "mail.mailers.smtp.transport" => "smtp",
                    "mail.mailers.smtp.host" => $setting["VIVVO_EMAIL_SMTP_HOST"],
                    "mail.mailers.smtp.port" => $setting["VIVVO_EMAIL_SMTP_PORT"],
                    "mail.mailers.smtp.username" => $setting["VIVVO_EMAIL_SMTP_USERNAME"],
                    "mail.mailers.smtp.encryption" => "tls",
                    "mail.mailers.smtp.password" => $setting["VIVVO_EMAIL_SMTP_PASSWORD"],
                    "mail.mailers.smtp.timeout" => 20,
                    "mail.from.address" => $setting["VIVVO_ADMINISTRATORS_EMAIL"],

                    "mail.host" => $setting["VIVVO_EMAIL_SMTP_HOST"],
                    "mail.port" => $setting["VIVVO_EMAIL_SMTP_PORT"],
                    "mail.username" => $setting["VIVVO_EMAIL_SMTP_USERNAME"],
                    "mail.encryption" => "tls",
                    "mail.password" => $setting["VIVVO_EMAIL_SMTP_PASSWORD"],
                ]);
                $config = Config::get("mail.mailers");
                //dd($config);
                Mail::raw($content,        function($message) use ($form,$setting)
                {
                    //dd($form->email);
                    $message->to($form->email)
                        ->subject($form->title)
                        ->from($setting["VIVVO_ADMINISTRATORS_EMAIL"]);
                });
            }
            unset($data);unset($fields);
            return redirect(route("frontend.contact"))->withSuccess($form->message);
        }
        return $this->page("contact",true);
    }
    function mobilePage($slug) {
        $keyCache = 'mobile_page_'.$slug;
        $cache = new CustomCache();
        $content = $cache->get($keyCache);
        if($content) {
            return $content;
        }
        $this->_init();
        $page = Page::where("sefriendly",$slug)->first();
        if($page) {
            $cdnUrl = Config::get("app.cdn_url");
            $setting = CustomConfig::getAllValue();
            $content = view("frontend.mobile.frame.default",compact("cdnUrl","setting","page"))->render();
            $cache->set($keyCache,$content);
            return $content;
        } else {
            abort(404);
        }
    }
    function mobileContact() {
        abort(404);
    }
    function siteMap() {
        $key = 'siteMap';
        $content = Cache::get($key);
        if(!$content) {
            $this->_init();
            $articles = $this->articleRepo->siteMap();
            $content = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            $content .= view('sitemap',compact('articles'))->render();
            Cache::put($key,$content,now()->addMinutes(10));
        }
        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
    function feed($type) {
        return $this->renderFeed($type,"desktop");
    }
    function mobileFeed($type) {
        return $this->renderFeed($type,"mobile");
    }
    protected function renderFeed($type,$mobile="") {
        /*$key = 'rssIndex12_'.$type.$mobile;
        //dd($key);
        $content = Cache::get($key);
        if(!$content) {

            Cache::put($key,$content,now()->addMinutes(10));
        }*/
        $this->_init();
        $setting = CustomConfig::getAllValue();
        $fileRepo = $this->fileRepo;
        $articles = $this->articleRepo->siteMap();
        $atomLink = Config::get("app.url");
        if($mobile == 'mobile') {
            $atomLink .= 'mobile/';
        }
        $atomLink .= 'feed/index.rss';
        $content = view('frontend.feed_'.$type,compact('articles','setting','fileRepo','atomLink'))->render();
        return response($content, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
