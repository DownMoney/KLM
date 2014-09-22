<?php

  class wt_plugins {
    var $plugins,
        $started_plugins;

    function wt_plugins() {
    if(wt_not_null(CFGDB_PLUGINS_INSTALLED)) {
      $this->plugins = explode(';', CFGDB_PLUGINS_INSTALLED);
      } else {
      $this->plugins = array();
      }
    }

    function start_plugins() {
      $this->started_plugins = array();



      foreach ($this->plugins as $plugin) {
      	$this->start_plugin($plugin);

      }

    }

    function stop_plugins() {
      if ($this->is_started('output_compression')) {
        $key = array_search('output_compression', $this->started_plugins);
        unset($this->started_plugins[$key]);
        $this->started_plugins[] = 'output_compression';
      }
      foreach ($this->started_plugins as $plugin) {
        $this->stop_plugin($plugin);
      }
    }

    function start_plugin($plugin) {
      if(@include_once(CFGF_DIR_FS_PLUGINS . $plugin . '.plug.php')) {
      	if(@call_user_func(array('WT_Plugin_' . $plugin, 'start'))) {
	        $this->started_plugins[] = $plugin;
	      }
      }
    }

    function stop_plugin($plugin) {
      @call_user_func(array('WT_Plugin_' . $plugin, 'stop'));
    }

    function action_after_user() {
      foreach ($this->started_plugins as $plugin) {
        @call_user_func(array('WT_Plugin_' . $plugin, 'action_after_user'));
      }

    }

    function action_after_module() {
    foreach ($this->started_plugins as $plugin) {
        @call_user_func(array('WT_Plugin_' . $plugin, 'action_after_module'));
      }
    }



    function action_after_block() {
      foreach ($this->started_plugins as $plugin) {
        @call_user_func(array('WT_Plugin_' . $plugin, 'action_after_block'));
      }
    }

    function action_before_load() {
      foreach ($this->started_plugins as $plugin) {
        @call_user_func(array('WT_Plugin_' . $plugin, 'action_before_load'));
      }
    }

    function is_started($plugin) {
      return in_array($plugin, $this->started_plugins);
    }

	 function load_module_plugins($plugin) {
     	global $wt_module;
				$mod_plugins = array();
				if( wt_is_valid($wt_module->installed_modules_ids, 'array') ) {
					foreach($wt_module->installed_modules_ids as $m) {
						if(@include_once(CFGF_DIR_FS_MODULES . $m . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plugin . '.plug.php')) {
							$mod_plugins[$m] = $m;
						}
					}

				}
			 return $mod_plugins;
    }


	 function register_action($module, $action = null, $function) {
     	global $wt_plugins;
			if(wt_not_null($action)) {
				$wt_plugins->_actions[$module]['actions'][$action][] = $function;
			} else {
				$wt_plugins->_actions[$module]['globals'][] = $function;
			}

    }


	 function run_action($module, $action, $mod_action, $iID) {
     	global $wt_plugins;
		if(wt_is_valid($wt_plugins->_actions[$module]['actions'][$action], 'array')) {
			foreach($wt_plugins->_actions[$module]['actions'][$action] as $func) {
				@call_user_func($func, $module, $action, $mod_action, $iID);
			}

		}

    }//function


  }
?>
