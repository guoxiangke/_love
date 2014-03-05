<?php



function _mp_node_create($keyword, $nodetype = 'love_diary', $uid = 1) {
  $title = truncate_utf8($keyword, 15, $wordsafe = FALSE, $add_ellipsis = FALSE, $min_wordsafe_length = 1);

  $node = new stdClass();
  $node->title = $title;
  $node->type = $nodetype;
  node_object_prepare($node); // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
  $node->language = LANGUAGE_NONE; // Or e.g. 'en' if locale is enabled
  $node->uid = $uid;
  $node->status = 1; //(1 or 0): published or not
  $node->promote = 0; //(1 or 0): promoted to front page
  $node->comment = 0; // 0 = comments disabled, 1 = read only, 2 = read/write
  $node->path['pathauto'] = false;
  $node->body[$node->language][0]['value']   = $keyword.'<div class="love-source"><span class="ll-date-details">'.date('l H:i').'</span> 【微信发布】</div>';
  // $node->body[$node->language][0]['summary'] = text_summary($keyword);
  $node->body[$node->language][0]['format']  = 'full_html';
  if($nodetype == 'love_diary') {
    $last_diary = db_query("SELECT node.created AS node_created, node.nid AS nid
FROM 
{node} node
WHERE (( (node.status = '1') AND (node.type IN  ('love_diary')) ))
ORDER BY node_created DESC
LIMIT 10 OFFSET 0")->fetchAssoc();
    if(date('Y-m-d', $last_diary['node_created']) == date('Y-m-d', strtotime('now'))) {
      $node = node_load($last_diary['nid']);
      $node->title = date('n月j日');
      $node->body[$node->language][0]['value']   .= '<div class="ll-diary-added"><br/></div>'.$keyword.'<div class="love-source"><span class="ll-date-details">'.date('l H:i').'</span> 【微信发布】</div>';
    }
    node_save($node);//\n".$tip."
    return $contentStr = "恭喜您【".$node->title."】\n日志更新成功，http://wx.dev.camplus.hk/node/$node->nid";

    $node->field_date[LANGUAGE_NONE][0]['value'] =  date('Y-m-d H:i:s', strtotime('now'));
  }

  // 【201】无主情话(随便说点情话)-38
  // 【202】时光隧道(分享我的过去)-39
  // 【203】独居生活(记录现在的生活)-40
  // 【204】想对你说(写给喜欢的人)-41

  // $node->field_status_topic[$node->language][0]['tid'] = $menukey-163;
  ////////begin @see love_layout_node_presave($node)
   // $pattern = '/#([^\\#|.]+)#|＃([^\\＃|.]+)＃/';
   // preg_match_all($pattern, $node->title, $matches, PREG_SET_ORDER);
   // $node->field_status_tags[LANGUAGE_NONE] = array();
   // foreach ($matches as $key => $value) {

   //    $term_name = $value[1];
   //    $term = taxonomy_get_term_by_name($term_name);
   //    //new one
   //    if(!count($term)){
   //     $term = new stdClass();
   //     $term->vid = 1;
   //     $term->name = $term_name;
   //     taxonomy_term_save($term);
   //     //$term = taxonomy_get_term_by_name($term_name);
   //     foreach ($term as $value) {
   //        //dpm($value,$key);
   //        $node->field_status_tags[LANGUAGE_NONE][$term->tid]['tid'] = $term->tid;
   //      }
   //    }else{
   //      foreach ($term as $tid => $value) {
   //        // dpm($value,$tid);
   //        $node->field_status_tags[LANGUAGE_NONE][$tid]['tid'] = $tid;
   //      }
   //    }
   // }
  ///////////end
  if($node = node_submit($node)) { // Prepare node for saving
      node_save($node);//\n".$tip."
      $contentStr = "恭喜您【".$keyword."】\n发布成功，http://wx.dev.camplus.hk/node/$node->nid";
  }
  return $contentStr;
}


function _mp_get_mp_node($type = 'grace365', $counts = 1) {
  
  $query = db_select('node', 'n');
  $query->fields('n', array('nid'));
  $query->condition('n.status', 1,'=');
  $query->condition('n.type', $type,'=');
  $query->orderBy('n.created', 'DESC');
  $query->range(0, $counts);
  $results = $query->execute()->fetchAll();

  $default_image = ybzx_get_default_image_field_value($type, $field_name = 'field_image', $type = 'default_image', $entity_type = 'node');
  $second_image = 'http://wx.dev.camplus.hk/sites/default/files/pictures/picture-172-1356487827.jpg';

  if(count($results))
    foreach ($results as $key => $value) {
      $node = node_load($value->nid);

      $des = decode_entities(check_markup($node->body[LANGUAGE_NONE][0]['value']));
      $des = strip_tags($des);
      $des = str_replace('&nbsp;&nbsp;',"\n",$des);
      $des = str_replace('&nbsp;',' ',$des);
      $des = truncate_utf8($des, 300, $wordsafe = FALSE, $add_ellipsis = TRUE, $min_wordsafe_length = 1);

      if($node->field_image) {
        $default_uri = $node->field_image[LANGUAGE_NONE][0]['uri'];
        $default_image = file_create_url($default_uri);
      }
      $img = array(
          'Title'=> $node->title,
          'Description'=>$des,
          'PicUrl'=>$default_image,
          'Url'=> url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q=').'node/'.$node->nid,
        );
      $news[] = $img;
      return $news;
    }
}
