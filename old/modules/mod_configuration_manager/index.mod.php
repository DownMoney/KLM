<?php 
class mod_configuration_manager {
	var $task;
	var $action;
	var $mode;
	var $module_dir;
	var $module_class;
	var $module_key = 'mod_configuration_manager';

	var $sort_order_filter = array(
   						   'configuration' => array('c.configuration_id', 'c.configuration_title', 'c.configuration_key')
   						   	);


	function mod_configuration_manager() {
		$this->module_dir = dirname(__FILE__);
		$this->module_class = get_class($this);
		$this->set_sort_order();
	}
	
	function set_sort_order($table = 'configuration', $default = '0a') {
  		global $wt_session;
		$sort = wt_set_task($_GET, 'sort');
		$sort_orders = $wt_session->value('sort_orders');
		if( !wt_not_null($sort_orders[$table]) ) {
			$sort_orders[$table] = $default;
		}
		if( wt_not_null($sort) && wt_not_null( $this->sort_order_filter[$table][(int)$sort] ) )	{
			$sort_orders[$table] = $sort;
		}
		$wt_session->set('sort_orders', $sort_orders);	
  	}	  
	
	function get_db_sort_order($table = 'configuration') {	
		global $wt_session;
		$sort_orders = $wt_session->value('sort_orders');
		if (wt_not_null($sort_orders[$table])) {
			return 	wt_get_sort_order_for_items_to_db($this->sort_order_filter[$table], null, $sort_orders[$table]);		  			
		} else {
			return 	wt_get_sort_order_for_items_to_db($this->sort_order_filter[$table], null, "0a");		  			
		}
  	}

	function get_module_path() {
		return dirname(__FILE__);
	}

	function get_module_class() {
		return $this->module_class;
	}

	function __construct() {
		$class_name = __CLASS__;
		$this->$class_name();
	}

	function _init() {
		$this->task = wt_set_task($_REQUEST, 't');
		$this->action = wt_set_task($_REQUEST, 'a');
		$this->mode = wt_set_task($_REQUEST, 'm');
		
 	if(wt_not_null($this->action))  {	
		$cache = new wt_cache();
		$cache->clear(array('config'));
		unset($cache);
		
		switch($this->action) {
			case 'saveConfiguration':
				$this->saveConfiguration();
				break;
			case 'delConfiguration':
				$this->delConfiguration();
				break;
		}
	}
		if(!wt_not_null($this->action))  {
			switch ($this->task) {
       			case 'mP':
       				$this->mode = 'configuration';
       				$this->task = 'configuration';
        			break;
			}
			switch ($this->mode) {
				default:
				case 'configuration':
					switch($this->task) {
						default:
						case 'configuration':
						case 'searchConfiguration':
							$this->configuration();
							break;
						case 'addConfiguration':
							$this->addConfiguration();
							break;
						case 'configurationInfo':
							$this->configurationInfo();
							break;
					}
					break;
			}
		}
	}

	
	function mainPage() {
		global $wt_template, $wt_sql, $wt_session;
				
		$stats = array();
		
		$wt_template->assign('stats',$stats);
		$wt_template->tFile = 'theme_list';
		$wt_template->load_file('mainPage');
	}

	function configuration() {
		global $wt_template;
		
		$gSearch = trim(strip_tags(wt_set_task($_GET, 'gSearch')));
		$params = array();   	
		if( wt_not_null($gSearch) ) {
			if(wt_parse_search_string($gSearch, $parsed_string)) {
				$params['where'] .= wt_parse_array_to_query($parsed_string, array('c.configuration_title','c.configuration_key'));
	 		} 
		}
		$configuration_listing = $this->get_configuration(null, $params);
		$wt_template->assign('configuration_listing', $configuration_listing);
		$number_of_rows_text = $this->configuration_split_listing->display_count($this->db_configuration_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z %s rekordów)');
		$wt_template->assign('number_of_rows_text', $number_of_rows_text);
		$number_of_rows_links = $this->configuration_split_listing->display_links($this->db_configuration_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
		$wt_template->assign('number_of_rows_links', $number_of_rows_links);
		$wt_template->assign('display_to_display',  $this->configuration_split_listing->display_to_display());
		$wt_template->tFile = 'theme_list';
		$wt_template->load_file('configuration.tpl');
	}
	
	function configurationInfo() {
		global $wt_template,$wt_sql, $wt_module;
		
		$wt_template->display_self = true;
		$cID = wt_set_task($_REQUEST, 'cID');
		if( wt_is_valid($cID, 'int', '0') ) {
	    	$item=$this->get_configuration($cID);
			$wt_template->assign('item',$item);			
		} 
		$wt_template->load_file('configurationInfo');
	}

	
	function delConfiguration($cID = '') {
		global $wt_sql;

		if(!wt_not_null($dID)) {
			$cID = wt_set_task($_REQUEST, 'cID');
		}
		if(wt_not_null($cID)) {
			$wt_sql->db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_id = '" . $cID . "'");
		}
		die('ok');
	}
	
	function saveConfiguration($data = array()) {
		global $wt_sql, $wt_session, $wt_user;

		$outside_action = false;
		if( wt_is_valid($data, 'array') ) {
			$data_array = $data;
			unset($data);
			$outside_action = true;
		} else {
			$data_array = $_POST;
			unset($_POST);
		}
		$data_array = $wt_sql->db_prepare_input($data_array);
		if( wt_is_valid($data_array['cID'], 'int', '0') ) {
			$action = 'save';
			$cID = $data_array['cID'];
		} else {
			$action = 'add';
		}
		$sql_configuration_data_array = array('configuration_title' => $data_array['configuration_title'],
											'configuration_key' => $data_array['configuration_key'],
											'configuration_value' => $data_array['configuration_value'],
											);
		if($action == 'add') {
			$sql_configuration_data_array['date_added'] = 'now()';
			$wt_sql->db_perform(TABLE_CONFIGURATION, $sql_configuration_data_array);
			$cID = $wt_sql->db_insert_id();
		}
		if($action == 'save') {
			$sql_configuration_data_array['last_modified'] = 'now()';
			$wt_sql->db_perform(TABLE_CONFIGURATION, $sql_configuration_data_array, 'update', 'configuration_id = ' . $cID);
		}
		if( $outside_action === true ) {
			return $cID;
		} else {
			$site_url = wt_href_link('mod_configuration_manager', '', 'm=configuration');
			$wt_session->set('site_url', $site_url);
			if( $action == 'add' ) {
				$form_url = wt_href_link('mod_configuration_manager', '', 'm=configuration&t=addConfiguration&cID=' . $cID);
				$wt_session->set('form_url', $form_url);
			}
	
			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action));
		}
	}
	
	function addConfiguration() {
		global $wt_template;

		$wt_template->display_self = true;   
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addConfiguration.php');
	}
	
	function get_configuration($conf_id = '', $params = array() ) {
		global $wt_sql, $wt_session;

		if(wt_not_null($conf_id)) {
			$db_conf_query_raw = "SELECT * FROM " . TABLE_CONFIGURATION . " c WHERE ".((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " c.configuration_id = '".$conf_id."' ";
		} else {
			$db_conf_query_raw = "SELECT * FROM " . TABLE_CONFIGURATION . " c ". ((isset($params['where']) && wt_not_null($params['where'])) ? "WHERE ".$params['where'] : '' );
			if( isset($params['order']) && wt_not_null($params['order']) ) {
	  			$db_conf_query_raw .= " ORDER BY " . $params['order'] . " ";	
	  		} elseif (!isset($params['order'])) {
	  			$db_conf_query_raw .= " ORDER BY " . $this->get_db_sort_order() . " ";
	  		}
	  		if(!isset($params['dsplit'])) { 
      			$this->configuration_split_listing =  new splitPageResults($_GET['page'], MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $db_conf_query_raw, $this->db_configuration_query_numrows, '*', $wt_sql);
	  		}
		}
		$conf_array = array();
		$db_conf_query = $wt_sql->db_query($db_conf_query_raw);
		while($db_conf = $wt_sql->db_fetch_array($db_conf_query)) {
			if(wt_not_null($conf_id)) {
				$dc_array = $db_conf;
			} else {
				$dc_array[] = $db_conf;
			}
		}
		return $wt_sql->db_output_data($dc_array);
	}

	function _mod_menu($params = array(), $admin = false ) {
		//$this->wt_navigationbar($params);
   		$menu_data[] = array('mod_ico' => true,	
							 'href' => wt_href_link('mod_configuration_manager'),
							 'ico' => $this->module_key);
		if( $admin === true ) {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu_admin.php');
		} else {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu.php');
		} 
	 	return $menu_data;
	 }
	 
 /* 
function _structureJSTree($data = false) {
    	global $wt_template;
		$structure = array();
	 	if( $data === true ) {	  
	 		$item=array('type' => 'folder',
  				          'status' => '1',
  						  'name' => 'Konfiguracja',
  						  'url' => wt_href_link('mod_configuration_manager', '', 'm=configuration') 
  						  );
	 		$items=array();
	 		$items[]=$item;
  			$structure['children'] = $items;
	 	} else {
  			$structure = array('title' => 'Konfiguracja',
							   'ico' => '',
							   'link' => wt_href_link('mod_configuration_manager', '', 't=mP'),
							   'target' => 'site',
							   'url' => wt_href_link('mod_configuration_manager', '', 't=mP') );
 		}	
		return $structure;
	}   
 */

} // class


  ?>