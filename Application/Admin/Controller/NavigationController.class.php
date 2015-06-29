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

//后台首页左侧导航
class NavigationController extends CommonController{


    public function index(){

        $result=D('Navigation')->getNav(1);

        $category=new Category();
        $cate=$this->cate=$category->cate_ullist($result);
        //P($cate);
        $this->assign('nav',$cate);
        $this->display();
    }

}