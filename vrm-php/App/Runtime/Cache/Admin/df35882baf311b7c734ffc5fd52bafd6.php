<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="__PUBLIC__/admin/style/common.css" rel="stylesheet" type="text/css" />
        <link href="__PUBLIC__/common/style/common.css" rel="stylesheet" type="text/css" />
        <script src="__PUBLIC__/common/js/jquery.js" language="javascript" type="text/javascript"></script>
		<script src="__PUBLIC__/common/js/common.js" language="javascript" type="text/javascript"></script>
        <style type="text/css">
            .topbox{
                overflow: hidden;
            }
            .downbox{
                overflow: hidden; margin-top: 6px;
            }
            .input2a{
                display:block; text-align: center; text-decoration: none;
            }
            .input2a:hover{
                text-decoration: none;
            }
			.btn3{float: left;}
        </style>
        <script language="javascript" type="text/javascript">

        </script>
    </head>
    <body>
        <div class="main">
            <div class="downbox">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D6D6" align="center">
                    <tr>
                        <td height="32"  class="td_title td_head">
                            <b>制作用户列表 </b>
                        </td>
                    </tr>
                </table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D6D6" align="center">
                    <tr>
                        <td height="32"  class="td_title td_head">
                            <span style="text-align: right;"><input type="button" onclick="window.location.href = '<?php echo U('user/add');?>';" value="新增制作账号" class="btn2"/></span>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D6D6D6">
                    <tr class="tr_hui" height="30" align="center">
                        <td width="5%">
                            <b>ID</b>
                        </td>
                        <td width="20%">
                            <b>用户名称</b>
                        </td>
                        <td width="20%">
                            <b>允许项目数量</b>
                        </td>
						 <td width="20%">
                            <b>当前项目数量</b>
                        </td>
                        <td width="35%">
                            <b>操作</b>
                        </td>
                    </tr>

                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_white">
                            <td align="center"><?php echo ($vo['id']); ?></td>
                            <td align="center"><?php echo ($vo['account']); ?>
							<?php if($vo['status'] == 3): ?><font color="red">(已禁用)</font><?php endif; ?>
							</td>
                            <td align="center" height="30"><?php echo ($vo['pano_limit']); ?></td>
                            <td align="center" height="30"><?php echo ($vo['len']); ?></td>
                            <td align="center">
							<input class="btn1" onclick="window.open('/admin/user/control/id/<?php echo ($vo["id"]); ?>');" value="登录访问" type="button">
							<input class="btn1" onclick="window.location.href = '/admin/user/edit/id/<?php echo ($vo["id"]); ?>';" value="修改" type="button">
							<?php if($vo['status'] == 3): ?><input class="btn1" onclick="window.location.href = '/admin/user/useropened/id/<?php echo ($vo["id"]); ?>';" value="启用" type="button">
							<?php else: ?>
							<input class="btn1" onclick="window.location.href = '/admin/user/userdisabled/id/<?php echo ($vo["id"]); ?>';" value="禁用" type="button"><?php endif; ?>
							<!-- <input class="btn1" onclick="DoNote('确认删除【admin】吗？','/admin/control/del/id/1');" value="删除" type="button"> -->
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
    </body>
</html>