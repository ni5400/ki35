<?php
return array(
    //设置模版替换变量 注意 __ROOT__.'/'.APP_PATH 里的 '/'不能省掉
    'TMPL_PARSE_STRING'=>array(
        '__PUBLIC__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'View/static',
        '__CSS__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/css',
        '__JS__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/js',
        '__IMG__'=>__ROOT__.'/'.APP_PATH.MODULE_NAME.'/View/static/images',

    ),
    //COOKIE密钥
    //模板相关设置
    'TAGLIB_BEGIN'          =>  '<{',  // 标签库标签开始标记
    'TAGLIB_END'            =>  '}>',  // 标签库标签结束标记
    'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记
    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
    //需要配置开启LAYOUT_ON 参数（默认不开启），并且设置布局入口文件名LAYOUT_NAME（默认为layout）。
//    'LAYOUT_ON'=>true,
//    'LAYOUT_NAME'=>'layout',

);