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
        <script type="text/javascript">
            function checksb(){
                var result = true;
                if(result == true){
                    result = AutoCheckSub(".cs");
                }
                return result;
            }
            $(document).ready(function(){

            });
        </script>
        <style>
            #imgbox{
                background: url(__PUBLIC__/member/images/common/psbg.png); float: left;
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
                        <div class="title">导航样式管理</div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <a class="pano_menu_bottom me">系统导航</a>
                            <a href="<?php echo U('daohang/manage_my');?>" class="pano_menu_bottom">我的导航</a>
                        </div>
                        <div class="none_main">
                            <div class="action_main">
                                <div class="action_title"><a href="<?php echo U('index');?>">导航样式</a> - 添加</div>
                                <form name="form1" action="" onsubmit="return checksb();" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="dopost" value="save" />
                                    <table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
                                        <tr class="tr_white" height="40">
                                            <td align="right" width="120"><b>导航样式名称：</b></td>
                                            <td align="left">
                                                <input type="text" id="bgname" name="bgname" value="" sbname="导航样式名称" class="inputcube cs"/>
                                            </td>
                                        </tr>
                                        <tr class="tr_white" height="40">
                                            <td align="right" width="120"><b>背景图片上传：</b></td>
                                            <td align="left">												
												<input type="hidden" id="file" name="file" value="" />
                                                <input type="button" id="imgbtn" class="btn3" value="点击上传" />
                                                <font color="red">（请使用png图片）</font>
                                            </td>
                                        </tr>
                                        <tr class="tr_white" height="10">
                                            <td align="right" width="120"></td>
                                            <td align="left">
                                                <div id="imgbox"></div>
                                            </td>
                                        </tr>
                                        <script type="text/javascript">
                                            $(function(){
                                                $("#imgbtn").uploader("image", "file");
                                            })
                                            function file(data){
                                                $("#file").val(data);
                                                $("#imgbox").html('<img src="'+data+'"" />');
                                            }
                                        </script>
                                        <tr class="tr_white" height="40">
                                            <td align="right" width="120"></td>
                                            <td align="left">
                                                <input type="submit" class="blackbutton" value="提交" />
												&nbsp;&nbsp;<a href="<?php echo U('daohang/manage_my');?>">返回列表</a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
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