<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 15:47
 */

class Response
{
    /**
     * @desc json格式输出通信数据
     * @param int $code 状态码
     * @param string $message 提示信息
     * @param array $data 数据
     * return mixed
     */

    public static function json($code,$message='',$data=array())
    {
        if(! is_numeric($code)){
            return '';
        }
        $result = array(
            'code'     =>  $code,
            'message'  =>  $message,
            'data'     =>  $data,
        );
        echo json_encode($result);
    }

    /**
     * @desc xml格式输出通信数据
     * @param int $code 状态码
     * @param string $message 提示信息
     * @param array $data 数据
     * return mixed
     */

    public static function xml($code,$message='',$data=array())
    {
        if(! is_numeric($code)){
            return '';
        }
        $result = array(
            'code'  =>  $code,
            'message'  =>  $message,
            'data'  =>  $data,
        );
       header("Content_Type:text/xml");
        $xml = "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<root>";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>";

        echo $xml;
    }
    public static function xmlToEncode($data)
    {
        $xml = $attr ='';
        foreach ($data as $key=>$value){
            if(is_numeric($key)){
                $attr = "id='{$key}'";
                $key = "item ";
            }
            $xml .= "<{$key}{$attr}>";
            $xml .= is_array($value)?self::xmlToEncode($value):$value;
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }

    /**
     * @desc 综合方式输出通信数据
     * @param int $code 状态码
     * @param string $type 数据类型 json|xml
     * @param string $message 提示信息
     * @param array $data 数据
     * return mixed
     */

    public static function show($code,$message='',$data=array(),$type='json')
    {
        if(!is_numeric($code)){
            return '';
        }

        $result =array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data,
        );

        if($type == 'json'){
            self::json($code,$message,$data);
        }elseif ($type == 'xml'){
            self::xml($code,$message,$data);
        }else{
           echo "<pre>";
           print_r($result);
        }
    }
}
