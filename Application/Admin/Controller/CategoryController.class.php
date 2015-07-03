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
use MyLibrary\Page;
//后台管理内容管理栏目管理
class CategoryController extends CommonController {

    //后台栏目列表
    public function index(){
        $getNodeList=M('Category')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,'　　');
        $this->assign('cate',$cate);
        $this->display();
    }

    public function add(){
        $this->display();
    }


} 