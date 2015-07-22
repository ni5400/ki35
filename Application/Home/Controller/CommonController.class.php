<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */

namespace Home\Controller;
use Think\Controller;
//基类
class CommonController extends Controller {

    public function _empty(){
        $this->error('访问的页面不存在');
    }

}