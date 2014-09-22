<?php 
			class wt_module_plugins {
			
				function singleton($mod_key, $plug) {
    		global $wt_module_plugins, $wt_module;
    	
		
	
		  $mod =	$wt_module->get_mod_info($mod_key);
		
		  $mod_key = $mod['mod_key'];
		
    		if(isset($wt_module_plugins->instances[$mod_key][$plug]) && is_object($wt_module_plugins->instances[$mod_key][$plug]) ) {
    			$instance = $wt_module_plugins->instances[$mod_key][$plug];
    		} else {
    		
    	  if( @include_once(CFGF_DIR_FS_MODULES . $mod_key . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plug . '.plug.php') ) {
    		$plug_name = $mod_key . '_' . $plug . '_plug';
    		$instance = new $plug_name;
    		$wt_module_plugins->instances[$mod_key][$plug] = $instance;
    		} else {
    		return false;
    		}
     }		
    		
    return $instance;
    }
    
    function factory($mod_key, $plug) {
    		if( include_once(CFGF_DIR_FS_MODULES . $mod_key . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plug . '.plug.php') ) {
    		$plug_name = $mod_key . '_' . $plug . '_plug';
    		return new $plug_name;
    		} else {
    		return false;
    		}
    }
    
    function load_all_plugins($plug) {
    
    
    
    }
			
			
			}
?>