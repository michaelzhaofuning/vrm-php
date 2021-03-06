<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/pano/pano.js"></script>
        <?php echo W("Easyui");?>
        <?php echo W("Uploader");?>
        <script type="text/javascript">
            var playing = 0;
            var pause = 0;
            $(document).ready(function(){
                $('.dd').tooltip({
                    position: 'top'
                });

                $(".play").click(function(){
                    var temp = $(this).parent().data("checked");
                    if(temp){
                        if(temp == 1){
                            return;
                        }else{
                            stopplay();
                        }
                    }else{
                        stopplay();
                    }
                    if(playing == 0){
                        playing = 1;
                        pause = 0;
                        var music = $(this).data("url");
                        var krpano = document.getElementById("krpano");
                        krpano.call("playsound(bgsnd, '"+music+"', 1,stopme);");
                        $(".play").removeClass("me");
                        $(this).addClass("me");
                        $(this).parent().data("checked",1);
                        $(this).parent().children(".stop").addClass("stoper");
                    }else{
                        showMsg("请先停止，才能重新播放或播放其它！",0);
                    }
                });
                $(".pause").click(function(){
                    var temp = $(this).parent().data("checked");
                    if(temp){
                        if(temp == 1){
                            if(playing == 1){
                                var krpano = document.getElementById("krpano");
                                if(pause == 0){
                                    pause = 1;
                                    $(".pause").removeClass("me");
                                    $(this).addClass("me");
                                    krpano.call("pausesound(bgsnd);");
                                }else{
                                    pause = 0;
                                    $(".pause").removeClass("me");
                                    $(this).data("check",0);
                                    krpano.call("resumesound(bgsnd);");
                                }
                            }
                        }
                    }
                });
                $(".stop").click(function(){
                    var temp = $(this).parent().data("checked");
                    if(temp){
                        if(temp == 1){
                            if(playing == 1){
                                var krpano = document.getElementById("krpano");
                                krpano.call("stopsound(bgsnd);");
                                $(".stoper").removeClass("stoper");
                                $(".play").removeClass("me");
                                $(".pause").removeClass("me");
                                $(this).parent().data("checked",0);
                                playing = 0;
                                pause = 0;
                            }
                        }
                    }
                });
            });
            function stopplay(){
                var krpano = document.getElementById("krpano");
                krpano.call("stopsound(bgsnd);");
                $(".stoper").removeClass("stoper");
                $(".play").removeClass("me");
                $(".pause").removeClass("me");
                playing = 0;
                pause = 0;
                $(".musicbox").data("checked",0);
            }
        </script>
        <style type="text/css">
            .chengbox{
                width: auto; height: 24px; overflow: hidden; border:1px solid #f7db99; border-radius : 5px; text-indent: 10px;
                background: #fffbf3;margin: 5px; font: 12px/24px "微软雅黑"; color: #FFA900; cursor: default;
            }
            .musicbox{
                width: 500px; height: 30px; overflow: hidden; border:1px solid #bbb; border-radius: 5px; margin: 5px; background: #eee;
            }
            .musicbox .title{
                min-width: 200px; height: 22px; overflow: hidden; background: #f8f8f8; font: 12px/22px "微软雅黑"; padding: 0 6px;
                border:1px solid #bbb; margin: 3px; border-radius: 4px; float: left; cursor: default;
            }
            .play{
                width: 24px; height: 24px; overflow: hidden; margin: 3px; cursor: pointer; float: left;
                background: url(__PUBLIC__/member/images/pano/playpic.png) no-repeat;
            }
            .play.me{
                background-position: -27px 0;
            }
            .pause{
                width: 24px; height: 24px; overflow: hidden; margin: 3px; cursor: pointer; float: left;
                background: url(__PUBLIC__/member/images/pano/playpic.png) -53px 0 no-repeat;
            }
            .pause.me{
                background-position: -53px -26px;
            }
            .stop{
                width: 24px; height: 24px; overflow: hidden; margin: 3px; cursor: pointer; float: left;
                background: url(__PUBLIC__/member/images/pano/playpic.png) -80px 0 no-repeat;
            }
            .stoper:hover{
                background-position: -80px -26px;
            }
            .editplay{
                width: 24px; height: 24px; overflow: hidden; margin: 3px; cursor: pointer; float: right; display: block;
                background: url(__PUBLIC__/member/images/pano/playedit.png) 0px 0 no-repeat;
            }
            .delplay{
                width: 24px; height: 24px; overflow: hidden; margin: 3px; cursor: pointer; float: right; display: block;
                background: url(__PUBLIC__/member/images/pano/playedit.png) -30px 0 no-repeat;
            }

            .pano{
                width: 0px; height: 0px; overflow: hidden;
            }
        </style>
    </head>
    <body>
        <?php echo W("Bg");?>
        <div id="upmain">
            <div class="main">
                <div class="main_head">
                    <div class="main_head_left"></div>
                    <div class="main_head_right"></div>
                    <div class="main_head_main">
                        <div class="title">背景音乐管理</div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <a class="pano_menu_bottom me">背景音乐</a>
                        </div>
                        <div class="none_main">
                            <div class="action_main" style="background:  #f3f3f3;">
                                <a href="<?php echo U('add');?>" class="button_add">添加新音乐</a>
                                <div class="pano_table">
                                    <div class="chengbox">添加音乐，才能在制作时调用！</div>
                                    <div id="pano" class="pano"></div>
                                    <script type="text/javascript">
                                        embedpano({
                                            id:"krpano",
                                            swf:"__PUBLIC__/pano/pano.swf",
                                            xml:"<?php echo U('musicxml');?>",
                                            target:"pano",
                                            html5:"auto",wmode:"transparent"
                                        });
                                    </script>
                                    <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$music): $mod = ($i % 2 );++$i;?><div class="musicbox">
                                            <div class="title"><?php echo ($music["title"]); ?></div>
                                            <div class="play" data-url="<?php echo ($music["file"]); ?>"></div>
                                            <div class="pause"></div>
                                            <div class="stop"></div>
                                            <a href="<?php echo U('del',array('id'=>$music['id']));?>" class="delplay easyui-tooltip dd" title="删除音乐"></a>
                                            <a href="<?php echo U('edit',array('id'=>$music['id']));?>" class="editplay easyui-tooltip dd" title="修改音乐"></a>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_foot">
                    <div class="main_foot_left"></div>
                    <div class="main_foot_right"></div>
                    <div class="main_foot_main"></div>
                </div>
            </div>
        </div>
    </body>
</html>