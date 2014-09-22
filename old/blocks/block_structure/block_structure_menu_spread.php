<?php 

      global $wt_template;
      
  $bl_params = new wt_params($block_params);  
  $mod_structure = wt_module::singleton('mod_structure');
  $top = '0';
		
	if( $bl_params->get('get_hl') == '1' ) {
		$cPath = wt_set_task($_REQUEST, 'cPath');
		$_top = explode('_', $cPath);
		
		if( wt_is_valid($bl_params->get('hl_is'), 'int', '0') ) {
			$top = $_top[$bl_params->get('hl_is')-1];	
		} else {
			$top = $_top[0];		
		}
	} elseif( wt_is_valid($bl_params->get('starts_from'), 'int') ) {
		$top = $bl_params->get('starts_from');
	} else {
		$top = 0;
	}
	
		if(wt_is_valid($top,'int', '0')) {	 
		$wt_template->assign('top_item', $mod_structure->get_items($top));
		}
		
  $wt_template->assign('starts_from', $bl_params->get('starts_from', $top));
			
  $params = array('include_parent' => $bl_params->get('include_parent', false),
						'not_include' => $bl_params->get('not_include', array()),
						'not_list' => $bl_params->get('not_list', array()),
						'types_only' => $bl_params->get('types_only', array()),
						'types_without' => $bl_params->get('types_without', array()),
						'limit' => explode(',',$bl_params->get('limit')),
						'order' => (wt_not_null($bl_params->get('sort_order'))) ? $bl_params->get('sort_order')." ".$bl_params->get('sort_order_desc') : false,
						);

  $wt_template->assign('BCMS_structure', $a = $mod_structure->BCMS_get_categories_tree($top, $bl_params->get('no_of_flat_levels', '1'), $params) ); 
	
	
  	
	if( $bl_params->get('get_rest') == '1' && wt_is_valid($top, 'int', '0') ) { 
		$params = array('not_include' => array($top),
							'types_only' => $bl_params->get('types_only', array()),
							'types_without' => $bl_params->get('types_without', array()), );

  		$wt_template->assign('BCMS_structure_rest', $b = $mod_structure->BCMS_get_categories_tree(0, 1, $params) ); 
	}
  //wt_print_array( $b );	
 //unset($bl_params);
 
?>