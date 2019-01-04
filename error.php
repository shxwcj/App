<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/4
 * Time: 13:41
 */

require_once ('./common.php');
require_once ('./Response/Response.php');
require_once ('./db.php');

class Error extends Common
{
    public function error()
    {
        $this->check();
        $errorlog = isset($_POST['error_log']) ? $_POST['error_log'] : '';
        if (!$errorlog){
            return Response::show(401,'日志为空');
        }
        $sql = "insert into error_log('app_id','did','version_id','version_mini','error_log','create_time') values ('{$this->params['app_id']}','{$this->params['did']}','{$this->params['version_id']}','{$this->params['version_mini']}','{$errorlog}','time()')";

        $connect = Db::getInstance()->connect();
        $result = mysqli_query($connect,$sql);
        if($res = mysqli_fetch_assoc($result)){
            return Response::show(200,'错误信息记录成功',$res);
        }else{
            return Response::show(400,'错误信息记录失败');
        }
    }
}

$error = new Error();
$error->error();