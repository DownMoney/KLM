<?php
		$bl_params = new wt_params($block_params);  
		
		global $wt_sql;
			$query = "SELECT sf2i.fi_id, sf2i.it_id, sf2i.fi_value, si.cPath FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " sf2i, " . TABLE_MOD_STRUCTURE_ITEMS . " si WHERE ";
			
			if(wt_is_valid($bl_params->get('it_id'), 'int', '0')) {
				$query .= " si.it_id = '".$bl_params->get('it_id')."' AND ";
			}			
			if(wt_is_valid($bl_params->get('parent_id'), 'int')) {
				$query .= " si.parent_id = '".$bl_params->get('parent_id')."' AND ";
			}
			if(wt_not_null($bl_params->get('cPath'))) {
				$query .= " si.cPath LIKE '".$bl_params->get('cPath')."\_%' AND ";
			}
			
			$query .= "sf2i.fi_id = '".$bl_params->get('fi_id')."'AND sf2i.it_id = si.it_id AND si.status = '1'  AND sf2i.language_id = '".$wt_session->value('languages_id')."'";
			
			$db_fields_query = $wt_sql->db_query($query);
			
			
			$random_images = array();
			while($db_fields = $wt_sql->db_fetch_array($db_fields_query)) {			
				$images = unserialize($db_fields['fi_value']);
				if( wt_is_valid($images, 'array') ) {
					foreach($images as $i) {
						$i['cPath'] = $db_fields['cPath'];						
						$i['fi_id'] = $db_fields['fi_id'];					
						$i['it_id'] = $db_fields['it_id'];
						$random_images[] = $i;
					}
				}
			}
			
		 if( wt_is_valid($bl_params->get('limit'), 'int', '0') && wt_is_valid($random_images, 'array') ) {
		 	$wt_template->assign('BL_random_images', wt_random_array($random_images, $bl_params->get('limit')) );
		 }	else {
		 	$wt_template->assign('BL_random_images', $random_images);
		 }		
		 unset($random_images);
  //	wt_print_array( $random_images );
?>