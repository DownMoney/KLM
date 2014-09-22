<?php
switch ($_POST['action']) {
    default:
    user_login_form();
    break;
    case 'log_on':
    user_log_on($_POST['usr_email'], $_POST['usr_pass']);
    break;
}

function user_login_form() {
    global $user, $module;
    
    
    
    echo HTML_draw_form('user_login', wt_href_link($module->module_info['mod_id'], 'user_login'));
    echo HTML_draw_hidden_field('action', 'log_on');
    echo HTML_draw_input_field('usr_email');
    echo HTML_draw_password_field('usr_pass');
    echo HTML_draw_submit_field('submit', 'wyslij');
}

function user_log_on($usr_email, $usr_pass) {
    global $user;
    if($user->user_login($usr_email, $usr_pass));
}

?>