<?php if (!defined('THINK_PATH')) exit(); echo '<?'; ?>
xml version="1.0" encoding="UTF-8"?>

<krpano showerrors="true" debugmode="true" onstart="action(start);action(fixfov);" idletime="<?php echo ($panorow['autonextpass']); ?>">
    <?php echo "<include"; ?> url="<?php echo U('basexml',array('pano_id'=>$pano_id));?>" />
	<?php echo "<include"; ?> url="%SWFPATH%/plugins/showtext.xml" />
    <?php if($panorow['is_ipad_view'] == 1): ?><plugin name="skin_gyro" keep="true" url="%SWFPATH%/plugins/gyro.js" devices="html5+!firefox" enabled="true" camroll="true" friction="0" velastic="0" onavailable="if(device.fullscreensupport, if(device.mobile,add(layer[skin_btn_gyro].x,40),add(layer[skin_btn_gyro].x,20));); set(layer[skin_btn_gyro].visible,true);" /><?php endif; ?>

    <action name="start">
        loadscene(scene<?php echo ($scene); ?>, null, MERGE);
        <?php if($panorow['open_music'] == 1): ?>playsound(bgsnd, '<?php echo ($musicurl); ?>', 0);<?php endif; ?>
		if(autorotate.enabled == true ,bombtimer(0););
		<?php if($panorow['opennews'] == 'true'): ?>danmurun1();<?php endif; ?>
    </action>

	<plugin name="soundinterface"
	url="__PUBLIC__/pano/plugins/soundinterface.swf"
	alturl="__PUBLIC__/pano/plugins/soundinterface.js"
	rootpath="" preload="true" keep="true" loops="1" />

    <?php if(($strorow['open']) == "1"): ?><layer name="introimage" url="<?php echo CC('web_root'); echo ($strorow['image']); ?>" enabled="true" align="center" onclick="hideintroimage();" keep="true" visible="true" zorder="50000"/>

        <action name="hideintroimage">
            if(layer[introimage].enabled,
                    set(layer[introimage].enabled,false);
                    tween(layer[introimage].alpha, 0.0, 0.5, default, removelayer(introimage));
              );
        </action><?php endif; ?>

    <?php if($panorow['open_music'] == 1 AND $panorow['open_musicbtn'] == 1): ?><plugin name="musicbtn" url="<?php echo CC('web_root'); echo ($panorow['musicpic']); ?>"
             onurl="<?php echo CC('web_root'); echo ($panorow['musicpic']); ?>"
             offurl="<?php echo CC('web_root'); echo ($panorow['musichoverpic']); ?>"
             onalpha="<?php echo ($panorow['alpha']); ?>" outalpha="<?php echo ($panorow['hoveralpha']); ?>" keep="true"
             align="<?php echo ($panorow['musicposto']); ?>" x="<?php echo ($panorow['mpos_x']); ?>" y="<?php echo ($panorow['mpos_y']); ?>" alpha="<?php echo ($panorow['alpha']); ?>" scale="1" onover="tween(alpha,get(onalpha));" onout="tween(alpha,get(outalpha));"
			onclick="pausesoundtoggle(bgsnd); switch(url, get(onurl), get(offurl));"
            />
		<krpano devices="mobile">				
			<plugin name="musicbtn" scale="0.5" altscale="0.5" />
		</krpano><?php endif; ?>

    <?php if($panorow['openautorate'] == 1): ?><autorotate enabled="true" waittime="<?php echo ($panorow['autoratewaittime']); ?>" speed="<?php echo ($panorow['autoratespeed']); ?>" accel="1" horizon="0" tofov="100" />
    <?php else: ?>
    <autorotate enabled="false" /><?php endif; ?>

    <?php if(is_array($sysuirow)): $i = 0; $__LIST__ = $sysuirow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sui): $mod = ($i % 2 );++$i; echo "<include"; ?> url="__PUBLIC__/pano/uistore/<?php echo ($sui["path"]); ?>/skin/skin.xml" /><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php echo "<include"; ?> url="__PUBLIC__/pano/krpanocms.xml?<?php echo time(); ?>" />
	<?php echo "<include"; ?> url="__PUBLIC__/pano/gundongzimu.xml?<?php echo time(); ?>" />
	<?php echo "<include"; ?> url="__PUBLIC__/pano/cms_config.xml?<?php echo time(); ?>" />
	<?php echo "<include"; ?> url="__PUBLIC__/pano/html.xml?<?php echo time(); ?>" />
	<?php if($panorow['openwechat'] == 1): echo "<include"; ?> url="__PUBLIC__/pano/shuoyishuo.xml?<?php echo time(); ?>" />
	<?php echo "<include"; ?> url="__PUBLIC__/pano/hotspotComment.xml?<?php echo time(); ?>" /><?php endif; ?>
	<?php echo "<include"; ?> url="__PUBLIC__/pano/video-player.xml?<?php echo time(); ?>" />

<events onclick="screentosphere(mouse.x,mouse.y,h,v);trace(h);" />
<events onxmlcomplete="set(control.mousetype, moveto);" />
<skin_settings openautonext="<?php echo ($panorow['openautonext']); ?>" thumbs_width="<?php echo ($panorow['thumbwidth']); ?>" thumbs_height="<?php echo ($panorow['thumbheight']); ?>" thumbs_padding="10" thumbs_crop="" krpanocms="true" domainlink="<?php echo ($domainlink); ?>" groupid="1" webvr="true" bgmusic="false" bgyunyin="false" erweima="false" opennews="<?php echo ($panorow['opennews']); ?>" news="<?php echo ($panorow['gundongzimu']); ?>" opentel="<?php echo ($panorow['opentel']); ?>" tel="openurl('tel://<?php echo ($panorow['linkphone']); ?>',_blank)" openhttp="<?php echo ($panorow['openhttp']); ?>" http="openurl('<?php echo ($panorow['website']); ?>',_blank )" opendaohang="<?php echo ($panorow['opendaohang']); ?>" daohang="openurl('http://apis.map.qq.com/uri/v1/geocoder?coord=<?php echo ($panorow[map]); ?>',_blank )" opencard="<?php echo ($panorow['opencard']); ?>" ope_bdmap="" bd_map="" openzan="<?php echo ($panorow['openzan']); ?>" pano_id="<?php echo ($pano_id); ?>"></skin_settings>
<lensflareset name="DEFAULT" url="%SWFPATH%/lensflare/flares.jpg"/>

<?php if(!empty($panorow['openpanologo'])&&!empty($panorow['pano_logo'])): ?><layer name="ui_logo" type="images" url="<?php echo ($panorow['pano_logo']); ?>" keep="true" visible="true" zorder="0" align="lefttop" x="2" y="55" autowidth="" autoheight="" scale="1.0" altscale="1.0" alpha="1" /><?php endif; ?>

<?php if(!empty($panorow['openauthor'])&&!empty($userinfo['company_logo'])): ?><layer name="zj-logo" type="images" url="<?php echo ($userinfo['company_logo']); ?>" keep="true" visible="true" zorder="0" align="rightbottom" x="80" y="30" autowidth="" autoheight="" scale="1.0" altscale="1.0" alpha="1"
<?php if(!empty($userinfo[company_url])): ?>onclick="openurl('<?php echo ($userinfo[company_url]); ?>',_blank);"<?php endif; ?> /><?php endif; ?>

<?php if(!empty($panorow['openwelcome'])&&!empty($panorow['welcome'])): ?><layer name="welcome" type="image" visible="true" url="<?php echo ($panorow['welcome']); ?>" keep="true" scale="0.5" alpha="1" width="998" height="666" x="0" y="0"  align="center" zorder="100"  maskchildren="false" onclick="action(welcome_close,welcome);" onloaded="welcome_close_ready();" />
<action name="welcome_close">
	tween(plugin[%1].alpha,0,0.5,default, set(plugin[%1].visible,false));
</action>
<action name="welcome_close_ready">
delayedcall(10,welcome_close(welcome));
</action><?php endif; ?>

<?php if($panorow['opentongji'] == 1): ?><style name="cms_view" url="%SWFPATH%/plugins/textfield.swf" zorder="0" align="lefttop" x="20" oy="30" keep="true" backgroundcolor="0xFFFFFF" backgroundalpha="0.0" roundedge="0" css="font-family:黑体; font-size:16px; color:#FFFFFF;"  width="300" autoheight="" />
<layer name="cms_view_html" style="cms_view" html=""/>
<action name="cms_view_html">
set(layer[cms_view_html].html,%1);
</action><?php endif; ?>


<?php if(!empty($navList)): ?><style name="nav_text" url="%SWFPATH%/plugins/textfield.swf" zorder="0" align="center" keep="true" backgroundcolor="0xFFFFFF" backgroundalpha="0.0" roundedge="0" css="font-family:Arial,宋体;font-size:14px;font-weight:bold;color:<?php echo ($panonav["color"]); ?>;" width="100" height="28" autoheight="" />
<krpano devices="desktop">
<?php if(is_array($navList)): $i = 0; $__LIST__ = $navList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><layer name="nav_<?php echo ($nav["id"]); ?>" keep="true" url="<?php echo ($nav["navbg_file"]); ?>" x="<?php echo ($nav["navbg_x"]); ?>" y="0" crop="0|<?php echo ($nav["navbg_crop"]); ?>|<?php echo ($nav["navbg_width"]); ?>|<?php echo ($nav["navbg_crop"]); ?>" onovercrop="0|<?php echo ($nav["navbg_height"]); ?>|<?php echo ($nav["navbg_width"]); ?>|<?php echo ($nav["navbg_crop"]); ?>" align="righttop" visible="true"/>
<layer name="nav_<?php echo ($nav["id"]); ?>_html" style="nav_text" parent="nav_<?php echo ($nav["id"]); ?>" ox="<?php echo ($panonav["ox"]); ?>" oy="<?php echo ($panonav["oy"]); ?>" html="<?php echo ($nav["navname"]); ?>" onover="set(layer[nav_<?php echo ($nav["id"]); ?>_html].css,'font-family:Arial,宋体;font-size:14px;font-weight:bold;color:<?php echo ($panonav["overcolor"]); ?>;');" 
onout="set(layer[nav_<?php echo ($nav["id"]); ?>_html].css,'font-family:Arial,宋体;font-size:14px;font-weight:bold;color:<?php echo ($panonav["color"]); ?>;');" 
<?php if($nav['opentype'] == 1 or $nav['opentype'] == 3): ?>onclick="openIframe(<?php echo ($panonav["iframewidth"]); ?>,<?php echo ($panonav["iframeheight"]); ?>,'<?php echo ($nav["linkurl"]); ?>')"<?php endif; ?>
<?php if($nav['opentype'] == 2): ?>onclick="openLink('<?php echo ($nav["linkurl"]); ?>')"<?php endif; ?>
/><?php endforeach; endif; else: echo "" ;endif; ?>
</krpano><?php endif; ?>

<layer name="Iframe_close" keep="true" url="/Public/pano/images/fx.png" align="righttop" edge="righttop" width="25" height="25" x="8" y="8" onclick="closeIframe()" zorder="1" visible="false" />
<action name="Iframe_bg">
if(layer[openIframe_bg],'',
	<!-- step one - add a background layer and fade it in -->
	set(layer[Iframe_close].visible, true);
	addlayer(openIframe_bg);
	set(layer[openIframe_bg].type, container);
	set(layer[openIframe_bg].zindex, 999999);
	set(layer[openIframe_bg].align, lefttop);
	set(layer[openIframe_bg].width, 100%);
	set(layer[openIframe_bg].height, 100%);
	set(layer[openIframe_bg].bgcolor, 0x000000);
	set(layer[openIframe_bg].bgalpha, 0.5);
	set(layer[openIframe_bg].bgcapture, true);
	set(layer[openIframe_bg].handcursor, false);
	set(layer[openIframe_bg].alpha, 0.0);
	set(layer[openIframe_bg].onclick, closeIframe());	
	tween(layer[openIframe_bg].alpha, 1.0, 0.5, default);
);
</action>
<action name="openIframe">
Iframe_bg();
js(openIframe(%1,%2,%3,1));
</action>

<krpano devices="mobile">
<action name="openIframe">
txtadd(openurl,%3,'/m_type/1');
openwindow(get(openurl),100%,100%);
</action>
</krpano>

<action name="openLink">
js(openLink(%1));
</action>
<action name="closeIframe">
set(layer[openIframe_bg].onclick, null);
js(closeIframe());
tween(layer[openIframe_bg].alpha, 0.0, 0.5, default,
	removelayer(openIframe_bg);
	set(layer[Iframe_close].visible, false);
);
</action>


<krpano devices="mobile">
<layer name="zj-logo" x="10" y="45" scale="0.5" altscale="0.5"/>
<layer name="ui_logo" y="50" scale="0.5" altscale="0.5" />
<layer name="welcome" scale="0.2" altscale="0.2"/>
<style name="cms_view" x="10" css="font-family:黑体; font-size:12px; color:#FFFFFF;" />
</krpano>



    <?php if(is_array($uirow)): $i = 0; $__LIST__ = $uirow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ui): $mod = ($i % 2 );++$i; echo "<include"; ?> url="<?php echo U('readui',array('uid'=>$ui['uid']));?>" /><?php endforeach; endif; else: echo "" ;endif; ?>

    <?php if(is_array($mbuirow)): $i = 0; $__LIST__ = $mbuirow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mbui): $mod = ($i % 2 );++$i; echo "<include"; ?> url="<?php echo U('readmbui',array('uid'=>$mbui['uid']));?>" /><?php endforeach; endif; else: echo "" ;endif; ?>

    <?php if($panorow['open_music'] == 1): if($panorow['open_musicbtn'] == 1): ?><plugin name="musicbtn" url="<?php echo CC('web_root'); echo ($panorow['musicpic']); ?>" keep="true"
                         onurl="<?php echo CC('web_root'); echo ($panorow['musichoverpic']); ?>"
                         offurl="<?php echo CC('web_root'); echo ($panorow['musicpic']); ?>"
                         onalpha="<?php echo ($panorow['hoveralpha']); ?>" outalpha="<?php echo ($panorow['alpha']); ?>"
                         align="<?php echo ($panorow['musicposto']); ?>" x="<?php echo ($panorow['mpos_x']); ?>" y="<?php echo ($panorow['mpos_y']); ?>" alpha="<?php echo ($panorow['alpha']); ?>" scale="1" onover="tween(alpha,get(onalpha));" onout="tween(alpha,get(outalpha));"
	        onclick="pausesoundtoggle(bgsnd); switch(url, get(onurl), get(offurl));"
	        /><?php endif; endif; ?>
	<?php if(!empty($banrow)): ?><contextmenu>
         <?php if(is_array($banrow)): $i = 0; $__LIST__ = $banrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ban): $mod = ($i % 2 );++$i; switch($ban['type']): case "none": ?><item name="ban<?php echo ($ban["id"]); ?>" caption="<?php echo ($ban["title"]); ?>" onclick=""/><?php break;?>
                <?php case "link": ?><item name="ban<?php echo ($ban["id"]); ?>" caption="<?php echo ($ban["title"]); ?>" onclick="linkto(<?php echo ($ban["link"]); ?>)"/><?php break;?>
                <?php default: ?><item name="ban<?php echo ($ban["id"]); ?>" caption="<?php echo ($ban["title"]); ?>" onclick="<?php echo ($ban["type"]); ?>()"/><?php endswitch; endforeach; endif; else: echo "" ;endif; ?>
    </contextmenu><?php endif; ?> 

    <?php if(($toolboxmap_on) == "1"): echo "<include"; ?> url="<?php echo U('readvtoolmap',array('pano_id'=>$pano_id));?>" /><?php endif; ?>

    <?php if(($toolboxmaps_on) == "1"): echo "<include"; ?> url="<?php echo U('readvtoolmaps',array('pano_id'=>$pano_id));?>" /><?php endif; ?>

    <?php if(is_array($viewlist)): $i = 0; $__LIST__ = $viewlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$view): $mod = ($i % 2 );++$i; if($view['sort'] == $scene and $panorow['is_littleplanet_view'] == 1): ?><scene name="scene<?php echo ($view['sort']); ?>" title="<?php echo ($view['title']); ?>" thumburl="<?php echo ($view['thumb']); ?>" onstart="newsceneevent();" firsttime="true">
        <?php else: ?>
        <scene name="scene<?php echo ($view['sort']); ?>" title="<?php echo ($view['title']); ?>" thumburl="<?php echo ($view['thumb']); ?>" onstart="newsceneevent();"><?php endif; ?>
            <events name="viewevent" />
            <?php if(($view['open_limit']) == "0"): ?><view hlookat="<?php echo ($view['hlookat']); ?>" vlookat="<?php echo ($view['vlookat']); ?>" fov="<?php echo ($view['fov']); ?>" fisheye="0" fovmin="<?php echo ($view['fovmin']); ?>" fovmax="<?php echo ($view['fovmax']); ?>" /><?php endif; ?>
            <?php if(($view['open_limit']) == "1"): ?><view hlookat="<?php echo ($view['hlookat']); ?>" vlookat="<?php echo ($view['vlookat']); ?>" fov="<?php echo ($view['fov']); ?>" fisheye="0" fovmin="<?php echo ($view['fovmin']); ?>" fovmax="<?php echo ($view['fovmax']); ?>"
                    limitview="<?php echo ($view['limitview']); ?>" hlookatmin="<?php echo ($view['hlookatmin']); ?>" hlookatmax="<?php echo ($view['hlookatmax']); ?>" vlookatmin="<?php echo ($view['vlookatmin']); ?>" vlookatmax="<?php echo ($view['vlookatmax']); ?>"
                /><?php endif; ?>

            <?php if(($view['vopen']) == "0"): ?><preview url="<?php echo ($mybag); ?>/<?php echo ($view["filedir"]); ?>/view/preview.jpg" />
                <image type="CUBE">
                    <cube  url="<?php echo CC('web_root'); echo ($view['pano_path']); ?>" />
                </image><?php endif; ?>
            <?php if(($view['vopen']) == "1"): ?><preview url="<?php echo ($mybag); ?>/<?php echo ($view["filedir"]); ?>/scene/preview.jpg" />
                <image type="CUBE" multires="true" tilesize="256" progressive="false">
                    <level tiledimagewidth="<?php echo ($view['v1']); ?>" tiledimageheight="<?php echo ($view['v1']); ?>">
                        <cube url="<?php echo ($view['web_dir']); ?>/pian_%s/l2/%v/l2_%s_%v_%h.jpg" />
                    </level>
                    <level tiledimagewidth="<?php echo ($view['v2']); ?>" tiledimageheight="<?php echo ($view['v2']); ?>">
                        <cube url="<?php echo ($view['web_dir']); ?>/pian_%s/l1/%v/l1_%s_%v_%h.jpg" />
                    </level>
                    <mobile>
                        <cube url="<?php echo ($view['web_dir']); ?>/pano_%s.jpg" />
                    </mobile>
				</image><?php endif; ?>

            <?php if($view['openmusic'] == 1): ?><events name="sound<?php echo ($view['sort']); ?>" onnewpano="playsound(bgsnd<?php echo ($view['sort']); ?>, '<?php echo ($view['musicfile']); ?>', <?php echo ($view['musictimes']); ?>);set(sound[bgsnd<?php echo ($view['sort']); ?>].volume,<?php echo ($view['musicvolume']); ?>);"  onremovepano="stopsound(bgsnd<?php echo ($view['sort']); ?>);" /><?php endif; ?>
            <?php if(($view['logo']['open']) == "1"): ?><hotspot name="nadirlogo"
                     url="<?php echo CC('web_root'); echo ($view['logo']['image']); ?>"
                     ath="0"
                     atv="90"
                     distorted="true"
                     scale="<?php echo ($view['logo']['scale']/100); ?>"
                     rotate="0.0"
                     /><?php endif; ?>
				
            <?php if(is_array($view['roam'])): $i = 0; $__LIST__ = $view['roam'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$roam): $mod = ($i % 2 );++$i; if($roam['spot_type'] == 1): ?><hotspot style="skin_hotspotstyle" title="<?php echo ($roam['title']); ?>" devices="<?php echo ($device[$roam['is_flash']][$roam['is_html5']]); ?>" name="spot<?php echo ($roam["id"]); ?>" alpha="1" ath="<?php echo ($roam["spot_x"]); ?>" scale="<?php echo ($roam['spot_scale']/100); ?>"
                    atv="<?php echo ($roam["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$roam['spot_id']]['file']); ?>"
                    align="<?php echo ($roam["spot_edge"]); ?>" edge="<?php echo ($roam["spot_edge"]); ?>" zorder="2"
					<?php if(($roam['is_showtext']) == "1"): ?>onloaded="showtxt_action();"<?php endif; ?>
				            
                    <?php switch($roam["changetype"]): case "1": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3)););"<?php break;?>
                        <?php case "2": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php case "3": ?>onclick="ifnot(device.html5,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php default: endswitch;?>
                    />
                    <?php elseif($roam['spot_type'] == 2): ?>
                    <hotspot style="skin_hotspotstyle" title="<?php echo ($roam['title']); ?>" devices="<?php echo ($device[$roam['is_flash']][$roam['is_html5']]); ?>" name="spot<?php echo ($roam["id"]); ?>" alpha="1" ath="<?php echo ($roam["spot_x"]); ?>" scale="<?php echo ($roam['spot_scale']/100); ?>" atv="<?php echo ($roam["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$roam['spot_id']]['file']); ?>"
                    align="<?php echo ($roam["spot_edge"]); ?>" edge="<?php echo ($roam["spot_edge"]); ?>" zorder="2" 
                    <?php if($roam['is_showtext'] == 1): ?>onloaded="do_crop_animation(<?php echo ($spotdata[$roam['spot_id']]['width']); ?>,<?php echo ($spotdata[$roam['spot_id']]['height']); ?>,60);showtxt_action();"
					<?php else: ?>
					onloaded="do_crop_animation(<?php echo ($spotdata[$roam['spot_id']]['width']); ?>,<?php echo ($spotdata[$roam['spot_id']]['height']); ?>,60);"<?php endif; ?>
                    <?php switch($roam["changetype"]): case "1": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3)););"<?php break;?>
                        <?php case "2": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php case "3": ?>onclick="ifnot(device.html5,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php default: endswitch;?>
                    />                    
                    <?php elseif($roam['spot_type'] == 3): ?>
                    <hotspot style="skin_hotspotstyle" title="<?php echo ($roam['title']); ?>" devices="<?php echo ($device[$roam['is_flash']][$roam['is_html5']]); ?>" name="spot<?php echo ($roam["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($roam["spoturl"]); ?>"
                         keep="false" visible="true" enabled="true" handcursor="true" zorder="2"
                         ath="<?php echo ($roam["spot_x"]); ?>" atv="<?php echo ($roam["spot_y"]); ?>" distorted="true" rx="<?php echo ($roam["rx"]); ?>" ry="<?php echo ($roam["ry"]); ?>" rz="<?php echo ($roam["rz"]); ?>"
                         edge="center" scale="<?php echo ($roam['spot_scale']/100); ?>" rotate="0" alpha="1.0"
						 <?php if(($roam['is_showtext']) == "1"): ?>onloaded="showtxt_action();"<?php endif; ?>
                    <?php switch($roam["changetype"]): case "1": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,ZOOMBLEND(1,3)););"<?php break;?>
                        <?php case "2": ?>onclick="ifnot(device.html5,moveto(<?php echo ($roam['spot_x']); ?>,<?php echo ($roam['spot_y']); ?>,smooth());loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php case "3": ?>onclick="ifnot(device.html5,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.vlookat=<?php echo ($roam['target_y']); ?>&amp;view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1));,loadscene(scene<?php echo ($scenedata[$roam['target_id']]); ?>, view.hlookat=<?php echo ($roam['target_x']); ?>, MERGE,BLEND(1)););"<?php break;?>
                        <?php default: endswitch;?>
                    /><?php endif; endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['link'])): $i = 0; $__LIST__ = $view['link'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i; if($link['spot_type'] == 1): ?><hotspot devices="<?php echo ($device[$link['is_flash']][$link['is_html5']]); ?>" title="<?php echo ($link['title']); ?>" name="lkspot<?php echo ($link["id"]); ?>" alpha="1" ath="<?php echo ($link["spot_x"]); ?>" scale="<?php echo ($link['spot_scale']/100); ?>"
                    atv="<?php echo ($link["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$link['spot_id']]['file']); ?>"
                    align="<?php echo ($link["spot_edge"]); ?>" edge="<?php echo ($link["spot_edge"]); ?>"
					<?php if($link['opentype'] == 1): ?>onclick="openIframe(820,540,'<?php echo ($link["tuwenlink"]); ?>')"<?php endif; ?>
					<?php if($link['opentype'] == 2): ?>onclick="openLink('<?php echo ($link["linkurl"]); ?>')"<?php endif; ?>
                    <?php if($link['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    />
                    <?php elseif($link['spot_type'] == 2): ?>
                    <hotspot devices="<?php echo ($device[$link['is_flash']][$link['is_html5']]); ?>" title="<?php echo ($link['title']); ?>" name="lkspot<?php echo ($link["id"]); ?>" alpha="1" ath="<?php echo ($link["spot_x"]); ?>" scale="<?php echo ($link['spot_scale']/100); ?>" atv="<?php echo ($link["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$link['spot_id']]['file']); ?>"
                    align="<?php echo ($link["spot_edge"]); ?>" edge="<?php echo ($link["spot_edge"]); ?>" 
                    <?php if($link['opentype'] == 1): ?>onclick="openIframe(820,540,'<?php echo ($link["tuwenlink"]); ?>')"<?php endif; ?>
					<?php if($link['opentype'] == 2): ?>onclick="openLink('<?php echo ($link["linkurl"]); ?>')"<?php endif; ?>
                    <?php if($link['is_hover'] == 1): ?>onloaded="do_crop_animation(<?php echo ($spotdata[$link['spot_id']]['width']); ?>,<?php echo ($spotdata[$link['spot_id']]['height']); ?>,60);showtxt_action();"
					<?php else: ?>
					onloaded="do_crop_animation(<?php echo ($spotdata[$link['spot_id']]['width']); ?>,<?php echo ($spotdata[$link['spot_id']]['height']); ?>,60);"<?php endif; ?>
                    />
                    <?php elseif($link['spot_type'] == 3): ?>
                    <hotspot devices="<?php echo ($device[$link['is_flash']][$link['is_html5']]); ?>" title="<?php echo ($link['title']); ?>" name="lkspot<?php echo ($link["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($link["spoturl"]); ?>"
                         keep="false" visible="true" enabled="true" handcursor="true"
                         ath="<?php echo ($link["spot_x"]); ?>" atv="<?php echo ($link["spot_y"]); ?>" distorted="true" rx="<?php echo ($link["rx"]); ?>" ry="<?php echo ($link["ry"]); ?>" rz="<?php echo ($link["rz"]); ?>"
                         edge="center" scale="<?php echo ($link['spot_scale']/100); ?>" rotate="0" alpha="1.0"
						 <?php if($link['opentype'] == 1): ?>onclick="openIframe(820,540,'<?php echo ($link["tuwenlink"]); ?>')"<?php endif; ?>
						 <?php if($link['opentype'] == 2): ?>onclick="openLink('<?php echo ($link["linkurl"]); ?>')"<?php endif; ?>
                         <?php if($link['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    /><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<!-- shipinredian -->
            <?php if(is_array($view['vpoint'])): $i = 0; $__LIST__ = $view['vpoint'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vpoint): $mod = ($i % 2 );++$i; if($vpoint['spot_type'] == 1): ?><hotspot devices="<?php echo ($device[$vpoint['is_flash']][$vpoint['is_html5']]); ?>" title="<?php echo ($vpoint['title']); ?>" name="vpspot<?php echo ($vpoint["id"]); ?>" alpha="1" ath="<?php echo ($vpoint["spot_x"]); ?>" scale="<?php echo ($vpoint['spot_scale']/100); ?>"
                    atv="<?php echo ($vpoint["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$vpoint['spot_id']]['file']); ?>"
                    align="<?php echo ($vpoint["spot_edge"]); ?>" edge="<?php echo ($vpoint["spot_edge"]); ?>" 
					onclick="videoplayer_open('<?php echo ($vpoint["url"]); ?>', '<?php echo ($vpoint["appleimg"]); ?>', 0.5);"
                    <?php if($vpoint['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    />
                <?php elseif($vpoint['spot_type'] == 2): ?>
                    <hotspot devices="<?php echo ($device[$vpoint['is_flash']][$vpoint['is_html5']]); ?>" title="<?php echo ($vpoint['title']); ?>" name="vpspot<?php echo ($vpoint["id"]); ?>" alpha="1" ath="<?php echo ($vpoint["spot_x"]); ?>" scale="<?php echo ($vpoint['spot_scale']/100); ?>" atv="<?php echo ($vpoint["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$vpoint['spot_id']]['file']); ?>"
                    align="<?php echo ($vpoint["spot_edge"]); ?>" edge="<?php echo ($vpoint["spot_edge"]); ?>" 
                    onclick="videoplayer_open('<?php echo ($vpoint["url"]); ?>', '<?php echo ($vpoint["appleimg"]); ?>', 0.5);"
                    <?php if($vpoint['is_hover'] == 1): ?>onloaded="do_crop_animation(<?php echo ($spotdata[$vpoint['spot_id']]['width']); ?>,<?php echo ($spotdata[$vpoint['spot_id']]['height']); ?>,60);showtxt_action();"
					<?php else: ?>
					onloaded="do_crop_animation(<?php echo ($spotdata[$vpoint['spot_id']]['width']); ?>,<?php echo ($spotdata[$vpoint['spot_id']]['height']); ?>,60);"<?php endif; ?>
                    />
                <?php elseif($vpoint['spot_type'] == 3): ?>
                    <hotspot devices="<?php echo ($device[$vpoint['is_flash']][$vpoint['is_html5']]); ?>" title="<?php echo ($vpoint['title']); ?>" name="vpspot<?php echo ($vpoint["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($vpoint["spoturl"]); ?>"
						 keep="false" visible="true" enabled="true" handcursor="true"
                         ath="<?php echo ($vpoint["spot_x"]); ?>" atv="<?php echo ($vpoint["spot_y"]); ?>" distorted="true" rx="<?php echo ($vpoint["rx"]); ?>" ry="<?php echo ($vpoint["ry"]); ?>" rz="<?php echo ($vpoint["rz"]); ?>"
                         edge="center" scale="<?php echo ($vpoint['spot_scale']/100); ?>" rotate="0" alpha="1.0" 
						 onclick="videoplayer_open('<?php echo ($vpoint["url"]); ?>', '<?php echo ($vpoint["appleimg"]); ?>', 0.5);"
                         <?php if($vpoint['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    /><?php endif; endforeach; endif; else: echo "" ;endif; ?>				
			<!-- shipinredian for mobile -->
			<?php if(!empty($view['vpoint'])): ?><krpano devices="mobile">
				<?php if(is_array($view['vpoint'])): $i = 0; $__LIST__ = $view['vpoint'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vpoint): $mod = ($i % 2 );++$i;?><hotspot name="vpspot<?php echo ($vpoint["id"]); ?>"
					scale="1.0"
					zoom="true"
					ath="<?php echo ($vpoint["spot_x"]); ?>" atv="<?php echo ($vpoint["spot_y"]); ?>"
					onclick="videoplayer_open('<?php echo ($vpoint["url"]); ?>', '<?php echo ($vpoint["appleimg"]); ?>', 0.5);"
					/><?php endforeach; endif; else: echo "" ;endif; ?>
			</krpano><?php endif; ?>



            <?php if(is_array($view['zhu'])): $i = 0; $__LIST__ = $view['zhu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zhu): $mod = ($i % 2 );++$i; if($zhu['spot_type'] == 1): ?><hotspot devices="<?php echo ($device[$zhu['is_flash']][$zhu['is_html5']]); ?>" title="<?php echo ($zhu['title']); ?>" name="zhuspot<?php echo ($zhu["id"]); ?>" alpha="1" ath="<?php echo ($zhu["spot_x"]); ?>" scale="<?php echo ($zhu['spot_scale']/100); ?>"
                        atv="<?php echo ($zhu["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$zhu['spot_id']]['file']); ?>"
                        align="<?php echo ($zhu["spot_edge"]); ?>" edge="<?php echo ($zhu["spot_edge"]); ?>" zorder="4" style="tooltip" tooltip="<?php echo ($zhu['title']); ?>"
						onclick="openIframe(820,540,'<?php echo ($zhu["tuwenlink"]); ?>')" />

                    <?php elseif($zhu['spot_type'] == 2): ?>
                    <hotspot devices="<?php echo ($device[$zhu['is_flash']][$zhu['is_html5']]); ?>" title="<?php echo ($zhu['title']); ?>" name="zhuspot<?php echo ($zhu["id"]); ?>" alpha="1" ath="<?php echo ($zhu["spot_x"]); ?>" scale="<?php echo ($zhu['spot_scale']/100); ?>" atv="<?php echo ($zhu["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$zhu['spot_id']]['file']); ?>"
                        align="<?php echo ($zhu["spot_edge"]); ?>" edge="<?php echo ($zhu["spot_edge"]); ?>" zorder="4" style="tooltip" tooltip="<?php echo ($zhu['title']); ?>" onclick="openIframe(820,540,'<?php echo ($zhu["tuwenlink"]); ?>')" onloaded="do_crop_animation(<?php echo ($spotdata[$zhu['spot_id']]['width']); ?>,<?php echo ($spotdata[$zhu['spot_id']]['height']); ?>,60)" />

					<?php elseif($zhu['spot_type'] == 3): ?>
                    <hotspot devices="<?php echo ($device[$zhu['is_flash']][$zhu['is_html5']]); ?>" title="<?php echo ($zhu['title']); ?>" name="zhuspot<?php echo ($zhu["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($zhu["spoturl"]); ?>"
                         keep="false" visible="true" enabled="true" handcursor="true"
                         ath="<?php echo ($zhu["spot_x"]); ?>" atv="<?php echo ($zhu["spot_y"]); ?>" distorted="true" rx="<?php echo ($zhu["rx"]); ?>" ry="<?php echo ($zhu["ry"]); ?>" rz="<?php echo ($zhu["rz"]); ?>"
                         edge="center" scale="<?php echo ($zhu['spot_scale']/100); ?>" rotate="0" alpha="1.0" zorder="4" style="tooltip" tooltip="<?php echo ($zhu['title']); ?>"
						 onclick="openIframe(820,540,'<?php echo ($zhu["tuwenlink"]); ?>')" /><?php endif; endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['cube'])): $i = 0; $__LIST__ = $view['cube'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cube): $mod = ($i % 2 );++$i; if($cube['spot_type'] == 1): ?><hotspot devices="<?php echo ($device[$cube['is_flash']][$cube['is_html5']]); ?>" title="<?php echo ($cube['title']); ?>" name="cubespot<?php echo ($cube["id"]); ?>" alpha="1" ath="<?php echo ($cube["spot_x"]); ?>" scale="<?php echo ($cube['spot_scale']/100); ?>"
                    atv="<?php echo ($cube["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$cube['spot_id']]['file']); ?>"
                    align="<?php echo ($cube["spot_edge"]); ?>" edge="<?php echo ($cube["spot_edge"]); ?>"
                    <?php if($cube['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    onclick="set(layer[cube<?php echo ($cube["id"]); ?>].visible,true);set(skin_settings.cube<?php echo ($cube["id"]); ?>_open,1);cube<?php echo ($cube["id"]); ?>next();"
                    />
                    <?php elseif($cube['spot_type'] == 2): ?>
			<hotspot devices="<?php echo ($device[$cube['is_flash']][$cube['is_html5']]); ?>" title="<?php echo ($cube['title']); ?>" name="cubespot<?php echo ($cube["id"]); ?>" alpha="1" ath="<?php echo ($cube["spot_x"]); ?>" scale="<?php echo ($cube['spot_scale']/100); ?>" atv="<?php echo ($cube["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$cube['spot_id']]['file']); ?>"
                    align="<?php echo ($cube["spot_edge"]); ?>" edge="<?php echo ($cube["spot_edge"]); ?>" 
                    <?php if($cube['is_hover'] == 1): ?>onloaded="do_crop_animation(<?php echo ($spotdata[$cube['spot_id']]['width']); ?>,<?php echo ($spotdata[$cube['spot_id']]['height']); ?>,60);showtxt_action();"
					<?php else: ?>
					onloaded="do_crop_animation(<?php echo ($spotdata[$cube['spot_id']]['width']); ?>,<?php echo ($spotdata[$cube['spot_id']]['height']); ?>,60);"<?php endif; ?>
                    onclick="set(layer[cube<?php echo ($cube["id"]); ?>].visible,true);set(skin_settings.cube<?php echo ($cube["id"]); ?>_open,1);cube<?php echo ($cube["id"]); ?>next();"
                    />

                    <?php elseif($cube['spot_type'] == 3): ?>
                    <hotspot devices="<?php echo ($device[$cube['is_flash']][$cube['is_html5']]); ?>" title="<?php echo ($cube['title']); ?>" name="cubespot<?php echo ($cube["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($cube["spoturl"]); ?>"
		     keep="false" visible="true" enabled="true" handcursor="true" ath="<?php echo ($cube["spot_x"]); ?>" atv="<?php echo ($cube["spot_y"]); ?>" distorted="true" rx="<?php echo ($cube["rx"]); ?>" ry="<?php echo ($cube["ry"]); ?>" rz="<?php echo ($cube["rz"]); ?>" edge="center" scale="<?php echo ($cube['spot_scale']/100); ?>" rotate="0" alpha="1.0"
                    <?php if($cube['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    onclick="set(layer[cube<?php echo ($cube["id"]); ?>].visible,true);set(skin_settings.cube<?php echo ($cube["id"]); ?>_open,1);cube<?php echo ($cube["id"]); ?>next();"
                    /><?php endif; endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['cubebag'])): $i = 0; $__LIST__ = $view['cubebag'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cubebag): $mod = ($i % 2 );++$i; echo "<include"; ?> url="<?php echo U('readcube',array('cube_id'=>$cubebag));?>" /><?php endforeach; endif; else: echo "" ;endif; ?>


            <?php if(is_array($view['photo'])): $i = 0; $__LIST__ = $view['photo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i; if($photo['spot_type'] == 1): ?><hotspot devices="<?php echo ($device[$photo['is_flash']][$cube['is_html5']]); ?>" title="<?php echo ($photo['title']); ?>" name="photospot<?php echo ($photo["id"]); ?>" alpha="1" ath="<?php echo ($photo["spot_x"]); ?>" scale="<?php echo ($photo['spot_scale']/100); ?>"
                    atv="<?php echo ($photo["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$photo['spot_id']]['file']); ?>"
                    align="<?php echo ($photo["spot_edge"]); ?>" edge="<?php echo ($photo["spot_edge"]); ?>"
                    <?php if($photo['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                    onclick="set(layer[photo<?php echo ($photo["id"]); ?>].visible,true);"
                    />
                    <?php elseif($photo['spot_type'] == 2): ?>
                    <hotspot devices="<?php echo ($device[$photo['is_flash']][$photo['is_html5']]); ?>" title="<?php echo ($photo['title']); ?>" name="photospot<?php echo ($photo["id"]); ?>" alpha="1" ath="<?php echo ($photo["spot_x"]); ?>" scale="<?php echo ($photo['spot_scale']/100); ?>" atv="<?php echo ($photo["spot_y"]); ?>" url="<?php echo CC('web_root'); echo ($spotdata[$photo['spot_id']]['file']); ?>"
                    align="<?php echo ($photo["spot_edge"]); ?>" edge="<?php echo ($photo["spot_edge"]); ?>" 
					<?php if($photo['is_hover'] == 1): ?>onloaded="do_crop_animation(<?php echo ($spotdata[$photo['spot_id']]['width']); ?>,<?php echo ($spotdata[$photo['spot_id']]['height']); ?>,60);showtxt_action();"
					<?php else: ?>
					onloaded="do_crop_animation(<?php echo ($spotdata[$photo['spot_id']]['width']); ?>,<?php echo ($spotdata[$photo['spot_id']]['height']); ?>,60);"<?php endif; ?>
                    onclick="set(layer[photo<?php echo ($photo["id"]); ?>].visible,true);"
                    />
                    <?php elseif($photo['spot_type'] == 3): ?>
                    <hotspot devices="<?php echo ($device[$photo['is_flash']][$photo['is_html5']]); ?>" title="<?php echo ($photo['title']); ?>" name="photospot<?php echo ($photo["id"]); ?>" type="image" url="<?php echo CC('web_root'); echo ($photo["spoturl"]); ?>"
                         keep="false" visible="true" enabled="true" handcursor="true"
                         ath="<?php echo ($photo["spot_x"]); ?>" atv="<?php echo ($photo["spot_y"]); ?>" distorted="true" rx="<?php echo ($photo["rx"]); ?>" ry="<?php echo ($photo["ry"]); ?>" rz="<?php echo ($photo["rz"]); ?>"
                         edge="center" scale="<?php echo ($photo['spot_scale']/100); ?>" rotate="0" alpha="1.0"
                         <?php if($photo['is_hover'] == 1): ?>onloaded="showtxt_action();"<?php endif; ?>
                         onclick="set(layer[photo<?php echo ($photo["id"]); ?>].visible,true);"
                    /><?php endif; endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['hotploy'])): $i = 0; $__LIST__ = $view['hotploy'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotploy): $mod = ($i % 2 );++$i;?><hotspot name="ploypot<?php echo ($hotploy["id"]); ?>" keep="false" visible="true" enabled="true"
                    fillcolor="<?php echo (str_replace('#','0x',$hotploy['fillcolor'])); ?>" fillcolorhover="<?php echo (str_replace('#','0x',$hotploy['fillcolorhover'])); ?>"
                    fillalpha="<?php echo ($hotploy['fillalpha']); ?>" fillalphahover="<?php echo ($hotploy['fillalphahover']); ?>"
                    borderwidth="<?php echo ($hotploy['borderwidth']); ?>" borderwidthhover="<?php echo ($hotploy['borderwidthhover']); ?>" bordercolor="<?php echo (str_replace('#','0x',$hotploy['bordercolor'])); ?>" bordercolorhover="<?php echo (str_replace('#','0x',$hotploy['bordercolorhover'])); ?>"
                    borderalpha="<?php echo ($hotploy['borderalpha']); ?>" borderalphahover="<?php echo ($hotploy['borderalphahover']); ?>"
					<?php if($hotploy['action_type'] == 1): ?>onclick="loadscene(<?php echo getScene($hotploy['scene_id']);?>, Null, MERGE,BLEND(1));"
					<?php elseif($hotploy['action_type'] == 3): ?>
					onclick="openIframe(<?php echo ($hotploy["textbox_width"]); ?>,<?php echo ($hotploy["textbox_height"]); ?>,'<?php echo ($hotploy["tuwenlink"]); ?>')"
					<?php else: ?>
					onclick="set(layer[ploycube<?php echo ($hotploy["id"]); ?>].visible,true);"<?php endif; ?>
                >
                    <?php if(is_array($hotploy['pointarr'])): $i = 0; $__LIST__ = $hotploy['pointarr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spot): $mod = ($i % 2 );++$i;?><point ath="<?php echo ($spot["ath"]); ?>" atv="<?php echo ($spot["atv"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                </hotspot><?php endforeach; endif; else: echo "" ;endif; ?>

			<!-- requtanshipin -->
            <?php if(is_array($view['ployvideo'])): $i = 0; $__LIST__ = $view['ployvideo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ployvideo): $mod = ($i % 2 );++$i;?><hotspot name="ployvideo<?php echo ($ployvideo["id"]); ?>" keep="false" visible="true" enabled="true"
                    fillcolor="<?php echo (str_replace('#','0x',$ployvideo['fillcolor'])); ?>" fillcolorhover="<?php echo (str_replace('#','0x',$ployvideo['fillcolorhover'])); ?>"
                    fillalpha="<?php echo ($ployvideo['fillalpha']); ?>" fillalphahover="<?php echo ($ployvideo['fillalphahover']); ?>"
                    borderwidth="<?php echo ($ployvideo['borderwidth']); ?>" borderwidthhover="<?php echo ($ployvideo['borderwidthhover']); ?>" bordercolor="<?php echo (str_replace('#','0x',$ployvideo['bordercolor'])); ?>" bordercolorhover="<?php echo (str_replace('#','0x',$ployvideo['bordercolorhover'])); ?>"
                    borderalpha="<?php echo ($ployvideo['borderalpha']); ?>" borderalphahover="<?php echo ($ployvideo['borderalphahover']); ?>"
					onclick="videoplayer_open('<?php echo ($ployvideo["url"]); ?>', '<?php echo ($ployvideo["appleimg"]); ?>', 0.5);"
                >
                    <?php if(is_array($ployvideo['pointarr'])): $i = 0; $__LIST__ = $ployvideo['pointarr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spot): $mod = ($i % 2 );++$i;?><point ath="<?php echo ($spot["ath"]); ?>" atv="<?php echo ($spot["atv"]); ?>"/><?php endforeach; endif; else: echo "" ;endif; ?>
                </hotspot><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(!empty($view['ployvideo'])): ?><krpano devices="mobile">
				<?php if(is_array($view['ployvideo'])): $i = 0; $__LIST__ = $view['ployvideo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ployvideo): $mod = ($i % 2 );++$i;?><hotspot name="ployvideo<?php echo ($ployvideo["id"]); ?>" zoom="true"
					onclick="videoplayer_open('<?php echo ($ployvideo["url"]); ?>', '<?php echo ($ployvideo["appleimg"]); ?>', 0.5);"
					/><?php endforeach; endif; else: echo "" ;endif; ?>
			</krpano><?php endif; ?>



			<!-- shipinrequ -->
            <?php if(is_array($view['vspot'])): $i = 0; $__LIST__ = $view['vspot'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vspot): $mod = ($i % 2 );++$i;?><hotspot name="videospot<?php echo ($vspot["id"]); ?>"
                     url="%SWFPATH%/plugins/videoplayer.swf"
                     alturl="%SWFPATH%/plugins/videoplayer.js"
                     videourl="<?php echo ($vspot["url"]); ?>"
                     posterurl="<?php echo ($vspot["appleimg"]); ?>"
                     distorted="true" devices="<?php echo ($vspot["devices"]); ?>"
                     ath="<?php echo ($vspot["ath"]); ?>" atv="<?php echo ($vspot["atv"]); ?>"
                     edge="center"
                     scale="<?php echo ($vspot["scale"]); ?>" rx="<?php echo ($vspot["rx"]); ?>" ry="<?php echo ($vspot["ry"]); ?>" rz="<?php echo ($vspot["rz"]); ?>"
                     loop="true"
                     pausedonstart="true"
                     directionalsound="true"
                     range="200"
                     volume="0.7"
                     onhover="<?php echo ($vspot["hover"]); ?>"
                     style="<?php echo ($vspot["style"]); ?>"
                     onclick="<?php echo ($vspot["eve"]); ?>"
                     /><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(!empty($view['vspot'])): ?><krpano devices="mobile">
				<?php if(is_array($view['vspot'])): $i = 0; $__LIST__ = $view['vspot'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vspot): $mod = ($i % 2 );++$i;?><hotspot name="videospot<?php echo ($vspot["id"]); ?>" visible="false" />
					<hotspot name="videospot_mobile_<?php echo ($vspot["id"]); ?>"
					url="%SWFPATH%/images/media_playback_start.png"
					scale="0.5"
					zoom="true"
					ath="<?php echo ($vspot["ath"]); ?>" atv="<?php echo ($vspot["atv"]); ?>"
					onclick="videoplayer_open('<?php echo ($vspot["url"]); ?>', '<?php echo ($vspot["appleimg"]); ?>', 0.5);"
					/><?php endforeach; endif; else: echo "" ;endif; ?>
			</krpano><?php endif; ?>
			

            <?php if(is_array($view['photobag'])): $i = 0; $__LIST__ = $view['photobag'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photobag): $mod = ($i % 2 );++$i; echo "<include"; ?> url="<?php echo U('readphoto',array('photo_id'=>$photobag));?>" /><?php endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['hotploybag'])): $i = 0; $__LIST__ = $view['hotploybag'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotploybag): $mod = ($i % 2 );++$i; echo "<include"; ?> url="<?php echo U('readholy',array('holy_id'=>$hotploybag));?>" /><?php endforeach; endif; else: echo "" ;endif; ?>

            <?php if(is_array($view['lensflare'])): $i = 0; $__LIST__ = $view['lensflare'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lensflare): $mod = ($i % 2 );++$i;?><lensflare name="lens<?php echo ($lensflare["id"]); ?>" ath="<?php echo ($lensflare["ath"]); ?>" atv="<?php echo ($lensflare["atv"]); ?>"  alpha="1" set="DEFAULT" size="<?php echo ($lensflare['size']/100); ?>" blind="<?php echo ($lensflare['blind']/100); ?>" blindcurve="<?php echo ($lensflare["blindcurve"]); ?>" keep="False" /><?php endforeach; endif; else: echo "" ;endif; ?>

            <?php if(($view['haveui']) == "1"): echo "<include"; ?> url="<?php echo U('readvui',array('view_id'=>$view['id']));?>" /><?php endif; ?>
			
            <action name="newsceneevent">
                <?php if($weather_used > 0): ?>action(<?php echo ($view['effect_mod']); ?>);<?php endif; ?>
                <?php if($view['sort'] == $scene and $panorow['is_littleplanet_view'] == 1): $scene_key = $scene-1; ?>
					if(scene[<?php echo ($scene_key); ?>].firsttime,
                        becomestar();
                        set(scene[<?php echo ($scene_key); ?>].firsttime,false);
                    delayedcall(<?php echo ($view['star_time']); ?>, normalview(<?php echo ($view['hlookat']); ?>,<?php echo ($view['vlookat']); ?>,<?php echo ($view['fov']); ?>)));<?php endif; ?>
                <?php if(($toolboxmap_on) == "1"): ?>toolboxmapto(<?php echo ($view['sort']); ?>);<?php endif; ?>
                <?php if(($toolboxmaps_on) == "1"): ?>toolboxmapsto(<?php echo ($view['sort']); ?>);<?php endif; ?>
            </action>

            <?php if(($view['luopan']['open']) == "1"): ?><plugin name="luoban<?php echo ($view['luopan']['view_id']); ?>" keep="false" width="130" height="130" scale="1" zorder="0" align="center" edge="center" url="<?php echo CC('web_root'); echo ($view['luopan']['image']); ?>" alpha="1"  handcursor="true" enabled="true" parent="luopanbox" />
                <events onviewchange= "set(plugin[luopanbox].visible,true);set(plugin[luopan_bang].visible,true);div(luopandu,get(view.hlookat),-1);sub(plugin[luoban{view['luopan']['view_id']}].rotate,-180, get(luopandu));"/><?php endif; ?>
            <?php if(($view['luopan']['open']) == "0"): ?><events onviewchange= "set(plugin[luopanbox].visible,false);set(plugin[luopan_bang].visible,false);"/><?php endif; ?>

        </scene><?php endforeach; endif; else: echo "" ;endif; ?>

    <plugin name="luopanbox" url="__PUBLIC__/pano/luopan/none.png" keep="true" zorder="1" children="false" align="righttop" edge="center" x="80" y="80" scale="1" scalechildren="true" destscale="1.0" alpha="1" visible="true" capture="true" handcursor="true" enabled="true"/>
    <plugin name="luopan" url="__PUBLIC__/pano/luopan/kedu.png" keep="true" handcursor="false" parent="luopanbox" zorder="1" alpha="1"  y="0" align="center" mask="plugin[luopan_mask]" visible="true" enabled="false"/>
    <plugin name="luopan_mask" url="__PUBLIC__/pano/luopan/luopan_mask.png" keep="true" zorder="4" parent="luopanbox" align="center" blendmode="normal" visible="false" capture="false" handcursor="true" enabled="false" />
    <plugin name="luopan_quan" url="__PUBLIC__/pano/luopan/quan.png" alpha="1" keep="true" enabled="false" visible="true" parent="luopanbox" zorder="4" align="center" capture="false" handcursor="false"/>
    <plugin name="luopan_hover" url="__PUBLIC__/pano/luopan/hover.png" keep="true" enabled="false" visible="true" parent="luopanbox" zorder="3" align="center" capture="false" handcursor="false" mask="plugin[luopan_mask]"/>
    <plugin name="luopan_v" url="__PUBLIC__/pano/luopan/luopanv.png" keep="true" enabled="false" visible="true" parent="luopanbox" zorder="2" align="top" capture="false" handcursor="false" y="-37" />

    <plugin name="luopan_bang" url="__PUBLIC__/pano/luopan/none.png" keep="true" zorder="8" align="righttop" edge="center" width="100" height="100" x="80" y="80" handcursor="false" alpha="1" />
    <plugin name="luopan_bangdou" url="__PUBLIC__/pano/luopan/bang.png" keep="true" zorder="2" align="center" parent="luopan_bang"  x="0" y="0" ondown="startluopanslider();" onup="stopluopanslider();"/>
    <krpano devices="mobile">				
	<plugin name="luopanbox" scale="0.5" altscale="0.5" />
	</krpano>

	<action name="startluopanslider">
    set(plugin[luopan_bangdou].backup_align, get(plugin[luopan_bangdou].align));
    set(plugin[luopan_bangdou].backup_edge,  get(plugin[luopan_bangdou].edge));
    plugin[luopan_bangdou].changeorigin(center,center);
    sub(mouse_x_offset, plugin[luopan_bangdou].x, mouse.x);
    sub(mouse_y_offset, plugin[luopan_bangdou].y, mouse.y);
    set(image_dragging,true);
    luopanslider();r\n";
    </action>

    <action name="stopluopanslider">
    set(image_dragging, false);
    set(plugin[luopan_bangdou].x, 0);
    set(plugin[luopan_bangdou].y, 0);
    </action>

    <action name="luopanslider">
    if(image_dragging,
    add(ypos, mouse.y, mouse_y_offset);
    add(xpos, mouse.x, mouse_x_offset);
    if(ypos LT -35, set(ypos,-35));
    if(ypos GT 35, set(ypos,35));
    if(xpos LT -35, set(xpos,-35));
    if(xpos GT 35, set(xpos,35));
    copy(plugin[luopan_bangdou].y, ypos);
    copy(plugin[luopan_bangdou].x, xpos);
    setblend(get(val));
    div(ypos , ypos , 40);
    div(xpos , xpos , 15);
    add(valx, xpos , 0);
    add(valy, ypos , 0);
    add(view.vlookat , valy , get(view.vlookat) );
    add(view.hlookat , valx , get(view.hlookat) );
    delayedcall(0.01, luopanslider() );
    ,
    plugin[luopan_bangdou].changeorigin(get(plugin[luopan_bangdou].backup_align), get(plugin[luopan_bangdou].backup_edge));
    );
    </action>
</krpano>