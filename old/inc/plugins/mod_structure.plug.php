<?php


  class WT_Plugin_mod_structure {

    function start() { 
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
	 global $wt_template;
	 	$wt_template->assign('__cPath_array', explode('_', wt_set_task($_REQUEST, 'cPath')));
    	return true;
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
      return false;
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