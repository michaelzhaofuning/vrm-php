<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery-1.4.2.util.js"></script>
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
                onoroff();
                $('.dd').tooltip({
                    position: 'right'
                });
                $('.dd').tooltip({
                    position: 'right'
                });
                $('.leftarrow').tooltip({
                    position: 'top'
                });
                $('.rightarrow').tooltip({
                    position: 'top'
                });
            });
		</script>
        <style>
			.form-inline .form-group {margin: 4px 8px 4px 0;}
			.form-group {display: inline-block;vertical-align: middle;float:right;}
			.form-control {width: auto;}
			.form-control {border-radius: 0;font-size: 12px;height: 18px;padding: 3px;transition: none 0s ease 0s ;background-color: #ffffff;background-image: none;border: 1px solid #cccccc;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;color: #555555;line-height: 1.42857;vertical-align: middle;}
			.console-searchbar-textinput {min-width: 180px;}
			.btn-primary {background-color: #ffa900;border: 1px solid #ffa900;color: #fff;}
			.alibtn {border-radius: 0;font-size: 12px;height: 26px;line-height: 14px;padding: 5px 16px;-moz-user-select: none;background-image: none;cursor: pointer;display: inline-block;font-weight: normal;margin-bottom: 1px;text-align: center;vertical-align: middle;white-space: nowrap;}
			.midonlytext{width:200px;text-align:left;line-height: 24px;}
			.plugin_update_tips{margin: 15px 8px 20px;}
			.mod_conts .set_title {height: 34px;line-height: 34px;}
			.set_title a{color:#26709A;text-decoration:underline;height: 18px;line-height: 18px;padding: 5px 3px;}
			/*color:#26709A;*/
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
                        <div class="title">全景项目 - <?php echo ($panorow['title']); ?></div>
                        <div title="关闭" onclick="DoNote('确认返回功能首页？','<?php echo U('main/index');?>');" class="close"></div>
                    </div>
                </div>
                <div class="main_mid">
                    <div class="main_mid_left"></div>
                    <div class="main_mid_right"></div>
                    <div class="main_mid_main">
                        <div class="pano_menu">
                            <?php echo W("Panomenu",array("pano_id"=>$pano_id,"num"=>2));?>
                        </div>
                        <div class="none_main">
                            <div class="action_main" style="background:  #f3f3f3;min-height:10px;">
                                <div style="">
								<div class="pano_top" style="float: left;">
                                    <a href="<?php echo U('add',array('pano_id'=>$pano_id));?>" class="button_add floatmod">添加全景场景</a>
                                    <a href="<?php echo U('changeview',array('pano_id'=>$pano_id));?>" class="button_add floatmod">设置场景排序</a>
                                    <a href="<?php echo U('firstview',array('pano_id'=>$pano_id));?>" class="button_add floatmod">设置初始场景</a>                                
								</div>
								<div style="float:right;">
									<div class="form-group ng-scope">
										<form name="searchform" id="searchform" action="" method="post">
										<input type="text" id="title" name="title" placeholder="请输入场景名称进行模糊查询" value="<?php echo ($title); ?>" size="36" class="form-control console-searchbar-textinput ng-pristine ng-valid">
										<button class="alibtn btn-primary ng-binding" type="submit">搜索</button>
										<!-- <span style="margin-left: 10px;margin-right: 18px;"><a href="<?php echo U('view/index',array('pano_id'=>$pano_id));?>" style="text-decoration:underline;">全部场景</a></span> -->
										</form>
										
									</div>
								</div>
								</div>
							</div>
							<form name="listForm" action="" method="post">
							<div class="action_main" style="background:  #f3f3f3;padding:1px 10px;">

                                <div class="set_title bbor2">
								<strong>场景分组：</strong>
								<a <?php if(empty($fzid)): ?>style="color:#444444;text-decoration:none;"<?php endif; ?> href="<?php echo U('view/index',array('pano_id'=>$pano_id));?>" style="color:#26709A;">全部场景</a>
								<?php if(is_array($fenzulist)): $i = 0; $__LIST__ = $fenzulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($fzid == $vo[id]): ?>style="color:#444444;text-decoration:none;"<?php endif; ?> href="<?php echo U('view/index',array('pano_id'=>$pano_id,'fzid'=>$vo[id]));?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
								<a href="javascript:;" onclick="openwin('场景分组管理','<?php echo U('view/fenzulist',array('pano_id'=>$pano_id));?>',800,650);" style="text-decoration:none;">&nbsp;&nbsp;【管理分组】</a>
								</div>
								
								<div class="pano_table">
								<?php if(!empty($viewlist)): if(is_array($viewlist)): $i = 0; $__LIST__ = $viewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ovo): $mod = ($i % 2 );++$i;?><div class="pano_cube">
                                            <div class="pano_up">
                                                <div class="pic"><img src="<?php echo CC('web_root'); echo ($ovo["thumb"]); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" onload="photocenterout(this,200,100);" /></div>
                                                <div class="ufo">
                                                    <a href="<?php echo U('edit',array('view_id'=>$ovo['id']));?>" class="ufo_editbox">
                                                        <div class="ufo_ico1"></div>
                                                        <div class="ufo_txt">修改</div>
                                                    </a>
                                                    <div onclick="DoNote('确定删除此场景？','<?php echo U('del',array('view_id'=>$ovo['id']));?>')" class="ufo_delbox">
                                                        <div class="ufo_ico2"></div>
                                                        <div class="ufo_txt">删除</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pano_down">
                                                <div class="midonlytext">
												<input type="checkbox" id="vid_<?php echo ($ovo["id"]); ?>" name="ids[]" value="<?php echo ($ovo["id"]); ?>">
												<?php if(!empty($ovo[fenzuid])): ?><span style="color:#26709a;">[<?php echo ($ovo['fenzuname']); ?>]</span>&nbsp;&nbsp;<?php endif; ?><label for="vid_<?php echo ($ovo["id"]); ?>"><?php echo ($ovo["title"]); ?></label>
												</div>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
									
								<?php else: ?>
								<div class="page_msg mini plugin_update_tips">
									<div class="inner group">尚未添加任何场景&nbsp;&nbsp;请先<a href="/member/view/add/pano_id/<?php echo ($pano_id); ?>" class="a_detail">创建场景</a></div>
								</div><?php endif; ?>								
                                </div>
								<div class="page_msg mini plugin_update_tips">
									<input type="checkbox" id="checkall" onclick="$.checkAll('ids[]',this.checked)"><label for="checkall">全选</label>&nbsp;&nbsp;
									设置分类
									<select id="selAction" name="fzid">
									<option value="">请选择...</option>
									<?php if(is_array($fenzulist)): $i = 0; $__LIST__ = $fenzulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									<option value="-1">取消分组</option>
									</select>
									<input type="submit" class="button" name="btnSubmit" id="btnSubmit" value=" 确定 ">
								</div>								
                            </div>
							</form>
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