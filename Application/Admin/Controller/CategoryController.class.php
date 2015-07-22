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
    /*获取栏目列表
     * html为无序列表的多级别前的字符
     */
    public function getCategory($html){
        $getNodeList=M('Category')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,$html);
        if(I('cateid')) $cateid=I('cateid','','intval');
        $this->assign('cate',$cate);
        $this->assign('cateid',$cateid);
    }
    //后台栏目列表
    public function index()
    {
        $this->getCategory($html="┈┈┤");
        $this->display();
    }

    public function category_add()
    {
        $this->getCategory($html="┈┈");
        $this->display('add');
    }

    public function Category_edit()
    {
        $this->getCategory($html="┈┈");
        $map['id']= $cateid=I('cateid','','intval');
        $getCate=D('Category')->where($map)->find();
        $this->assign('getCate',$getCate);
        $this->display('edit');
    }

    //查询是否有子节点和是否存在文章
    public function catePid()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        $map['catid']=$data['pid'];
        $count['category']=D('Category')->where($data)->count();
        $count['article']=D('Article')->where($map)->count();
        return $this->ajaxReturn($count);
    }

    //栏目删除
    public function cateDel()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        $map['id']=I('id','','intval');
        $Category=D('Category');
        if($Category->where($data)->count()){
            exit('存在子结点，请先删除子节点后再进行操作');
        }
        if($Category->where($map)->delete()){
            echo "true";
        }else{
            echo "false";
        }
    }
    //文章推荐位
    public function nature()
    {
        $getNodeList=M('ArticleNature')->field('id,pid,title')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,'　　');
        $this->assign('cate',$cate);
        $this->display();
    }
    //添加推荐位
    public function nature_add()
    {
        $getNodeList=M('ArticleNature')->where('pid=0')->field('id,pid,title')->select();
        $this->assign('list',$getNodeList);
        $this->display();
//        $getNodeList=M('ArticleNature')->field('id,pid,title')->select();
//        $Category=new Category();
//        $list=$Category->cate_ollist($getNodeList,0,'┈┈');
//        $this->assign('list',$list);
//        $this->display();
    }
    //推荐位表单处理
    public function natureHandle()
    {
        $data=array(
            'title'=>I('title'),
            'pid'=>I('pid','intval'),
            'color'=>I('style')
        );
       $Nature=M('ArticleNature');
        if($Nature->add($data)){
            $this->success('添加成功',U('Category/nature'));
        }else{
            $this->error('添加失败');
        }
    }
    //查询是否有子节点和是否存在文章
    public function naturePid()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        echo $AuthRule=D('ArticleNature')->where($data)->count();
    }

    //推荐位删除
    public function natureDel()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        $map['id']=I('id','','intval');
        $AuthRule=D('ArticleNature');
        if($AuthRule->where($data)->count()){
            exit('存在子结点，请先删除子节点后再进行操作');
        }
        if($AuthRule->where($map)->delete()){
            echo "true";
        }else{
            echo "false";
        }
    }
    //栏目添加表单处理
    public function addHandle()
    {
        $data=array(
            'pid'=>I('pid','intval'),
            'status'=>I('status','','intval'),
            'ctitle'=>I('ctitle'),
            'stitle'=>I('stitle'),
            'skeywords'=>I('skeywords'),
            'catalog'=>I('catalog'),
            'pic_title'=>I('pic_title'),
            'content'=>I('content'),
            'scontent'=>I('scontent'),
        );
        $Cate=D('Category');
        if(!$Cate->create($data)){
            $this->error($Cate->getError());
        }else{
            if($Cate->data($data)->add()){
                $this->success('添加栏目成功',U('Category/index'));
            }else{
                $this->error('添加失败,请重试');
            }
        };
    }
    //栏目修改表单处理
    public function editHandle()
    {
        $data=array(
            'id'=>I('id','intval'),
            'pid'=>I('pid','intval'),
            'status'=>I('status','','intval'),
            'ctitle'=>I('ctitle'),
            'stitle'=>I('stitle'),
            'skeywords'=>I('skeywords'),
            'catalog'=>I('catalog'),
            'pic_title'=>I('pic_title'),
            'content'=>I('content'),
            'scontent'=>I('scontent'),
        );
        $Cate=D('Category');
        if(!$Cate->create($data)){
            $this->error($Cate->getError());
        }else{
            if($Cate->save($data)){
                $this->success('修改栏目成功',U('Category/index'));
            }else{
                $this->error('修改栏目失败,请重试');
            }
        };
    }
    //检测没目录是否重值
    public function checkCatelog()
    {
        if(!IS_AJAX) $this->error('非法操作');

        if($id=I('post.id','intval')){
            $map['id']=array('NEQ',$id);
        }
        $map['catalog']=I('catalog');

        if(D('Category')->where($map)->find()){
            echo 'false';
        }else{
            echo 'true';
        };
    }
    /**
     * tag标签，分类添加
     */
    public function tagAdd()
    {
        $getNodeList=M('ArticleTag')->where('pid=0')->field('id,pid,title')->select();
        $this->assign('list',$getNodeList);
        $this->display();
    }

    /**
     * [tagHandle description]添加Tag分类表单处理
     * @return [type] [description]
     */
    public function tagHandle()
    {
        $data=array(
            'title'=>I('title'),
            'name'=>I('name'),
            'pid'=>I('pid','intval'),
            'color'=>I('style')
        );
        $Tag=M('ArticleTag');
        if($Tag->add($data)){
            $this->success('添加成功',U('Category/getTag'));
        }else{
            $this->error('添加失败');
        }
    }
    /**
     * [getTag description] tag分类列表首页
     * @return [type] [description]
     */
    public function getTag()
    {
        $getNodeList=M('ArticleTag')->field('id,pid,title')->select();
        $category=new Category();
        $cate=$category->cate_ollist($getNodeList,0,'　　');
        $this->assign('cate',$cate);
        $this->display('tag');
    }

    /**
     * [tagPid description]tag分类检测是否存在子类
     * @return [type] [description]
     */
    public function tagPid()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        echo $AuthRule=D('ArticleTag')->where($data)->count();
    }

    /**
     * [tagDel description] tag分类ajax删除
     * @return [type] [description]
     */
    public function tagDel()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        $map['id']=I('id','','intval');
        $AuthRule=D('ArticleTag');
        if($AuthRule->where($data)->count()){
            exit('存在子结点，请先删除子节点后再进行操作');
        }
        if($AuthRule->where($map)->delete()){
            echo "true";
        }else{
            echo "false";
        }
    }





} 