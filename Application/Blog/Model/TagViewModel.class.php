<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-7-9 下午5:30
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Blog\Model;
use Think\Model\ViewModel;

/**
 * Class NatureViewModel
 * @package Blog\Model查询以推荐位id为条件的，新闻信息列表
 */
class TagViewModel extends ViewModel{

    public $viewFields=array(
        'ArticleTagData'=>array(
            'article_id','tag_id',
            '_type'=>'LEFT',
        ),
        'ArticleTag'=>array(
            'title'=>'tag_title','id'=>'tag_id','pid'=>'tag_pid','color'=>'tag_color','name'=>'tag_name',
            '_on'=>'ArticleTagData.tag_id=ArticleTag.id'
        ),
        'Article'=>array(
            'id','catid','title','add_time','status','tags','introduce','thumb','hits','update_time','user_name',
            '_on'=>'ArticleTagData.article_id=Article.id'
        ),
    );

} 