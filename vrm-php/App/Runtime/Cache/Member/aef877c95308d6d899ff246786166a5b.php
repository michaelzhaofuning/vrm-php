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
        <style type="text/css">
            .nonumtext{
                width: auto; min-width: 24px; height: 20px; overflow: hidden; background: #ccc; text-align: center; margin-top: 1px; cursor: pointer;
                font: 12px/20px "微软雅黑"; color: #fff; position: absolute; border:1px solid #ccc; border-radius:4px; padding: 0 3px;
            }
            .numtext{
                width: auto; min-width: 24px; height: 20px; overflow: hidden; background: #bbb; text-align: center; margin-top: 1px; cursor: pointer;
                font: 12px/20px "微软雅黑"; color: #fff; position: absolute; border:1px solid #aaa; border-radius:4px; padding: 0 3px;
            }
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
                            <?php echo W("Panomenu",array("pano_id"=>$pano_id,"num"=>4));?>
                        </div>
                        <div class="none_main">
                            <div class="action_main" style="background:  #f3f3f3;">
                                <div class="pano_table">

									<div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/daohangcaidan.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('daohang/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">导航菜单模块</div>
                                        </div>
                                    </div>


                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/mapone.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('toolmap/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <?php if(($tmap) == "1"): ?><div class="numtext">开</div><?php endif; ?>
                                            <?php if(($tmap) == "0"): ?><div class="numtext">关</div><?php endif; ?>
                                            <div class="midonlytext">单地图模块</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/mapduo.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('toolmaps/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <?php if(($tmaps) == "1"): ?><div class="numtext">开</div><?php endif; ?>
                                            <?php if(($tmaps) == "0"): ?><div class="numtext">关</div><?php endif; ?>
                                            <div class="midonlytext">多地图模块</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/requ.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('hotpoly/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">多边形热区</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/videodian.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('vpoint/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">视频热点</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/videoqu.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('vspot/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">视频热区</div>
                                        </div>
                                    </div>

                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/intro.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('intro/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">初始提示图片</div>
                                        </div>
                                    </div>

                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/rediantuwen.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('linkspot/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">热点图文</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/zhushi.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('zhuspot/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">注释热点</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/luopan.png" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('luopan/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">罗盘图</div>
                                        </div>
                                    </div>
                                    <div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/videoqu.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('polyvideo/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">热区弹出视频</div>
                                        </div>
                                    </div>
									<div class="pano_cube">
                                        <div class="pano_up">
                                            <div class="pic"><img src="__PUBLIC__/member/images/pano/zhuchiren.jpg" onload="photocenterout(this,200,100);" /></div>
                                            <div class="ufo">
                                                <a href="<?php echo U('zhuchiren/index',array('pano_id'=>$pano_id));?>" class="ufo_previewbox">
                                                    <div class="ufo_longtxt">设置模块</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="pano_down">
                                            <div class="midonlytext">视频主持人</div>
                                        </div>
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