<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 14-6-27 上午11:07
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */

namespace MyLibrary;
/**
 * Class Category 栏目分类及无限级分类方法
 */
class Category {

    /**反回一维数组开式的无限公类
     * @param $cate
     * @param int $pid
     * @param string $html
     * @param int $level
     * @return array
     */
     public function cate_ollist($cate,$pid=0,$html='--',$level=0){
        $data=array();
        foreach($cate as $v){
            if($v['pid']==$pid){
                $v['level']=$level+1;
                $v['html']=str_repeat($html,$level);
                $data[]=$v;
                $data=array_merge($data,static::cate_ollist($cate,$v['catid'],$html,$level+1));
            }

        }
        return $data;
    }

    /**以多维数组形式的无限分类
     * @param $cate 查询结果
     * @param int $pid 默认0
     * @param string $name  子类默认值child
     * @return array  返回结果集
     */
     public function cate_ullist($cate,$pid=0,$name='child'){
        $data=array();
        foreach($cate as $v){
            if($v['pid']==$pid){
                $v[$name]=static::cate_ullist($cate,$v['id'],$name);

                $data[]=$v;
            }
        }
        return $data;
    }

    /**根据一个子类id获取父类 如首页>>栏目1>>cate2>>cate3
     * @param $cate
     * @param $id
     * @return array
     */
    static public function cate_parents($cate,$id){
        $data=array();
        foreach($cate as $v){
            if($v['id']==$id){
               $data[]=$v;
               //$data[]=static::cate_parents($cate,$v['pid']);
              $data=array_merge(static::cate_parents($cate,$v['pid']),$data);
            }
        }
        return $data;
    }

    /**查询指定父类栏目下的所有了栏目
     * @param $cate
     * @param $id
     * @return array
     */
    static public function cate_child($cate,$id){
        $data=array();
        foreach($cate as $v){
            if($v['pid']==$id){
                $data[]=$v;
                $data=array_merge($data,static::cate_child($cate,$v['id']));
            }
        }
        return $data;
    }

    /**查询指定你父类下所有的子类id
     * @param $cate
     * @param $id
     * @return array
     */
    static public function cate_childid($cate,$id){
        $data=array();
        foreach($cate as $v){
            if($v['pid']==$id){
                $data[]=$v['id'];
                $data=array_merge($data,static::cate_childid($cate,$v['id']));
            }
        }
        return $data;
    }


}