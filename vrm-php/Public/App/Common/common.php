<?php

//解决不同服务器HTML转义的BUG
if (get_magic_quotes_gpc()) {

    function stripslashes_deep($value) {
        $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

function CC($word) {
    $readfile = APP_ROOT . "/App/Common/setting.php";

    if (is_file($readfile)) {
        require ($readfile);
        return $sysrow[$word];
    } else {
        freshsetting();
        require ($readfile);
        return $sysrow[$word];
    }
}

function freshsetting() {
    $readfile = APP_ROOT . "/App/Common/setting.php";
    $sysconfig = M("sysconfig")->select();
    $sysrow = array();
    foreach ($sysconfig as $sys) {
        $sysrow[$sys['varname']] = $sys['value'];
    }
    $text = "";
    $text .= '<?php' . "\r\n";
    $text .= '$sysrow = array();' . "\r\n";
    foreach ($sysrow as $sk => $sv) {
        $text .= '$sysrow["' . $sk . '"] = "' . $sv . '";' . "\r\n";
    }
    $text .= '?>' . "\r\n";
    writeinFile($readfile, $text);
}

/**
 * 写入文件
 * @param type $file 文件名称
 * @param type $text 写入内容
 */
function writeinFile($file, $text) {
    $fp_conf = fopen($file, "w");
    fwrite($fp_conf, $text);
    fclose($fp_conf);
}

function createFolder($path) {
    if (!file_exists($path)) {
        createFolder(dirname($path));
        mkdir($path, 0777);
    }
}
/**
 * 复制文件夹
 * @param type $src
 * @param type $dst
 */
function copyFolder($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ( $file = readdir($dir))) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file)) {
                copyFolder($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    } closedir($dir);
}

/**
 * 删除目录
 *
 * @param unknown_type $indir
 */
function RemoveDirFiles($indir) {
    if (!is_dir($indir)) {
        return;
    }
    $dh = dir($indir);
    while ($filename = $dh->read()) {
        if ($filename == "." || $filename == "..") {
            continue;
        } else if (is_file("$indir/$filename")) {
            @unlink("$indir/$filename");
        } else {
            RemoveDirFiles("$indir/$filename");
        }
    }
    $dh->close();
    @rmdir($indir);
}

//select函数
function CteatSelect($n, $arr) {
    $r = "";
    foreach ($arr as $h => $v) {
        $k = explode("|", $v);
        if (($n != "") && $n == $k[0]) {
            $r .= "<option value=\"{$k[0]}\" selected>{$k[1]}</option>";
        } else if ($n == "" && $h == 0) {
            $r .= "<option value=\"{$k[0]}\" selected>{$k[1]}</option>";
        } else {
            $r .= "<option value=\"{$k[0]}\">{$k[1]}</option>";
        }
    }
    return $r;
}

function Checked($t1,$t2){
    $r = "";
    if($t1 == $t2){
        $r = ' checked="true"';
    }
    return $r;
}

function Selected($t1,$t2){
    $r = "";
    if($t1 == $t2){
        $r = ' selected="true"';
    }
    return $r;
}

function download($file_dir,$file_name)
 //参数说明：
 //file_dir:文件所在目录
 //file_name:文件名
 {
     $file_dir = chop($file_dir);//去掉路径中多余的空格
     //得出要下载的文件的路径
     if($file_dir != '')
     {
         $file_path = $file_dir;
         if(substr($file_dir,strlen($file_dir)-1,strlen($file_dir)) != '/')
             $file_path .= '/';
         $file_path .= $file_name;
     }
    else
         $file_path = $file_name;

    //判断要下载的文件是否存在
     if(!file_exists($file_path))
     {
         echo '对不起,你要下载的文件不存在。';
         return false;
     }
     $file_size = filesize($file_path);

    header("Content-type: application/octet-stream");
     header("Accept-Ranges: bytes");
     header("Accept-Length: $file_size");
     header("Content-Disposition: attachment; filename=".$file_name);

    $fp = fopen($file_path,"r");
     $buffer_size = 1024;
     $cur_pos = 0;

    while(!feof($fp)&&$file_size-$cur_pos>$buffer_size)
     {
         $buffer = fread($fp,$buffer_size);
         echo $buffer;
         $cur_pos += $buffer_size;
     }

    $buffer = fread($fp,$file_size-$cur_pos);
     echo $buffer;
     fclose($fp);
     return true;
 }
 
 
 function readPost($postarr, $delkey = array("dopost")) {
    $newarr = array();
    foreach ($postarr as $key => $value) {
        if (!in_array($key, $delkey)) {
            $newarr[$key] = $value;
        }
    }
    return $newarr;
}
function SpHtml2Text($str){
	$str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
	$alltext = "";
	$start = 1;
	for($i=0;$i<strlen($str);$i++){
	if($start==0 && $str[$i]==">") $start = 1;
	else if($start==1){
	  if($str[$i]=="<"){ $start = 0; $alltext .= " "; }
	  else if(ord($str[$i])>31) $alltext .= $str[$i];
	}
	}
	$alltext = str_replace("　"," ",$alltext);
	$alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
	$alltext = preg_replace("/[ ]+/s"," ",$alltext);
	return $alltext;
}
function substring($str, $start, $length)
{
	$len = $length;
	if($length < 0){
		$str = strrev($str); 
		$len = -$length;
	}
	$len= ($len < strlen($str)) ? $len : strlen($str);
	for ($i= $start; $i < $len; $i ++){
		   if (ord(substr($str, $i, 1)) > 0xa0){
			 $tmpstr .= substr($str, $i, 2);
			 $i++;
		   }else {
			 $tmpstr .= substr($str, $i, 1);
		   }
	}
	if($length < 0) $tmpstr = strrev($tmpstr);
	return $tmpstr;
}
?>
