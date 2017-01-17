<?php
/*	
 * @author  odaboy  QQ 5735524, www.odaboy.com
 * @�ļ�������
 * @v 0.1.2 
 * @�����˲鿴Ŀ¼����
 * @�����˲��ܱ����ϼ�Ŀ¼
 * @time 20111101
 *  */
class file_class{
	var $root ; //·��
	var $handle ; //��¼��ǰ�ļ�����Ϣ
	function __construct(){
		$this->root = dirname(__FILE__);
	}
/*	
 * function_ file_root 
 * ������·��
 * return : string
 *  */
	function file_root($path,$root=false){
		if($path{0}!='//' && $path{0}!='\\')
			$path = '\\'.$path;
		if($root==false && isset($path)){
			$this->root .=  $path;
		}else{
			$this->root =  $root .$path;
		}
	}
/*	
 * function_ file_read 
 * ������·��
 * return : string
 *  */
	function file_read($path,$root=false){
		if(is_file($this->root =  $root .$path)){
			file_get_contents();
		}
	}
/*	
 * function_ file_list 
 * ������ǰĿ¼
 * 
 *  */
	function file_list(){
		if(is_dir($this->root)){
			if($dh = opendir($this->root)) {
			$i = 1;
				while (($file = readdir($dh)) !== false) {
					if($file!='.' && $file!='..'){
						$this->handle[$i]['name']=$file;
						$this->handle[$i]['type']=$this->file_type($file);
						$this->handle[$i]['size']=$this->file_size($file);
						$this->handle[$i]['rw']=$this->file_rw($file);
						$this->handle[$i]['time']=$this->file_time($file);
						$this->handle[$i]['md5']=$this->file_md5($file);
						$i++;
					}
				}
			fclose($dh);
			}
		}
	}
/*	
 * function_ file_rw
 * ���ص�ǰ�ļ���Ȩ��,�Ƿ�ɶ���д
 * return :string   00  ûȨ��, 11 �ɶ���д, 10  �ɶ� ,01  ��д 
 *  */
	function file_rw($file){
		 if(@fopen($this->root.'/'.$file,'r')){
			$status = '10';
		 }elseif(@fopen($this->root.'/'.$file,'w')){
			$status ='01';
		 }elseif(@fopen($this->root.'/'.$file,'r+')){
			$status ='11';
		 }else{
			$status ='00';
		 }
		 return $status;//���ɶ�
	}
/*	
 * function_ file_type
 * ���ص�ǰ�ļ�������
 * return :string
 *  */
	function file_type($file){
		return filetype($this->root.'/'.$file);
	}
/*	
 * function_ file_time
 * ���ص�ǰ�ļ���ʱ��,�޸�ʱ����ϴη���ʱ��
 * return :string
 *  */
	function file_time($file){
		$time['fileatime'] = fileatime($this->root.'/'.$file);
		$time['filemtime'] = filemtime($this->root.'/'.$file);
		return $time;
	}
/*	
 * function_ file_size
 * ���ص�ǰ�ļ��Ĵ�С
 * return :string
 *  */
	function file_size($file){
		return filesize($this->root.'/'.$file);
	}
/*	
 * function_ file_del 
 * ɾ���ļ���,�ļ�
 * return : bool
 *  */
	function file_del($file){
		if(is_file($this->root.'/'.$file)){
			unlink($this->root.'/'.$file);
		}
	}
/*	
 * function_ file_md5
 * �����ļ���md5ֵ
 * return : bool
 *  */
	function file_md5($file){
		return md5($file);
	}
/*	
 * function_ debug 
 * debug���  $f��Ҫdebug�ĺ������߱���,$v=1 var_dump��� ,����print_r���
 *  */
	function debug($f,$v){
		switch ($v) {
			case 1:
				var_dump($this->$f);break;
			default:
				print_r($this->$f);break;
		}
	}
}





$action=$_GET['action'];
$de = new file_class();
$de -> debug('root', 0);
$de -> file_root($_GET['path']);
$de -> file_list();
// $de -> debug('handle', 0);

if($action=='del'){
	if(isset($_GET['file'])){
		$de -> file_del($_GET['file']);
	}
}
if($action=='show'){
	if(isset($_GET['path'])){
		$de -> file_root($_GET['path']);
	}
}


?>

<TABLE>
<TR>
	<TD>�ļ���</TD>
	<TD>��С</TD>
	<TD>����</TD>
	<TD>Ȩ��</TD>
	<TD>�޸�ʱ��</TD>
	<TD>�ϴη���ʱ��</TD>
	<TD>MD5</TD>
	<TD>ɾ��</TD>
</TR>
<TR>
		<TD><a href="?action=show&path=<?php echo (isset($_GET['path']) && (substr($_GET['path'],0,3)=='../'))?substr($_GET['path'],3,strlen($_GET['path'])):'.\/'?>">.</a></TD>
</TR>
<TR>
		<TD><a href="?action=show&path=<?php echo isset($_GET['path'])?$_GET['path'].'../':'../'?>">..</a></TD>
</TR>
<?php 
if(!is_array($de -> handle)) exit;
foreach($de -> handle as $value){ ?>
<TR>
	<TD><?php if($value["type"]=='dir'){?><a href="?action=show&path=<?php echo $_GET['path'].$value['name']?>"><b style="color:red"><?php echo $value["name"]?></b></a><?php }else{?><?php echo $value["name"];}?></TD>
	<TD><?php echo $value["type"]?></TD>
	<TD><?php echo $value["size"]?></TD>
	<TD><?php echo $value["rw"]=='00'?'ûȨ��':($value["rw"]=='11'?'�ɶ���д':($value["rw"]=='10'?'�ɶ�':'��д'))?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["filemtime"])?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["fileatime"])?></TD>
	<TD><?php if($value["type"]!='dir') echo $value["md5"];?></TD>
	<TD><a href='?action=del&file=<?php echo $value["name"]?>'>���ɾ��</a></TD>
</TR>
<?php }?>

</TABLE>