<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="__PUBLIC__/common/style/common.css" rel="stylesheet" type="text/css"/>
        <link href="__PUBLIC__/admin/style/login.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript">
            $(function(){
                $(".ban_border input").focus(function(){
                    $(this).parent(".ban_border").addClass("green");
                });
                $(".ban_border input").blur(function(){
                    $(this).parent(".ban_border").removeClass("green");
                });
            });
            function checksb(){
                var result = true;
                if(result == true){
                    result = AutoCheckSub(".boluo");
                }
                return result;
            }
        </script>
    </head>
    <body>
        <img id="bg" width="100%" height="100%" src="__PUBLIC__/admin/images/login/bg.jpg" />
        <div id="upmain">
            <form name="form1" action="" onsubmit="return checksb();" enctype="multipart/form-data" method="post">
                <input type="hidden" name="dopost" value="login" />
                <div class="logo"></div>
                <div class="ban">
                    <div class="ban_box">
                        <div class="ban_border bb1">
                            <input type="text" class="boluo" value="" placeholder="用户名" sbname="用户名" name="userid" />
                        </div>
                        <div class="ban_border bb2">
                            <input type="password" class="boluo" placeholder="密码" sbname="密码" name="pwd"/>
                        </div>
                    </div>
                    <div class="ban_btn_outer">
                        <input type="submit"  class="ban_btn" value="" />
                    </div>
                </div>
            </form>  
        </div>

    </body>
</html>