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
use MyLibrary\Category;
use MyLibrary\Page;

class ArticleController extends CommonController{

    //内容模型首页
   public function content(){
       $this->display();
   }
    //公共获取栏目
    public function getCategory(){
        $getNodeList=M('Category')->field('id,pid,ctitle')->select();
        $Category=new Category();
        $CategoryList=$Category->cate_ollist($getNodeList,0,'┈┈┤');
        $this->assign('category',$CategoryList);
    }

    //检索的表单的变量返还给模板
    public function assignMap($data){
        $map=array();
        foreach($data['map'] as $key =>$value){
            $map['user_name']=$data['map']['user_name'][1];
            $map['add_time_from']=$data['map']['add_time'][0][1];
            $map['add_time_to']=$data['map']['add_time'][1][1];
            $map['status']=$data['map']['status'][1];
            $map['cateid']=$data['map']['cateid'][1];
            $map['id']=$data['map']['id'][1];
        };
        $map['order']=$data['order'];
        $newMap=array();
        foreach($map as $v){
            $newMap['user_name']=substr($map['user_name'],1,-1);
            if($map['add_time_from']) $newMap['add_time_from']=date('Y-m-d',$map['add_time_from']);
            if($map['add_time_to']) $newMap['add_time_to']=date('Y-m-d',$map['add_time_to']);
            //if(empty($map['status'])) $newMap['status']='false';
            if(isset($map['status'])){
                $newMap['status']=$map['status'];
            }else{
                $newMap['status']='false';
            }
            $newMap['cateid']=$map['cateid'];
            $newMap['id']=$map['id'];
            $newMap['order']=$map['order'];
        }
        $this->assign('map',$newMap);
    }

    //获取文章列表
    public function getArticle($data){
        $this->getCategory(); //取得栏目下拉菜单
        if($_GET['cateid']) $data['map']['cateid']=I('cateid','intval');
        if(!$data['order']) $data['order']='id Desc';
        $User = D('ArticleView');
        $count      = $User->where($data['map'])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,$data['num']);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($data['map'])
             ->field('id,catid,title,add_time,status,hits,update_time,user_name,ctitle,cateid')
             ->order($data['order'])
             ->limit($Page->firstRow.','.$Page->listRows)
             ->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Article/index');
    }

    //文章列表
    public function index(){
        //获取表单检索的条件
        $data=A('Common')->whereCondition();
        $this->assignMap($data); //注册搜索条件给模板
        $this->getArticle($data);  //获取表表
    }

    //待审核的文章列表
    public function wait(){
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',2);
        $this->assignMap($data);
        $this->getArticle($data);

    }
    //已删除的文档
    public function remove(){
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',3);
        $this->assignMap($data);
        $this->getArticle($data);
    }

    //我发布的文档即当前登陆人发布的文档
    public function my(){
        $data=A('Common')->whereCondition();
        $data['map']['user_name']=session('admin_auth')['user_name'];
        $this->assignMap($data);
        $this->getArticle($data);
    }
    //审核通过的文档，即正常显示的文档
    public function normal(){
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',1);
        $this->assignMap($data);
        $this->getArticle($data);
    }


    public function add(){
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