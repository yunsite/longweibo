<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zhangxy
 * Date: 12-9-25
 * Time: 下午3:33
 */


class Option{

    /*
    * 加载路由表
    */

    static function getRoutingTable(){
        $routingTable = array(
            array(
                'model' => 'index_Controller',
                'method' => 'index',
                'reg' => '#m=index&a=index(&.*)?#',
            ),
            array(
                'model' => 'other_controller',
                'method'=>'go',
                'reg' => '#m=index&a=go(&.*)?#',
            ),
        );
        return $routingTable;
    }

}