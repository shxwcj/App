<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/4
 * Time: 11:55
 */

require_once ('./Response/Response.php');

/**
 * @desc 处理公共业务逻辑
 * @author wangchunjing
 * @email 1131920105@qq.com
*/
class Common
{
    public $params;
    public $app;

    /*验证规则*/
    public function check()
    {
        $this->params['app_id'] = $appId = isset($_POST['app_id']) ? $_POST['app_id'] : '';  //设备号
        $this->params['version_id'] = $versionId = isset($_POST['version_id']) ? $_POST['version_id'] : ''; //版本号
        $this->params['version_mini'] = $versionMini = isset($_POST['version_mini']) ? $_POST['version_mini'] : ''; //小版本号
        $this->params['did'] = $did = isset($_POST['did']) ? $_POST['did'] : '';   //app类型
        $this->params['encrypt_did'] = $encryptDid = isset($_POST['encrypt_did']) ? $_POST['encrypt_did'] : ''; //加密did

        if (!is_numeric($appId || !is_numeric($versionId))){
            return Response::show(401,'参数不合法');
        }
        /*判断APP是否需要加密*/
        $this->app = $this->getApp($appId);
        if (!$this->app){
            return Response::show(402,'设备号不存在');
        }
        /*判断加密是否符合*/
        if($this->app['is_encryption'] && $encryptDid != md5($did.$this->app['key'])){
            return Response::show(403,'没有该权限');
        }
    }

    public function getApp($id)
    {
        $sql = "select * from app where id={$id} and status = 1 limit 1";
        $connect = Db::getInstance()->connect();
        $result = mysqli_query($connect,$sql);
        return mysqli_fetch_assoc($result);
    }

    /*获取版本信息方法*/
    public function get_version_upgrade($appId)
    {
        $sql = "select * from version_upgrade where app_id={$appId} and status = 1 limit 1";
        $connect = Db::getInstance()->connect();
        $result = mysqli_query($connect,$sql);
        return mysqli_fetch_assoc($result);
    }
}