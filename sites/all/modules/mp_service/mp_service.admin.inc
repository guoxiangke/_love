<?php
function mp_service_settings_form($form, &$form_state) {
	$form['mp_service_uri'] = array(
		'#markup'=>url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q=').'mp_service_response',
		'#prefix' => '<b>Url:</b>',
	);
	$form['mp_service_token'] = array(
		'#type' => 'textfield', 
	  '#title' => t('Token'), 
	  '#default_value' => 'ybzx', 
	  '#size' => 60, 
	  '#maxlength' => 128, 
	  '#required' => TRUE,
	);
	dpm(variable_get('mp_service_uri', 'default'));
	return system_settings_form($form);
}