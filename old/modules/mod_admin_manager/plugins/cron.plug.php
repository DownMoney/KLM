<?php 
class mod_admin_manager_cron_plug {
	function make_cron_job() {
		global $wt_sefu_urls;
		if( is_object($wt_sefu_urls) ) {
		$wt_sefu_urls->make_sefu_mod_urls();	 
		}
		$previous_cleaning = new wt_cache();
		$cache_key = array();
		$cache_key['groups'] = array('config');
		$cache_key['name'] = 'last_cleaning';
		if (!$previous_cleaning->read($cache_key)) {
			$this->clear_media_dir(CFGF_DIR_FS_MEDIA);
			$this->clear_cache_dir(CFGF_DIR_FS_WORK.'query_cache'.DIRECTORY_SEPARATOR);
			$data = array('last_cleaning' => time());
			$previous_cleaning->writeBuffer($data);
		} else {
			$last_timestamp = $previous_cleaning->getCache();
			if(time()-$last_timestamp['last_cleaning'] > 60*60*24) {
				$this->clear_media_dir(CFGF_DIR_FS_MEDIA);
				$this->clear_cache_dir(CFGF_DIR_FS_WORK.DIRECTORY_SEPARATOR);
			}	
		}
	}
		
	function clear_media_dir($dir) {
		if (!file_exists($dir) || !is_dir($dir)) {
        	return false;
        }
    //    echo " |- ".$dir."<br />"; 
        if (!is_dir($dir)) {
        	return false;
        }
    	$d = dir($dir);
        $now = time();
        while ($file = $d->read()) {
            if (is_dir($dir.$file) && $file != '..' && $file != '.') {
      //      	echo " |   | - katalog: ".$file."<br />";
        		$this->clear_media_dir($dir.$file.DIRECTORY_SEPARATOR);
            } elseif (substr($file, 0, 3) == 'th_') {
                $last_timestamp=filemtime($dir.$file);
        //        echo " |   | - miniatura: ".$file."<br />";
          //      echo " |   | - data modyfikacji: ".($now-$last_timestamp)/(24*60*60)."<br />";
				if($now-$last_timestamp > 60*60*24*3) {
	        //    	echo " |   | - USUWAM: ".$file."<br />";
					@unlink($dir.$file);
				} else {
			//		echo " |   | - NOWY PLIK: ".$file."<br />";
				}
             } else {
             	//echo " |   | - inny plik: ".$file."<br />";
             }
        }
	}
	
	function clear_cache_dir($dir) {
		if (!file_exists($dir) || !is_dir($dir)) {
        	return false;
        }
        //echo " |- ".$dir."<br />"; 
        if (!is_dir($dir)) {
        	return false;
        }
        $d = dir($dir);
        $now = time();
        while ($file = $d->read()) {
            if (is_dir($dir.$file) && $file != '..' && $file != '.') {
          // 	echo " |   | - katalog: ".$file."<br />";
        		$this->clear_cache_dir($dir.$file.DIRECTORY_SEPARATOR);
            } elseif (substr($file, -5) == 'cache') {
                $last_timestamp=filemtime($dir.$file);
                //echo " |   | - cache: ".$file."<br />";
                //echo " |   | - data modyfikacji: ".($now-$last_timestamp)/(24*60*60)."<br />";
				if($now-$last_timestamp > 60*60*24*3) {
	        //    	echo " |   | - USUWAM: ".$file."<br />";
					@unlink($dir.$file);
				} else {
				//	echo " |   | - NOWY PLIK: ".$file."<br />";
				}
             } else {
             	//echo " |   | - inny plik: ".$file."<br />";
             }
        }
	}
	
} // class
?>