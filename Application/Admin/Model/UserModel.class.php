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
use MyLibrary\Page;
class UserModel extends Model {
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
//        array('user_name','','帐号名称已经存在！',0,'unique',1),
        array('user_name','require','用户名不能为空',0,'',1),
        array('user_name', '5,20', '用户名长度5-20位！',0,'length',1),
        array('user_byname','require','别名不能为空',0,'',3),
        array('user_byname', '2,20', '别名长度2-10位！', 0,'length',3),
        array('password','require','密码不能为空',0,'',3),
        array('password','5,20','密码长度5-20位！',0,'length',1),
        array('code','require','验证码不能为空',self::EXISTS_VALIDATE),
        array('repassword', 'password', '俩次输入密码不一致！', self::EXISTS_VALIDATE,'confirm'),
        array('code', '4', '请输入4位验证码', self::EXISTS_VALIDATE,'length'),
    );
    //使用create方法创建数据对象的时候,执行Add()方法时，不在$insertFields定义范围内的字段将直接丢弃即只允许新增定义内的字段
    protected $insertFields = array('id','user_name','password','user_byname','reg_time','reg_ip','login_time','login_count','role_id','status','unqi_id');
    //使用create方法更新数据对象的时候,执行sava()方法时，不在$updateFields定义范围内的字段将直接丢弃
    protected $updateFields = array('password','user_byname','login_time','role_id','status','unqi_id');
    //自动完成
    protected $_auto=array(
        array('login_time', 'time', self::MODEL_INSERT, 'function'),
        array('reg_time','time',self::MODEL_INSERT,'function'),
        array('reg_ip','get_client_ip',self::MODEL_INSERT,'function'),
        array('login_ip','get_client_ip',self::MODEL_BOTH,'function'),
        array('login_time','time',self::MODEL_BOTH,'function'),
        array('login_count',0,self::MODEL_INSERT),
        array('password', 'sha1', self::MODEL_BOTH, 'function'),
        array('password','',self::MODEL_UPDATE,'ignore'),//修改时空白则忽略
    );

    //检帐帐户是否存在同时检测停用状态
    public function checkStatus($username){
        $map=array();
        $map['user_name']=$username;
        $map['status']=array('gt',0);
        return $authInfo=$this->where($map)->find();
    }
    //检帐帐户是否存在
    public function checkUsername($username){
        $map=array();
        $map['user_name']=$username;
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

    //登陆后更新数据库登陆时间和次数级ip
    public function update($user_id,$login_count){
        $data = array(
            'login_time'=>time(),
            'login_ip'=>get_client_ip(),
            'login_count'=>$login_count+1
        );
       return $this-> where('id='.$user_id )->setField($data);

    }

    //注册管理员
    public function register($username,$byname,$password,$status){
        $data=array(
            'user_name'=>$username,
            'user_byname'=>$byname,
            'password'=>$password,
            'status'=>$status,
        );
        if(!$this->create($data)){
            return $this->getError();
        }else{
            return  $this->add();

        }
    }
    //获取管理员列表
    public function getList($data){
        return ;

    }

    //要据条件查询某条结果
    public function getMy($data){
        return $this->where($data)->find();
    }

}