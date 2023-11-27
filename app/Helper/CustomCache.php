<?php
namespace App\Helper;
use App\Models\Config as CustomConfig;
use Illuminate\Support\Facades\Cache;
class CustomCache {
    protected $timeCache = 15;
    function __construct()
    {
        $setting = CustomConfig::getAllValue();
        if(isset($setting['VIVVO_CACHE_TIME'])) {
            $this->timeCache = $setting['VIVVO_CACHE_TIME'];
        }
    }
    function get($key) {
        //return "";
        return Cache::get($key);
    }
    function set($key,$content) {
        Cache::put($key,$content,now()->addSeconds($this->timeCache));
    }
}
