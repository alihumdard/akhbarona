<?php
/**
 * Created by dinhbang19.
 * Date: 3/8/2018
 */
require 'vendor/autoload.php';
class Cache {
    static $pathOption = array('cache_dir'=>'../cache/mobile_app');
    static $obj = null;
    static $isSetPath = false;
    static $isCache = 1;
    static function set($key, $value, $expire=36000) {
        self::setPath();
        if(self::$isCache != 1) {
            return false;
        }
        $obj = self::$obj;
        if(!$obj) {
            $obj = new FileCache(self::$pathOption);
            self::$obj = $obj;
        }
        $obj->save($key, $value,$expire);
    }
    static function get($key) {
        if(self::$isCache != 1) {
            return '';
        }
        self::setPath();
        $obj = self::$obj;
        if(!$obj) {
            $obj = new FileCache(self::$pathOption);
            self::$obj = $obj;
        }
        //var_dump($obj);die;
        return $obj->get($key);
    }
    static private function setPath() {
        if(self::$isSetPath) {
            return true;
        }
        $path = self::$pathOption;
        $year = date('Y');
        $path = $path['cache_dir'].'/'.$year;
        if(!is_dir($path)) {
            mkdir($path,755);
        }
        self::$pathOption = array('cache_dir'=>$path);
        self::$isSetPath = true;
    }
}