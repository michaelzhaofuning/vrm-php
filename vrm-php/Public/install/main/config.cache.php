<?php

return array(
    "DB_TYPE" => "mysql", //数据库类型 
    "DB_HOST" => "__HOST__", //数据库服务器地址 
    "DB_NAME" => "__DBNAME__", //数据库名称 
    "DB_USER" => "__DBUSER__", //数据库用户名 
    "DB_PWD" => "__DBPWD__", //数据库用户密码 
    "DB_CHARSET" => "utf8",
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => '__FIX__', // 数据库表前缀
    
    'UPLOAD_FILE' => '/uploads', //上传目录
    'UPLOAD_BAG' => '/station', //上传暂存目录
    
    'APP_GROUP_LIST' => 'Home,Admin,Member,Uploader,Install', //项目分组设定
    'DEFAULT_GROUP' => 'Home', //默认分组
    
    'SESSION_OPTIONS' => array('path'=>APP_ROOT."/session"),

    "URL_CASE_INSENSITIVE" => TRUE, //URL是否不区分大小写 
    "URL_MODEL" => 2 //URL访问模式支持 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE 模式);3 (兼容模式)  
);
?>
