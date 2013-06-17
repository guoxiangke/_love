<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>下载列表(周<?php
$today=mktime(0,0,0,date('m'),date('d'),date('Y'));
$get_date=$_GET["date"]?mktime(0,0,0,date('m',$_GET["date"]),date('d',$_GET["date"]),date('Y',$_GET["date"])):$today;
$date= $_GET["date"]?date("ymd",$get_date):date("ymd");
echo $showtime=date("w");
?>节目)</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">
	.program{text-align:left;}
	.program div{padding-left:10px;width:80px;}
</style>
</head>
<body>


<div align=center><br/><b>下载列表(周<?php
echo $showtime=date("w",$get_date);
?>节目)</b><br/>
<br/><br/>
<p>下载方法：鼠标右键-》链接另存为 即可下载！耶稣爱你^_^</p>
<?php
$program=array(
				'ws'=>'长夜的牵引',
				'bv'=>'灵命日粮',
				'ee'=>'拥抱每一天',
				'se'=>'恋爱季节',
				'hg'=>'欢乐卡洽碰',
				'bc'=>'书香园地',
				'ds'=>'晨曦讲座',
				'gv'=>'生活无国界',
				'cc'=>'空中辅导',
				'up'=>'亲情不断电',
				'bf'=>'幸福满家园',
				'eg'=>'英语世界',
				);
foreach($program as $key=>$value){
	$mp3 = array('se','ws');
	$extend = '.wma';
	if(in_array($key, $mp3)) {
		$extend = '.mp3';
	}
	echo "<div class='program'>
	<span> $value</span>
	<span><a href='http://liangyou.nissigz.com/media/$key/$key".$date.$extend."'>线路一</a> </span>
	<span><a href='http://audio.liangyou.net/files/media/program_live/$key/$key".$date.$extend."'>线路二</a></span>
	<span><a href='http://audio2.liangyou.net/files/media/program_live/$key/$key".$date.$extend."'>线路三</a></span>
	<span><a href='http://audio.liangyou.net/download.php?t=2&c=$key&f=$key".$date.$extend."'>线路4</a></span>
	</div><br/>";
}
?>
<div><?php $yes=$get_date-3600*24;?><?php
if( time()-$yes>3600*24*7){
}else{
echo '<a href="download_list.php?date='.$yes.'">前一天的节目</a>';
}
?>

注：书香园地 周一-周五
</body>
</html>