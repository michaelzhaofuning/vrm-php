<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="__PUBLIC__/admin/style/common.css" rel="stylesheet" type="text/css" />
        <script src="__PUBLIC__/common/js/jquery.js" language="javascript" type="text/javascript"></script>
        <script src="__PUBLIC__/common/js/common.js" language="javascript" type="text/javascript"></script>
        <script type="text/javascript">
            function checksb(){
                var result = true;
                if(result == true){
                    result = AutoCheckSub(".cs");
                }
                return result;
            }
        </script>
    </head>
    <body>
        <div class="main">
            <form name='form1' method='post' onsubmit="return checksb();">
                <input type='hidden' name='dopost' value='save'/>
                <input type='hidden' name='id' value="<?php echo ($row['id']); ?>"/>
                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D6D6D6" align="center">
                    <tr>
                        <td class="td_title" height="26" style="padding-left:10px;">
                            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr> 
                                    <td width="24%" class="td_p8"><b>修改管理员</b> </td>
                                    <td width="76%" class="td_pr8" align="right">
                                        <input type="button" onclick="window.location.href='<?php echo ($backurl); ?>'" value="返回管理" class="btn2"/>
                                    </td>
                                </tr>
                            </table>
                        </td>                            
                    </tr>
                    <tr class="tr_white">
                        <td align="center" style="padding-top: 20px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                    <td width="120" height="40" align="right"><b>管理员帐号：</b></td>
                                    <td align="left" class="td_p8">
                                        <?php echo ($row['account']); ?>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td align="right" width="120"><b>设置密码：</b></td>
                                    <td align="left" class="td_p8">
                                        <input type="text" id="password" tname="密码" value="" name="password"/>（不填写则不修改密码！）
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td align="right" width="120"><b>管理员昵称：</b></td>
                                    <td align="left" class="td_p8">
                                        <input type="text" class="cs" id="nickname" tname="昵称" value="<?php echo ($row['nickname']); ?>" name="nickname"/>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td align="right" width="120"><b>管理员权限：</b></td>
                                    <td align="left" class="td_p8">
                                        <select name="group_id">
                                            <?php echo CteatSelect($row['group_id'],$garr);;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr> 
                                    <td colspan="2" height="10"></td>
                                </tr>

                                <tr> 
                                    <td height="50" align="center">&nbsp;</td>
                                    <td height="50"  style="text-align:left;">
                                        <input  class="btn1" type="submit" value="保存"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>                    
                </table>                
            </form>
        </div>
    </body>
</html>