<?php
return array(
	//'配置项'=>'配置值'
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Admin','Home','Member'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',
    //tp页面调试模式开启
    'SHOW_PAGE_TRACE'=>true,


    //数据库配置
    'DB_TYPE'=>'pdo',
    'DB_USER'=>'root',
    'DB_PWD'=>'root',
    'DB_PREFIX'=>'think_',
    'DB_DSN'=>'mysql:host=localhost;dbname=mycms;charset=UTF8',

    //URL模式
    'URL_MODEL'=>2,  // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    'URL_CASE_INSENSITIVE' =>true,  //不区分大小写url


    'LOAD_EXT_CONFIG'       =>'code',  //引入扩展配置文件
    //设置自己的引入扩展类库
    'AUTOLOAD_NAMESPACE' => array(
        'MyLibrary'     => APP_PATH.'MyLibrary',
    ),

    'SHOW_PAGE_TRACE'       =>true, //开启页面调试信息


//    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
//    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
//    'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
//    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
//
//    'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...htmlspecialchars
//
//     //模板相关设置
//    'TAGLIB_BEGIN'          =>  '<{',  // 标签库标签开始标记
//    'TAGLIB_END'            =>  '}>',  // 标签库标签结束标记
//    'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
//    'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记
//    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
);