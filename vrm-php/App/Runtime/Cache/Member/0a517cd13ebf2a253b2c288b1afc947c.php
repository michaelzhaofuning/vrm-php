<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="__PUBLIC__/member/style/common.css" media="screen"/>
        <script type="text/javascript" src="__PUBLIC__/common/js/jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/common/js/common.js"></script>
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
		.main .main_mid .main_mid_main{background:none;}
		.main .main_foot .main_foot_main{background:none;}
		.main .main_foot .main_foot_left{background:none;}
		.main .main_foot .main_foot_right{background:none;}
		.none_main{border: 1px solid #d8d8d8;padding:0px;}
        </style>
    </head>
    <body>
        <div id="upmain">
            <div class="main">
                <div class="main_mid">
                    <div class="main_mid_main">
                        <div class="none_main">
                            <div class="action_main" style="background:  #f3f3f3;">
                                <a target="_blank" href="<?php echo U('view',array('pano_id'=>$pano_id));?>" class="button_add">完整项目预览</a>
                                <div class="pano_table">
                                    <?php if(!empty($viewlist)): if(is_array($viewlist)): $i = 0; $__LIST__ = $viewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ovo): $mod = ($i % 2 );++$i;?><div class="pano_cube">
                                            <div class="pano_up">
                                                <div class="pic"><img src="<?php echo CC('web_root'); echo ($ovo["thumb"]); ?>?<?php echo (date('Y-m-d g:i a',time())); ?>" onload="photocenterout(this,200,100);" /></div>
                                                <div class="ufo">
                                                    <a target="_blank" href="<?php echo U('view',array('pano_id'=>$pano_id,'scene'=>$ovo['sort']));?>" class="ufo_previewbox">
                                                        <div class="ufo_ico3"></div>
                                                        <div class="ufo_txt">预览</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="pano_down">
                                                <div class="midonlytext"><a target="_blank" href="<?php echo U('view',array('pano_id'=>$pano_id,'view_id'=>$ovo['id']));?>"><?php echo ($ovo["title"]); ?></a></div>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php else: ?>
									<div class="page_msg mini plugin_update_tips">
										<div class="inner group">尚未添加任何场景&nbsp;&nbsp;请先<a href="/member/view/add/pano_id/<?php echo ($pano_id); ?>" class="a_detail">创建场景</a></div>
									</div><?php endif; ?>
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