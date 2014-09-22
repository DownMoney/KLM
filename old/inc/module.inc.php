<?php
/**
* @package core
*/

//initialize


 class wt_module {

    var $module_info;
    var $module_global;
    var $module_count;
    var $module_access = false;
	 var $installed_modules_manager;
	 var $installed_modules_local;
    var $installed_modules;
    var $installed_modules_ids,
    $installed_modules_keys,
    $installed_home_module;
    var $loaded_module;
    var $instances = array();


    	  function __construct() {
    	  		$this->wt_module();
    	  }

        function wt_module() {
          global $wt_sql, $wt_session;

           $cache = new wt_cache();

				if(!wt_is_valid($wt_session,'object')) {
					$cache->clearAll();
					@unlink(CFGF_DIR_FS_WORK.'sys_db_tables.php');
				}

		$cache_key = array();
		$cache_key['groups'] = array('core', 'modules');
		$cache_key['name'] = 'wt_module_'.$wt_session->value('languages_id');
		$cache_key['dont_add_gr_key'] = true;
		if(!$cache->read($cache_key)) {

          $db_modules_local_query = $wt_sql->db_query("SELECT m.mod_id, m.mod_key, m.mod_type, m.mod_home, m.mod_name, m.use_cache, m.access, m.theme, md.mod_title, md.mod_short_desc, md.mod_desc, md.sefu_id, md.params, m.mod_secure FROM " . TABLE_MODULES . " m LEFT JOIN " . TABLE_MODULES_DESCRIPTION . " md ON m.mod_id = md.md_id AND md.language_id = '" . $wt_session->value('languages_id') . "' WHERE m.status = '1' ORDER BY m.mod_type");



          while($db_modules_local = $wt_sql->db_fetch_array($db_modules_local_query)) {
			 $mods_data[] = $wt_sql->db_output_data($db_modules_local);
			 }


		$cache->writeBuffer($mods_data);

		} else {
		$mods_data = $cache->getCache();
		}
		 unset($cache);

		 foreach($mods_data as $m) {

        $this->installed_modules[$m['mod_key']] = $m;

        if($m['mod_home'] == '1') {
        		$this->installed_home_module = $m;
        }

        $this->installed_modules_ids[$m['mod_id']] = $m['mod_key'];

			if( $m['mod_type'] == 'manager' ) {
			$this->installed_modules_manager[] = $m['mod_key'];
			} elseif( $m['mod_type'] == 'local' ) {
			$this->installed_modules_local[] = $m['mod_key'];
         }

        $this->installed_modules_keys[$m['mod_key']] = $m['mod_id'];

        }

       }



    function singleton($mod_key) {
    		global $wt_module,$wt_language;



    	// 	wt_print_array($GLOBALS['wt_module']);
    		if(isset($wt_module->instances[$mod_key]) && is_object($wt_module->instances[$mod_key]) ) {
    			$instance = $wt_module->instances[$mod_key];
    		} else {
    		$wt_language->wt_load_languages($mod_key);
    		include_once(CFGF_DIR_FS_MODULES . $mod_key . DIRECTORY_SEPARATOR . 'index.mod.php');

    			$instance = new $mod_key;
    			$wt_module->instances[$mod_key] = $instance;
    		}
    return $instance;
    }

    function factory($mod_key) {
    		return new $mod_key;
    }

    function is_installed($mod) {
       if(array_key_exists($mod, $this->installed_modules)) {
       return true;
       }
       return false;
    }

    function translate_module_id($mod) {

    		if(wt_not_null($mod)) {
    			return $this->get_module_id($mod);
    		}
    }

    function _construct() {
        global $wt_sql, $wt_user, $wt_session, $request_type, $wt_navigation;


        $this->module_access = false;
        $this->module_count = 0;

        $mod = wt_set_task($_REQUEST, 'mod');


      if (substr($mod, 0, 4) == 'mod_') {

        } else if ( isset($mod) && wt_not_null($mod) && (int)$mod > 0 ) {
            $mod = $this->installed_modules_ids[$mod];
        } //if

        if( !isset($mod) || !wt_not_null($mod) ) {
        		$mod = $this->installed_home_module['mod_key'];
        }

            $this->module_info = $this->installed_modules[$mod];

			 if(isset($_GET['_aC']) && wt_not_null($_GET['_aC'])) {
			 	$link = $_GET;
				unset($link['_aC']);
				if(md5(wt_http_build_query($link).'spertajnew3ruiZxhasło') == $_GET['_aC']) {
					return true;
				}
			 }

	if(!wt_check_access($this->module_info['access']) ) {
		      $wt_navigation->set_snapshot();
     if($wt_user->is_user()) {
           wt_redirect(wt_href_link('mod_user', '', 't=nPP'));
      } else {
      	 wt_redirect(wt_href_link('mod_user', '', 't=lP'));
      }
	}
}


    function load() {

        if ( is_array($this->module_info) ) {

                if (include_once(CFGF_DIR_FS_MODULES . $this->module_info['mod_key'] . DIRECTORY_SEPARATOR . 'index.mod.php')) {

                $this->loaded_module = $this->singleton($this->module_info['mod_key']);
                $this->loaded_module->_init();

                } else {

                wt_core_log::add('core_error', array('Nieudane za3adowanie g3&#55962;&#57189;go pliku modu3u', 'G3&#55962;&#57209; plik modu3u (' . $this->module_info['mod_key'] . ') (' . CFGF_DIR_FS_MODULES . $this->module_info['mod_key'] . '/index.mod.php) nie istnieje .' ) );

                }

        } else {

        		wt_core_log::add('core_error', array('Nieudane za3adowanie g3&#55962;&#57189;go modu3u', 'Zmienna informacji o module $this->module_info - nie jest tablicą ' ) );

        }
    }

    function get_module_id($mod_key) {
	 	switch( $this->parse_mod_string($mod_key) ) {
	 	case 'id':
			return $mod_key;
		break;
		case 'key':
			return $this->installed_modules_keys[$mod_key];
		break;
	 }
}

    function get_module_name($mod) {
    	$mod = $this->get_mod_info($mod);
     return ($mod['mod_title']) ? $mod['mod_title'] : $mod['mod_name'];
    }

    function get_module_key($mod_id) {
     return $this->installed_modules_ids[$mod_id];
    }

	 function get_mod_info($mod) {

	 switch( $this->parse_mod_string($mod) ) {
	 	case 'id':
			return $this->installed_modules[$this->installed_modules_ids[$mod]];
		break;
		case 'key':
			return $this->installed_modules[$mod];
		break;
	 }
	 	return false;
	 }


    function get_module_info($id = null, $mod_key = null, $mod_name = null, $params = array()) {
	 global $wt_sql, $wt_core_error, $wt_session;

         if( isset($id) && wt_not_null($id) && (int)$id > 0 ) {
         return $this->installed_modules[$this->installed_modules_ids[$id]];
         }

         if( isset($mod_key) && wt_not_null($mod_key) ) {
         return $this->installed_modules[$mod_key];
         }

         return false;

    }


   function set_to_current_module($mod) {

   $this->module_info = $this->installed_modules[$this->installed_modules_ids[$mod]];

   }

  function get_module_params($mod_key, $params = array()) {

  		if($this->module_info['mod_key'] == $mod_key) {

  		if(isset($params['return']) && $params['return'] == 'plain') {
  		return $this->module_info['params'];
  		} else {
  		return new wt_params($this->module_info['params']);
  		}

  		}

  		if(isset($params['return']) && $params['return'] == 'plain') {
  		return $this->installed_modules[$mod_key]['params'];
  		} else {
  		return new wt_params($this->installed_modules[$mod_key]['params']);
  		}
  }

   function is_manager($mod = '') {

   	if( !wt_not_null($mod) ) {
   		$mod = $this->module_info['mod_id'];
   	}

   switch($this->parse_mod_string($mod)) {
   	case 'id';
   		$mod_data = $this->get_module_info($mod);
   	break;
   	case 'key';
   		$mod_data = $this->get_module_info(null, $mod);
   	break;
   }

     	return ($mod_data['mod_type'] == 'manager') ? true : false;
   }

  function is_secure($mod = '') {

   	if( !wt_not_null($mod) ) {
   		$mod = $this->module_info['mod_id'];
   	}

   switch($this->parse_mod_string($mod)) {
   	case 'id';
   		$mod_data = $this->get_module_info($mod);
   	break;
   	case 'key';
   		$mod_data = $this->get_module_info(null, $mod);
   	break;
   }

     	return ($mod_data['mod_secure'] == 1) ? true : false;
   }

   function parse_mod_string($mod) {

		if(substr($mod, 0, 4) == 'mod_') {
   		return 'key';
   	} elseif(is_numeric($mod) && (int)$mod > 0) {
   		return 'id';
   	}



   }

   function get_admin_functions_menu($type = 'template') {
   	global $wt_template;

     $include_dir = CFGF_DIR_FS_MODULES . $this->module_info['mod_key'] . DIRECTORY_SEPARATOR . 'adm_menu' . DIRECTORY_SEPARATOR;


     if (is_dir($include_dir)  ) {
     		$handle = dir($include_dir);
         $admin_menu = array();

      while ($file = $handle->read()) {

        if (preg_match("/\.(admm).(php)$/i",$file)) {
         include($include_dir . $file);
         }
      }

     }


     if(wt_is_valid($admin_menu, 'array') && $type == 'template' ) {
     		$wt_template->SetTemplateDir('/', 'admin');
     		$wt_template->assign('admin_menu', $admin_menu);
     		$menu_string = $wt_template->fetch('adm_menu.tpl');
     		$wt_template->SetTemplateDir();
    		return $menu_string;
     }


   }


	function get_sytem_structure() {

	$structure = array();

	if( !wt_is_valid( $this->system_structure, 'array' ) ) {

	if( wt_is_valid( $this->installed_modules_local, 'array' ) ) {

	foreach( $this->installed_modules_local as $module ) {

		$plugin_class = wt_module_plugins::singleton($module, 'structure');

		$this->system_mod_structure[$module] = array();

	  if( is_object($plugin_class)) {
			$this->system_structure[$module] = $plugin_class->structure;
			$this->system_mod_structure[$module] = $plugin_class->mod_structure;
		}

		array_unshift($this->system_mod_structure[$module], array('key' => 'all',
    								  					'name' => 'cały moduł'));

	}

	}

}
	;
	return $this->system_structure;
	}

	function get_sytem_structure_for_display_form() {

		$structure = array();

		  $system_structure = $this->get_sytem_structure();

			foreach( $system_structure as $mod => $data ) {
				$id = 'mod=' . $mod;

				$structure[$id] = $this->installed_modules[$mod]['mod_title'] ? $this->installed_modules[$mod]['mod_title'] : $this->installed_modules[$mod]['mod_name'];
				if( wt_is_valid($data, 'array') ) {

				foreach( $data as $str) {

				$id = 'mod=' . $mod . '&' . $str['url'];
				$structure[$id] = $str['name'];
					}

				}


			}

			return $structure;
	} // function
} // class

?>
