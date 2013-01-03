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
	//dpm($profile);
	// views alter 
	if(isset($profile['main']->field_name[LANGUAGE_NONE]))
		$field_name = $profile['main']->field_name[LANGUAGE_NONE][0]['value'];
	
	if(isset($profile['main']->field_sex[LANGUAGE_NONE]))
		$field_sex = $profile['main']->field_sex[LANGUAGE_NONE][0]['value'];
	
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
	  $rtid = 1;//粉丝 关注
	  $ur_way = user_relationships_load(array('rtid' => array($rtid),'between' => array($user->uid,$profile_uid)),array('count'=>1));
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
	    $follow = user_relationships_load(array('rtid' => array($rtid),'between' => array($user->uid,$profile_uid),'requester_id'=>$user->uid),array('count'=>1));
        $follower = user_relationships_load(array('rtid' => array($rtid),'between' => array($user->uid,$profile_uid),'requester_id'=>$profile_uid),array('count'=>1));
	      break;
	  }
	// 
	$real_name = $name;
	if(isset($field_name)){
		$real_name = $field_name;
	}
	$display_name= $friends?$real_name:$name;
	if(!isset($field_sex))$fields=TRUE;
	$Ta = $field_sex?"他":"她";

  $field_birthday = $profile['main']->field_birthday[LANGUAGE_NONE][0]['value'];
  $year_now =  date("Y",time());
  $year_born =  date("Y",strtotime($field_birthday));
  if(isset($profile['main']->field_height[LANGUAGE_NONE][0])){
	$field_height  = $profile['main']->field_height[LANGUAGE_NONE][0]['value'];
  }else{
  	$field_height  = 'xxx';
  }
  //
  if(isset($profile['main']->field_marriage[LANGUAGE_NONE][0])){
  	  $all_fields_on_my_website = field_info_fields();
	  $field_marriage = $profile['main']->field_marriage[LANGUAGE_NONE][0]['value'];
	  $marriage_value = list_allowed_values($all_fields_on_my_website["field_marriage"]);
	  $field_marriage = $marriage_value[$field_marriage];
  }else{
  	$field_marriage = '婚恋状态-未知';
  }
?>
<div class="t-pic float-l">
	<div class="round120<?php print $field_sex?" boy":" girl" ?>">
		<?php print l($picture,'user/'.$profile_uid,array('html'=>TRUE)) ; ?>
	</div>
	<?php if($user->uid != $profile_uid):?>
	<div class="t-user-info">
		<ul>
		<?php
			if($friends){ ?>
				<li><a href="#" rel="tooltip" data-placement="right" title="互相关注"><i class="icon-retweet"></i></a></li>
				<!--li><a href="" rel="tooltip" data-placement="right" title="取消关注"><i class="icon-minus"></i></a></li-->
			<?php
			}elseif($no_relationships){ ?>
				<li><?php echo l('<i class="icon-plus"></i>',"ajax/relationship/$profile_uid/request/$rtid",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action'),'title'=>'关注'.$Ta,'rel'=>"tooltip",'data-placement'=>"right")));?>
					
			<?php }
			if($follower){ //Ta想认识你?>
				<li><a href="#" rel="tooltip" data-placement="right" title="<?php echo $Ta;?>关注了你"><i class="icon-arrow-left"></i></a></li>
				<li><?php echo l('<i class="icon-plus"></i>',"ajax/relationship/$profile_uid/request/$rtid",array('html'=>TRUE,'query' => drupal_get_destination(),'attributes'=>array('class' => array('love-icon','love-icon-action'),'title'=>'关注'.$Ta,'rel'=>"tooltip",'data-placement'=>"right")));?>
				
			<?php 
			}
			if($follow){ //你想认识Ta?>
				<li><a href="#" rel="tooltip" data-placement="right" title="你关注了<?php echo $Ta;?>"><i class="icon-arrow-right"></i></a></li>
				<!--li><a href="" rel="tooltip" data-placement="right" title="取消关注"><i class="icon-minus"></i></a></li-->
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
		<div class="t-name float-l"><?php print l($display_name,'user/'.$profile_uid,array('html'=>true)); print '，【'.$real_name.'】'.$field_marriage.'，'.($year_born).'，'.$field_height.'厘米，'.$local;?> </div>
		
	</div>
	<?php if (isset($body)): ?>
	<div class="t-body">
		<p>刚刚上传了相片</p>
		<div class="t-field_photo">
			<?php if (isset($field_photo)): ?><span class="photo"> <?php print $field_photo; ?> </span><?php endif; ?>
			<?php if (isset($flag)): ?>
			<!-- <span class="flag"> <?php print $flag; ?> </span>
			<span><ul>
			 			<li><a title="赞" href=""><i class="icon-star-empty"></i></a></li>
			 			<li><a title="踩" href=""><i class="icon-star"></i></a></li>
			 		</ul>
			</span> -->
			<?php endif; ?>
			<?php if (isset($vote)): ?>
			 	<div class="vote-1">
			 	<div class="love_vote"> <?php print $vote; ?> </div>
			 	</div>
			<?php endif; ?>

			<?php if (strlen($body)!=0): ?>
			<div class="t-des">
				<?php print $body; ?>
			</div>
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


			</div>
		</div>
	</div><?php endif; //<!--end t-body-->?>


</div>