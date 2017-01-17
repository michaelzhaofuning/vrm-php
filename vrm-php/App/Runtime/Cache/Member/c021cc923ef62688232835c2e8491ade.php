<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>首页</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <?php echo W("Boluoui");?>
        <style>
            .panoimg{width: 120px; height: 90px; overflow: hidden; border:1px solid #dbdbdb;}
			.form-inline .form-group {margin: 4px 8px 4px 0;}
			.form-group {display: inline-block;vertical-align: middle;float:right;}
			.form-control {width: auto;}
			.form-control {border-radius: 0;font-size: 12px;height: 18px;padding: 3px;transition: none 0s ease 0s ;background-color: #ffffff;background-image: none;border: 1px solid #cccccc;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;color: #555555;line-height: 1.42857;vertical-align: middle;}
			.console-searchbar-textinput {min-width: 180px;}
			.btn-primary {background-color: #ffa900;border: 1px solid #ffa900;color: #fff;}
			.alibtn {border-radius: 0;font-size: 12px;height: 26px;line-height: 14px;padding: 5px 16px;-moz-user-select: none;background-image: none;cursor: pointer;display: inline-block;font-weight: normal;margin-bottom: 1px;text-align: center;vertical-align: middle;white-space: nowrap;}
        </style>
		<script type="text/javascript">
		$(document).ready(function(){
			$("#searchform").submit(function(){
				var panoname = $.trim($("#panoname").val());
				if(panoname==""){
					alert("请输入项目名称");
					return false;
				}
			});
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
                        <div class="title">全景项目管理</div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="webpage">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#c6c6c6" align="center">
                                <tr>
                                    <td height="36"  class="td_title" style="border:1px solid #c6c6c6; border-bottom:none; padding: 0px 10px;">
                                        <input type="button" onclick="window.location.href = '<?php echo U('add');?>';" value="添加" class="btn1 me"/>

										<div class="form-group ng-scope">
										<form name="searchform" id="searchform" action="" method="post">
										<input type="text" id="panoname" name="panoname" placeholder="请输入项目名称进行模糊查询" size="36" class="form-control console-searchbar-textinput ng-pristine ng-valid">
										<button class="alibtn btn-primary ng-binding" type="submit">搜索</button>
										</form>
										</div>

                                    </td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#c6c6c6">
                                <tr class="tr_hui" height="36" align="center">
                                    <!-- <td width="5%">
                                        <b>选择</b>
                                    </td> -->
									<td width="5%">
                                        <b>项目编号</b>
                                    </td>
                                    <td width="25%">
                                        <b>项目名称</b>
                                    </td>
                                    <td width="15%">
                                        <b>场景数</b>
                                    </td>
                                    <td width="15%">
                                        <b>创建时间</b>
                                    </td>
                                    <td width="40%">
                                        <b>操作</b>
                                    </td>
                                </tr>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_white" height="36">
                                        <!-- <td align="center"><input type="checkbox" value="<?php echo ($vo['id']); ?>" /></td> -->
                                        <td align="center"><?php echo ($vo['id']); ?></td>
                                        <td align="center"><?php echo ($vo['title']); ?></td>
                                        <td align="center"><?php echo ($vo["num"]); ?></td>
                                        <td align="center"><?php echo (date('Y-m-d H:i:s',$vo['creat_time'])); ?></td>
                                        <td align="center">
											<input type="button" onclick="LinkTo('<?php echo U('view/index',array('pano_id' =>$vo['id']));?>');" class="btn1" value="编辑"/>
											<input type="button" onclick="LinkTo('<?php echo U('config/index',array('pano_id' =>$vo['id']));?>');" class="btn1" value="参数"/>
											<input type="button" onclick="LinkToOpen('<?php echo U('preview/view',array('pano_id' =>$vo['id']));?>');" class="btn1" value="预览"/>
											<input type="button" onclick="openwin('项目生成','/member/putout/index/pano_id/<?php echo ($vo['id']); ?>',800,650);" class="btn1" value="生成静态"/>
											<input type="button" onclick="openwin('说一说','weixin/syslist/pano_id/<?php echo ($vo["id"]); ?>',980,800);" class="btn1" value="说一说(<?php echo ($vo["syscount"]); ?>)"/>
											<input type="button" onclick="boluo_DoNote('确认删除【<?php echo ($vo["title"]); ?>】吗？','<?php echo U('del',array('pano_id' =>$vo['id']));?>','正在删除...');" class="btn1" value="删除"/>
										</td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" align="center">
                                <tr  class="tr_white" align="center">
                                    <td id="page_list" height="60" style="border:1px solid #c6c6c6; border-top: none; padding: 0px 10px;">
                                        <?php echo ($page); ?>
                                    </td>
                                </tr>
                            </table>
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