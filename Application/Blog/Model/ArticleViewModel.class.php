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

class ArticleViewModel extends ViewModel{

    public $viewFields=array(
        'Article'=>array('id','catid','title','add_time','tags','introduce','status','hits','update_time','user_name','_type'=>'LEFT'),
        'Category'=>array('id'=>'cateid','ctitle','_on'=>'Article.catid=Category.id'),
        'ArticleData'=>array('content','_on'=>'Article.id=ArticleData.aid'),
    );

} 