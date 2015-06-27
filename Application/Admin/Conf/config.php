<?php
return array(
    //设置模版替换变量 注意 __ROOT__.'/'.APP_PATH 里的 '/'不能省掉
    'TMPL_PARSE_STRING'=>array(
        '__PUBLIC__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'View/static',
        '__CSS__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/css',
        '__JS__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/js',
        '__IMG__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/images',
        '__DATA__'=>__ROOT__.'/Data',

    ),
    //COOKIE密钥
    //模板相关设置
    'TAGLIB_BEGIN'          =>  '<{',  // 标签库标签开始标记
    'TAGLIB_END'            =>  '}>',  // 标签库标签结束标记
    'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记
    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀

    //Auth权限认证
    'AUTH_CONFIG'=>array(
        'AUTH_ON'           => true,                      // 认证开关
        'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
        'AUTH_GROUP'        => 'auth_group',        // 用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
        'AUTH_RULE'         => 'auth_rule',         // 权限规则表
        'AUTH_USER'         => 'user'             // 用户信息表
    )

);