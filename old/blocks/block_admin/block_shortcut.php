<?php
global $wt_template, $wt_module;

if( defined('CFGDB_SHORTCUT_MODULES') && wt_not_null(CFGDB_SHORTCUT_MODULES) ) {
		$sca = explode(',', CFGDB_SHORTCUT_MODULES);
			$_s = array();
		if( wt_is_valid($sca, 'array') ) {			
			foreach( $sca as $s ) {
				if(wt_not_null($s)) {
				$_s[] = array('k' => $s, 'n' => $wt_module->installed_modules[$s]['mod_title']);
				}
			}
			$wt_template->assign('structure_modules', $_s);
		}
}

?>