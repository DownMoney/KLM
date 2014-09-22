<?php 
class mod_user_manager_core_log_plug {  
	
  function parse_message($data) {
  	global $wt_sql, $wt_session;	
  	  //	wt_print_array($data);
		$desc['msg'] = 'Użytkownik nr #'.$data['usr_id'].' - '.$data['user_data']['usr_last_name'].' '.$data['user_data']['usr_first_name'].' ';
		switch($data['ms_type']) {
			case 'manager_add':
				$desc['msg'] .= 'dodał';
			break;
			case 'manager_edit':
				$desc['msg'] .= 'zmienił';
			break;
			case 'manager_status1':
				$desc['msg'] .= 'włączył';			
			break;
			case 'manager_status0':
				$desc['msg'] .= 'wyłączył';			
			break;
			case 'manager_del':
				$desc['msg'] .= 'usunął';			
			break;
		}
			$desc['msg'] .= ' konto nr '.$data['mod_task_id'].'';		
		if(wt_is_valid($data['mod_task_id'], 'int', 0)) {
	  		$mod_user_manager = wt_module::singleton('mod_user_manager');
			$item = $mod_user_manager->get_users($data['mod_task_id']);
			$desc['msg'] .= ' "'.$item['usr_last_name'].' '.$item['usr_first_name'].'" ';
			$desc['link'] = wt_href_link('mod_user_manager', '', 'm=users&t=userInfo&uID='.$item['usr_id'].'&tFile=theme_self.tpl');
		}
		
		return $desc;
  }	
  
} // class
?>