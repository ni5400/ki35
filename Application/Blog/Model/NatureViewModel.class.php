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
class NatureViewModel extends ViewModel{

    public $viewFields=array(
        'ArticleNatureData'=>array(
            'article_id','nature_id',
            '_type'=>'LEFT',
        ),
        'Article'=>array(
            'id','catid','title','add_time','status','introduce','thumb','hits','update_time','user_name',
            '_on'=>'ArticleNatureData.article_id=Article.id'
        ),
    );

} 