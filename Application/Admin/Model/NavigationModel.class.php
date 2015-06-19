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

//后台首页左侧导航
class NavigationModel extends Model {
    /**
     * @param $type 后台头部菜单类型1为工作台，2为模型，以此按顺序类推
     * @return mixed
     */
    public function getNav($type){
        $map['type']=$type;
        return $this->where($map)->select();
    }
}