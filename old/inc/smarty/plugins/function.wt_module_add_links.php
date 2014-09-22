
<?php 

function  smarty_function_wt_module_add_links($params, &$smarty) {
   global $wt_module, $wt_template;
   
  if(!isset($params['mod'])) {
  $params['mod'] = $wt_module->module_info['mod_key'];
  }
  
  if(is_dir(CFGF_DIR_FS_MODULES . $params['mod'] . DIRECTORY_SEPARATOR . 'links')) {
   
   $dir = dir(CFGF_DIR_FS_MODULES . $params['mod'] . DIRECTORY_SEPARATOR . 'links');
   
  while ($file = $dir->read()) {
    if (preg_match("/\.(links.php)$/i", $file)) {
    
    
   include_once(CFGF_DIR_FS_MODULES . $params['mod'] . DIRECTORY_SEPARATOR . 'links' . DIRECTORY_SEPARATOR . $file);       
            }
   }
  
  }
  
  if (is_array($mod_add_links) && wt_not_null($mod_add_links)) {
    
    $i = 0;
    $return_string = '<fieldset ><legend ><b>Dodatkowe opcje</b></legend>';
    foreach($mod_add_links as $add_link) {
    
      $link = '';
      $link = "onclick=\"document.location.href='" . sprintf($add_link['link'], $params['item_id']) . "'\"";
    
     if(isset($add_link['popupWindow']) && $add_link['popupWindow'] == true) {
     $link = "onclick=\"javascript:popupWindow('" . sprintf($add_link['link'], $params['item_id']) . "', '" . $add_link['title'] . "', 800, 600, 'yes');\"";
     
     }
    
    
    
    	switch($add_link['type']) {
    	 case 'infobox';
    	 	if($add_link['type'] == $params['type'] && $add_link['mode'] == $params['mode'] && $add_link['item'] == $params['item']) {
    	 	
    	 	if($i == 2) {
    	 	$return_string .= '<br><br class="verdana04">';
    	 	$i = 0;
    	 	}
    	 		
    	 	$return_string .= '<input type="button" class="buttonIB" onmouseover="this.className=\'buttonIBover\';this.style.cursor=\'pointer\'" onmouseout="this.className=\'buttonIB\'" ' . $link . ' value="' . $add_link['title'] . '">&nbsp;';
    	 	
    	 	$i++;
    	 	}
    	
    	
    	}
    
    
    
    }
  	
  
  }
   $return_string .= '</fieldset>';
   return $return_string;

} // function


?>
