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

class UserModel extends Model {
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
        array('user_name','require','用户名不能为空',self::EXISTS_VALIDATE),
        array('user_name', '5,20', '用户名长度5-20位！', self::EXISTS_VALIDATE,'length'),
        array('name','','帐号名称已经存在！',0,'unique',4),
        array('password','require','密码不能为空',self::EXISTS_VALIDATE),
        array('code','require','验证码不能为空',self::EXISTS_VALIDATE),
        array('password', '5,30', '密码长度不合法！', self::EXISTS_VALIDATE,'length'),
        array('repassword', 'password', '俩次输入密码不一致！', self::EXISTS_VALIDATE,'confirm'),
        array('code', '4', '请输入4位验证码', self::EXISTS_VALIDATE,'length'),
    );
    //使用create方法创建数据对象的时候,执行Add()方法时，不在$insertFields定义范围内的字段将直接丢弃即只允许新增定义内的字段
    protected $insertFields = array('user_name','password','code','email');
    //使用create方法更新数据对象的时候,执行sava()方法时，不在$updateFields定义范围内的字段将直接丢弃
    protected $updateFields = array('user_name','password','code','email');
    //自动完成
    protected $auto=array(
        array('password', 'sha1', self::MODEL_INSERT, 'function'),
        array('logintime', 'time', self::MODEL_INSERT, 'function'),
        array('regtime','time',self::MODEL_INSERT,'function'),
        array('lock',1,self::MODEL_INSERT),
        array('password','',self::MODEL_UPDATE,'ignore'),//修改时空白则忽略
    );

    //检帐帐户是否存在或者停用状态
    public function checkStatus($username){
        $map=array();
        $map['user_name']=$username;
        $map['status']=array('gt',0);
        return $authInfo=$this->where($map)->find();
    }

    //验证登陆
    public function checkLogin($username,$password,$code){
        $data=array(
            'user_name'=>$username,
            'password'=>$password,
            'code'=>$code,
        );
        if(!$this->create($data)) return $this->getError();
        //检测用户名是否存在或状态
        if($authInfo=$this->checkStatus($username)){
         return  $authInfo;
        }
    }

    public function update($user_id,$login_count){
        $data = array(
            'login_time'=>time(),
            'login_ip'=>get_client_ip(1),
            'login_count'=>$login_count+1
        );
       return $this-> where('id'==$user_id )->setField($data);

    }

}