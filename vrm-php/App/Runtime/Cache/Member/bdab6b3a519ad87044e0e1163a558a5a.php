<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title><?php echo ($twinfo["twname"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript" src="/Public/pano/images/jquery-1.7.2.min.js"></script>
<link href="/Public/pano/images/nav.css" rel="stylesheet">
</head>
<body>
<?php if($m_type == 1): ?><style>
.qjmy_news img {max-width: 260px;}
#navinfo, #mess{padding:0px;}
.pluginBox {font-family: STHeiti,Microsoft YaHei,Helvetica,Arial,sans-serif;font-size: 14px;}
.pluginBox h1{font-size: 1.0rem;color: #404040;}
.pluginBox p {line-height: 2.0em;}
p {background-color: transparent;word-break: break-all;}
</style>
<script>
$(function(){
	$("#pluginBox").addClass("mobileBox");
});
</script><?php endif; ?>
<div id="pluginBox" class="panoNav">
<div class="pluginBox">

<div id="navinfo">
<div id="navinfoList">
<div class="qjmy_main">
<div class="qjmy_title">
<h1><?php echo ($twinfo["twname"]); ?></h1>
</div><!-- qjmy_title -->
<div class="qjmy_news">
<?php echo ($twinfo["twcontent"]); ?>
</div><!-- qjmy_news -->
</div><!-- qjmy_main -->
</div><!-- navinfoList -->
</div><!-- navinfo -->

</div>
</div>

</body>
</html>