<?php
namespace Blog\Controller;
use Think\Controller;
use MyLibrary\Category;

/**
 * Class IndexController
 * @package Blog\Controller博客首页
 */
class ShowController extends CommonController {
    /**
     * 显示首页
     */
    public function index(){
        $id=I('id','intval');
        $List=D('ArticleRelation')
            ->field('id,title,stitle,style,introduce,tags,keyword,author,copyfrom,add_time')
            ->relation('Data')->find($id);
        foreach($List as $value){
            $List['content']=htmlspecialchars_decode($List['content']);
            $List['tag']=json_decode($List['tags'],true);
        }
        if($List){
            $this->assign('oneList',$List);
            $this->display();
        }else{
            $this->error();
        }

    }
    //获取文章页面点击量
    public function getHits(){
        $id=I('id','intval');
        $Article = M("Article");
        $Article->where('id='.$id)->setInc('hits',1); // 文章阅读数加1
        $Hits=$Article->where('id='.$id)->getfield('hits');
        echo $Hits;
    }

    //把数据库写入S缓存，不用查库  测试用
    public function index2(){
        $id=I('id','intval');
        echo 1111;
        $Article = M("Article")->where('id='.$id)->setInc('hits',1); // 文章阅读数加1
        if(!$oneList= S('List')){
            $List=D('ArticleRelation')->relation('Data')->find($id);
            $oneList=S('List',$List,30);
            $this->assign('oneList',$List);
        }else{
            $this->assign('oneList',$oneList);
        }
        $this->display();
    }

    //404页面
    public function error(){
        $map['status']=1;
        $order='hits Desc';
        $User = M('Article');
        $list = $User->where($map)
            ->field('id,title,add_time,introduce,tags,status,hits,update_time,user_name,thumb')
            ->order($order)
            ->limit(20)
            ->select();
        //把Tags数据json格式化数组对象
        foreach($list as $value =>$key){
            $list[$value]['tags']=json_decode($list[$value]['tags'],true);
        }

        $this->assign('list',$list);// 赋值数据集
        $this->display('Show/error');
    }

    //
    public function cs(){
        $map['nature'][]['nature_id']=5;
//        $map['nature']['nature_id']=5;
        $a=D('ArticleRelation')->relation(true)->where($map)->order('id Desc')->limit(10)->select();
       P($a);
    }
    //测试查询推荐位为2的N条列表
    public function cs2(){
        $map['nature_id']=5;
        $a=D('NatureView')->where($map)->order('id Desc')->limit(10)->select();
        P($a);
    }
}