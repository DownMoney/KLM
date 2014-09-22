<?php 
include_once('inc/core2.inc.php');
wt_set_time_limit(0);
$time = @file_get_contents(DIR_FS_WORK.'cron.lock');
$run = true;
if(wt_not_null($time) && $time > time()-600) {
	die('cron is running');
}

if( $run == true ) {
file_put_contents(DIR_FS_WORK.'cron.lock',time());
		$mods = $wt_plugins->load_module_plugins('cron');
	   			echo 'START<br />';
		if( wt_is_valid($mods, 'array') ) {
				foreach($mods as $m) {
					echo date('H:i:s').' '.$m.'<br />';
					$class_name = $m . '_cron_plug';
					$instance = new $class_name;
					$instance->make_cron_job();
				}
			}		
					echo 'KONIEC<br />';
	@unlink(DIR_FS_WORK.'cron.lock');
	} 
?>