<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-7-9 下午4:15
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Blog\Model;
use Think\Model\RelationModel;
class ArticleRelationModel extends RelationModel{
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
        'nature'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'ArticleNatureData',
            'foreign_key'=>'article_id',
            'mapping_fields'=>'nature_id',
        ),

    );
}