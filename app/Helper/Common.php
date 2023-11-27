<?php
namespace App\Helper;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
class Common {
    protected static $agent;
    protected static $isMobile = false;
    public static function convertSize($size) {
        if($size >= 1073741824) {
            return round($size/1073741824,2).'GB';
        } else if($size >= 1048576) {
            return round($size/1048576,2).'MB';
        } else if($size >= 1024) {
            return round($size/1024,2).'KB';
        }
        return $size.'Byte';
    }

    public static function subWords($text,$length=null) {
        if($length === null) {
            return $text;
        }
        $text = strip_tags(html_entity_decode($text));
        if ($length < 1) {
            $length = 25;
        }

        return implode(' ', array_slice(explode(' ', trim($text)), 0, $length));
    }
    public static function menus() {
        $keyCache = 'menu_categories';
        $categories = Cache::get($keyCache);
        if(!$categories) {
            $categories = Category::where("view_subcat",1)->where("parent_cat",0)->orderBy('order_num','ASC')->get();
            Cache::forever($keyCache,$categories);
        }
        //dd($categories);
        return $categories;
    }
    static function delCacheMenu() {
        Cache::forget('menu_categories');
    }
    public static function link($name,$params=null) {
        $mobile = '';
        if(self::isRedirectMobile()) {
            $mobile = 'mobile.';
        }
        if($params == null) {
            return route($mobile.$name);
        }
        return route($mobile.$name,$params);
    }
    public static function isRedirectMobile() {
        if(self::$isMobile == true) {
            return true;
        }
        if (!self::$isMobile) {
            $currentRouter = \Route::currentRouteName();
            if(strpos($currentRouter,'mobile') !== false) {
                self::$isMobile = true;
                return true;
            }
        }
        if(!self::$agent) {
            $agent = new Agent();
            self::$agent = $agent;
        } else {
            $agent = self::$agent;
        }
        if($agent->isMobile() || $agent->isTablet()) {
            $isDesktop = \Request::get('is_desktop');
            $key = 'is_desktop';
            if($isDesktop === null) {
                $isDesktop = isset($_COOKIE[$key])?$_COOKIE[$key]:null;
            } else {
                setcookie($key,$isDesktop);
            }
            //dd($isDesktop);
            if($isDesktop != 1) {
                return true;
            }
        }
        return false;
    }
    public static function isMobile() {
        if(!self::$agent) {
            $agent = new Agent();
            self::$agent = $agent;
        } else {
            $agent = self::$agent;
        }
        if($agent->isMobile() || $agent->isTablet()) {
            return true;
        }
        return false;
    }
    public static function redirectMobile() {
        if(self::isRedirectMobile()) {
            return Config::get("app.url").'mobile'.\Request::getRequestUri();
        }
        return "";
    }
    public static function mobileLink() {
        $link = Config::get("app.url");
        if(self::isRedirectMobile()) {
            $link = $link."mobile/";
        }
        return $link;
    }
    static function pretty_date($datetime, $format = false) {

        $format and list($format, $datetime) = array($datetime, $format);	// swap
        $time = strtotime($datetime);
        $seconds = time() - $time;
        if ($seconds < 0 || floor($seconds / 86400) > 0) {
            $setting = \App\Models\Config::getAllValue();
            return Carbon::createFromFormat("Y-m-d H:i:s",$datetime,$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])->format("d/m/Y H:i:s");
        }
        return Config::get("site.lang.LNG_PRETTY_DATE_PREFIX") . self::_pretty_date_format($seconds) . Config::get("site.lang.LNG_PRETTY_DATE_SUFFIX");
    }
    protected static function _pretty_date_format($seconds) {
        $formats = array(
            array( 60,                  Config::get("site.lang.LNG_PRETTY_DATE_FEW_MOMENTS")),
            array( 120,                 Config::get("site.lang.LNG_PRETTY_DATE_1_MINUTE")),
            array( 3600,  array( 60,    Config::get("site.lang.LNG_PRETTY_DATE_MINUTES"))),
            array( 7200,                Config::get("site.lang.LNG_PRETTY_DATE_1_HOUR")),
            array( 86400, array( 3600,  Config::get("site.lang.LNG_PRETTY_DATE_HOURS")))
        );

        for ($i = 0, $len = count($formats); $i < $len; $i++) {
            $format = $formats[$i];
            if ($seconds < $format[0]) {
                if (is_array($format[1])) {
                    $formatted = floor($seconds / $format[1][0]) . ' ' . $format[1][1];
                    $seconds = $seconds % $format[1][0];
                    if ($seconds > 60) {
                        $formatted .= ' ' . self::_pretty_date_format($seconds);
                    }
                } else {
                    $formatted = $format[1];
                }
                return $formatted;
            }
        }

        return Config::set("site.lang.LNG_PRETTY_DATE_VERY_LONG_TIME");
    }
    static function bad_words_filter($input_words,$configBadWords) {
        preg_match_all('/[^\"\.,\s;<>\\\{\}\]\[\(\)]+/m', strtolower($configBadWords), $bad_words_array);
        foreach ($bad_words_array[0] as $bw) {
            $bw = preg_quote($bw, '/');
            $pattern = "/(?:\b)".$bw."(?:\b)/i";
            $replacement = str_repeat("*", strlen($bw));
            $input_words = preg_replace($pattern, $replacement, $input_words);
        }
        return $input_words;
    }
    static function bad_ip_filter() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $setting = \App\Models\Config::getAllValue();
        preg_match_all('/[^\",\s;<>\\\{\}\]\[\(\)]+/m', $setting["VIVVO_COMMENTS_IP_FITER"], $bad_ip_array);

        foreach ($bad_ip_array[0] as $bad_ip) {

            $bad_ip = str_replace('?','\d',$bad_ip);
            $bad_ip = str_replace('.','\.',$bad_ip);
            $bad_ip = str_replace('*','[^\.]',$bad_ip);
            $pattern = "/".$bad_ip."/";

            if (preg_match($pattern, $ip)) {
                return true;
            }
        }
        return false;
    }
    static function getVoteAvg($article,$dec=0) {
        if (intval($article->vote_num) > 0){
            return number_format(intval($article->vote_sum) / intval($article->vote_num), $dec);
        }
        return 0;
    }
    static function article_link($article,$isConvertMobile = false) {
        $categoryRepo = new \App\Repositories\Category\EloquentCategory();
        $category = $categoryRepo->getById($article->category_id);
        $url = $category->sefriendly;
        if($category->parent_cat > 0) {
            $parentCat = $categoryRepo->getById($category->parent_cat);
            $url = $parentCat->sefriendly.'/'.$url;
        }
        $url .= '/'.$article->id.'.html';
        if(self::isRedirectMobile()) {
            if($isConvertMobile == false) {
                $url = 'mobile/'.$url;
            }
        } else {
            if($isConvertMobile == true) {
                $url = 'mobile/'.$url;
            }
        }
        $categoryRepo = null;
        $category = null;
        return Config::get("app.url").$url;
    }
    static function article_rss($article) {
        $categoryRepo = new \App\Repositories\Category\EloquentCategory();
        $category = $categoryRepo->getById($article->category_id);
        $url = $category->sefriendly;
        if($category->parent_cat > 0) {
            $parentCat = $categoryRepo->getById($category->parent_cat);
            $url = $parentCat->sefriendly.'/'.$url;
        }
        $url = 'feed/'.$url.'/'.$article->id.'.rss';
        if(self::isRedirectMobile()) {
            $url = 'mobile/'.$url;
        }
        $categoryRepo = null;
        $category = null;
        return Config::get("app.url").$url;
    }
    static function cat_link($article,$ext='html',$categoryId=0) {
        $categoryRepo = new \App\Repositories\Category\EloquentCategory();
        if($categoryId == 0) {
            $category = $categoryRepo->getById($article->category_id);
        } else {
            $category = $categoryRepo->getById($categoryId);
        }
        $url = $category->sefriendly;
        if($category->parent_cat > 0) {
            $parentCat = $categoryRepo->getById($category->parent_cat);
            $url = $parentCat->sefriendly.'/'.$url;
        }
        if($ext == 'rss' || $ext == 'atom') {
            $url = 'feed/'.$url;
        }
        if(self::isRedirectMobile()) {
            $url = 'mobile/'.$url;
        }
        $categoryRepo = null;
        $category = null;
        return Config::get("app.url").$url.'/index.1.'.$ext;
    }
    static function secureSql($value) {
        $value = str_replace(
            array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'),
            array('&', '"', "'", '<', '>'),
            $value
        );

        if (get_magic_quotes_gpc()) {
            $value = stripslashes( $value );
        }

        if (function_exists('mysql_real_escape_string')) {
            $value = mysql_real_escape_string($value);
        } else {
            $value = addslashes($value);
        }
        return $value;
    }
    static function viewCounter($id) {
        $memCacheTime = 3600;
        if(!self::$agent) {
            $agent = new Agent();
            self::$agent = $agent;
        } else {
            $agent = self::$agent;
        }
        if($agent->isRobot()) {
            return;
        }
        $memcache_obj = @\memcache_connect('127.0.0.1', 11211);
        $isMemcache = true;
        $key = 'bangtd_cache_counter';
        if(!$memcache_obj) {
            $isMemcache = false;
            $arrCounter = Cache::get($key);
        } else {
            $arrCounter = memcache_get($memcache_obj,$key);
        }

        /*var_dump($memcache_obj);
        dd($arrCounter);*/
        if(!isset($arrCounter['time'])) {
            // process old last read
            $dateCheck = date("Y-m-d");
            $sql = "UPDATE ".DB::getTablePrefix()."articles SET today_read=0 WHERE last_read IS NOT NULL AND today_read > 0 AND last_read < '".$dateCheck."'";
            DB::statement($sql);
            $arrCounter = array('time'=>time(),$id=>array('time'=>time(),'last_read'=>time(),'counter'=>1));
            if($isMemcache) {
                memcache_set($memcache_obj, $key, $arrCounter, 0, $memCacheTime);
            } else {
                Cache::put($key,$arrCounter,now()->addMinutes(60));
            }

        } else {
            if(isset($arrCounter[$id])) {
                $arrCounter[$id]['counter'] += 1;
                $arrCounter[$id]['last_read'] = time();
            } else {
                $arrCounter[$id] = array('time'=>time(),'counter'=>1,'last_read'=>time());
            }
            $dateCache = date('Y-m-d',$arrCounter['time']);
            $today = date('Y-m-d');
            // reset counter cache
            if($dateCache != $today) {
                // set memcache
                $resetArrCounter = array('time'=>time(),array());
                if($isMemcache) {
                    memcache_set($memcache_obj, $key, $resetArrCounter, 0, $memCacheTime);
                } else {
                    Cache::put($key,$arrCounter,now()->addMinutes(60));
                }
                Article::where("today_read",">",0)->update(["today_read"=>0]);
                // update times_read,last_read
                self::updateCounter($arrCounter,false);
                $arrCounter = $resetArrCounter;
            } else {
                $arrCounter = self::updateCounter($arrCounter,true);
                // set memcache
                if($isMemcache) {
                    memcache_set($memcache_obj, $key, $arrCounter, 0, $memCacheTime);
                } else {
                    Cache::put($key,$arrCounter,now()->addMinutes(60));
                }
            }
        }

        return $arrCounter;
    }
    static function updateCounter($arrCounter,$isToday = true) {
        if(count($arrCounter) > 0) {
            if($isToday === true) {
                $timeCompare = 90; // 15 minutes
                $currentTime = time();
                foreach ($arrCounter as $id=>$arr) {
                    if($id != 'time') {
                        $timeCheck = $currentTime - $arr['time'];
                        $counter = $arr['counter'];
                        if($timeCheck >= $timeCompare ) {
                            $sql = "UPDATE ".DB::getTablePrefix()."articles SET times_read=times_read+".$counter;
                            $last_read = date('Y-m-d H:i:s',$arr['last_read']);
                            $sql .= ",today_read=today_read+".$counter.",last_read='".$last_read."'";
                            unset($arrCounter[$id]);
                            $sql .= ' WHERE id='.$id;
                            DB::statement($sql);
                        }
                    }
                }
            } else {
                $newArr = array();
                foreach ($arrCounter as $id=>$arr) {
                    if($id != 'time') {
                        $counter = $arr['counter'];
                        if (isset($newArr[$counter])) {
                            $newArr[$counter] .= ',' . $id;
                        } else {
                            $newArr[$counter] = $id;
                        }
                    }
                }
                if($newArr) {
                    foreach ($newArr as $counter => $listId) {
                        $sql = "UPDATE ".DB::getTablePrefix()."articles SET times_read=times_read+".$counter;
                        $sql .= ' WHERE id IN ('.$listId.')';
                        DB::statement($sql);
                    }
                }
            }
        }
        return $arrCounter;
    }
    static function format_date_atom($date){
        $setting = \App\Models\Config::getAllValue();
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
        }
        return date('Y-m-d\TH:i:s', strtotime($date)) . substr(date('O',strtotime($date)),0,3) . ':' . substr(date('O',strtotime($date)),3,2);
    }
    static function format_date($in_date = '', $format = false, $no_localization = null){
        $setting = \App\Models\Config::getAllValue();
        $localize = true;
        if ($no_localization) {
            $localize = false;
            $format = $no_localization;
        }
        if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $in_date)){
            try {
                $dateTime = new DateTime($in_date);
            } catch (Exception $e) {
                $dateTime = false;
            }
            $_format = $format;
        }elseif (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $format)){
            try {
                $dateTime = new DateTime($format);
            } catch (Exception $e) {
                $dateTime = false;
            }
            $dateTime = new DateTime($format);
            $_format = $in_date;
        }elseif (is_numeric($format)){
            try {
                $dateTime = new DateTime("@$format");
            } catch (Exception $e) {
                $dateTime = false;
            }
        }

        if ($dateTime){
            try {
                $dateTimeZone = new DateTimeZone(VIVVO_GENERAL_TIME_ZONE_FORMAT);
            } catch (Exception $e) {
                $dateTimeZone = false;
            }

            if ($dateTimeZone){
                $dateTime->setTimezone($dateTimeZone);
            }

            if ($dateTime){
                if ($_format === true){
                    $date = $localize ? localized_date('Y-m-d H:i:s', $dateTime) : $dateTime->format('Y-m-d H:i:s');
                }elseif ($_format !== false){
                    $date = $localize ? localized_date($_format, $dateTime) : $dateTime->format($_format);
                }else{
                    $date = $localize ? localized_date(VIVVO_DATE_FORMAT, $dateTime) : $dateTime->format(VIVVO_DATE_FORMAT);
                }
            }
            return $date;
        }
        return '';
    }
}
