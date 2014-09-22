<?php 
class mod_core_logs_manager_cron_plug {
	function make_cron_job() {
		global $wt_sql, $wt_template, $wt_module;
			$db_notify_query = $wt_sql->db_query("SELECT * FROM ".TABLE_CORE_MESSAGES_NOTIFIES." WHERE status = '1'");
			while($db_notify = $wt_sql->db_fetch_array($db_notify_query)) {
				if(wt_is_valid($db_notify['usr_id'], 'int', 0)) {
					$mod_user_manager = wt_module::singleton('mod_user_manager');
					$user_data = $mod_user_manager->get_users($db_notify['usr_id']);
					if(wt_is_valid($user_data, 'array') && wt_is_valid($user_data['usr_email'], 'email')) {
						$db_messages_query = $wt_sql->db_query("SELECT * FROM ".TABLE_CORE_MESSAGES." WHERE ms_notified = '0' AND ms_type LIKE 'user%'");
						while($db_messages = $wt_sql->db_fetch_array($db_messages_query)) {
						
							if(wt_is_valid($db_messages['usr_id'], 'int', 0)) {
								$db_messages['user'] = $mod_user_manager->get_users($db_messages['usr_id']);
							}
							if(wt_is_valid($db_messages['mod_id'], 'int', 0)) {
								$db_messages['mod'] = $wt_module->get_mod_info($db_messages['mod_id']);
							}							
							$messages[] = 	$wt_sql->db_output_data($db_messages);
						}
						
						if(wt_is_valid($messages, 'array')) {
							$wt_template->assign('messages', $messages);
							$wt_template->SetTemplateDir('mails' . DIRECTORY_SEPARATOR . 'mod_core_logs_manager' . DIRECTORY_SEPARATOR, NULL, 'mod_core_logs_manager'); 
    						$email = new email();
						   $email->add_html($wt_template->fetch('notify.tpl','', 'mod_core_logs_manager'));
						   $email->build_message();
    						$email->send($user_data['usr_first_name'], $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, 'Wydarzenia na stronie '.SITE_NAME);
							$ms_ids = wt_get_ids_from_array('ms_id', $messages);
							$wt_sql->db_perform(TABLE_CORE_MESSAGES, array('ms_notified' => '1'), 'update', "ms_id IN(".implode(',', $ms_ids).")");
						}
							
						
					}
				}
			}
		}		
} // class
?>