
<?php 

function  smarty_function_wt_time_left($params, &$smarty) {
   global $wt_module, $wt_template;
   
   if(wt_is_valid($params['timestamp'], 'int', 0)) {
   	return $params['timestamp']-time();
   }
       
}


?>