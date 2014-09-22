<?php 


 function smarty_function_wt_check_permission($params, &$smarty) {
     
   return wt_check_permission($params['mod'], $params['perm_key'], false);
 
 
 }


?>