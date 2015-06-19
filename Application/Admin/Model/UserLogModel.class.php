<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Model;
use Think\Model;
//user操作日志表
class UserLogModel extends Model {

    public function addLogin($data){
        if($this->add($data)){
            echo '成功';
        }else{
            echo '失败';
        };
    }
}