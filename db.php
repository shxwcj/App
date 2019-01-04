<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 16:38
 */
/*单例模式连接数据库:
    1.私有的保存静态的变量
    2.私有的构造方法
    3.私有的克隆方法
    4.公共的静态的创建对象的方法
*/

class Db
{
    /*1.私有的保存静态的变量*/
    private static $_instance = null;

    /*连接数据库*/
    public $_db = array(
        'host'=> 'shenheng.xin',
        'user'=>'root',
        'password'=>'root',
        'database'=>'test',
    );

    private static $_connect;

    /*2.私有的构造方法*/
    private function __construct()
    {
    }

    /* 3.私有的克隆方法*/
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /*4.公共的静态的创建对象的方法*/
    public static function getInstance()
    {
        if(! self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /*连接数据库*/
    public function connect()
    {
        if(! self::$_connect) {
            self::$_connect = mysqli_connect($this->_db['host'], $this->_db['user'], $this->_db['password']);
            if (!self::$_connect) {
                die(mysqli_connect_error(self::$_connect));
            }
            mysqli_select_db(self::$_connect,$this->_db['database']);
            mysqli_set_charset(self::$_connect,'UTF8');
            return self::$_connect;
        }
    }

}

/*$db=Db::getInstance()->connect();
var_dump($db);exit();
$sql = "select * from oc_member";
$result = mysqli_query($db,$sql);

$res = mysqli_fetch_assoc($result);*/
