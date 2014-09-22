<?php 
class mod_sitemaps_manager_cron_plug {
	function make_cron_job() {
		$mod_sitemaps_manager = wt_module::singleton('mod_sitemaps_manager');
		$mod_sitemaps_manager->make_sitemaps();	  
	}
} // class
?>