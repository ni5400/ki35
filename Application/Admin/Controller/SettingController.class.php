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

class SettingController extends CommonController {

    //显示设置页板首页
    public function index(){
        $this->display();
    }
    //显示角色列表
    public function role(){
        $User = D('AuthGroup');
        $count      = $User->count();// 查询满足要求的总记录数
        $Page       = new Page($count,8);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //P($list); die;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //角色添加
    public function role_add(){
        $this->display();
    }

    //修改角色
    public function role_edit($role_id){

        $map['id']=I('role_id','','htmlspecialchars,intval');
        if($map['id']==1) $this->error('管理员禁止操作');
        $AuthGroup = D('AuthGroup');
        if($role=$AuthGroup->getRole($map)){
            $this->assign('role',$role);
        }else{
            $this->error('数据不存在,请重试');
        }
        $this->display();
    }

    //管理员列表
    public function manager(){
        $data=array(
            'user_name'=>$username=I('post.username'),
            'usr_byname'=>$byname=I('post.byname'),
            'date_from'=>$date_from=I('post.date_from'),
            'date_to'=>$date_to=I('post.date_to'),
            'order'=>$order=I('post.order'),
            'status'=>$status=I('post.status'),
            'id'=>$id=I('id','','intval'),
        );
        $map = array(); //查询条件,列表的搜索表单
        if ($username)  $map['user_name'] = array('like', '%'.$username.'%');
        if ($byname)    $map['user_byname'] = array('like', '%'.$byname.'%');
        if ($id)  $map['id'] = array('EQ', $id);
        //按登陆时间条件
        if ($date_from && $date_to) {
            $map['login_time'] = array(array('egt', strtotime($date_from)), array('elt', strtotime($date_to)));
        } else if ($date_from) {
            $map['login_time'] = array('egt', strtotime($date_from));
        } else if ($date_to) {
            $map['login_time'] = array('elt', strtotime($date_to));
        }
        $User = D('UserView');
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->field('id,user_name,user_byname,login_time,login_ip,reg_time,login_count,status,role_name')
            ->where($map)
            ->order($order)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach($list as $key=>$values){
            $list[$key]['login_time']=date('Y-m-d H:i:s',$values['login_time']);
            $list[$key]['reg_time']=date('Y-m-d',$values['reg_time']);
        }
//        P($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
        /**不用视图模型的多表查询方式
        $Model = D("Blog");
        $Model->table('think_blog Blog,think_category Category,think_user User')
        ->field('Blog.id,Blog.name,Blog.title,Category.title as category_name,User.name as username')
        ->order('Blog.id desc')
        ->where('Blog.category_id=Category.id AND Blog.user_id=User.id')
        ->select();
         */
    }
    //管理员添加
    public function manager_add(){
        $GroupList=$Group=D('AuthGroup')->getList($Field="id,title,status,type");
//        P($GroupList);
        $this->assign('group',$GroupList);
        $this->display();
    }

    //节点列表
    public function node(){
        $this->display();
    }

    //节点添加
    public function node_add(){
        $this->display();
    }
}