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
//节点管理模型
class AuthRuleModel extends Model {
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
        array('name','require','节点名不能为空',self::EXISTS_VALIDATE),
        array('title','require','节点别名不能为空',self::EXISTS_VALIDATE),
        array('status','require','状态不能为空',self::EXISTS_VALIDATE),
        array('pid','require','父节点不能为空',self::EXISTS_VALIDATE),
        array('level','require','级别不能为空',self::EXISTS_VALIDATE),
        array('name', '4,60', '节点名长度5-100位！', self::EXISTS_VALIDATE,'length'),
        array('title', '2,20', '节点别名长度2-20位！', self::EXISTS_VALIDATE,'length'),
        array('pid', '1,5', '父节点错误', self::EXISTS_VALIDATE,'length'),
        array('level', '1', '级别只能是1位', self::EXISTS_VALIDATE,'length'),
        array('remark', '4,100', '描述长度5-100位！', self::VALUE_VALIDATE,'length'),
        array('condition', '4,100', '描述长度5-100位！',self::VALUE_VALIDATE,'length'),

    );

    // 限制新增的字段
    protected $insertFields = array('id','name','title','status','condition','pid','level','remark');
    // 限制更新时的字段
    protected $updateFields = array('id','name','title','status','condition','pid','level','remark');

    //获取所有列表
    public function getNodeList(){
        return $this->select();
    }




}