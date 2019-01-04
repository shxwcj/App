<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 18:05
 */
class File
{
    /*缓存目录*/
    private $_dir;
    /*文件扩展名*/
    const EXTENSION ='.txt';
    public function __construct()
    {
       $this->_dir = dirname(__FILE__).'/files/';
    }

    /**
     * @desc 生成/删除/获取 缓存
     * @param string $key 文件名
     * @param int    $value 被缓存的数据(为''时表示获取缓存,为NUll时为删除缓存文件,否则为生成缓存)
     * @param string $path 文件保存的路径
     * @param int    $time 缓存时间(秒),0为永不过期
     * return mixed
     */
    public function cache($key,$value='',$path='',$time=0)
    {
        $filename = $this->_dir.$path.$key.self::EXTENSION;


        if($value){
            //生成缓存
            $dir = dirname($filename);
            if(! is_dir($dir)){
                mkdir($dir,0777);
            }
            /*设置缓存时间长度*/
            $time = sprintf('%011d',$time);
            return file_put_contents($filename,$time.json_encode($value));
        }

        if(is_file($filename) && !$value){
            if(is_null($value)){
                //删除缓存
                return unlink($filename);
            }

            //获取缓存
            $content = file_get_contents($filename);

            /*判断是否永久时间*/
            $time = intval(substr($content,0,11));

            //转化为数组
            $content = json_decode(substr($content,11));

            if($time != 0 && $time + filemtime($filename) < time()){
                //过期了，删除
                unlink($filename);
                return FALSE;
            }
            return $content;
        }else{
            return FALSE;
        }
    }
}

/*$file = new File();

/*生成缓存*/
/*$data = array(
    'id'=>1,
    'name'=>'sina',
    'phone'=>'13058185654',
    'type'=>array(4,5,6),
    'test'=>array(1,45,67=>array(123,'tsyya'),),
);*/
//$file = new File();
/*永久缓存*/
/*if($file->cache('index_mk_cache',$data)) echo 'success';
else echo 'fail';*/
/*设置缓存时间*/
/*if($file->cache('cache',$data,'',180)) echo 'success';
else echo 'fail';*/

/*获取缓存*/
/*if($file->cache('index_mk_cache')) var_dump($file->cache('index_mk_cache'));
else echo 'fail';*/
/*if($file->cache('cache')) var_dump($file->cache('cache'));
else echo 'fail';*/
