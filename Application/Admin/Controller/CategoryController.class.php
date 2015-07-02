<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-7-7 下午9:50
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Controller;
use MyLibrary\Category;
use Think\Controller;
//后台管理内容管理栏目管理
class CategoryController extends CommonController {

    //后台栏目列表
    public function index(){

    }

    //后台栏目添加
    public function add(){
        //添加获取主栏目id
        $cateid=isset($_GET['id']) ? intval($_GET['id']) : 0;
        $this->assign('catid',$cateid);
        //查询无序分类到模板
        $cate=M('category')->select();
        $category=new \MyLibrary\Category();
        $this->cate=$category->cate_ollist($cate,0,'　');
        $this->display();
    }


    //后台栏目添加表单处理
    public function addHandle(){
        if(!IS_POST) $this->error('非法操作');
        $pid=isset($_GET['id'])?I('id','','intval') :0;
        echo $pid;
        P($_POST);
    }

    public function del(){
        if(IS_POST){
            $catid=I('id','','intval');
            $Category=M('category')->where(array('pid'=>$catid))->count();  //查询是否存在子栏目
            $count=M('article')->where(array('catid'=>$catid))->count(); //查询栏目是否存在数据

           if($Category!=0 || $count!=0) {
               //$this->error('请先删除下级栏目和数据后进行操作');
               echo 2;
           }else{
               if(M('category')->where(array('catid'=>$catid))->delete()){
                   //$this->success('删除栏目成功',U('Admin/Category/index'));
                   echo 1;
               }else{
                   //$this->error('逻辑错误');
                   echo 0;
               }
           }
        }else{
            $this->error('非法操作');
        }

    }

    public function edit(){

    }

    public function move(){
        echo '功能正在添加中';
    }
} 