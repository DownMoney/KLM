<?php 
/**
* @package core
*/


  class wt_navigation_history {
    var $path, $snapshot, $set_global;

    function wt_navigation_history() {
   //   $this->reset();
      
      $this->setGlobal();
      
    }

    function reset() {
      $this->last_page = array();
      $this->path = array();
      $this->snapshot = array();
    }
    
     
    
    function prev_link($default = array()) {
     
 if(!wt_not_null($default)) {
   return  wt_href_link($this->last_page['get']['mod'], '', wt_get_all_get_params('', $this->last_page['get']), '', 'NONSSL', false, true, array('full_url' => true) );
   } else {
   return  wt_href_link($default['mod'], '', $default['params'], $default['mode']);
   }
    }

    function add_current_page() {
      global $request_type, $cPath;

      if ($this->set_global) {
        global $_GET, $_POST;
      }

      $set = 'true';
      /*
      for ($i=0, $n=sizeof($this->path); $i<$n; $i++) {
        if ($this->path[$i]['page'] == basename($_SERVER['PHP_SELF'])) {
          if (isset($cPath)) {
            if (!isset($this->path[$i]['get']['cPath'])) {
              continue;
            } else {
              if ($this->path[$i]['get']['cPath'] == $cPath) {
                array_splice($this->path, ($i+1));
                $set = 'false';
                break;
              } else {
                $old_cPath = explode('_', $this->path[$i]['get']['cPath']);
                $new_cPath = explode('_', $cPath);

                for ($j=0, $n2=sizeof($old_cPath); $j<$n2; $j++) {
                  if ($old_cPath[$j] != $new_cPath[$j]) {
                    array_splice($this->path, ($i));
                    $set = 'true';
                    break 2;
                  }
                }
              }
            }
          } else {
            array_splice($this->path, $i);
            $set = 'true';
            break;
          }
        }
      }
*/

 if(sizeof($this->path) > 10) {
  array_shift($this->path);
 }
		
      if ($set == 'true' && wt_is_valid($_GET, 'array')  ) {
      
        $this->update_last_page();  		
        $this->path[] = array('page' => basename($_SERVER['PHP_SELF']),
                              'mode' => $request_type,
                              'get' => $_GET);
      }
      
      
      
      
    }
	 
	 function update_last_page() {
	 	 $this->last_page = $this->path[sizeof($this->path) - 1]; 
	 }
	 

    function remove_current_page() {
      $last_entry_position = sizeof($this->path) - 1;
      unset($this->path[$last_entry_position]);
		$this->update_last_page();
    }

    function set_snapshot($page = '') {
    	global $request_type;
		
      if (wt_is_valid($page, 'array')) {
        $this->snapshot = array('mode' => $page['mode'],
                                'get' => $page['get']);
      } else {
        $this->snapshot = array('mode' => $request_type,
                                'get' => $_GET);
      }
    }

    function clear_snapshot() {
      $this->snapshot = array();
    }

    function set_path_as_snapshot($history = 0) {
      $pos = (sizeof($this->path)-1-$history);
      $this->snapshot = array('page' => $this->path[$pos]['page'],
                              'mode' => $this->path[$pos]['mode'],
                              'get' => $this->path[$pos]['get']);
    }

    function setGlobal() {
      $this->set_global = (PHP_VERSION < 4.1) ? true : false;
    }

    function debug() {
      global $wt_session;

      for ($i=0, $n=sizeof($this->path); $i<$n; $i++) {
        echo $this->path[$i]['page'] . '?';
        while (list($key, $value) = each($this->path[$i]['get'])) {
          echo $key . '=' . $value . '&';
        }
        if (sizeof($this->path[$i]['post']) > 0) {
          echo '<br>';
          while (list($key, $value) = each($this->path[$i]['post'])) {
            echo '&nbsp;&nbsp;<b>' . $key . '=' . $value . '</b><br>';
          }
        }
        echo '<br>';
      }

      if (sizeof($this->snapshot) > 0) {
        echo '<br><br>';

        echo $this->snapshot['mode'] . ' ' . $this->snapshot['page'] . '?' . wt_array_to_string($this->snapshot['get'], array($wt_session->name)) . '<br>';
      }
    }
  }
?>