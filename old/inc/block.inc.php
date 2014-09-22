<?php
/**
* @package core
*/


class wt_block {
    var $blocks_count = 0;
    var $blocks_list = array();
    
    function wt_block() {
        global $wt_sql, $wt_module, $wt_session;
        $mod_id = $wt_module->module_info['mod_id'];
        
        if($mod_id > 0) {
			
	 $db_block_query_raw = "SELECT b.block_id, b.block_name, b.block_system, b.block_key, b.block_file, b.use_cache, b.cache_depends_on_request, bd.language_id, bd.bd_title, b2m.btm_column, b2m.sort_order, b2m.access, b2m.btm_theme, b2m.btm_id, b2m.params, b2m.btm_view, b2m.btm_view_manual FROM " . TABLE_BLOCKS . " b, " . TABLE_BLOCKS_DESCRIPTION . " bd, " . TABLE_BLOCKS_TO_MODULES . " b2m WHERE ((b2m.btm_view LIKE '%mod=" . $mod_id . "|%' OR b2m.btm_view = '' OR b2m.btm_view = NULL) OR ( b2m.btm_view_manual LIKE '%mod=" . $mod_id . "|%')) " . wt_access_query('b2m') . " AND b2m.status = '1' AND b2m.btm_block_id = b.block_id AND b2m.btm_id = bd.btm_id AND bd.language_id = '" . $wt_session->value('languages_id') . "' AND bd.language_status = '1' ORDER BY b2m.sort_order";	
			
		$cache = new wt_cache();			
		$cache_key = array();
		$cache_key['groups'] = array('core', 'blocks');
		$cache_key['name'] = 'wt_block_'.md5($db_block_query_raw);	
		$cache_key['dont_add_gr_key'] = true;			
		if(!$cache->read($cache_key)) {			          
        $db_block_query = $wt_sql->db_query($db_block_query_raw);
			while ($block_query = $wt_sql->db_fetch_array($db_block_query) ) {
				$_block_query[] = $wt_sql->db_output_data($block_query);
			}
			$cache->writeBuffer($_block_query);
		} else {
		$_block_query = $cache->getCache();
		}
		   
  if( !wt_is_valid($_block_query,'array') ) {
	return;
  }			
			
       foreach($_block_query as $block_query) { 
		 
        $include = true;
        $block_mode = '';
        $block_task = '';
        $block_option_id = '';
        $options = array();
		  $tasks = array();				
        if( wt_not_null($block_query['btm_view']) ) {        	
        	preg_match_all('/mod=' . $mod_id . '\|op=(.*)/', $block_query['btm_view'], $matches_o);
        	$options = $matches_o[1];
        	preg_match_all('/mod=' . $mod_id . '\|t=(.*)/', $block_query['btm_view'], $matches_t);
        	$tasks = $matches_t[1];
       // 	echo $block_query['btm_view'];
       // 	wt_print_array( $tasks );
        }
			
		
			
		  if( wt_not_null($block_query['btm_view_manual']) ) {    
			
			if(!wt_not_null($block_query['btm_view']) && strpos($block_query['btm_view_manual'], 'mod='.$mod_id.'|') === false) {
				continue;
			}
			
			    		
        	preg_match_all('/mod=' . $mod_id . '\|op=(.*)/', $block_query['btm_view_manual'], $matches_o);
			if(wt_is_valid($matches_o[1],'array')) {
				$options = array_merge($options,$matches_o[1]);
			}
        	$options_man = $matches_o[1];
        	preg_match_all('/mod=' . $mod_id . '\|t=(.*)/', $block_query['btm_view_manual'], $matches_t);
			if(wt_is_valid($matches_t[1],'array')) {
				$tasks = array_merge($tasks,$matches_t[1]);
			}
        }
        
       if( wt_is_valid($tasks, 'array') ) {    
           
         $task = wt_set_task($_REQUEST, 't');
         
        if($task && wt_not_null($task)) { 
         if(!in_array(trim($task), $tasks)) {
         $include = false;
         } else {
         $include = true;
         }
       } else {
       	$include = false;
       }
       
       if(in_array('mainPage', $tasks) || in_array('mP', $tasks)  && !wt_not_null($task)) {
       	$include = true;
       }
       
       if(in_array('all', $tasks)) {
       	$include = true;
       }
       
       if(in_array('', $tasks)) {
       	$include = true;
       }
       
        }
        
        if( wt_is_valid($options, 'array') ) {     
              
         
         foreach($options as $prepare) {
         
       if( wt_not_null($prepare) ) {  
          list($key, $value) = split('=', $prepare);
          
			 $wchildren = false;
			 
			 if( strpos($value, '[!!!]') !== false ) {
			 	$value = substr($value, 0, -5);
				$wchildren = true;
			 }
			 
         if(isset($_REQUEST[$key]) && wt_not_null($_REQUEST[$key])) { 
         
         if( strpos($key, 'Path') !== false ) {
			
         if( ((strlen($_GET[$key]) >= strlen($value)) && (substr($_GET[$key], 0, strlen($value)+1) == $value.'_'))  || ($_GET[$key] == $value) ) {
			
			if( $wchildren === true  ) {
			
			if( $_GET[$key] == $value ) {
			$include = true;
			} else {
			$include = false;
			}
			
			} else {
			$include = true;
			}
			
         
         break;
         } else {
         $include = false;
         }
         
         
         } else {         
         if($_GET[$key] != $value) {
         $include = false;
         } else {
         $include = true;
         break;
         }
         
         } 
         
       } else {
         $include = false;
         } //if(isset($_GET[$key]) && wt_not_null($_GET[$key])) { 
       } // if( wt_not_null($prepare) ) {  
       
         } //  foreach($block_option_id as $prepare) {
         
        } // if($block_query['btm_mod_option_id'] && wt_not_null($block_query['btm_mod_option_id'])) {    
       
      
      
      if($block_query['btm_mod_task_dont'] && wt_not_null($block_query['btm_mod_task_dont']) && $include === true) {    
       
               
         $block_task_dont = explode(';', $block_query['btm_mod_task_dont']);
         
         $task = wt_set_task($_REQUEST, 't');
       
       
                
        if($task && wt_not_null($task)) { 
         if(in_array(trim($task), $block_task_dont)) {
         $include = false;
         } else {
         $include = true;
         }
       } else {
       	$include = true;
       }
       
       if(in_array('mainPage', $block_task_dont) && !wt_not_null($task)) {
       	$include = false;
       }
       
        }
        
       
      
        if($block_query['btm_mod_option_id_dont'] && wt_not_null($block_query['btm_mod_option_id_dont']) && $include === true) {    
               
         $block_option_id_dont = explode(';', $block_query['btm_mod_option_id_dont']);
         
         
         reset($block_option_id_dont);
         while(list($cos, $prepare) = each($block_option_id_dont)) {
          list($key, $value) = split('=', $prepare);
         
         
         if(isset($_GET[$key]) && wt_not_null($_GET[$key])) { 
         
         if(strpos($key, 'Path') !== false ) {
         
        
         if( (strlen($_GET[$key]) >= strlen($value)) && (substr($_GET[$key], 0, strlen($value)+1) == $value.'_')  || ($_GET[$key] == $value) ) {
         $include = false;
         break;
         } else {
         $include = true;
         }
         
         } else {         
         if($_GET[$key] != $value) {
         $include = true;
         } else {
         $include = false;
         break;
         }
         
         } 
         
       } else {
         $include = true;
         } //if(isset($_GET[$key]) && wt_not_null($_GET[$key])) { 
       
         } //  foreach($block_option_id as $prepare) {
         
        } // if($block_query['btm_mod_option_id'] && wt_not_null($block_query['btm_mod_option_id'])) {
      
  if($include === true) {        
  				$this->block_themes[$block_query['btm_theme']] = true;	  
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['block_id'] = $block_query['block_id'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['btm_id'] = $block_query['btm_id'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['block_name'] = $block_query['block_name'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['block_key'] = $block_query['block_key'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['block_file'] = $block_query['block_file'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['bd_title'] = $block_query['bd_title'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['bd_content'] = $block_query['bd_content']; 
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['bd_content_before'] = $block_query['bd_content_before'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['bd_content_after'] = $block_query['bd_content_after'];             
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['bd_theme'] = $block_query['btm_theme'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['btm_access'] = $block_query['btm_access'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['btm_show_title'] = $block_query['btm_show_title'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['params'] = $block_query['params'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['use_cache'] = $block_query['use_cache'];
            $this->blocks_list[$block_query['btm_column']][$block_query['sort_order']]['cache_depends_on_request'] = $block_query['cache_depends_on_request'];
            
            $this->blocks_count++;
            }
            
        }
        }
        
        $this->blocks_list = $wt_sql->db_output_data($this->blocks_list);
       
    }
    
    function column_count($column_id) {
        $val = false;
        if (array_key_exists($column_id, $this->blocks_list)  ) {
            $val = true;
        }
        return $val;
    }
    
        }
?>