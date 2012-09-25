<?php
/**
 * 数据库操作封装类.
 * User: zhangxy
 * Date: 12-9-25
 * Time: 下午8:21
 */
class Mysql{
    /*
     * 查询次数
     */
    private $queryCount = 0;

    /*
     * 内部数据连接对象
     */
    private $conn;
    /*
     * 内部数据结果
     */
    private $result;
    /*
     * 实例对象
     */
    private static $instance = null;

    /*
     * 构造方法
     */
    private function  __construct(){
        if(!function_exists('mysql_connect')){
            longMsg('php不支持mysql数据库');
        }
        if(!$this->conn = @mysql_connect(DB_HOST, DB_USER, DB_PASSWD)){
            longMsg('数据库连接失败，请检查用户名或者密码');
        }
        if($this->getMysqlVersion() > '4.1'){
            mysql_query("set names 'utf8'");
        }
        @mysql_select_db(DB_NAME, $this->conn) or longMsg('未找到指定数据库');

    }
    /*
     * 单例实例
     */
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Mysql();
        }
        return self::$instance;
    }
    /*
     * 关闭数据库连接
     */
    public function close(){
        return mysql_close($this->conn);
    }

    /*
     * 查询语句
     */
    public function query($sql){
        $this->result = @mysql_query($sql, $this->conn);
        $this->queryCount++;
        if(!$this->result){
            longMsg('sql语句执行错误:<br />' . $this->getError());
        }
        return $this->result;
    }

    /*
     * 获取查询资源
     */
    public function fetch_array($query, $type = MYSQL_ASSOC){
        return mysql_fetch_array($query, $type);
    }
    /*
     * 根据sql查询出数组
     */
    public function once_fetch_array($sql){
        $this->result = $this->query($sql);
        return $this->fetch_array($this->result);
    }
    /*
     * 取得上一步插入的id
     */
    function insert_id(){
        return mysql_insert_id($this->conn);
    }
    /*
     * 取得影响的行数
     */
    public function affected_rows(){
        return mysql_affected_rows();
    }
    /*
     * 获取mysql错误
     */
    public function getError(){
        return mysql_errno();
    }

    /*
     * 获取mysql版本
     */
    private function getMysqlVersion(){
        return mysql_get_server_info();
    }
    public function getQueryCount(){
        return $this->queryCount;
    }
}