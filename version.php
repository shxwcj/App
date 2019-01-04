<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/4
 * Time: 11:38
 */

require_once ('./common.php');

class Version extends Common
{
    public function version()
    {
        /*检测验证规则*/
        $this->check();
        /*获取版本信息*/
       $version = $this->get_version_upgrade($this->app['id']);
       if ($version){
           if ($version['type'] && $this->params['version_id'] < $version['version_id']){
               $version['is_upload'] = $version['type'];
           }else{
               $version['is_upload'] = 0;
           }
           return Response::show(200,'版本升级信息获取成功',$version);
       }else{
           return Response::show(200,'版本升级信息获取失败');
       }
    }
}