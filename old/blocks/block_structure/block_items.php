<?php 
 global $wt_template;
  $wt_template->clear_assign('BL_items');    
  $bl_params = new wt_params($block_params);  
  $mod_structure = wt_module::singleton('mod_structure');
 	
  $iP = array();
	
  if( $bl_params->get('get_recursive') == '1' ) {
  		if($bl_params->get('from') != '0') {
		$iP['where'] = " si.cPath LIKE '".$bl_params->get('from')."\_%' AND ";
		}
	 } else {
	$iP['where'] = " si.parent_id = '".$mod_structure->current_item_id($bl_params->get('from'))."' AND "; 
  } 
	
  $_types = $bl_params->get('types_only');
  wt_clear_empty_array($_types);
						
if( wt_is_valid($_types, 'array') ) {
	$types_query = ' (';
	foreach($_types as $t) {
	$types_query .= " sit.itt_key = '" . $t . "' OR ";
	}
	$types_query = substr($types_query, 0, -4);
	$types_query .= ") AND ";
	$iP['where'] .= $types_query;
} 			
			
if( wt_is_valid($bl_params->get('limit'), 'int', '0') ) {	
	$iP['limit'] = $bl_params->get('limit'); 
}	

if( wt_is_valid($bl_params->get('get_fields'), 'int', '0') ) {	
	$iP['get_fields'] = true; 
	$iP['group_fields'] = true; 
}

if($bl_params->get('sort_order') == 'order_fi_id') {
	$iP['order_fi_id'] = $bl_params->get('order_fi_id');
	$iP['order_fi_id_desc'] = $bl_params->get('sort_order_desc');
} else {
	if( wt_not_null($bl_params->get('sort_order')) ) {
		 $iP['order'] = $bl_params->get('sort_order'); 
	}
	if( $bl_params->get('sort_order') != 'RAND()' && wt_not_null($iP['order']) ) {
		 $iP['order'] .= " ".$bl_params->get('sort_order_desc'); 
	}
}

if( $bl_params->get('sort_order') == 'RAND()' ) {
	 $iP['no_cache'] = true; 
}

		if( wt_is_valid($bl_params->get('fi_id'),'int','0') && wt_not_null($bl_params->get('fi_value')) ) {
			$fid_itids = $mod_structure->get_items_id_by_field_value(array($bl_params->get('fi_id') => $bl_params->get('fi_value')), $fid_itids_finded);
			if( !wt_is_valid($fid_itids, 'array') ) {
				$iP['not_finded'] = true;
				return;
			} else {
				$iP['where'] .= " si.it_id IN (" . implode(',', $fid_itids) . ") AND ";
			}
		}

  if(!isset($iP['not_finded'])) {
	 $iP['get_desc_short'] = true;	
	 $iP['get_desc'] = true;
  $wt_template->assign('BL_items', $a = $mod_structure->get_items(null, $iP)); 
  }	
	//	wt_print_array($a);
 //unset($bl_params);
?>