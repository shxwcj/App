<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 15:59
 */
/*测试接收通信数据*/
/*require_once('./Response.php');

$data = array(
    'id'=>1,
    'name'=>'sina',
    'phone'=>'13058185654',
    'type'=>array(4,5,6),
    'test'=>array(1,45,67=>array(123,'tsyya'),),
);
//Response::json(200,'获取数据成功',$data);
//Response::xml(200,'success',$data);

Response::show(200,'success',$data,'xml');*/

/*测试静态缓存数据*/
require_once ('../file.php');
/*生成缓存*/
$data = array(
    'id'=>1,
    'name'=>'sina',
    'phone'=>'13058185654',
    'type'=>array(4,5,6),
    'test'=>array(1,45,67=>array(123,'tsyya'),),
);
$file = new File();
/*if($file->cache('index_mk_cache',$data)) echo 'success';
else echo 'fail';*/

/*获取缓存*/
if($file->cache('index_mk_cache')) var_dump($file->cache('index_mk_cache'));
else echo 'fail';

?>