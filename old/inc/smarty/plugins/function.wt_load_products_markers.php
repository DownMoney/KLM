
<?php 

function  smarty_function_wt_load_products_markers($params, &$smarty) {
   global $wt_module, $wt_template;
   
   $markers_string = '';
   
   if(isset($params['pr_markers']) && wt_not_null($params['pr_markers']) && isset($params['pr_id']) && (int)$params['pr_id'] > 0) {
   
   $products_markers = explode(',', $params['pr_markers']);
   
   $mod_products_markers = wt_module::singleton('mod_products_markers_manager');
   
   foreach($products_markers as $marker) {
   
   $markers_string .= $mod_products_markers->get_marker_string($marker, $params['pr_id']);
   
   }
   
   }
   
   if(wt_not_null($markers_string)) {
   return $markers_string;
   } else {
   return '---';
   }
}


?>
