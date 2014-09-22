<?php 




   function smarty_function_wt_push_column($params, &$smarty) {
   global $wt_block, $wt_template, $wt_session, $wt_module;
   
  
//  wt_print_array(htmlspecialchars($params["element_end"]));
  
   $column = (int)$params['column'];
   $element_start = str_replace("'", '"', $params["element_start"]);
   $element_end = str_replace("'", '"', $params["element_end"]);
   $separator = str_replace("'", '"', $params["separator"]); 
   $include_last = (bool)$params['include_last'];
   
   if($wt_session->exists('structureEdit') && $wt_session->exists('structureEdit') == true && !$wt_module->is_manager() ) {
    $structureEdit = true;
    echo '<ul id="wt_column-' . $column . '"  class="structureEdit">';
    
 }  
  
    if( !wt_is_valid($wt_block->blocks_list, 'array') ) {
   return;
   } 
	
        if (array_key_exists($column, $wt_block->blocks_list)) {
           
            $blocks = $wt_block->blocks_list[$column];
            
            $count = 0;
            $count = count($blocks);
            $current_block_count = 0;
            
            foreach($blocks as $blocks_data => $blocks_value) {
           		$block_params = null;
					$include = true;
					$cache_key = array();
					
				 $smarty->clear_assign(array('bd_title', 'bd_content', 'block_content_before', 'block_content_after'));
				
                if (wt_not_null($blocks_value['bd_title']) ) {
                 $smarty->assign('block_title', $blocks_value['bd_title']);
                } else {
                 $smarty->clear_assign('block_title');
                }
                
                if (wt_not_null($blocks_value['bd_content'])) {
                 $smarty->assign('block_content', $blocks_value['bd_content']);
                 $blocks_value['block_key'] = 'block_db_content';
                } else {
                 $smarty->clear_assign('block_content');
                }
                
                if (wt_not_null($blocks_value['bd_content_before']) && strlen($blocks_value['bd_content_before']) > 5) {
                 $smarty->assign('block_content_before', $blocks_value['bd_content_before']);
                } else {
                 $smarty->clear_assign('block_content_before');
                }
                
                if (wt_not_null($blocks_value['bd_content_after'])  && strlen($blocks_value['bd_content_after']) > 5 ) {
                 $smarty->assign('block_content_after', $blocks_value['bd_content_after']);
                } else {
                 $smarty->clear_assign('bd_content_after');
                }
                
                if (wt_not_null($blocks_value['block_file']) && $blocks_value['block_key'] != 'block_db_content') {
        
        if(CFG_USE_TEMPLATE_BLOCK_CACHE == 'true' && $wt_module->module_info['mod_type'] == 'local' && $blocks_value['use_cache'] == '1' && !isset($_GET[$wt_session->name])) {
             
            $cache_key = $wt_template->create_block_cache_key($column, $blocks_value);
               
     			 $block_view_cache = new wt_cache();
     			
     		  if(!$block_view_cache->read($cache_key)) {  
     		  		$include = true;
     		  } else {
     		  		$include = false;
     		  }    // if(!$block_view_cache->read($cache_key)) { 
     		  
     		 } else {
     		 		$include = true;
     		 } // if(CFG_USE_TEMPLATE_BLOCK_CACHE == 'true' && $wt_module->module_info['mod_type'] == 'local' && $blocks_value['use_cache'] == '1') {
     		 
     		 if($include === true) {   
                    $block_params = $blocks_value['params'];
                    if(include(CFGF_DIR_FS_BLOCKS . $blocks_value['block_key'] . '/' . $blocks_value['block_file'] . '.php')) {
           
           } else {
           // error
           }       
             
            }  // if($include === true) {  
                        
                   
                    
                } //  if (wt_not_null($blocks_value['block_file']) && $blocks_value['block_key'] != 'block_db_content') {
              
                if (wt_not_null($blocks_value['bd_theme'])) {
                
                
                    if(file_exists(CFGF_DIR_FS_TEMPLATES . $wt_template->theme . '/source/blocks/' . $blocks_value['block_key'] . '/' . $blocks_value['bd_theme'] . '.tpl')) {
                  
						$wt_template->SetTemplateDir();  
                                    
     if(CFG_USE_TEMPLATE_BLOCK_CACHE == 'true' && $wt_module->module_info['mod_type'] == 'local' && $blocks_value['use_cache'] == '1' && !isset($_GET[$wt_session->name]) && $structureEdit != true) {        	
             
             if(!isset($block_view_cache) || !is_object(block_view_cache) ) {
             $cache_key = $wt_template->create_block_cache_key($column, $blocks_value);
             
             
     			 $block_view_cache = new wt_cache();
     			 $block_view_cache->set_cache_key($cache_key);
            } 
             
             if($include === true) {
				 
                  $_block_content = $wt_template->fetch('blocks/' . $blocks_value['block_key'] . '/' . $blocks_value['bd_theme'] . '.tpl', null, $blocks_value['block_key']);
                 
             	   $block_view_cache->write($block_view_cache->cache_key, $_block_content); 
             } else {
             		$_block_content =	$block_view_cache->getCache();
             } // if(!$block_view_cache->read($cache_key)) {
             
             unset($block_view_cache);
     } else {
	  
     				$_block_content = $wt_template->fetch('blocks/' . $blocks_value['block_key'] . '/' . $blocks_value['bd_theme'] . '.tpl', null, $blocks_value['block_key']);
     }  // if(CFG_USE_TEMPLATE_BLOCK_CACHE == 'true' && $wt_module->module_info['mod_type'] == 'local' && $blocks_value['use_cache'] == '1') {      
             
  
              $current_block_count++;
              
       if(wt_not_null($_block_content) && strlen($_block_content) > 20) {  
              		
              		
              		if( $structureEdit === true ) {
              		
              		echo '<li id="block_' . $blocks_value['btm_id'] . '" class="structureEdit" onMouseOver="Application.setStructureEditOptions(this.id);" onmouseOut="Application.setStructureEditOptions(this.id, true);">';
						
              		echo '<div class="structureEdit" style="display: none;" id="block_' . $blocks_value['btm_id'] . '_options"><nobr><a title=" edytuj " href="' . wt_href_link('mod_blocks_manager', '', 't=addBlockToModule&btmID=' . $blocks_value['btm_id']) . '"  onclick="popupWindow(this.href, \'addBlock\', \'600\', \'500\', \'yes\'); return false" target="_blank"><img src="' . CFGF_DIR_WS_TEMPLATES . '/admin2/media/images/icons/bi_edit.gif" alt=" edytuj " /></a> <a title=" usuń " href="' . wt_href_link('mod_blocks_manager', '', 't=deleteBlock&btmID=' . $blocks_value['btm_id']) . '" onclick="popupWindow(this.href, \'addBlock\', \'300\', \'300\', \'yes\'); return false" target="_blank"><img src="' . CFGF_DIR_WS_TEMPLATES . '/admin2/media/images/icons/bi_del.gif" alt=" usuń " /></a> <img src="' . CFGF_DIR_WS_TEMPLATES . '/admin2/media/images/icons/bi_move.gif" alt=" przesuń " title=" przesuń " style="cursor: move;" class="structureEdit_move_handler" />';
						if( wt_not_null($block_edit_link) ) {
						echo ' <a title=" ustawienia " href="' . $block_edit_link . '"  onclick="popupWindow(this.href, \'addBlock\', \'600\', \'500\', \'yes\'); return false" target="_blank"><img src="' . CFGF_DIR_WS_TEMPLATES . '/admin2/media/images/icons/bi_mod.gif" alt=" ustawienia " /></a>';
						}
						echo '</nobr></div>';
              		echo $element_start;
              		echo $_block_content;
						echo $element_end;
              		echo '</li>';
              		
              		} else {
              		echo $element_start;
              		echo $_block_content;
              		echo $element_end;
              		}
              		 
              		
              		
              		
              }  else {
             continue;
             } // if(wt_not_null($_block_content) && strlen($_block_content) > 20) {  
                       
            
          
             if(wt_not_null($separator) && $current_block_count < $count) {
                echo $separator;
                } else if(wt_not_null($include_last) && wt_not_null($separator)) {
                echo $separator;
                } 
              
                    }
                      else {
                      wt_core_log::add('core_error', array('Nieudane za3adowanie bloku', 'Plik szablonu (' . CFGF_DIR_FS_TEMPLATES . $wt_template->theme . '/blocks/' . $blocks_value['block_key'] . '/' . $blocks_value['bd_theme'] . '.tpl) nie istnieje.' ) );
                        }
                        

                }
                else {
                
                 /*    if(file_exists(CFGF_DIR_FS_TEMPLATES . $wt_template->theme . '/source/blocks/block_default.tpl')) {
                    
                    echo $element_start;
                            $wt_template->display('blocks/block_default.tpl');
                    echo $element_end;
                    if(wt_not_null($separator) && $i < $count) {
                echo $separator;
                } else if(wt_not_null($include_last) && wt_not_null($separator)) {
                echo $separator;
                }          
                            
                   } 
                    else  {*/
                    
                    wt_core_log::add('core_error', array('Nieudane za3adowanie bloku', 'Domy¶lny plik szablonu (' . CFGF_DIR_FS_TEMPLATES . $wt_template->theme . '/source/blocks/block_default.tpl) nie istnieje.' ) );
                    }
           //   } 


                

                
               }
             
           if($structureEdit === true) {
    echo "</ul>";
   }      
      
            
            
            
        } else {
        
if($structureEdit === true) {
    echo "</ul>";
   } 
        
            return false;
        }
  
   
   }

?>
