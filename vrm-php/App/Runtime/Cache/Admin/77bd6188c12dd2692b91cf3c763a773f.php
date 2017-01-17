<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>帐号用户组管理</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="__PUBLIC__/admin/style/common.css" rel="stylesheet" type="text/css" />
        <script src="__PUBLIC__/common/js/jquery.js" language="javascript" type="text/javascript"></script>
        <script src="__PUBLIC__/common/js/common.js" language="javascript" type="text/javascript"></script>
    </head>
    <body>
        <div id="indexmian">
            <div id="indextitle">帐号用户组管理 </div>
            <div id="indexmain">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#D6D6D6" align="center">
                    <tr>
                        <td height="32"  class="td_title td_head">
                            <span style="text-align: right;"><input type="button" onclick="window.location.href = '<?php echo U('group/add');?>';" value="新增用户组" class="btn2"/></span>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D6D6D6">
                    <tr class="tr_hui" height="30" align="center">
                        <td width="5%">
                            <b>级别</b>
                        </td>
                        <td width="20%">
                            <b>用户组名称</b>
                        </td>
                        <td width="15%">
                            <b>修改日期</b>
                        </td>
                        <td width="30%">
                            <b>权限描述</b>
                        </td>
                        <td width="30%">
                            <b>操作</b>
                        </td>
                    </tr>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_white">
                            <td align="center"><?php echo ($vo['id']); ?></td>
                            <td align="center" height="30"><?php echo ($vo['groupname']); ?></td>
                            <td align="center" height="30"><?php echo (date('Y-m-d H:i:s',$vo['updata_time'])); ?></td>
                            <td align="center" height="30"><?php echo ($vo['groupinfo']); ?></td>
                            <td align="center">
                                <input type="button" onclick="window.location.href = '<?php echo U('group/edit',array('id'=>$vo['id']));?>';" value="修改权限" class="btn1"/>
                                <input type="button" onclick="DoNote('确认删除【<?php echo ($vo["groupname"]); ?>】吗？','<?php echo U('group/del',array('id'=>$vo['id']));?>');" value="删除权限" class="btn1"/>
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