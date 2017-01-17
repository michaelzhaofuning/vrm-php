<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <?php echo W("Easyui");?>
        <?php echo W("Uploader");?>
        <style type="text/css">
            .box{
                width: auto; height: 60px; overflow: hidden; border:1px solid #c6c6c6; margin: 5px; float: left; border-radius: 5px; background: #f3f3f3;
            }
            .boxtext{
                width: 80px; height: 40px; overflow: hidden; float: left; background: #fff; padding: 5px 0;
                text-align: center; font: 12px/20px "微软雅黑"; cursor: default; margin-top: 5px; margin-left: 5px;
            }
            .boxbag{
                width: auto; height: 60px; overflow: hidden; float: left;
            }
            .boxbag .pigbox{
                width: 48px; height: 48px; overflow: hidden; float: left; background: #fff; margin-left: 4px; border:1px solid #ddd;
                box-shadow: 1px 1px 2px #999; margin: 4px 4px;
            }
            .btnbox{
                width: 72px; height: 50px; overflow: hidden; float: left; margin-left: 4px; margin-top: 5px; margin-right: 5px;
            }
        </style>
        <script type="text/javascript">

        </script>
    </head>
    <body>
        <?php echo W("Bg");?>
        <div id="upmain">
            <div class="main">
                <div class="main_head">
                    <div class="main_head_left"></div>
                    <div class="main_head_right"></div>
                    <div class="main_head_main">
                        <div class="title">动态热点设置</div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <a class="pano_menu_bottom me">极简型</a>
                            <a href="<?php echo U('d4');?>" class="pano_menu_bottom">四向型</a>
                            <a href="<?php echo U('d8');?>" class="pano_menu_bottom">八向型</a>
                        </div>
                        <div class="none_main">
                            <div class="action_main" style="background:  #f3f3f3;">
                                <a href="<?php echo U('add2');?>" class="button_add">添加鼠标样式</a>
                                <div class="pano_table">
                                    <?php if(is_array($sysrow)): $i = 0; $__LIST__ = $sysrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sys): $mod = ($i % 2 );++$i;?><div class="box">
                                            <div class="boxtext">
                                                <b>类型</b><br/>极简型
                                            </div>
                                            <div class="boxbag">
                                                <div class="pigbox"><div style="width: <?php echo ($sys['w']); ?>px; height:<?php echo ($sys['h']); ?>px; margin-left:<?php echo ($sys['w']*(-1)/2+24); ?>px; margin-top:<?php echo ($sys['h']*(-1)/2+24); ?>px; overflow:hidden;"><img style="margin-left:<?php echo ($sys['w']*0); ?>px;" src="/Public/material/system/cursor/<?php echo ($sys['file']); ?>/cursor.png" /></div></div>
                                                <div class="pigbox"><div style="width: <?php echo ($sys['w']); ?>px; height:<?php echo ($sys['h']); ?>px; margin-left:<?php echo ($sys['w']*(-1)/2+24); ?>px; margin-top:<?php echo ($sys['h']*(-1)/2+24); ?>px; overflow:hidden;"><img style="margin-left:<?php echo ($sys['w']*(-1)); ?>px;" src="/Public/material/system/cursor/<?php echo ($sys['file']); ?>/cursor.png" /></div></div>
                                            </div>
                                            <div class="btnbox">
                                                <input type="button" style="margin-top: 1px;" class="btn1 me" value="系统" />
                                                <input type="button" style="margin-top: 2px;" class="btn1" value="不可修改" />
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php if(is_array($selfrow)): $i = 0; $__LIST__ = $selfrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$self): $mod = ($i % 2 );++$i;?><div class="box">
                                            <div class="boxtext">
                                                <b>类型</b><br/>极简型
                                            </div>
                                            <div class="boxbag">
                                                <div class="pigbox"><div style="width: <?php echo ($self['w']); ?>px; height:<?php echo ($self['h']); ?>px; margin-left:<?php echo ($self['w']*(-1)/2+24); ?>px; margin-top:<?php echo ($self['h']*(-1)/2+24); ?>px; overflow:hidden;"><img style="margin-left:<?php echo ($self['w']*0); ?>px;" src="/Public/material/self/cursor/<?php echo ($self['member_id']); ?>/<?php echo ($self['file']); ?>/cursor.png" /></div></div>
                                                <div class="pigbox"><div style="width: <?php echo ($self['w']); ?>px; height:<?php echo ($self['h']); ?>px; margin-left:<?php echo ($self['w']*(-1)/2+24); ?>px; margin-top:<?php echo ($self['h']*(-1)/2+24); ?>px; overflow:hidden;"><img style="margin-left:<?php echo ($self['w']*(-1)); ?>px;" src="/Public/material/self/cursor/<?php echo ($self['member_id']); ?>/<?php echo ($self['file']); ?>/cursor.png" /></div></div>
                                            </div>
                                            <div class="btnbox">
                                                <input type="button" style="margin-top: 1px;" class="btn1 me" value="自定义" />
                                                <input type="button" style="margin-top: 2px;" onclick="LinkTo('<?php echo U('del',array('id'=>$self['id']));?>');" class="btn1" value="删除" />
                                            </div>
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