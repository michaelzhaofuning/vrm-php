<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($panorow['title']); ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="Keywords" content="全景,全景软件,全景拍摄,全景照片,三维全景,全景网,虚拟现实内容平台,360度全景,720全景,360VR,pano2vr,全景通,临沂全景信息技术有限公司">
	<meta name="Description" content="全景通软件是临沂全景信息技术有限公司开发的国内首款基于WEB图形化的漫游制作平台，具有WEB系统良好的扩展性与易用性，是目前国内应用最广泛的专业全景软件">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Cache" content="no-cache">
	<style>
		@-ms-viewport { width:device-width; }
		@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
		html { height:100%; }
		body, html { height:100%; overflow:hidden; margin:0; padding:0; font-family: Arial,PingFangSC-Regular,Hiragino Sans GB,STHeiti,WenQuanYi Micro Hei,SimSun,sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }
	</style>

</head>
<body>
<link href="__PUBLIC__/pano/images/jszlqj_1.css" type="text/css" rel="stylesheet">
<script src="__PUBLIC__/pano/images/jquery-1.7.2.min.js"></script>
<script src="__PUBLIC__/pano/images/jszlqj_0.js"></script>
<script src="__PUBLIC__/pano/images/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pano/images/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<?php if($panorow['openwechat'] == 1): ?><script language="javascript">
window.configHC = {id:"<?php echo $pano_id; ?>",appid:"<?php echo $wxinfo['appid']; ?>",serverDomain:"<?php echo $domainlink; ?>",openAnyCom:1,openWXCom:1,pageMaxShow:100,addGui_BackColor:"0x77ff77"};
</script>
<link href="__PUBLIC__/pano/images/hotspotComment.css" type="text/css" rel="stylesheet">
<script src="__PUBLIC__/pano/images/hotspotComment.js" type="text/javascript"></script><?php endif; ?>
<script src="__PUBLIC__/pano/pano.js"></script>
<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
	<script><?php echo ($xmlscript); ?></script>
</div>
<script src="__PUBLIC__/pano/images/common.js"></script>
<?php if($zhuchiren['open'] == 1): $temp = explode(".",$zhuchiren['file']); $file = $temp[0]; $width = $zhuchiren['width']; $height = $zhuchiren['height']; ?>
<?php if($zhuchiren['position'] == 'right'): ?><style>.div_voide{position: fixed;_position:absolute;bottom:15px;max-width:500px;max-height:500px;z-index:999;right:10px;background-color: Transparent;}</style>
<?php elseif($zhuchiren['position'] == 'left'): ?>
<style>.div_voide{position: fixed;_position:absolute;bottom:15px;max-width:500px;max-height:500px;z-index:999;left:10px;background-color: Transparent;}</style><?php endif; ?>
<div id="videodiv"></div>
<script type="text/javascript">
var vhtml = "";
vhtml = "<div onmousedown='cc1.create(this)' id='video' class='div_voide' >";
vhtml += "<div Style='position: absolute; bottom:12px; right:12px;z-index:999;'>";
vhtml += "<a href=\"JavaScript:;\" onclick=\"hidead()\" style=\"color:#fff;text-decoration:none;font-size:12px;\">关闭</a>";
vhtml += "</div>";
vhtml += "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='/Public/pano/zhuchiren/swflash.cab'";
vhtml += "width='<?php echo ($width); ?>' height='<?php echo ($height); ?>' id='FLVPlayer'>";
vhtml += "<param name='wmode' value='transparent'>";
vhtml += "<param name='movie' value='/Public/pano/zhuchiren/FLVPlayer_Progressive.swf' />";
vhtml += "<param name='salign' value='lt' />";
vhtml += "<param name='quality' value='high' />";
vhtml += "<param name='scale' value='noscale' />";
vhtml += "<param name='FlashVars' value='&MM_ComponentVersion=1&skinName=/Public/pano/zhuchiren/Clear_Skin_1&streamName=<?php echo ($file); ?>&autoPlay=true&autoRewind=true'/>";
vhtml += "<embed wmode='transparent' src='/Public/pano/zhuchiren/FLVPlayer_Progressive.swf' flashvars='&MM_ComponentVersion=1&skinName=/Public/pano/zhuchiren/Clear_Skin_1&streamName=<?php echo ($file); ?>&autoPlay=true&autoRewind=true'";
vhtml += "quality='high' scale='noscale' width='<?php echo ($width); ?>' height='<?php echo ($height); ?>' name='FLVPlayer' salign='LT'";
vhtml += "type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />";
vhtml += "</object>";
vhtml += "</div>";
function hidead() {
	var my = document.getElementById("video");
	if (my != null)
		my.parentNode.removeChild(my);
}
$(function(){
	if(!navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
		window.setTimeout(function(){$("#videodiv").html(vhtml);},5000);
	}
});
</script><?php endif; ?>
<input type="hidden" value="<?php echo ($pano_id); ?>" id="pano_id">
<?php if($panorow['openzan'] == 1): ?><script type="text/javascript">
$(function(){	
	$.ajax({
		type:"get",
		url:"<?php echo ($domainlink); ?>/index.php?s=/Member/Panoapi/getzan",
		data:{"pano_id":$("#pano_id").val()},
		dataType:'jsonp',
		jsonp: "callbackzan",
		jsonpCallback:"success_callbackzan",
		success:function(result){
			if(result.status){
				krpano.call("cms_zan_html("+result.data+")");
				if(result.status==2){
					krpano.call("cms_zan_check()");
				}
			}
		}
	});
});
</script><?php endif; ?>
<?php if($panorow['opentongji'] == 1): ?><script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		type:"get",
		url:"<?php echo ($domainlink); ?>/index.php?s=/Member/Panoapi/view",
		data:{pano_id:$("#pano_id").val()},
		dataType:'jsonp',
		jsonp: "callbackparam",
		jsonpCallback:"success_jsonpCallback",
		success:function(result){
			if(result.status == 1){	
				krpano.call("cms_view_html(访问量："+result.data+")");			
			}
		}
	});
});
</script><?php endif; ?>
</body>
</html>