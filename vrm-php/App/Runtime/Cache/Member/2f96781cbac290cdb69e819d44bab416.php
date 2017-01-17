<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/boluoui/js/boluo.js"></script>
        <?php echo W("Easyui");?>
        <?php echo W("Uploader");?>
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

                                <div style="margin-bottom: 7px;margin-top: 5px;">
								&nbsp;&nbsp;<a href="<?php echo U('navadd',array('pano_id'=>$pano_id));?>" style="text-decoration:none;">【添加导航】</a>
								</div>


								<table width="100%" cellspacing="1" cellpadding="2" border="0" bgcolor="#c6c6c6">
									<tbody>
									<tr class="tr_hui" align="center" height="36">
									<td width="5%">
                                        <b>名称</b>
                                    </td>
                                    <td width="40%">
                                        <b>链接</b>
                                    </td>
                                    <td width="10%">
                                        <b>打开方式</b>
                                    </td>									
                                    <td width="10%">
                                        <b>窗口宽/高</b>
                                    </td>
									<td width="10%">
                                        <b>排序</b>
                                    </td>
                                    <td width="10%">
                                        <b>操作</b>
                                    </td>
                                </tr>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_white" height="36">
									<td align="center"><?php echo ($vo["navname"]); ?></td>
									<td align="center">
									<?php if($vo['opentype'] == 2): ?><a href="<?php echo ($vo["linkurl"]); ?>" target="_blank"><?php echo ($vo["linkurl"]); ?></a>
									<?php else: ?>
										无<?php endif; ?>
									</td>
									<td align="center">
									<?php if($vo['opentype'] == 1): ?>图文弹框<?php endif; ?>
									<?php if($vo['opentype'] == 2): ?>外部链接<?php endif; ?>
									<?php if($vo['opentype'] == 3): ?>系统留言<?php endif; ?>
									</td>									
									<td align="center"><?php if($vo['opentype'] == 1): echo ($vo["iframewidth"]); ?>px/<?php echo ($vo["iframeheight"]); ?>px<?php else: ?>无<?php endif; ?></td>
									<td align="center"><?php echo ($vo["listorder"]); ?></td>
									<td align="center">
										<input onclick="LinkTo('/member/Daohang/edit/id/<?php echo ($vo['id']); ?>');" class="btn1" value="编辑" type="button">
										<input type="button" onclick="boluo_Do('确认删除【<?php echo ($vo["navname"]); ?>】吗？','<?php echo U('del',array('id' =>$vo['id'],'pano_id'=>$vo['pano_id']));?>');" class="btn1" value="删除"/>
									</td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>									

									</tbody>
									</table>
                                    
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
    </body>
</html>