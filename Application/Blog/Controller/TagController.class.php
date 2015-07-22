<?php
namespace Blog\Controller;
use Think\Controller;
use MyLibrary\Page;
/**
 * Class IndexController
 * @package Blog\Controller博客首页
 */
class TagController extends CommonController {
    /**
     * 显示首页
     */
    public function index(){

        $map['tag_name']=I('name');
        $map['status']=1;
        $map2['name']=I('name');
        $order='add_time Desc';
        if(!M('ArticleTag')->where($map2)->find()){
            A('Show')->error();
        }

        //写入缓存，
        if(!$list=S('tag_'.$map['tag_name'])){
            $User = D('TagView');
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

            $list=S('tag_'.$map['tag_name'],$cateList,30);
            $this->assign('list',$cateList);// 赋值数据集
        }else{
            $this->assign('list',$list);// 赋值数据集
        }
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

}