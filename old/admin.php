<?php 
error_reporting(0);
include_once('inc/core2.inc.php');
$admin_login = 1;
$wt_session->set('admin_login',$admin_login);
wt_redirect(wt_href_link('mod_admin_manager'));
?> 