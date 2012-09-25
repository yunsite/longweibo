<?php
/**
 * 路由分发器
 * User: zhangxy
 * Date: 12-9-25
 * Time: 上午11:28
 */

class Dispatcher{

    static $_instance;

    private $_model = '';

    private $_method = '';

    private $_params;

    private $rotingTable = array();

    private $_path = null;

    /*
     * 单例模式
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new DisPatcher();
            return self::$_instance;
        }else{
            return self::$_instance;
        }
    }
    /*
     * 构造方法
     */
    private function __construct(){
        $this->_path = $this->setPath();
        $this->rotingTable = Option::getRoutingTAble();
        foreach($this->rotingTable as $route){
            $reg = $route['reg'];

            if(preg_match($reg, $this->_path, $matches)){
                $this->_model = $route['model'];
                $this->_method = $route['method'];
                $this->_params = $matches;
            }
        }

        if(empty($this->_model)){
            longMsg('404', LONGWEIBO_ROOT);
        }

    }

    /*
     * 准备好url和路由层的匹配后开始分发
     */
    public function dispatch(){
        $module = new $this->_model;
        $method = $this->_method;
        $module->$method($this->_params);
    }

    /*
     * 设置路径
     */
    public static function setPath(){
        $path = '';
        if(isset($_SERVER['REQUEST_URI'])){
            $path = $_SERVER['REQUEST_URI'];
        }else{
            if(isset($_SERVER['argv'])){
                $path = $_SERVER['PHP_SELF'] . '?' .$_SERVER['argv'][0];
            }else{
                $path = $_SERVER['PHP_SELF'] .'?' .$_SERVER['QUERY_STRING'];
            }
        }
        $parsepath = parse_url($path);
        return $parsepath['query'];
    }


}
