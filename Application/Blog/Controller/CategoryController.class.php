<?php
namespace Blog\Controller;
use Think\Controller;
use MyLibrary\Page;
/**
 * Class IndexController
 * @package Blog\Controller博客首页
 */
class CategoryController extends CommonController {
    /**
     * 显示首页
     */
    public function index(){
//        P($_GET);
        $map['catid']=I('cate_id','','intval');
        $map['status']=1;
        $order='add_time Desc';
        //写入缓存，
        if(!$list=S('category_'.$map['catid'])){
            $User = D('ArticleView');
            $count      = $User->where($map)->count();// 查询满足要求的总记录数
            $Page       = new Page($count,20);  // 每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $cateList = $User->where($map)
                ->field('id,title,add_time,tags,introduce,status,hits,update_time,user_name,thumb')
                ->order($order)
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
            //把Tags数据json格式化数组对象
            foreach($cateList as $value =>$key){
                $cateList[$value]['tags']=json_decode($cateList[$value]['tags'],true);
            }
            $list=S('category_'.$map['catid'],$cateList,30);
            $this->assign('list',$cateList);// 赋值数据集
        }else{
            $this->assign('list',$list);// 赋值数据集
        }
        $this->assign('page',$show);// 赋值分页输出
        $this->display();

    }

    //测试用，
    public function cate(){
        $User = D('ArticleRelation')->relation(true);
        $list=$User->limit(2)->order('id Desc')->select();
        $a=M('ArticleNature');
        foreach($list as $value =>$key){
            if($nature=$list[$value]['nature']){
                foreach($nature as $v =>$k){
                    $map['id']=$nature[$v]['nature_id'];
                    $list[$value]['nature'][$v]=array_values($a->where($map)->field('id,color,title')->select());
                }
            }
        }
        P($list);
    }

    //测试用
    public function cate2(){
        $User = D('ArticleRelation')->relation(true);
        $list=$User->limit(2)->order('id Desc')->select();
        $getNodeList=M('ArticleNature')->field('id,pid,title')->select();
//        foreach($content['nature'] as $v=>$k){
//            $content['nature'][$v]=$k['nature_id'];
//        }
        foreach($list as $value=>$key){
            $str='';
            foreach($list[$value]['nature'] as $v=>$k){
                $str.=$k['nature_id'].',';
                $list[$value]['nature'][$v]=$k['nature_id'];
                $list[$value]['nature2']=substr($str,0,-1);
                $map['id']=array('in',$list[$value]['nature2']);
                $list[$value]['nature3']=M('ArticleNature')->where($map)->select();

            }
        }
        P($list);
    }
    //测试用，读取Tag表
    public function cate3(){
        $User = D('ArticleRelation')->relation(true);
        $list=$User->limit(10)->order('id Desc')->select();

        foreach($list as $value=>$key){
            $str='';
            foreach($list[$value]['nature'] as $v=>$k){
                $str.=$k['nature_id'].',';
//                $list[$value]['nature'][$v]=$k['nature_id'];
                $id=substr($str,0,-1);
                if($map['id']=array('in',$id)){
                    $list[$value]['nature']=M('ArticleNature')->where($map)->select();
                }


            }
        }


        P($list);

    }
}