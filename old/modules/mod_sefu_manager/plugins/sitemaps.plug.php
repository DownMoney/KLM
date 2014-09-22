<?php 
class mod_sefu_manager_sitemaps_plug {
		var $_folder_freq = 'daily';
		var $_file_freq = 'daily';
		var $_folder_prior = '0.7';
		var $_file_prior = '1.0';
		
	function get_sitemaps() {

		$mod_sefu_manager = wt_module::singleton('mod_sefu_manager');
		$sP = array();
		$sP['dsplit'] = true;
		$sefu_data = $mod_sefu_manager->get_sefus(null, $sP);

		if( wt_is_valid($sefu_data, 'array') ) {
			foreach($sefu_data as $sf) {
				$this->sitemaps_files[] = array('l' => wt_href_link($sf['mod_key'], '', $sf['sf_key'],'','NONSSL',false,true,array('full_url' => true)),
										  				  'm' => date('Y-m-d H:i:s') );
			}
		}
	}
}
?>