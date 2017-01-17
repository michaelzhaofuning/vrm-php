<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <?php echo W("Easyui");?>
        <?php echo W("Boluoui");?>
        <?php echo W("Uploader");?>
        <style type="text/css">
            .box{
                width: auto; height: 50px; overflow: hidden; border:1px solid #c6c6c6; margin: 5px; float: left; border-radius: 5px; background: #eee; cursor: pointer;
            }
            .box.me{
                background: #e0f5ff; border-color: #ace;
            }
            .box:hover{
                background: #e5ffcb;
            }
            .box.me:hover{
                background: #e0f5ff;
            }
            .boxtext{
                width: 60px; height: 36px; overflow: hidden; float: left; background: #fff; padding: 2px 0;
                text-align: center; font: 12px/36px "微软雅黑"; cursor: default; margin-top: 5px; margin-left: 5px;
            }
            .boxbag{
                width: auto; height: 50px; overflow: hidden; float: left; padding-right: 5px;
            }
            .boxbag .pigbox{
                width: 38px; height: 38px; overflow: hidden; float: left; background: #fff; margin-left: 5px; border:1px solid #ccc;
                margin-top: 5px;
            }
            .box.me .boxbag .pigbox{
                border-color: #ace;
            }
            .cursorout{
                overflow: hidden; background: #f8f8f8; padding: 5px; border:1px solid #c6c6c6; float: left; border-radius:5px;
            }
            .cursormarket{
                overflow: hidden;
            }
        </style>
        <script type="text/javascript">
            function checksb(){
                var result = true;
                if(result == true){
                    result = AutoCheckSub(".cs");
                }
                return result;
            }
            $(document).ready(function(){
                onoroff();
                boluo_autocheckui();
                $('.dd').tooltip({
                    position: 'right'
                });

                $(".box").click(function(){
                    var cid = $(this).data("cid");
                    $("#cursor_id").val(cid);
                    checkcurosr(cid);
                });
            });
            function checkcurosr(n){
                $(".box").removeClass("me");
                $("#cursor"+n).addClass("me");
            }
			function submitMap(addr_cur,poi_cur)
			{
				$("#map").val(poi_cur);
				$("#address").val(addr_cur);
				$("#openmap").attr("checked",true);
				closewin();
			}
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
                        <div class="title">全景项目 - <?php echo ($panorow['title']); ?> - 全局参数设定</div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <?php echo W("Panomenu",array("pano_id"=>$pano_id,"num"=>1));?>
                        </div>
                        <div class="none_main">
                            <div class="action_main">
                                <div class="action_title">全局参数设置</div>
                                <div class="action_web">
                                    <form name="form1" action="" onsubmit="return checksb();" enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="dopost" value="save" />
                                        <input type="hidden" name="pano_id" value="<?php echo ($pano_id); ?>" />
                                        <table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
                                            <tr class="tr_white" height="36">
                                                <td align="right" width="100"><b>全景项目名称：</b></td>
                                                <td align="left">
                                                    <input type="text" id="title" name="title" sbname="全景项目名称" value="<?php echo ($panorow['title']); ?>" class="inputcube cs"/>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>启用说一说：</b></td>
                                                <td align="left">
													<input type="checkbox" id="openwechat" name="openwechat" <?php if($panorow['openwechat'] == 1): ?>checked<?php endif; ?> value="1" /> 启用 <span class="textspan">设置<a href="javascript:void(0);" style="text-decoration:underline;" onclick="openwin('微信参数','/member/weixin/',600,500);">微信参数</a></span>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>浏览量统计：</b></td>
                                                <td align="left">
													<input type="checkbox" id="opentongji" name="opentongji" <?php if($panorow['opentongji'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>点赞功能：</b></td>
                                                <td align="left">
													<input type="checkbox" id="openzan" name="openzan" <?php if($panorow['openzan'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>分享功能：</b></td>
                                                <td align="left">
													<input type="checkbox" id="openshare" name="openshare" <?php if($panorow['openshare'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
                                                </td>
                                            </tr>
                                            <tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>官方网站：</b></td>
                                                <td align="left">
													<input type="checkbox" id="openhttp" name="openhttp" <?php if($panorow['openhttp'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
                                                    <input type="text" id="website" name="website" value="<?php echo ($panorow['website']); ?>" class="inputcube"/>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>联系电话：</b></td>
                                                <td align="left">
													<input type="checkbox" id="opentel" name="opentel" <?php if($panorow['opentel'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
                                                    <input type="text" id="linkphone" name="linkphone" value="<?php echo ($panorow['linkphone']); ?>" class="inputcube"/>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>展商名片：</b></td>
                                                <td align="left">
												<input type="checkbox" id="opencard" name="opencard" <?php if($panorow['opencard'] == 1): ?>checked<?php endif; ?> value="1" /> 启用&nbsp;&nbsp;
												<input type="button" onclick="openwin('展商名片','<?php echo U('config/card',array(pano_id=>$pano_id));?>',820,580);" class="btn1" value="名片设置"/>
												</td>
                                                </td>
                                            </tr>

											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>滚动字幕：</b></td>
                                                <td align="left">
												<input type="checkbox" id="opennews" name="opennews" <?php if($panorow['opennews'] == 1): ?>checked<?php endif; ?> value="1" /> 启用<br>
												<textarea style="width: 350px; height: 100px;" class="textacube" name="gundongzimu"><?php echo ($panorow['gundongzimu']); ?></textarea>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>地图坐标：</b></td>
                                                <td align="left">
												<input type="checkbox" id="opendaohang" name="opendaohang" <?php if($panorow['opendaohang'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
												<input type="text" maxlength="255" size="20" value="<?php echo ($panorow['map']); ?>" id="map" name="map" class="inputcube">&nbsp;
												<input type="button" onclick="openwin('地图坐标拾取','<?php echo U('config/getpoint');?>',950,480);" class="btn1" value="点击获取"/>
												</td>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>所在地址：</b></td>
                                                <td align="left">
												<input type="text" id="address" name="address" value="<?php echo ($panorow['address']); ?>" class="inputcube"/>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"></td>
                                                <td align="left" colspan="2"></td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>启用项目开场图片：</b></td>
                                                <td align="left">
												<input type="checkbox" id="openwelcome" name="openwelcome" <?php if($panorow['openwelcome'] == 1): ?>checked<?php endif; ?> value="1" /> 启用 (建议尺寸：500*350)

												<!-- <div class="thumbbox1" style="cursor: pointer;width:480px;height:280px;">
												<?php if(!empty($panorow['welcome'])): ?><img id="welcome_pic" src="<?php echo CC('web_root'); echo ($panorow['welcome']); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" title="点击图片重新上传" onload="swichimg2w(this,200);"/>
                                                <?php else: ?>
													<img id="welcome_pic" width="380px" height="221px" src="__PUBLIC__/member/images/pano/welcome.jpg" title="点击上传"/><?php endif; ?>
												</div> -->

												<div class="thumbbox1" id="imgbox" style="cursor: pointer;width:480px;height:280px;">
													<?php if(!empty($panorow['welcome'])): ?><img src="<?php echo CC('web_root'); echo ($panorow['welcome']); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" onload="swichimg2w(this,200);"/><?php endif; ?>		
												</div>
												<input type="button" id="imgbtn" class="btn3" value="点击上传" />

                                                <input type="hidden" id="welcome" name="welcome" value="<?php echo ($panorow['welcome']); ?>" />
												<input type="hidden" id="old_welcome" name="old_welcome" value="<?php echo ($panorow['welcome']); ?>" />
												</td>
                                            </tr>
											<!-- <?php echo uploadSend(".thumbbox1","#welcome","#welcome_pic");?> -->
											<script type="text/javascript">
                                            $(function(){
                                                $("#imgbtn").uploader("image", "file");
                                            })
                                            function file(data){
                                                $("#welcome").val(data);
                                                $("#imgbox").html('<img width="200" height="200" src="'+data+'"" />');
                                            }
											</script>
											<tr class="tr_white" height="10">
                                                <td colspan="2"></td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>启用本项目LOGO：</b></td>
                                                <td align="left">
												<input type="checkbox" id="openpanologo" name="openpanologo" <?php if($panorow['openpanologo'] == 1): ?>checked<?php endif; ?> value="1" /> 启用  (建议尺寸：210*70)显示在项目左上角位置

												<!-- <div class="thumbbox2" style="cursor: pointer; height: auto;">
												<?php if(!empty($panorow['pano_logo'])): ?><img id="pano_logo_pic" src="<?php echo CC('web_root'); echo ($panorow['pano_logo']); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" title="点击图片重新上传" onload="swichimg2w(this,200);"/>
                                                <?php else: ?>
													<img id="pano_logo_pic" src="__PUBLIC__/member/images/login/lg_logo.gif" title="点击上传"/><?php endif; ?>
												</div> -->
												<div class="thumbbox2" id="imgbox2" style="cursor: pointer; height: auto;">
												<?php if(!empty($panorow['pano_logo'])): ?><img src="<?php echo CC('web_root'); echo ($panorow['pano_logo']); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" onload="swichimg2w(this,200);"/><?php endif; ?>
												</div>
												<input type="button" id="imgbtn2" class="btn3" value="点击上传" />

                                                <input type="hidden" id="pano_logo" name="pano_logo" value="<?php echo ($panorow['pano_logo']); ?>" />
												<input type="hidden" id="old_pano_logo" name="old_pano_logo" value="<?php echo ($panorow['pano_logo']); ?>" />
												</td>
                                                </td>
                                            </tr>
											<!-- <?php echo uploadSend(".thumbbox2","#pano_logo","#pano_logo_pic");?> -->
											<script type="text/javascript">
                                            $(function(){
                                                $("#imgbtn2").uploader("image", "file2");
                                            })
                                            function file2(data){
                                                $("#pano_logo").val(data);
                                                $("#imgbox2").html('<img src="'+data+'"" />');
                                            }
											</script>
											<tr class="tr_white" height="10">
                                                <td colspan="2"></td>
                                            </tr>
											<tr class="tr_white" height="10">
                                                <td align="right" width="100"><b>开启右下角&nbsp;&nbsp;<br>制作者LOGO：</b></td>
                                                <td align="left">
												<input type="checkbox" id="openauthor" name="openauthor" <?php if($panorow['openauthor'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
												<span class="textspan">制作者logo请到<a href="javascript:void(0);" style="text-decoration:underline;" onclick="openwin('账号设置','/member/user/',750,850);">账号信息</a>设置</span>
                                                </td>
                                            </tr>
											

                                            <tr class="tr_white" height="40">
                                                <td align="right"><b>手机陀螺仪：</b></td>
                                                <td>
													<label>
													<input type="checkbox" id="is_ipad_view" name="is_ipad_view" <?php if($panorow['is_ipad_view'] == 1): ?>checked<?php endif; ?> value="1" /> 启用   
													</label>
													<span class="textspan">可以通过手机位置移动来浏览全景</span>
												</td>
                                            </tr>
											<tr class="tr_white" height="40">
                                                <td align="right"><b>小行星开场：</b></td>
                                                <td>
												<label>
													<input type="checkbox" id="is_littleplanet_view" name="is_littleplanet_view" <?php if($panorow['is_littleplanet_view'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
												</label>
												<span class="textspan">开场时以小行星视角进入</span>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="40">
                                                <td align="right"><b>自动切换场景：</b></td>
                                                <td>
													<label>
													<input type="checkbox" id="openautonext" name="openautonext" <?php if($panorow['openautonext'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
													</label>
													<span class="textspan">当无操作 <input type="text" id="autonextpass" name="autonextpass" value="<?php echo ($panorow['autonextpass']); ?>" class="smallinputcube"/> 秒后切换至下一个场景</span>
                                                </td>
                                            </tr>

                                            <tr class="tr_white" height="10">
                                                <td colspan="2"></td>
                                            </tr>                                            
											 <tr class="tr_white" height="40">
                                                <td align="right"><b>场景缩略图大小：</b></td>
                                                <td>
                                                    宽 <input type="text" id="thumbwidth" name="thumbwidth" value="<?php echo ($panorow['thumbwidth']); ?>" class="smallinputcube"/>
                                                    高 <input type="text" id="thumbheight" name="thumbheight" value="<?php echo ($panorow['thumbheight']); ?>" class="smallinputcube"/>
													<span class="textspan">场景选择切换处，默认缩略图大小</span>
												</td>
                                            </tr>
											<tr class="tr_white" height="40">
                                                <td align="right"><b>开启自动旋转：</b></td>
                                                <td>
													<label>
													<input type="checkbox" id="openautorate" name="openautorate" <?php if($panorow['openautorate'] == 1): ?>checked<?php endif; ?> value="1" /> 启用
													</label>
													<span class="textspan">
													浏览场景时，若没有任何操作 <input type="text" id="autoratewaittime" name="autoratewaittime" value="<?php echo ($panorow['autoratewaittime']); ?>" class="smallinputcube"/> 秒后自动执行旋转，
													旋转速度 <input type="text" id="autoratespeed" name="autoratespeed" value="<?php echo ($panorow['autoratespeed']); ?>" class="smallinputcube"/>（0~10，负数代表反方向）
													</span>
                                                </td>
                                            </tr>								
                                                       
                                            <tr class="tr_white" height="40">
                                                <td align="right" width="120"></td>
                                                <td align="left">
                                                    <input type="submit" class="blackbutton" value="提交" />
                                                </td>
                                            </tr>
                                            <tr class="tr_white" height="10">
                                                <td colspan="2"></td>
                                            </tr>
                                        </table>
                                    </form>
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