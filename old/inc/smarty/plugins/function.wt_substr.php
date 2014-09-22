
<?php 

function  smarty_function_wt_substr($params, &$smarty) {
   global $wt_module, $wt_template;
   
   
   $str = substr($params['string'], $params['start'], $params['end']);
   
   if( isset($params['assign']) && wt_not_null($params['assign']) ) {
   	$smarty->assign($params['assign'], $str);
   }
   
   if( !isset($params['nreturn']) ) {
   return $str;
   }    
}


?>
