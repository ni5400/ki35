<?php
return array(
    //设置模版替换变量 注意 __ROOT__.'/'.APP_PATH 里的 '/'不能省掉
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>__ROOT__.'/Public/Blog/css',
        '__JS__'=>__ROOT__.'/Public/Blog/js',
        '__IMG__'=>__ROOT__.'/Public/Blog/images',
    ),
	//'配置项'=>'配置值'
    'VIEW_PATH'=>'./Template/Blog/' ,// 设置默认的视图层名称
    //标签库引入Cx,html是默认的标签库
    'TAGLIB_PRE_LOAD'=>'Ki35',

    //启用路由功能
    'URL_ROUTER_ON'=>true,
    //配置路由规则
    'URL_ROUTE_RULES'=>array(
        //每条键值对，对应一个路由规则
        'i/:domain'=>'Space/index',
        'category/:cate_id\d'=>'Category/index', //'category/:cate_id'=>'Category/index',  \d代表只能匹配数字
        '/^category_(\d+)$/'=>'Category/index?cate_id=:1',//类似category_22
        'notes/:id\d'=>'Show/index', //博客内容页地址
        'tag/:name'=>'tag/index',  //tag标签地址1，地址类似tag/apache
        '/^tag_(\w+)$/'=>'tag/index?name=:1',//类似tag_apache
        '/search.html'=>'Search/search/',//类似tag_apache
    ),
    //开启静态缓存
    'HTML_CACHE_ON'=>true,
    'HTML_CACHE_RULES'=>array(
//        'Show:index'=>array('{:module}/notes/{id}',0),
//        'Show:error'=>array('{:module}/notes/',0),
    ),
    //动态缓存方式
    'DATA_CACHE_TYPE'=>'file', //tp默认是file缓存  Memcache





);