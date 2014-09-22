<?php 


 function smarty_function_wt_href_tpl_link($params, &$smarty) {
   
   $mod_id = $params['mod_id'];
   $mod_key = $params['mod_key'];
   $mod_name = $params['mod_name'];
   $mod_params = $params['get_params'];
   $key_words = $params['key_words'];
   $index_file = $params['index_file'];
	
	
   
   if(wt_not_null($mod_params)) {
   $paramss = explode('|', $mod_params);
   } 
   

   $plug = $params['plug'];
   
   $parameters = '';
   if(wt_not_null($paramss)) {
   $parameters .= wt_get_all_get_params($paramss);
   }
   $parameters .= $params['parameters'];
   
   if(wt_not_null($params['connection'])) {
   $connection = $params['connection'];
   } else {
   $connection = 'NONSSL';
   }
   
   if(wt_not_null($params['add_session_id'])) {
   $add_session_id = $params['add_session_id'];
   } else {
   $add_session_id = true;
   }
   
   if(isset($params['search_engine_safe']) && $params['search_engine_safe'] === false ) {
   $search_engine_safe = false;
   } else {
   $search_engine_safe = true;
   }
      
	unset($params['mod_id'], $params['mod_key'], $params['mod_name'], $params['get_params'], $params['key_words'], $params['index_file'], $params['parameters'], $params['connection'], $params['add_session_id'], $params['search_engine_safe']);
	
	
	
	
   if(wt_not_null($mod_id) && is_int($mod_id)) {
   return wt_href_link($mod_id, $key_words, $parameters, $index_file, $connection, $add_session_id, $search_engine_safe, $params);
   }
   
   
   
   if(wt_not_null($mod_key) && is_string($mod_key)) {
   return wt_href_link($mod_key, $key_words, $parameters, $index_file, $connection, $add_session_id, $search_engine_safe, $params);
   }
   
   if(!wt_not_null($mod_id) && !wt_not_null($mod_key)) {
   return wt_href_link('', $key_words, $parameters, $index_file, $connection, $add_session_id, $search_engine_safe, $params);
   }
 
 
 }


?>
