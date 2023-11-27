<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    public $timestamps = false;
    protected $table = 'configuration';
    public static function getAllValue() {
        $keyCache = 'all_value_config';
        $arr = Cache::get($keyCache);
        if(!$arr) {
            $arr = Self::where("variable_name","like","%VIVVO_%")->limit(300)->pluck("variable_value","variable_name");
            Cache::forever($keyCache,$arr);
        }
        return $arr;
    }
    public static function delCache() {
        Cache::forget("all_value_config");
    }

}
