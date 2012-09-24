<?php

/*
 * 前台入口文件
 */

//载入初始化文件
//require_once 'init.php';

//print_r($_SERVER);

//从URL中获取主机名称
preg_match('@^(?:http://)?([^/]+)@i',
    "http://www.php.net/index.html", $matches);
$host = $matches[1];


//获取主机名称的后面两部分
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
echo "domain name is: {$matches[0]}\n";
