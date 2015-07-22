<?php
namespace Blog\Controller;
use Think\Controller;
use MyLibrary\Page;
/**
 * Class IndexController
 * @package Blog\Controller博客首页
 */
class IndexController extends CommonController {
    /**
     * 显示首页
     */
    public function index(){
        $map['status']=1;
        $order='add_time Desc';
        $User = D('ArticleView');
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,20);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($map)
            ->field('id,title,add_time,tags,introduce,status,hits,update_time,user_name,thumb')
            ->order($order)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach($list as $value =>$key){
            $list[$value]['tags']=json_decode($list[$value]['tags'],true);
        }

        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
}