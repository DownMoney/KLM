<?php


  class WT_Plugin_mod_advertise {
    var $title = '',
        $description = '',
        $uninstallable = false,
        $depends,
        $preceeds;

    function start() {
    
   // $wt_plugins->start_plugin('sefu');
    
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
      	global $wt_module;
      	
     // die( wt_print_array( $_SERVER ) );
      	$parse_uri = '/' . substr($_SERVER['REQUEST_URI'], strlen(CFGF_DIR_WS_HTTP_CATALOG));
			
      	 if (isset($parse_uri) && (strlen($parse_uri) > 1) && (strpos($parse_uri, 'mod_advertise') || strpos($parse_uri, 'mod=' . $wt_module->installed_modules_keys['mod_advertise'] . '&') || strpos($parse_uri, 'mod/' . $wt_module->installed_modules_keys['mod_advertise'] . '/') )) {     
    
    global $wt_plugins;
    
    
    if (isset($parse_uri) && (strlen($parse_uri) > 1)) {
        $parameters = explode('/', substr($parse_uri, 1));

        $GET_array = array();

        for ($i=0, $n=sizeof($parameters); $i<$n; $i++) {
          if (!isset($parameters[$i+1])) $parameters[$i+1] = '';

          if (strpos($parameters[$i], '[]')) {
            $GET_array[substr($parameters[$i], 0, -2)][] = $parameters[$i+1];
          } else {
            $_GET[$parameters[$i]] = $parameters[$i+1];
           
          }

          $i++;
        }

        if (sizeof($GET_array) > 0) {
          foreach ($GET_array as $key => $value) {
            $_GET[$key] = $value;
            
          }
        }
      }
      
     $_REQUEST = array_merge($_REQUEST, $_GET);
  }  
     
      
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
      return false;
    }

    function stop() {       
      return true;
    }

    function install() {
      return false;
    }

    function remove() {
      return false;
    }

    function keys() {
      return false;
    }
  }
?>