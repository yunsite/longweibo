<?php
/**
 * 基础方法类库
 * User: zhangxy
 * Date: 12-9-23
 * Time: 下午8:43
 */
function __autoload($class){
    $class = strtolower($class);
    if(file_exists(LONGWEIBO_ROOT.'/include/model/'.$class.'.php')){
        include_once LONGWEIBO_ROOT.'/include/model'.$class.'.php';
    }elseif(file_exists(LONGWEIBO_ROOT.'/include/lib/'.$class.'.php')){
        include_once LONGWEIBO_ROOT.'/include/lib/'.$class.'.php';
    }elseif(file_exists(LONGWEIBO_ROOT.'/include/controller/'.$class.'.php')){
        include_once LONGWEIBO_ROOT.'/include/controller/'.$class.'.php';
    }else{
        longMsg($class.'加载失败', LONGWEIBO_ROOT);
    }

}


/*
 * 去除多余的转义符
 */
function doStripslashes(){
    if(function_exists(get_magic_quotes_gpc()) && get_magic_quotes_gpc()){
        $_GET = stripslashesDeep($_GET);
        $_POST = stripslashesDeep($_POST);
        $_COOKIE = stripslashesDeep($_COOKIE);
        $_REQUEST = stripslashesDeep($_REQUEST);
    }
}
/*
 * 递归去除转义
 */
function stripslashesDeep($value){
    return is_array($value) ? array_map(stripslashesDeep, $value) : stripslashes($value);
}

/*
 * 直接跳转
 */

function longRedirect($directUrl){
    header("location: $directUrl");
}


/*
 * 获取站点地址
 */

function getLongUrl(){
    $phpself = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
    if(preg_match("/^.*\//", $phpself, $matches)){
        return 'http://'. $_SERVER['HTTP_HOST'] .$matches[0];
    }else{
        return LONG_URL;
    }
}
/*
 *  获取客户端ip
 */

function getIp(){
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    if(!preg_match("/^\d+\.\d+\.\d+\.\d+$/", $ip)){
        $ip = '';
    }
    return $ip;
}

/*
 * 显示错误longMsg
 */
function longMsg($msg, $url='javascript:history.back(-1);', $isAutoGo = false){
    if($msg == '404'){
        header('HTTP/1.1 404 Not Found');
        $msg = '抱歉，你访问的页面不存在!';
    }
    echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
EOT;
    if($isAutoGo === true){
        echo '<meta http-equiv="refresh" content="2;url= '.$url.'"/>';
    }
echo <<<EOT
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>emlog system message</title>
<style type="text/css">
<!--
body {
	background-color:#F7F7F7;
	font-family: Arial;
	font-size: 12px;
	line-height:150%;
}
.main {
	background-color:#FFFFFF;
	font-size: 12px;
	color: #666666;
	width:650px;
	margin:60px auto 0px;
	border-radius: 10px;
	padding:30px 10px;
	list-style:none;
	border:#DFDFDF 1px solid;
}
.main p {
	line-height: 18px;
	margin: 5px 20px;
}
-->
</style>
</head>
<body>
<div class="main">
<p>$msg</p>
<p><a href="$url">&laquo;点击返回</a></p>
</div>
</body>
</html>
EOT;
    exit;

}
