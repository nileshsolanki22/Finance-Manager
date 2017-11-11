<?php
/**
 * Implements hook_html_head_alter().
 * We are overwriting the default meta character type tag with HTML5 version.
 */
function framework_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function framework_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // Uncomment to add current page to breadcrumb
	// $breadcrumb[] = drupal_get_title();
    return '<nav class="breadcrumb">' . $heading . implode(' » ', $breadcrumb) . '</nav>';
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function framework_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function framework_preprocess_node(&$variables) {
  $variables['submitted'] = t('Published by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Preprocess variables for region.tpl.php
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
function framework_preprocess_region(&$variables, $hook) {
  // Use a bare template for the content region.
  if ($variables['region'] == 'content') {
    $variables['theme_hook_suggestions'][] = 'region__bare';
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function framework_preprocess_block(&$variables, $hook) {
  // Use a bare template for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__bare';
  }
  $variables['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function framework_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}

/**
 * Changes the search form to use the "search" input element of HTML5.
 */
function framework_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}


//add class to buttons
function framework_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
 
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  $element['#attributes']['class'][] = 'btn';
  // adding bootstrap classes.
  if($element['#button_type'] == 'submit'){
    $element['#attributes']['class'][] = 'btn-primary';
    //$element['#attributes']['class'][] = 'btn-lg';
  }
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
 
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/**text area**/
function framework_select($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'size'));
  _form_set_class($element, array('form-select'));
  
  $element['#attributes']['class'][]= 'form-control';
  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}
/**** theme form textarea. ***/
function framework_textarea($variables) {
  $variables['element']['#rows'] = 3;
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'cols', 'rows'));
  _form_set_class($element, array('form-textarea'));

  $wrapper_attributes = array(
    'class' => array('form-textarea-wrapper'),
  );

  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    drupal_add_library('system', 'drupal.textarea');
    $wrapper_attributes['class'][] = 'resizable';
  }

  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}
 
/**** theme form textfields. ***/
function framework_textfield($variables) {
 
  $element = $variables['element'];
  $output = '';
  // login form adding glyphicon.
  if($element['#name'] == 'name') {
    //$output = '<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>';
  }
 
  // force type.
  $element['#attributes']['type'] = 'text';
  // set placeholder.
  if(isset($variables['element']['#description'])){
    $element['#attributes']['placeholder'] = $variables['element']['#description'];
  }
 
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  // adding bootstrap classes.
  _form_set_class($element, array('form-text', 'form-control', 'input-lg-3'));
 
  $extra = '';
  if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';
 
    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }
 
  $output .= '<input' . drupal_attributes($element['#attributes']) . ' />';
 
  return $output . $extra;
}
 
/*** theme password field ***/
function framework_password($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'password';
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
  _form_set_class($element, array('form-text', 'form-control'));
 
  $output = '';
  // login form adding glyphicon.
  if($element['#name'] == 'pass') {
    //$output = '<span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>';
  }
 
  return $output . '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function phptemplate_user_profile($account, $fields = array()) {
  // Pass to phptemplate, including translating the parameters to an associative array. The element names are the names that the variables
  // will be assigned within your template.
  /* potential need for other code to extract field info */
  return _phptemplate_callback('user_profile', array('account' => $account, 'fields' => $fields));
}


function framework_theme() {
  $items = array();
  // create custom user-login.tpl.php
  $items['user_login'] = array(
  'render element' => 'form',
  'path' => drupal_get_path('theme', 'framework') . '/templates',
  'template' => 'user-login',
  'preprocess functions' => array(
  'framework_preprocess_user_login'
  ),
 );
return $items;
}

/**
 * Implementation of hook_menu_local_tasks_alter()
 */
function framework_menu_local_tasks_alter(&$data, $router_item, $root_path){
  if($router_item['path'] == 'user' && $root_path == 'user') {
    //watchdog('framework:',' <pre>' . print_r($data, true) . '</pre>');
    unset($data['tabs'][0]['output'][0]);
    unset($data['tabs'][0]['output'][1]);
    unset($data['tabs'][0]['output'][2]);
  }
    else if($router_item['path'] == 'user/password' && $root_path == 'user/password'){
        unset($data['tabs'][0]['output'][0]);
        unset($data['tabs'][0]['output'][1]);
        unset($data['tabs'][0]['output'][2]);
        
    }
    else if($router_item['path'] == 'user/register' && $root_path == 'user/register'){
        unset($data['tabs'][0]['output'][0]);
        unset($data['tabs'][0]['output'][1]);
        unset($data['tabs'][0]['output'][2]);
        
    } 
}

/**
 * Implementation of hook_form_alter().
 *
 * Autofocus on the username field.
 * Some proper page titles would be nice for a change.. User account is a bit boring..
 */
function framework_form_alter(&$form, &$form_state, $form_id) {
  // Autofocus on the username field.
  // And add some pretty CSS :).
  // And a few other things too...
  if ($form_id == 'user_login' || $form_id == 'user_register_form' || $form_id == 'user_pass' || $form_id == 'user_pass_reset') {
    $form['name']['#attributes']['autofocus'] = 'autofocus';

    // We don't really need descriptions to tell us what we already know...
    unset($form['name']['#description']);
    unset($form['pass']['#description']);

    // Add in some CSS.
    $form['#attached']['css'][] = drupal_get_path('theme', 'framework') .'/css/login.css';
  }

  switch ($form_id) {
    case 'user_login':
      drupal_set_title(t(''));
      break;

    case 'user_register_form':
      drupal_set_title(t('Register'));
      
      // The registration form behaves differently...
      $form['account']['name']['#attributes']['autofocus'] = 'autofocus';
      break;

    case 'user_pass':
      drupal_set_title(t('Forgot your password?'));
      break;

    case 'user_pass_reset':
      drupal_set_title(t('Reset password'));
      break;
  }
}

/*
framework_preprocess(&$variables, $hook) {
  if( drupal_is_front_page()) {
      drupal_goto('ticket/new-ticket')
  }
}
*/
/*
  function framework_js_alter(&$javascript) {
    $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'framework') .
    '/js/jquery1.min.js';
    $javascript['misc/jquery.js']['version'] = '1.9.1';
}
*/

function framework_preprocess_html(&$variables) {
 
   /* drupal_add_js('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', array( 
    'scope' => 'header', 
    'weight' => '14' 
  ));
  */
    
    drupal_add_js(drupal_get_path('theme', 'framework') . '/js/sidebar.js', array( 
    'scope' => 'header', 
    'weight' => '15' 
  ));
    
    drupal_add_js(drupal_get_path('theme', 'framework') . '/js/filter.js', array( 
    'scope' => 'header', 
    'weight' => '16' 
  ));

        drupal_add_js(drupal_get_path('theme', 'framework') . '/js/active.js', array( 
    'scope' => 'header', 
    'weight' => '17' 
  ));
    
}