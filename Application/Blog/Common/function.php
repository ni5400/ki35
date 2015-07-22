<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:09
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
/**
 * @param $array 打印数组格式化
 */
function P($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


function content_format($array){
    foreach($array as $value){
        $array[$value]['content']=htmlspecialchars_decode($array[$value]['content']);
    }
    return $array;
}


  