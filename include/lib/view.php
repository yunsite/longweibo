<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zhangxy
 * Date: 12-9-25
 * Time: 下午3:50
 */

class View{
    public static function getView($template, $ext = '.php'){
        if(!is_dir(TEMPLATE_PAHT))
            longMsg('模板不存在', LONGWEIBO_ROOT);
        return TEMPLATE_PATH.$template.$ext;
    }
    public static function output(){
        $content = ob_get_clean();
        ob_start();
        echo $content;
        ob_end_flush();
        exit;
    }
}