<?php 
/**
* @package core
*/



  class wt_Session {
    var $is_started,
        $save_path,
        $name,
        $id;

// class constructor
    function wt_Session() {
    
      global $wt_sql, $cookie_path, $cookie_domain;

      $this->setName('WT_sess_id');
      $this->setSavePath(CFGF_DIR_FS_WORK);

      //session_set_cookie_params((60*60*24), $cookie_path, $cookie_domain); 
	
		
      if (STORE_SESSIONS == 'db') {
		  if(defined('SESSIONS_DB_SERVER') && wt_not_null(SESSIONS_DB_SERVER) && defined('SESSIONS_DB_SERVER_USERNAME') && wt_not_null(SESSIONS_DB_SERVER_USERNAME) && defined('SESSIONS_DB_SERVER_PASSWORD') && wt_not_null(SESSIONS_DB_SERVER_PASSWORD) && defined('SESSIONS_DB_DATABASE') && wt_not_null(SESSIONS_DB_DATABASE) && defined('SESSIONS_DB_PREFIX') && wt_not_null(SESSIONS_DB_PREFIX)) {
		  		$this->db = new wt_sql(SESSIONS_DB_SERVER, SESSIONS_DB_SERVER_USERNAME, SESSIONS_DB_SERVER_PASSWORD, SESSIONS_DB_DATABASE, NULL, true, false, 'utf8');
			} else {
				$this->db = $wt_sql;
			}
			
        session_set_save_handler(array(&$this, '_open'),
                                 array(&$this, '_close'),
                                 array(&$this, '_read'),
                                 array(&$this, '_write'),
                                 array(&$this, '_destroy'),
                                 array(&$this, '_gc'));
      }
 
      $this->setStarted(false);
    }


    function start() {
        global $cookie_path, $cookie_domain;    
    
      $sane_session_id = true;
		
      
      if (isset($_GET[$this->name])) {
      	if (preg_match('/^[a-zA-Z0-9]+$/', $_GET[$this->name]) == false) {
          unset($_GET[$this->name]);

          $sane_session_id = false;
        }
      } elseif (isset($_POST[$this->name])) {
      	if (preg_match('/^[a-zA-Z0-9]+$/', $_POST[$this->name]) == false) {
          unset($_POST[$this->name]);

          $sane_session_id = false;
        }
      } elseif (isset($_COOKIE[$this->name])) {
        if (preg_match('/^[a-zA-Z0-9]+$/', $_COOKIE[$this->name]) == false) {
          unset($_COOKIE[$this->name]);

          $sane_session_id = false;
        }
      }
  	
      if ($sane_session_id == false) {
       // wt_redirect(wt_href_link('home', '', '', 'NONSSL', false));
      } else {
		
			if(wt_not_null($session_checksum = wt_set_task($_GET,$this->name.'_checksum')) && wt_validate_password($this->name.$_GET[$this->name].date('H').$_GET[$this->name].SESSIONS_SECRET,$session_checksum)) {
				$this->setID($_GET[$this->name]);
				if(session_start()) {
					$this->setStarted(true);
					setcookie($this->name, $this->id, time()+(60*60*24), $cookie_path, $cookie_domain, 0);
					return true;
				}
			} elseif(session_start()) {
      	$this->setStarted(true);
         $this->setID();
   		setcookie($this->name, $this->id, time()+(60*60*24), $cookie_path, $cookie_domain, 0);
         return true;
      	}
		}

      return false;
    }

    function exists($variable) {
      if (isset($_SESSION[$variable])) {
        return true;
      }

      return false;
    }

    function set($variable, &$value) {
      if ($this->is_started == true) {
        $_SESSION[$variable] = $value;
        return true;
      }

      return false;
    }

    function remove($variable) {
      if ($this->exists($variable)) {
        unset($_SESSION[$variable]);

        return true;
      }

      return false;
    }

    function &value($variable) {
      if (isset($_SESSION[$variable])) {
        return $_SESSION[$variable];
      }
 
      return false;
    }

    function close() {
      if (function_exists('session_write_close')) {
        return session_write_close();
      }

      return true;
    }

    function destroy() {
      if (isset($_COOKIE[$this->name])) {
        unset($_COOKIE[$this->name]);
      }

      if (STORE_SESSIONS == '') {
        if (file_exists($this->save_path . $this->id)) {
          @unlink($this->save_path . $this->id);
        }
      }
      
      
    setcookie($this->name, $this->id, time()-3600, $cookie_path, $cookie_domain, 0);   
    
   unset($_SESSION);
      return session_destroy();
    }

    function recreate() {
      $session_backup = $_SESSION;

      $this->destroy();

      $this->wt_Session();

      $this->start();

      $_SESSION = $session_backup;

      unset($session_backup);
    }

    function setName($name) {
      session_name($name);
      $this->name = session_name();
      return true;
    }

    function setID($id = null) {
	 	if(wt_not_null($id)) {
			session_id($id);
		} 
		$this->id = session_id();
      return true;
    }
	 
	 function reset() {
     return session_destroy();
    }

    function setSavePath($path) {
      if (substr($path, -1) == '/') {
        $path = substr($path, 0, -1);
      }

      session_save_path($path);

      $this->save_path = session_save_path();

      return true;
    }

    function setStarted($state) {
     global $wt_sql;
      if ($state == true) {
        $this->is_started = true;
        
        
      } else {
        $this->is_started = false;
      }
    }

    function _open() {
      return true;
    }

    function _close() {
      return true;
    }

    function _read($key) {
      global $wt_sql;

      $db_session_query = $this->db->db_query("SELECT ss_val FROM ".TABLE_SESSIONS." WHERE ss_key = '".$key."' AND ss_expiry > '".time()."' LIMIT 1");      
      $db_session = $this->db->db_fetch_array($db_session_query);
	 	
		//wt_print_array($db_session['ss_val']);
		//wt_print_array($this->db->db_output_data($db_session['ss_val']));
		//wt_print_array(wt_unserialize($db_session['ss_val']));
		if(wt_not_null($db_session['ss_val'])) {
			//WT_PRINT_ARRAY(wt_unserialize($this->db->db_output_data($db_session['ss_val'])));
      	return $db_session['ss_val'];     
				
		}
		return false;
    }

    function _write($key, $value) {
      
      if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
        $SESS_LIFE = CFG_COOKIE_LIFE*3600;
      }
     //	$value = $this->db->db_prepare_input($value);   
      $expiry = time()+$SESS_LIFE;
		//wt_print_array($_SESSION);
  		//wt_print_array($value);
		$db_session_query = $this->db->db_query("SELECT count(*) AS total FROM ".TABLE_SESSIONS." WHERE ss_key = '".$key."' LIMIT 1");
		$db_session = $this->db->db_fetch_array($db_session_query);
		
		$db_sql_data_array = array('ss_key' => $key,
											'ss_val' => $value,
											'ss_expiry' => $expiry
											);
		
      if (wt_is_valid($db_session['total'],'int',0)) {
			$write = $this->db->db_perform(TABLE_SESSIONS, $db_sql_data_array, 'update', "ss_key = '".$key."' LIMIT 1");		
      } else {
			$write = $this->db->db_perform(TABLE_SESSIONS, $db_sql_data_array);	      
      }
      
      if($write) {
      return true;
      } else {
      return false;
      }
    }

    function _destroy($key) {
		 $this->db->db_query("DELETE FROM ".TABLE_SESSIONS." WHERE ss_key = '".$key."' LIMIT 1");
    }

    function _gc($maxlifetime) {
		$this->db->db_query("DELETE FROM ".TABLE_SESSIONS." WHERE ss_expiry < '".time()."'");
    }
  }
  
  
?>