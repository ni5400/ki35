<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-7-9 下午4:15
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Admin\Model;
use Think\Model\RelationModel;
class ArticleRelationModel extends RelationModel{
    //自动验证
    protected $_validate=array(
        //array(验证字段，验证规则，错误提示，验证条件，附加规则，验证时间) 或者单独留给注册用，登陆单独写规则
        array('title','require','标题名不能为空',self::EXISTS_VALIDATE),
        array('catid','require','栏目不能为空',self::EXISTS_VALIDATE),
        array('status','require','状态不能为空',self::EXISTS_VALIDATE),
        array('title','','标题重复，请更正后再重试！',0,'unique',1),
    );
    //定义主表
    protected $tableName ='Article';
    //定义副表
    protected $_link=array(
        'Data'=>array(
            'mapping_type'=>self::HAS_ONE,
            'foreign_key'=>'aid',
            'class_name'=>'ArticleData',
            'mapping_fields'=>'content', //读取副表的字段
            'as_fields'=>'content' //默认查询副表返回的结果是多维数组，若此询副表的一个字段，用此表，可取消多维数组，直接以只元素返回
            //[name]=>结果  若更改键名name  'as_fields'=>'name：cate'
        ),
        //推荐位表
        'nature'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'ArticleNatureData',
            'foreign_key'=>'article_id',
            'mapping_fields'=>'nature_id',
        ),
        //tag表
        'tag'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'ArticleTagData',
            'foreign_key'=>'article_id',
            'mapping_fields'=>'tag_id',
        ),

    );
}