<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Model;
use Think\Model;

class AuthGroupModel extends Model {
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
        array('title','require','角色名不能为空',self::EXISTS_VALIDATE),
        array('title', '2,20', '角色名长度5-20位！', self::EXISTS_VALIDATE,'length'),
        array('title','','角色名已经存在！',0,'unique'),
    );

    // 限制新增的字段
    protected $insertFields = array('title','status','rules','type');
    // 限制更新时的字段
    protected $updateFields = array('status','rules');

    // 新增角色
    public function add_group($data){
        if(!$this->create($data)) return $this->getError();
        return $this->add($data);
    }

    //获取分组列表字段，和名字
    public function getList($field){
       return $this->field($field)->select();
    }

    //根据id获取信息
    public function getRole($map){
        return $this->field('id,title,status')->where($map)->find();
    }

    public function updata($map){
        return $this->data($map)->save();
    }




}