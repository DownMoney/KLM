<?php 
class mod_system_dictionary_manager {
	var $task;
	var $action;
	var $mode;
	var $module_dir;
	var $module_class;
	var $module_key = 'mod_system_dictionary_manager';

	var $sort_order_filter = array(
   						   'dictionary' => array('d.dc_id', 'dd.dc_name', 'd.dc_key','d.mod_key','d.dc_section')
   						   	);


	function mod_system_dictionary_manager() {
		$this->module_dir = dirname(__FILE__);
		$this->module_class = get_class($this);
	}
	
	function set_sort_order($table = 'dictionary', $default = '0a') {
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
	
	function get_db_sort_order($table = 'dictionary') {	
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
		$this->set_sort_order();
		switch($this->action) {
			case 'saveDefinition':
			case 'quickSaveDefinition':
				$this->saveDefinition();
				break;
			case 'delDefinition':
				$this->delDefinition();
				break;
		}

		if(!wt_not_null($this->action))  {
			switch ($this->task) {
       			case 'mP':
       				$this->mode = 'dictionary';
       				$this->task = 'definitions';
        			break;
			}
			switch ($this->mode) {
				default:
				case 'dictionary':
					switch($this->task) {
						default:
						case 'definitions':
							$this->definitions();
							break;
						case 'addDefinition':
							$this->addDefinition();
							break;
						case 'definitionInfo':
							$this->definitionInfo();
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

	function definitions() {
		global $wt_template;
		
		$dP = array(); 
		$iSearch = wt_set_task($_REQUEST, 'iSearch');
		if(wt_is_valid($iSearch,'array')) {
			if(wt_not_null($iSearch['mod_key'])) {
				$dP['where'] .= " d.mod_key='".$iSearch['mod_key']."' AND ";
			}
			if(wt_not_null($iSearch['dc_section'])) {
				$dP['where'] .= " d.dc_section='".$iSearch['dc_section']."' AND ";
			}
		}
				
		$definitions_listing = $this->get_definitions(null, $dP);
		$wt_template->assign('definitions_listing', $definitions_listing);
		$number_of_definitions_text = $this->definitions_split_listing->display_count($this->db_definitions_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z %s rekordów)');
		$wt_template->assign('number_of_rows_text', $number_of_definitions_text);
		$number_of_definitions_links = $this->definitions_split_listing->display_links($this->db_definitions_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
		$wt_template->assign('number_of_rows_links', $number_of_definitions_links);
		$wt_template->assign('display_to_display',  $this->definitions_split_listing->display_to_display());
		$wt_template->tFile = 'theme_list';
		$wt_template->load_file('definitions.tpl');
	}
	
	function definitionInfo() {
		global $wt_template,$wt_sql, $wt_module;
		
		$wt_template->display_self = true;
		$dID = wt_set_task($_REQUEST, 'dID');
		if( wt_is_valid($dID, 'int', '0') ) {
	    	$item=$this->get_definitions($dID);
			$wt_template->assign('item',$item);			
		} 
		$wt_template->load_file('definitionInfo');
	}
	
	function delDefinition($dID = '') {
		global $wt_sql;

		if(!wt_not_null($dID)) {
			$dID = wt_set_task($_REQUEST, 'dID');
		}

		if(wt_not_null($dID)) {
			$wt_sql->db_query("DELETE FROM " . TABLE_MOD_SYSTEM_DICTIONARY . " WHERE dc_id = '" . $dID . "'");
			$wt_sql->db_query("DELETE FROM " . TABLE_MOD_SYSTEM_DICTIONARY_DESC . " WHERE dc_id = '" . $dID . "'");
		}
		die('ok');
	}
	
	function saveDefinition($data = array()) {
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
		if( wt_is_valid($data_array['dID'], 'int', '0') ) {
			$action = 'save';
			$dID = $data_array['dID'];
		} else {
			$action = 'add';
		}
		$sql_definition_data_array = array('mod_key' => $data_array['mod_key'],
											'dc_section' => $data_array['dc_section'],
											'dc_key' => $data_array['dc_key'],
											);
		if($action == 'add') {
			$wt_sql->db_perform(TABLE_MOD_SYSTEM_DICTIONARY, $sql_definition_data_array);
			$dID = $wt_sql->db_insert_id();
		}
		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_SYSTEM_DICTIONARY, $sql_definition_data_array, 'update', 'dc_id = ' . $dID);
		}
		$sql_definition_desc_data_array = array('dc_name' => $data_array['dc_name'],
												'dc_desc' => $data_array['dc_desc'],
												'language_id' => $wt_session->value('languages_id'));
		if($action == 'add') {
			$sql_definition_desc_data_array['dc_id'] = $dID;
			$wt_sql->db_perform(TABLE_MOD_SYSTEM_DICTIONARY_DESC, $sql_definition_desc_data_array);
		}
		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_SYSTEM_DICTIONARY_DESC, $sql_definition_desc_data_array, 'update', 'dc_id = ' . $dID);
		}
		
		if( $outside_action === true ) {
			return $dID;
		} else {
			$site_url = wt_href_link('', '', wt_get_all_get_params( array('a', 'm', 't', 'dID') ) . 'm=dictionary');
			$wt_session->set('site_url', $site_url);			
	 	
			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action . '&dRT=1'));
		
		}

	}
	
	function addDefinition() {
		global $wt_template;

		$wt_template->display_self = true;   
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addDefinition.php');
	}
	
	function get_definition_for_form($mod_key, $dc_section, $params = array() ) {
		$Dparams = array();
		$Dparams['where'] = " d.mod_key = '" . $mod_key . "' AND d.dc_section='" . $dc_section . "' AND ";
		$dictionary_data = $this->get_definitions(null, $Dparams);
		$dictionary_array = array();
		if(!isset($params['dont_add_blank']) ) {
			$dictionary_array[0] = ' --- wybierz --- ';
		}
		foreach($dictionary_data as $dd) {
			if($params['group_keys'] == true) {
				$dictionary_array[$dd['dc_key']] = $dd['dc_name'];
			} else {
				$dictionary_array[$dd['dc_id']] = $dd['dc_name'];
			}
			
		}
		asort($dictionary_array);
		return $dictionary_array;
	}


	function get_definitions($dc_id = '', $params = array() ) {
		global $wt_sql, $wt_session;

		if(wt_not_null($dc_id)) {
			$db_dc_query_raw = "SELECT * FROM " . TABLE_MOD_SYSTEM_DICTIONARY . " d, " . TABLE_MOD_SYSTEM_DICTIONARY_DESC . " dd WHERE " . ( (isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '' ) . " d.dc_id = dd.dc_id  AND dd.language_id = '" . $wt_session->value('languages_id') . "' AND d.dc_id = '" . $dc_id . "'";
		} else {
			$db_dc_query_raw = "SELECT * FROM " . TABLE_MOD_SYSTEM_DICTIONARY . " d, " . TABLE_MOD_SYSTEM_DICTIONARY_DESC . " dd WHERE " . ( (isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '' ) . " d.dc_id = dd.dc_id  AND dd.language_id = '" . $wt_session->value('languages_id') . "'";
			if( isset($params['order']) && wt_not_null($params['order']) ) {
	  			$db_dc_query_raw .= " ORDER BY " . $params['order'] . " ";	
	  		} elseif (!isset($params['order'])) {
	  			$db_dc_query_raw .= " ORDER BY " . $this->get_db_sort_order('dictionary') . " ";
	  		}
	  		if(!isset($params['dsplit'])) { 
      			$this->definitions_split_listing =  new splitPageResults($_GET['page'], MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $db_dc_query_raw, $this->db_definitions_query_numrows, '*', $wt_sql);
	  		}
		}
		$dc_array = array();
		$db_dc_query = $wt_sql->db_query($db_dc_query_raw);
		while($db_dc = $wt_sql->db_fetch_array($db_dc_query)) {
			if(wt_not_null($dc_id)) {
				$dc_array = $wt_sql->db_output_data($db_dc);
			} else {
				$dc_array[] = $wt_sql->db_output_data($db_dc);
			}
		}
		return $dc_array;
	}

	function _mod_menu($params = array(), $admin = false ) {
		//$this->wt_navigationbar($params);
   		$menu_data[] = array('mod_ico' => true,	
							 'href' => wt_href_link('mod_products_manufacturers_manager'),
							 'ico' => $this->module_key);
		if( $admin === true ) {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu_admin.php');
		} else {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu.php');
		} 
	 	return $menu_data;
	 }
	 
	function _structureJSTree($data = false) {
    	global $wt_sql,$wt_session;
		$structure = array();
	 	if( $data === true ) {	  
		
			$db_mod_query = $wt_sql->db_query("SELECT DISTINCT(sd.mod_key), md.mod_title FROM ".TABLE_MOD_SYSTEM_DICTIONARY." sd, ".TABLE_MODULES." m, ".TABLE_MODULES_DESCRIPTION." md WHERE sd.mod_key = m.mod_key AND m.mod_id = md.md_id  AND md.language_id = '".$wt_session->value('languages_id')."'");
			
			$structure['children'][] = array('type' => 'folder',
  				          						'status' => '1',
						  						   'name' => 'Cała strona',
						  						   'url' => wt_href_link('mod_system_dictionary_manager', '', 'm=dictionary&iSearch[mod_key]=all')
						  						  );
			
			while($db_mod = $wt_sql->db_fetch_array($db_mod_query)) {
				$db_mod = $wt_sql->db_output_data($db_mod);
				
				$db_section_query = $wt_sql->db_query("SELECT DISTINCT(sd.dc_section) FROM ".TABLE_MOD_SYSTEM_DICTIONARY." sd WHERE sd.mod_key='".$db_mod['mod_key']."' ");
					$sections = array();
				while($db_section = $wt_sql->db_fetch_array($db_section_query)) {
					$sections[] = array('type' => 'doc',
  				          						'status' => '1',
						  						   'name' => $db_section['dc_section'],
						  						   'url' => wt_href_link('mod_system_dictionary_manager', '', 'm=dictionary&iSearch[mod_key]='.$db_mod['mod_key'].'&iSearch[dc_section]='.$db_mod['dc_section'])
						  						  );
				}
				
$structure['children'][] = array('type' => 'folder',
  				          						'status' => '1',
						  						   'name' => $db_mod['mod_title'],
						  						   'url' => wt_href_link('mod_system_dictionary_manager', '', 'm=dictionary&iSearch[mod_key]='.$db_mod['mod_key']),
													'docs' => $sections
						  						  );
	  		}
		
	 	} else {
  			$structure = array('title' => 'Słownik danych',
							   'ico' => '',
							   'link' => wt_href_link('mod_system_dictionary_manager', '', 't=mP'),
							   'target' => 'site',
							   'url' => wt_href_link('mod_system_dictionary_manager', '', 't=mP') );
 		}	
		return $structure;
	}   

} // class


  ?>
