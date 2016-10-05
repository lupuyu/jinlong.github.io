<?php
namespace app\api\controller;

use app\api\model\User;

class UserController
{
    public function news(){
        $appkey = "db05e1234f593a7b458b43c3bfb2a000";
        //************1.头条新闻信息查询************
        $url = "http://v.juhe.cn/toutiao/index";
        $params = [
              "type" => "top",//类型
              "dtype" => "json",//返回数据格式：json或xml,默认json
              "key" => $appkey,//你申请的key
        ];
        $paramstring = http_build_query($params);           /*生成 URL-encode 之后的请求字符串*/
        // print_r($paramstring);
        //     echo "<br>";
        $ch = curl_init($url.'?'.$paramstring);
        $contents = curl_exec($ch);
        $title=$contents['title'];
        $content=[
            'title'=>$title,
        ];
        return $content;
        // return 1;
        // curl_close($ch);
        // print_r($content);
        // echo "<br>";
        // $result = json_decode($content,true);
        // if($result){
        //     if($result['error_code']=='0'){
        //         print_r($result);
        //     }else{
        //         echo $result['error_code'].":".$result['reason'];
        //     }
        // }else{
        //     echo "请求失败";
        // }
        //************************************************** 
    }



}