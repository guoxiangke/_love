<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php /*foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; ?>
  <?php print $field->wrapper_suffix; ?>
<?php endforeach; */?>

<?php
/**
 * new fields:
 * $picture
 * $name
 * $field_photo $body $created $filed_tags $edit_node $delete_node
 */
	foreach ($fields as $id => $field) {
		$$id = $field->wrapper_prefix.$field->label_html.$field->content.$field->wrapper_suffix;
		if (!empty($field->separator)){
			$$id .= $field->separator;
		}
	}
	$profile_uid = $fields['uid']->raw;
	//give frendly name...
	$account = user_load($profile_uid);
	$profile = profile2_load_by_user($account);

	if(isset($profile['believes'])){
		$province = $profile['believes']->field_address[LANGUAGE_NONE][0]['province'];
		$city = $profile['believes']->field_address[LANGUAGE_NONE][0]['city'];
		$county = $profile['believes']->field_address[LANGUAGE_NONE][0]['county'];
	}else{
		$province = $profile['main']->field_address[LANGUAGE_NONE][0]['province'];
		$city = $profile['main']->field_address[LANGUAGE_NONE][0]['city'];
		$county = $profile['main']->field_address[LANGUAGE_NONE][0]['county'];
	}
	$province = china_address_get_region_name($province);
	$city = china_address_get_region_name($city);
	$county = china_address_get_region_name($county);
	if($province==$city){
		$local = $province.$county;
	}else{
		$local = $province.$city;
	}

	$vote = $value;
	$flag = $ops;
	//dpm($field_name,$name);

	  global $user;
	  $ur_way = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid)),array('count'=>1));
	  $friends = FALSE;
	  $follow = FALSE;
	  $follower = FALSE; 
	  $no_relationships = FALSE;
	  switch ($ur_way) {
	    case '2':
	      // two-way relationships.
	      $friends = TRUE;
	      break;
	    case '0':
	    	$no_relationships = TRUE;
	      // no-way relationships.
	      break;
	    default:
	    	// one-way relationships.
	    $follow = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid),'requester_id'=>$user->uid),array('count'=>1));
        $follower = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid),'requester_id'=>$profile_uid),array('count'=>1));
	      break;
	  }
	// 
	$real_name = $name;
	if(!is_null($fields['field_name']->content)){
		$real_name = $field_name;
	}
	$display_name= $friends?$real_name:$name;
	if(!isset($fields['field_sex']))$fields['field_sex']=TRUE;
	$Ta = $field_sex?"他":"她";
?>
<div class="t-pic float-l">
	<div class="round120<?php if(isset($fields['field_sex'])) print $field_sex?" boy":" girl" ?>">
		<?php print l($picture,'user/'.$profile_uid,array('html'=>TRUE)) ; ?>
	</div>
	<?php if($user->uid != $profile_uid):?>
	<div class="t-user-info">
		<ul>
				<li><i class="icon-th-list icon-large"></i></li>
				<li><i class="icon-camera-retro icon-large"></i></li>
				
				<li><a href="" rel="tooltip" data-placement="right" title="<?php echo $local;?>"><i class="icon-map-marker"></i></a></li>
		<?php
			if($friends){ ?>
				<li><a href="" rel="tooltip" data-placement="right" title="互相关注"><i class="icon-retweet"></i></a></li>
				<li><a href="" rel="tooltip" data-placement="right" title="取消关注"><i class="icon-minus"></i></a></li>
			<?php
			}elseif($no_relationships){ ?>
				<li><a href="" rel="tooltip" data-placement="right" title="关注<?php echo $Ta;?>"><i class="icon-plus"></i></a></li>
			<?php }
			if($follower){ //Ta想认识你?>
			<li><a href="" rel="tooltip" data-placement="right" title="关注<?php echo $Ta;?>"><i class="icon-plus"></i></a></li>
				<li><a href="" rel="tooltip" data-placement="right" title="<?php echo $Ta;?>关注了你"><i class="icon-arrow-left"></i></a></li>
			<?php 
			}
			if($follow){ //你想认识Ta?>
				<li><a href="" rel="tooltip" data-placement="right" title="你关注了<?php echo $Ta;?>"><i class="icon-arrow-right"></i></a></li>
				<li><a href="" rel="tooltip" data-placement="right" title="取消关注"><i class="icon-minus"></i></a></li>
			<?php 
			}
		 ?>
		</ul>
		
	</div>
	<?PHP endif; ?>
</div>

<div class="t-Con float-l">
	<div class="t-author clearfix">
		<?php 
			//delete when user has real name...
			
			// TODO:是朋友，显示真名，否则显示昵称
		?>
		<div class="t-name float-l"> <?php print l($display_name,'user/'.$profile_uid,array('html'=>true));?> 上传了照片</div>
		
	</div>
	<?php if (isset($body)): ?><div class="t-body"> <?php //print $body; ?> </div><?php endif; ?>
	<div class="t-field_photo">
		<?php if (isset($field_photo)): ?><span class="photo"> <?php print $field_photo; ?> </span><?php endif; ?>
		<?php if (isset($flag)): ?>
		<span class="flag"> <?php print $flag; ?> </span>
		<span><img title="收藏" src="http://simg.sinajs.cn/xblogstyle/images/common/icon_like.png"></span>
	<?php endif; ?>
	</div>
	<div class="t-footer clearfix">
		<!--div class="filed_tags float-l"> <?php print $field_tags; ?> </div-->
		<div class="t-created  float-l"> <?php print $created; ?> </div>
		<div class="t-links  float-r">
			<?php global $user; if ($user->uid<>0): //TODO ?>
			<?php if (isset($edit_node)): ?><span class="edit"> <?php print $edit_node; ?> </span><?php endif; ?>
			<?php if (isset($delete_node)): ?><span class="del"> <?php print $delete_node; ?> </span><?php endif; ?>
		 	<?php endif; ?>

		 	<?php if (isset($vote)): ?>
		 	<div class="vote"> <?php print $vote; ?>
		 		<ul>
		 			<li><a title="赞" href=""><i class="icon-thumbs-up"></i></a></li>
		 			<li><a title="踩" href=""><i class="icon-thumbs-down"></i></a></li>
		 		</ul>
		 	</div>
		 	<?php endif; ?>
		</div>
	</div>
</div>