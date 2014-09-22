<?php


  class WT_Plugin_admin {
    var $title = 'Przyjazne URL',
        $description = 'Przyjazne URL.',
        $uninstallable = true,
        $depends,
        $preceeds = 'session';

    function start() { 
	 	if(isset($_GET['proxyrequest']) && wt_not_null($_GET['proxyrequest']) && wt_validate_password($_GET['proxyrequest'].date('Ymd'), $_GET['proxycheck'])) {
			include(CFGF_DIR_FS_INCLUDES.'/proxy.inc.php');
			die();
		}	
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
    	return true;
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
    	global $wt_template, $wt_module, $wt_message_stack, $wt_session;
   
		
if( $wt_module->is_manager($_REQUEST['mod']) ) {		
	$url =  wt_href_link('', '', wt_get_all_get_params(array('sort', 'page')));
if($wt_module->module_info['mod_key'] == 'mod_structure_manager') {
	$mod_structure_manager = wt_module::singleton('mod_structure_manager');
	if(wt_is_valid($mod_structure_manager->current_item_id(),'int','0')) {
	 $url = wt_href_link('', '', 'cPath='.$mod_structure_manager->get_cpath_to_items_tree($mod_structure_manager->current_item_id()));
	}	
}
	
	
	
	$footer = '<script type="text/javascript">
	 
if( self!=top ) {
function structureTreeSetItem() {
parent.structureTreeSetItem(\''.$url.'\');
}

if(window.name == "mod_content_info") {
   parent.$("mod_content_info").show();	
	parent.$("navTabInfo").removeClassName("navTab-progress");	
}


parent.load_module(\'' . base64_encode($_SERVER['QUERY_STRING']) . '\', \'' . $wt_module->get_module_id($_REQUEST['mod']) . '\');

setTimeout(function() { if(parent.$(\'structureJSTreeID\')) { structureTreeSetItem(); } }, 300);

parent.$("navTabMod").removeClassName("navTab-progress");
if(window.name == "mod_content") {
Event.observe(window, "unload", function () {
		parent.$("navTabMod").addClassName("navTab-progress");
		parent.navigationTabsTab.cycleTab("navTabMod");	
		} );	
}
} 
			
			
	  
				
		';
	
	$footer .= '</script>';
	$wt_template->add_to_footer($footer);
	
  }	
	
	
	
      return true;
    }

    function stop() {
      return true;
    }

    function install() {
      return false;
    }

    function remove() {
      return false;
    }

    function keys() {
      return false;
    }
  }
?>