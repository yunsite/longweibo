<?php

/*
 * 前台入口文件
 */

//载入初始化文件
//require_once 'init.php';


require_once 'init.php';

define('TEMPLATE_PATH', TPLS_URL);

$longDispatcher = Dispatcher::getInstance();

$longDispatcher->dispatch();

View::output();
