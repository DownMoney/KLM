
<?php 

function  smarty_function_wt_push_module($params, &$smarty) {
   global $wt_module, $wt_template;
   
   
   if(CFG_USE_SMARTY_CACHE == 'true' && isset($wt_template->template_module_file_attr) && wt_not_null($wt_template->template_module_file_attr) && $wt_module->module_info['use_cache'] == '1' && $wt_module->module_info['mod_type'] == 'local') {
   $smarty->caching = true; 
   $wt_template->display($wt_template->template_module_file, $wt_template->template_module_file_attr);
   $smarty->caching = false;
   } else {
   $smarty->caching = false;
   $wt_template->display($wt_template->template_module_file, null, $wt_module->module_info['mod_key']);
   }
   $smarty->caching = false;
   return;
   
}


?>
