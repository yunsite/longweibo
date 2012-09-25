<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zhangxy
 * Date: 12-9-25
 * Time: 下午4:19
 */

/*
 * controller层演示
 */
class index_Controller{
    function index(){
        $index_model = new index_model();
        $write = $index_model->write();
        echo "this" . $write;
    }
}