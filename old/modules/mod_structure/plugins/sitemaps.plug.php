<?php
class mod_structure_sitemaps_plug {
		var $_folder_freq = 'daily';
		var $_file_freq = 'weekly';
		var $_folder_prior = '0.7';
		var $_file_prior = '0.7';

	function get_sitemaps() {

		$mod_structure = wt_module::singleton('mod_structure');
		$iP = array();
		$iP['no_cache'] = true;
		$item_data = $mod_structure->get_items(null, $iP);

		if( wt_is_valid($item_data, 'array') ) {
			foreach($item_data as $it) {
			if($it['itt_nochildren'] == '1' ) {
$this->sitemaps_files[] = array('l' => wt_href_link('mod_structure', '', 't=iP&cPath='.$it['cPath'],'','NONSSL',false,true,array('full_url' => true)),
											 'm' => wt_return_item_date($it['date_added'], $it['last_modified']));
			} else {
				$this->sitemaps_files[] = array('l' => wt_href_link('mod_structure', '', 't=iP&cPath='.$it['cPath'],'','NONSSL',false,true,array('full_url' => true)),
											 'm' => wt_return_item_date($it['date_added'], $it['last_modified']),
											 'f' => 'daily',
											 'p' => '1.0');
			}
			}
		}
	}
} // class
?>
