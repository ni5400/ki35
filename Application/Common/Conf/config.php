<?php
return array(
	//'配置项'=>'配置值'
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Admin','Home','Member'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>true,

    //数据库配置
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'cms',          // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => 'root',          // 密码
    'DB_PORT'               => '',        // 端口
    'DB_PREFIX'=>'think_',

    //URL模式
    'URL_MODEL'=>1,  // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    'URL_CASE_INSENSITIVE' =>true,  //不区分大小写url


    'LOAD_EXT_CONFIG'       =>'code',  //引入扩展配置文件
    //设置自己的引入扩展类库
    'AUTOLOAD_NAMESPACE' => array(
        'MyLibrary'     => APP_PATH.'MyLibrary',
    ),

    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称

    'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...htmlspecialchars


);