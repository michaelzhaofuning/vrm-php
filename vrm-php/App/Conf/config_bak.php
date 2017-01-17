<?php

return array(    
    'UPLOAD_FILE' => '/uploads', //上传目录
    'UPLOAD_BAG' => '/station', //上传暂存目录
    
    'APP_GROUP_LIST' => 'Home,Install', //项目分组设定
    'DEFAULT_GROUP' => 'Install', //默认分组
    
    'SESSION_OPTIONS' => array('path'=>APP_ROOT."/session"),

    "URL_CASE_INSENSITIVE" => TRUE, //URL是否不区分大小写 
    "URL_MODEL" => 2 //URL访问模式支持 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE 模式);3 (兼容模式)  
);
?>
