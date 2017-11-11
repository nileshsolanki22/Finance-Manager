<?php
function framework_preprocess_user_login(&$vars) {
  $vars['intro_text'] = t('This is my awesome login form');
}

function framework_preprocess_user_register_form(&$vars) {
  $vars['intro_text'] = t('This is my super awesome reg form');
}

function framework_preprocess_user_pass(&$vars) {
  $vars['intro_text'] = t('This is my super awesome request new password form');
}

?>