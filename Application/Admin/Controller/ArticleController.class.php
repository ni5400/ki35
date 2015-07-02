<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-7-8 下午4:54
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */ 

namespace Admin\Controller;
use Admin\Model\ArticleDataViewModel;

class ArticleController extends CommonController{

    public function index(){

        //查询无序分类到搜索的栏目条件
        $cate=M('category')->select();
        $category=new \MyLibrary\Category();
        $this->cate=$category->cate_ollist($cate,0,'　');

        //显示栏目内容页条件
        if(isset($_GET['catid'])){
            $this->catid=$catid=I('catid','','intval') ;
            $where=array('catid'=>$catid);
        }

        //分配资源
        $article=M('article'); // 实例化对象
        $this->count=$count= $article->where($where)->count();// 查询满足要求的总记录数
        $page=new \MyLibrary\Pagetwo($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show   = $page->show();// 分页显示输出
        //查询
        $list=D('ArticleView')->where($where)->field('itemid,catid,title,ctitle,addtime,edittime,addtime,status,hits,username')->limit($page->firstRow.','.$page->listRows)->order('itemid desc')->select();

        $this->assign('page',$show);
        $this->assign('list',$list);// 赋值数据集
        $this->display(); // 输出模板
    }

    public function add(){

        if(isset($_GET['catid'])){
            $this->catid=$catid=I('catid','','intval') ;

        }
        //查询无序分类到模板
        $this->catid=I('catid','','intval');
        $cate=M('category')->select();
        $category=new \MyLibrary\Category();

        $this->cate=$category->cate_ollist($cate,0,'　');
//        P($category->cate_ollist($cate,0,'　'));
        $this->display();
    }

    public function addHandle(){

        $data=array(
            'itemid'=>'',
            'catid'=>I('catid','','intval'),
            'title'=>I('title','','trim,htmlspecialchars'),
            'stitle'=>I('stitle','','trim,htmlspecialchars'),
            'style'=>I('style','','htmlspecialchars'),
            'introduce'=>I('introduce','','trim,htmlspecialchars'),
            'search'=>I('search','','trim,htmlspecialchars'),
            'keyword'=>I('keyword','','trim,htmlspecialchars'),
            'author'=>I('author','','trim,htmlspecialchars'),
            'copyfrom'=>I('copyfrom','','trim,htmlspecialchars'),
            'fromurl'=>I('fromurl','','trim,htmlspecialchars'),
            'thumb'=>I('thumb','','htmlspecialchars'),
            'username'=>session('username'),
            'edittime'=>I('addtime','','strtotime'),
            'ip'=>get_client_ip(),
            'template'=>I('template','','htmlspecialchars'),
            'islink'=>I('islink','','intval'),
            'linkurl'=>I('linkurl','','htmlspecialchars'),
            'filepath'=>I('filepath','','htmlspecialchars'),
            'reason'=>I('reason','','trim,htmlspecialchars'),
            'addtime'=>I('addtime','','strtotime'),
            'status'=>I('status','','trim,intval'),
            'hits'=>I('hits','','trim,intval')
        );
        if(!IS_POST) $this->error('非法操作');
        $itemid=M('article')->data($data)->add();
           $data2=array(
               'itemid'=>$itemid,
               'content'=>I('content','','htmlspecialchars')
           );
        $content=M('article_data')->data($data2)->add();
        if($itemid && $content){
            $this->success('添加成功');
        }else{
            $this->error('新增失败');
        }


    }

    public function del(){

      if(IS_POST){
            $itemid=I('id','','intval');
            $del=M('Article')->where(array('itemid'=>$itemid))->delete();
            $del2=M('Article_data')->where(array('itemid'=>$itemid))->delete();
            if($del&&$del2){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $this->error('非法操作');
        }


    }

    public function edit(){

        if(isset($_GET['catid'])){
            $this->catid=$catid=I('catid','','intval') ;

        }
        //查询无序分类到模板
        $cate=M('category')->select();
        $category=new \MyLibrary\Category();
        $this->cate=$category->cate_ollist($cate,0,'　');
        $this->catid=I('catid','','intval');

        $itemid=I('id','','intval');
        //$this->data=D('ArticleView')->where(array('itemid'=>$itemid))->find();
       $this->data=$data=D('ArticleDataView')->where(array('itemid'=>$itemid))->find();
         //$this->data=$data=D('ArticleRelation')->where(array('itemid'=>$itemid))->relation(true)->find();
       //P($data);
       $this->display();
    }


    public function editHandle(){
        if(!IS_POST) $this->error('非法操作');
        $data=array(
            'itemid'=>I('id','','intval'),
            'catid'=>I('catid','','intval'),
            'title'=>I('title','','trim,htmlspecialchars'),
            'stitle'=>I('stitle','','trim,htmlspecialchars'),
            'style'=>I('style','','htmlspecialchars'),
            'introduce'=>I('introduce','','trim,htmlspecialchars'),
            'search'=>I('search','','trim,htmlspecialchars'),
            'keyword'=>I('keyword','','trim,htmlspecialchars'),
            'author'=>I('author','','trim,htmlspecialchars'),
            'copyfrom'=>I('copyfrom','','trim,htmlspecialchars'),
            'fromurl'=>I('fromurl','','trim,htmlspecialchars'),
            'thumb'=>I('thumb','','htmlspecialchars'),
            'username'=>session('username'),
            'edittime'=>time(),
            'template'=>I('template','','htmlspecialchars'),
            'islink'=>I('islink','','intval'),
            'linkurl'=>I('linkurl','','htmlspecialchars'),
            'filepath'=>I('filepath','','htmlspecialchars'),
            'reason'=>I('reason','','trim,htmlspecialchars'),
            'addtime'=>I('addtime','','strtotime'),
            'status'=>I('status','','trim,intval'),
            'hits'=>I('hits','','trim,intval')
        );
        $itemid=$data['itemid'];

        $data2=array(
            'itemid'=>$itemid,
            'content'=>I('content','','htmlspecialchars')
        );
        $save1=M('article')->save($data);
        $save2=M('article_data')->save($data2);
        if( $save1|| $save2){
            $this->success('修改成功',U('Admin/Article/index',array('catid'=>$data['catid'])));
        }else{
            $this->error('数据修改失败');
        }


    }

    public function upload(){
        P($_FILES);

    }


}