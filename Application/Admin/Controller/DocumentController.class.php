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
use MyLibrary\Category;
use MyLibrary\Page;
//内容模型菜单
class DocumentController extends CommonController {
    //模型首页
    public function index(){
        $this->display();
    }
    //栏目管理首页
    public function category(){
        $getNodeList=M('Category')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,'　　');
        $this->assign('cate',$cate);
        $this->display('Category/index');
    }
    //添加栏目
    public function category_add(){
        $this->display('Category/add');
    }
    //文章 添加
    public function article_add(){
        $this->display('Article/add');
    }
    //栏目列表
    public function Category_edit(){
        $this->display('Article/edit');
    }
    //文章列表
    public function Article(){
        //获取表单检索的条件
        $data=A('Common')->whereCondition();
        if(!$data['order']) $data['order']='id Desc';
        $User = D('ArticleView');
        $count      = $User->where($data['map'])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,$data['num']);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($data['where'])->order($data['order'])->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Article/index');
    }


}