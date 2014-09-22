<?php 
function smarty_function_wt_mod_id($p, &$smarty) {
     global $wt_module;
	  if(wt_not_null($p['m'])) {	
   		return $wt_module->translate_module_id($p['m']);
	  }
			return $wt_module->module_info['mod_id'];
 }
?>