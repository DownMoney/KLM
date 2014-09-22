<?php 


		class mod_menu_manager {
		   var $task;
      	var $action;
      	var $mode;
      	var $module_dir;
      	var $module_class;
      	var $module_key = 'mod_menu_manager';
      	var $module_gallery_dir = '';
		   var $links_type = array( 'mod_link' => 'link do modułu',
		   								 'header' => 'nagłówek',
		   								 'separator' => 'separator',
		   								 'outside_link' => 'link zewnętrzny',
											 'javascript' => 'JavaScript');
		
       function mod_menu_manager() {
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
        global $wt_template;
  $this->task = wt_set_task($_REQUEST, 't');
  $this->action = wt_set_task($_REQUEST, 'a');
  $this->mode = wt_set_task($_REQUEST, 'm');
 
  
     
 if(wt_not_null($this->action)) {
 $unset_cache = new wt_cache();
 $unset_cache->clear(array('menu'));
 unset($unset_cache);
 }       
              
 
					
       switch($this->action) {
       		 case 'saveMenu':
     		    $this->saveMenu();
     		    break;
     		     case 'delMenu':
     		    $this->delMenu();
     		    break;
       		 case 'saveLink':
     		    $this->saveLink();
     		    break;
     		    case 'delLink':
     		    $this->delLink();
     		    break;
             case 'downLinkOrder':
     		    $this->linkOrder(+1);
     		    break;
     		    case 'upLinkOrder':
     		    $this->linkOrder(-1);
     		    break;
     		    case 'setLinkStatus':
     		    $this->setLinkStatus();
     		    break;
				 case 'getStruture':
				 $this->getStruture();
				 break;
       }
       
     
     
       
    if(!wt_not_null($this->action))  { 
       $wt_template->tFile = 'theme_self';
  switch ($this->mode) {
  
    default: 
    case 'menus': 
    	switch($this->task) {
     		default:   
     			$this->menus();
     		break;
     		case 'addMenu':   
     			$this->addMenu();
     		break;   
     		case 'deleteMenu':
     			$this->deleteMenu();
     			$this->menus();
     		break;   			
   	}
    break;
    case 'links': 
    	switch($this->task) {
     		default:   
     			$this->links();
     		break; 
     		case 'addLink':   
     			$this->addLink();
     		break;     	
     		case 'deleteLink':
     			$this->deleteLink();
     		break;		
   	}
    break;
    
  }
     }
     
        } // function
      
      
	function getStruture() {
       	global $wt_module;
       	
      // 	wt_print_array( $_REQUEST );
       	$mod_id = wt_set_task($_REQUEST, 'mod_id');
       	
			
			
       	$plugin_class = wt_module_plugins::singleton($mod_id, 'structure');
		
	  if( is_object($plugin_class)) {
			$structure = $plugin_class->structure;
		  	$mod_structure = $plugin_class->mod_structure;
		}	
		
	
    echo '<script type="text/javascript">' . "\n";
    echo "options = new Array();\n";
    echo "options[0] = new Array('', 'strona główna modułu');\n"; 
     if( wt_is_valid($structure, 'array') ) {  
      $i = 1;
      foreach( $structure as $s ) {
      
        echo "options[" . $i++ . "] = new Array('" . $s['url'] . "', '" . $s['name'] . "');\n";  
          	
      }
      	
     }
     
     
       echo "</script>\n"; 	
       	die();
       }
		
		
      function delLink($data = array()) {
      	global $wt_sql;
      	$outside_action = false;
      	
       if( wt_is_valid($data, 'array') )	{
       	$link_id = $data['link_id'];
         $mID = $data['mID'];
         $outside_action = true;
       } else {
      	$link_id = wt_set_task($_REQUEST, 'link_id');
      	$lID = wt_set_task($_REQUEST, 'lID');
         $mID = wt_set_task($_REQUEST, 'mID');
			$link_id[] = $lID;
       }
         
         if( wt_is_valid($link_id, 'array') && wt_is_valid($mID, 'int', '0')) {
       
       if( wt_is_valid($lID, 'int', '0') )  {
         $link_data = $this->get_links($lID);
       }
         
			
			
         foreach( $link_id as $id) {
         
         	if(wt_is_valid($id, 'int', '0')) {
         		$wt_sql->db_query("DELETE FROM " . TABLE_MENU_LINKS . " WHERE link_id = '" . (int)$id . "' LIMIT 1");
         		$wt_sql->db_query("DELETE FROM " . TABLE_MENU_LINKS_DESCRIPTION . " WHERE link_id = '" . (int)$id . "'");
         	}
         
         }		
         
 if( wt_is_valid($link_data, 'array') ) {        
     $params = array();
     $params['tbl_key'] = 'link_id';
     $params['tbl'] = TABLE_MENU_LINKS;
     $params['where'] = "menu_id = '" . $mID . "' AND link_parent_id = '" . $link_data['link_parent_id'] . "'";
     wt_fix_sort_order($params);
   }      
         
         	$wt_sql->db_query("OPTIMIZE TABLE " . TABLE_MENU_LINKS . " , " . TABLE_MENU_LINKS_DESCRIPTION . " ");
         }
   
   if($outside_action === false) {   
      wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'lID', 't', 'a') ) . 'm=links'));
   }   
      }  
      
      function deleteLink() {
      global $wt_template, $wt_sql;
  $wt_template->tFile = 'theme_self';
  $links_array = array();
  $links_to_delete = array();
  $lID = wt_set_task($_REQUEST, 'lID'); 
  $mID = wt_set_task($_REQUEST, 'mID');
      
     if( wt_is_valid($lID, 'int', '0') && wt_is_valid($mID, 'int', '0') )   {
     
  $links_array = $this->get_links_tree($lID, $mID, '', array(), false);   
  $links_to_delete[] = $lID;   
  
 if( wt_is_valid($links_array, 'array') ) {
  foreach($links_array as $link) { 
  $links_to_delete[] = $link['link_id'];
  } //foreach($links_array
  } //if( wt_is_valid($links_array
  } //  if( wt_is_valid($lID,
  
  $links_to_delete = array_unique($links_to_delete);
  
     include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'deleteLink.php'); 
    }    
    
    function deleteMenu() {
      global $wt_template, $wt_sql;
  
  $mID = wt_set_task($_REQUEST, 'mID');
      
     if( wt_is_valid($mID, 'int', '0') )   {
  			 $wt_template->assign('count_links', $this->count_links_to_menu($mID));
    }   
    }
    
    function delMenu($data = array()) {
      global $wt_template, $wt_sql;
  
	
  $links_array = array();
  $links_to_delete = array();
  $outside_action = false;
  
  if( wt_is_valid($data, 'array') ) {
  $mID = $data['mID'];
  $outside_action = true;
  } else {
  $mID = wt_set_task($_REQUEST, 'mID');
  }
  
  
      
 if( wt_is_valid($mID, 'int', '0') )   {
     
    $lParams = array();
    $lParams['where'] = " ml.menu_id = '" . $mID . "' AND ";
    $links_array = $this->get_links(null, $lParams);
     
 if( wt_is_valid($links_array, 'array') ) {
  foreach($links_array as $link) { 
  $links_to_delete[] = $link['link_id'];
  } //foreach($links_array
  } //if( wt_is_valid($links_array} 
  
  if( wt_is_valid($links_to_delete, 'array') ) {
  $dParams = array();
  $dParams['link_id'] = $links_to_delete;
  $dParams['mID'] = $mID;
  $this->delLink($dParams);
  }
  
$wt_sql->db_query("DELETE FROM " . TABLE_MENU . " WHERE menu_id = '" . (int)$mID . "' LIMIT 1");

$wt_sql->db_query("DELETE FROM " . TABLE_MENU_DESCRIPTION . " WHERE menu_id = '" . (int)$mID . "'");

$wt_sql->db_query("OPTIMIZE TABLE " . TABLE_MENU . " , " . TABLE_MENU_DESCRIPTION . " ");
  
}  

if($outside_action === true) {   
      return true;
   }  
   
   wt_redirect(wt_href_link('', '', 'm=menus'));
   
    }   
 
 
       function saveMenu($data = array() ) {
     global $wt_sql, $wt_session, $wt_user;
     
     $outside_action = false;
     
     if(wt_is_valid($data, 'array')) {
     $data_array = $data;
     $outside_action = true;
     } else {
     $data_array = $_POST;
     }
          
     $data_array = $wt_sql->db_prepare_input($data_array);     
          
     if( wt_is_valid($data_array['mID'], 'int', '0') ) {
          
          $mID = $data_array['mID'];
          $action = 'save';
          
          if(isset($data_array['action_save']) && $data_array['action_save'] == 'save') {
          $action = 'save';          
          } else if(isset($data_array['action_save']) && $data_array['action_save'] == 'save_as_new') {
          $action = 'add';     
          }
          
       } else {
       $action = 'add';
       }
     
     
     
$sql_data_array = array('access' => wt_parse_access_for_db($data_array['access']));
										  
	  if($action == 'add') {
   $sql_data_array['date_added'] = 'now()';
  	$sql_data_array['added_by'] = $wt_user->usr_info['usr_login'];
  	$sql_data_array['version'] = '1';
  	
  	$wt_sql->db_perform(TABLE_MENU, $sql_data_array);
  	$mID = $wt_sql->db_insert_id();
	  
	  }	
	  
	  if($action == 'save') {	
	  
   $sql_data_array['last_modified'] = 'now()';
  	$sql_data_array['modified_by'] = $wt_user->usr_info['usr_login'];
  	$sql_data_array['version'] = 'version+1';
    	
  	$wt_sql->db_perform(TABLE_MENU, $sql_data_array, 'update', "menu_id = '" . (int)$mID . "'");
	  
	  }		
	  
	 $sql_desc_data_array = array('menu_name' => $data_array['menu_name'],
	 									   'menu_title' => $data_array['menu_title'],
	 									   'menu_desc' => $data_array['menu_desc'],
								         ); 			
										  
if($action == 'add') {
  	$sql_desc_data_array['menu_id'] = $mID;
  	$sql_desc_data_array['language_id'] = $wt_session->value('languages_id');
  	$wt_sql->db_perform(TABLE_MENU_DESCRIPTION, $sql_desc_data_array);
  	}	
  	
  	if($action == 'save') {
  	$wt_sql->db_perform(TABLE_MENU_DESCRIPTION, $sql_desc_data_array, 'update', "menu_id = '" . (int)$mID . "' AND  language_id = '" . (int)$wt_session->value('languages_id') . "'");
  	}	
  	 
 if( $outside_action === true ) {
  return $mID;
 } else {
  switch($data_array['action_after']) {
       	
       	default:
       	case 'main':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'mID', 't') ) . 'm=menus&mID=' . $mID));
       			break;
       	case 'add_new':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'mID', 't') ) . 'm=menus&t=addMenu'));
       			break;
       	case 'edit':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'mID', 't') ) . 'm=menus&t=addMenu&mID=' . $mID));
       			break;
       }
 }
   
    
    }
         
        
      function saveLink($data = array() ) {
     global $wt_sql, $wt_session, $wt_user;
     
     $outside_action = false;
     
     if(wt_is_valid($data, 'array')) {
     $data_array = $data;
     $outside_action = true;
     } else {
     $data_array = $_POST;
     }
          
     $data_array = $wt_sql->db_prepare_input($data_array);     
          
     if( wt_is_valid($data_array['lID'], 'int', '0') ) {
          
          $lID = $data_array['lID'];
          $action = 'save';
          
          if(isset($data_array['action_save']) && $data_array['action_save'] == 'save') {
          $action = 'save';          
          } else if(isset($data_array['action_save']) && $data_array['action_save'] == 'save_as_new') {
          $action = 'add';     
          }
          
       } else {
       $action = 'add';
       }
     
     
     
$sql_data_array = array('menu_id' => $data_array['menu_id'],
								'link_parent_id' => $data_array['link_parent_id'],
								'link_type' => $data_array['link_type'],
								'link_link' => $data_array['link_link'],
								'link_module' => $data_array['link_module'],
							   'status' => $data_array['status'],
								'link_key_words' => $data_array['link_key_words'],
								'link_index_file' => $data_array['link_index_file'],
								'css_id' => $data_array['css_id'],
								'date_up' => $data_array['date_up'],
								'date_down' => $data_array['date_down'],
								'access' => wt_parse_access_for_db($data_array['access']));
										  
	  if($action == 'add') {
   $sql_data_array['date_added'] = 'now()';
  	$sql_data_array['added_by'] = $wt_user->usr_info['usr_login'];
  	$sql_data_array['version'] = '1';
  	$sql_data_array['sort_order'] = $data_array['sort_order'];
  	
  	$wt_sql->db_perform(TABLE_MENU_LINKS, $sql_data_array);
  	$lID = $wt_sql->db_insert_id();
	  
	  }	
		
		
		$upload_dir = 'mod_menu' . DIRECTORY_SEPARATOR . $data_array['menu_id'] . DIRECTORY_SEPARATOR;	
		
	  if(!is_dir(CFGF_DIR_FS_MEDIA . $upload_dir)) {	
   wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
  	$create_file = @fopen(CFGF_DIR_FS_MEDIA . $upload_dir . DIRECTORY_SEPARATOR . 'index.html', 'w');
  	@fclose($create_file);  	
}	
   
	$sql_images_data_array = array();
	
	if( wt_is_valid($data_array['delete_link_image'], 'int', '0') && wt_not_null($data_array['previus_link_image'])) {
  	$sql_images_data_array['link_image'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_image']);
  	}
	
	if( wt_is_valid($data_array['delete_link_image_over'], 'int', '0') && wt_not_null($data_array['previus_link_image_over'])) {
  	$sql_images_data_array['link_image_over'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_image_over']);
  	}
	
	if( wt_is_valid($data_array['delete_link_icon_left'], 'int', '0') && wt_not_null($data_array['previus_link_icon_left'])) {
  	$sql_images_data_array['link_icon_left'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_icon_left']);
  	}
	
	if( wt_is_valid($data_array['delete_link_icon_right'], 'int', '0') && wt_not_null($data_array['previus_link_icon_right'])) {
  	$sql_images_data_array['link_icon_right'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_icon_right']);
  	}
	
	if( wt_is_valid($data_array['delete_link_bg'], 'int', '0') && wt_not_null($data_array['previus_link_bg'])) {
  	$sql_images_data_array['link_bg'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_bg']);
  	}
	
		if( wt_is_valid($data_array['delete_link_bgover'], 'int', '0') && wt_not_null($data_array['previus_link_bgover'])) {
  	$sql_images_data_array['link_bgover'] = '';
  	@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_link_bgover']);
  	}
	
  		if( wt_is_valid($sql_images_data_array, 'array') ) {
	$wt_sql->db_perform(TABLE_MENU_LINKS, $sql_images_data_array, 'update', "link_id = '" . (int)$lID . "' LIMIT 1");
	}	
	
	
	$sql_images_data_array = array();
	  
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file_name'] = $lID . 'link_image';
  	$images_params['file'] = 'link_image';
  	
  	if( $link_image_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_image'] = $link_image_name;
  	}	
	
	
	
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file'] = 'link_image_over';
  	$images_params['file_name'] = $lID . '_link_image_over';
  	
  	if( $link_image_over_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_image_over'] = $link_image_over_name;
  	}	
	
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file'] = 'link_icon_left';
  	$images_params['file_name'] = $lID . '_link_icon_left';
  	
  	if( $link_icon_left_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_icon_left'] = $link_icon_left_name;
  	}	
	
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file'] = 'link_icon_right';
  	$images_params['file_name'] = $lID . '_link_icon_right';
  	
  	if( $link_icon_right_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_icon_right'] = $link_icon_right_name;
  	}	
	
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file'] = 'link_bg';
  	$images_params['file_name'] = $lID . '_link_bg';
  	
  	if( $link_bg_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_bg'] = $link_bg_name;
  	}	
	
	$images_params = array();
  	$images_params['dir'] = $upload_dir;
  	$images_params['file'] = 'link_bgover';
  	$images_params['file_name'] = $lID . '_link_bgover';
  	
  	if( $link_bgover_name = move_uploaded_media_file($images_params) ) {
  	  	$sql_images_data_array['link_bgover'] = $link_bgover_name;
  	}	
	
	
	if( wt_is_valid($sql_images_data_array, 'array') ) {
	$wt_sql->db_perform(TABLE_MENU_LINKS, $sql_images_data_array, 'update', "link_id = '" . (int)$lID . "' LIMIT 1");
	}	
		
	  
	  if($action == 'save') {	
	  
   $sql_data_array['last_modified'] = 'now()';
  	$sql_data_array['modified_by'] = $wt_user->usr_info['usr_login'];
  	$sql_data_array['version'] = 'version+1';
  	if( wt_not_null($data_array['sort_order']) ) {
  	$sql_data_array['sort_order'] = $data_array['sort_order'];
  	}
  	
  	$wt_sql->db_perform(TABLE_MENU_LINKS, $sql_data_array, 'update', "link_id = '" . (int)$lID . "'");
	  
	  }		
	  
	 $sql_desc_data_array = array('link_name' => $data_array['link_name'],
	 									   'link_title' => $data_array['link_title'],
								         ); 			
										  
if($action == 'add') {
  	$sql_desc_data_array['link_id'] = $lID;
  	$sql_desc_data_array['language_id'] = $wt_session->value('languages_id');
  	$wt_sql->db_perform(TABLE_MENU_LINKS_DESCRIPTION, $sql_desc_data_array);
  	}	
  	
  	if($action == 'save') {
  	$wt_sql->db_perform(TABLE_MENU_LINKS_DESCRIPTION, $sql_desc_data_array, 'update', "link_id = '" . (int)$lID . "' AND  language_id = '" . (int)$wt_session->value('languages_id') . "'");
  	}	
  	
  	
  	  $params = array();
     $params['tbl_key'] = 'link_id';
     $params['tbl'] = TABLE_MENU_LINKS;
     $params['where'] = "menu_id = '" . $data_array['menu_id'] . "' AND link_parent_id = '" . $data_array['link_parent_id'] . "'";
     wt_fix_sort_order($params);
    
 
 if( $outside_action === true ) {
  return $lID;
 } else {
  switch($data_array['action_after']) {
       	
       	default:
       	case 'main':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'lID', 't') ) . 'm=links&lID=' . $lID));
       			break;
       	case 'add_new':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'lID', 't') ) . 'm=links&t=addLink'));
       			break;
       	case 'edit':
       			wt_redirect(wt_href_link('', '', wt_get_all_get_params( array('m', 'lID', 't') ) . 'm=links&t=addLink&lID=' . $lID));
       			break;
       }
 }
   
    
    }
      
      function addLink() {
     global $wt_template;
    
    include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addLink.php');
    
    }
    
    function addMenu() {
     global $wt_template;
    
    include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addMenu.php');
    
    }
      
      function linkOrder($dirn) {
        
        unset($params);
        $params['tbl_key'] = 'link_id';
        $params['tbl'] = TABLE_MENU_LINKS;
        $params['tbl_val'] = (int)$_GET['lID'];
        $params['sort'] = (int)$_GET['sort'];
        $params['where'] = " menu_id = '" . (int)$_GET['mID'] . "' AND link_parent_id = '" . (int)$_GET['parent_id'] . "'  ";
        
        wt_set_sort_order($dirn, $params);
        
        wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('a', 't', 'm', 'sort')) . 'm=links'));	
        }
        
      function links() {
      global $wt_template;
      
    $mID = wt_set_task($_REQUEST, 'mID');
    
    if( wt_is_valid($mID, 'int', '0') ) {  
       $wt_template->assign('links_listing', $links_listing = $this->get_links_tree(0, $mID) );
       $wt_template->assign('count_links', count($links_listing) );
       $wt_template->load_file('links.tpl');
    }
    }  
        
      function menus() {
      global $wt_template;
      
       $mParams = array();
       $mParams['count_links'] = true;
       $wt_template->assign('menu_listing', $menu_listing = $this->get_menus(null, $mParams) );
       
       $wt_template->assign('menu', $menu = $this->get_menus($this->get_selected_menu_id($menu_listing)) );
       $wt_template->load_file('menus.tpl');
    }
      
      
      
       function get_menus($menu_id = null, $params = array()) {
       	global $wt_sql, $wt_session, $wt_template;
        
        $menus_array = array();
        
     if(wt_not_null($menu_id)) {
     
     $db_menu_query_raw = "SELECT * FROM " . TABLE_MENU . " m, " . TABLE_MENU_DESCRIPTION . " md WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " m.menu_id = '" . $menu_id . "' AND m.menu_id = md.menu_id AND md.language_id = '" . $wt_session->value('languages_id') . "' LIMIT 1";
     } else {
     $db_menu_query_raw = "SELECT * FROM " . TABLE_MENU . " m, " . TABLE_MENU_DESCRIPTION . " md WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " m.menu_id = md.menu_id AND md.language_id = '" . $wt_session->value('languages_id') . "'";
     
     }
     
     $db_menu_query = $wt_sql->db_query($db_menu_query_raw);
     
     while($db_menu = $wt_sql->db_fetch_array($db_menu_query)) {
     	  
     	  if(isset($params['count_links']) && $params['count_links'] === true) {
     	  $db_menu['count_links'] = $this->count_links_to_menu($db_menu['menu_id']);
     	  }
     	  
      if(wt_not_null($menu_id)) {
      $menus_array = $db_menu;
      } else {
      $menus_array[] = $db_menu;
      }

     }
    
    return $wt_sql->db_output_data($menus_array);
       
       
       } //function
	
	
 function count_links_to_menu($mn_id) {
 		global $wt_sql;
 		$count = 0;
 		
 		if( wt_is_valid($mn_id, 'int',' 0') ) {
 		$db_menu_query = $wt_sql->db_query("SELECT COUNT(*) as total FROM " . TABLE_MENU_LINKS . "  WHERE menu_id = '" . (int)$mn_id . "'");
 		$db_menu = $wt_sql->db_fetch_array($db_menu_query);
 		$count = $db_menu['total'];
 		}
 		
 		return $count;
 }	
		
 function get_selected_menu_id($menu_array) {	
    
    if(wt_is_valid($_GET['mID'], 'int', '0')) {
     return $_GET['mID'];
    } else {
     return wt_is_valid($menu_array['0']['menu_id'], 'int', '0') ? $menu_array['0']['menu_id'] : 0;
    }
    
   }	
  
 function get_selected_link_id($link_array) {	
    
    if(wt_is_valid($_REQUEST['lID'], 'int', '0')) {
     return $_REQUEST['lID'];
    } else {
     return wt_is_valid($link_array['0']['link_id'], 'int', '0') ? $link_array['0']['link_id'] : 0;
    }
    
   }	  	  
  
  function get_menus_for_form($params = array()) {
  		global $wt_sql;
  		
  		$Tparams = array();
  		$menus_array = array();
  		
  		if($params['add_blank']) {
  		$menus_array[''] = '== WYBIERZ ==';
  		}
  		
  		
  	  $db_menus_data = $this->get_menus();
  		
  		if(is_array($db_menus_data) && wt_not_null($db_menus_data)) {
  		
  			foreach($db_menus_data as $menu) {
  				$menus_array[$menu['menu_id']] = $menu['menu_name'] . ' [' . $menu['menu_id'] . ']';
  			}
  		  		
  		}
  		
  		return $menus_array;

  }	
  
  
    function get_links($link_id = null, $params = array()) {
       	global $wt_sql, $wt_session, $wt_template;
        
        $links_array = array();
        
     if( wt_is_valid($link_id, 'int', '0') ) {
     $db_link_query = $wt_sql->db_query("SELECT * FROM " . TABLE_MENU_LINKS . " ml, " . TABLE_MENU_LINKS_DESCRIPTION . " mld WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " ml.link_id = '" . (int)$link_id . "' AND ml.link_id = mld.link_id AND mld.language_id = '" . $wt_session->value('languages_id') . "' LIMIT 1");
     } else {
     $db_link_query = $wt_sql->db_query("SELECT * FROM " . TABLE_MENU_LINKS . " ml, " . TABLE_MENU_LINKS_DESCRIPTION . " mld WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " ml.link_id = mld.link_id AND mld.language_id = '" . $wt_session->value('languages_id') . "' ORDER BY ml.sort_order");
     
     }
     
     
     while($db_link = $wt_sql->db_fetch_array($db_link_query)) {
     	   
     	   
     	   
     $db_link['type_text'] = $this->links_type[$db_link['link_type']]; 
     $db_link['status_text'] = wt_return_item_status($db_link['status']);
     $db_link['date_up'] = wt_parse_publish_date_desc($db_link['date_up'], 'up');
     $db_link['date_down'] = wt_parse_publish_date_desc($db_link['date_down'], 'down');
     	  
      if( wt_is_valid($link_id, 'int', '0') ) {
      $links_array = $db_link;
      } else {
      $links_array[] = $db_link;
      }

     }
    
    return $wt_sql->db_output_data($links_array);
       
       
       } //function
  
  function setLinkStatus($params = array()) {
         $no_redirect = false;
         if( !wt_is_valid($params, 'array') ) {
         $params['status'] = (int)$_GET['status'];
         $params['table'] = TABLE_MENU_LINKS;
         $params['tbl_key'] = 'link_id';
         $params['tbl_val'] = (int)$_GET['lID'];
         } else {
         $no_redirect = true;
         }
         wt_change_status_full($params); 
           
      if($no_redirect === false) {        
      
      global $wt_message_stack;
      switch($params['status']) {
   	case '0':
   		$wt_message_stack->add_session('Zmieniono status linku', 'Status linku nr: ' . $params['tbl_val'] . ' został pomyślnie zmieniony.<br><br>Od tej pory link jest <b>nieaktywny</b>.', 'ok');
   	break;
   	case '1':
   		$wt_message_stack->add_session('Zmieniono status linku', 'Status linku nr: ' . $params['tbl_val'] . ' został pomyślnie zmieniony.<br><br>Od tej pory link jest <b>aktywny</b>.', 'ok');
   	break;
   }
      
        	wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('a', 't', 'm', 'status')) . 'm=links'));	
        }	

        }
  
       function get_links_tree($parent_id = 0, $menu_id, $spacing = '', $links_tree_array = array(), $cache = true) {
    global $wt_sql, $wt_session;

     $links_query_cache = new wt_cache();
     $cache_key = array();
	  $cache_key['groups'] = array('menu');
	  $cache_name = md5(serialize($parent_id . $menu_id . $include_itself));
	  $cache_key['name'] = 'link_tree_' . $cache_name;
	  
	  	if($cache === false || !$links_query_cache->read($cache_key)) {
	   
	   $lParams = array();
	   $lParams['where'] = " ml.menu_id = '" . (int)$menu_id . "' AND ml.link_parent_id = '" . (int)$parent_id . "' AND ";
	   $links_data = $this->get_links(null, $lParams);
	   
	  
    foreach($links_data as $db_links) {
    
       $db_links['link_name'] = $spacing . '&mdash;' . $db_links['link_name'];
       $links_tree_array[] = $db_links;
             
       $links_tree_array = $this->get_links_tree($db_links['link_id'], $menu_id, $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |', $links_tree_array, $cache);
    }
    
  $links_query_cache->writeBuffer($links_tree_array);
  		} else {
  $links_tree_array = $links_query_cache->getCache();
 		}

    return $wt_sql->db_output_data($links_tree_array);
  }
  
  
  	function get_links_tree_for_form($mn_id) {
  		
  		$links_data = $this->get_links_tree(0, $mn_id);
  		$links_array = array();
  		
  		$links_array['0'] = 'góra';
  		
  		foreach($links_data as $link) {
  			$links_array[$link['link_id']] = $link['link_name'];
  		}
  		
  		return $links_array;
  		
  	}
  
		
		} // class
?>
