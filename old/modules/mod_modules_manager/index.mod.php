<?php 


  class mod_modules_manager {
   var $task;
   var $action;
   var $mode; 
   var $module_dir;
   var $module_class;
   var $module_key = 'mod_modules_manager';
  
  function mod_modules_manager() {
  $this->module_dir = dirname(__FILE__);
  $this->module_class = get_class($this);
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
  
	if($this->action) {		 
		$cache = new wt_cache();
		$cache->clear(array('core','module'));
		unset($cache);  
  }
	
   switch($this->action) {
     case 'saveModule':
     $this->saveModule();
     break;
     case 'updateDBTableInfo':
     $this->updateDBTableInfo();
     break;
     case 'delModule':
     $this->delModule();
     break;
	  case 'getShowonStruture':
	  $this->getShowonStruture();
	  break;		
   }
  
 if(!wt_not_null($this->action)) {
 
 $this->_moduleLittleMenu();
 
  switch($this->task) {
    
    default:
       switch($this->mode) {
       default:
       case 'loc': 
       $this->main_page('local');
       break;
       case 'man': 
       $this->main_page('manager');
       break;
       }
    break;
    case 'editModule':
     $this->editModule();
    break;
    }
  }
  }
  
  
  function _moduleLittleMenu() {
	 	global $wt_template;
	 
	 include($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'moduleLittleMenu.php'); 
	 
	 $wt_template->assign('__moduleLittleMenu__', $little_menu);
	 
	 }  
  
  function delModule() {
  	global $wt_sql;
  	
  	$mID = wt_set_task($_GET, 'mID');
  	
  	if( wt_is_valid($mID, 'int', '0') ) {
  	
  		$mod_data = $this->get_installed_modules($mID);
 if(wt_is_valid($mod_data, 'array') && !wt_is_valid($mod_data['mod_system'], 'int', '0')) {
  		$wt_sql->db_query("DELETE FROM " . TABLE_MODULES . " WHERE mod_id = '" . (int)$mID . "'");
      $wt_sql->db_query("DELETE FROM " . TABLE_MODULES_DESCRIPTION . " WHERE md_id = '" . (int)$mID . "'");
      $wt_sql->db_query("DELETE FROM " . TABLE_MODULES_PERMISSION . " WHERE mod_id = '" . (int)$mID . "'");
  
  if(wt_not_null($mod_data['mod_key'])) {
		$params = array();
		$params['dirname'] = CFGF_DIR_FS_MODULES . $mod_data['mod_key'];		
  		wt_rmdir($params);
  		
  		if(wt_not_null($mod_data['theme'])) {
  			$params = array();
		   $params['dirname'] = CFGF_DIR_FS_TEMPLATES . $mod_data['theme'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mod_data['mod_key'];		
  		    wt_rmdir($params);
  		}
  		
  		}
 }
 }
  		$this->updateDBTableInfo(false);
  		
  wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('mID', 'a', 't'))));	
  }
  
  function updateDBTableInfo($redirect = true) {
  		global $wt_sql;
  		$params = array();
  		//$params['where'] = " m.mod_type = 'manager' AND ";
  		$modules_array = $this->get_installed_modules();
  	
	
  	foreach($modules_array as $module) {
  		if( is_dir(CFGF_DIR_FS_MODULES . $module['mod_key'] . DIRECTORY_SEPARATOR . 'install') && file_exists(CFGF_DIR_FS_MODULES . $module['mod_key'] . DIRECTORY_SEPARATOR . 'install' . DIRECTORY_SEPARATOR . 'db_tables.install.php') ) {
  				
  				include(CFGF_DIR_FS_MODULES . $module['mod_key'] . DIRECTORY_SEPARATOR . 'install' . DIRECTORY_SEPARATOR . 'db_tables.install.php');
  				
  				if( wt_is_valid($mod_db_tables, 'array') ) {
  					$wt_sql->db_query("UPDATE " . TABLE_MODULES . " SET mod_db_tables = '" . serialize($mod_db_tables) . "' WHERE mod_id = '" . $module['mod_id'] . "' LIMIT 1 ");
  				}
  				
  			
  		}
  			
  	}
  	
  	@unlink(CFGF_DIR_FS_WORK . 'sys_db_tables.php');
	
 if($redirect === true) { 	
  	wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('mID', 'a', 't'))));	
  	}
  }
  
  function main_page($mode) {
  global $wt_sql, $wt_session, $wt_template;
  
    $params = array();
    
    
    switch($mode) {
    	default:
    	case 'local':
    	$params['where'] = " m.mod_type = 'local' AND ";
    	break;
    	case 'manager':
    	$params['where'] = " m.mod_type = 'manager' AND ";
    	break;
    }
  
    $modules_listing = $this->get_installed_modules('', $params);
    
     $wt_template->assign('modules_listing', $modules_listing);
          
     $wt_template->assign('module', $this->get_installed_modules($this->get_selected_module_id($modules_listing)));
    
     $wt_template->assign('modules_count', sizeof($modules_listing));
     $wt_template->assign('mode', $mode);
	  $wt_template->tFile = 'theme_list';
     $wt_template->load_file('index.tpl');
		
  }
  
  function editModule() {
    global $wt_sql, $wt_session, $wt_template, $wt_module;
  
	  $wt_template->tFile = 'theme_self';
    include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'editModule.php');
    
   
  }
  
  
  function saveModule($data_array = array() ) {
     global $wt_sql, $wt_session, $wt_user;
     
	
     $data_array = $wt_sql->db_prepare_input($_POST);
          
     if($data_array['mID'] && wt_not_null($data_array['mID'])) {
     $action = 'save';
     $mID = $data_array['mID'];
     } else {
     $action = 'add';
     }
          
     
$sql_data_array = array('status' => $data_array['status'],
											'mod_home' => $data_array['mod_home'],
									     'access' => wt_parse_access_for_db($data_array['access']));
										  
	  if($action == 'add') {

   $sql_data_array['date_added'] = 'now()';
  	$sql_data_array['added_by'] = $wt_user->usr_info['usr_login'];
  	
  	$wt_sql->db_perform(TABLE_MODULES, $sql_data_array);
  	$mID = $wt_sql->db_insert_id();
	  
	  }	
	  
	  if($action == 'save') {	
	  
   $sql_data_array['last_modified'] = 'now()';
  	$sql_data_array['modified_by'] = $wt_user->usr_info['usr_login'];
  	
  	
  	$wt_sql->db_perform(TABLE_MODULES, $sql_data_array, 'update', 'mod_id = ' . $mID);
	  
	  }		 
	  
	 $sql_desc_data_array = array('mod_title' => $data_array['mod_title'],
								        'mod_short_desc' => $data_array['mod_short_desc'],
										  'mod_desc' => $data_array['mod_desc'],
					 					  'params' => wt_parse_params_for_db($data_array['params'])); 			
										  
			if($action == 'add') {
  	$sql_desc_data_array['md_id'] = $mID;
  	$wt_sql->db_perform(TABLE_MODULES_DESCRIPTION, $sql_desc_data_array);
  	}
   
  	
  	if($action == 'save') {
  	$wt_sql->db_perform(TABLE_MODULES_DESCRIPTION, $sql_desc_data_array, 'update', "md_id='".$mID."'  AND language_id = '".$wt_session->value('languages_id')."' LIMIT 1");
  	}	
  	

  	
  	wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('mID', 'a', 't', 'm')) . 'mID=' . $mID . '&m=modules'));		  
    
    }
  
  function get_installed_modules($mod_id = '', $params = array() ) {
   global $wt_sql, $wt_session, $wt_template, $wt_module;
   
   if(wt_not_null($mod_id) && (int)$mod_id > 0) {
    	 
    	 $db_admin_modules_query_raw = "SELECT * FROM " . TABLE_MODULES . " m, " . TABLE_MODULES_DESCRIPTION . " md WHERE " . (isset($params['where']) ? $params['where'] : '') . " m.mod_id = '" . (int)$mod_id . "' AND m.mod_id = md.md_id AND md.language_id = '" . $wt_session->value('languages_id') . "'"; 
    	 
    } else {   
        
      $db_admin_modules_query_raw = "SELECT * FROM " . TABLE_MODULES . " m, " . TABLE_MODULES_DESCRIPTION . " md WHERE " . (isset($params['where']) ? $params['where'] : '') . " m.mod_id = md.md_id AND md.language_id = '" . $wt_session->value('languages_id') . "'";
   
   
   }
   
   
   $db_admin_modules_query = $wt_sql->db_query($db_admin_modules_query_raw);
   
   $admin_modules = array();
   
   while($db_admin_modules = $wt_sql->db_fetch_array($db_admin_modules_query)) {
   
   $db_admin_modules['status_text'] = wt_return_item_status_easy($db_admin_modules['status']);
   $db_admin_modules['system_text'] = wt_return_item_yes_or_no($db_admin_modules['mod_system']);
   
   if(wt_not_null($mod_id)) {
   
   $mod_templates_manager = wt_module::singleton('mod_templates_manager');
   
   $db_admin_modules['access_text'] = wt_get_access_desc($db_admin_modules['access'], 'text');
   $db_admin_modules['access_desc'] = wt_get_access_desc($db_admin_modules['access']);
   $db_admin_modules['access_desc'] = wt_get_access_desc($db_admin_modules['access']);
   $db_admin_modules['theme_desc'] = $mod_templates_manager->get_theme_info($db_admin_modules['theme']);
   $db_admin_modules['themes_for_module'] = $mod_templates_manager->get_themes_for_module($db_admin_modules['mod_key']); 
   $db_admin_modules['blocks'] = $this->get_blocks_to_module($db_admin_modules['mod_id']);
   $db_admin_modules['blocks_depends'] = $this->get_blocks_depends_on_module($db_admin_modules['mod_key']);
  // $db_admin_modules['description'] = $wt_module->get_module_desc($wt_module->get_module_xml_array('mod_content', 'mod_info'), 'short'); 
   
   }
   
   
   if(wt_not_null($mod_id)) {
          $admin_modules = $db_admin_modules;
       } else {
          $admin_modules[] = $db_admin_modules;
      }
   
   }
   
   
   
   return $wt_sql->db_output_data($admin_modules);
  }
  
  function get_selected_module_id($admin_modules) {
    
    if($_GET['mID']) {
     return $_GET['mID'];
    } else {
     return $admin_modules['0']['mod_id'];
    }
    
   }
   
  function get_blocks_to_module($mod_id) {
   global $wt_sql, $wt_session;
   
	return array();
	
  }
  
  function get_blocks_depends_on_module($mod_key) {
   global $wt_sql, $wt_session;
    
   $blocks_depends = '';
     
     $db_block_query = $wt_sql->db_query("SELECT block_id, block_name  FROM " . TABLE_BLOCKS . " WHERE block_depends = '" . $mod_key . "'");
     
     while($db_block = $wt_sql->db_fetch_array($db_block_query)) {
       $blocks_depends[] = $db_block;
     }
    return $wt_sql->db_output_data($blocks_depends);
  }
  
  function parse_theme_list_for_form($mod_key) {
  $theme_array = '';
  $avaible_themes = mod_templates_manager::get_themes_for_module($mod_key);
  
  if(is_array($avaible_themes)) {
  foreach($avaible_themes as $theme) {
    $theme_array[$theme['tem_key']] = $theme['tem_name'];
  
  }}
  
  return $theme_array;
  
  
  }
  
  function parse_selected_theme_for_form($theme) {
  $theme_info = '';
  $theme_info = mod_templates_manager::get_theme_info($theme);
  
  $parse_theme[$theme_info['tem_key']] = $theme_info['tem_name'];
   
  return $parse_theme;
  
  
  }
  
  function parse_parameters_from_xml_array($xml_array) {
    global $wt_template;
    
    if(!is_array($xml_array)) {
    return;
    }
    
    foreach($xml_array['PARAMS']['PARAM'] as $parameters) {
	 
	 if(is_array($parameters['OPTION'])) {
	 foreach ($parameters['OPTION'] as $op) {
	    $parameters['ATTRIBUTES']['OPTIONS'][$op['ATTRIBUTES']['VALUE']] = $op['ATTRIBUTES']['NAME'];
	 }
	 
	 
	 }
	 
	
 	$return[] = $parameters['ATTRIBUTES'];
	$names[] = array('name' => $parameters['ATTRIBUTES']['NAME'],
				        'desc' => $parameters['ATTRIBUTES']['DESCRIPTION'],
				        'label' => $parameters['ATTRIBUTES']['LABEL'],);
	
	
	}

   $wt_template->assign('emodule_params_xml', $names);
   return $return;
  }
  
  
  function get_modules_for_form($params = array() ) {
  
  		$modules_for_form_array = array();
  
  if(isset($params['add_blank'])) {
  
  		if(!isset($params['blank_value'])) {
  		$params['blank_value'] = '';
  		}
  		
  		if(!isset($params['blank_text'])) {
  		$params['blank_text'] = '=== WYBIERZ ===';
  		}
  
  		$modules_for_form_array[$params['blank_value']] = $params['blank_text'];
  }
  
  if(isset($params['type'])) {
         $Mparams = array();
  			$Mparams['where'] = "m.mod_type = '" . $params['type'] . "' AND ";
  			$modules_listing = $this->get_installed_modules('', $Mparams);
  		} else {
  		$modules_listing = $this->get_installed_modules();
  		}
  	
  	
  	
  	
  	if(is_array($modules_listing) && wt_not_null($modules_listing)) {
  	
  		foreach($modules_listing as $module) {
  		
  		if( isset($params['use_keys']) && $params['use_keys'] === true ) {
  		$modules_for_form_array[$module['mod_key']] = (isset($params['add_type']) ? (($module['mod_type'] == 'local') ? '[L] ' : '[M] ') : ''  ) . (wt_not_null($module['mod_title']) ? $module['mod_title'] : $module['mod_name'] );
  		} else {
  		$modules_for_form_array[$module['mod_id']] = (isset($params['add_type']) ? (($module['mod_type'] == 'local') ? '[L] ' : '[M] ') : ''  ) . (wt_not_null($module['mod_title']) ? $module['mod_title'] : $module['mod_name'] );
  		}
  			
  		
  		}
  	
  	
  	}	
  	
  	return $modules_for_form_array;
  		
  
  } // function
  
	
   function update_language_tables($lang_id) {			
  		global $wt_sql;
  			
  			$a = $wt_sql->db_list_tables();  			
  			for ($i = 0; $i < $wt_sql->db_num_rows($a); $i++) {
  			if(stristr($wt_sql->db_tablename($a, $i), DB_PREFIX) && (substr($wt_sql->db_tablename($a, $i), -11) == 'description' || substr($wt_sql->db_tablename($a, $i), -4) == 'desc' ) )  {
  		 	$system_tables[] = $wt_sql->db_tablename($a, $i);
  		 	}
  			}
  			foreach($system_tables as $table) {
  			  $db_data_query = $wt_sql->db_query("SELECT * FROM " . $table . " WHERE language_id = '5' ");
  			  while($db_data = $wt_sql->db_fetch_array($db_data_query) ) 			  {
  			  $db_data['language_id'] = $lang_id;
  			  $wt_sql->db_perform($table, $db_data);   
  			  }
        } 	
	}
	
 
 		function getShowonStruture() {
       	global $wt_module;
       	
       	$mod_id = wt_set_task($_REQUEST, 'mod_id');
       	$plugin_class = wt_module_plugins::singleton($wt_module->get_module_key($mod_id), 'structure');
			$mod_structure = array();
			
	  		if(is_object($plugin_class)) {
				 $structure = $plugin_class->structure;
				 $mod_structure = $plugin_class->mod_structure;
			}	
		
	 		if(!wt_is_valid($mod_structure, 'array') )	{
				 array_unshift($mod_structure, array('key' => 'all',
		    								  					'name' => 'cały moduł'));
			}
				
    
    echo '<script type="text/javascript">' . "\n";
    echo "task = new Array();\n";
    echo "options = new Array();\n";
    
    if( $mod_id == 0 ) {
    	$mod_structure = array();
	   $mod_structure[] = array('key' => 'all',
	    								  'name' => 'cała strona');
    }
    
    if( wt_is_valid($mod_structure, 'array') ) {  
      $i = 0;
      foreach( $mod_structure as $ms ) {
        echo "task[" . $i++ . "] = new Array('" . $ms['key'] . "', '" . $ms['name'] . "');\n";    	
      }
    }
     
    if( wt_is_valid($structure, 'array') ) {  
      $i = 0;
      foreach( $structure as $s ) {
        echo "options[" . $i++ . "] = new Array('" . $s['key'] . "=" . $s['val'] . "', '" . $s['name'] . "', '" . $s['path'] . "');\n";  
      }
    }
    echo "</script>\n"; 	
    die();
	}
  
  function parse_showon_data_for_form($data = '') {	
       	global $wt_module;
       	$parsed = array();
       	
       	if( wt_not_null($data) ) {
       		$s = ";";
       		$_data = explode($s, $data); 
			
       	if( wt_is_valid($_data, 'array') ) {       	
       		$structure = $wt_module->get_sytem_structure();
       		$mod_structure = $wt_module->system_mod_structure;
									 
       	 	foreach( $mod_structure as $mod => $md ) {
       	 		$mod_id = $wt_module->get_module_id($mod);
					if( wt_is_valid($md, 'array') ) {
       	 			foreach( $md as $tasks ) {
       	 				$pk = 'mod=' . $mod_id . '|t=' . $tasks['key'];
       	 				$parsed_tasks[$pk] = $tasks['name'];
       	 			}
					}
       	 	}
       	 	
       	 	foreach( $structure as $mod => $ms ) {
       	 		$mod_id = $wt_module->get_module_id($mod);
					if( wt_is_valid($ms, 'array') ) {
       	 			foreach( $ms as $op ) {
       	 				$ok = 'mod=' . $mod_id . '|op=' . $op['key'] . '=' . $op['val'];
       	 				$parsed_options[$ok] = (wt_not_null($op['path']) ? $op['path'] : $op['name']);
							$ok2 = 'mod=' . $mod_id . '|op=' . $op['key'] . '=' . $op['val'] . '[!!!]';
       	 				$parsed_options[$ok2] = (wt_not_null($op['path']) ? $op['path'] : $op['name']) . ' [!!!]';
       	 			}
					}
       	 	
       	 	}
        
       foreach( $_data as $d  ) {
       	preg_match('/mod=(.*)\|/', $d, $match_mod);
       	$mod_id = $match_mod[1];
       	$parsed[$mod_id]['name'] = $wt_module->get_module_name($mod_id);
       	if( array_key_exists($d, $parsed_tasks) || array_key_exists($d, $parsed_tasks) ) {
       		$parsed[$mod_id]['t'][$d] = $parsed_tasks[$d];
       	} else if( array_key_exists($d, $parsed_options) ) {
       		$parsed[$mod_id]['o'][$d] = $parsed_options[$d];
       	}
       }
  	}
}
       	return $parsed;
       }

  } // class
  
  


?>