<?php


  class WT_Plugin_site_offline {
    var $title = 'Inicjalizacja sklepu',
        $description = 'Inicjalizacja sklepu',
        $uninstallable = false,
        $depends,
        $preceeds;

    function start() {
      return true;
    }
    
    function action_after_user() {
     return true; 
    }
    
    function action_after_module() {
  		 return true; 
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
    	  	global $wt_template, $wt_module, $wt_session;
    	if(CFGDB_SITE_OFFLINE == 'true') {      
		$code = wt_set_task($_GET,'code');
	   if(wt_not_null($code) && $code == CFGDB_SITE_OFFLINE_CODE) {
			$wt_session->set('site_offline_code',$code);
		}		
      if($wt_session->value('site_offline_code') != CFGDB_SITE_OFFLINE_CODE ) {
      include(CFGF_DOCUMENT_FS_ROOT.'site_offline.php');
      die();
      } 	
      }
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