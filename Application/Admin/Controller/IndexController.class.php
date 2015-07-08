<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Controller;
use Think\Controller;
use MyLibrary\Page;

class IndexController extends CommonController {

    //默认登陆后台后的首页
    public function index()
    {

        $this->display();
    }
    //修改个人密码模板显示
    public function password()
    {
        $this->display();
    }
    //修改个人密码表单处理
    public function passwordHandle()
    {
        //动态验证
        $rules = array(
            array('password','require','密码必须！'), //默认情况下用正则进行验证
            array('password', '5,20', '密码长度5-20位！',0,'length'),
            array('repassword','password','俩次密码输入不一致',0,'confirm'), // 验证确认密码是否和密码一致
            array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
        );
        $User = M("User"); // 实例化User对象
        if (!$User->validate($rules)->create()){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $this->error($User->getError());
        }else{
            $data=array(
                'id'=>session('admin_auth')['user_id'],
                'password'=>sha1(I('password'))
            );
            if($User->save($data)){
                A('Login')->login_out();
            }else{
                $this->error('修改失败，或与密码一致');
            };
        }
    }
    //个人信息首页
    public function info()
    {
        $map['id']=session('admin_auth')['user_id'];
        $this->user = D("UserView")->where($map)->find();
        $this->display();
    }
    //个人中心登陆日志
    public function log()
    {
        //获取多查询条件
        $Data=A('Common')->whereCondition();
        //只查询当前用户的登陆信息
        $Data['map']['user_name'] = array('like', '%'.session('admin_auth')['user_name'].'%');//当前用户的登陆日志
        $Data['order']? $Data['order']: $Data['order']='id desc';
        $User = M('UserLogin');
        $count      = $User->where($Data['map'])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,$Data['num']);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->field('id,user_name,login_time,login_ip,error_content')->where($Data['map'])->order($Data['order'])->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //删除单条登陆日志记录
    public function delDialog()
    {
        if(!IS_AJAX) $this->error('非法操作');
        $UserId=I('post.id','','intval');
        if($UserId==1) echo "false";
        if($User = M('UserLogin')->where('id='.$UserId)->delete() ){
                echo "true";
        }else{
            echo "false";
        }
    }
    //批量删除登陆日志记录
    public function delBatchDialog()
    {
        P($_POST);
    }

    //文档表表
    public function document()
    {
        A('Article')->index();
    }



}