<?php 


		class wt_core_log {
		
			
			function wt_core_log() {
			  //	error_reporting(E_ALL ^ E_NOTICE);
				
			}//function
			
			function &singleton() {
		static $instance;

		if(!isset($instance)) {
			$instance = new wt_core_log;
		}

		return $instance;
	}//function
	   
	   function php_error_handler($errNo, $errMsg, $file, $line) {
	   	global $old_error_handler;
	        
	  		$errType = array (
            1    => "Php Error",
            2    => "Php Warning",
            4    => "Parsing Error",
            8    => "Php Notice",
            16   => "Core Error",
            32   => "Core Warning",
            64   => "Compile Error",
            128  => "Compile Warning",
            256  => "Php User Error",
            512  => "Php User Warning",
            1024 => "Php User Notice"
        );

if ($errNo != E_NOTICE){ 

  //	while(@ob_end_clean());
     		$sep = chr(9);
        	$content = '';
        	$content .= date('Y-m-d H:i:s') . $sep;
        	$content .= $errType[$errNo] . $sep;
        	$content .= $errMsg . $sep;
        	$content .= $file . $sep;
        	$content .= $line . $sep;
        	$content .= "\n";
    	error_log($content, 3, "logs/php_error.log");	
   
     $this->display_message();
      
    }  
       
	   }
	   
	   function display_message() {
	   
	  if(DEVELOPERS_MODE == 'false') { 
	      @ob_end_clean();
	      ob_start();
	   	@include_once(dirname(__FILE__) . '/php_error.tpl.php');
	   	die();
	  }
	   }
	
		function add($type = '', $params = array()) {
			global $wt_core_log;
		  
		  if( CFGDB_RUN_CORE_LOG != 'true' ) {
		  	return;	
		  }
			
		switch($type) {
			  case 'core_error':
			  	//	$wt_core_log->add_core_error($params);
			  break;
			  case 'db_error':
			  		$wt_core_log->add_db_error($params);
			  break;
			  case 'user_action':
			  		$wt_core_log->add_user_action($params);
			  break;
			  case 'admin_action':
			  		$wt_core_log->add_admin_action($params);
			  break;
			  case 'admin_message':
			  		$wt_core_log->add_admin_message($params);
			  break;
			}
 
		
		} //function
		
		function add_core_error($params) {
			$sep = chr(9);
        	$content = '';
        	$content .= date('Y-m-d H:i:s') . $sep;
        	$content .= $params[0] . $sep;
        	$content .= $params[1] . $sep;
        	
        	
        		$trace = array();

        if (function_exists('debug_backtrace')) {
            $trace = debug_backtrace();
        } 
        

		 if(is_array($trace) && wt_not_null($trace[2])) {
		 	unset($trace[1]['class'], $trace[1]['type'], $trace[1]['function'], $trace[1]['args']);
		 	$content .= serialize($trace[1]);
		 }
			
        	$content .= "\n";
        	
    	error_log($content, 3, CFGF_DOCUMENT_FS_ROOT . "logs/core_error.log");	
   
   //  $this->display_message();
		}
		
		function add_admin_action($params) {
			global $wt_user;
			
			$sep = chr(9);
        	$content = '';
        	$content .= date('Y-m-d H:i:s') . $sep;
        	$content .= $wt_user->usr_info['usr_id'] . $sep;
        	$content .= strip_tags($params[0]) . $sep;
        	$content .= strip_tags($params[1]) . $sep;
        	$content .= wt_get_ip_address();
        	$content .= "\n";
    	error_log($content, 3, CFGF_DOCUMENT_FS_ROOT . "logs/admin_action.log");	
    return true;
    
		}
		
		function add_db_error($params) {
			$sep = chr(9);
        	$content = '';
        	$content .= date('Y-m-d H:i:s') . $sep;
        	$content .= $params[0] . $sep;
        	$content .= $params[1] . $sep;
        	$content .= $params[2] . $sep;
        	
        	$content .= "\n";
        	echo "$content";
    	error_log($content, 3, CFGF_DOCUMENT_FS_ROOT . "logs/db_error.log");	
   
   
      if(DEVELOPERS_MODE == 'true') { 
		echo '<pre>';
      print_r($content);
		echo '</pre>';
      }
   
    // $this->display_message();
		}
		
		
		function add_admin_message($params) {
			global $wt_sql;
			
			$params = $wt_sql->db_prepare_input($params);
			
			 $sql_data_array = array();	
		    $sql_data_array = array('ms_title' => $params[0],
		    								 'ms_text' => $params[1],
		    								 'ms_link' => $params[2],
		    								 'date_added' => 'now()');
		
		$wt_sql->db_perform(DB_PREFIX . 'core_messages', $sql_data_array);
		
		}
		
		function saveLog($params) {
			global $wt_sql, $wt_module, $wt_user;
			$params = $wt_sql->db_prepare_input($params);
			if(wt_not_null($params['mod_id'])) {
				$params['mod_id'] = $wt_module->get_module_id($params['mod_id']);
			}
			if(!wt_is_valid($params['usr_id'], 'int', 0)) {
				$params['usr_id'] = $wt_user->usr_info['usr_id'];
			}
			
			$sql_data_array = $params;	
		   $sql_data_array['date_added'] = 'now()';
			$wt_sql->db_perform(DB_PREFIX . 'core_messages', $sql_data_array);
		}
		
		function add_user_action($params) {
			
			$sep = chr(9);
			$content = '';
			$content .= date('Y-m-d H:i:s') . $sep;
			$content .= $params['t'] . $sep;
			$content .= $params['m'];
			$content .= "\n";
			
       error_log($content, 3, CFGF_DOCUMENT_FS_ROOT . "logs/user_action.log");	
		  		
		}//function
	
	} // class
?>
