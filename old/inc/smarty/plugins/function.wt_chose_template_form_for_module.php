<?php 

function  smarty_function_wt_chose_template_form_for_module($params, &$smarty) {
   global $wt_module, $wt_template;
   		
   		
   		$mod_templates_manager = wt_module::singleton('mod_templates_manager');
   		
   		$mod_templates_manager->chose_template_form_for_module($wt_module->module_info['mod_key'], $params); 
   		
}


?>