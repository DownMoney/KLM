<?php 
class mod_core_logs_manager {
         var $task;
   		var $action;
  		   var $mode;
   		var $module_dir;
   		var $module_class;
   		var $module_key = 'mod_core_logs_manager';

        
   function mod_core_logs_manager() {
   	global $wt_module;
         $this->module_dir = dirname(__FILE__);
  			$this->module_class = get_class($this);
  			$this->module_params = $wt_module->get_module_params($this->module_class);
   }
   
   
  	
  function get_module_path() {
   return dirname(__FILE__);
   }
  
  function get_module_class() {
   return $this->module_class;
   } 
        
        
        
  	function __construct() {

         $class_name = __CLASS__;
    	  	$this->$class_name();

    	  	}

    	function _init() {
        
  $this->task = wt_set_task($_REQUEST, 't');
  $this->action = wt_set_task($_REQUEST, 'a');
  $this->mode = wt_set_task($_REQUEST, 'm');
         
       switch($this->action) {
       		case 'delMessage':
       			$this->delMessage();
       		break; 
       		case 'massActiv':
       			$this->massActivDeactiv(1);
       		break;
       		case 'massDeactiv':
       			$this->massActivDeactiv(0);
       		break; 
       		case 'massDel':
       			$this->massDel(0);
       		break;     
                   }

    if(!wt_not_null($this->action))  { 
       
  switch ($this->mode) {
  
    default:
    case 'messages':
    	switch($this->task) {
    	   default:
    		case 'messages':
     			$this->messages();
				
     		break;
     		case 'messagesLittleBox':
     			$this->messagesLittleBox();
     		break;
     		case 'messagePage':
     			$this->messagePage();
     		break;
   	} //switch($this->task) {
    break;
    case 'logs':
    	switch($this->task) {
     		default:
     			$this->logs();
     		break;
   	} //switch($this->task) {
    break;
  } // switch ($this->mode) {
  
  $this->wt_navigationbar();
  
     } //if(!wt_not_null($this->action))  { 
        } //function
      
      function massDel() {
      	$messages = wt_set_task($_REQUEST, 'ms');
      	
      	if(isset($messages) && is_array($messages) && wt_not_null($messages)) {
      	   foreach($messages as $ms_id) {
      	   	$this->delMessage( array('mID' => $ms_id) );
      	   }
      	   
      	   global $wt_message_stack;
      		$wt_message_stack->add_session('Wiadomo¶ci usuni&#40165;', 'Wiadomo¶ci nr: ' . implode(', ', $messages) . ' zosta3y pomy¶lnie <b><u>usuni&#40165;</u></b>.', 'ok');
      	}
      	
      	 wt_redirect( wt_href_link('', '', wt_get_all_get_params( array('a') )) );
      
      }
      
      function massActivDeactiv($op) {
      	global $wt_sql;
      	
      	$messages = array();
      	$messages = wt_set_task($_REQUEST, 'ms');
      	
      	if(isset($messages) && is_array($messages) && wt_not_null($messages)) {
      		
      			$wt_sql->db_query("UPDATE " . TABLE_CORE_MESSAGES . " SET ms_readed = '" . $op . "' WHERE ms_id IN (" . implode(',', $messages) . ")");
      		
      		 global $wt_message_stack;
      		 switch($op) {
      		 	case '0':
      		 	$wt_message_stack->add_session('Wiadomo¶ci oznaczone', 'Wiadomo¶ci nr: ' . implode(', ', $messages) . ' zosta3y oznaczone jako <b><u>nieprzeczytane</u></b>.', 'ok');
      		 	break;
      		 	case '1':
      		 	$wt_message_stack->add_session('Wiadomo¶ci oznaczone', 'Wiadomo¶ci nr: ' . implode(', ', $messages) . ' zosta3y oznaczone jako <b><u>przeczytane</u></b>.', 'ok');
      		 	break;
      		 }	
      	}
      	
      wt_redirect( wt_href_link('', '', wt_get_all_get_params( array('a') )) );
      		
      }
      
      
      function delMessage($data = array() ) {
      	global $wt_sql;
      	$outside_action = false;
      	
      if(isset($data) && is_array($data) && (int)$data['mID'] > 0) {
      	$mID = (int)$data['mID'];
      	$nmID = (int)$data['n_mID'];
      	$outside_action = true;
      } else {
      	$mID = (int)wt_set_task($_REQUEST, 'mID');
      	$nmID = (int)wt_set_task($_REQUEST, 'n_mID');
      }	
      
      if($mID > 0) {
      	$wt_sql->db_query("DELETE FROM " . TABLE_CORE_MESSAGES . " WHERE ms_id = '" . (int)$mID . "' LIMIT 1");
      }
      
      if($outside_action === false) {
      
        global $wt_message_stack;
   		$wt_message_stack->add_session('Usunięto wiadomość', 'Wiadomość: ' . $mID . ' została pomyślnie usunięta.', 'ok');
   	
      	if($nmID > 0) {
      	wt_redirect( wt_href_link('', '', wt_get_all_get_params( array('a', 'mID') ) . 'mID=' . $nmID) );
      	} else {
      	wt_redirect( wt_href_link('', '', wt_get_all_get_params( array('a', 'mID') ) ) );
      	}
      	
      }
      
      
      }
      
      function logs() {
      	global $wt_template;
      	
      $log_script = '';
	   $log_script .= '<script type="text/javascript">' . "\n";
      $log_script .= 'var log_tab = new rotateElements("log_tab", "log_page");' . "\n";
  		$log_script .= '</script>' . "\n";
  		
  		$wt_template->add_to_header($log_script);
      	
      	$start = wt_set_task($_REQUEST, 'st', 0);
      	$end = wt_set_task($_REQUEST, 'en', 50);
      	
        //	wt_print_array($this->parse_logs($this->task, $start, $end));
      	
      		$wt_template->assign('logs_listing', $this->parse_logs($this->task, $start, $end));
      		$wt_template->assign('count_logs', $this->count_logs);
      		  		
      		$wt_template->load_file($this->task);
      		
      		
      		
      		
      }
      
      
      function parse_logs($log_type = '', $start = 0, $end = 100) {
      		
      		$file = 'logs/' . basename($log_type) . '.log';
      	 	$admin_logs_array = array(); 	
      		$sep = chr(9);
      		
     if(file_exists($file) && is_file($file) && is_readable($file)) {
     
         $h = array();
     		$h = @file($file);
     		
     	  if(isset($h) && is_array($h) && wt_not_null($h)) {	
     	  		    	$this->count_logs = count($h);
     	  		    	     		    	  
     	  		    	  if($end > ($this->count_logs-$start-1)) {
     	  		    	  		$end = $this->count_logs-$start-1;
     	  		    	  }
     	  rsort($h);		
     	      	      	  
     		 	for($i = $start; $i <= $end; $i++) { 	
     		 	
     		 		$logs = split($sep, $h[$i]);
     		 	
     		 	switch($log_type) {
     		 		case 'db_error':
     		 		  $logs[4] = @unserialize($logs[4]);
     		 		  $admin_logs_array[] = $logs;
     		 		break;
     		 		case 'core_error':
     		 			$logs[3] = @unserialize($logs[3]);
     		 		   $admin_logs_array[] = $logs;
     		 		break;
     		 		default: 
     		 		$admin_logs_array[] = $logs;
     		 		break;
     		 	}
     		 	
 		
 					}
     		}
     		
     		    		  
     }     
      
       return $admin_logs_array;
      
      }
      
      function messages() {
        global $wt_template;
        
         wt_check_permission('', 'ms_view', true);
	 
	  $params = array();
	  $params['get_user_data'] = true;	
	  $params['get_desc'] = true;	
		
		
	 if(isset($_GET['SmID']) && (int)$_GET['SmID'] > 0) {
	  $params['where'] .= " ms_id = '" . (int)$_GET['SmID'] . "' AND ";	
	 }
	 
	 if(isset($_GET['ms_text']) && wt_not_null($_GET['ms_text'])) {
	  $params['where'] .= " (ms_text LIKE '%" . $_GET['rw_text'] . "%' OR  ms_title LIKE '%" . $_GET['ms_text'] . "%') AND ";	
	 }
	 $iSearch = wt_string_user_safe_array(wt_set_task($_REQUEST, 'iSearch'));
	 if(wt_is_valid($iSearch, 'array')) {
	 	if(wt_is_valid($iSearch['usr_id'], 'int', 0)) {
			$params['where'] .= " usr_id = '".(int)$iSearch['usr_id']."' ";
		}
		if(wt_is_valid($iSearch['mod_id'], 'int', 0)) {
			$params['where'] .= " mod_id = '".(int)$iSearch['mod_id']."' ";
		}		
		if(wt_is_valid($iSearch['mod_id'], 'int', 0)) {
	  //		$params['where'] .= " mod_id = '".$iSearch['mod_id']."' AND ";
		}
	 }
	 
    
     $wt_template->assign('items_listing', $items_listing = $this->get_messages(null, $params));
     
     
     $number_of_messages_text = $this->split_listing->display_count($this->db_data_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z %s rekordów)');
     $wt_template->assign('number_of_items_text', $number_of_messages_text);
    
     $number_of_messages_links = $this->split_listing->display_links($this->db_data_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
     
     $wt_template->assign('number_of_items_links', $number_of_messages_links);
     
     $wt_template->assign('display_to_display', $this->split_listing->display_to_display());
          
	  $wt_template->tFile = 'theme_list';	
     $wt_template->load_file('messages.tpl');
        
      }
      
      function get_selected_message_id($messages_listing) {
    
    if(isset($_GET['mID']) && $_GET['mID'] > 0) {
     return $_GET['mID'];
    } else {
     return $messages_listing['0']['ms_id'];
    }
    
   }	
   
   function count_not_readed_messages() {
    	global $wt_sql;
    	
    	$db_count_query = $wt_sql->db_query("SELECT COUNT(*) AS total FROM " . TABLE_CORE_MESSAGES . " WHERE ms_readed = '0'");
   
   	$db_count = $wt_sql->db_fetch_array($db_count_query);
   	
   	return $db_count['total'];
    
   }	
   
   
   
      
      function messagePage() {
      	global $wt_template, $wt_sql;
      	$mID = wt_set_task($_REQUEST, 'mID');
      	
      	if(isset($mID) && (int)$mID > 0) {
      		
      	  $params = array();
      	  $params['limit'] = '1';	
      	  $params['dsplit'] = true;
      	  
      	  $params['where'] = " ms_id < '" . $mID . "' ";
      	  $prev_message = $this->get_messages('', $params);	
      	  $wt_template->assign('prev_message_data', $prev_message[0]);		
      	  $params['where'] = " ms_id > '" . $mID . "' ";
      	  $params['order'] = " ms_id ";
      	  
      	  $next_message = $this->get_messages('', $params);	
      	  $wt_template->assign('next_message_data', $next_message[0]);		
      	  
      	  $wt_template->assign('message_data', $this->get_messages($mID));	
      	  $wt_sql->db_query("UPDATE " . TABLE_CORE_MESSAGES . " SET ms_readed = '1' WHERE ms_id = '" . $mID . "'");
      	       		
      	  $wt_template->load_file('messagePage');	
      	}
      
      }//function
      
      function messagesLittleBox() {
      	global $wt_template, $wt_navigation;
      	
      	$wt_navigation->remove_current_page();
      	
      		$params = array();
      		$params['limit'] = '5';
      		$params['dsplit'] = true;
      		
      	
      		
      		$wt_template->assign('messages_listing', $this->get_messages('', $params));
      		
      	  $wt_template->load_file('popup_messagesLittleBox');	
      		
      }  
              
        
	function get_messages($ms_id = null, $params = array() ) {
     	global $wt_sql, $wt_session, $wt_template, $wt_module, $wt_plugins;
        
        $data_array = array();
        
     if(wt_is_valid($ms_id, 'int', 0)) {
     $db_data_query_raw = "SELECT * FROM " . TABLE_CORE_MESSAGES . " WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " ms_id = '" . (int)$ms_id . "' LIMIT 1";
     } else {     
     $db_data_query_raw = "SELECT * FROM " . TABLE_CORE_MESSAGES . " " . ( (isset($params['where']) && wt_not_null($params['where'])) ? ' WHERE ' . $params['where'] : '') . " ";
     
     if(!isset($params['order'])) {
      $db_data_query_raw .= " ORDER BY date_added DESC";
     }
     
     if(isset($params['order'])) {
      $db_data_query_raw .= " ORDER BY " . $params['order'];
     }
     
     if(isset($params['limit']) && isset($params['dsplit'])) {
      $db_data_query_raw .= " LIMIT 0, " . $params['limit'];
     }
      
    if(!isset($params['dsplit'])) { 
     $this->split_listing =  new splitPageResults($_GET['page'], ($wt_session->value('results_to_display')) ? $wt_session->value('results_to_display') : MAX_DISPLAY_SEARCH_RESULTS, $db_data_query_raw, $this->db_data_query_numrows);
     }
     
     }
     
     $db_data_query = $wt_sql->db_query($db_data_query_raw);
	  if($params['get_user_data'] === true) {	
	  	$mod_user_manager	= wt_module::singleton('mod_user_manager');
	  }	
	  if($params['get_desc'] === true) {		
	  	$core_log_plugins = $wt_plugins->load_module_plugins('core_log');
	  }
		
		
          
     while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
      
		if($params['get_user_data'] === true) {
			if(wt_is_valid($db_data['usr_id'], 'int', 0) && wt_is_valid($_users_data[$db_data['usr_id']], 'array')) {
				$db_data['user_data'] = $_users_data[$db_data['usr_id']];
			} elseif(wt_is_valid($db_data['usr_id'], 'int', 0)) {
				$_users_data[$db_data['usr_id']] = $mod_user_manager->db->db_fetch_array($mod_user_manager->db->db_query("SELECT usr_first_name, usr_last_name, usr_email, usr_id FROM ".TABLE_USERS_INFO." WHERE usr_id = '".$db_data['usr_id']."' LIMIT 1"));
				$db_data['user_data'] = $_users_data[$db_data['usr_id']];
			}
		}    
		$mod_key = $wt_module->get_module_key($db_data['mod_id']);
		$db_data['mod_text'] = $wt_module->installed_modules[$mod_key]['mod_title'];
		if($params['get_desc'] === true && wt_is_valid($core_log_plugins, 'array') && in_array($mod_key, $core_log_plugins)) {	
			if(!wt_is_valid($core_log_plugins_instances[$mod_key], 'object')) {
				$instance = $mod_key.'_core_log_plug';
				$core_log_plugins_instances[$mod_key] = new $instance;
			}
			if(wt_is_valid($core_log_plugins_instances[$mod_key], 'object')) {
				$db_data['desc'] = $core_log_plugins_instances[$mod_key]->parse_message($db_data);
			}
			
		}	 
			 
			 
      if(wt_is_valid($ms_id, 'int', 0)) {
      $data_array = $wt_sql->db_output_data($db_data);
      } else {
      $data_array[] = $wt_sql->db_output_data($db_data);
      }

     }
    
    return $data_array;
    } 	
    
 	function _structureJSTree($data = false) {
    	global $wt_template, $wt_module, $wt_sql;
		$structure = array();
	 	if($data === true ) {	  
		
			$db_mods_query = $wt_sql->db_query("SELECT DISTINCT(mod_id) FROM ".TABLE_CORE_MESSAGES."");
			while($db_mods = $wt_sql->db_fetch_array($db_mods_query)) {
				$mods_ids[$db_mods['mod_id']] = $db_mods['mod_id'];
			}
  			$items_local = array();
  			$items_a = array();
  			if (wt_is_valid($wt_module->installed_modules_local,'array')) {
  				foreach ($wt_module->installed_modules_local as $mod_key) {
					if(!in_array($wt_module->installed_modules_keys[$mod_key], $mods_ids)) {
						continue;
					}
  					$items_local[] = array('type' => 'doc',
				  				          'status' => 1,
				  						  'name' => (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key),
				  						  //'name' => $mod_key,
				  						  'url' => wt_href_link('mod_core_logs_manager', '', 'm=messages&iSearch[mod_id]='.$wt_module->installed_modules_keys[$mod_key]),
  				 	);   
  				}
  			}
	 		$items_mod = array();
  				if (wt_is_valid($wt_module->installed_modules_manager,'array')) {
  					foreach ($wt_module->installed_modules_manager as $mod_key) {
						if(!in_array($wt_module->installed_modules_keys[$mod_key], $mods_ids)) {
							continue;
						}
  						$items_mod[] = array('type' => 'doc',
					  				          'status' => 1,
					  						 'name' => (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key),
				  						  //'name' => $mod_key,
					  						  'url' => wt_href_link('mod_core_logs_manager', '', 'm=messages&iSearch[mod_id]='.$wt_module->installed_modules_keys[$mod_key]),
					  						  );   
  					}
  				}
  				$items[] = array('type' => 'folder',
  				          'status' => 1,
  						  'name' => 'Administracja',
  						  'url' => '',
  						  'docs' => $items_mod
  					 	);   
  				$items[] = array('type' => 'folder',
  				          'status' => 1,
  						  'name' => 'Użytkownicy',
  						  'url' => '',
  						  'docs' => $items_local
  					 	); 
  			
	 		$structure['children'] = $items;
	 		$structure['docs'][] = 	array('type' => 'doc',
  				          'status' => 1,
  						  	 'name' => 'wszystkie',
  						  	 'url' => wt_href_link('mod_core_logs_manager', '', 'm=messages'),
  						  );   
 		} else {
  			$structure = array('title' => 'Logi systemowe',
							   'ico' => '',
							   'link' => wt_href_link('mod_core_logs_manager', '', ''),
							   'target' => 'site',
							   'url' => wt_href_link('mod_core_logs_manager', '', '') );
 		}	
		return $structure;
	}
 
   function wt_navigationbar() {
          global $wt_template, $wt_navigationbar, $wt_module;
        
    
    $wt_navigationbar->add($wt_module->module_info['mod_name'], wt_href_link()); 
     
  switch($this->mode) {
 	case 'logs':	
 		  $wt_navigationbar->add('Logi');
   break;
   case 'messages':	
 		  $wt_navigationbar->add('Wiadomości');
   break;   
 }       
         
 switch($this->task) {
 	case 'messagePage':	
 		  $wt_navigationbar->add('Wiadomości' . $_REQUEST['mID']);
   break;
   case 'core_error':	
 		  $wt_navigationbar->add('Błąd systemu');
   break;
   case 'php_error':	
 		  $wt_navigationbar->add('Błąd PHP');
   break;
   case 'db_error':	
 		  $wt_navigationbar->add('Błąd bazy danych');
   break;
   case 'admin_action':	
 		  $wt_navigationbar->add('Praca administratora');
   break;
   case 'user_action':	
 		  $wt_navigationbar->add('Akcje użytkowików');
   break;
   
 }  
        

 
        }  // function  
 
 
   	
  } // class
  
  
  ?>
