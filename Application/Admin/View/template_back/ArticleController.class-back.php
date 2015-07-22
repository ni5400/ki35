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
   public function content()
   {
       $this->display();
   }
    //公共获取栏目
    public function getCategory()
    {
        $getNodeList=M('Category')->field('id,pid,ctitle')->select();
        $Category=new Category();
        $CategoryList=$Category->cate_ollist($getNodeList,0,'┈┈┤');
        $this->assign('category',$CategoryList);
    }

    //检索的表单的变量返还给模板  检索条件，表单搜索的动态值
    public function assignMap($data)
    {
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
    public function getArticle($data)
    {
        $this->getCategory(); //取得栏目下拉菜单
        if($_GET['cateid']) $data['map']['cateid']=I('cateid','intval');
        if(!$data['order']) $data['order']='id Desc';
        $User = D('ArticleView');
        $count      = $User->where($data['map'])->count();// 查询满足要求的总记录数
        $Page       = new Page($count,$data['num']);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($data['map'])
             ->field('id,catid,title,add_time,status,hits,update_time,user_name,ctitle')
             ->order($data['order'])
             ->limit($Page->firstRow.','.$Page->listRows)
             ->select();
        //查询是否有推荐位存在，如果有nature＝true
        foreach($list as $value=>$key){
            $natureMap['article_id']=$list[$value]['id'];
            if(M('ArticleNatureData')->where($natureMap)->find()){
                $list[$value]['nature']='true';
            }
        }
//        P($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Article/index');
    }

    //文章列表
    public function index()
    {
        //获取表单检索的条件
        $data=A('Common')->whereCondition();
        $this->assignMap($data); //注册搜索条件给模板
        $this->getArticle($data);  //获取表表
    }

    //待审核的文章列表
    public function wait()
    {
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',2);
        $this->assignMap($data);
        $this->getArticle($data);

    }
    //已删除的文档
    public function remove()
    {
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',3);
        $this->assignMap($data);
        $this->getArticle($data);
    }

    //我发布的文档即当前登陆人发布的文档
    public function my()
    {
        $data=A('Common')->whereCondition();
        $data['map']['user_name']=session('admin_auth')['user_name'];
        $this->assignMap($data);
        $this->getArticle($data);
    }
    //审核通过的文档，即正常显示的文档
    public function normal()
    {
        $data=A('Common')->whereCondition();
        $data['map']['status']=array('EQ',1);
        $this->assignMap($data);
        $this->getArticle($data);
    }

    //添加文章
    public function articleAdd()
    {
        //查询推荐位
        $getNodeList=M('ArticleNature')->field('id,pid,title')->select();
        $Category=new Category();
        $nature=$Category->cate_ullist($getNodeList);
        $this->assign('nature',$nature);
        //查询tag分类
        $getTagList=M('ArticleTag')->field('id,pid,title')->select();
        $tagList=$Category->cate_ullist($getTagList);
        $this->assign('tag',$tagList);
        //查询栏目
        A('Category')->getCategory($html="┈┈┤");
        $this->display('add');
    }

    //文章添加表单处理
    public function addHandle()
    {
        //表单数据
        $data=array(
            'catid'=>I('post.catid','intval'),
            'title'=>I('post.title'),
            'style'=>I('post.style'),
            'thumb'=>I('post.thumb'),
            'stitle'=>I('post.stitle'),
            'keyword'=>I('post.keyword'),
            'introduce'=>I('post.introduce'),
            'ip'=>get_client_ip(),
            'linkurl'=>I('post.linkurl'),
            'filepath'=>I('post.filepath'),
            'search'=>I('post.search'),
            'user_name'=>session('admin_auth')['user_name'],
            'Data'=>array(
                'content'=>I('post.content'),
            ),
            'status'=>I('post.status'),
            'add_time'=>strtotime(I('post.add_time')),
            'update_time'=>time(),
            'fromurl'=>I('post.fromurl'),
            'author'=>I('post.author'),
            'copyfrom'=>I('post.copyfrom'),
            'hits'=>I('post.hits','0','intval'),
        );
        $tag=I('post.tag');
        $tagstr='';
        foreach($tag as $v=>$k){
            $tagstr.=$k.',';
        }
        $tagMap['id']=array('in',substr($tagstr,0,-1));
        $tags=M('ArticleTag')->where($tagMap)->select();
        $data['tags']=$tags;
//        $tag=I('post.tag');
//        $tagstr='';
//        foreach($tag as $v=>$k){
//            $tagstr.=$k.',';
//        }
//        $tagMap['id']=array('in',substr($tagstr,0,-1));
//        $tags=M('ArticleTag')->where($tagMap)->select();
//        $data['tags']=$tags;
//        M('Article')->add($data);
//        P($data);
////        P($taps);
//        die;
        $Article=D('ArticleRelation');
        if(!$Article->create($data)){
            $this->error($Article->getError());
        }else{
            if($result=$Article->relation('Data')->add($data)){
                //处理推荐表处理，多对多
                //处理推荐表处理，多对多
                $nature=I('post.nature');
                foreach($nature as $v=>$k){
                    $nature[$v]=array(
                        'article_id'=>$result,
                        'nature_id'=>$k
                    );
                }
                //tag表处理，多对多
                foreach($tag as $v=>$k){
                    $tag[$v]=array(
                        'article_id'=>$result,
                        'tag_id'=>$k
                    );
                }
                M('ArticleNatureData')->addAll($nature); //插入推荐表
                M('ArticleTagData')->addAll($tag);//插入tag表
                $this->success('添加成功',U('Article/index'));

            }else{
                $this->error('添加失败，请检查');
            }
        }

    }

    //文档删除 ajax删除的
    public function document_del()
    {
        if(!IS_AJAX) $this->error('非法操作');
        $Id=I('post.id','','intval');
        $map['article_id']=$Id;
        $delArticle=M('Article')->where('id='.$Id)->delete(); //删除文章主表
        $delArticleData=M('ArticleData')->where('aid='.$Id)->delete(); //删除文章副表
        $delArticleNature=M('ArticleNatureData')->where($map)->delete(); //删除推荐副表
        $delArticleTag=M('ArticleTagData')->where($map)->delete(); //删除推荐副表
        if($delArticle || $delArticleData || $delArticleNature ||$delArticleTag ){
                echo "true";
        }else{
            echo "false";
        }
    }

    /**
     *文章修改，便例推荐位，
     * 推荐位的处理，比较复杂，多研究下
     */
    public function article_edit()
    {
        $id=I('get.edit','intval');//获取文章修改的id
        A('Category')->getCategory($html="┈┈┤");
        //查询推荐位
        $getNodeList=M('ArticleNature')->field('id,pid,title')->select();
        //查询文章的所有信息包推荐位信息
        $content=D('ArticleRelation')->relation(true)->find($id);
        /*
        $natureData=array_column($content['nature'],'nature_id');
        php 5.5以上的版本可以直接使用此函数$content['nature']将数据里所有的值取出来重组成一个新数组，
        5.4以下版本只能使用便例的方式 取出文章表里推荐位的id的值
        */
        //处理推荐位
        foreach($content['nature'] as $v=>$k){
            $content['nature'][$v]=$k['nature_id'];
        }
//        P($content);
        //匹配文章表里推荐位的值如果和$getNodeList所有推荐位的id的值相等则让其子数组多一个check元素
        foreach($getNodeList as $key=>$values){
            if(in_array($values['id'],$content['nature'])){
                $getNodeList[$key]['check'] = 1;
            }
        }
        //同理处理tag分类
        //查询推荐位
        $getTagList=M('ArticleTag')->field('id,pid,title')->select();
        foreach($content['tag'] as $v=>$k){
            $content['tag'][$v]=$k['tag_id'];
        }
        foreach($getTagList as $key=>$values){
            if(in_array($values['id'],$content['tag'])){
                $getTagList[$key]['check'] = 1;
            }
        }

//        P($getTagList);  //重组后的数组测试
        // 推荐位信息以无限子类方式传到模板里
        $Category=new Category();
        $nature=$Category->cate_ullist($getNodeList);
        $this->assign('nature',$nature);
        //tag分类以无限子类的方式传到模板里
        $tag=$Category->cate_ullist($getTagList);
        $this->assign('tag',$tag);
        $this->assign('content',$content);
        $this->display('edit');
    }

    /**
     *修改文章
     */
    public function editHandle()
    {
        //表单数据
        $data=array(
            'id'=>I('post.id','intval'),
            'catid'=>I('post.catid','intval'),
            'title'=>I('post.title'),
            'style'=>I('post.style'),
            'thumb'=>I('post.thumb'),
            'stitle'=>I('post.stitle'),
            'keyword'=>I('post.keyword'),
            'introduce'=>I('post.introduce'),
            'ip'=>get_client_ip(),
            'linkurl'=>I('post.linkurl'),
            'filepath'=>I('post.filepath'),
            'reason'=>I('post.reason'),
            'search'=>I('post.search'),
            'user_name'=>session('admin_auth')['user_name'],
            'Data'=>array(
                'content'=>I('post.content'),
            ),
            'status'=>I('post.status'),
            'add_time'=>strtotime(I('post.add_time')),
            'update_time'=>time(),
            'fromurl'=>I('post.fromurl'),
            'author'=>I('post.author'),
            'copyfrom'=>I('post.copyfrom'),
            'hits'=>I('post.hits','0','intval'),
        );
        //修改数据前删除推荐位信息后重新插入，不考虑是否修改
        M('ArticleNatureData')->where('article_id='.$data['id'])->delete();
        //修改数据前删除tag表信息后重新插入，不考虑是否修改
        M('ArticleTagData')->where('article_id='.$data['id'])->delete();
        $Article=D('ArticleRelation');
        if(!$Article->create($data)){
            $this->error($Article->getError());
        }else{

            $result=$Article->relation('Data')->save($data);
                //处理推荐表处理，多对多
            $nature=I('post.nature');
           if($nature){
               foreach($nature as $v=>$k){
                   $nature[$v]=array(
                       'article_id'=>$data['id'],
                       'nature_id'=>$k
                   );
               }
               $ArticleNatureData=M('ArticleNatureData')->addAll($nature);
           }
            //处理推荐表处理，多对多
            $tag=I('post.tag');
            if($tag){
                foreach($tag as $v=>$k){
                    $tag[$v]=array(
                        'article_id'=>$data['id'],
                        'tag_id'=>$k
                    );
                }
                $ArticleTagData=M('ArticleTagData')->addAll($tag);
            }
            if($result || $ArticleNatureData || $ArticleTagData){
                $this->success('修改成功',U('Article/index'));
            }else{
                $this->error('添加失败，请检查');
            }
        }
    }

    public function upload()
    {
        P($_FILES);

    }

    public function cs(){

        $a=D('ArticleRelation')->relation(true)->find(248);
        P($a);
    }


}