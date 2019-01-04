<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 19:59
 */

    /*crontab 定时执行脚本数据*/
    //50 7 * * * /usr/bin/php/data/www/app/cron.php;

require_once ('./file.php');
require_once ('./db.php');
require_once ('./Response/Response.php');

$file = new File();

$sql = "select * from oauth_clients";

try{
    $connect = Db::getInstance()->connect();

} catch (Exception $e){
    file_put_contents('./logs'.date('Ymd').'.txt',$e->getMessage());
    return;
}
$result = mysqli_query($connect,$sql);

$res = array();
while($resu = mysqli_fetch_assoc($result)){
    $res[] = $resu;
}

if($res){
    $file->cache('db',$res,'',300);
    return Response::show(200,'缓存数据成功',$res,'json');
}else{
    file_put_contents('./logs'.date('Ymd').'.txt','无相关数据');
}

