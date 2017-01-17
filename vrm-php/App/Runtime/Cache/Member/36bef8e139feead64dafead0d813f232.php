<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/jscolor/jscolor.js"></script>
        <?php echo W("Easyui");?>
        <?php echo W("Uploader");?>
		<?php echo W("Kindediter");?>
        <script type="text/javascript">
            function checksb(){
                var result = true;
                if(result == true){
                    result = AutoCheckSub(".cs");
                }
                return result;
            }
			function chk_opentype(type)
			{
				var type=parseInt(type);
				if(type==1){
					$("#opentype_1").show();
					$("#opentype_2").hide();
					$("#opentype_3").hide();
				}
				if(type==2){
					$("#opentype_1").hide();
					$("#opentype_2").show();
					$("#opentype_3").hide();
				}
				if(type==3){
					$("#opentype_1").hide();
					$("#opentype_2").hide();
					$("#opentype_3").show();
				}
			}
            $(document).ready(function(){
                onoroff();
            });
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
                        <div class="title">全景项目 - <?php echo ($panorow['title']); ?></div>
                        <div title="关闭" data-info="确认返回功能首页？" data-url="<?php echo U('main/index');?>" class="delaction close"></div>
                        <div title="返回上级" onclick="LinkTo('<?php echo ($backurl); ?>');" class="goback"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <?php echo W("Panomenu",array("pano_id"=>$pano_id,"num"=>4));?>
                        </div>
                        <div class="none_main">
                            <div class="action_main">
                                <div class="action_title"><a href="<?php echo U('toolbox/index',array('pano_id'=>$pano_id));?>">模块管理</a> - <a href="<?php echo U('index',array('pano_id'=>$pano_id));?>">导航菜单管理</a>
								<span class="vrback"><a href="<?php echo U('toolbox/index',array('pano_id'=>$pano_id));?>">返回上级</a></span></div>
                                
								
								<div class="pano_top">
                                    <a class="pano_topbtn" href="<?php echo U('index',array('pano_id'=>$pano_id));?>">设置</a>
                                    <span class="pano_topbtnb">导航管理</span>
									<a class="pano_topbtn" href="<?php echo U('msglist',array('pano_id'=>$pano_id));?>">留言管理</a>
                                </div>


								<div class="pano_table">
								<div class="action_web">
                                    <form name="form1" action="" enctype="multipart/form-data" method="post">
                                        <input name="dopost" value="save" type="hidden" />
                                        <input name="id" value="<?php echo ($navinfo["id"]); ?>" type="hidden" />
                                        <table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
                                            <tr class="tr_white" height="40">
                                                <td align="right"><b>修改导航&nbsp;</b></td>
                                                <td>
                                                    <a href="<?php echo U('navlist',array('pano_id'=>$pano_id));?>">返回导航列表</a>
                                                </td>
                                            </tr>
											<tr class="tr_white" height="40">
                                                <td align="right"><b>导航名称：</b></td>
                                                <td>
                                                    <input type="text" class="inputcube cs" value="<?php echo ($navinfo['navname']); ?>" name="navname" />
                                                </td>
                                            </tr>											
											<tr class="tr_white" height="40">
                                                <td align="right"><b>排序：</b></td>
                                                <td>
                                                    <input type="text" class="inputcube cs" value="<?php echo ($navinfo['listorder']); ?>" name="listorder" />
                                                </td>
                                            </tr>

											<tr class="tr_white" height="40">
                                            <td align="right" width="120"><b>打开方式：</b></td>
                                            <td align="left">
												<input type="radio" value="1" name="opentype" id="opentype1" onclick="chk_opentype(this.value)" <?php if($navinfo['opentype'] == '1'): ?>checked="true"<?php endif; ?> /><label for="opentype1">图文弹框</label>
                                                <input type="radio" value="2" name="opentype" id="opentype2" onclick="chk_opentype(this.value)" <?php if($navinfo['opentype'] == '2'): ?>checked="true"<?php endif; ?> /><label for="opentype2">外部链接</label>
												<input type="radio" value="3" name="opentype" id="opentype3" onclick="chk_opentype(this.value)" <?php if($navinfo['opentype'] == '3'): ?>checked="true"<?php endif; ?> /><label for="opentype3">留言表单</label>
                                            </td>
											</tr>
											</table>
											
											<div id="opentype_1">
											<table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
											<tr class="tr_white" height="40">
                                                <td align="right" width="80"><b>弹出窗口大小：</b></td>
                                                <td>
													宽：<input type="text" class="shortinputcube" value="<?php echo ($navinfo['iframewidth']); ?>" name="iframewidth" />&nbsp;&nbsp;
													高：<input type="text" class="shortinputcube" value="<?php echo ($navinfo['iframeheight']); ?>" name="iframeheight" />
                                                </td>
                                            </tr>
											
											<tr class="tr_white" height="40">
                                                <td align="right" width="120"><b>图文内容：</b></td>
                                                <td align="left">                                                    
													<script>
													var editor;
													KindEditor.ready(function(K) {
														editor = K.create('textarea[name="content"]', {
															allowFileManager : true,
															width : '830px',
															height: '500px',
															resizeType: 0   //固定宽高
														});
													});
													</script>
													<div style="width:820px;height:500px;border: 1px solid #bbb; overflow: hidden;">
													<textarea id="content" name="content"><?php echo ($navinfo["content"]); ?></textarea>
													</div>
                                                </td>
                                            </tr>
											</table>
											</div>

											<div id="opentype_2" style="display:none;">
											<table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
											<tr class="tr_white" height="40">
                                            <td align="right" width="122"></td>
                                            <td align="left">												
                                                外部链接：<input type="text" class="longinputcube" style="width:500px;" value="<?php echo ($navinfo['linkurl']); ?>" name="linkurl" />
												<br><font color="red">若填写外部链接，点击导航菜单将直接打开该网址</font>
                                            </td>
											</tr>
											</table>
											</div>

											<div id="opentype_3" style="display:none;">
											<table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
											<tr class="tr_white" height="40">
                                            <td align="right" width="122"></td>
                                            <td align="left">												
												系统默认留言模型，留言包括(姓名、QQ、邮箱、电话、内容)
                                            </td>
											</tr>
											</table>
											</div>

											<table width="100%" border="0" cellpadding="4" cellspacing="1" align="center">
                                            <tr class="tr_white" height="40">
                                                <td align="right" width="122"></td>
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
                </div>
                <div class="main_foot">
                    <div class="main_foot_left"></div>
                    <div class="main_foot_right"></div>
                    <div class="main_foot_main"></div>
                </div>
            </div>
        </div>
<script>
chk_opentype("<?php echo ($navinfo['opentype']); ?>");
</script>
    </body>
</html>