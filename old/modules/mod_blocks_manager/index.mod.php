<?php 


		class mod_blocks_manager {
		   var $task;
      	var $action;
      	var $mode;
      	var $module_dir;
      	var $module_class;
      	var $module_key = 'mod_blocks_manager';
      	var $module_gallery_dir = '';
		
		
       function mod_blocks_manager() {
         $this->module_dir = dirname(__FILE__);
  			$this->module_class = get_class($this);
  			$this->module_key = basename($this->module_dir);
  		 } // function
		
		
		function get_module_path() {
   		return dirname(__FILE__);
   	} // function
  
  		
  		function get_module_class() {
   		return $this->module_class;
   	} // function
		
		
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
		 $cache->clear(array('core','blocks'));
		 unset($cache);  
  }
	            
       switch($this->action) {
             case 'setb2mStatus':
             $this->setb2mStatus();
             break;
             case 'saveBlockToModule':
             $this->saveBlockToModule();
             break;
             case 'delColumnPreviewSession':
             $this->delColumnPreviewSession();
             break;     
             case 'delBlockToModule':
             $this->delBlockToModule();
             break;    
             case 'itemInfo':
             $this->itemInfo();
             break;  
             case 'saveBlockOrder':
             $this->saveBlockOrder();
             break;  
             case 'getStruture':
             $this->getStruture();
             break;
             case '_clearModule':
             $this->_clearModule();
         	 break;  
       }
       
     unset($unset_categories_cache);
     
       
    if(!wt_not_null($this->action))  { 
       
  switch ($this->mode) {
  
    default: 
    case 'blocks': 
    	switch($this->task) {
     		default:   
     			$this->block2modules();
     		break;  
     		case 'addBlockToModule':
     		   $this->addBlockToModule();
     		break;
     		case 'columnPreview':
     		   $this->columnPreview();
     		break;  
			case 'deleteBlock':
     			$this->deleteBlock();
     		break;   
     		case 'blockSaved':
     			$this->blockSaved();
     		break; 			
     		
   	}
    break;
    
  }
     }
     
        } // function
       
       function _clearModule() {
       	global $wt_sql;
			
			$bl_data = $this->get_blocks();
         $del_by_id = array();  
				
			 if(wt_is_valid( $bl_data, 'array' )) {
			 
			 	foreach( $bl_data as $bl ) {
				
if( !wt_not_null($bl['block_key']) ) {
$del_by_id[] = $bl['block_id'];
continue;
}
if( !is_dir(CFGF_DIR_FS_BLOCKS . $bl['block_key']) ) {
	 $del_by_id[] = $bl['block_id'];
continue;
}
if( !wt_not_null($bl['block_file']) ) {
$del_by_id[] = $bl['block_id'];
continue;
}
if( !file_exists(CFGF_DIR_FS_BLOCKS . $bl['block_key'] . DIRECTORY_SEPARATOR . $bl['block_file'] . '.php' ) ) {
$del_by_id[] = $bl['block_id'];
continue;
} 
	 
				} // foreach( $bl_data as $bl ) {
			 
			 }	//if(wt_is_valid( $bl_data, 'array' )) {
			 
			 
			 if( wt_is_valid($del_by_id, 'array') ) {
			 
			 	$params = array();
				$params['where'] = "b.block_id IN (" . implode(',', $del_by_id) . ") AND ";
			   $b2m_data = $this->get_blocks_to_modules(null, $params);
				
				if( wt_is_valid( $b2m_data, 'array' ) ) {
					
					foreach( $b2m_data as $b2m ) {
					  $this->delBlockToModule($b2m['btm_id']);
					}
						
				}
				
				foreach( $del_by_id as $bi ) {
					  $wt_sql->db_query("DELETE FROM " . TABLE_BLOCKS . " WHERE block_id = '" . (int)$bi . "' LIMIT 1");
					  $wt_sql->db_query("DELETE FROM " . TABLE_BLOCKS_TO_MODULES . " WHERE btm_block_id = '" . (int)$bi . "'"); 
				}
			 }
			 
			$db_blocks_query = $wt_sql->db_query("SELECT btm_id FROM " . TABLE_BLOCKS_TO_MODULES);
			  		$del_by_id = array();
			  while( $db_blocks = $wt_sql->db_fetch_array($db_blocks_query) ) {
					if( wt_is_valid($db_blocks['btm_id'], 'int', '0') ) {
						$del_by_id[] = $db_blocks['btm_id'];
					}
			  }		 
						 
			 if( wt_is_valid($del_by_id, 'array') ) {
			 	$wt_sql->db_query("DELETE FROM " . TABLE_BLOCKS_DESCRIPTION . " WHERE btm_id NOT IN (" . implode(',', $del_by_id) . ") ");
			 }
			 
			 
       } // function
       
		 function deleteBlock() {
		 	global $wt_template;
			
		 	$wt_template->tFile = 'theme_self';
			
			$wt_template->assign( 'btm_id', $_REQUEST['btmID'] );
			
       	$wt_template->load_file( 'deleteBlock' );
		 }
		 
		 
       function blockSaved() {
       	global $wt_template;
       	$wt_template->tFile = 'theme_self';
       	$wt_template->load_file( 'blockSaved' );
       }
       
	function getStruture() {
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
        echo "options[" . $i++ . "] = new Array('" . $s['key'] . "=" . $s['val'] . "', '" . $s['name'] . "');\n";  
      }
    }
    echo "</script>\n"; 	
    die();
	}
       
       
       
       function parse_structure_for_form($data = '') {
       	global $wt_module;
       	$parsed = array();
       	
       	if( wt_not_null($data) ) {
       		$s = "\n";
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
       	 				$parsed_options[$ok] = $op['name'];
							$ok2 = 'mod=' . $mod_id . '|op=' . $op['key'] . '=' . $op['val'] . '[!!!]';
       	 				$parsed_options[$ok2] = $op['name'] . ' [!!!]';
       	 			}
					}
       	 	}
        
       foreach( $_data as $d  ) {
       	preg_match('/mod=(.*)\|/', $d, $match_mod);
       	$mod_id = $match_mod[1];
       	$parsed[$mod_id]['name'] = $wt_module-> get_module_name($mod_id);
       	if( array_key_exists($d, $parsed_tasks) || array_key_exists($d, $parsed_tasks) ) {
       		$parsed[$mod_id]['t'][$d] = $parsed_tasks[$d];
       	} else if( array_key_exists($d, $parsed_options) ) {
       		$parsed[$mod_id]['o'][$d] = $parsed_options[$d];
       	}
       }
       	}
       }
       
        //	wt_print_array( $parsed );
       	return $parsed;
       }
       
       function saveBlockOrder() {
       	global $wt_sql;
       	
       	
       	foreach( $_POST as $k => $v ) {
       		
       	if( substr($k, 0, 10) == 'wt_column-' && wt_is_valid($v, 'array') ) {
       			$_col = explode('-', $k);
       			$col_id = $_col[1];
       			
       			foreach( $v as $sort => $btm_id ) {
       if( wt_is_valid($btm_id, 'int', '0') ) {			
$sql_data_array = array('sort_order' => $sort,
       						'btm_column' => $col_id);	
	$wt_sql->db_perform(TABLE_BLOCKS_TO_MODULES, $sql_data_array, 'update', "btm_id = '" . $btm_id . "' LIMIT 1");
	}
       			}
       			
       	}
       	       	
       }
       	die('ok');       		
       }
       
       function mod_menu($params = array()) {
       	global $wt_template;
       	
       	$menu_data[] = array('name' => 'usuń',										      'href' => wt_href_link('mod_content_manager', '', 'm=contents&t=deleteContent&cnID=' . $params['cnID'] . '&cPath=' . $params['cPath']),
											'action_form' => true,
											'awt' => 'Usuwanie podstrony',
											'ico' => 'del_content' );
					
			
       	
       	$wt_template->display_self = true;
       	$wt_template->load_file('aaaa');
       }
       
       function itemInfo() {
       	global $wt_template;
       
       $wt_template->display_self = true;
       $wt_template->load_file('aaaa');
       }
       
       function delBlockToModule($data = array()) {
        global $wt_sql;
       	
       	$outside_action = false;
        if(wt_is_valid($btmID, 'int', '0')) {
       	$outside_action = true;
       } else {
         $btmID = wt_set_task($_REQUEST, 'btmID');
       }
       
       if(wt_is_valid($btmID, 'int', '0')) {
       $wt_sql->db_query("DELETE FROM " . TABLE_BLOCKS_TO_MODULES . " WHERE btm_id = '" . (int)$btmID . "' LIMIT 1");
       $wt_sql->db_query("DELETE FROM " . TABLE_BLOCKS_DESCRIPTION . " WHERE btm_id = '" . (int)$btmID . "'");      
       }
       
		 
		 
   if($outside_action) {
  		return true;
  } else {   
 wt_redirect(wt_href_link());
  }
     
       } 
       
       
       function delColumnPreviewSession() {
       	global $wt_session;
       	
       	$wt_session->remove('columnPreview');
       	$wt_session->remove('columnPreviewColID');
       
       wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('a'))));
       }
       
       function columnPreview() {
       	global $wt_template, $wt_sql, $wt_module;
       	
       	$data = $wt_sql->db_prepare_input($_GET);
       	
       	$columnPreview = wt_create_random_value(10);
       	$columnCheck = wt_encrypt_password($columnPreview);
       	
        $array_to_string = array();
         
         $mod = 'home';
         
        if(isset($data['mod_id']) && $data['mod_id'] > 0) {
         $mod_data = array();
         $mod_data = $wt_module->get_module_info($data['mod_id']);
         $mod = $mod_data['mod_key'];
        }
        
       
       	
       	$previewLink_p = 'columnPreview=' . $columnPreview . '&columnCheck=' . $columnCheck;
       	if(isset($data['col_id']) && is_array($data['col_id']) && wt_not_null($data['col_id'])) {
       	
       	$_data = array();
       	$_data['col_id'] = $data['col_id'];
       	
       	$previewLink_p .= '&' . substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], 'col_id'));
       	}
       	
       	$previewLink = wt_href_link($mod, '', $previewLink_p);
       	
      // 	echo $previewLink;
       	
       	$wt_template->assign('previewLink', $previewLink);
       	
       include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'columnPreview.php');
       
       $wt_template->load_file('columnPreview');
       } // function
      
       function saveBlockToModule($data = array() ) {
       	global $wt_sql, $wt_user, $wt_session, $wt_language;
       
       $outside_action = false;
       	
      if(is_array($data) && wt_not_null($data)) {
       $block_array = $data;
       $outside_action = true;
       }	else {
       $block_array = $_POST;
       }
       
       $block_array = $wt_sql->db_prepare_input($block_array);
          
       
       if(isset($block_array['btm_id']) && $block_array['btm_id'] > 0) {
          
          $btmID = $block_array['btm_id'];
          $action = 'save';
          
          if(isset($block_array['action_save']) && $block_array['action_save'] == 'save') {
          $action = 'save';          
          } else if(isset($block_array['action_save']) && $block_array['action_save'] == 'save_as_new') {
          $action = 'add';     
          }
          
       } else {
       $action = 'add';
       }
       
       if( wt_is_valid( $block_array['btm_view'], 'array' ) ) {
       $btm_view = array_unique($block_array['btm_view']);
       
   	 $s = "\n";
       $btm_view = implode($s, $btm_view);
       
       } else {
       $btm_view = '';
       }
		$block_array['btm_view_manual'] = str_replace("\r\n","\n",$block_array['btm_view_manual']);
      
       
      $sql_block_to_module_data_array = array('status' => '1',
      										'access' => wt_parse_access_for_db($block_array['access']),
      										'btm_column' => $block_array['btm_column'],
      										'btm_block_id' => $block_array['block_id'],
      										'btm_view' => $btm_view,
      										'btm_view_manual' => $block_array['btm_view_manual'],
      										'btm_theme' => $block_array['btm_theme'],
      										'params' => wt_parse_params_for_db($block_array['params']),);
      
       if($action == 'add') {
       	$sql_block_to_module_data_array['date_added'] = 'now()';
       	$sql_block_to_module_data_array['added_by'] = $wt_user->usr_info['usr_login'];
       	$sql_block_to_module_data_array['sort_order'] = $block_array['sort_order'];
       	
         $wt_sql->db_perform(TABLE_BLOCKS_TO_MODULES, $sql_block_to_module_data_array);
  	      $btmID = $wt_sql->db_insert_id();
       } //$action == 'add'
       
       if($action == 'save') {
         
                  
         if(isset($block_array['sort_order']) && wt_not_null($block_array['sort_order'])) {
         	$sql_block_to_module_data_array['sort_order'] = $block_array['sort_order'];
         }
         
       	$sql_block_to_module_data_array['last_modified'] = 'now()';
  			$sql_block_to_module_data_array['modified_by'] = $wt_user->usr_info['usr_login'];
  			$sql_block_to_module_data_array['version'] = 'version+1';
  	
  	$wt_sql->db_perform(TABLE_BLOCKS_TO_MODULES, $sql_block_to_module_data_array, 'update', 'btm_id = ' . $btmID);
       } //$action == 'save'
       
       unset($sql_block_to_module_data_array);
       
       $sql_block_desc_data_array = array();
       $sql_block_desc_data_array = array(
	 									  'bd_title' => $block_array['bd_title'],
										  ); 			
										  
			if($action == 'add') {
  	       $sql_block_desc_data_array['btm_id'] = $btmID;
			 global $wt_language;
			 $wt_language->update_language_table($sql_block_desc_data_array, TABLE_BLOCKS_DESCRIPTION);
  	        }	//$action == 'add'
  	
  	if($action == 'save') {
  	  	$wt_sql->db_perform(TABLE_BLOCKS_DESCRIPTION, $sql_block_desc_data_array, 'update', "btm_id = '" . $btmID . "' AND language_id = '" .$block_array['language_id']. "' LIMIT 1");
  	}	
       unset($sql_block_desc_data_array);
       
     $wt_language->update_item_languages_status($btmID,'btm_id',TABLE_BLOCKS_DESCRIPTION,$wt_sql,$block_array['languages_status']);
		  
     $params = array();
     $params['tbl_key'] = 'btm_id';
     $params['tbl'] = TABLE_BLOCKS_TO_MODULES;
     $params['where'] = 'btm_column = ' . $block_array['btm_column'];
     wt_fix_sort_order($params);
       
       
  if($outside_action) {
  		return $btmID;
  } else {   
       switch($block_array['action_after']) {
       	
       	default:
       	case 'main':
       		 	wt_redirect(wt_href_link('mod_blocks_manager', '', ''));
       			break;
       	case 'add_new':
       			wt_redirect(wt_href_link('mod_blocks_manager', '', 'm=blocks&t=addBlockToModule'));
       			break;
       	case 'edit':
       			wt_redirect(wt_href_link('mod_blocks_manager', '', 'm=blocks&t=addBlockToModule&btmID=' . $btmID));
       			break;
       }
  }     
       
       } // function
      
        
       function addBlockToModule() {
       	global $wt_template, $wt_language,$wt_session;
    
    $btmID = wt_set_task($_REQUEST, 'btmID');
    $block_id = wt_set_task($_REQUEST, 'block_id');
   // $wt_template->display_self = true;
    $wt_template->tFile = 'theme_self';
    
    if( wt_is_valid($btmID, 'int', '0') || wt_is_valid($block_id, 'int', '0') ) {
    	include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addBlockToModule_2.php');
    	$wt_template->load_file('addBlockToModule_2');
    } else {
    	include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addBlockToModule_1.php');
    	$wt_template->load_file('addBlockToModule_1');
    }
       	
       } // function 
       
       
       function detect_installed_blocks($params = array() ) {
       
       if(isset($params['group']) && wt_not_null($params['group']))	{
       $inc_block_dir = CFGF_DIR_FS_BLOCKS . $params['group'] . '/';
       }	 else {
       $inc_block_dir = CFGF_DIR_FS_BLOCKS;
       }
        
        $block_dir = dir($inc_block_dir);
        
        $block_group = array();

      while ($block_groups = $block_dir->read()) {
     
     		if(is_dir($inc_block_dir . $block_groups) && $block_groups != '.' && $block_groups != '..' && substr($block_groups, 0, 6) == 'block_' ) {
     			
     		 
     			if(file_exists($inc_block_dir . $block_groups . '/gr_info.inf.php')) {
     			include($inc_block_dir . $block_groups . '/gr_info.inf.php');
     			
     			$gr_info = $group_info;
     			
     			} else {
     			
     			$gr_key = $block_groups;
     			$gr_name = substr($gr_key, 6, strlen($gr_key));
     			
     			$gr_info['gr_name'] = $gr_name;
     			$gr_info['gr_key'] = $gr_key;
     			$gr_info['gr_desc'] = '';
     			
     			} // if(file_exists
     			
     			
     			$Gparams = array();
     			$Gparams['group'] = $block_groups;
     			
     			
       if(is_array($gr_info) && wt_not_null($gr_info)) {	    			
     			$block_group[$block_groups] = $gr_info;
     		   $block_group[$block_groups]['files'] = $this->detect_installed_blocks($Gparams);
     		 }
     		
     		   
     		} else if(is_file($inc_block_dir . $block_groups) && $block_groups != '.' && $block_groups != '..' && substr($block_groups, 0, 6) == 'block_' && substr($block_groups, -4) == '.php') {
        
       
        
        		if(file_exists($inc_block_dir . '/' . basename(substr($block_groups, 6, strlen($block_groups)), '.php') . '.inf.php')) {
        	   include($inc_block_dir . '/' . basename(substr($block_groups, 6, strlen($block_groups)), '.php') . '.inf.php');
     			
     			$file_info = $file_info_file;
     			
     			} else {
     			
     			$file = basename($block_groups, '.php');
     			$file_key = $file;
     			$file_name = substr($file_key, 6, strlen($file));
     			
     			$file_info['block_key'] = $params['group'];
     			$file_info['block_file'] = basename($block_groups, '.php');
     			$file_info['block_name'] = $file_name;
     			$file_info['block_desc'] = '';
     			$file_info['block_depends'] = '';
     			$file_info['use_cache'] = '0';
     			$file_info['cache_depends_on_request'] = '0';
     			}
     		
     		$file_info_file = array();
     		
     		if(!$this->is_installed($file_info['block_key'], $file_info['block_file']) )	{
     		  		
     		  $this->install_new_block($file_info);
     		
     		}
     		
     		
     		
     		  $block_data = array();
     		  
     		  $Bparams = array();
     		  $Bparams['where'] = " block_key = '" . $file_info['block_key'] . "' AND block_file = '" . $file_info['block_file'] . "' ";
     		  
     		  $block_data = $this->get_blocks(null, $Bparams);
     		
     		  if(is_array($block_data[0]) && wt_not_null($block_data[0]) ) {
     		  
     		  $file_info['block_name'] = $block_data[0]['block_name'];
     		  $file_info['block_id'] = $block_data[0]['block_id'];
     		  $file_info['block_system'] = $block_data[0]['block_system'];
     		  
     		  }
     		
     		     	  	
     	  	if(is_array($file_info) && wt_not_null($file_info)) {	    			
     			$block_group[$file_info['block_file']] = $file_info;
     	  }	   
     	  
     	  }
        
      }
      
      $block_dir->close();

     return $block_group;
       
       } // function 
       
       
       function install_new_block($params = array() ) {
       		global $wt_sql;
       		
       		if(isset($params['block_depends']) && is_array($params['block_depends']) && wt_not_null($params['block_depends'])) {
       		$params['block_depends_ar'] = implode(',', $params['block_depends']);
       		} else {
       		$params['block_depends_ar'] = '';
       		}
       		
       		$params = $wt_sql->db_prepare_input($params);
       		
       		$sql_data_array = array();
       		$sql_data_array = array('block_name' => $params['block_name'],
       									   'block_system' => $params['block_system'],
       									   'block_key' => $params['block_key'],
       									   'block_file' => $params['block_file'],
       									   'block_depends' => $params['block_depends_ar'],
       									   'use_cache' => $params['use_cache'],
       									   );
       
       
       									   
       $wt_sql->db_perform(TABLE_BLOCKS, $sql_data_array);
       
       
       }
       
       function is_installed($block_key, $block_file) {
       
           $Bparams = array();
     		  $Bparams['where'] = " block_key = '" . $block_key . "' AND block_file = '" . $block_file . "' ";
     		  
     		  $block_data = $this->get_blocks(null, $Bparams);
     		  
     		  if(is_array($block_data) && wt_not_null($block_data)) {
     		  return true;
     		  }
     		  
     		  return false;
       
       }
       
       function get_blocks($block_id = null, $params = array()) {
       	
       	global $wt_sql, $wt_session, $wt_template;
        
        $blocks_array = array();
        
    
        
     if(wt_not_null($block_id)) {
     
     $db_blocks_query_raw = "SELECT * FROM " . TABLE_BLOCKS . " WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " block_id = '" . $block_id . "' LIMIT 1";
     } else {
     $db_blocks_query_raw = "SELECT * FROM " . TABLE_BLOCKS . " " . ((isset($params['where']) && wt_not_null($params['where'])) ? ' WHERE ' . $params['where'] : '') . " ";
     
     }
     
     $db_blocks_query = $wt_sql->db_query($db_blocks_query_raw);
     
     while($db_blocks = $wt_sql->db_fetch_array($db_blocks_query)) {
     		
     		$db_blocks['block_depends_ar'] = explode(',', $db_blocks['block_depends']);
     		
      if(wt_not_null($block_id)) {
      $blocks_array = $db_blocks;
      } else {
      $blocks_array[] = $db_blocks;
      }

     }
    
    
    return $wt_sql->db_output_data($blocks_array);
       
       
       } //function
		
		 function setb2mStatus($data = array()) {
         global $wt_sql, $wt_user;
         
         
         $params = array();
         $params['status'] = ($data['status']) ? (int)$data['status'] : (int)$_GET['status'];
         $params['table'] = TABLE_BLOCKS_TO_MODULES;
         $params['tbl_key'] = 'btm_id';
         $params['tbl_val'] = ($data['btmID']) ? (int)$data['btmID'] : (int)$_GET['btmID'];
         
             wt_change_status_full($params);   
              
        if(!$data) {
        	wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('a', 't', 'm')) . 'm=blocks'));	
        	}
        }
		
		function block2modules() {
			global $wt_template;
			
		 	$wt_template->tFile = 'theme_self';
			
		 $params = array();
		 $params['where'] = '';	
		 if(isset($_GET['mod_id']) && (int)$_GET['mod_id'] > 0)	{
		 
		 $params['where'] .= " (b2m.btm_module_id = '" . (int)$_GET['mod_id'] . "' OR b2m.btm_module_id = '0') AND ";

		 }
		 
		 if(isset($_GET['col_id']) && (int)$_GET['col_id'] > 0)	{
		 
		 $params['where'] .= " b2m.btm_column = '" . (int)$_GET['col_id'] . "' AND ";

		 }
		
		 $blocks_listing = $this->get_blocks_to_modules(null, $params);
	  
	    $wt_template->assign('block', $this->get_blocks_to_modules($this->get_selected_b2m_id($blocks_listing)));
     
     
    //  wt_print_array($blocks_listing);
     
     
     $wt_template->assign('all_blocks_count', count($blocks_listing));
     $wt_template->assign('blocks_listing', $blocks_listing);
		
		
		
	  include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'b2m_view.php');	
		
	  $wt_template->load_file('block2modules.tpl');	
		}
		
		function get_blocks_to_modules($btm_id = '', $params = array()) {
	  		global $wt_sql, $wt_session, $wt_template,$wt_language;
        
        $blocks_array = array();
        
    
        
     if(wt_not_null($btm_id)) {
     
     $db_blocks_query_raw = "SELECT * FROM " . TABLE_BLOCKS_TO_MODULES . " b2m, " . TABLE_BLOCKS_DESCRIPTION . " bd, " . TABLE_BLOCKS . " b WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " b2m.btm_id = '" . $btm_id . "' AND b2m.btm_id = bd.btm_id AND b.block_id = b2m.btm_block_id AND bd.language_id = '" . $wt_session->value('languages_id') . "' LIMIT 1";

     } else {
     
     $db_blocks_query_raw = "SELECT * FROM " . TABLE_BLOCKS_TO_MODULES . " b2m, " . TABLE_BLOCKS_DESCRIPTION . " bd, " . TABLE_BLOCKS . " b WHERE " . ( (isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " b2m.btm_id = bd.btm_id AND b.block_id = b2m.btm_block_id AND (b2m.btm_column < 100 OR b2m.btm_column > 200) AND bd.language_id = '" . $wt_session->value('languages_id') . "'  ORDER BY b2m.btm_column, b2m.sort_order";
     
     }
     
     $db_blocks_query = $wt_sql->db_query($db_blocks_query_raw);
     
     while($db_blocks = $wt_sql->db_fetch_array($db_blocks_query)) {
     
     
     $db_blocks['status_text'] = wt_return_item_status($db_blocks['status']);
     $db_blocks['date_up'] = wt_parse_publish_date_desc($db_blocks['date_up'], 'up');
     $db_blocks['date_down'] = wt_parse_publish_date_desc($db_blocks['date_down'], 'down');
     
     $db_blocks['show_on_modules'] = $this->get_modules_for_blocks('btm_module_id');
     
     $db_blocks['languages_status'] = $wt_language->get_item_languages_status($db_blocks['btm_id'],'btm_id',TABLE_BLOCKS_DESCRIPTION,$wt_sql);
     
     
      if(wt_not_null($btm_id)) {
      $db_blocks['access_desc'] = wt_get_access_desc($db_blocks['access']);
      $blocks_array = $db_blocks;
      } else {
      $blocks_array[] = $db_blocks;
      }

     }
    
    
    return $wt_sql->db_output_data($blocks_array);
    
		} // function
		
  function get_selected_b2m_id($blocks_array) {
    
    if(isset($_GET['btmID']) && wt_not_null($_GET['btmID'])) {
     return $_GET['btmID'];
    } else {
     return $blocks_array['0']['btm_id'];
    }
    
   }	  // function	
	
  function get_modules_for_blocks($modules_id = '', $params = array() ) {
  
  
  }
  
  
  function get_columns_for_form($params = array()) {
  		global $wt_sql;
  		
  		$Tparams = array();
  		$columns_array = array();
  		
  		
  		if($params['add_blank']) {
  		
  		if(!isset($params['blank_value'])) {
  		$params['blank_value'] = '';
  		}
  		
  		if(!isset($params['blank_text'])) {
  		$params['blank_text'] = '=== WSZYSTKIE ===';
  		}
  		
  		$columns_array[$params['blank_value']] = $params['blank_text'];
  
  		}
  		
  		
  		if(isset($params['tem_key']) && wt_not_null($params['tem_key'])) {
  		$Tparams['where'] = " tem_key = '" . $params['tem_key'] . "' ";
  		} 
  		
  		$mod_templates_manager = wt_module::singleton('mod_templates_manager');
  		
  		$themes_data = $mod_templates_manager->get_themes($params['tem_id'], $Tparams);
  		
  		if(is_array($themes_data) && wt_not_null($themes_data)) {
  		
  		foreach ($themes_data as $theme) {
  		
  		if(wt_not_null($theme['tem_columns'])) {
  		$columns = unserialize($theme['tem_columns']);
  		}
  		
  		if(is_array($columns) && wt_not_null($columns)) {
  		
  			foreach($columns as $column) {
  				$columns_array[$column] = $column;
  			}
  		
  		}
  		
  		}
  		
  		}
  		
  		return $columns_array;

  }	
  
  
  function get_theme_files_for_blocks($block_key, $block_file) {
  		
  		$files_for_blocks = array();
  		
  		
  		if($block_key == 'block_db_content') {
  		$block_file = 'block_';
  		}
  		
  		$mod_templates_manager = wt_module::singleton('mod_templates_manager');
       
       $Tparams = array();
       $Tparams['where'] = " tem_key != 'admin' ";
       $themes_array = array();
       $themes_array = $mod_templates_manager->get_themes(null, $Tparams);
       
       
       if(is_array($themes_array) && wt_not_null($themes_array)) {
       		
       		foreach($themes_array as $theme) {
       		
       		$block_theme_dir = CFGF_DIR_FS_TEMPLATES . $theme['tem_key'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'blocks' . DIRECTORY_SEPARATOR . $block_key;
       		
       	
       		
       				if( is_dir($block_theme_dir)  ) {
       				
       				$block_dir = dir($block_theme_dir);
        
        				

      			while ($theme_file = $block_dir->read()) {
      
      			$block_file = basename($block_file, '.php');
      
          if($theme_file != '..' && $theme_file != '.' && substr($theme_file, -4) == '.tpl' && strpos($theme_file, $block_file) !== false && substr($theme_file, -9) != '_form.tpl' ) {
          		
          		$theme_file = basename($theme_file, '.tpl');
          		
          		if(isset($files_for_blocks[$theme_file])) {
          		$files_for_blocks[$theme_file] .= ' [' . $theme['tem_name'] . '] ';
          		} else {
          		
          		$files_for_blocks[$theme_file] = $theme_file . ' [' . $theme['tem_name'] . ']';
          		}
          		
          
                    
          }
      			
      
      
      } //  while
       				
       				
       				} // if( is_dir
       			
       		
       		
       		} // foreach($themes_array
       
       } // if(is_array($themes_array)
  
  
  
  return $files_for_blocks;
  
  } // function
  
  
		
		} // class
?>