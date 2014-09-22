<?php 


if($_POST) {
$user = $_POST;

if (strlen($_POST['usr_login']) < '5') {
    $error['usr_login'] = 'Login musi mieæ przynajmniej 5 znaków.';
  } 

if($this->user_exists($_POST['usr_login'])) {
    $error['usr_login'] = 'Wybrany przez Ciebie login jest ju¿ zajêty.';
 }

 
}

if(!$_POST['group_id']) {
$group_id = $this->get_default_group();
}

$process = false;

if($_POST) $process = TRUE;

if(!$process) {
$wt_template->assign('error', $error);
$wt_template->assign('user', $user);
$wt_template->load_file('user_register.tpl');
} 

if($process) {

$sql_user_data_array = array('usr_login' => $_POST['usr_login']);
if(wt_not_null($_POST['usr_pass'])) {
    $sql_user_data_array['usr_pass'] = wt_encrypt_password($_POST['usr_pass']);
    }

$sql_user_info_data_array = array('usr_first_name' => $_POST['usr_first_name'],
								'usr_second_name' => $_POST['usr_second_name'],
								'usr_last_name' => $_POST['usr_last_name'],
								'usr_nick' => $_POST['usr_nick'],
								'usr_dob' => $_POST['usr_dob'],
								'usr_address' => $_POST['usr_address'],
								'usr_suburb' => $_POST['usr_suburb'],
								'usr_post_code' => $_POST['usr_post_code'],
								'usr_city' => $_POST['usr_city'],
								'usr_state' => $_POST['usr_state'],
								'usr_country_id' => $_POST['usr_country_id'],
								'usr_email' => $_POST['usr_email'],
								'usr_phone' => $_POST['usr_phone'],
								'usr_fax' => $_POST['usr_fax'],
								'usr_mobile' => $_POST['usr_mobile'],
								'usr_www' => $_POST['usr_www']);

   $sql_user_data_array['date_added'] = 'now()';
   $sql_user_data_array['added_by'] = $_POST['usr_login'];
   
   $wt_sql->db_perform(TABLE_USERS, $sql_user_data_array);
   $user_id = $wt_sql->db_insert_id();
   
   $sql_user_info_data_array['usr_id'] = $user_id;
   $wt_sql->db_perform(TABLE_USERS_INFO, $sql_user_info_data_array);

	 $sql_user_groups_data_array = array('usr_id' => $user_id,
   												'group_id' => $group_id,
   												'date_added' => 'now()',
   												'added_by' => $_POST['usr_login']);
   												
$wt_sql->db_perform(TABLE_USERS_TO_GROUPS, $sql_user_groups_data_array);

$wt_user->user_login($_POST['usr_login'], $_POST['usr_pass']);
wt_redirect(wt_href_link());


}
?>