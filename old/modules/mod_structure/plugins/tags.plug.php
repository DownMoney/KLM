<?php 
class mod_structure_tags_plug {
  
	
  function get_tags() {
  	global $wt_sql, $wt_session;	
  		
		$db_tags_query = $wt_sql->db_query("SELECT sid.tags, si.it_type FROM " . TABLE_MOD_STRUCTURE_ITEMS . " si, " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " sid WHERE si.it_id = sid.it_id AND sid.language_id = '" . $wt_session->value('languages_id') . "' AND si.status = '1' AND sid.tags != '' ");
		
		$tags_array = array();
		while( $db_tags = $wt_sql->db_fetch_array($db_tags_query) ) {
			$tags = explode(' ', $db_tags['tags']);
			if( wt_is_valid($tags, 'array') ) {
				foreach($tags as $t) {
					if( wt_not_null($t) ) {
						$tags_array['iP_'.$db_tags['it_type']][trim($t)] += 1;
					}
				}
			}
		}
	return $tags_array;		
  }	
  
} // class
?>