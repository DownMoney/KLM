<?php


  class WT_Plugin_blocks {
    var $title = '',
        $description = '',
        $uninstallable = false,
        $depends,
        $preceeds;

    function start() {
    	    
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() { 
      global $wt_session, $wt_module;
    if(isset($_GET['columnPreview']) && wt_not_null($_GET['columnPreview']) && isset($_GET['columnCheck']) && wt_not_null($_GET['columnCheck']) && wt_validate_password($_GET['columnPreview'], $_GET['columnCheck']) ) {
    
    $columnPreview = '1';
    $wt_session->set('columnPreview', $columnPreview);
    $wt_session->set('columnPreviewColID', $_GET['col_id']);
    
    
    }
    
    
    
    if(isset($_REQUEST['a']) && wt_not_null($_REQUEST['a']) && isset($_REQUEST['mod']) && wt_not_null($_REQUEST['mod']) && $wt_module->is_manager($_REQUEST['mod'])) {
    		
    		$clear_block_cache = new wt_cache();
    		$cache_key = array('_blocks_content');
    	 	$clear_block_cache->clear($cache_key);
    	 
    	 
    		unset($clear_block_cache);
    }
    
      return false;
      
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
    	global $wt_session, $wt_template;
 
 
if(wt_check_permission('mod_blocks_manager', 'col_prev'))  {    
   if($wt_session->exists('columnPreview') && $wt_session->exists('columnPreview') == '1') {
   
   if($wt_session->exists('columnPreviewColID') && is_array($wt_session->value('columnPreviewColID')) ) {
   
   	$to_header = '<style type="text/css">' . "\n";
   
    		foreach($wt_session->value('columnPreviewColID') as $col_id => $col_color) {
    		
    		$wt_template->assign('__column' . $col_id . '__', '1');		
    		
    		$to_header .= ' #column' . $col_id . ' { ' . "\n";
    		$to_header .= ' border: 2px dashed ' . $col_color . '; ' . "\n";
    		$to_header .= ' } ' . "\n";
    		}
   
     $to_header .= '</style>';
     
     $wt_template->add_to_header($to_header);
   }
   
   
   
   }

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
