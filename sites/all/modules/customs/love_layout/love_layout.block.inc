<?php
/**
 * blocks info of custom love.
 */


/**
 * Get relate user info , context will be  used.
 */
function love_block_user_info() {
  global $user;
  //TODO: 
  // if(arg(0) == 'user'){
  //   $account = user_load(arg(1));
  //   $account = $account->uid?$account:$user;
  // }else {
  //   $account = $user;
  // }
  // $account = $account->uid?$account:$user;
  $account = $user;
  $variables['account'] = $account;
  $variables['image_style'] = 'sc250';
  $picture = love_layout_template_preprocess_user_picture($variables);
  if($account->uid)
  $signature = $account->signature?$account->signature:"这家伙很懒，还没写签名....这家伙很懒，还没写签名....这家伙很懒，还没写签名....";
  $variables['account'] = $account;
  // '.l('<em class="icon-setting"></em>完善资料','user/'.$account->uid.'/edit/believes',array('html'=>TRUE,'attributes'=>array('class'=>'link-mt','target'=>"_blank"))).'
  //'.l('<em class="icon-upload"></em>进入相册','user/'.$account->uid.'',array('html'=>TRUE,'attributes'=>array('class'=>'link-mt','target'=>"_blank"))).'
  $output = '<div class="right-module module-selfInfo" data-log="userIntro">
            '.$picture.'
            <div class="module-selfInfo-inner">
               <div class="module-selfInfo-arrow">
                  <em class="icon-user-arrow"></em>
               </div>
               <div class="module-selfInfo-title">
                  <h2><a class="link-mt" data-log="nickname" target="_blank" href="/601017">'.$account->name.'</a></h2>
               </div>
               <div id="selfInfo" class="module-selfInfo-setting">
                  <ul>
                     <li>
                        <h3 class="text-md">个人资料</h3>
                        
                     </li>
                     <li class="noBg">
                        <h3 class="text-md">我的相册</h3>
                     </li>
                     <li>
                        <h3 class="text-md">我的缘分</h3>
                        <a class="link-mt" href="/followers" target="_blank">被收藏0</a>
                        <span class="text-sd fR" style="margin:-1px 3px 0;">|</span>
                        <a class="link-mt" href="/following" target="_blank">收藏<em class="js-following-count">7</em></a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>';
  $output2 = '
  <div class="aside">
              <div class="info-box">
                  <div class="avatar">
                     '.$picture.'
                  </div>
                  <div class="description description-with-follow">
                    '.truncate_utf8($signature, $max_length=120, $wordsafe = FALSE, $add_ellipsis = TRUE, $min_wordsafe_length = 1).'

                  </div>
                  <div class="links links-with-follow">
                      <a href="">+熟人</a> /
                      '.l(t('Messages'),'messages/new/'.$account->uid,array('query' => drupal_get_destination())).' / 
                      '.l(t('Blog'),'user/'.$account->uid.'/blog',array('query' => drupal_get_destination())).' / 
                      <a href="">+粉丝</a>
                  </div>
                  
                  <div class="follow">
                  '._love_user_relationships_link($variables).'
                  </div>
                  
              </div>
          </div>';
         
  return $output;//.drupal_render(menu_local_tasks());
}

function love_block_profile_info() {
    //TODO: 
  global $user;
  if(arg(0) == 'user'){
    $account = user_load(arg(1));
    $account = $account->uid?$account:$user;
  }else {
    $account = $user;
  }
  $account = $account->uid?$account:$user;
  // $account = $user;
  $variables['account'] = $account;
  $variables['image_style'] = 'sc250';
  $picture = love_layout_template_preprocess_user_picture($variables);
  if($account->uid)
  $signature = $account->signature?$account->signature:"这家伙很懒，还没写签名....这家伙很懒，还没写签名....这家伙很懒，还没写签名....";

  $profile = profile2_load_by_user($account);
  //dpm($profile);
  if(isset($profile['main']->field_name[LANGUAGE_NONE][0]['safe_value']))
  $display_name = $profile['main']->field_name[LANGUAGE_NONE][0]['safe_value'];
  //$display_name = $field_name;
  $field_birthday = $profile['main']->field_birthday[LANGUAGE_NONE][0]['value'];
  $year_now =  date("Y",time());
  $year_born =  date("Y",strtotime($field_birthday));
  $field_height  = $profile['main']->field_height[LANGUAGE_NONE][0]['value'];
  //TODO more....
  if(isset($profile['main']->field_character[LANGUAGE_NONE][0]['taxonomy_term']))
  $field_character  = $profile['main']->field_character[LANGUAGE_NONE][0]['taxonomy_term']->name;
  if(isset($profile['believes'])){
    $province = $profile['believes']->field_address[LANGUAGE_NONE][0]['province'];
    $city = $profile['believes']->field_address[LANGUAGE_NONE][0]['city'];
    $county = $profile['believes']->field_address[LANGUAGE_NONE][0]['county'];

    $province = china_address_get_region_name($province);
    $city = china_address_get_region_name($city);
    $county = china_address_get_region_name($county);
    if($province==$city){
      $now_local = $province.$county;
    }else{
      $now_local = $province.$city;
    }
  }

  {//if(isset($profile['main']))
    $province = $profile['main']->field_address[LANGUAGE_NONE][0]['province'];
    $city = $profile['main']->field_address[LANGUAGE_NONE][0]['city'];
    $county = $profile['main']->field_address[LANGUAGE_NONE][0]['county'];

    $province = china_address_get_region_name($province);
    $city = china_address_get_region_name($city);
    $county = china_address_get_region_name($county);
    if($province==$city){
      $home_local = $province.$county;
    }else{
      $home_local = $province.$city;
    }

  }

  $all_fields_on_my_website = field_info_fields();
  if(isset($profile['main']->field_degree[LANGUAGE_NONE][0])){
    $field_degree = $profile['main']->field_degree[LANGUAGE_NONE][0]['value'];
    $degree_value = list_allowed_values($all_fields_on_my_website["field_degree"]);
    $field_degree = $degree_value[$field_degree];
  }
  if(isset($profile['main']->field_links[LANGUAGE_NONE][0])){
    $field_links = $profile['main']->field_links[LANGUAGE_NONE][0]['value'];
    $field_links_title = $profile['main']->field_links[LANGUAGE_NONE][0]['title'];
  }

  $field_marriage = $profile['main']->field_marriage[LANGUAGE_NONE][0]['value'];
  $marriage_value = list_allowed_values($all_fields_on_my_website["field_marriage"]);
  $field_marriage = $marriage_value[$field_marriage];

  if(isset($profile['main']->field_industry[LANGUAGE_NONE][0])){
    $field_industry = $profile['main']->field_industry[LANGUAGE_NONE][0]['value'];
    $industry_value = list_allowed_values($all_fields_on_my_website["field_industry"]);
    $field_industry = $industry_value[$field_industry];
  }
  if(isset($profile['main']->field_salary[LANGUAGE_NONE][0])){
    $field_salary = $profile['main']->field_salary[LANGUAGE_NONE][0]['value'];
    $values = list_allowed_values($all_fields_on_my_website["field_salary"]);
    $field_salary = $values[$field_salary];
  }
  if($account->uid != $user->uid){
   $my_space = FALSE;
   $ur = love_ur_between($account);
   if($ur == 'friends'){//<->
    $ur_output = '<i class="icon-retweet"></i>互相关注';
    $ur_action =l('<i class="icon-minus"></i>取消关注',"ajax/relationship/$account->uid/request/1",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action','btn-fav', 'mess-trigger'),'title'=>'取消关注')));
   }elseif($ur == 'follow'){//->
    $ur_output = '<i class="icon-arrow-left"></i>你关注了Ta';

    $ur_action =l('<i class="icon-minus"></i>取消关注',"ajax/relationship/$account->uid/request/1",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action','btn-fav', 'mess-trigger'),'title'=>'取消关注')));
   }elseif($ur == 'follower'){//<-
    $ur_output = '<i class="icon-arrow-right"></i>Ta关注了你';
    $ur_action =l('<i class="icon-plus"></i>关注Ta',"ajax/relationship/$account->uid/request/1",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action','btn-fav', 'mess-trigger'),'title'=>'关注Ta')));
   }else{
    $ur_action =l('<i class="icon-plus"></i>关注Ta',"ajax/relationship/$account->uid/request/1",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action','btn-fav', 'mess-trigger'),'title'=>'关注Ta')));
    $ur_output = '<a href="#" rel="tooltip" data-placement="right" title="暂无关系"><i class="icon-eye-close"></i></a>';
   }
   $privite_msg = '<a class="btn-mess mess-trigger" href="/messages/new/'.$account->uid.'">
           <span class="btn-mess-txt"><i class="icon-envelope"></i>私信</span>
          </a> ';
  }else{
    $ur_action =l('<i class="icon-cogs"></i>完善信息',"user/$account->uid/edit/believes",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action','btn-fav', 'mess-trigger'),'title'=>'关注Ta')));
    $privite_msg = '<a class="btn-mess mess-trigger" href="messages/recent">
           <span class="btn-mess-txt"><i class="icon-envelope"></i>私信</span>
          </a> ';

    $ur_output = '<a href="#" rel="tooltip" data-placement="right" title="nothings"><i class="icon-eye-open"></i></a>';
    $my_space = TRUE;
    $edit_profile_main_link = l('－－','user/'.$account->uid.'/edit/main',array('attributes'=>array('title'=>'现在完善','rel'=>'tooltip','data-placement'=>'right')));
    $edit_profile_believes_link = l('－－','user/'.$account->uid.'/edit/believes',array('attributes'=>array('title'=>'现在完善','rel'=>'tooltip','data-placement'=>'right')));
    $edit_profile_love_link = l('－－','user/'.$account->uid.'/edit/requirements',array('attributes'=>array('title'=>'现在完善','rel'=>'tooltip','data-placement'=>'right')));
  }

	$output = '<div id="basicInfoBox" class="profile-basic profile-basic-edit">
         <div class="profile-avatar">'.$picture.'</div>
         <div class="profile-basic-main">
                              <!--div class="profile-elite elite-school js-eliteTag">
                           <div class="profile-elite-school" title="">神的</div>
                           <div class="profile-elite-corp" title="">宝贝</div>
                  <div class="profile-elite-arrow">
            <em class="profile-arrow-income"></em>
            <em class="profile-arrow-school"></em>
            <em class="profile-arrow-corp"></em>
         </div>
      </div-->
            <div class="profile-verify">
                     <em title="在线" class="icon-female"></em>
      
         <span id="profileVerifyName" class="profile-name">'.(isset($display_name)?truncate_utf8($display_name, $max_length=8, $wordsafe = FALSE, $add_ellipsis = TRUE):$account->name).'</span><span class="profile-age">'.($year_now-$year_born).'岁</span>
                                 <a title="身份已认证" target="_blank" href="/verified/name" class="icon-verify"></a>
         
                           <a title="手机未认证" target="_blank" href="/verified/mobile" class="icon-mobile-disabled"></a>'.$ur_output.'
                     </div>
            <div class="js-preview">
         <ul class="profileList">
            <li><span class="profile-label">身高：</span>'.$field_height.'cm</li>
             <li><span class="profile-label">性格特点：</span>'.(isset($field_character)?$field_character:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).' </li>
            <li><span class="profile-label">恋爱状态：</span>'.$field_marriage.'</li>
            <li><span class="profile-label">来自：</span>'.(isset($now_local)?$now_local:($my_space?$edit_profile_believes_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙神秘，没有留下踪迹！">－－</a>')).'</li>
            <li><span class="profile-label">学历：</span>'.(isset($field_degree)?$field_degree:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).'</li>
            <li><span class="profile-label">籍贯：</span>'.(isset($home_local)?$home_local:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).'<i class="icon-unlock"></i></li>
            <li><span class="profile-label">行业：</span>'.(isset($field_industry)?$field_industry:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).'</li>
            <li title=""><span class="profile-label">链接：</span>'.(isset($field_links_title)?$field_links_title:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).'</li>
           
            <!--li><span class="profile-label">月均收入：</span>'.(isset($field_salary)?$field_salary:($my_space?$edit_profile_main_link:'<a href="#" rel="tooltip" data-placement="right" title="这家伙很懒，还在空着！">－－</a>')).'</li-->
         </ul>
      </div>
            <div class="js-edit"></div>
        <div class="profile-relation-btn">
          '.$privite_msg.$ur_action.'
      </div>
               </div>
</div>';
	return $output;
}


function love_block_about_us() {

  $output =  '
      <ul class="about-us">
        <li>1.我们坚信婚姻是神所设立的，是对我们幸福生活的美好设计。</li>
        <li>2.我们认为组建家庭是神对人的一项呼召，在家庭中彰显神的荣耀。</li>
        <li>3.基于圣经，我们认为神所设立的美好婚姻是：一男一女、一夫一妻、一生一世,信与不信原不相配。</li>
        <li>4.我们确信神在创世之先已未我们预备了另一半。</li>
        <li>5.我们相信神对我们的爱永不止息。</li>
      <div>【永不止息】只接受熟人间邮箱邀请注册，请为您邀请的肢体祷告，您在熟人之间互相介绍时，应慎重，严谨，并为之代祷。</div>
      <div>爱是永不止息，是互相激励成长，需要公众见证，公开交往，接受监督的，让更多的肢体在婚恋交友，及组建家庭上彰显神的荣耀</div>
      </ul>';
  return $output;
}
?>