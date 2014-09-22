<? 



class mod_admin_manager  {
		var $admin_mode = false;
     
	function mod_admin_manager() {

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
 
 }
         
       switch($this->action) {
       		 case 'uAI':
				 case 'updateAdminInterface':
       		 $this->updateAdminInterface();
       		 break;
				 case 'fS':
				 case 'formSaved':
				 $this->formSaved();
				 break;
				 case 'fastFormSaved':
				 $this->fastFormSaved();
				 break;
				 case 'updateFormFields':
				 $this->updateFormFields();
				 break;
       }
       
     
     
       
    if(!wt_not_null($this->action))  { 
       
  switch ($this->mode) {
  
    default: 
	 	switch($this->task) {
			default:
				$this->mainPage();
			break;
			case 'structureJSTree':
				$this->structureJSTree();
			break;
   	}
    break;
    
  }
     }

} // function

function mainPage() {
global $wt_template; 
$wt_template->load_file('mainPage.tpl');
}

function updateFormFields() {
	global $wt_session, $wt_template;
	$wt_template->assign('d', $wt_session->value('updateFormFields') );
	$wt_session->remove('updateFormFields');
	$wt_template->display_self = true;
	$wt_template->load_file('updateFormFields');
}


function updateAdminInterface() {
	global $wt_module, $wt_template;

	$this->_site_url = base64_decode($_REQUEST['v']);
	
	if( !wt_not_null($this->_site_url) ) {
		$this->_site_url = 'mod=home';
	}
		
	parse_str($this->_site_url, $this->_site_url_array);
	
	
	
   if( wt_not_null($this->_site_url_array['mod']) ) {
 		$this->admin_module = $this->get_working_module($this->_site_url_array['mod'], $this->admin_mode);
	}  
	
	
	
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . 'mod_admin_manager' . DIRECTORY_SEPARATOR, 'admin2');
	
if( wt_is_valid($this->admin_module, 'array') && wt_not_null( $this->admin_module['mod_key'] ) && $wt_module->is_installed($this->admin_module['mod_key']) ) {
 if( $this->admin_mode === true ) { 
     $this->updateModMenu();
     $this->updateStructureJSTree();	
 } else {
	  $this->updateModMenu();
  	  $this->updateStructureJSTree();
 }
	
 }	  	 

die();

}

	function get_working_module($mod, &$admin_mode) {
		global $wt_module;
		
	if($mod == 'home') {
		$working_module = $wt_module->installed_home_module;
	} else {
		$working_module = $wt_module->get_mod_info($mod);
	}
	
	
	
	
		if( wt_is_valid($working_module, 'array') ) {
			if( $wt_module->is_manager($working_module['mod_key']) ) {
			$admin_module = $working_module;
			$admin_mode = true;
			} else {
			$admin_module = $wt_module->get_mod_info($working_module['mod_key'] . '_manager');
			$admin_mode = false;
			}	
		}
		return $admin_module;
	}


	function updateModMenu($menu_data = array() ) {
		global $wt_template, $wt_module, $wt_session;
	
	$last_menu_hash = md5( $this->_site_url );
	
	if( $last_menu_hash != $wt_session->value('AI_last_menu_hash')) {
  if( !wt_is_valid($menu_data, 'array')  )	{
	
		if( $wt_module->is_installed($this->admin_module['mod_key']) ) {	
			$mod_instance = wt_module::singleton($this->admin_module['mod_key']);
		
			if( is_callable(array($mod_instance, '_mod_menu')) ) {
			  $menu_data =	$mod_instance->_mod_menu($this->_site_url_array, $this->admin_mode);
				
			  if( $menu_data[0]['mod_ico'] === true ) {
			  	unset($menu_data[0]);
			  }	
			  
			  $wt_session->set('AI_last_menu_hash', $last_menu_hash);	
				if( is_object( $mod_instance->_navigationbar ) ) {
				$wt_template->assign('nB', $mod_instance->_navigationbar->draw_breadcrump(' &raquo; '));
				}
			}
	}
  	}	
		
		$wt_template->assign('admin_mode', $this->admin_mode);
	 	$wt_template->assign('menu_data', $menu_data);
			  
		echo $wt_template->fetch('mod_menu.tpl');
     }
	}
	
	function updateStructureJSTree() {
		global $wt_session, $wt_template;
			
		$AI_working_module = $this->admin_module['mod_key'];
		
	
		if( $wt_session->value('AI_working_module') != $AI_working_module ) {
			 $wt_template->assign('AI_working_module', $AI_working_module);	
		 	 $wt_session->set('AI_working_module', $AI_working_module);
			 echo $wt_template->fetch('structure_js_tree.tpl');
		} else {
			$wt_template->assign('site_url', $wt_session->value('site_url'));
			echo $wt_template->fetch('structure_js_tree.tpl');
		}
		
	}
	
	
	function structureJSTree() {
		global $wt_template, $wt_module;
	 
	 $structure = array();
	 $wm = wt_set_task($_GET, 'wm');
	 $admin_module = $this->get_working_module($wm, $false);
	 $mod_key = $admin_module['mod_key']; 
				
				
		
	 if( wt_not_null( $mod_key ) ) {
		if( $wt_module->is_installed($mod_key) ) {
				$mod_instance = wt_module::singleton($mod_key);	
				if( is_callable(array($mod_instance, '_structureJSTree')) ) {
				$structure = $mod_instance->_structureJSTree(true);
				 unset( $mod_instance );  
			  	}
		}
	 }	
		$wt_template->display_self = true;
		$wt_template->assign('structure', $structure);
		$wt_template->assign('mod', $admin_module);
		$wt_template->load_headers();
		$wt_template->load_file('structureJSTree');	
	}
	
	function get_structure_modules() {
			global $wt_template, $wt_module;
	 		
	 
	 $structure = array();
		
		if( wt_is_valid( $wt_module->installed_modules_manager, 'array' ) ) {
			foreach( $wt_module->installed_modules_manager as $mod_key ) {
				if( $wt_module->is_installed($mod_key) ) {
				$mod_instance = wt_module::singleton($mod_key);	
					if( is_callable(array($mod_instance, '_structureJSTree')) ) {
							$_s = array();
							$_s = $mod_instance->_structureJSTree();
							$_s['mod_key'] = $mod_key;
							$structure[] = $_s;
					}
				unset( $mod_instance );	
				}
			}
		}
		
		return $structure;
	}
	
	function updateItemInfo() {
		global $wt_template;
			
		 $itemURL = $this->_site_url_array;
		 	
			unset( $itemURL['mod'] );
			unset( $itemURL['a'] );
		 $itemURL = base64_encode(wt_http_build_query($itemURL));	
		$wt_template->assign('item_url', wt_href_link($this->admin_module['mod_key'], '', 'a=itemInfo&v=' . $itemURL)  );
		
		echo $wt_template->fetch('item_info.tpl');
	}
	
	function formSaved() {
	 	global $wt_session, $wt_template, $wt_message_stack;
				
		$wt_template->tFile = 'theme_self';
		$wt_template->assign('site_url', $wt_session->value('site_url'));
		
			
		
		$wt_template->assign('form_url', $wt_session->value('form_url'));
		$wt_session->remove('form_url');
		$wt_template->assign('op', wt_set_task($_REQUEST, 'op') );
		$wt_template->assign('opA', wt_set_task($_REQUEST, 'opA') );
		$wt_template->assign('dRT', wt_set_task($_REQUEST, 'dRT') );
		$wt_template->assign('dRL', wt_set_task($_REQUEST, 'dRL') );
		$wt_template->assign('system_message', $wt_message_stack->output_last() );
		$wt_template->assign('_formType', wt_set_task($_REQUEST, '_formType') );

		$wt_template->load_file('formSaved');	 	
	 }
	 
	function fastFormSaved() {
			global $wt_session, $wt_template;
		$wt_template->tFile = 'theme_self';	
		$wt_template->assign('dRT', wt_set_task($_REQUEST, 'dRT') );
		$wt_template->assign('site_url', $wt_session->value('site_url'));
		$wt_template->assign('mess', $wt_session->value('mess'));
		$wt_session->remove('mess');
		$wt_template->load_file('fastFormSaved');
	} 

	
	

} 
?>