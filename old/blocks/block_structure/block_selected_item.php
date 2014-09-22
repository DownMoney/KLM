<?php 
 global $wt_template;
      
  $bl_params = new wt_params($block_params);  
  $mod_structure = wt_module::singleton('mod_structure');
 	
  if( wt_is_valid($bl_params->get('it_id'), 'int', '0') ) {
  	 $iP = array();
	 $iP['get_desc_short'] = true;	
	 $iP['get_desc'] = true;
	 $wt_template->assign('BL_item', $mod_structure->get_items($bl_params->get('it_id'),$iP)); 	
  } 
  
?>