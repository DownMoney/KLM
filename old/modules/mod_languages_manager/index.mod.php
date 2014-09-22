<?php 
class mod_languages_manager {
			
         var $task;
   		var $action;
  		   var $mode;
   		var $module_dir;
   		var $module_class;
   		var $module_key = 'mod_languages_manager';   
   		
   		var $sort_order_filter = array(
   								   'texts' => array('lt.txt_id', 'lt.txt_value', 'lt.mod_id', 'lt.txt_key'),
   								   					);
	function mod_languages_manager() {
   		global $wt_module, $wt_sql;

   		$this->module_dir = dirname(__FILE__);
		$this->module_class = get_class($this);
		$this->module_key = basename($this->module_dir);
		$this->module_params = $wt_module->get_module_params($this->module_key); 		
		if($this->module_params->get('db_us_this_db') == '1' && wt_not_null($this->module_params->get('db_host')) && wt_not_null($this->module_params->get('db_user')) && wt_not_null($this->module_params->get('db_database'))) { 
  			$db_host = $this->module_params->get('db_host');
  			$db_user = $this->module_params->get('db_user');
  			$db_password = $this->module_params->get('db_password');
  			$db_database = $this->module_params->get('db_database');
  			$this->db_prefix = $this->module_params->get('db_prefix');
  			$db_silent_mode = $this->module_params->get('db_silent_mode');
  			$db_persistant = $this->module_params->get('db_persistant');
  			$this->db = new wt_sql($db_host, $db_user, $db_password, $db_database, NULL, $db_silent_mode, $db_persistant);
  		} else {
  			$this->db = &$wt_sql;
  		}	    
   }
   
   
  	function set_sort_order($table = 'texts', $default = '2a') {
		global $wt_session,$wt_template;
		$sort = wt_set_task($_GET, 'sort');
		$sort_orders = $wt_session->value('sort_orders');
		if( !wt_not_null($sort_orders[$this->module_key][$table]) ) {
			$sort_orders[$this->module_key][$table] = $default;
		}
		if( wt_not_null($sort) && wt_not_null( $this->sort_order_filter[$table][(int)$sort] ) )	{
			$sort_orders[$this->module_key][$table] = $sort;
		}
		$wt_session->set('sort_orders', $sort_orders);
		$wt_template->assign('sort_orders', $sort_orders[$this->module_key]);
	}

	function get_db_sort_order($table = 'texts') {
		global $wt_session;
		$sort_orders = $wt_session->value('sort_orders');
		return 	wt_get_sort_order_for_items_to_db($this->sort_order_filter[$table], null, $sort_orders[$this->module_key][$table]);
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
/**
* Inicjalizacja klasy
*/            
	function _init() {
    	global $wt_session;
		$this->task = wt_set_task($_REQUEST, 't');
  		$this->action = wt_set_task($_REQUEST, 'a');
		$this->mode = wt_set_task($_REQUEST, 'm');
  				
  		//$this->wt_navigationbar();
        
  		switch($this->action) {
        	
            case 'saveText':
             	$this->saveText();
             	break;
            case 'delText':
             	$this->delText();
             	break;
            case 'generateFiles':
            	$this->generateFiles();
            	break;
            case 'generateFile':
            	$this->generateFile();
            	break;
            case 'generateAllFiles':
            	$this->generateAllFiles();
            	break;
            case 'checkUniqueKey':
            	$this->checkUniqueKey();
            	break;
            case 'test':
//					
				die();
       	}
        
        if(!wt_not_null($this->action))  { 
       		switch ($this->mode) {
       			default:
    			case 'texts':
    				$this->set_sort_order('texts','0a');
	    			switch($this->task) { 
	    				default:
	    				case 'searchText':
	    					$this->texts();
	    					break;
	    				case 'addText':
     						$this->addText();
     						break;
	    				case 'textInfo':
	    					$this->textInfo();
	    					break;
	   			}
    			break;
    		}
     	}
	}
	   
	function texts() {
		global $wt_template, $wt_sql, $wt_session;
    	
    	$params = array();   
    	$params['group'] = 'lt.txt_key';
    	$params['count_missing'] = true;	
	   	$iSearch = wt_set_task($_GET, 'iSearch');
		$gSearch = trim(strip_tags(wt_set_task($_GET, 'gSearch')));
    	$mod_id = wt_set_task($_GET,'mod_id');	
    	$mod_type = wt_set_task($_GET,'mod_type');	
    	
    	if( wt_is_valid($iSearch, 'array') ) {
    		if(wt_not_null($iSearch['mod_id'])) {
	  			$params['where'] .= "lt.mod_id = '" . (int)$iSearch['mod_id'] . "' AND ";
	  		}
	    	if(isset($iSearch['txt_value']) && wt_not_null($iSearch['txt_value'])) {
     			$params['where'] .= "lt.txt_value LIKE '%" . $this->db->db_input($iSearch['txt_value']) . "%' AND ";
     		}
        	if(isset($iSearch['txt_key']) && wt_not_null($iSearch['txt_key'])) {
	     		$params['where'] .= "lt.txt_key LIKE '%" . $this->db->db_input($iSearch['txt_key']) . "%' AND ";
    	 	}
    	}
    	$gSearch = trim(strip_tags(wt_set_task($_GET, 'gSearch')));
		if( wt_not_null($gSearch) ) {
			$search = true;
			if(wt_parse_search_string($gSearch, $parsed_string)) {
				$params['where'] = wt_parse_array_to_query($parsed_string, array('lt.txt_value','lt.txt_key')). " AND ";
			}
		}
		global $wt_module, $wt_language;
		if (wt_is_valid($mod_id,'int','0') || $mod_id==-1) {
			$params['where'].=" lt.mod_id=".$mod_id." AND ";
			$item = $wt_module->installed_modules[$wt_module->installed_modules_ids[$mod_id]];
			$wt_template->assign('item_data',$item);
		} else { 
			if (wt_not_null($mod_type)) {
				
				if ($mod_type=='l') {
					if (wt_is_valid($wt_module->installed_modules_local,'array')) {
						foreach ($wt_module->installed_modules_local as $mod_key) {
							$mod_ids[] = $wt_module->installed_modules_keys[$mod_key];
						}
					}
				} elseif ($mod_type=='m' && wt_is_root()) {
					if (wt_is_valid($wt_module->installed_modules_manager,'array')) {
						foreach ($wt_module->installed_modules_manager as $mod_key) {
							$mod_ids[] = $wt_module->installed_modules_keys[$mod_key];
						}
					}
				}
				$params['where'].=" lt.mod_id IN(".implode(',',$mod_ids).") AND ";
			}
		}
		$params['where'].=" lt.language_id=".$wt_session->value('languages_id')." ";
		
		
		$texts_listing = $this->get_texts(null,$params);
	
        $wt_template->assign('texts_listing', $texts_listing);
        $number_of_news_text = $this->split_listing->display_count($this->db_texts_query_numrows, MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z %s rekordów)');
	    $wt_template->assign('number_of_rows_text', $number_of_news_text);
    	$number_of_news_links = $this->split_listing->display_links($this->db_texts_query_numrows, MAX_ADMIN_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
        $wt_template->assign('number_of_rows_links', $number_of_news_links);
	  	$wt_template->assign('display_to_display', $this->split_listing->display_to_display());	
        include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'searchText_form.php');	
	  	$wt_template->tFile = 'theme_list';
        $wt_template->load_file('texts.tpl');
    }
    
	function textInfo() {
		global $wt_template,$wt_sql, $wt_module, $wt_language;
		
		$wt_template->display_self = true;
		$tID = wt_set_task($_REQUEST, 'tID');
		if( wt_is_valid($tID, 'int', '0') ) {
	    	$params['all_values'] = true;
			$item=$this->get_texts($tID,$params);
			$wt_template->assign('item',$item);			
			$wt_template->assign('languages',$wt_language->catalog_languages);
		} 
		$wt_template->load_file('textInfo');
	}


	function delText($txt_id = null) {
		global $wt_sql, $wt_message_stack;

		if(wt_is_valid($txt_id,'int','0')) {
			$outside_action = true;
		} else {
			$txt_id = wt_set_task($_REQUEST, 'tID');
			$outside_action = false;
		}
		if(wt_not_null($txt_id)) {
			$this->db->db_query("DELETE FROM " . TABLE_LANGUAGES_TEXTS . " WHERE txt_id = '" . (int)$txt_id . "'");
		}
		if($outside_action === true) {
			return true;
		} else {
			die('ok');
		}
	}
      
	function checkUniqueKey() {
		global $wt_module;
		
		$key = wt_set_task($_GET,'key');
		$ignore = wt_set_task($_GET,'ignore');
		$mod_id = wt_set_task($_GET,'mod_id');
		
		if (wt_not_null($key)) {
			$whole_key = 'TEXT_';
			if ($mod_id!=-1) {
				$whole_key.= strtoupper($wt_module->installed_modules_ids[$mod_id]).'_';
			}
			$whole_key.=$key;
			if (wt_not_null($ignore)) {
				$ignore = wt_clear_empty_id($ignore);
				$where = ' AND txt_id NOT IN('.$ignore.') ';
			}
			$db_query = $this->db->db_query("SELECT COUNT(*) AS total FROM ".TABLE_LANGUAGES_TEXTS." WHERE txt_key='".$whole_key."' ".$where);
			$db_data = $this->db->db_fetch_array($db_query);
			if ($db_data['total']==0) {
				die('ok');
			} else {
				die('not_unique');
			}
			//echo 	"SELECT COUNT(*) AS total FROM ".TABLE_LANGUAGES_TEXTS." WHERE txt_key='".$whole_key."' ".$where;
		} else {
			die('no_key');
		}
	}
	
	function generateAllFiles() {
		$result = $this->generateFiles();
		if ($result==1) {
			die('wygenerowano pliki');
		} else {
			die('nie znaleziono wpisów do wygenerowania');
		}
		
	}
	
	function generateFile() {
		$mod_id = wt_set_task($_GET,'mID');
		$result = $this->generateFiles($mod_id);
		if ($result==1) {
			die('ok');
		} else {
			die('no_text');
		}
	}
	
	function generateFiles($mod_id = null) {
		global $wt_language, $wt_module;
		
		$params = array();
		$params['dsplit'] = true;
		$params['order'] = ' lt.txt_id ';
		if (wt_is_valid($mod_id,'int','0')) {
			$params['where'] = " lt.mod_id=".$mod_id." ";
		}
		$texts = $this->get_texts(null,$params);
		$prepared_texts = array();
		$languages = array();
		if (wt_is_valid($wt_language->catalog_languages,'array')) {
			foreach ($wt_language->catalog_languages as $language) {
				$languages[$language['id']] = $language;
			}
		}
		if (wt_is_valid($texts,'array')) {
			foreach ($texts as $text) {
				$prepared_texts[$text['mod_id']][$text['language_id']][$text['txt_key']] = $text['txt_value'];
			}
			foreach ($prepared_texts as $mod_id => $data) {
				$directory = CFGF_DOCUMENT_FS_ROOT.'languages';
				if ($mod_id!=-1) {
					$directory .= DIRECTORY_SEPARATOR.$wt_module->installed_modules_ids[$mod_id];
				}
				if(!is_dir($directory)) {
					wt_create_dir_structure($directory);
					$create_file = @fopen($directory . DIRECTORY_SEPARATOR . 'index.html', 'w');
					@fclose($create_file);
				}
				foreach ($data as $language_id => $values) {
					$filename = $directory.DIRECTORY_SEPARATOR.$languages[$language_id]['directory'].'.lang.php';
					$file = fopen($filename,'w');
					if ($file!=false) {
						fwrite($file,"<?php\n");
						foreach ($values as $key => $value) {
							fwrite($file,"define('".$key."', '".preg_replace("%(?<!\\\\)'%", "\\'", $value)."');\n");
						}
						fwrite($file,"?>");
					}
					fclose($file);
				}
			}
		} else {
			return -1;
		}
		return 1;
	}
        
  function saveText($data = array()) {
    	global $wt_sql, $wt_session, $wt_user, $wt_module;
        
    	$outside_action = false;
     
     	if(wt_not_null($data)) {
     		$text_array = $this->db->db_prepare_input($data);
     		$outside_action = true;
     	} else {
     		$text_array = $this->db->db_prepare_input($_POST);
     	}
     	     	
		if(wt_is_valid($text_array['tID'],'int','0')) {
     		if($text_array['action_save'] == 'save_as_new') {
    	      	$action = 'add';     
          	} else {
				$action = 'save';
     			$tID = $text_array['tID'];
          	}
     	} else {
     		$action = 'add';
     	}
     	$mod_text = strtoupper($wt_module->installed_modules_ids[$text_array['mod_id']]);
     	if (wt_not_null($mod_text)) {
     		$mod_text=$mod_text.'_';
     	}
     	$sql_text_data_array = array('mod_id' => $text_array['mod_id'],
			//							'language_id' => $text_array['language_id'],
										'txt_key' => 'TEXT_'.$mod_text.$text_array['txt_key'],
		//								'txt_value' => $text_array['txt_value'],
									); 	
		if (wt_is_valid($text_array['txt_value'],'array')) {
			foreach ($text_array['txt_value'] as $ln_id => $value) {
				$sql_text_data_array['language_id'] = $ln_id;
				$sql_text_data_array['txt_value'] = $value;
				if (wt_is_valid($text_array['txt_id'][$ln_id],'int','0') && $action=='save') {
					if (wt_not_null($value)) {
						$sql_text_data_array['last_modified'] = 'now()';
		  				$sql_text_data_array['modified_by'] = $wt_user->usr_info['usr_id'];
		  	  			$this->db->db_perform(TABLE_LANGUAGES_TEXTS, $sql_text_data_array, 'update', "txt_id='".$text_array['txt_id'][$ln_id]."' LIMIT 1");
					} else {
						$this->db->db_query("DELETE FROM ".TABLE_LANGUAGES_TEXTS." WHERE txt_id=".$text_array['txt_id'][$ln_id]);
					}
				} else {
					if (wt_not_null($value)) {
						$sql_text_data_array['date_added'] = 'now()';
						$sql_text_data_array['added_by'] = $wt_user->usr_info['usr_id'];
				  		$this->db->db_perform(TABLE_LANGUAGES_TEXTS, $sql_text_data_array);
							
				  		$tID = $this->db->db_insert_id();
					}
				}
			}
		}
									
    	if($outside_action === true)   {
			return $tID;
		} else {
			if( $text_array['submit_type'] == 'save_close' ) {
				switch($text_array['action_after']) {
					case 'add_new':
						$action = 'add';
						$text_array['submit_type'] = 'save';
						$form_url = wt_href_link('mod_languages_manager', '', wt_get_all_get_params( array('a', 'm', 't') ) . 'm=texts&t=addText&action_after=' . $text_array['action_after']);
						$wt_session->set('form_url', $form_url);
						break;
					case 'edit':
						$action = 'add';
						$text_array['submit_type'] = 'save';
						$form_url = wt_href_link('mod_languages_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'tID') ) . 'm=texts&t=addText&tID=' . $tID . '&action_after=' . $text_array['action_after']);
						$wt_session->set('form_url', $form_url);
						break;
				}
			} else {
				if( $action == 'add'  ) {
					$form_url = wt_href_link('mod_languages_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'tID') ) .  'm=texts&t=addText&tID=' . $tID);
					$wt_session->set('form_url', $form_url);
				}
			}
			$site_url = wt_href_link('mod_languages_manager', '', wt_get_all_get_params( array('m') ) . 'm=texts');
			/*echo $form_url."<br />";
			echo $site_url."<br />";
			die();*/
			$wt_session->set('site_url', $site_url);
			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $text_array['submit_type'] . '&opA=' . $action . '&dRT=1&dRL=' . !$text_array['list_fields_changed']));
		}

/*

		if($outside_action === true)   {
			return $iID;
		} else {

			if( $data_array['submit_type'] == 'save_close' ) {
				switch($data_array['action_after']) {
					case 'add_new':
						$action = 'add';
						$data_array['submit_type'] = 'save';
						$form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't') ) . 't=addItem&cPath='.$data_array['cPath'] . '&action_after=' . $data_array['action_after']);
						$wt_session->set('form_url', $form_url);
						break;
					case 'edit':
						$action = 'add';
						$data_array['submit_type'] = 'save';
						$form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'iID') ) . 't=addItem&cPath='.$data_array['cPath'] . '&iID=' . $iID . '&action_after=' . $data_array['action_after']);
						$wt_session->set('form_url', $form_url);
						break;
				}
			} else {
				if( $action == 'add'  ) {
					$form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'iID') ) .  't=addItem&cPath='.$data_array['cPath'] . '&iID=' . $iID);
					$wt_session->set('form_url', $form_url);
				}
			}
			$site_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('m', 'cPath') ) . 'cPath='.$data_array['cPath']);
			$wt_session->set('site_url', $site_url);

			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action . '&dRT=' . !$data_array['tree_fields_changed'] . '&dRL=' . !$data_array['list_fields_changed']));

		}
*/

   	} // function
    
           
	function addText() {
		global $wt_template;
        
		/*wt_load_editor('fckeditor');
     	$init_editor[] = array('name' => 'txt_value', 
    								'width' => '600',
    								'height' => '500');
     	$wt_template->add_to_header(wt_init_editor($init_editor));*/
     	$wt_template->display_self = true;    
     	include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addText.php');
     }
    
	function get_texts($txt_id = NULL, $params = array()) {
    	global $wt_sql, $wt_session, $wt_module, $wt_language;
    	
        $texts_array = array();
        if(wt_not_null($txt_id)) {
        	$db_texts_query_raw = "SELECT lt.* FROM (" . TABLE_LANGUAGES_TEXTS . " lt) WHERE " . (isset($params['where']) ? $params['where'] : '') . " lt.txt_id = '" . $txt_id . "' LIMIT 1";
        } else {
        	//$db_texts_query_raw = "SELECT lt.*".($params['count_missing']==true ? " ,SUM(IF(lt.txt_value IS NOT NULL AND lt.txt_value!='',1,0)) AS saved_languages " : '') ." FROM (" . TABLE_LANGUAGES_TEXTS . " lt) " . (isset($params['where']) ? " WHERE " .$params['where'] : '') . " ";
        	$db_texts_query_raw = "SELECT lt.* FROM (" . TABLE_LANGUAGES_TEXTS . " lt) " . (isset($params['where']) ? " WHERE " .$params['where'] : '') . " ";
        	if( isset($params['group']) && wt_not_null($params['group']) ) {
        		$db_texts_query_raw .= " GROUP BY " . $params['group'] . " ";
        	}
        	if( isset($params['order']) && wt_not_null($params['order']) ) {
        		$db_texts_query_raw .= " ORDER BY " . $params['order'] . " ";
        	} elseif (!isset($params['order']) && wt_not_null($this->get_db_sort_order('texts'))) {
        		$db_texts_query_raw .= " ORDER BY ".$this->get_db_sort_order('texts')." ";
        	} else {
        		$db_texts_query_raw .= " ORDER BY lt.ln_value ";
        	}
        	if(!isset($params['dsplit'])) {
        		$this->split_listing =  new splitPageResults($_GET['page'], MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $db_texts_query_raw, $this->db_texts_query_numrows, 'lt.txt_id', $this->db);
        	}
        	if ( isset($params['limit']) && wt_not_null($params['limit'])) {
        		$db_texts_query_raw .= " LIMIT 0, ".$params['limit']." ";
        	}
        }
        $db_texts_query = $this->db->db_query($db_texts_query_raw);
        while($db_texts = $this->db->db_fetch_array($db_texts_query)) {
        	$db_query = $this->db->db_query("SELECT SUM(IF(lt.txt_value IS NOT NULL AND lt.txt_value!='',1,0)) AS saved_languages FROM ".TABLE_LANGUAGES_TEXTS." lt WHERE lt.txt_key='".$db_texts['txt_key']."'");
        	$db_data = $this->db->db_fetch_array($db_query);
        	$db_texts['saved_languages'] = $db_data['saved_languages'];
        	$db_texts['mod_key'] = $wt_module->installed_modules_ids[$db_texts['mod_id']];
        	$db_texts['language_count'] = $wt_language->languages_count;
        	$db_texts['mod_title'] = $wt_module->installed_modules[$db_texts['mod_key']]['mod_title'];
        	$db_texts['missing_languages'] = $db_texts['language_count']-$db_data['saved_languages'];
        	if ($params['all_values']==true) {
        		$db_query = $this->db->db_query("SELECT * FROM ".TABLE_LANGUAGES_TEXTS." WHERE txt_key='".$db_texts['txt_key']."'");
        		while ($db_data = $this->db->db_fetch_array($db_query)) {
        			$db_texts['values'][$db_data['language_id']] = $db_data;
        		}
        	}
        	if(wt_not_null($txt_id)) {
        		$texts_array = $this->db->db_output_data($db_texts);
        	} else {
        		$texts_array[] = $this->db->db_output_data($db_texts);
      		}
     	}    
    	return $texts_array;
    } 	
    
  function _mod_menu($params = array(), $admin = false ) {
   		$menu_data[] = array('mod_ico' => true,	
							 'href' => wt_href_link('mod_languages_manager'),
							 'ico' => $this->module_key);
		if( $admin === true ) {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu_admin.php');
		} else {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu.php');
		} 
	 	return $menu_data;
	 }
	 
	function _structureJSTree($data = false) {
    	global $wt_template, $wt_module;
		$structure = array();
	 	if($data === true ) {	  
  			$items_local = array();
  			$items_a = array();
  			if (wt_is_valid($wt_module->installed_modules_local,'array')) {
  				foreach ($wt_module->installed_modules_local as $mod_key) {
  					$items_local[] = array('type' => 'doc',
				  				          'status' => 1,
				  						  'name' => (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key),
				  						  //'name' => $mod_key,
				  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_id='.$wt_module->installed_modules_keys[$mod_key]),
  				 	);   
  				}
  			}
	 		$items_mod = array();
  			if (wt_is_root()) {
  				if (wt_is_valid($wt_module->installed_modules_manager,'array')) {
  					foreach ($wt_module->installed_modules_manager as $mod_key) {
  						$items_mod[] = array('type' => 'doc',
					  				          'status' => 1,
					  						 'name' => (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key),
				  						  //'name' => $mod_key,
					  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_id='.$wt_module->installed_modules_keys[$mod_key]),
					  						  );   
  					}
  				}
  				$items[] = array('type' => 'folder',
  				          'status' => 1,
  						  'name' => 'Administracyjne',
  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_type=m'),
  						  'docs' => $items_mod
  					 	);   
  				$items[] = array('type' => 'folder',
  				          'status' => 1,
  						  'name' => 'Lokalne',
  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_type=l'),
  						  'docs' => $items_local
  					 	);   
  			} else {
  				$items = $items_local;
  			}
  			/*$items[] = array('type' => 'doc',
  				          'status' => 1,
  						  'name' => 'Globalne',
  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_id=-1'),
  						  );   */
	 				 	
	 		$structure['children'] = $items;
	 		$structure['docs'][] = 	array('type' => 'doc',
  				          'status' => 1,
  						  'name' => 'Globalne',
  						  'url' => wt_href_link('mod_languages_manager', '', 'm=texts&mod_id=-1'),
  						  );   
 		} else {
  			$structure = array('title' => 'Wpisy językowe',
							   'ico' => '',
							   'link' => wt_href_link('mod_languages_manager', '', 't=mP'),
							   'target' => 'site',
							   'url' => wt_href_link('mod_languages_manager', '', 't=mP') );
 		}	
		return $structure;
	}
        

  } // class  
?>