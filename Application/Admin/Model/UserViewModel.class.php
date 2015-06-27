<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Model;
use Think\Model\ViewModel;


class UserViewModel extends ViewModel {
    public $viewFields = array(
        'User'=>array('id','user_name','user_byname','login_time','login_ip','reg_time','login_count','status'),
        'AuthGroupAccess'=>array('uid','group_id','_on'=>'User.id=AuthGroupAccess.uid'),
        'AuthGroup'=>array('title'=>'role_name', '_on'=>'AuthGroup.id=AuthGroupAccess.group_id'),
    );
}