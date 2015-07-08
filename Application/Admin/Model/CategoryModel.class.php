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
class CategoryModel extends Model {
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
        array('ctitle','require','栏目名不能为空',self::EXISTS_VALIDATE),
        array('catalog','require','目录不能为空',self::EXISTS_VALIDATE),
        array('pid','require','栏目归属不能为空',self::EXISTS_VALIDATE),
        array('status','require','状态不能为空',self::EXISTS_VALIDATE),
        array('catalog','','目录名称已经存在！',0,'unique',1),
        array('ctitle', '2,20', '标题长度2-20位！', self::EXISTS_VALIDATE,'length'),
        array('catalog', '3,20', '目录长度2-20位！', self::EXISTS_VALIDATE,'length'),

    );


}