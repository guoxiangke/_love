<?php
/**
 * 微信扩展接口测试
 */
	include("../wechatext.class.php");
	
	function logdebug($text){
		file_put_contents('../data/log.txt',$text."\n",FILE_APPEND);		
	};
	
	$options = array(
		'account'=>'love_yongbuzhixi',
		'password'=>'mjk5nj',
		'datapath'=>'../data/cookie_' ,
			'debug'=>true,
			'logcallback'=>'logdebug'	
	); 
