<?php
phpinfo();die;
$memcache_obj = memcache_connect('127.0.0.1', 11211);
$arrCounter = memcache_get($memcache_obj,"bangtd_cache_counter");
var_dump($arrCounter);
