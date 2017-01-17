<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="__PUBLIC__/admin/style/common.css" rel="stylesheet" type="text/css" />
        <script src="__PUBLIC__/common/js/jquery.js" language="javascript" type="text/javascript"></script>
        <script src="__PUBLIC__/common/js/common.js" language="javascript" type="text/javascript"></script>
    </head>
    <body>
        <div id="indexmian">
            <div id="indextitle">管理员帐号管理 </div>
            <div id="indexmain">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D6D6" align="center">
                    <tr>
                        <td height="32"  class="td_title td_head">
                            <span style="text-align: right;"><input type="button" onclick="window.location.href = '<?php echo U('control/add');?>';" value="新增管理员" class="btn2"/></span>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D6D6D6">
                    <tr class="tr_hui" height="30" align="center">
                        <td width="5%">
                            <b>ID</b>
                        </td>
                        <td width="15%">
                            <b>管理员帐号</b>
                        </td>
                        <td width="10%">
                            <b>管理员昵称</b>
                        </td>
                        <td width="15%">
                            <b>注册日期</b>
                        </td>
                        <td width="15%">
                            <b>登录时间</b>
                        </td>
                        <td width="10%">
                            <b>最后登录IP</b>
                        </td>
                        <td width="25%">
                            <b>操作</b>
                        </td>
                    </tr>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_white">
                            <td align="center"><?php echo ($vo['id']); ?></td>
                            <td align="center" height="30"><?php echo ($vo['account']); ?></td>
                            <td align="center" height="30"><?php echo ($vo['nickname']); ?></td>
                            <td align="center" height="30"><?php echo (date('Y-m-d H:i:s',$vo['create_time'])); ?></td>
                            <td align="center" height="30"><?php echo (date('Y-m-d H:i:s',$vo['last_login_time'])); ?></td>
                            <td align="center" height="30"><?php echo ($vo['last_login_ip']); ?></td>
                            <td align="center">
                                <input type="button" onclick="window.location.href = '<?php echo U('control/edit',array('id'=>$vo['id']));?>';" value="修改" class="btn1"/>
                                <input type="button" onclick="DoNote('确认删除【<?php echo ($vo["account"]); ?>】吗？','<?php echo U('control/del',array('id'=>$vo['id']));?>');" value="删除" class="btn1"/>
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