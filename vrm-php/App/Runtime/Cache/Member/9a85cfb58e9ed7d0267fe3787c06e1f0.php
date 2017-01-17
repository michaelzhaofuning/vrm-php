<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript">
            function repassword(){
                var m1 = $("#mi1").val();
                var m2 = $("#mi2").val();
                if(m1 == ""||m2 == ""){
                    showMsg('密码不可以为空！',0);
                }else if(m1 != m2){
                    showMsg('两次密码不相同！',0);
                }else{
                    $.ajax({
                        url:"<?php echo U('repassword');?>",
                        type:"POST",
                        dataType:"script",
                        data:{
                            mm:m1
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
        <?php echo W("Bg");?>
		<?php echo W("Uploader");?>
        <div id="upmain">
            <div class="ban">
                <div class="ban_top"></div>
                <div class="ban_mid">
                    <div class="ban_title">帐号信息</div>
					<form method="post" enctype="multipart/form-data" action="" name="form1">
                    <table width="100%"  class="tb">
                        <tbody>
                            <tr height="32">
                                <td width="120" align="right"><b>我的帐号：</b></td>
                                <td><?php echo ($row['account']); ?></td>
                            </tr>
							<tr height="32">
                                <td width="120" align="right"><b>我的头像：</b></td>
                                <td>
								<div id="imageimg" class="headimgdiv">
									<?php if(!empty($row['headimg'])): ?><img class="headimg" src="<?php echo ($row['headimg']); ?>">
									<?php else: ?>
									<img class="headimg" src="__PUBLIC__/member/images/common/no_img.jpg"><?php endif; ?>
								</div>
								<div class="uploaddiv">
									<div>250 X 250 像素以上<br>大小不超过2M<br>支持格式: JPG/PNG.</div>
									<div style="margin-top:30px;"><input id="imagebtn" class="btn" type="button" value="点击上传"></div>							
								</div>
								<input type="hidden" id="image" name="image" value="<?php echo ($row['headimg']); ?>" />
								<input type="hidden" name="old_image" value="<?php echo ($row['headimg']); ?>" />
								<script type="text/javascript">
									$(function(){
										$("#imagebtn").uploader("image", "image");
									})
									function image(data){
										$("#image").val(data);
										$("#imageimg").html('<img src="'+data+'" onload="photocenterin(this,150,150)" />');
									}
								</script>
								</td>
                            </tr>

                            <!-- <tr height="32">
                                <td align="right"><b>修改密码：</b></td>
                                <td>
                                    <input type="password" id="mi1" class="ban_input short" style="float: left;" value="" />
                                </td>
                            </tr>
                            <tr height="32">
                                <td align="right"><b>重复密码：</b></td>
                                <td>
                                    <input type="password" id="mi2" class="ban_input short" style="float: left;" value="" />
                                </td>
                            </tr> -->
                            <tr height="32">
                                <td align="right"><b>昵称：</b></td>
                                <td>
                                    <input class="ban_input short" name="nickname" style="float: left;" value="<?php echo ($row['nickname']); ?>"/>
                                </td>
                            </tr>
                            <tr height="32">
                                <td align="right"><b>手机号：</b></td>
                                <td>
                                    <input class="ban_input short" name="phone" style="float: left;" value="<?php echo ($row['phone']); ?>"/>
                                </td>
                            </tr>                            
							<tr height="32">
                                <td align="right"><b>QQ号码：</b></td>
                                <td>
                                    <input class="ban_input" name="qq" style="float: left;" value="<?php echo ($row['qq']); ?>" />
                                </td>
                            </tr>
							<tr height="32">
                                <td align="right"><b>邮箱：</b></td>
                                <td>
                                    <input class="ban_input" name="email" style="float: left;" value="<?php echo ($row['email']); ?>" />
                                </td>
                            </tr>
							<tr height="32">
                                <td align="right"><b>公司名称：</b></td>
                                <td>
                                    <input class="ban_input" name="company" style="float: left;" value="<?php echo ($row['company']); ?>" />
                                </td>
                            </tr>
							<tr height="32">
                                <td align="right"><b>公司网址：</b></td>
                                <td>
                                    <input class="ban_input" name="company_url" style="float: left;" value="<?php echo ($row['company_url']); ?>" />
                                </td>
                            </tr>
							<tr height="32">
                                <td align="right"><b>公司LOGO：</b></td>
                                <td>
									<div class="thumbbox" style="cursor: pointer; height: auto;">
									<?php if(!empty($row['company_logo'])): ?><img id="company_logo_pic" src="<?php echo CC('web_root'); echo ($row['company_logo']); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" title="点击图片重新上传" onload="swichimg2w(this,200);"/>
									<?php else: ?>
										<img id="company_logo_pic" src="__PUBLIC__/member/images/login/lg_logo.gif" title="点击上传"/><?php endif; ?>									
									</div>
									<span>(建议尺寸：210*70)</span>
									<input type="hidden" id="company_logo" name="company_logo" value="<?php echo ($panorow['company_logo']); ?>" />
									<input type="hidden" id="old_company_logo" name="old_company_logo" value="<?php echo ($panorow['company_logo']); ?>" />
                                </td>
                            </tr>
							<?php echo uploadSend(".thumbbox","#company_logo","#company_logo_pic");?>

							<tr height="32">
                                <td align="right"><b>个人介绍：</b></td>
                                <td>
									<textarea class="ben_textbox" name="intro" style="width: 350px; height: 100px;"><?php echo ($row['intro']); ?></textarea>
                                </td>
                            </tr>

                            <tr height="32">
                                <td align="right"><b>注册日期：</b></td>
                                <td>
                                    <?php echo (date('Y-m-d H:i:s',$row['create_time'])); ?>
                                </td>
                            </tr>

							<tr height="32">
                                <td align="right">&nbsp;</td>
                                <td>
									<input type="hidden" name="dopost" value="save">
									<input type="submit" value="保 存" class="btn1"></div>
                                </td>
                            </tr>
							</tbody>
                    </table>
					</form>
                </div>
                <div class="ban_down"></div>
            </div>
        </div>
    </body>
</html>