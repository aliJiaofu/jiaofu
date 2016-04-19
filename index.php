<?php

define('APP_DEBUG', true);
header("content-type:text/html;charset=utf-8");
function show_bug($val){
    var_dump($val);
    exit();
}

//http://192.168.235.18
define("SITE_URL","/");
//Home 分为四个模块
//公共的css js img
define('HOME_CSS',SITE_URL."its/Public/Home/css/");
define('HOME_JS',SITE_URL."its/Public/Home/js/");
define('HOME_IMG',SITE_URL."its/Public/Home/img/");
//correct模块
define('CORRECT',SITE_URL."its/Public/Home/correct/");
//index模块
define('INDEX',SITE_URL."its/Public/Home/index/");
//movie模块
define('MOVIE',SITE_URL."its/Public/Home/movie/");
//tone模块
define('TONE',SITE_URL."its/Public/Home/tone/");
define('TEXT',SITE_URL."its/Public/Home/text/");
include "./ThinkPHP/ThinkPHP.php";