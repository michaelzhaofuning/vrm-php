<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=100"/>
        <title><?php echo CC("web_name");?> - 后台管理系统</title>
        <link href="__PUBLIC__/admin/style/index.css" rel="stylesheet" type="text/css" />
        <script src="__PUBLIC__/common/js/jquery.js" language="javascript" type="text/javascript"></script>
        <script src="__PUBLIC__/admin/js/index/jquery.tinyscrollbar.js" language="javascript" type="text/javascript"></script>
        <script src="__PUBLIC__/admin/js/index/index.js" language="javascript" type="text/javascript"></script>
        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                cheakWindow();
                $(".button").click(function() {
                    if ($("body").attr("class") == "showmenu") {
                        $("body").attr("class", "hidemenu");
                    } else {
                        $("body").attr("class", "showmenu");
                    }
                });
            });
        </script>
    </head>
    <body class="showmenu">
        <div class="header">
            <div class="header_in">
                <div id="logo"></div>
            </div>
        </div>
        <div class="left">
            <div class="ie7box"></div>
            <div class="leftline"></div>
            <div class="menu" id="menu">
                <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                <div class="viewport">
                    <div class="overview">
                        <div class="nemulist">
                            <ul>
                                <?php echo ($fatherhtml); ?>
                            </ul>
                        </div>
                        <script type="text/javascript">
                            menuListView();
                        </script>
                        <?php echo ($menuhtml); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="ie7box"></div>
            <div class="rightline">
                <div class="righthide"></div>
                <div class="exit"><a href="<?php echo U('login/logout');?>">登出</a></div>
                <div class="userdata">亲，<?php echo session(C("SESSION_NAME"));;?>，欢迎您回来！</div>
            </div>
            <div class="main">
                <iframe id="main" name="main" frameborder="0" src="<?php echo U('user/index');?>" scrolling="auto" ></iframe>
            </div>
        </div>
    </body>
</html>