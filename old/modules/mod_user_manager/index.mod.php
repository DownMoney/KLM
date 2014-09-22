<?php 

class mod_user_manager {
         var $task;
   		var $action;
  		   var $mode;
   		var $module_dir; 
   		var $module_class;
   		var $module_key;
         var $groups_ids; 
   		var $db; 
   		var $usr_gender = array('' => '',
   										'F' => 'kobieta',
   										'M' => 'mężczyzna');
   		
   		var $zones_array = array(
         						 '' => '--- wybierz ---',
         						 'dolnośląskie' => 'dolnośląskie',
   						       'kujawsko-pomorskie' => 'kujawsko-pomorskie',
   						       'lubelskie' => 'lubelskie',
   						       'lubuskie' => 'lubuskie',
   						       'łódzkie' => 'łódzkie',
   						       'mazowieckie' => 'mazowieckie',
   						       'małopolskie' => 'małopolskie',
   						       'opolskie' => 'opolskie',
   						       'podkarpackie' => 'podkarpackie',
   						       'podlaskie' => 'podlaskie',
   						       'pomorskie' => 'pomorskie',
   						       'śląskie' => 'śląskie',
   						       'świętokrzyskie' => 'świętokrzyskie',
   						       'warmińsko-mazurskie' => 'warmińsko-mazurskie',
   						       'wielkopolskie' => 'wielkopolskie',
   						       'zachodniopomorskie' => 'zachodniopomorskie',
         								 'nie dotyczy / obcokrajowiec' => 'nie dotyczy / obcokrajowiec',
         								 );
   		var $usr_sort_order_filter = array('u.usr_id', 'ui.usr_last_name', 'ui.usr_first_name', 'u.status', 'ui.usr_email', 'ui.usr_city', 'ui.usr_company', 'ui.usr_phone');
      
         
   function mod_user_manager() {
   	global $wt_module, $wt_sql;
   	
         $this->module_dir = dirname(__FILE__);
  			$this->module_class = get_class($this);
  			$this->module_key = basename($this->module_dir);
  			$this->module_params = $wt_module->get_module_params('mod_user');
  			
  		 if($this->module_params->get('db_us_this_db') == '1' && wt_not_null($this->module_params->get('db_host')) && wt_not_null($this->module_params->get('db_user')) && wt_not_null($this->module_params->get('db_database'))) { 
  		
  		$db_host = $this->module_params->get('db_host');
  		$db_user = $this->module_params->get('db_user');
  		$db_password = $this->module_params->get('db_password');
  		$db_database = $this->module_params->get('db_database');
  		$this->db_prefix = $this->module_params->get('db_prefix');
  		$db_silent_mode = $this->module_params->get('db_silent_mode');
  		$db_persistant = $this->module_params->get('db_persistant');
  		
  		$this->db = new wt_sql($db_host, $db_user, $db_password, $db_database, NULL, $db_silent_mode, $db_persistant);
  		
  		} else {
  		$this->db = &$wt_sql;
  		}	
	 	$this->set_users_sort_order();	
   }
   
  
  function set_users_sort_order() {
  		  global $wt_session;
			$sort = wt_set_task($_GET, 'sort');
			$sort_orders = $wt_session->value('sort_orders');
			
			if( !wt_not_null($sort_orders['users']) ) {
				$sort_orders['users'] = '1d';
			}
			
		  if( wt_not_null($sort) && wt_not_null( $this->usr_sort_order_filter[(int)$sort] ) )	{
			$sort_orders['users'] = $sort;
			}
			$wt_session->set('sort_orders', $sort_orders);	
  }	  
	
  function get_users_db_sort_order() {	
  		  global $wt_session;
			$sort_orders = $wt_session->value('sort_orders');
		 return 	wt_get_sort_order_for_items_to_db($this->usr_sort_order_filter, null, $sort_orders['users']);		  
  }	  
	
   
  function get_module_path() {
   return $this->module_dir;
   }
  
  function get_module_class() {
   return $this->module_class;
   } 
  
  function get_module_key() {
   return $this->module_key;
   }       
        
        
  	function __construct() {

         $class_name = __CLASS__;
    	  	$this->$class_name();

    	  	}

    	function _init() {
     global $wt_user,$wt_session;   
  $this->task = wt_set_task($_REQUEST, 't');
  $this->action = wt_set_task($_REQUEST, 'a');
  $this->mode = wt_set_task($_REQUEST, 'm');
    
         
       if(isset($this->action) && wt_not_null($this->action)) {
        
         $unset_users_cache = new wt_cache();
         $unset_users_cache->clear(array('mod_user'));
         unset($unset_users_cache);
       } 
         
         
       switch($this->action) {
       		case 'delUser':
       			$this->delUser();
       		break;
       		case 'saveGroup':
       			$this->saveGroup();
       		break;
				case 'saveUser':
       			$this->saveUser();
       		break;
       		case 'delGroup':
       			$this->delGroup();
       		break;
       		case '__update_access_tables':
       			$this->update_access_tables();
       		break;
				case 'setUserStatus':
					$this->setUserStatus();
				break;
     			case 'makeExportUsers':
	     			$this->makeExportUsers();
	     		break;
       }
       
    if(!wt_not_null($this->action))  { 
       
    $this->_userSearchForm();   
    $wt_session->remove('__user_data');
	    
  switch ($this->mode) {
    default:
    case 'users':
    	switch($this->task) {
     		default: 
     			$this->users();
     		break;   
     		case 'userSearch':
     			$this->users();
     		break;
			case 'userInfo':
     			$this->userInfo();
     		break;
     		case 'addUser':
     			$this->addUser();
     		break;
     		case 'getUsersForAutocompletion':
     			$this->getUsersForAutocompletion();
     		break;
     		case 'exportUsers':
     			$this->exportUsers();
     		break;
    }
    break;
    case 'groups':
      switch($this->task) {
     		default: 
     			$this->groups();
     		break;
     		case 'addGroup': 
     			$this->addGroup();
     		break;
     		case 'deleteGroup': 
     			$this->deleteGroup();
     		break;
     	}	
    break;
  }
     }
        }
			
 function makeExportUsers($data = array(), $gSearch = null) {
   global $wt_template;
 	if(!wt_is_valid($data['iSearch'], 'array')) {
		$iSearch = wt_set_task($_REQUEST, 'iSearch');
	}
	if(!wt_not_null($data['gSearch'], 'array')) {
		$gSearch = wt_set_task($_REQUEST, 'gSearch');
	}
	  $params = array();   	
	  $iSearch = wt_string_user_safe_array($iSearch);
	  $this->parse_search_params($iSearch, $params);
	  $gSearch = wt_string_user_safe_array($gSearch);
	 
	 if( wt_not_null($gSearch) ) {
		if(wt_parse_search_string($gSearch, $parsed_string)) {
		$params['where'] = wt_parse_array_to_query($parsed_string, array('ui.usr_first_name', 'ui.usr_last_name', 'ui.usr_company', 'ui.usr_company_vat_id', 'ui.usr_email')). " AND ";
	 	} 
	 }
	 
     $gID = $this->current_group_id();	
	 if( wt_is_valid($gID, 'int', '0') && $gID != '2' && $gID != '3' ) {
	  		$gtd = $this->get_group_tree($gID, '', '0');
			$gid = array();
			$gid[] = $gID;
			if( wt_is_valid($gtd, 'array') ) {
				foreach($gtd as $g) {
					if( wt_is_valid($g['id'], 'int', '0') ) {
						$gid[] = $g['id'];
					}
				}
			}
	 }	
	 
	 if( wt_is_valid( $gid, 'array') ) {
	 	$params['where'] .= " u2g.group_id IN (" . implode(',', $gid) . ") AND ";
	 }
	 	$params['dsplit'] = true;
	 	$params['order'] = "u.usr_id DESC";
	 	$params['get_groups'] = true;
     $wt_template->assign('users_listing', $this->get_users(null, $params));
 	  
	  if(!wt_not_null($data['format']) || $data['format'] == 'cvs') {
	  		ob_start(); 
			$headers = array();
			$headers['Cache-Control'] = 'no-cache, must-revalidate';
			$headers['Expires'] = 'Mon, 26 Jul 1997 05:00:00 GMT';
			$headers['Content-Type'] = 'application/csv;';
			$headers['Content-Disposition'] = 'attachment; filename='.wt_safe_string(SITE_NAME).'_users_export_'.date('Ymd_His').'.csv';
			$headers['Content-Transfer-Encoding'] = 'binary';
	      $wt_template->set_headers($headers, true);
			$wt_template->load_headers();
			ob_end_clean();
			$wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.$this->module_key.DIRECTORY_SEPARATOR);
			$content = $wt_template->fetch('sub/users_export_csv.tpl', null, $this->module_key);
			echo iconv('UTF-8', 'WINDOWS-1250', $content);
			$wt_template->SetTemplateDir();
		  	die();
	  }	
 
 }			
			
 
 function exportUsers() {
 	global $wt_template;
         
			$wt_template->tFile = 'theme_self';                   
         include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'exportUsers.php'); 
 }
 
 function userInfo() {
			global $wt_template;
			$wt_template->display_self = true;
			
			$uID = wt_set_task($_REQUEST, 'uID');
			
			if( wt_is_valid($uID, 'int', '0') ) {
			  $wt_template->assign('item', $this->get_users($uID) );	
			//  wt_print_array( $this->get_users($uID) );		
			} 
			
			$wt_template->load_file('userInfo');
			}	


 function parse_search_params($iSearch, &$params) {
 
 	if( wt_is_valid($iSearch, 'array') ) {
	
		$text_fields = array('usr_first_name', 'usr_last_name', 'usr_email', 'usr_address', 'usr_city', 'usr_post_code', 'usr_state', 'usr_phone', 'usr_fax', 'usr_mobile', 'usr_gg', 'usr_company', 'usr_company_city', 'usr_first_name', 'usr_company_vat_id', 'usr_company_address', 'usr_company_post_code', 'usr_company_city', 'usr_company_state', 'usr_company_email', 'usr_company_www', 'usr_company_phone', 'usr_company_fax');
		
		foreach($iSearch as $key => $val) {
			if(wt_not_null($key) && wt_is_valid($val, 'string') && wt_not_null($val) && in_array($key, $text_fields)) {
				$params['where'] .= " ui.".$key." LIKE '%" . $this->db->db_input($val) . "%' AND ";
			}
			if(wt_not_null($key) && wt_is_valid($val, 'array') && in_array($key, $text_fields)) {
				$params['where'] .= " ( ";
				foreach($val as $v) {
					$params['where'] .= " ui.".$key." LIKE '%" . $this->db->db_input($v) . "%' OR ";
				}
				$params['where'] = substr($params['where'], 0, -4);
				$params['where'] .= " ) AND ";
			}
		}
		
    	if(wt_is_valid($iSearch['usr_id'], 'int', '0' ) ) {
       $params['where'] .= " u.usr_id = '".(int)$iSearch['usr_id']."' AND ";
      }
		if(wt_is_valid($iSearch['status'], 'int', '0' ) ) {
       $iSearch['status'] = array($iSearch['status']);
      }
		
		if(wt_is_valid($iSearch['status'], 'array')) {
       $params['where'] .= " u.status IN (".implode(',', $iSearch['status']).") AND ";
      }
				
		if(wt_is_valid($iSearch['usr_source'], 'array')) {
			$params['where'] .= " ( ";
       	if(in_array('user', $iSearch['usr_source'])) {
			 	$params['where'] .= " u.added_by = 0 OR ";
			}
			if(in_array('admin', $iSearch['usr_source'])) {
			 	$params['where'] .= " u.added_by > 0 OR ";
			}
			if(in_array('sys', $iSearch['usr_source'])) {
			 	$params['where'] .= " u.added_by < 0 OR ";
			}
		 	$params['where'] = substr($params['where'], 0, -4);
			$params['where'] .= " ) AND ";
      }
		
		if(wt_is_valid($date_added_from = strtotime($iSearch['date_added_from']), 'int', 0)) {
			$params['where'] .= " UNIX_TIMESTAMP(u.date_added) >= '".$date_added_from."' AND ";
		}
		if(wt_is_valid($date_added_to = strtotime($iSearch['date_added_to']), 'int', 0)) {
			$params['where'] .= " UNIX_TIMESTAMP(u.date_added) <= '".$date_added_to."' AND ";
		}
       
    }
	 
 }
			
 
 function _userSearchForm() {
    global $wt_template;
    
    include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'searchUser_form.php'); 
    }
    
    function delGroup($data = array(), $params = array()) {
     global $wt_sql;
     
     $outside_action = false;
     
    if(isset($data) && is_array($data) && wt_not_null($data) ) {
  		$group_del_array = $data;
  		$outside_action = true;
  } else {
  		$group_del_array = $_REQUEST;
  }

	
    if(isset($group_del_array['group_id']) && is_array($group_del_array['group_id']) && wt_not_null($group_del_array['group_id'])) {
    
        
        $this->db->db_query("DELETE FROM " . TABLE_USERS_GROUPS . " WHERE group_id IN (" . implode(',', $group_del_array['group_id']) . ")" );
        $this->db->db_query("DELETE FROM " . TABLE_USERS_GROUPS_PERMISSION . " WHERE group_id IN (" . implode(',', $group_del_array['group_id']) . ")" );
        $this->db->db_query("DELETE FROM " . TABLE_USERS_TO_GROUPS . " WHERE group_id IN (" . implode(',', $group_del_array['group_id']) . ")" );
       
		 wt_plugins::run_action($this->module_key, 'delGroup', null, $group_del_array['group_id']);
    }  // foreach($data['cat_id'] as $cat_id)
    
      if($outside_action) {
      return true;
      } else {
      global $wt_session;
		$site_url = wt_href_link('mod_user_manager');
			$wt_session->set('site_url', $site_url);
  			$mess = 'Grupa usunięta';
			$wt_session->set('mess', $mess);
		
 wt_redirect(wt_href_link('mod_admin_manager', '', 'a=fastFormSaved'));
		
      }
      
      } // function

    function addGroup() {
         global $wt_template;
         
			$wt_template->display_self = true;                   
         include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addGroup.php'); 
         
        }
	
	function delUser($data = array()) {
		global $wt_sql;
		
		$outside_action = false;
		
		if( wt_is_valid( $data, 'array' ) ) {
			$del_user_array = $data;
			$outside_action = true;
		} else {
			$del_user_array = $_REQUEST;
		}
		
		if(isset($del_user_array['uID']) && $del_user_array['uID'] > 1) {
		
      $this->db->db_query("DELETE FROM " . TABLE_USERS . " WHERE usr_id = '" . (int)$del_user_array['uID'] . "' LIMIT 1;");
      $this->db->db_query("DELETE FROM " . TABLE_USERS_INFO . " WHERE usr_id = '" . (int)$del_user_array['uID'] . "' LIMIT 1;");
      $this->db->db_query("DELETE FROM " . TABLE_USERS_TO_GROUPS . " WHERE usr_id = '" . (int)$del_user_array['uID'] . "'");
		wt_core_log::saveLog(array('ms_type' => 'manager_del', 'ms_title' => 'Usunięto użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'dU', 'mod_task_id' => $del_user_array['uID']));
		wt_plugins::run_action($this->module_key, 'delUser', null, $del_user_array['uID']);	
		}
		
		if($outside_action) {
		return true;
		} else {
		
		die('ok');
		
		}
		
	} // function

	
	
    function check_email($email_address = '') {
     		global $wt_sql;
     		
     		if(!wt_not_null($email_address)) {
     			return true;
     		}
     		
     		$db_email_check_query = $this->db->db_query("SELECT usr_id FROM " . TABLE_USERS_INFO . " WHERE usr_email = '" . $this->db->db_input($email_address) . "'");
     		
     		$db_email_check = $this->db->db_fetch_array($db_email_check_query);
     		
     		
     		
     		if(!wt_not_null($db_email_check['usr_id'])) {
     			return true;
     		}
     	
     		
     		if(isset($_REQUEST['uID']) && $_REQUEST['uID'] > 0 ) {
     			$action = 'save';
     		} else {
     			$action = 'add';
     		}
     		
     
     		
     		if($action == 'save') {
     			
     			if($_REQUEST['uID'] == $db_email_check['usr_id']) {
     			return true;
     			} else {
     			return false;
     			}
     			    		
     		} else {
     		
     		if($db_email_check['usr_id'] > 0) {
     			return false;
     		} else {
     			return true;
     		}
     		
     		}
     		
     		return false;
     }

			function addUser() {
				global $wt_template;
				 $wt_template->display_self = true;
				 include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addUser.php');
         
        $wt_template->load_file('addUser.tpl'); 
			
			}
			
			
		   function saveGroup($data = array()) {	
     global $wt_sql, $wt_session, $wt_user;
     
     $outside_action = false;
     
     if( wt_is_valid($data, 'array') ) {
       $group_array = $this->db->db_prepare_input($data);
       $outside_action = true;
       }	else {
       $group_array = $this->db->db_prepare_input($_REQUEST);
       }
       
     
       
       if( wt_is_valid( $group_array['gID'], 'int', '0' ) ) {
          
          $gID = $group_array['gID'];
          $action = 'save';
          
          if(isset($group_array['action_save']) && $group_array['action_save'] == 'save') {
          $action = 'save';          
          } else if(isset($group_array['action_save']) && $group_array['action_save'] == 'save_as') {
          $action = 'add';     
          }
          
       } else {
       $action = 'add';
       }
          
			
     
$sql_group_data_array = array('parent_id' => $group_array['parent_id'],
								      'group_name' => $group_array['group_name'],
							         'group_desc' => $group_array['group_desc'],							     
									    );
										  
	  if($action == 'add') {
   	$sql_group_data_array['date_added'] = 'now()';
	  	$sql_group_data_array['added_by'] = $wt_user->usr_info['usr_id'];
	  	$sql_group_data_array['version'] = '1';
	  	$this->db->db_perform(TABLE_USERS_GROUPS, $sql_group_data_array);
	  	$gID = $this->db->db_insert_id();
	}	
	  
	  if($action == 'save') {	
   $sql_group_data_array['last_modified'] = 'now()';
  	$sql_group_data_array['modified_by'] = $wt_user->usr_info['usr_id'];
  	$sql_group_data_array['version'] = 'version+1';
  	if($gID != $group_array['parent_id']) {
  	$this->db->db_perform(TABLE_USERS_GROUPS, $sql_group_data_array, 'update', "group_id = '" . (int)$gID . "'");
	}
	  }		 
	  
	if(!$this->is_default_group($gID) && $group_array['group_default'] == '1') {
  $this->db->db_query("UPDATE " . TABLE_USERS_GROUPS . " SET group_default = '0' WHERE group_id = '" . (int)$this->get_default_group() . "'"); 
  
  $this->db->db_query("UPDATE " . TABLE_USERS_GROUPS . " SET group_default = '1' WHERE group_id = '" . (int)$gID . "'");
  }	
  
  if(isset($group_array['perm_id']) && is_array($group_array['perm_id']) && wt_not_null($group_array['perm_id']))  {
  
  $this->db->db_query("DELETE FROM " . TABLE_USERS_GROUPS_PERMISSION . " WHERE group_id = '" . (int)$gID . "'");
  
   foreach($group_array['perm_id'] as $perm_id) {
   
   $sql_group_perm_array = array();	
   $sql_group_perm_array = array('group_id' => $gID,
								      	'perm_id' => $perm_id,					     
									    );
	
	$this->db->db_perform(TABLE_USERS_GROUPS_PERMISSION, $sql_group_perm_array);

   }
   
   }
   
   if(isset($group_array['mod_id']) && is_array($group_array['mod_id']) && wt_not_null($group_array['mod_id'])) {
   
   	$db_module_access_query = $this->db->db_query("SELECT mod_id, access FROM " . TABLE_MODULES . " WHERE mod_id IN (" . implode(',', $group_array['mod_id']) . ") ");
   	
   	while($db_module_access = $this->db->db_fetch_array($db_module_access_query)) {
   		
   		$mod_access = wt_parse_access_to_array($db_module_access['access']);
   		$mod_access[] = $gID;
   		
   		$mod_access = array_unique($mod_access);
   	   $mod_access = wt_parse_access_for_db($mod_access);
   	   
   	   $this->db->db_query("UPDATE " . TABLE_MODULES . " SET access = '" . $mod_access . "' WHERE mod_id = '" . (int)$db_module_access['mod_id'] . "'");
   	}
   	
   }
   
  wt_plugins::run_action($this->module_key, 'saveGroup', $action, $gID);
	
 if($outside_action) {
 return $gID;
 }  else {
     
	  $site_url = wt_href_link('mod_user_manager', '', wt_get_all_get_params( array('a', 'm', 't') ) . 'm=users' );	
  $wt_session->set('site_url', $site_url);
	
		if( $action == 'add' ) {
		$form_url = wt_href_link('mod_user_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'uID') ) . 'm=groups&t=addGroup&gID=' . $gID);
		$wt_session->set('form_url', $form_url);
		}
		
 wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $group_array['submit_type'] . '&opA=' . $action));		
		
  }
    
    }

        function group_navbar() {
          global $wt_template;
          
         $gPath_array = $this->gPath_array();
         $nav_bar = new wt_breadcrumb();    
         $nav_bar->add('Grupy', wt_href_link('mod_user_manager', '', wt_get_all_get_params(array('gPath', 'gID')))); 
      
 if(is_array($gPath_array)) {
      
    for ($i=0, $n=sizeof($gPath_array); $i<$n; $i++) {
    
      $group_info = $this->get_groups($gPath_array[$i]);
      
      $nav_bar->add($group_info['group_name'], wt_href_link('mod_user_manager', '', wt_get_all_get_params(array('gPath', 'gID')) . 'gPath=' . implode('_', array_slice($gPath_array, 0, ($i+1))))); 
      }

          }    
        return $nav_bar->draw_breadcrump(' &raquo; ');
        }
			
			
function get_groups($gr_id = NULL, $params = array()) {
     global $wt_sql, $wt_session, $wt_template;
        
        $groups_array = array();
        
        
     if(wt_not_null($gr_id) && $gr_id > 0) {
     
     $db_groups_query_raw = "SELECT * FROM " . TABLE_USERS_GROUPS . " WHERE " . (isset($params['where']) ? $params['where'] : '') . " group_id = '" . (int)$gr_id . "' LIMIT 1";

     } else {
     
     $db_groups_query_raw = "SELECT group_id, parent_id, group_name FROM " . TABLE_USERS_GROUPS . " " . (isset($params['where']) ? ' WHERE ' . $params['where'] : '') . "  ";
     
     
     if(!isset($params['order'])) {
      $db_groups_query_raw .= " ORDER BY group_id";
     }
     
     if(isset($params['order'])) {
      $db_groups_query_raw .= " ORDER BY " . $params['order'];
     }
     
     if(isset($params['limit'])) {
      $db_groups_query_raw .= " LIMIT 0, " . $params['limit'];
     }
     
     }
     
     $db_groups_query = $this->db->db_query($db_groups_query_raw);
     
     while($db_groups = $this->db->db_fetch_array($db_groups_query)) {
     
      $db_groups['gPath'] = $this->parse_group_path($this->get_group_path($db_groups['group_id']));

		
     
     $db_groups['users_count'] = $this->count_users_in_groups($db_groups['group_id']);
     $db_groups['subgroups_count'] = $this->count_subgroups_in_group($db_groups['group_id']);
     $db_groups['permission_count'] = $this->count_permissions_to_group($db_groups['group_id']); 
       
      if(wt_not_null($gr_id) && $gr_id > 0) {
      
      $groups_array = $db_groups;
      } else {
      
      $groups_array[] = $db_groups;
      }

     }
    
    
    return $this->db->db_output_data($groups_array);
    }
	 
	   function get_selected_group_id($groups_array) {
    
    if($_GET['gID']) {
     return $_GET['gID'];
    } else {
     return $groups_array['0']['group_id'];
    }
    
   }	 
	  
	  		
     function users() {
     global $wt_template, $wt_sql;
     
     
     $params = array();   	
	  $iSearch = wt_string_user_safe_array(wt_set_task($_REQUEST, 'iSearch'));
  	  $wt_template->assign('iSearch', $iSearch);	
	  $this->parse_search_params($iSearch, $params);
		
		
	 $gSearch = wt_string_user_safe_array(wt_set_task($_REQUEST, 'gSearch'));
	 
	 if( wt_not_null($gSearch) ) {
		if(wt_parse_search_string($gSearch, $parsed_string)) {
		$params['where'] = wt_parse_array_to_query($parsed_string, array('ui.usr_first_name', 'ui.usr_last_name', 'ui.usr_company', 'ui.usr_company_vat_id', 'ui.usr_email')). " AND ";
	 	} 
	 }
	 
     $gID = $this->current_group_id();	
	 if( wt_is_valid($gID, 'int', '0') && $gID != '2' && $gID != '3' ) {
	  		$gtd = $this->get_group_tree($gID, '', '0');
			$gid = array();
			$gid[] = $gID;
			if( wt_is_valid($gtd, 'array') ) {
							
				foreach($gtd as $g) {
					if( wt_is_valid($g['id'], 'int', '0') ) {
						$gid[] = $g['id'];
					}
				}
			}
	 }	
	 
	 if( wt_is_valid( $gid, 'array') ) {
	 	$params['where'] .= " u2g.group_id IN (" . implode(',', $gid) . ") AND ";
	 }
	 
     $wt_template->assign('users_listing', $this->get_users(null, $params));
		
     $number_of_items_text = $this->users_split_listing->display_count($this->db_users_query_numrows, MAX_DISPLAY_ADMIN_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z <b>%s</b> użytkowników)');
     $wt_template->assign('number_of_items_text', $number_of_items_text);
    
     $number_of_items_links = $this->users_split_listing->display_links($this->db_users_query_numrows, MAX_DISPLAY_ADMIN_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
     
     $wt_template->assign('number_of_items_links', $number_of_items_links);
     $wt_template->assign('display_to_display',  $this->users_split_listing->display_to_display());
 	  
	  
	  include($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'searchUser_form.php');
		
		
	  $wt_template->tFile = 'theme_list';		
     $wt_template->load_file('users.tpl');
     }
     
     function parse_group_path($path) {
  $return = '';
  
  if(isset($path) && is_array($path) && wt_not_null($path)) {
  $return = implode('_', $path);
  }
  
  return $return;
  }   
     
	  
		
      function get_groups_tree_for_dropdown_menu() {
          global $wt_session;
          
        $groups_cache = new wt_cache();
        $dropdown_array = array();
        
        $cache_key = array();
        $cache_key['groups'] = array('mod_user');
        $cache_key['name'] = 'users_groups_tree_for_dropdown_menu_' . $wt_session->value('languages_id');
        
if(!$groups_cache->read($cache_key)) {

  $groups_tree_for_dropdown_menu = $this->get_groups_tree();
  $dropdown_array[''] = array('name' => 'Strona początkowa', 'level' => '1');
  
  foreach($groups_tree_for_dropdown_menu as $drop_down_menu) {
      
        $gPath = '';
        $gPath = $this->parse_group_path($this->get_group_path($drop_down_menu['group_id']));
        
        $level = '2';
        if(stristr($gPath, '_') === false) {
        $level = '1';
        }
        
    
        
        $dropdown_array[$gPath] = array('name' => $drop_down_menu['group_name'], 'level' => $level);
        
        
       }
        
        
  $groups_cache->writeBuffer($dropdown_array);
  } else {
  $dropdown_array = $groups_cache->getCache();
  }
  
  unset($groups_cache);
  
  return $dropdown_array;
  }

function groups() {
        global $wt_template;
			$wt_template->tFile = 'theme_list';
			
         wt_check_permission('', 'gr_view', true);
       
      $current_group_id = $this->current_group_id();
      $wt_template->assign('current_group_id', $current_group_id); 
	  	$gParams = array();
	  	$gParams['where'] = " parent_id = '" . (int)$current_group_id . "' ";   

     $wt_template->assign('items_listing', $groups_listing = $this->get_groups(null, $gParams));
     $wt_template->assign('all_groups_count', count($groups_listing));    
     $wt_template->load_file('groups');
        
        }
     
     
     
      function get_selected_user_id($users_array) {
    
    if(isset($_GET['uID']) && wt_not_null($_GET['uID']) && $_GET['uID'] > 0) {
     return $_GET['uID'];
    } else {
     return $users_array['0']['usr_id'];
    }
    
   }	
     
   function saveUserSettings($usr_id,$data, $unset_array = array()) {
     	global $wt_user,$wt_session;
     	
     	if (wt_is_valid($data,'array') && wt_is_valid($usr_id,'int','0')) {
     		if (wt_is_valid($unset_array,'array')) {
				foreach ($unset_array as $ua){
					unset($wt_user->usr_settings[$ua]);
				}
			}
			if (!wt_is_valid($wt_user->usr_settings,'array')) {
				$wt_user->usr_settings = array();
			}
			$data = array_merge($wt_user->usr_settings,$data);
			$this->db->db_query("DELETE FROM ".TABLE_USERS_SETTINGS." WHERE usr_id='".$usr_id."'");
			$this->db->db_perform(TABLE_USERS_SETTINGS,array('usr_id' => $usr_id,'settings' => wt_parse_params_for_db($data)));
			$wt_user->usr_settings = $data;
			wt_plugins::run_action($this->module_key, 'saveUserSettings', $action, $usr_id);
			return true;
     	}
     }
     
      function get_users($usr_id = null, $params = array()) {
       	  global $wt_sql, $wt_session, $wt_template;
        
        $users_array = array();
        
     if( wt_is_valid($usr_id, 'int', '0') ) {
     $db_users_query_raw = "SELECT " . ((isset($params['base_data']) && $params['base_data'] === true) ? "u.usr_id, u.usr_login, ui.usr_first_name, ui.usr_last_name, ui.usr_email "  : 'DISTINCT(u.usr_id), u.*, ui.*') . " FROM (" . TABLE_USERS . " u, " . TABLE_USERS_INFO . " ui) LEFT JOIN ". TABLE_USERS_SETTINGS ." us ON u.usr_id=us.usr_id WHERE u.usr_id = '" . (int)$usr_id ."' AND u.usr_id = ui.usr_id LIMIT 1";
     } else {
     $db_users_query_raw = "SELECT DISTINCT(u.usr_id), u.*, ui.* FROM (" . TABLE_USERS . " u, " . TABLE_USERS_INFO . " ui, " . TABLE_USERS_TO_GROUPS . " u2g, " . TABLE_USERS_GROUPS . " ug) LEFT JOIN ". TABLE_USERS_SETTINGS ." us ON u.usr_id=us.usr_id  WHERE " . (isset($params['where']) ? $params['where'] : '') . " u2g.usr_id = u.usr_id AND u2g.group_id = ug.group_id AND u.usr_id = ui.usr_id ";
     
		
	  if( isset($params['order']) && wt_not_null($params['order']) ) {
	  $db_users_query_raw .= " ORDER BY " . $params['order'] . " ";	
	  } elseif (!isset($params['order'])) {
	  $db_users_query_raw .= " ORDER BY " . $this->get_users_db_sort_order() . " ";
	  }	
		
      if(!isset($params['dsplit'])) { 
     $this->users_split_listing = new splitPageResults($_GET['page'], ($wt_session->value('results_to_display')) ? $wt_session->value('results_to_display') : MAX_DISPLAY_ADMIN_SEARCH_RESULTS, $db_users_query_raw, $this->db_users_query_numrows, 'u.usr_id', $this->db);
     }
     
     } 
     
     $db_users_query = $this->db->db_query($db_users_query_raw);
     
     while($db_users = $this->db->db_fetch_array($db_users_query)) {
		$db_users['settings'] = unserialize($db_users['settings']);
      $db_users['user_gender_text'] = $this->usr_gender[$db_users['user_gender']];
		$db_users['status_text'] = wt_return_item_status_easy($db_users['status']);
      $db_users['usr_params_array'] = unserialize($db_users['usr_params']);
		if($params['get_groups'] === true) {
			$db_users_to_groups_query = $this->db->db_query("SELECT u2g.group_id, ug.group_name FROM ".TABLE_USERS_TO_GROUPS." u2g, ".TABLE_USERS_GROUPS." ug WHERE u2g.usr_id = '".(int)$db_users['usr_id']."' AND u2g.group_id = ug.group_id");
      	while($db_users_to_groups = $this->db->db_fetch_array($db_users_to_groups_query)) {
	      $db_users['groups'][$db_users_to_groups['group_id']] = $db_users_to_groups;
	      }
		}
		
			
       if( wt_is_valid($usr_id, 'int', '0') ) {
          $users_array = $this->db->db_output_data($db_users);
       } else {
          $users_array[$db_users['usr_id']] = $this->db->db_output_data($db_users);
       }
     }
    
    
    return $users_array;
       
       }
     
     
      function count_users_in_groups($gr_id) {
    global $wt_sql, $wt_session;
    
  $cache_key = array();
  $cache_key['groups'] = array('mod_user');
  $cache_key['name'] = $gr_id . '_count_users_to_subgroups';  
  
  $count_cache = new wt_cache();
  
  if(!$count_cache->read($cache_key)) {
    
    $users_count = 0;
    
	 $db_users_count_query = $this->db->db_query("SELECT count(*) AS total FROM " . TABLE_USERS_TO_GROUPS . " WHERE group_id = '" . (int)$gr_id . "'");
	 
	 $db_users_count = $this->db->db_fetch_array($db_users_count_query); 
   

    $users_count += $db_users_count['total'];
    
    $db_groups_children_query = $this->db->db_query("SELECT group_id  FROM " . TABLE_USERS_GROUPS . " WHERE parent_id = '" . (int)$gr_id . "'");
    
	 while($db_groups_children = $this->db->db_fetch_array($db_groups_children_query)) { 
	 $users_count += $this->count_users_in_groups($db_groups_children['group_id']);
	 } 
	 
  $count_cache->writeBuffer($users_count);  
  } else {
  $users_count = $count_cache->getCache();
  }	 
  
  unset($count_cache);

    return $users_count;
  }
  
  function count_subgroups_in_group($gr_id) {
    global $wt_sql, $wt_session;
  
  
  $cache_key = array();
  $cache_key['groups'] = array('mod_user');
  $cache_key['name'] = $gr_id . '_count_subgroups';  
  
  $count_cache = new wt_cache();
  
  if(!$count_cache->read($cache_key)) {
  
    $subgroups_count = 0;
      
    $db_groups_children_query = $this->db->db_query("SELECT group_id  FROM " . TABLE_USERS_GROUPS . " WHERE parent_id = '" . (int)$gr_id . "'");
    
	 while($db_groups_children = $this->db->db_fetch_array($db_groups_children_query)) { 
	 $subgroups_count += 1;
	 $subgroups_count += $this->count_subgroups_in_group($db_groups_children['group_id']);
	 } 
   
  $count_cache->writeBuffer($subgroups_count);  
  } else {
  $subgroups_count = $count_cache->getCache();
  }	 
  
  unset($count_cache);
	 
    return $subgroups_count;
  }
  
  function count_permissions_to_group($gr_id) {
    global $wt_sql, $wt_session;
    
    $db_groups_permission_query = $this->db->db_query("SELECT COUNT(*) AS total  FROM " . TABLE_USERS_GROUPS_PERMISSION . " WHERE group_id = '" . (int)$gr_id . "'");
    
	 $db_groups_permission = $this->db->db_fetch_array($db_groups_permission_query);

    return $db_groups_permission['total'];
  }
    
    function gPath_array() {
    if (strlen($_GET['gPath']) > 0) {
    $gPath_array = explode('_', $_GET['gPath']);
    
    
  } else {
   // $gPath_array = array();
  }
  return $gPath_array;
    }
    
    
    
    function current_group_id($gPath = '') {
    
	 if( !wt_not_null($gPath) ) {
	 	$gPath = wt_set_task($_GET, 'gPath');
	 }
	 
if (wt_not_null($gPath)) {
    $gPath_array = explode('_', $gPath);
    $current_group_id = $gPath_array[(sizeof($gPath_array)-1)];
  } else {
    $current_group_id = 0;
  }
      return $current_group_id; 
    }
    
function get_group_path($gr_id, $gPath = array()) {
    global $wt_sql;
    
  

	$db_gPath_query = $this->db->db_query("SELECT group_id, parent_id FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $gr_id . "'");
	
	while($db_gPath = $this->db->db_fetch_array($db_gPath_query)) {
	$gPath[] = $db_gPath['group_id'];
	
	if($db_gPath['parent_id'] != '0') {
	$gPath = $this->get_group_path($db_gPath['parent_id'], $gPath);  
	}
	
	}  
	  
   krsort($gPath);
  
  return $gPath;
  }
    
  function gPath_back() {
  
  $gPath_array = $this->gPath_array();
  
  if ($gPath_array) {
      $gPath_back = '';
      for($i = 0, $n = sizeof($gPath_array) - 1; $i < $n; $i++) {
        if ($gPath_back == '') {
          $gPath_back .= $gPath_array[$i];
        } else {
          $gPath_back .= '_' . $gPath_array[$i];
        }
      }
    }   
    if(wt_not_null($gPath_back)) {
    $gPath_back = 'gPath=' . $gPath_back;
    } else {
    $gPath_back = 'gPath=';
    }
    
    return $gPath_back;
     }
        
      
     function get_group_tree($parent_id = '0', $spacing = '', $exclude = '', $group_tree_array = '', $include_itself = false) {
    global $wt_sql;

    if (!is_array($group_tree_array)) $group_tree_array = array();
    if ( (sizeof($group_tree_array) < 1) && ($exclude != '0') ) $group_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
      $db_group_query = $this->db->db_query("SELECT group_name FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $parent_id . "'");
      $db_group = $this->db->db_fetch_array($db_group_query);
      $group_tree_array[] = array('id' => $parent_id, 'text' => $db_group['group_name']);
    }

    $db_groups_query = $this->db->db_query("SELECT group_id, group_name, parent_id FROM " . TABLE_USERS_GROUPS . " WHERE parent_id = '" . $parent_id . "' ORDER BY group_name");
    while ($db_groups = $this->db->db_fetch_array($db_groups_query)) {
      if ($exclude != $db_groups['group_id']) {
       $group_tree_array[] = array('id' => $db_groups['group_id'], 'text' => $spacing . $db_groups['group_name']);
       }
      $group_tree_array = $this->get_group_tree($db_groups['group_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $group_tree_array);
    }

    return $group_tree_array;
  }
  
  function get_group_tree_reverse($group_id, $exclude = '', $it_self = '', $group_tree_array = '') {
    global $wt_sql;

    if (!is_array($group_tree_array)) $group_tree_array = array();
    

    
    if($it_self) {
    $db_groups_is_query = $this->db->db_query("SELECT group_id, group_name, parent_id FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id . "'");
    $db_groups_is = $this->db->db_fetch_array($db_groups_is_query);
    $group_tree_array[] = $db_groups_is['group_id'];
    }
    $db_groups_query = $this->db->db_query("SELECT group_id, group_name, parent_id FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id . "'");
    while ($db_groups = $this->db->db_fetch_array($db_groups_query)) {
    if($exclude != $group_id) {
      $group_tree_array[] = $db_groups['group_id'];
      }
      $group_tree_array = $this->get_group_tree_reverse($db_groups['parent_id'], $exclude, '', $group_tree_array);
     
    }

    return $group_tree_array;
  }
     
  
     function deleteGroup($data = array()) {
      global $wt_template, $wt_sql;
  
  $groups_array = array();
  $groups_to_delete = array();
  
  if(isset($data) && is_array($data) && wt_not_null($data) && $data['gID'] > 0) {
  		$cID = $data['gID'];
  } else {
  		$cID = wt_set_task($_REQUEST, 'gID');
  }
  
  
        
     if(isset($cID) && $cID > 0)   {
     
  $groups_array = $this->get_groups_tree($cID, '', '', '', true);     
  
  foreach($groups_array as $group) { 
  $groups_to_delete[] = $group['group_id'];
  
  }
  
     } 
  	  $wt_template->display_self = true;
     include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'deleteGroup.php'); 
	  $wt_template->load_file('deleteGroup');	
    } 
     

     
     
  function has_group_permission($permission_array, $group, $it_self = '') {
  
  if(wt_not_null($group)) {
  
  $groups = $this->get_group_tree_reverse($group, $group, $it_self);
  foreach($groups as $group_id) {
  
  if(in_array($group_id, $permission_array)) {
  return true;
  }
  }
  } 
  }  
  
  function has_permission($key_id, $group, $it_self = '') {
   global $wt_sql;
    if(wt_not_null($group)) {
      $groups = $this->get_group_tree_reverse($group, $group, $it_self);
       foreach($groups as $group_id) {
        
        $db_group_permission_query = $this->db->db_query("SELECT count(*) as total FROM " . TABLE_USERS_GROUPS_PERMISSION . " where group_id = '" . $group_id . "' and perm_id = '" . $key_id . "'");
        
        $db_group_permission = $this->db->db_fetch_array($db_group_permission_query);
          
          
          if($db_group_permission['total'] > 0) {
          return true;
          }
       }  
    }
  }
     
  function get_groups_permission($group_id = '', $action) {
     global $wt_sql;
  
      if($action == 'add') {
      $group_id = $this->current_group_id();
      $it_self = true;
      } 
  
    $db_modules_query = $this->db->db_query("SELECT * FROM " . TABLE_MODULES . " ORDER BY mod_type, mod_name");
           
   
           
    while ($db_modules = $this->db->db_fetch_array($db_modules_query)) {
         
         
         
         $mod_checked_array = wt_parse_access_to_array($db_modules['access']);
                  
         $mod_checked = 0;
         $mod_read_only = 0;
         
         if($group_id > 0 && in_array($group_id, $mod_checked_array)) {
         $mod_checked = 1;
        
         }
         
         if($group_id == '1') {
         $mod_read_only = 1;
         $mod_checked = 1;
         }
         
         if($this->has_group_permission($mod_checked_array, $group_id, $it_self)) {
          
         $mod_read_only = 1;
         $mod_checked = 1;
         }
    
       $db_modules_permission_class_query = $this->db->db_query("SELECT perm_id,  perm_key, perm_name, class_id FROM " . TABLE_MODULES_PERMISSION . " WHERE mod_id = '" . $db_modules['mod_id'] . "' and is_class = '1' ORDER BY perm_name");
       
       $mod_perm_class_array = array();
       
       while ($db_modules_permission_class = $this->db->db_fetch_array($db_modules_permission_class_query)) {
         
         $mod_perm_array = array();
         
        $db_modules_permission_query = $this->db->db_query("SELECT perm_id, perm_key, perm_name, class_id FROM " . TABLE_MODULES_PERMISSION . " WHERE mod_id = '" . $db_modules['mod_id'] . "' and is_class = '0' and to_class = '" . $db_modules_permission_class['class_id'] . "' ORDER BY perm_name");
        
           
        
          while ($db_modules_permission = $this->db->db_fetch_array($db_modules_permission_query)) {
          
          
          
          $db_group_permission_query = $this->db->db_query("SELECT count(*) as total FROM " . TABLE_USERS_GROUPS_PERMISSION . " where group_id = '" . $group_id . "' and perm_id = '" . $db_modules_permission['perm_id'] . "'");
          
          $db_group_permission = $this->db->db_fetch_array($db_group_permission_query);
          
          $perm_checked = 0;
          $perm_read_only = 0;
          if($db_group_permission['total'] > 0) {
          $perm_checked = 1;
          $mod_checked = 1;
          
          } 
          
          if($this->has_permission($db_modules_permission['perm_id'], $group_id, $it_self)) {
         $mod_read_only = 1;
         $mod_checked = 1;
         $perm_read_only = 1;
         $perm_checked = 1;
         
         }
         
         if($group_id == '1') {
         $mod_read_only = 1;
         $perm_read_only = 1;
         $perm_checked = 1;
         
         }
          
          
            $mod_perm_array[] = array('perm_id' => $db_modules_permission['perm_id'],
            						        'perm_key' => $db_modules_permission['perm_key'],
            						        'perm_name' => $db_modules_permission['perm_name'],
            						        'perm_checked' => $perm_checked,
            						        'perm_read_only' => $perm_read_only);
          
          }
       
       $mod_perm_class_array[] = array('class_name' => $db_modules_permission_class['perm_name'],
       											'perm' => $mod_perm_array);
       }
    
    $module_permission_array[] = array('mod_id' => $db_modules['mod_id'],
    												'mod_name' => $db_modules['mod_name'],
    												'mod_type' => $db_modules['mod_type'],
    												'mod_perm_class' => $mod_perm_class_array,
    												'mod_checked' => $mod_checked,
    												'mod_read_only' => $mod_read_only);
    
    }
  
   return $module_permission_array;
  }  
  
  
  function get_default_group() {
  global $wt_sql;
  
  $db_default_group_query = $this->db->db_query("SELECT group_id FROM " . TABLE_USERS_GROUPS . " WHERE group_default = '1'");
  
  $db_default_group = $this->db->db_fetch_array($db_default_group_query);
  if( wt_is_valid( $db_default_group['group_id'], 'int', '0') ) {
  	return  $db_default_group['group_id'];		
  } 
  return 0;
  
  }
  
  function is_default_group($group_id) {
  global $wt_sql;
  
  $db_default_group_query = $this->db->db_query("SELECT group_default FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id. "'");
  
  $db_default_group = $this->db->db_fetch_array($db_default_group_query);
  
  return $db_default_group['group_default'];
  
  }
  
  
  function set_permission($ids_array, $group_id, $type) {
    global $wt_sql;
  
  if($type == 'module') {
  
  $db_module_permission_query = $this->db->db_query("SELECT mod_id, access FROM " . TABLE_MODULES . "");
  
      while ($db_module_permission = $this->db->db_fetch_array($db_module_permission_query)) {
      
      
       
       $action = '';
       $new_access = '';
       $mod_access = explode("|", $db_module_permission['access']);
       
       if(in_array($group_id, $mod_access) && !in_array($db_module_permission['mod_id'], $ids_array)) {       
       $group_temp_array = array($group_id);
       $new_access = array_diff($mod_access, $group_temp_array);  
          
       }
       
       if(!in_array($group_id, $mod_access) && in_array($db_module_permission['mod_id'], $ids_array)) {       
       $group_temp_array = array($group_id);
       $new_access = wt_array_merge($mod_access, $group_temp_array);     
       }
       
        if(in_array($group_id, $mod_access) && in_array($db_module_permission['mod_id'], $ids_array)) {       
         continue;    
       }
       if(!in_array($group_id, $mod_access) && !in_array($db_module_permission['mod_id'], $ids_array)) {       
         continue;    
       }
       
      // $new_access = array_diff($mod_access, $groups_id_array);
       
       
       if(wt_not_null($new_access)) {
       $new_access = implode('|', $new_access);
       $action = 'go';
       } else {
       $new_access = '';
       $action = 'go';
       }
       
       if($action == 'go') {  
   $sql_new_access_data_array = array('access' => $new_access);
   $this->db->db_perform(TABLE_MODULES, $sql_new_access_data_array, 'update', 'mod_id = ' . $db_module_permission['mod_id']);      
       }       
      }
      
      }
      
     if($type == 'block') {
     
     
     $db_block_permission_query = $this->db->db_query("SELECT btm_id, btm_access FROM " . TABLE_BLOCKS_TO_MODULES . "");
  
            
       while ($db_block_permission = $this->db->db_fetch_array($db_block_permission_query)) {
      $block_access = explode("|", $db_module_permission['access']);
       $group_temp_array = array($group_id);
       $new_access = array_diff($block_access, $group_temp_array);
       
       if(wt_not_null($new_access)) {
       $new_access = implode('|', $new_access);
       }
   $sql_new_access_data_array = array('btm_access' => $new_access);
  
   $this->db->db_perform(TABLE_MODULES, $sql_new_access_data_array, 'update', 'btm_id = ' . $db_block_permission['btm_id']);
     
      }
     
     
     
     } 
      
  
  }
  
  function get_groups_ids() {
  
  if (!is_array($this->groups_ids) || !wt_not_null($this->groups_ids)) {
  		 $groups_data = $this->get_groups();
  		foreach($groups_data as $group) {
  		$this->groups_ids[] = $group['group_id'];
  		}
  } 
  
  return $this->groups_ids;
   
  }
  
  function update_access_tables() {
  
    			global $wt_sql;
  			
  			$a = $this->db->db_list_tables();
  			
  			
  			for ($i = 0; $i < $this->db->db_num_rows($a); $i++) {
  			
  			if(stristr($this->db->db_tablename($a, $i), DB_PREFIX)) {
  		 	
  		 	$system_tables[] = $this->db->db_tablename($a, $i);
  		 	
  		 	}
  		 	
  			}
  			
  			
  			        $groups_array = $this->get_groups_ids();
            	   
            	   $gi = 0;
            	   $groups_count = count($groups_array);
            	   
            	   $groups = "'0', ";
            	   foreach($groups_array as $group) {
            	   
            	   $groups .= "'$group', ";
            	               	   
            	   $gi++;
            	   }
            	   
            	   $groups = substr($groups, 0, -2);
  			
  			foreach($system_tables as $table) {
  				$keys = array();
  				
  			$fields = $this->db->db_list_fields($table);
         $columns = $this->db->db_num_fields($fields);

         for ($i = 0; $i < $columns; $i++) {
         	$field_name = $this->db->db_field_name($fields, $i);
         	$field_type = $this->db->db_field_type($fields, $i);
          	$filed_flags = $this->db->db_field_flags($fields, $i);
          
         	if(stristr($filed_flags, 'primary_key')) {
         	$key = $field_name;
         	}
         
         	
         	
            if($field_name == 'access') {
            		
            		$db_get_access_query = $this->db->db_query("SELECT " . $key . ", access FROM " . $table . " ORDER BY " . $key . "");
            	
             if($field_type != 'text') {	   
            	   $this->db->db_query("ALTER TABLE " . $table . " CHANGE `access` `access` TEXT NULL ");
            	   }
            	  	
            	
            		
            			
            			while($db_get_access = $this->db->db_fetch_array($db_get_access_query)) {
            			
            			$access = array();
            			
            		  if(wt_not_null($db_get_access['access'])) {	
            			if(stristr($access, '|')) {
            		   $access = explode('|', $db_get_access['access']);
            		   } else {
            		   $access = explode(',', $db_get_access['access']);
            		   }
            		  }
            		   
            		   $sql_data = array();
              if(is_array($access) && wt_not_null($access)) {
            		   $sql_data = array('access' => '|' . implode('|', $access) . '|');
            		   } 
            		   
            	if(!wt_not_null($access))	{   
            		   $sql_data = array('access' => '|' . implode('|', array('0', '2')) . '|');
            		  } 
            		  
            		 $sql_data['access'] = str_replace('||', '|', $sql_data['access']);
            		 $sql_data['access'] = str_replace('||', '|', $sql_data['access']);
            		 $sql_data['access'] = str_replace('||', '|', $sql_data['access']);
            		 $sql_data['access'] = trim($sql_data['access']);
            		 $sql_data['access'] = str_replace(' ', '', $sql_data['access']);  
            		 
            		 
            		  
            		   $this->db->db_perform($table, $sql_data, 'update', $key . ' = ' . $db_get_access[$key]);            		   
            		   
            		
            		}
            		
            }
          
     }
  			
  			}
  
  } // function
     
     
     function get_groups_tree($parent_id = '0', $spacing = '', $exclude = '', $groups_tree_array = array(), $include_itself = false, $initialize = true, $get_top = false) {
    global $wt_sql, $wt_session;

	 
	  
	 if($get_top && $initialize) {
	 $groups_tree_array[] = array('id' => '0', 'text' => 'Strona początkowa');
	 } 
 
    if ($include_itself) {
      $db_groups_query = $this->db->db_query("SELECT * FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $parent_id . "'");
      $db_groups = $this->db->db_fetch_array($db_groups_query);
      $db_groups['group_name'] = $spacing . $db_groups['group_name'];
      $groups_tree_array[] = $db_groups;
    }
    
    unset($params);
  
	  
	   $db_groups_query = $this->db->db_query("SELECT * FROM " . TABLE_USERS_GROUPS . " WHERE parent_id = '" . $parent_id . "' ORDER BY group_name");
      
    
    while ($db_groups = $this->db->db_fetch_array($db_groups_query)) {
      if ($exclude != $db_groups['group_id']) {
       $db_groups['group_name'] = $spacing . $db_groups['group_name'];	
       $groups_tree_array[] = $db_groups;
       }
       
      $groups_tree_array = $this->get_groups_tree($db_groups['group_id'], $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $exclude, $groups_tree_array, '', false, false);
    }

  

    return $this->db->db_output_data($groups_tree_array);
  } // function
  
  
   function get_users_to_groups($uID = '', $gID = '') {
      global $wt_sql;
      
     $users_to_groups = array();
      
  if(wt_not_null($uID) && $uID > 0) {    
      $db_users_to_groups_query = $this->db->db_query("SELECT group_id FROM " . TABLE_USERS_TO_GROUPS . " WHERE usr_id = '" . (int)$uID. "'");
      while($db_users_to_groups = $this->db->db_fetch_array($db_users_to_groups_query)) {
      $users_to_groups[] = $db_users_to_groups['group_id'];
      }
   }
     
     return $users_to_groups;
     } // function
          
          
          
   function saveUser($data = array()) {
     		global $wt_sql, $wt_user, $wt_session;
       
       $outside_action = false;
      
      if( wt_is_valid($data, 'array') ) {
       $user_array = $this->db->db_prepare_input($data);
       $outside_action = true;
       }	else {
       $user_array = $this->db->db_prepare_input($_REQUEST);
      }
       
       if( wt_is_valid( $user_array['uID'], 'int', '0' ) ) {
          $uID = $user_array['uID'];
          $action = 'save';			 
          if(isset($user_array['action_save']) && $user_array['action_save'] == 'save') {
          $action = 'save';          
          } else if(isset($user_array['action_save']) && $user_array['action_save'] == 'save_as') {
          $action = 'add';     
          }
       } else {
       $action = 'add';
       }
       
      $sql_user_data_array = array();
      $sql_user_data_array = array('usr_login' => $user_array['usr_login'],
      							        'status' => $user_array['status'],
      							        'language_id' => $wt_session->value('languages_id'));
     if(isset($user_array['usr_password']) && wt_not_null($user_array['usr_password'])) {	
      $sql_user_data_array['usr_pass'] = wt_encrypt_password($user_array['usr_password']);				  } 	
      
       if($action == 'add') {
       	$sql_user_data_array['date_added'] = 'now()';
       	$sql_user_data_array['added_by'] = $wt_user->usr_info['usr_id'];
         $this->db->db_perform(TABLE_USERS, $sql_user_data_array);
  	      $uID = $this->db->db_insert_id();
       } //$action == 'add'
       
       if($action == 'save') {
       	$sql_user_data_array['last_modified'] = 'now()';
  			$sql_user_data_array['modified_by'] = $wt_user->usr_info['usr_id'];
  			$this->db->db_perform(TABLE_USERS, $sql_user_data_array, 'update', "usr_id = '".$uID."' LIMIT 1");
			if($user_array['status'] == '1' && $user_array['old_status'] != '1' && $user_array['send_active_email'] == '1') {
				$mod_user = wt_module::singleton('mod_user');
				$aP = array();
     	  		$aP['usr_id'] = $uID;
     	  		$aP['action'] = 'user_activ';
		      $mod_user->send_system_message($aP);
			}
       } //$action == 'save'
       unset($sql_user_data_array);
		 
$sql_user_info_data_array = array('usr_gender' => $user_array['usr_gender'],
								          'usr_dob' => $user_array['_usr_dob_year'] . '-' . $user_array['_usr_dob_month'] . '-' . $user_array['_usr_dob_day'],
								          'usr_first_name' => $user_array['usr_first_name'],
								          'usr_second_name' => $user_array['usr_second_name'],
								          'usr_last_name' => $user_array['usr_last_name'],
								          'usr_nick' => $user_array['usr_nick'],
								          'usr_company' => $user_array['usr_company'],
								          'usr_company_vat_id' => $user_array['usr_company_vat_id'],
								          'usr_address' => $user_array['usr_address'],
								          'usr_suburb' => $user_array['usr_suburb'],
								          'usr_city' => $user_array['usr_city'],
								          'usr_post_code' => $user_array['usr_post_code'],
								          'usr_state' => $user_array['usr_state'],
								          'usr_country_id' => $user_array['usr_country_id'],
								          'usr_zone_id' => $user_array['usr_zone_id'],
								          'usr_email' => $user_array['usr_email'],
								          'usr_phone' => $user_array['usr_phone'],
								          'usr_fax' => $user_array['usr_fax'],
								          'usr_mobile' => $user_array['usr_mobile'],
								          'usr_www' => $user_array['usr_www'],
								          'usr_gg' => $user_array['usr_gg'],
								          'usr_tlen' => $user_array['usr_tlen'],
								          'usr_icq' => $user_array['usr_icq'],
								          'usr_skype' => $user_array['usr_skype'],
								          'usr_other_contact' => $user_array['usr_other_contact'],
										  ); 			
		
		
	  $upload_dir = 'mod_user' . DIRECTORY_SEPARATOR;		
		if(!is_dir(CFGF_DIR_FS_MEDIA . $upload_dir)) {
			wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
			$create_file = @fopen(CFGF_DIR_FS_MEDIA . $upload_dir . DIRECTORY_SEPARATOR . 'index.html', 'w');
			@fclose($create_file);
		}
		
		
										  
			if($action == 'add') {
  	       $sql_user_info_data_array['usr_id'] = $uID;
  	       $this->db->db_perform(TABLE_USERS_INFO, $sql_user_info_data_array);
			 wt_core_log::saveLog(array('ms_type' => 'manager_add', 'ms_title' => 'Dodano nowego użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'nU', 'mod_task_id' => $uID));
  	        }	
  	
  			if($action == 'save') {
		  	  	$this->db->db_perform(TABLE_USERS_INFO, $sql_user_info_data_array, 'update', " usr_id = '".$uID."' LIMIT 1 ");
				wt_core_log::saveLog(array('ms_type' => 'manager_edit', 'ms_title' => 'Edytowano  użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'nU', 'mod_task_id' => $uID));
				
				if( wt_is_valid($user_array['delete_usr_image'], 'int', '0') && wt_not_null($user_array['previus_usr_image'])) {
		
				@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $user_array['previus_usr_image']);
			
			$this->db->db_perform(TABLE_USERS_INFO, array('usr_image' => ''), 'update', " usr_id = '" . (int)$uID . "' LIMIT 1 ");
		}
				
		  	}	
  	
	$sql_image_data_array = array();
	$lP = array();
	$lP['dir'] = $upload_dir;
	$lP['file_name'] = $uID . '_image';
	$lP['file'] = 'usr_image';
	if( $usr_image_name = move_uploaded_media_file($lP) ) {
			$wt_sql->db_perform(TABLE_USERS_INFO, array('usr_image' => $usr_image_name), 'update', " usr_id = '" . (int)$uID . "' LIMIT 1 ");		
	}
	
	
  		unset($sql_user_info_data_array);
      
      $this->db->db_query("DELETE FROM " . TABLE_USERS_TO_GROUPS . " WHERE  usr_id = '" . (int)$uID . "'");
     wt_clear_empty_array($user_array['groups']);
	  if( !wt_is_valid($user_array['groups'], 'array') ) {	
		$user_array['groups'][] = $this->get_default_group();
	  }	
		
     	foreach($user_array['groups'] as $gr_id) {
	  	  $sql_user_to_groups_data_array = array('usr_id' => $uID,
	  	       									        'group_id' => $gr_id,
	  	       											  'date_added' => 'now()',
	  	       											  'added_by' => $wt_user->usr_info['usr_id']);
	     	$this->db->db_perform(TABLE_USERS_TO_GROUPS, $sql_user_to_groups_data_array);
	     }
			
  wt_plugins::run_action($this->module_key, 'saveUser', $action, $uID);
				
  if($outside_action) {
  		return $uID;
  } else {   
  $user_array['usr_id'] = $uID;	
  $wt_session->set('__user_data',$user_array);
  $site_url = wt_href_link('mod_user_manager', '', wt_get_all_get_params( array('a', 'm', 't') ) . 'm=users' );
  $wt_session->set('site_url', $site_url);
	
		if( $action == 'add' ) {
		$form_url = wt_href_link('mod_user_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'uID') ) . 'm=users&t=addUser&uID=' . $uID);
		$wt_session->set('form_url', $form_url);
		}
		
 wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $user_array['submit_type'] . '&opA=' . $action));		
        
   
   } //   if($outside_action) { return $uID; } else {  
    
     } // function
 
  function setUserStatus() {
         unset($params);
         $params['status'] = (int)$_GET['status'];
         $params['table'] = TABLE_USERS;
         $params['tbl_key'] = 'usr_id';
         $params['tbl_val'] = (int)$_GET['uID'];
         wt_change_status_base($params);   
			
			if($_GET['status'] == '1') {
				$mod_user = wt_module::singleton('mod_user');
				$aP = array();
     	  		$aP['usr_id'] = $_GET['uID'];
     	  		$aP['action'] = 'user_activ';
		      $mod_user->send_system_message($aP);
				wt_core_log::saveLog(array('ms_type' => 'manager_status1', 'ms_title' => 'Aktywowano użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'sUS', 'mod_task_id' => $_GET['uID']));
			} else {
				wt_core_log::saveLog(array('ms_type' => 'manager_status0', 'ms_title' => 'Deaktywowano użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'sUS', 'mod_task_id' => $_GET['uID']));
			}
         wt_plugins::run_action($this->module_key, 'setUserStatus', $_GET['status'], $_GET['uID']);  
        	die('ok');
        	

        }
			
 function get_users_for_form($params = array()) {
     
     $uParams = array();
     $uParams['dsplit'] = true;
	  $uParams['where'] = $params['where'];	
     $db_users = $this->get_users(null, $uParams);
     $users_list = array();
		     
     if( wt_is_valid($db_users, 'array') ) {
     
     foreach($db_users as $user) {     
	 	$users_list[$user['usr_id']] = $user['usr_last_name'].' '.$user['usr_first_name']. ' '.$user['usr_company'];     
     }
     
     }
   
   return $users_list;
   }        
   
   
   function wt_get_user_group_tree($parent_id = '0', $spacing = '', $exclude = '', $group_tree_array = '', $include_itself = false) {
    global $wt_sql;

    if (!is_array($group_tree_array)) { $group_tree_array = array(); }
   
    if ($include_itself) {
      $db_group_query = $this->db->db_query("SELECT group_name FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $parent_id . "'");
      $db_group = $this->db->db_fetch_array($db_group_query);
      $group_tree_array[] = array('id' => $parent_id, 'text' => $db_group['group_name']);
    }

    $db_groups_query = $this->db->db_query("SELECT group_id, group_name, parent_id FROM " . TABLE_USERS_GROUPS . " WHERE parent_id = '" . $parent_id . "' ORDER BY group_id");
    while ($db_groups = $this->db->db_fetch_array($db_groups_query)) {
      if ($exclude != $db_groups['group_id'] ) {
       $group_tree_array[] = array('id' => $db_groups['group_id'], 'text' => $spacing . $db_groups['group_name']);
       }
      $group_tree_array = $this->wt_get_user_group_tree($db_groups['group_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $group_tree_array);
    }

    return $group_tree_array;
  }
  
  function getUsersForAutocompletion() {
   		$params = array();
   		$params['dsplit'] = true;
 
 if (wt_not_null($_REQUEST['user'])) {
			if(wt_parse_search_string($_REQUEST['user'], $parsed_string)) {
		$params['where'] .= wt_parse_array_to_query($parsed_string, array('ui.usr_first_name', 'ui.usr_last_name', 'ui.usr_company', 'ui.usr_company_vat_id', 'ui.usr_email', 'ui.usr_address')). " AND ";
	 	} 
 
   		$users = $this->get_users(null,$params);
}
			
				echo "<ul class=\"user_list\">\n";
   		if (wt_is_valid($users,'array')) {
   			foreach ($users as $usr) {
	   			echo '<li id="'.$usr['usr_id'].'" class="user_list_element">';
	   			echo '<div>'.str_replace($_REQUEST['user'], '<b>' . $_REQUEST['user'] . '</b>', $usr['usr_first_name'])." ".str_replace($_REQUEST['user'], '<b>' . $_REQUEST['user'] . '</b>', $usr['usr_last_name'])."</div>";
	   			echo "<div class=\"informal\">".str_replace($_REQUEST['user'], '<b>' . $_REQUEST['user'] . '</b>', $usr['usr_company'])."</div>";
	   			echo "</li>\n";
	   		}
	   		
   		} else {
	   			echo '<li id="0" class="user_list_element">';
	   			echo '<div>NIE ZNALEZIONO UŻYTKOWNIKA</div>';
	   			echo "</li>\n";
	   	}
	   	  echo "</ul>\n";
   		die();
   }
   
  function wt_prepare_user_group_array_to_form() {
  
  $users_group_array = $this->wt_get_user_group_tree();
  
  $prepare_array = array();
  
  foreach($users_group_array as $key => $value) {
  
  $prepare_array[$value['id']] = $value['text'];
  }
  
  return $prepare_array;
  }
   
  function wt_get_access_desc($groups_array, $type = 'array') {

   
    
	 $groups = '';
	 	 	 
	$groups_array = wt_parse_access($groups_array);
	 
		 
   foreach($groups_array as $group_id) {
   
   
   if($group_id == '0' || $group_id == '' || $group_id == '2') {
   
   if($type == 'array') {
   $groups[] = array('group_id' => '2', 'group_name' => 'Wszyscy użytkownicy');
   }
   
   if($type == 'text') {
   $groups .= 'Wszyscy użytkownicy<br>';
   }
   
   } else {
   
   $db_group_query = $this->db->db_query("SELECT group_id, group_name FROM " . TABLE_USERS_GROUPS . " WHERE group_id = '" . $group_id . "'");
   $db_group = $this->db->db_fetch_array($db_group_query);
   
   if($db_group['group_id'] != '1') {
   
   if($type == 'array') {
   
   $groups[] = array('group_id' => $db_group['group_id'],
   						'group_name' => $db_group['group_name']);
    }
    	 					
   if($type == 'text') {
   $groups .= $db_group['group_name'] . '<br>';
   }
   }
   }
}
  return $groups;

} 

function _structureJSTree($data = false) {
    	global $wt_template;
	
	$structure = array();
	
 if( $data === true ) {	  
  $structure['children'] = $this->get_structure_tree();
 } else {
  $structure = array('title' => 'Użytkownicy',
							 'ico' => '',
							 'link' => wt_href_link('mod_user_manager'),
							 'target' => 'site',
							 'url' => wt_href_link('mod_user_manager') );
 }	

	
		return $structure;
	
    }
        
    function get_structure_tree($parent_id = 0) {
        
				$gParams = array();
        		$gParams['where'] = " parent_id = '" . (int)$parent_id . "' ";
        		$group_data = $this->get_groups(null, $gParams);
			
  $items = array();
				
        		foreach($group_data as $g) {
        		if( $g['group_id'] == '3' ) {
					continue;
				}
        	
  $item = array();      		
  $item = array('type' => 'folder',
  			       'status' => 1,
  					 'name' => $g['group_name'],
  					 'url' => wt_href_link('mod_user_manager', '', 'm=users&gPath=' . $g['gPath']) 
  					 );        		
					$item['children'] = $this->get_structure_tree($g['group_id']);
        			$items[] = $item;
        		}
        		
        return $items;
        
        }      
 
function _mod_menu($params = array(), $admin = false ) {
	 	
		$this->wt_navigationbar($params);
  
	
  $menu_data[] = array('mod_ico' => true,	
					  		  'href' => wt_href_link('mod_user_manager'),
							  'ico' => $this->module_key  );
	
	$cgi = $this->current_group_id($params['gPath']);
	include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu_admin.php');
  
		return $menu_data;
	 
	 }		
	 
   function wt_navigationbar() {
          global $wt_template, $wt_navigationbar, $wt_module;
    
	 $this->_navigationbar = new wt_breadcrumb();      
    $this->_navigationbar->add($wt_module->module_info['mod_name'], wt_href_link()); 
          	   
 }           
          
     } // class
     
  



?>