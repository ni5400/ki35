<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */

namespace Admin\Controller;
use MyLibrary\Category;
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
        //获取表单检索的条件
        $data=A('Common')->whereCondition();
        $User = D('UserView');
        $count      = $User->where($data['map'])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,$data['num']);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->field('id,user_name,user_byname,login_time,login_ip,reg_time,login_count,status,role_name')->where($data['where'])->order($data['order'])->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();

    }
    //管理员添加
    public function manager_add(){
        $GroupList=$Group=D('AuthGroup')->getList($Field="id,title,status,type");
        $this->assign('group',$GroupList);
        $this->display();
    }

    //管理员删除
    public function user_del(){
        if(!IS_AJAX) $this->error('非法操作');
        $UserId=I('post.id','','intval');
        if($UserId==1) echo "false";
        if(M('User')->where('id='.$UserId)->delete() ){
           if(M('AuthGroupAccess')->where('uid='.$UserId)->delete()){
               echo "true";
           }
        }else{
            echo "false";
        }
    }

    //节点列表
    public function node(){
        $getNodeList=M('AuthRule')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,'　　');
        $this->assign('cate',$cate);
//        P($cate);
        $this->display();
    }

    //节点添加
    public function node_add(){
        if($add_id=I('add_id','','intval')) $this->assign('add_id',$add_id);
        $getNodeList=M('AuthRule')->select();
        $Category=new Category();
        $list=$Category->cate_ollist($getNodeList,0,'┈┈┤');
//        P($list);
        $this->assign('list',$list);
        $this->display();
    }
    //修改节点
    public function node_edit(){
        //查询获节点列表
        $AuthRule=M('AuthRule');
        $getNodeList=$AuthRule->select();
        $Category=new Category();
        $list=$Category->cate_ollist($getNodeList,0,'┈┈┤');
        $this->assign('list',$list);

        //写入当前节点信息
        $map['id']=I('id','','intval');
        $getResult=$AuthRule->where($map)->find();
        $this->assign('one',$getResult);

        //查询是否有字节点
        $map2['pid']=I('id','','intval');
        $pid=$AuthRule->where($map2)->count();

        $this->display();
    }

    //修改管理员模板显示
    public function manager_edit(){
        $data['id']=I('edit','','intval');
        $User=D('UserView')->field('id,user_name,user_byname,role_name,status')->where($data)->find();
        $this->assign('user',$User);
        //assign角色
        $GroupList=$Group=D('AuthGroup')->getList($Field="id,title,status,type");
        $this->assign('group',$GroupList);
        $this->display();
    }

    //权限配置显示节点列表
    public function role_node(){
        $roleId=I('role','','intval');
        //取出现在的节点
        $Role=D('AuthGroup')->field('rules')->where('id='.$roleId)->find();
        $Role=explode(',',$Role['rules']);
        //查询节点信息以多维数据分配
        $getNodeList=M('AuthRule')->field('id,title,name,pid,level')->select();
        //匹配$Role的键值 与 $getNodeList 键值的[id]值相等 设置[check]=1;
        $new=array();
        foreach($getNodeList as $key){
            foreach($Role as $k){
                if($k==$key['id']){
                    $key['check']=1;
                }
            }
            $new[]=$key;
        }
        //分配节点到模板
        $category=new Category();
        $cate=$category->cate_ullist($new);
        //P($cate);
        //角色id传值过去
        $this->assign('cate',$cate);
        $this->assign('role_id',$roleId);
        $this->display();
    }


    //代码调试
    public function abc(){
        /**不用视图模型的多表查询方式
        $Model = D("Blog");
        $Model->table('think_blog Blog,think_category Category,think_user User')
        ->field('Blog.id,Blog.name,Blog.title,Category.title as category_name,User.name as username')
        ->order('Blog.id desc')
        ->where('Blog.category_id=Category.id AND Blog.user_id=User.id')
        ->select();
         */
    }



}