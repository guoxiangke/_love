<?php
function get_inhim() {
	// get created node in_him.
	$content_type = 'in_him';
	$today = mktime(0, 0, 0, date('n'),date('j'), date('Y'));
	$end = $today + 86400;
	$query = "SELECT n.nid nid, n.created created FROM {node} n  WHERE n.type = :type AND  n.created >$today AND n.created <$end  order by n.created desc limit 0,1";
	$result = db_query($query, array(':type' => $content_type))->fetch();
	// dpm($result->nid);
	if($result->nid) {
		$node = node_load($result->nid);	
		if(!strstr($node->title,'523')) {
		// dpm(strstr($node->title,'523'));
			return;
		}
	}else{
		// created node
	}
	
	$url = 'http://liangyou.net/Common/Reader/Channel/ShowPage.jsp?Cid=1484&Pid=45&Version=0&Charset=gb2312&page=0';
	  $html = file_get_html($url);
		// get title
		$node->uid = '618';
		//get title
	  $node->title = str_replace('在天父怀中：', '', trim($html->find('h2', 0)->plaintext) );
	  // get body
	  $node->body[LANGUAGE_NONE][0]['value'] = trim($html->find('td[width="600"]',1)->innertext);
	  $node->body[LANGUAGE_NONE][0]['format'] = 'filtered_html';
	  $node->field_wechat_url[LANGUAGE_NONE][0]['value'] =   'http://liangyou.net'. $html->find('td[class="caltableToday"] a',0)->attr['href'];
	  node_save($node);
}
function ybread_page(){
	$content_type = 'ybread';
	// get latest node.
	$query = "SELECT n.nid nid, n.created created FROM {node} n  WHERE n.type = :type order by n.created desc limit 0,1";
	$result = db_query($query, array(':type' => $content_type))->fetch();

  //dvm(12*60*60);
  $now = date('d',time());
  $hour = date('G',time());
  $last = date('d',$result->created);

  if($now - $last >= 1 && $hour >= 7) {
	  $html = file_get_html('http://simplified-odb.org/');
		// get title
		$node = new stdClass();
		$node->uid = '172'; //uid of love.
		$node->type = 'ybread';
		node_object_prepare($node);
		//get title
	  $node->title = trim($html->find('h1.entry-title', 0)->plaintext);
	  // get body
	  $node->body[LANGUAGE_NONE][0]['value'] = trim($html->find('.entry-content', 0)->plaintext);
	  $node->language = LANGUAGE_NONE;
	 	// Try to set your custom field
	  $html = file_get_html('http://ya-mi.org/');

	  $picture = $html->find('#featured-section .entry img', 0);
	  $pic_url = $picture->attr['src'];

		// $keys = parse_url($pic_url); // parse the url
		// $path = explode("/", $keys['path']); // splitting the path
		// $file_name = end($path); // get the value of the last element 
		// $destination = file_build_uri($file_name);

	 //  //file_put_contents($file_path, file_get_contents($pic_url));
	 //  $file = file_save_data($data=file_get_contents($pic_url), $destination, $replace = FILE_EXISTS_RENAME);
	 //  dpm($file,'file1');//	$file = file_move($file, $destination, $replace = FILE_EXISTS_RENAME) ;

	 //  $node->field_ybread_img[LANGUAGE_NONE][0]['value'] = objectToArray($file);
	  //'<div class="ybread-img"><img src ="'.$pic_url.'"/></div>'.
	  $node->body[LANGUAGE_NONE][0]['value'] = '<div class="ybread-img"><img src ="'.$pic_url.'"/></div>'.$node->body[LANGUAGE_NONE][0]['value']
	  // $node->body[LANGUAGE_NONE][0]['value'] = $node->body[LANGUAGE_NONE][0]['value'];
	  $node->body[LANGUAGE_NONE][0]['format'] = 'full_html';
	  
	  node_save($node);
  }else{
  	$nid = $result->nid;
	$node = node_load($nid);
  }
  dpm($node);
  // <div style="padding:10px;background-color:yellow;margin-bottom:10px;">版权关系，灵命日粮 文字内容请百度“<a href="http://www.baidu.com/s?wd=%C1%E9%C3%FC%C8%D5%C1%B8">灵命日粮</a>”到官方网站阅读，给您带来不便，敬请谅解。</div>
  $player ='<div class="ybread-player"><embed src="http://audio.liangyou.net/download.php?t=2&c=bv&f=bv'.date("ymd").'.mp3" width="430" height="50" type="application/x-mplayer2" autostart="1" showstatusbar="1" showdisplay="0" showcontrols="1" loop="-1" style="margin:0px auto;"></embed></div><div><p style="font-size:14px;">'."<p><audio src='http://liangyou.nissigz.com/media/bv/bv".date("ymd").".mp3' controls='controls'>
Your browser does not support the audio element.
</audio></p>".' 收听帮助: </p>
				<p> 
					选择 “开始-&gt;控制面板-&gt;添加删除程序-&gt;设定程序和访问默认值-&gt;双击 自定义-&gt;
					往下拉找到 选择一个媒体播放器-&gt;选择window media player 确定”
				</p>
				<p style="color:#666">下载收听:<a href="http://liangyou.nissigz.com/media/bv/bv'.date("ymd").'.mp3" >今日节目</a> &nbsp;&nbsp;音频来源：良友电台&nbsp;liangyou.net &nbsp;&nbsp;文字来源： http://simplified-odb.org </p></div>';

  $node_view = node_view($node); //drupal_render($node_view).;
  return drupal_render($node_view).$player;
}

//////////////////////////////////
// function objectToArray($d) {
// 		if (is_object($d)) {
// 			// Gets the properties of the given object
// 			// with get_object_vars function
// 			$d = get_object_vars($d);
// 		}
 
// 		if (is_array($d)) {
// 			/*
// 			* Return array converted to object
// 			* Using __FUNCTION__ (Magic constant)
// 			* for recursive call
// 			*/
// 			return array_map(__FUNCTION__, $d);
// 		}
// 		else {
// 			// Return array
// 			return $d;
// 		}
// 	}

// 	function arrayToObject($d) {
// 		if (is_array($d)) {
// 			/*
// 			* Return array converted to object
// 			* Using __FUNCTION__ (Magic constant)
// 			* for recursive call
// 			*/
// 			return (object) array_map(__FUNCTION__, $d);
// 		}
// 		else {
// 			// Return object
// 			return $d;
// 		}
// 	}

// /**
//  * Curl版本
//  * 使用方法：
//  * $post_string = "app=request&version=beta";
//  * request_by_curl('http://facebook.cn/restServer.php',$post_string);
//  */
// function request_by_curl($remote_server, $post_string)
// {
// 	$ch = curl_init();
// 	curl_setopt($ch, CURLOPT_URL, $remote_server);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_USERAGENT, "Jimmy's CURL Example beta");
// 	$data = curl_exec($ch);
// 	curl_close($ch);
// 	return $data;
// } 
