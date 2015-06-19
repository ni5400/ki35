<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Model;
use Think\Model\RelationModel;


//使用create方法,自动验证，自动执行等方法才会生效
class UserRelationModel extends RelationModel {

    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间)
        array('user_name', '/^[^@]{5,20}$/i', '用户名5-20位', self::EXISTS_VALIDATE),
        array('user_name','require','用户名不能为空',self::EXISTS_VALIDATE),
        array('password','require','密码不能为空',self::EXISTS_VALIDATE),
        array('password', '5,30', '密码长度不合法！', self::EXISTS_VALIDATE,'length'),
        array('password','checkPwd','密码格式不正确',0,'function'),  // 自定义函数验证密码格式
        array('repassword','checkPwd','密码格式不正确',0,'function'),  // 自定义函数验证密码格式
        array('repassword', 'password', '俩次输入密码不一致！', self::EXISTS_VALIDATE,'confirm'),
        array('user_email','6,40','邮箱6-40位',self::EXISTS_VALIDATE,'length'),
        array('user_email','email','邮箱格式不正确',self::EXISTS_VALIDATE),
        array('user_name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内

    );


    //使用create方法创建数据对象的时候,执行Add()方法时，不在$insertFields定义范围内的字段将直接丢弃即只允许新增定义内的字段
    protected $insertFields = array('account','password','nickname','email');

    //使用create方法更新数据对象的时候,执行sava()方法时，不在$updateFields定义范围内的字段将直接丢弃
    protected $updateFields = array('nickname','email');

    //关联模型
    protected  $_link=array(
        'user_log'=>array(
            'class_name'=>'User_log',
            'mapping_type'=>self::HAS_MANY,
            'foreign_key'=>'username',
            'mapping_name'=>'userlog'  //关联的映射名称
        ),
    );

    //自动完成
    protected $auto=array(
        array('password', 'sha1', self::MODEL_BOTH, 'function'),
        array('logintime', 'time', self::MODEL_INSERT, 'function'),
    );


    public function add(){
        $User = D("User"); // 实例化User对象
        if (!$User->create()){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            exit($User->getError());
        }else{
            // 验证通过 可以进行其他数据操作
        }

    }


}