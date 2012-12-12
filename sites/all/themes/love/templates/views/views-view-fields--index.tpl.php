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
	$vote = $value;
	$flag = $ops;
	//dpm($field_name,$name);

	  global $user;
	  $ur_way = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid)),array('count'=>1));
	  $friends = FALSE;
	  $acquaintance = FALSE;
	  $acquaintanced = FALSE; 
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
	      $acquaintance = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid),'requester_id'=>$user->uid),array('count'=>1));
        $acquaintanced = user_relationships_load(array('rtid' => array(1),'between' => array($user->uid,$profile_uid),'requester_id'=>$profile_uid),array('count'=>1));
	      break;
	  }
	// 
	$real_name = $name;
	if(!is_null($fields['field_name']->content)){
		$real_name = $field_name;
	}
	$display_name= $friends?$real_name:$name;
?>
<div class="t-pic float-l">
	<div class="round120<?php if(isset($fields['field_sex'])) print $field_sex?" boy":" girl" ?>">
		<?php print l($picture,'user/'.$profile_uid,array('html'=>TRUE)) ; ?>
	</div>
	<?php if($user->uid != $profile_uid):?>
	<div class="t-user-info">
		<div>
			<?php if(!isset($field_sex)) $field_sex=TRUE; ?>
			<span><img src="<?php print drupal_get_path('theme','love'); print $field_sex?'/images/ic_sex_male.png':'/images/ic_sex_female.png';?>"></span>
			<?php print $display_name;?>
			<span><img src="<?php print drupal_get_path('theme','love'); print $field_sex?'/images/ic_user_male2.png':'/images/ic_user_famale2.png';?>"></span>
		</div>
		<div>
			<span><img src="<?php print drupal_get_path('theme','love'); print '/images/sns_shoot_location_normal.png';?>"></span>
			北京海淀</div>
		<?php
			if($friends){ ?>
				<span><img title="你们是好友" src="<?php print drupal_get_path('theme','love'); print '/images/ic_userinfo_bothfollow.png';?>"></span>
			<?php
			}elseif($no_relationships){ ?>
			
			  <span><img title="+认识Ta" src="<?php print drupal_get_path('theme','love'); print '/images/contact_list_add_friend.png';?>"></span>
				<span><img title="+认识Ta" src="<?php print drupal_get_path('theme','love'); print '/images/find_more_friend_addfriend_icon.png';?>"></span>
			<?php }
			if($acquaintanced){ ?>
				<span><img title="Ta想认识你" src="<?php print drupal_get_path('theme','love'); print '/images/mm_title_btn_add_contact_normal.png';?>"></span>
			<?php 
			}
			if($acquaintance){ ?>
				<span><img title="你想认识Ta" src="<?php print drupal_get_path('theme','love'); print '/images/mm_title_btn_add_contact_normal.png';?>"></span>
			<?php 
			}
		 ?>
		
		<span><img src="<?php print drupal_get_path('theme','love'); print '/images/net_setalias_icon.png';?>"></span>
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
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/btn_top_normal.png';?>"></span>
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/btn_top_pressed.png';?>"></span>
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/friendactivity_likeicon.png';?>"></span>
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/zemoji_e335.png';?>"></span>
		<span><img title="收藏" src="http://simg.sinajs.cn/xblogstyle/images/common/icon_like.png"></span>
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/discuss_for_support_off.png';?>"></span>
		<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/discuss_for_support_on.png';?>"></span>
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
			 <span><img title="赞" src="<?php print drupal_get_path('theme','love'); print '/images/smiley_79.png';?>"></span>
			 <span><img title="踩" src="<?php print drupal_get_path('theme','love'); print '/images/smiley_80.png';?>"></span>

			<span><img title="收藏" src="<?php print drupal_get_path('theme','love'); print '/images/smiley_66.png';?>"></span>
		  <span><img title="踩" src="<?php print drupal_get_path('theme','love'); print '/images/smiley_67.png';?>"></span>
		 </div>
		 	<?php endif; ?>
		</div>
	</div>
</div>