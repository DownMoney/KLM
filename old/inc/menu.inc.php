<?php 
/**
* @package core
*/





  class wt_menu {
   var $menu_id;
   var $menu_type;
   var $menu_position;
  
  function wt_menu($params) {
      $this->menu_id = $params['menu_id'];
      $this->menu_position = $params['menu_position'];
      $this->menu_type = $params['menu_type'];
  }
  
  function menu_tree($parent_id = '0') {
    global $wt_sql, $wt_session, $wt_cache;
    
       
    $db_menu_links_query = $wt_sql->db_query("SELECT ml.link_id, mld.link_name, mld.link_title, ml.link_type, ml.link_link, ml.link_module, ml.access, ml.link_image, ml.link_icon_left, ml.link_icon_right, ml.link_link, ml.link_bg, ml.link_bgover, ml.link_key_words, ml.link_index_file, ml.css_id FROM " . TABLE_MENU . " m, " . TABLE_MENU_LINKS . " ml, " . TABLE_MENU_LINKS_DESCRIPTION . " mld WHERE m.menu_id = '" . $this->menu_id . "' AND ml.menu_id = m.menu_id AND ml.status = '1' " . wt_access_query('ml') . " AND ml.link_parent_id = '" . $parent_id . "' AND  ml.link_id = mld.link_id AND mld.language_id = '" . $wt_session->value('languages_id') . "' ORDER BY ml.link_parent_id, ml.sort_order, mld.link_name");	
   
  
  while ($db_menu_links = $wt_sql->db_fetch_array($db_menu_links_query)) {
  
 
      
      $link = '';
  switch($db_menu_links['link_type']) {
  		default: 
  		$link = $db_menu_links['link_link'];
  		break;
      case 'name_link':
      $link = '#' . $db_menu_links['link_link'];
      break;
      case 'mod_link':
      $link = wt_href_link($db_menu_links['link_module'], null, $db_menu_links['link_link']);
      break;
		case 'outside_link':
		if( substr($db_menu_links['link_link'], 0, 7) != 'http://' ) {
		$link = 'http://' . $db_menu_links['link_link'];
		} else {
		$link	= $db_menu_links['link_link'];
		}
		
		break;
  
  }
  
          
            $link_data[] = array('id' => $db_menu_links['link_id'],
                   'name' => $db_menu_links['link_name'], 
            		 'title' => $db_menu_links['link_title'],
            		 'checked' => $checked,
            		 'display' => $display,
            		 'type' => $db_menu_links['link_type'],
            		 'link' => $db_menu_links['link_link'],
            		 'module' => $db_menu_links['link_module'],
            		 'access' => $db_menu_links['access'],
            		 'permission' => $db_menu_links['permission'],
            		 'link_image' => $db_menu_links['link_image'],
            		 'link_image_over' => $db_menu_links['link_image_over'],
            		 'icon_left' => $db_menu_links['link_icon_left'],
            		 'icon_right' => $db_menu_links['link_icon_right'],
            		 'children' => $this->menu_tree($db_menu_links['link_id']),
            		 'href_link' => $link,
            		 'link_bg' => $db_menu_links['link_bg'],
            		 'link_bgover' => $db_menu_links['link_bgover'], 
            		 'key_words' => $db_menu_links['link_key_words'],
            		 'index_file' => $db_menu_links['link_index_file'],
            		 'css_id' => $db_menu_links['css_id']);
 		 }
          
          
         
       
     
          return $link_data;
     
  }
  
  
  
  
  
  
  
  }

 
?>
