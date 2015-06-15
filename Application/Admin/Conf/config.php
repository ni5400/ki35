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

);