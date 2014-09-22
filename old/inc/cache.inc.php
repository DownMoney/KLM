<?php
/**
* @package core
*/

  class wt_cache {
    var $cached_data = null,
        $cache_key = null,
        $cache_base_dir = null,
        $new_key = false,
        $cache_count = array();
	 		
	 function wt_cache() {
	 	$this->cache_base_dir = CFGF_DIR_FS_WORK . 'query_cache' . DIRECTORY_SEPARATOR;
	 	
	 	
	 	
	 }
	 
	 function update_cache_count($type) {
	   
	    if(!isset($GLOBALS['wt_cache_count'][$type])) {
	   $GLOBALS['wt_cache_count'][$type] = 1;
	 }
	   if(!wt_not_null($this->cache_count)) {
	   $this->cache_count = $GLOBALS['wt_cache_count'];
	 }
	 
	 	$this->cache_count[$type] = $this->cache_count[$type]+1;
	 	$GLOBALS['wt_cache_count'] = $this->cache_count;
	 }
	 
    function write($key, &$data) {
    
      $filename = CFGF_DIR_FS_WORK . 'query_cache'.DIRECTORY_SEPARATOR . $key . '.cache';

      if ($fp = @fopen($filename, 'w')) {
        flock($fp, 2); // LOCK_EX
        fputs($fp, serialize($data));
        flock($fp, 3); // LOCK_UN
        fclose($fp);
			
		  // $this->update_cache_count('write');	
			
        return true;
      }

      return false;
    }
    
    function create_key($key, $params = array()) {
       global $wt_user, $wt_session;
    
    $new_dirs = implode(DIRECTORY_SEPARATOR, $key['groups']);
    wt_create_dir_structure(CFGF_DIR_FS_WORK . 'query_cache'.DIRECTORY_SEPARATOR. $new_dirs);
    
    chmod(CFGF_DIR_FS_WORK . 'query_cache'.DIRECTORY_SEPARATOR . $new_dirs, 0777);
    
    $key_name = $key['name'];
  
  if(!isset($key['dont_add_gr_key'])) {  
  
    if(!is_array($wt_user->usr_group)) {
    $wt_user->usr_group = array();
    }
    
    $groups_keys = array_keys($wt_user->usr_group);
    $groups = implode('|', $groups_keys);
    
    
    $key_name .=  '_' . md5(serialize($groups . '_' . $wt_session->value('languages_id')));
   } 
    
    $created_key = array('file' => $new_dirs . DIRECTORY_SEPARATOR . $key_name);
    
    
    // $this->update_cache_count('create_key');	
    return $created_key;
    
    }
    
    function set_cache_key($key) {
    
    if(!is_array($key)) {
      $this->cache_key = $key;
    } else {
      $created_key = $this->create_key($key);
      $this->cache_key = $created_key['file'];
    }
    
      $filename = CFGF_DIR_FS_WORK . 'query_cache' . DIRECTORY_SEPARATOR . $this->cache_key . '.cache';
      
    }

    function read($key = '', $expire = 259200) {
    
    if(DISABLE_CACHE == 'true') {
    $this->clearAll();
    return false;
    }
    
   // wt_print_array($key);
    
    
    // $this->update_cache_count('read');	
    $this->set_cache_key($key);
    
    if(file_exists($this->cache_base_dir . $this->cache_key . '.cache') && (($expire == 0) || ($expire > floor((time() - @filemtime($this->cache_base_dir . $this->cache_key . '.cache')) / 60))) ) {
    	 return true;
    } else {
    	return false;
    }
    
   
            
    }

    function &getCache() {
    	
   if(!isset($this->cached_data) || !wt_not_null($this->cached_data)) {	
  	$this->cached_data = unserialize(@file_get_contents($this->cache_base_dir . $this->cache_key . '.cache'));
   }       
      // $this->update_cache_count('getCache');
      return $this->cached_data;
    }

    function startBuffer() {
      ob_start();
    }

    function stopBuffer() {
      $this->cached_data = ob_get_contents();

      ob_end_clean();

      $this->write($this->cache_key, $this->cached_data);
    }

    function writeBuffer(&$data) {
	 if(DISABLE_CACHE == 'true') {
	 return;
	 }
	 
      $this->cached_data = $data;

      $this->write($this->cache_key, $this->cached_data);
    }

    function clear($key) {
    
    if(is_array($key) && wt_not_null($key)) {
    	 
    	$entry = implode(DIRECTORY_SEPARATOR, $key);
    	 
    	  if(is_dir(CFGF_DIR_FS_WORK . 'query_cache' . DIRECTORY_SEPARATOR . $entry) && $entry != '.' && $entry != '..') {

        wt_rmdir(array('dirname' => CFGF_DIR_FS_WORK . 'query_cache' . DIRECTORY_SEPARATOR . $entry));
        }
    
    return true;
    }
    
      $key_length = strlen($key);

      $d = dir(CFGF_DIR_FS_WORK . 'query_cache');
      
      

      while ($entry = $d->read()) {
        if ((strlen($entry) >= $key_length) && (substr($entry, 0, $key_length) == $key)) {
          @unlink(CFGF_DIR_FS_WORK . 'query_cache'.DIRECTORY_SEPARATOR . $entry);
        }
      }

      $d->close();
    }
    
    function clearAll() {
	   wt_rmdir(array('dirname' => CFGF_DIR_FS_WORK . 'query_cache'));
	 }
  }
?>