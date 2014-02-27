<?php

/**
 * @file
 * Admin page of EasyCron module.
 */

/**
 * Define a setting form
 */
function easycron_admin() {
  // Default cron job setings.
  $easycron_settings = array(    
    'easycron_cron_expression' => variable_get('easycron_cron_expression', ''),
    'email_me' => variable_get('easycron_email_me', '0'),
    'log_output_length' => variable_get('easycron_log_output_length', '0'),
    'status' => variable_get('easycron_status', '0'),
  );
  $easycron_token = variable_get('easycron_token', '');

  $form = array();

  $form['easycron_status'] = array(
    '#type' => 'radios',
    '#title' => t('Status'),
    '#default_value' => $easycron_settings['status'],
    '#options' => array(t('Disabled'), t('Enabled')),
    '#description' => t('This option enables or disables the webcron job running.'),
    '#required' => TRUE,
  );

  $form['easycron_token'] = array(
    '#type' => 'textfield',
    '#title' => t('easyCron token'),
    '#default_value' => $easycron_token,
    '#size' => 32,
    '#maxlength' => 32,
    '#description' => t('The API token you get from easycron.com.'),
    '#required' => TRUE,
  );

  $form['easycron_cron_expression'] = array(
    '#type' => 'textfield',
    '#title' => t('Cron expression'),
    '#default_value' => $easycron_settings['easycron_cron_expression'],
    '#size' => 68,
    '#maxlength' => 256,
    '#description' => t('A string specifys when to execute the cron job. Read more at easyCron\'s <a href="http://www.easycronlocal.com/faq/What-cron-expression-does-easycron-support" target="_blank">Cron Expression</a> page.'),
    '#required' => TRUE,
  );

  $form['easycron_email_me'] = array(
    '#type' => 'select',
    '#title' => t('Email me'),
    '#options' => array(
      '0' => t('never'),
      '1' => t('if execution fails'),
      '2' => t('after execution'),
    ),
    '#default_value' => $easycron_settings['email_me'],
    '#description' => t('Email me.'),
    '#required' => TRUE,
  );

  $form['easycron_log_output_length'] = array(
    '#type' => 'select',
    '#title' => t('Log output'),
    '#options' => array(
      '0' => t('No'),
      '10240' => t('Yes'),
    ),
    '#default_value' => $easycron_settings['log_output_length'],
    '#description' => t("Log webcron job's output (You can check the output on easycron.com)."),
    '#required' => TRUE,
  );

  return system_settings_form($form);
}

/**
 * Make webcron settings by connecting easycron.com
 */
function easycron_connect($action, $easycron_settings) {
  $settings_array = array();
  foreach ($easycron_settings as $key => $value) {
    $settings_array[] = $key . '=' . urlencode($value);
  }
  $settings_str = implode('&', $settings_array);
  $url = 'http://www.easycron.com/rest/' . $action . '?' . $settings_str;
  $result = drupal_http_request($url, array('headers' => array(), 'max_redirects' => 0));

  if ($result->code != 200) {
    form_set_error('', t('Cannot connect to easycron.com.'));
  }
  else {
    return json_decode($result->data, TRUE);
  }
}

/**
 * Validate setting form input and handle webcron setting errors returned from easycron.com
 */
function easycron_admin_validate($form, &$form_state) {
  global $base_url;
  if (strlen($form['easycron_token']['#value']) != 32) {
    form_set_error('easycron_token', t('The API token should be 32 characters\' long.'));
  }
  if (!form_get_errors()) {
    $easycron_settings = array(
      'token' => $form['easycron_token']['#value'],
      'cron_expression' => $form['easycron_cron_expression']['#value'],
      'email_me' => $form['easycron_email_me']['#value'],
      'log_output_length' => $form['easycron_log_output_length']['#value'],
      'url' => url($base_url . '/cron.php', array('external' => TRUE, 'query' => array('cron_key' => variable_get('cron_key', 'drupal')))),
      'testfirst' => 0,
    );
    $cron_job_id = variable_get('easycron_cron_job_id', '');
    if (empty($cron_job_id)) {
      $action = 'add';
    }
    else {
      // if there is already cron job ID in drupal system, use it
      $action = 'edit';
      $easycron_settings['id'] = $cron_job_id;
    }

    $result = easycron_connect($action, $easycron_settings);

    if ($result['status'] == 'success') {
      // Setting change done. The status switch is performed below
      if ($form['easycron_status']['#value']) {
        $action = 'enable';
      }
      else {
        $action = 'disable';
      }
      $cron_job_id = $result['cron_job_id'];
      $result = easycron_connect($action, array(
        'token' => $form['easycron_token']['#value'],
        'id' => $cron_job_id,         
      ));

      if ($result['status'] == 'success') {
        variable_set('easycron_cron_job_id', $cron_job_id);
      }
      else {
        $notice = $result['error']['message'];
      }
    }
    else {
      $notice = $result['error']['message'];
      if (($action == 'edit') && ($result['error']['code'] == 25)) {
        // Something wrong with the cron job ID, create a new cron job
        $result = easycron_connect('add', $easycron_settings);
        if ($result['status'] == 'success') {
          variable_set('easycron_cron_job_id', $result['cron_job_id']);
          unset($notice);
        } else {
          // if the add action failed
          $notice = $result['error']['message'];
        }
      }
    }
    if (isset($notice)) {
      form_set_error('', check_plain($notice));
    }
  }
}
