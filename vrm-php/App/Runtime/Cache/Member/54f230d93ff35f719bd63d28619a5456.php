<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo CC('web_name');?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=9"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/index.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/member/js/index.js"></script>
    </head>
    <body>
        <div id="top">
            <div id="logo"></div>
            <div id="toplast">
                <span><?php echo ($minfo["account"]); ?></span>
                <a href="<?php echo U('login/logout');?>">退出</a>
            </div>
        </div>
        <div id="leftbox">
            <?php echo ($menuhtml); ?>
            <div id="onoffbtn">
                <div id="arrow"></div>
                <div id="arrowtext">收起菜单</div>
            </div>
        </div>
        <div class="rightbox">
            <iframe id="main" class="main" name="main" frameborder="0" src="<?php echo U('main/index');?>" scrolling="auto"></iframe>
        </div>
    </body>
</html>