<?php


  class WT_Plugin_mod_system_dictionary {
        var $preceeds = '';

    function start() { 
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
	 	global $wt_template;
	  		$params = array();
			$params['dont_add_blank'] = true;
			$params['group_keys'] = true;
	    	$mod_system_dictionary_manager = wt_module::singleton('mod_system_dictionary_manager');
			$wt_template->assign('__dictionary',$mod_system_dictionary_manager->get_definition_for_form('all', null,$params));
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