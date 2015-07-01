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

    protected   function _initialize(){

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
    public function whereCondition(){
        //获取的查询条件
        if($_GET['username']) $username=I('username','','htmlspecialchars,trim');
        if($_GET['byname']) $byname=I('byname','','htmlspecialchars,trim');
        if($_GET['date_from']) $date_from=I('date_from','','htmlspecialchars,trim');
        if($_GET['date_to']) $date_to=I('date_to','','htmlspecialchars,trim');
        if($_GET['content']) $error_content=I('content','','htmlspecialchars,trim');
        if($_GET['reg_date_from']) $reg_date_from=I('reg_date_from','','htmlspecialchars,trim');
        if($_GET['reg_date_to']) $reg_date_to=I('reg_date_to','','htmlspecialchars,trim');
        if($_GET['login_ip']) $login_ip=I('login_ip','','htmlspecialchars,trim');
        if($_GET['order']) $order=I('order','','intval');
        if($_GET['status']) $status=I('status','','htmlspecialchars,trim');
        if($_GET['id']) $id=I('id','','intval');
        if($_GET['content']) $error_content=I('content','','htmlspecialchars,trim');
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
        if ($login_ip)  $map['login_ip'] = array('EQ', $login_ip);
        if($status == "true") $map['status']=array('EQ',1);
        if($status == "false") $map['status']=array('EQ',0);
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
        $data=array(
            'map'=>$map,
            'order'=>$sort,
            'num'=>$num,
        );
        return $data;
    }


}