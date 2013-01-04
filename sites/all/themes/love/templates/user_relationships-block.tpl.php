<?php
/**
 * @file Main relationships listing block
 * List the relationships between the viewed user and the current user
 */
if ($relationships) {
  $the_other_uid = $settings->block_type == UR_BLOCK_MY ? $user->uid : $account->uid;
  $showing_all_types = $settings->rtid == UR_BLOCK_ALL_TYPES;
  $rows = array();
  $output = '';
  foreach ($relationships as $rtid => $relationship) {
    $tt_rel_name = ur_tt("user_relationships:rtid:$rtid:name", $relationship->name);
    $tt_rel_plural_name = ur_tt("user_relationships:rtid:$rtid:plural_name", $relationship->plural_name); 
    if ($the_other_uid == $relationship->requester_id) {
      $rtype_heading = $relationship->is_oneway ? 
        t("@rel_name of", array('@rel_name' => $tt_rel_name, '@rel_plural_name' => $tt_rel_plural_name)) : 
        t("@rel_plural_name", array('@rel_name' => $tt_rel_name, '@rel_plural_name' => $tt_rel_plural_name));
      $relatee = $relationship->requestee;
    }
    else {
      $rtype_heading = t("@rel_plural_name", array('@rel_name' => $tt_rel_name, '@rel_plural_name' => $tt_rel_plural_name));
      $relatee = $relationship->requester;
    }

    $title = $rtype_heading;

    $username = theme('username', array('account' => $relatee));
    $variables['account'] = $relatee;

    $output  .= '<div class="recent-visit">' . "\n";
    $output .= love_layout_template_preprocess_user_picture($variables);
    $output .= ' <div class="name">' . $username . '</div>' . "\n";
    $output .= '</div>' . "\n";
  }

  print $output;//implode('', $output);
}
?>
