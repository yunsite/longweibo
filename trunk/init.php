<?php
/**
 * 全局加载项.
 * User: zhangxy
 * Date: 12-9-23
 * Time: 下午7:36
 */

error_reporting(7);

ob_start();
header('content-type:text/html; charset=utf-8');

define('LONGWEIBO_ROOT', dirname(__FILE__));

include_once LONGWEIBO_ROOT.'/config.php';
include_once LONGWEIBO_ROOT.'/lib/function.base.php';

doStripslashes();



