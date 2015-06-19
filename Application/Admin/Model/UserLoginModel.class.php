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
//user登陆日志表
class UserLoginModel extends Model {

    //自动完成
    protected $auto=array(
        array('login_ip', 'get_client_ip(1)'),
        array('login_time', 'time', self::MODEL_INSERT, 'function'),
    );

    //写入登陆日志
    public function addLogin($username,$error_content){
        $data=array(
            'user_name'=>$username,
            'error_content'=>$error_content,
            'login_time'=>time(),
            'login_ip'=>get_client_ip(1)
        );
        if($this->create($data)){
            $this->add($data);
        }
    }

}