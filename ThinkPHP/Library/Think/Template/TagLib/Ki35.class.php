<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-7-14 下午10:56
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */
namespace Think\Template\TagLib;
use MyLibrary\Category;
use Think\Template\TagLib;
//自定义栏目标签库
class Ki35 extends TagLib{
    // 标签定义
    protected $tags  = array(
        //close 1是闭合标签，0是短标签  attr是定义包含的属性
        'category' =>array('attr'=>'limit,order','close'=>1),
        'navigation' =>array('attr'=>'limit,order,pid,status','close'=>1),
        'tags' =>array('attr'=>'limit,order,pid','close'=>1),
        'nature' =>array('attr'=>'limit,order,nature_id,status,','close'=>1),
        'tag' =>array('attr'=>'limit,order,tag_id,status,','close'=>1),
        'list' =>array('attr'=>'limit,order','close'=>1),
        'prev' =>array('attr'=>'limit,order','close'=>1),
        'next' =>array('attr'=>'limit,order','close'=>1),
    );
    //查询导航，及二级导航，制作下拉二级菜单等
    public function _category($tag,$content){
        $limit     = $tag['limit'];
        $order    = $tag['order'];
        $str='<?php ';
        $str.='$cateList=M("Category")->select();';
        $str.='$Category=new MyLibrary\Category();';
        $str.='$cateList=$Category->cate_ullist($cateList);';
        $str.='foreach($cateList as $cateList_v) :';
        $str.='extract($cateList_v);';
        $str.='$url=U("/"."Blog/category_".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    //根据pid的值来查询导航
    public function _navigation($tag,$content){
        $navigationLimit     = $tag['limit'];
        $navigationOrder     = $tag['order'];
        $navigationPid       =$tag['pid'];
        $navigationStatus   =$tag['status'];
        $str='<?php ';
        $str.='$navigationMap["pid"]='.$navigationPid.';';
        $str.='$navigationMap["status"]='.$navigationStatus.';';
        $str.='$navigationList=M("Category")->where($tagMap)->limit("'.$navigationLimit.'")->order("'.$navigationOrder.'")->select();';
        $str.='foreach($navigationList as $navigationList_v) :';
        $str.='extract($navigationList_v);';
        $str.='$url=U("/"."Blog/category_".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    /**
     * @param $tag 调用tag标签
     * @param $content
     * @return string
     */
    public function _tags($tag,$content){
        $tagsLimit     = $tag['limit'];
        $tagsOrder    = $tag['order'];
        $tagspid      = $tag['pid'];
        $str='<?php ';
        $str.='$tagsmap["pid"]='.$tagspid.';';
        $str.='$tagsList=M("ArticleTag")->where($tagsmap)->select();';
        $str.='foreach($tagsList as $tagsList_v) :';
        $str.='extract($tagsList_v);';
        $str.='$url=U("/"."Blog/tag_".$name)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    //查询某推荐位下的多条信息
    public function _nature($tag,$content){
        $naturelimit     = $tag['limit'];
        $natureorder     = $tag['order'];
        $nature_id       =$tag['nature_id'];
        $status   =$tag['status'];
        $str='<?php ';
        $str.='$natruemap["nature_id"]='.$nature_id.';';
        $str.='$natruemap["status"]='.$status.';';
        $str.='$natureList=D("NatureView")->where($natruemap)->limit("'.$naturelimit.'")->order("'.$natureorder.'")->select();';
        $str.='foreach($natureList as $natureList_v) :';
        $str.='extract($natureList_v);';
        $str.='$url=U("/"."Blog/notes/".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    //查询某tag分类下的下的多条信息
    public function _tag($tag,$content){
        $tagLimit     = $tag['limit'];
        $tagOrder     = $tag['order'];
        $tag_id       =$tag['tag_id'];
        $tagStatus   =$tag['status'];
        $str='<?php ';
        $str.='$tagMap["nature_id"]='.$tag_id.';';
        $str.='$tagMap["status"]='.$tagStatus.';';
        $str.='$tagList=D("TagView")->where($tagMap)->field("id,title,add_time,tag_id.tag_title.tag_color,tag_name,tag_pid,introduce,status,hits,update_time,user_name,thumb")->limit("'.$tagLimit.'")->order("'.$tagOrder.'")->select();';
        $str.='foreach($tagList as $tagList_v) :';
        $str.='extract($tagList_v);';
        $str.='$url=U("/"."Blog/tag_".$tag_name)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    //获取当前栏目的list列表，如果当前栏目不存在则获取所有栏目
    public function _list($tag,$content){
        $limit    = $tag['limit'];
        $order    = $tag['order'];
        $str='<?php ';
        $str.='if(I("cate_id","","intval"))  $thisMap["catid"]=array("eq",I("cate_id","intval"));';
        $str.='$aList=M("Article")->field("id,title,hits,add_time,update_time")->where($thisMap)->limit("'.$limit.'")->order("'.$order.'")->select();';
        $str.='foreach($aList as $aList_v) :';
        $str.='extract($aList_v);';
        $str.='$url=U("/"."Blog/notes/".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

    //获取上一/几条数据
    public function _prev($tag,$content){
        $limit    = $tag['limit'];
        $str='<?php ';
        $str.='if(I("id","","intval"))  $thisMap["id"]=array("lt",I("id","intval"));';
        $str.='$prevList=M("Article")->field("id,title")->where($thisMap)->limit("'.$limit.'")->order("id Desc")->select();';
        $str.='foreach($prevList as $prevList_v) :';
        $str.='extract($prevList_v);';
        $str.='$url=U("/"."Blog/notes/".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }
    //获取下一/几条数据
    public function _next($tag,$content){
        $limit    = $tag['limit'];
        $str='<?php ';
        $str.='if(I("id","","intval"))  $thisMap["id"]=array("gt",I("id","intval"));';
        $str.='$nextList=M("Article")->field("id,title")->where($thisMap)->limit("'.$limit.'")->select();';
        $str.='foreach($nextList as $nextList_v) :';
        $str.='extract($nextList_v);';
        $str.='$url=U("/"."Blog/notes/".$id)';
        $str.='?>';
        $str.=$content;
        $str.='<?php endforeach;?>';
        return $str;
    }

}