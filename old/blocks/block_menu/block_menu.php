<?php

global $wt_template, $wt_sql, $wt_session;

  $parameters = new wt_params($block_params);
  
  $params = array();
  $params['menu_id'] = $parameters->get('menu_id');
  $block_edit_link = wt_href_link('mod_menu_manager', '', 'm=links&mID=' . $parameters->get('menu_id'));	
 
 
  $menu = new wt_menu($params);	
  
  $menu_cache = new wt_cache();
  
  $cache_key = array();
  $cache_key['groups'] = array('menu');
  $cache_key['name'] = $params['menu_id'];
  
  if(!$menu_cache->read($cache_key)) {
  $menu_data = $menu->menu_tree();
  $menu_cache->writeBuffer($menu_data);
  } else {
  $menu_data = $menu_cache->getCache();
  }
 // wt_print_array($menu_cache);
  unset($menu_cache);
  
  $wt_template->assign('block_menu_tree', $menu_data); 
 
  
   
  	
   
?>
