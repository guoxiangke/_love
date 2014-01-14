<?php
// security check.
// if(!isset($_REQUEST['md5'])) {
// 	return;
// }elseif($_REQUEST['md5']!='21dad337d94e4c3e9de2b356d11bec9c'){
// 	return;
// }

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
// define('DRUPAL_ROOT', getcwd());

// require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
// drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
// menu_execute_active_handler();
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
if(isset($_REQUEST['mobile'])) {
	$phone_nums = $_REQUEST['mobile'];
}
if(isset($_REQUEST['msg'])) {
	$msg =$_REQUEST['msg'];
}

if(isset($phone_nums)) {
	send_sms_form_submit($phone_nums,$msg);
}
function send_sms_form_submit($phone_nums,$msg) {
	 //$phone_nums = trim($form_state['values']['phone_num']);
 	 $phone_nums = trim($phone_nums); 
	 $phone_nums = explode(';', $phone_nums, -1);
	 //$msg = trim($form_state['values']['sms_text']);
	 $msg = trim($msg);
	 foreach( $phone_nums as $line=> $number){
	 	$number = trim($number);
		if(!is_numeric($number)||strlen($number)!=11){
			$number_error[$line] = $number;
			
		}else{
			$number_right[$line] = $number;
		}
		
	 }
	  
	  if(isset($number_right)){
	  	$sae_sms_text=array('text'=>$msg);
	  	drupal_write_record('sae_sms_text',$sae_sms_text);
	  	$mobiles = array_unique($number_right);
			 // drupal_set_message('本次发送信息'.count($mobiles).'条:','status');
			 // drupal_set_message('信息内容：<br/>【'.$msg.'】','status');
	  	$return = '本次发送信息'.count($mobiles).'条:'.'信息内容：<br/>【'.$msg.'】';
			watchdog('send_sms',$return.print_r($mobiles,TRUE));
			$text_id = db_query('select text_id from sae_sms_text order by text_id desc limit 0,1')->fetchField();
			
	  	foreach ($mobiles as $key => $mobile) {
	  		$sms = apibus::init("sms"); //创建短信服务对象
				$obj = $sms->send( $mobile, $msg , "UTF-8"); 
				global $user;
				$sae_sms_history = array(
					'uid'=>$user->uid,
					'receive'=>$mobile,
					'text_id'=>$text_id,
					'created'=>time(),
				);
				drupal_write_record('sae_sms_history',$sae_sms_history);
        //dpm( $sms ); 
			}
	  }

 } 
 ?>
 <!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href="http://lib.sinaapp.com/js/jquery-mobile/1.1.0/jquery.mobile-1.1.0.min.css" rel="stylesheet" type="text/css"/>
	<link href="http://lib.sinaapp.com/js/jquery-mobile/1.1.0/jquery.mobile.theme-1.1.0.min.css" rel="stylesheet" type="text/css"/>
	<script src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.1.0/jquery.mobile-1.1.0.min.js" type="text/javascript"></script>
</head>
<body>
	
 <div data-role="page" id="page_send_sms"> 
  <script type="text/javascript" charset="utf-8" src="send_sms.js"></script>
  <div data-role="header" data-position="inline">
    <h1>添加sms</h1>
    <a href="#page_dashboard" data-icon="home" data-transition="fade" data-iconpos="notext">首页</a> <a href="#page_dashboard" data-icon="back" data-iconpos="notext">返回</a> </div>
  <!-- /header -->
  
  <div data-role="content" class='content'>
    <div>
      <label for="page_node_title">手机号</label>
      <textarea id="sms_mobile"></textarea>
    </div>
    <div>
      <label for="page_node_body">内容</label>
      <textarea id="sms_msg"></textarea>
    </div>
    <fieldset>
      <div>
        <button type="button" data-theme="b" id="page_send_sms_submit">提交</button>
      </div>
    </fieldset>
  </div>
</body>
</html>