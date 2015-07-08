<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */

namespace Admin\Controller;
use Think\Auth;
use Think\Controller;
//基类
class CommonController extends Controller {

    protected   function _initialize()
    {

        if(!isset(session('admin_auth')['user_id'])){
            redirect(U('Login/index'));
        }
        //帐号status==0则停用
        $map['id']=session('admin_auth')['user_id'];
        $status=M('User')->where($map)->field('status')->find();
        if($status['status']==0){
            session('admin_auth',null);
            $this->success('您的帐号已停用',U('Login/index'));
        }

        //如果是超级管理员则不需要通过权限认证
        if(session('admin_auth')['user_id']==1){
            return true;
        }

        $Auth = new Auth();
        if (!$Auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME.'/', session('admin_auth')['user_id'])) {
            echo '<p style="margin:10px;color:red;">对不起，您没有权限操作此模块！</p>';
            exit();
        }
    }

    //表单公共检索条件
    public function whereCondition()
    {
        //获取的查询条件
        $username=I('username');  //用户
        $byname=I('byname');  //姓名
        $date_from=I('date_from'); //登陆时间起
        $date_to=I('date_to'); //登陆时间到
        $reg_date_from=I('reg_date_from');  //注册时间
        $reg_date_to=I('reg_date_to');
        $add_time_from=I('addtime_from');//添加时间
        $add_time_to=I('addtime_to');
        $login_ip=I('login_ip');  //登陆ip
        $order=I('order','','intval');
        $status=I('status');
        $error_content=I('content','','htmlspecialchars,trim');  //登陆日志
        if($_GET['cateid']) $cateid=I('cateid','intval'); //文章列表里的
        if($_GET['id']) $id=I('id','','intval');  //按id检索

        //页码
        if($_GET['num']) {
            $num=I('num','','intval');
        }else{
            $num=10;
        };
        //排序条件
        $map = array(); //查询条件,列表的搜索表单
        if($error_content) $map['error_content'] = array('like', '%'.$error_content.'%');//登陆提示
        if ($username)  $map['user_name'] = array('like', '%'.$username.'%');
        if ($byname)    $map['user_byname'] = array('like', '%'.$byname.'%');
        if ($id)  $map['id'] = array('EQ', $id);
        if ($cateid)  $map['cateid'] = array('EQ', $cateid);
        if ($login_ip)  $map['login_ip'] = array('EQ', $login_ip);
        if($status == "正常" ||$status == "normal") $map['status']=array('EQ',1); //状态1正常
        if($status == "停用" || $status == "refuse") $map['status']=array('EQ',0);  //状态0为停用或审核未通过
        if($status == "待审核" || $status == "wait") $map['status']=array('EQ',2);  //状态2为待审核
        if($status == "已删除" || $status == "remove") $map['status']=array('EQ',3);  //状态3为已删除
        if($title=I('title','','htmlspecialchars')) $map['title']=array('like', '%'.$title.'%');
        if($order){
            switch($order){
                case 1:
                    $sort="reg_time";
                    break;
                case 2:
                    $sort="reg_time desc";
                    break;
                case 3:
                    $sort="id";
                    break;
                case 4:
                    $sort="id desc";
                    break;
                case 5:
                    $sort="login_time";
                    break;
                case 6:
                    $sort="login_time desc";
                    break;
                case 7:
                    $sort="add_time ";
                    break;
                case 8:
                    $sort="add_time desc";
                    break;
            }
        }
        //按登陆时间条件
        if ($date_from && $date_to) {
            $map['login_time'] = array(array('egt', strtotime($date_from)), array('elt', strtotime($date_to)));
        } else if ($date_from) {
            $map['login_time'] = array('egt', strtotime($date_from));
        } else if ($date_to) {
            $map['login_time'] = array('elt', strtotime($date_to));
        }
        //按注册时间条件
        if ($reg_date_from && $reg_date_to) {
            $map['reg_time'] = array(array('egt', strtotime($reg_date_from)), array('elt', strtotime($reg_date_to)));
        } else if ($reg_date_from) {
            $map['reg_time'] = array('egt', strtotime($reg_date_from));
        } else if ($reg_date_to) {
            $map['reg_time'] = array('elt', strtotime($reg_date_to));
        }
        //按添加时间条件
        if ($add_time_from && $add_time_to) {
            $map['add_time'] = array(array('egt', strtotime($add_time_from)), array('elt', strtotime($add_time_to)));
        } else if ($add_time_from) {
            $map['add_time'] = array('egt', strtotime($add_time_from));
        } else if ($add_time_to) {
            $map['add_time'] = array('elt', strtotime($add_time_to));
        }
        $data=array(
            'map'=>$map,
            'order'=>$sort,
            'num'=>$num,
        );
        return $data;
    }


}