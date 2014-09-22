<?php 




    class mod_templates_manager {
    	var $count_templates;
         
  	function __construct() {

         $class_name = __CLASS__;
    	  	$this->$class_name();

    	  	}

    
    
    
    function mod_templates_manager() {
    		$this->count_templates = $this->count_templates();
    }
	 
	 function _init() {
        
  $this->task = wt_set_task($_REQUEST, 't');
  $this->action = wt_set_task($_REQUEST, 'a');
  $this->mode = wt_set_task($_REQUEST, 'm');
 
         
 if(wt_not_null($this->action)) {
       switch($this->action) { 
       }
 } else {
 	switch ($this->mode) {
    default: 
    	switch($this->task) {
			case 'themeInfo':
				$this->themeInfo();
			break;
   	}
    break;
  }
     }
 
   
     
} // function 
	 
	 
	 
	 function themeInfo() {
	 	global $wt_template, $wt_module;
		
	 	
		
		$file = wt_set_task( $_REQUEST, 'theme' );
		$mod = wt_set_task( $_REQUEST, 'module' );
		
		$file = str_replace('---', DIRECTORY_SEPARATOR, $file);
    
    if( strpos($file, ';') !== false ) {
    	$prepare = explode(';', $file);
    	if( wt_not_null($prepare[0]) ) {
    		$theme = $prepare[0];
    	}
    	$file = $prepare[1];
    }
		
	  $wt_template->assign('theme', $theme);
	  $wt_template->assign('file', basename($file));		
	  $wt_template->assign('file_info', @file_get_contents( CFGF_DIR_FS_TEMPLATES . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR . $file . '_info' )  );	
		
		if( !$theme ) {
			$theme = $wt_module->installed_modules[$mod]['theme'];
		}
		
		
	  if( file_exists( CFGF_DIR_FS_TEMPLATES . $theme . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR . $file . '.jpg'  ) ) {
		
			$wt_template->assign('file_image', CFGF_DIR_WS_TEMPLATES . $theme . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR . $file . '.jpg' );
	  		
		} else {
			$wt_template->assign('file_image', CFGF_DIR_WS_TEMPLATES . $theme . DIRECTORY_SEPARATOR . 'no_preview.jpg' );
		}
		
	
		$wt_template->display_self = true;
		$wt_template->load_file('themeInfo');
		
	 }
    
    function count_templates() {
    	$params = array();
    	$params['where'] = " tem_key != 'admin' ";
    	return count($this->get_themes(null, $params));
    }
    
    function chose_template_form_for_module($mod = null, $params = array()) {
    
    		$Tparams = array();
    		$Tparams['where'] = " tem_key != 'admin' ";
    		$themes_data = $this->get_themes(null, $Tparams);
    		
    		$items = explode(';', $params['items']);
    		
    		
    		foreach($themes_data as $theme) {
    		
    				
    		
    		}
    		
    		wt_print_array($themes_data);
    		
    		
    		
    		
    }
    
    
    
    function get_themes($tem_id = null, $params = array()) {
    
    global $wt_sql, $wt_session, $wt_template;
        
        $themes_array = array();
       
         
     if(wt_not_null($tem_id)) {
     $db_themes_query_raw = "SELECT * FROM " . TABLE_TEMPLATES . " WHERE tem_id = '" . $tem_id . "' " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '' ) . " LIMIT 1";
     
     } else {
     $db_themes_query_raw = "SELECT * FROM " . TABLE_TEMPLATES . " " . ((isset($params['where']) && wt_not_null($params['where'])) ? ' WHERE ' . $params['where'] : '' ) . " ORDER BY tem_id";

     }
     
   $db_themes_query = $wt_sql->db_query($db_themes_query_raw);
     
     while($db_themes = $wt_sql->db_fetch_array($db_themes_query)) {
               
       if(wt_not_null($tem_id)) {
          $themes_array = $db_themes;
       } else {
          $themes_array[] = $db_themes;
       }
     }
    
    
    return $wt_sql->db_output_data($themes_array);
    
    }
    
    function get_theme_info($theme_key) {
      global $wt_sql;
      
       if(!wt_not_null($theme_key)) {
       return;
       }
        
        
        $db_theme_query = $wt_sql->db_query("SELECT tem_id, tem_name, tem_key, tem_columns, date_add, added_by FROM " . TABLE_TEMPLATES . " where tem_key = '" . $theme_key . "'");
        
       return $db_theme = $wt_sql->db_fetch_array($db_theme_query);
           
    }
    
    function get_themes_for_module($mod_key) {
      global $wt_sql;
      
      $avaible_themes = array();
      
       $db_theme_query = $wt_sql->db_query("SELECT tem_id, tem_name, tem_key FROM " . TABLE_TEMPLATES . "");
         
       while($db_theme = $wt_sql->db_fetch_array($db_theme_query)) {
       //   clearstatcache();
          
          if(is_dir(CFGF_DIR_FS_TEMPLATES . $db_theme['tem_key'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $mod_key)) {
            $avaible_themes[] = $db_theme;
          }
       
       }
      
    return $avaible_themes;
    }    
    
    
    
   function get_themes_for_form($params = array()) {
     
     $themes_array = array();
     
     $db_theme = mod_templates_manager::get_themes();
     
   if(!isset($params['dont_add_blank'])) {
     $themes_array[''] = ' === Wybierz === ';
   }
    
     
     if($db_theme && is_array($db_theme)) {
     
     foreach($db_theme as $theme_data) {
     
     if(isset($params['only_id_value'])) {
     
     $theme_string = $theme_data['tx_value'];
     
     } else {
     
     $theme_string = $theme_data['tem_name'];
     
     if($params['add_key']) {
     $theme_string .= ' [' . $theme_data['tem_key'] . ']';
     }
     
     }
     
     $themes_array[$theme_data['tem_key']] = $theme_string;
     }
     
     
     }
   
   return $themes_array;
   }         
    
    
    }



?>
