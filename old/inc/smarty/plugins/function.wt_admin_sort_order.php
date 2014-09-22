<?php 
function smarty_function_wt_admin_sort_order($params, &$smarty) {
 		global $wt_template;
 		
 	 $dir_ws_images =	CFGF_DIR_WS_TEMPLATES . $wt_template->theme . '/media/images/';
 	 
 	 if(!wt_not_null($params['c'])) {
 	 	$params['c'] = wt_set_task($_REQUEST, 'sort');
 	 }
 	 
 	 if(!wt_not_null($params['c'])) {
 	 	$params['c'] = $params['d'];
 	 }
 		 
  	$string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('sort') ) . 'sort=' . $params['i'] . 'a') . '">';	
  			
			if($params['c'] == $params['i'] . 'a') {
  			$string .= '<img src="' . $dir_ws_images . 'sort_arrow_a_selected.gif" alt="" border="0" align="absmiddle">';
  			} else {
  				$string .= '<img src="' . $dir_ws_images . 'sort_arrow_a.gif" border="0" align="absmiddle">';
  			}
  	
   $string .= '</a>';
	
 /***** sort D **********/ 	
  	$string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('sort') ) . 'sort=' . $params['i'] . 'd') . '">';
  	
  			if($params['c'] == $params['i'] . 'd') {
  			$string .= '<img src="' . $dir_ws_images . 'sort_arrow_d_selected.gif" border="0" align="absmiddle">';
  			} else {
  				$string .= '<img src="' . $dir_ws_images . 'sort_arrow_d.gif" border="0" align="absmiddle">';
  			}
  	
   $string .= '</a>';
 
 return $string;
 
 } 	
?>