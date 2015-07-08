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

//节点操作类
class AuthRuleController extends CommonController {

    //添加节点
    public function nodeHandle()
    {
        if(!IS_POST) $this->error('非法操作');
        $data=array(
            'name'=>I('name','','htmlspecialchars,trim'),
            'title'=>I('title','','htmlspecialchars,trim'),
            'remark'=>I('remark','','htmlspecialchars,trim'),
            'condition'=>I('condition','','htmlspecialchars,trim'),
            'pid'=>I('pid','','intval'),
            'level'=>I('level','','intval'),
            'status'=>I('status','','intval'),
        );
        $AuthRule=D('AuthRule');
        if(!$AuthRule->create($data)) $this->error($AuthRule->getError());
        if($result=$AuthRule->add($data)){
            $this->success('添加成功',U('Setting/node_add'));
        }else{
            $this->error('添加失败,请检查错误提示');
        }

    }
    public function nodeEditHandle()
    {
        if(!IS_POST) $this->error('非法操作');
        $data=array(
            'id'=>I('id','','intval'),
            'name'=>I('name','','htmlspecialchars,trim'),
            'title'=>I('title','','htmlspecialchars,trim'),
            'remark'=>I('remark','','htmlspecialchars,trim'),
            'condition'=>I('condition','','htmlspecialchars,trim'),
            'pid'=>I('pid','','intval'),
            'level'=>I('level','','intval'),
            'status'=>I('status','','intval'),
        );

        $AuthRule=D('AuthRule');
        if(!$AuthRule->create($data)) $this->error($AuthRule->getError());
        if($result=$AuthRule->save($data)){
            $this->success('修改成功',U('Setting/node'));
        }else{
            $this->error('添加失败,请检查错误提示');
        }
    }
    //查询是否有子节点存在
    public function nodePid()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        echo $AuthRule=D('AuthRule')->where($data)->count();
    }
    //节点删除
    public function node_del()
    {
        if(!IS_AJAX) $this->error("非法操作");
        $data['pid']=I('id','','intval');
        $map['id']=I('id','','intval');
        $AuthRule=D('AuthRule');
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