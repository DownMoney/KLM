<?php 



function smarty_block_wt_check_permission($params, $content, &$smarty) {

   if(wt_check_permission($params['mod'], $params['perm_key'], false)) {
   
    return $content;
   
   }
   
   if($params['text'] == true) {
   return '<span style="color: #Ff0000; font-weight: bold; font-size: 1em;">nie masz uprawnieñ do tej operacji</span>';
   }
   
   return;
}


?>