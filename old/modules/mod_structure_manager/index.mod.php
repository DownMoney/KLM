<?php
class mod_structure_manager {
	var $task;
	var $action;
	var $mode;
	var $module_dir;
	var $module_class;
	var $module_key = 'mod_structure_manager';
	var $sort_order_filter = array(
								'items' => array('si.it_id', 'sid.it_name', 'si.sort_order', 'si.status', 'sit.itt_name', 'si.date_added', 'publish_date', 'si.last_modified'),
								'types' => array('itt_id', 'itt_name', 'itt_key'),
								'fields' => array('fc.fi_id', 'fcd.fi_name', 'fc.fi_type', 'fc.fi_gr', 'fc.sort_order')
								);


	function mod_structure_manager() {
		global $wt_module;

		$this->module_dir = dirname(__FILE__);
		$this->module_class = get_class($this);
		$this->module_params = $wt_module->get_module_params($this->module_key);
		$this->import_dir = CFGF_DIR_FS_MEDIA.'mod_structure'.DIRECTORY_SEPARATOR.'_import'.DIRECTORY_SEPARATOR;
		$this->upload_tmp_dir = CFGF_DIR_FS_MEDIA.'mod_structure'.DIRECTORY_SEPARATOR.'_tmp'.DIRECTORY_SEPARATOR;

		if(!is_dir($this->import_dir)) {
				wt_create_dir_structure($this->import_dir);
				$create_file = @fopen($this->import_dir.'index.html', 'w');
				@fclose($create_file);
		}
		if(!is_dir($this->upload_tmp_dir)) {
				wt_create_dir_structure($this->upload_tmp_dir);
				$create_file = @fopen($this->upload_tmp_dir.'index.html', 'w');
				@fclose($create_file);
		}

	}

	function set_sort_order($table = 'items', $default = '2a') {
  		global $wt_session, $wt_template;
		$sort = wt_set_task($_GET, 'sort');
		$sort_orders = $wt_session->value('sort_orders');
		if( !wt_not_null($sort_orders[$this->module_key][$table]) ) {
			$sort_orders[$this->module_key][$table] = $default;
		}
		if( wt_not_null($sort) && wt_not_null( $this->sort_order_filter[$table][(int)$sort] ) )	{
			$sort_orders[$this->module_key][$table] = $sort;

		}

		$wt_template->assign('sort_orders', $sort_orders[$this->module_key]);
		$wt_session->set('sort_orders', $sort_orders);

  	}

  	function get_db_sort_order($table = 'items') {
		global $wt_session;
		$sort_orders = $wt_session->value('sort_orders');
	 	return 	wt_get_sort_order_for_items_to_db($this->sort_order_filter[$table], null, $sort_orders[$this->module_key][$table]);
  	}

	function __construct() {
		$class_name = __CLASS__;
		$this->$class_name();
	}

	function _init() {
		global $wt_session;

		$this->task = wt_set_task($_REQUEST, 't');
		$this->action = wt_set_task($_REQUEST, 'a');
		$this->mode = wt_set_task($_REQUEST, 'm');
		$wt_session->remove('lastAddediID');
		$wt_session->remove('lastSavediID');
		$wt_session->remove('lastAddediIDs');
		$wt_session->remove('lastSavediIDs');

		if( wt_not_null($this->action) ) {

		switch($this->action) {
        	case 'saveMoveItem':
				$this->saveMoveItem();
				break;
			case 'delField':
				$this->delField();
				break;
			case 'saveField':
				$this->saveField();
				break;
			case 'saveFieldEasy':
				$this->saveFieldEasy();
				break;
			case 'saveItem':
				$this->saveItem();
				break;
			case 'saveImage':
				$this->saveImage();
				break;
			case 'saveFile':
				$this->saveFile();
				break;
			case 'fileSaved':
				$this->fileSaved();
				break;
			case 'setItemStatus':
				$this->setItemStatus();
				break;
			case 'delItem':
				$this->delItem();
				break;
			case 'saveItemsOrder':
				$this->saveItemsOrder();
				break;
			case 'setItemOrder':
				$this->setItemOrder();
				break;
			case 'saveType':
				$this->saveType();
				break;
			case 'delType':
				$this->delType();
				break;
			case 'setItemLanguageStatus':
				$this->setItemLanguageStatus();
				break;
			case 'setFieldOrder':
				$this->setFieldOrder();
				break;


			case 'test':
				/*$params = array('field_order' => 'www',
								'ca_id' => '1');*/
				//$params = array('field_order' => '509');
				//wt_print_array($this->get_items(33));
				//phpinfo();
				die();
				break;
		}
	}
		if(!wt_not_null($this->action))  {
			$this->wt_navigationbar();
			switch ($this->mode) {
				default:
				case 'items':
					$this->set_sort_order('items', '2a');
					switch($this->task) {
						default:
							$this->items();
							break;
						case 'addItem':
							$this->addItem();
							break;
						case 'addItemCT':
							$this->addItemCT();
							break;
						case 'fieldValues':
							$this->fieldValues();
							break;
						case 'updateField':
							$this->updateField();
							break;
						case 'addNewField':
							$this->addNewField();
							break;
						case 'itemInfo':
							$this->itemInfo();
							break;
						case 'sortItems':
							$this->sortItems();
							break;
						case 'addImage':
							$this->addImage();
							break;
						case 'addFile':
							$this->addFile();
							break;
						case 'moveItem':
							$this->moveItem();
							break;
						case 'getItemsForAutocompletion':
							$this->getItemsForAutocompletion();
							break;
						case 'deleteItem':
							$this->deleteItem();
							break;
						case 'getSortList':
							$this->getSortList();
							break;
						case 'googleMapFormMap':
							$this->googleMapFormMap();
							break;
						case 'updateFieldDepends':
							$this->updateFieldDepends();
							break;
					}
					break;
				case 'types':
					$this->set_sort_order('types', '0a');
					switch($this->task) {
						default:
							$this->types();
							break;
						case 'addType':
							$this->addType();
							break;
					}
					break;
				case 'fields':
					$this->set_sort_order('fields', '1a');
					switch($this->task) {
						default:
							$this->fields();
							break;
						case 'addField':
							$this->addField();
							break;
					}
					break;
			}
		}
	}


	function updateFieldDepends() {
		global $wt_template,$wt_session;
		$wt_template->display_self=true;
		$fVAL = explode(',', wt_set_task($_REQUEST,'fVAL'));
		$fID = wt_set_task($_REQUEST,'fID');

		wt_clear_empty_array($fVAL);

		if( wt_is_valid($fID,'int','0')) {
	  		$language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id'));
			$fP = array();
			$fP['where'] = " fc.parent_id = '".$fID."' AND ";
			if(wt_is_valid($fVAL, 'array') ) {
				$fP['where'] .= " fc.fi_related_to = '".implode(',', $fVAL)."' AND ";
			} else {
				$fP['where'] .= " fc.fi_related_to = '0' AND ";
			}

			$fP['language_id'] = $language_id;
			$wt_template->assign('fields_listing',$this->get_config_fields(null,$fP));
			$wt_template->assign('field_data', $this->get_config_fields($fID));
		}


		$wt_template->load_file('updateField');
	}

	function googleMapFormMap() {
		global $wt_template;
		$wt_template->display_self=true;
		$wt_template->load_file('sub/googleMapFormMap');
	}

	function setItemLanguageStatus($data = array()) {
		$outside_action = false;
		if(wt_is_valid($data, 'array') ) {
			$outside_action = true;
		} else {
			$data = $_REQUEST;
		}
		if( !wt_is_valid($data, 'array') ) {
			die('ok');
		}
		$params = array();
		$params['status'] = $data['status'];
		$params['table'] = TABLE_MOD_STRUCTURE_ITEMS_DESC;
		$params['tbl_key'] = 'it_id';
		$params['tbl_val'] = $data['iID'];
		$params['language_id'] = $data['language_id'];
		wt_change_language_status($params);
		$this->del_cache('item',$data['iID']);
		$this->del_cache('items');
		wt_plugins::run_action($this->module_key, 'setItemLanguageStatus', $data['language_id'], $data['iID']);
		die('ok');
	}

	function del_cache($type = 'all', $id = null) {
		$cache = new wt_cache();

		if($type == 'all') {
		 $cache->clear(array('mod_structure'));
  		}
		if($type == 'item' && wt_is_valid($id, 'int', '0') ) {
		 $cache->clear(array('mod_structure','item',$id));
  		}
		if($type == 'items') {
		 $cache->clear(array('mod_structure','items'));
  		}
		if($type == 'fields_config') {
		 $cache->clear(array('mod_structure','fields_config'));
  		}
		unset($cache);
	}

	function types() {
		global $wt_template;
	 //	$gSearch = trim(strip_tags(wt_set_task($_GET, 'gSearch')));
		$wt_template->assign('items_listing', $items_listing = $this->get_items_types());
		$wt_template->tFile = 'theme_list';
		$wt_template->load_file('types.tpl');
	}

	function fields() {
		global $wt_template;
	 //	$gSearch = trim(strip_tags(wt_set_task($_GET, 'gSearch')));
	 	$pID = wt_set_task($_REQUEST,'pID',0);
	 	$tID = wt_set_task($_REQUEST,'tID');
	   $iP = array();
		$iP['where'] = '';
		if(wt_is_valid($tID,'int','0')) {
			$iP['where'] .= " fc.it_type = '".$tID."' AND ";
			$wt_template->assign('item_data', $a=$this->get_items_types($tID));
		}
		if(wt_is_valid($pID,'int','0')) {
		$iP['where'] .= " fc.parent_id = '".$pID."' AND ";
		$wt_template->assign('item_data', $this->get_config_fields($pID));
		}
		$wt_template->assign('items_listing', $this->get_config_fields(null,$iP));
		$wt_template->tFile = 'theme_list';
		$wt_template->load_file('fields.tpl');
	}

	function items() {
		global $wt_template,$wt_session;

		$gSearch = trim(strip_tags(wt_set_task($_REQUEST, 'gSearch')));
		$iSearch = wt_set_task($_REQUEST, 'iSearch');
		$parent_id = $this->current_item_id();
		$iParams = array();
		if(wt_set_task($_REQUEST, 'get_recursive') == 1) {
			$iParams['where'] = " si.cPath LIKE '".wt_set_task($_REQUEST, 'cPath')."_%' AND ";
		} else {
			$iParams['where'] = " si.parent_id='".$parent_id."' AND ";
		}
		if(isset($iSearch['itt_nochildren'])) {
			$iParams['where'] .= " sit.itt_nochildren = '".$iSearch['itt_nochildren']."' AND ";
		}

		if( wt_is_valid($parent_id, 'int', '0') ) {
			$iP = array();
			$iP['get_fields'] = true;
			$item_data = $this->get_items($parent_id, $iP);
			$item_params = new wt_params($item_data['itt_params']);
			$item_data['params_array'] = $item_params->get_array();
			$wt_template->assign('item_data', $item_data);

		if(wt_not_null($item_data['params_array']['adminList_fields'])) {
			$_fields = explode("\n", $item_data['params_array']['adminList_fields']);
			foreach($_fields as $_f) {
				$field = explode('=', $_f);
				$fields[$field[0]] = $field[1];
			}
			$wt_template->assign('table_fields', $fields);
		}
		}

		if(wt_not_null($item_data['itt_params_array']['adminList_no_parent_in_where'])) {
			$iParams['where'] = '';
		}

		if( wt_not_null($gSearch) ) {
			if(wt_parse_search_string($gSearch, $parsed_string)) {
				$iParams['where'] .= wt_parse_array_to_query($parsed_string, array('sid.it_name','sid.it_desc_short','sid.it_desc','sit.itt_name')). " AND ";
	 		}
		}

		if(wt_is_valid($iSearch, 'array')) {
		  $mod_structure = wt_module::singleton('mod_structure');
		  $mod_structure->parse_search_params($iParams, $iSearch);
		}

		if($item_data['params_array']['adminList_count_children'] == 1) {
		  $iParams['count_children'] = true;
		}

		if($item_data['params_array']['adminList_get_fields'] == '1' || wt_set_task($_REQUEST, 'get_fields') == 1 || wt_not_null($item_data['params_array']['adminList_fields']) ) {
		  $iParams['get_fields'] = true;
		}
	 //
		if(!wt_is_valid($iSearch, 'array') && !wt_not_null($gSearch) && wt_not_null($item_data['itt_params_array']['adminList_default_where'])) {
			$iParams['where'] .= $item_data['itt_params_array']['adminList_default_where'];
		}

	  if(!$_REQUEST['sort']) {
		if (wt_not_null($item_data['params_array']['adminList_order'])) {
				$iParams['order'] = $item_data['params_array']['adminList_order'];
				if (wt_not_null($item_data['params_array']['adminList_order_desc'])) {
				$iParams['order'] .= " ".$item_data['params_array']['adminList_order_desc'];
				}
			}

		if (wt_is_valid($item_data['params_array']['adminList_field_order'],'int','0')) {
			$iParams['field_order'] = $item_data['params_array']['adminList_field_order'];
			$iParams['field_order_type'] = $item_data['params_array']['adminList_field_order_type'];
			if (wt_not_null($item_data['params_array']['adminList_field_order_desc'])) {
			$iParams['field_order_desc'] = $item_data['params_array']['adminList_field_order_desc'];
			}
		}
	  }

		$wt_template->assign('items_listing', $items_listing = $this->get_items(null, $iParams));

		$number_of_items_text = $this->split_listing->display_count($this->db_items_query_numrows, MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z %s rekordów)');
		$wt_template->assign('number_of_items_text', $number_of_items_text);
		$number_of_items_links = $this->split_listing->display_links($this->db_items_query_numrows, MAX_ADMIN_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
		$wt_template->assign('number_of_items_links', $number_of_items_links);
		$wt_template->assign('display_to_display',$this->split_listing->display_to_display());
		$wt_template->assign('results',$this->db_items_query_numrows);
		$wt_template->assign('resultsPP',$wt_session->value('results_to_display'));

		$wt_template->tFile = 'theme_list';
		if(wt_not_null($item_data['params_array']['adminList_item_list_theme'])) {
			$wt_template->load_file('addons/item_'.$item_data['params_array']['adminList_item_list_theme'].'.tpl');
		} else {
			$wt_template->load_file('items.tpl');
		}

	}

	function itemInfo() {
		global $wt_template,$wt_sql, $wt_module;

		$wt_template->display_self = true;
		$iID = wt_set_task($_REQUEST, 'iID');
		if( wt_is_valid($iID, 'int', '0') ) {
			$item = $this->get_items($iID, array('get_fields' => true));
	  	  	//wt_print_array($item);
			$wt_template->assign('item',$item);
		}
		if(wt_not_null($item['itt_params_array']['adminList_item_info_theme'])) {
			$wt_template->load_file('addons/itemInfo_'.$item['itt_params_array']['adminList_item_info_theme']);
		} else {
			$wt_template->load_file('itemInfo');
		}

	}

	function updateField() {
		global $wt_template;

		$wt_template->display_self = true;
		$fID = wt_set_task($_GET, 'fID');
		if( wt_is_valid($fID, 'int', '0') ) {
			$params = array();
			$params['where'] = " fc.parent_id = '" . $fID . "' AND ";
			$params['get_children'] = true;
			$wt_template->assign('fields_listing', $this->get_config_fields(null, $params) );
			$wt_template->assign('field_data', $this->get_config_fields($fID) );
		}
		$wt_template->load_file('updateField');
	}

	function saveImage() {
		global $wt_session, $wt_template;
		$fID = (int)wt_set_task($_REQUEST, 'fID');
		$wt_template->assign('fID', $fID);
		if (wt_is_valid($fID,'int','0')) {
				$upload_dir = 'mod_structure' . DIRECTORY_SEPARATOR . '_tmp' . DIRECTORY_SEPARATOR . $fID . DIRECTORY_SEPARATOR . $wt_session->id . DIRECTORY_SEPARATOR;
			if(!is_dir(CFGF_DIR_FS_MEDIA . $upload_dir)) {
				wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
				$create_file = @fopen(CFGF_DIR_FS_MEDIA . $upload_dir . DIRECTORY_SEPARATOR . 'index.html', 'w');
				@fclose($create_file);
			}
			$_image_params = array();
			$_image_params['dir'] = $upload_dir;
			$_image_params['file'] = 'fi_image';
			if( $_image_name = move_uploaded_media_file($_image_params) ) {
				$wt_template->assign('image_dir', $upload_dir);
				$wt_template->assign('image_nr', $_image_name);
				$wt_template->assign('image_name', $_image_name);
			} elseif(wt_not_null($url = wt_set_task($_REQUEST,'fi_url'))) { // obrazek z linku
					$fileinfo = pathinfo($url);
					$file_name = wt_safe_string(basename($fileinfo['basename'],'.'.$extension)).".".$fileinfo['extension'];
					$result = copy($url,CFGF_DIR_FS_MEDIA . $upload_dir.$file_name);
					if ($result==true) {
						$wt_template->assign('image_dir',  $upload_dir);
						$wt_template->assign('image_nr', $file_name);
						$wt_template->assign('image_name',$file_name);
					}
			}
			$wt_template->display_self = true;
			$wt_template->load_file('sub/update_image');
		}
	}

	function saveFile() {
		global $wt_session, $wt_template, $wt_user;
		$fID = wt_set_task($_REQUEST, 'fID');
		if (wt_is_valid($fID,'int','0')) {
			$wt_template->assign('fID', $fID);
			$upload_dir = 'mod_structure' . DIRECTORY_SEPARATOR . '_tmp' . DIRECTORY_SEPARATOR . $fID . DIRECTORY_SEPARATOR . $wt_session->id . DIRECTORY_SEPARATOR;
			if(!is_dir(CFGF_DIR_FS_MEDIA.$upload_dir)) {
				wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
				$create_file = @fopen(CFGF_DIR_FS_MEDIA . $upload_dir . DIRECTORY_SEPARATOR . 'index.html', 'w');
				@fclose($create_file);
			}


			$_image_params = array();
			$_image_params['dir'] = $upload_dir;
			$_image_params['file'] = 'Filedata';
		  	$_image_params['replace'] = false;

		if( $_image_name = move_uploaded_media_file($_image_params) ) { // plik z dysku
				$file_info = pathinfo($_image_name);
				$uploaded_file_info = array(array('fID' => $fID,
													 'file_dir' => $upload_dir,
													 'file_nr' => $_image_name,
													 'file_name' => $_image_name,
													 'file_size' => @filesize(CFGF_DIR_FS_MEDIA.$upload_dir.$_image_name)/(1024*1024),
													 'file_ext' => $file_info['extension'],
													 ));
				file_put_contents(DIR_FS_WORK.'uploaded_file_info_'.$_REQUEST['addFileChecksum'],serialize($uploaded_file_info));

			  //	die('ok');
			} elseif(wt_not_null($url = wt_set_task($_REQUEST,'fi_file_link'))) { // plik z linku
					$fileinfo = pathinfo($url);
					$base_name = wt_safe_string(basename($fileinfo['basename'],'.'.$fileinfo['extension']));
					$file_name = $base_name.".".$fileinfo['extension'];
					$i = 0;
					while(@file_exists(CFGF_DIR_FS_MEDIA.$upload_dir.$file_name)) {
						$i++;
						$file_name = $base_name.'('.$i.').'.$fileinfo['extension'];
						}

					$result = @copy($url,CFGF_DIR_FS_MEDIA.$upload_dir.$file_name);

					if ($result==true) {
						$uploaded_files = array(array('file_dir' => $upload_dir,
													 'file_nr' => $file_name,
													 'file_name' => $file_name,
													 'file_size' => @filesize(CFGF_DIR_FS_MEDIA . $upload_dir.$file_name)/(1024*1024),
													 'file_ext' => $fileinfo['extension'],
													 ));
						$wt_template->assign('uploaded_files',$uploaded_files);
					}
			} elseif(wt_set_task($_REQUEST,'files_import') == '1') {
				$files = $this->scan_import_dir();
				if(wt_is_valid($files,'array')) {
						$uploaded_files = array();
					foreach($files as $f) {
						$fileinfo = pathinfo($this->import_dir.$f);
						$base_name = wt_safe_string(basename($f,'.'.$fileinfo['extension']));
						$new_name = $base_name.".".$fileinfo['extension'];
						$i = 0;
						while(@file_exists(CFGF_DIR_FS_MEDIA.$upload_dir.$new_name)) {
						$i++;
						$new_name = $base_name.'('.$i.').'.$fileinfo['extension'];
						}
						if(@rename($this->import_dir.$f,CFGF_DIR_FS_MEDIA.$upload_dir.$new_name)) {
						$uploaded_files[] = array('file_dir' => $upload_dir,
													 'file_nr' => $new_name,
													 'file_name' => $new_name,
													 'file_size' => @filesize(CFGF_DIR_FS_MEDIA.$upload_dir.$new_name)/(1024*1024),
													 'file_ext' => $fileinfo['extension'],
													 );
						}
					}
					$wt_template->assign('uploaded_files',$uploaded_files);

				}
			}

			$wt_template->display_self = true;
			if ($_REQUEST['multiple']=='1') {
				$wt_template->load_file('sub/update_file2');
			} else {
				$wt_template->load_file('sub/update_file');
			}

		}
	}

	function fileSaved() {
		global $wt_session, $wt_template,$wt_user;
		if(wt_not_null($_REQUEST['file'])) {
			$fID = wt_set_task($_REQUEST, 'fID');
			$upload_dir = 'mod_structure'.DIRECTORY_SEPARATOR. '_tmp'.DIRECTORY_SEPARATOR.'fi_'.$fID.DIRECTORY_SEPARATOR.$wt_session->id.DIRECTORY_SEPARATOR;
			wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
			$wt_template->assign('fID', $fID);
			$path_parts = pathinfo($_REQUEST['file']);
			$fileName = wt_safe_string(basename($path_parts['basename'],'.'.$path_parts['extension'])).'.'.$path_parts['extension'];
			$uploaded_files = array();
			$uploaded_files[] = array('file_dir' => $upload_dir,
									  		  'file_nr' => $fileName,
											  'file_name' => $fileName,
											  'file_size' => @filesize(CFGF_DIR_FS_MEDIA.$upload_dir.$fileName)/(1024*1024),
							   			  'file_ext' => $path_parts['extension'],
													 );
			$wt_template->assign('uploaded_files',$uploaded_files);
		}
		$wt_template->display_self = true;

		if ($_REQUEST['multiple']=='1') {
			$wt_template->load_file('sub/update_file2');
		} else {
		  $wt_template->load_file('sub/update_file');
		}
	}


	function saveItem($data = array()) {
		global $wt_sql, $wt_session, $wt_user, $wt_template, $wt_language;

		$outside_action = false;
		if(wt_is_valid($data, 'array')) {
			$data_array = $data;
			$outside_action = true;
		} else {
			$data_array = $_REQUEST;
		}

		$data_array = $wt_sql->db_prepare_input($data_array);

		//wt_print_array($data_array); die();

		if(wt_is_valid($data_array['iID'],'int','0')) {
			if($data_array['action_save'] == 'save_as_new') {
          $action = 'add';
          } else {
			 $iID = $data_array['iID'];
			 $action = 'save';
			 }
		} else {
			$action = 'add';
		}

		if( wt_is_valid($data_array['it_type'], 'int', '0') ) {
			$it_type_data = $this->get_items_types($data_array['it_type']);
		}

		$sql_data_array = array(
								'it_id2' => $data_array['it_id2'],
								'parent_id' => $data_array['parent_id'],
								'it_type' => $data_array['it_type'],
								'status' => (int)$data_array['status'],
								'date_up' => $data_array['date_up'],
								'date_down' => $data_array['date_up'],
								'sort_order' => $data_array['sort_order'],
								'it_logo_multilng' => (int)$data_array['it_logo_multilng'],
								'it_logo_large_multilng' => (int)$data_array['it_logo_large_multilng'],
		);

		if( isset($data_array['import_id']) ) {
			$sql_data_array['import_id'] = $data_array['import_id'];
		}

		if($data_array['it_use_item_type_params'] == '1') {
			$sql_data_array['params_type'] = wt_parse_params_for_db($data_array['params_type']);
		}

		if($action == 'add') {
			$sql_data_array['date_added'] = 'now()';
			$sql_data_array['added_by'] = $wt_user->usr_info['usr_id'];
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS, $sql_data_array);
			$iID = $wt_sql->db_insert_id();
			wt_core_log::saveLog(array('ms_type' => 'manager_add', 'ms_title' => 'Dodano wpis', 'mod_id' => $this->module_key, 'mod_task' => 'nI', 'mod_task_id' => $iID));
		}

		if($action == 'save') {
			$sql_data_array['last_modified'] = 'now()';
			$sql_data_array['modified_by'] = $wt_user->usr_info['usr_id'];
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS, $sql_data_array, 'update', " it_id = '" . (int)$iID . "' LIMIT 1 ");
			wt_core_log::saveLog(array('ms_type' => 'manager_edit', 'ms_title' => 'Zmieniono wpis', 'mod_id' => $this->module_key, 'mod_task' => 'nI', 'mod_task_id' => $iID));
		}



		$params = array();
		$params['tbl_key'] = 'it_id';
		$params['tbl'] = TABLE_MOD_STRUCTURE_ITEMS;
		$params['where'] = "parent_id = '" . (int)$data_array['parent_id'] . "' ";
		$params['op_where'] = "parent_id = '" . (int)$data_array['parent_id'] . "' ";
	 	wt_fix_sort_order($params);

		$sql_data_desc_array = array('it_name' => $data_array['it_name'],
									'it_name_short' => $data_array['it_name_short'],
									'it_desc_short' => $data_array['it_desc_short'],
									'it_desc' => $data_array['it_desc'],
									'tags' => $data_array['tags'],
									'params' => wt_parse_params_for_db($data_array['params']),
									'sefu_link' => $data_array['sefu_link'],
									'meta_title' => $data_array['meta_title'],
									'meta_keys' => $data_array['meta_keys'],
									'meta_desc' => $data_array['meta_desc']
		);
		if($action == 'add') {
			$sql_data_desc_array['it_id'] = $iID;
			$sql_data_desc_array['version'] = '1';
			$wt_language->update_language_table($sql_data_desc_array,TABLE_MOD_STRUCTURE_ITEMS_DESC);
		}

		if($action == 'save') {
			if($it_type_data['itt_disable_languages'] == '1') {
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_DESC, $sql_data_desc_array, 'update', " it_id = '".(int)$iID."'");
				$wt_sql->db_query("UPDATE ".TABLE_MOD_STRUCTURE_ITEMS_DESC." SET version = version+1 WHERE it_id = '".(int)$iID."' LIMIT 1");
			} else {
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_DESC, $sql_data_desc_array, 'update', " it_id = '".(int)$iID."' AND language_id = '".$data_array['language_id']."' LIMIT 1 ");
				$wt_sql->db_query("UPDATE ".TABLE_MOD_STRUCTURE_ITEMS_DESC." SET version = version+1 WHERE it_id = '".(int)$iID."' AND language_id = '".$data_array['language_id']."' LIMIT 1");
			}

		}

		if($it_type_data['itt_disable_languages'] == '1') {
			$wt_language->update_item_languages_status($iID,'it_id',TABLE_MOD_STRUCTURE_ITEMS_DESC,$wt_sql,array('all' => 1));
		} else {
			$wt_language->update_item_languages_status($iID,'it_id',TABLE_MOD_STRUCTURE_ITEMS_DESC,$wt_sql,$data_array['languages_status']);
		}
		$this->update_item_has_children($data_array['parent_id']);
		$this->update_item_has_children($iID);
		$this->update_item_cPath($iID);

		$upload_dir = 'mod_structure' . DIRECTORY_SEPARATOR . $this->generate_media_path($iID) . DIRECTORY_SEPARATOR;

		if($action == 'save') {
				$sql_data_array = array();
			if( wt_is_valid($data_array['delete_it_logo'], 'int', '0') && wt_not_null($data_array['previus_it_logo'])) {
				$sql_data_array['it_logo'] = '';
				@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_it_logo']);
			}
			if( wt_is_valid($data_array['delete_it_logo_large'], 'int', '0') && wt_not_null($data_array['previus_it_logo_large'])) {
				$sql_data_array['it_logo_large'] = '';
				@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $data_array['previus_it_logo_large']);
			}

		if( wt_is_valid($sql_data_array,'array') ) {
			if( $data_array['it_logo_multilng'] == 1 ) {
				$wt_language->update_language_table($sql_data_array,TABLE_MOD_STRUCTURE_ITEMS_DESC,'it_id',$iID);
			} else {
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_DESC, $sql_data_array, 'update', "it_id = '" . (int)$iID . "' AND language_id = '".$data_array['language_id']."' LIMIT 1");
			}
		} elseif($data_array['it_logo_multilng'] == 1) {
				$sql_data_array = array('it_logo' => $data_array['previus_it_logo'],
												'it_logo_large' => $data_array['previus_it_logo_large']);

			   $wt_language->update_language_table($sql_data_array,TABLE_MOD_STRUCTURE_ITEMS_DESC,'it_id',$iID);
		}
		}

		if( $outside_action === true && !isset($data_array['logo_uploaded']) ) {
			if( wt_not_null($data_array['it_logo']) && file_exists($data_array['it_logo']) && wt_is_valid(@getimagesize($data_array['it_logo']), 'array') ) {
				wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
				$ext = wt_get_file_extension($data_array['it_logo']);
				if(@copy($data_array['it_logo'], CFGF_DIR_FS_MEDIA . $upload_dir . 'logo.' . $ext)) {
		  		$sql_logo_data_array['it_logo'] = 'logo.' . $ext;
				}
			}

			if( wt_not_null($data_array['it_logo_large']) && file_exists($data_array['it_logo_large']) && wt_is_valid(@getimagesize($data_array['it_logo_large']), 'array') ) {
				$ext = wt_get_file_extension($data_array['it_logo_large']);
				wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
				if(@copy($data_array['it_logo_large'], CFGF_DIR_FS_MEDIA . $upload_dir . 'logo_large.' . $ext)) {
		  		$sql_logo_data_array['it_logo_large'] = 'logo_large.' . $ext;
				}
			}
		} else {
		$sql_logo_data_array = array();
		$logo_params = array();
		$logo_params['dir'] = $upload_dir;
		if( $data_array['it_logo_multilng'] == 1 ) {
			$logo_params['file_name'] = 'logo';
		} else {
			$logo_params['file_name'] = 'logo-'.$data_array['language_id'];
		}
		$logo_params['file'] = 'it_logo';
		if( $logo_name = move_uploaded_media_file($logo_params) ) {
			$sql_logo_data_array['it_logo'] = $logo_name;
		}

		$logo_large_params = array();
		$logo_large_params['dir'] = $upload_dir;
		if( $data_array['it_logo_multilng'] == 1 ) {
			$logo_params['file_name'] = 'logo_large';
		} else {
			$logo_params['file_name'] = 'logo_large-'.$data_array['language_id'];
		}
		$logo_large_params['file'] = 'it_logo_large';
		if( $logo_large_name = move_uploaded_media_file($logo_large_params) ) {
			$sql_logo_data_array['it_logo_large'] = $logo_large_name;
		}




	}
		if( wt_is_valid($sql_logo_data_array, 'array')  ) {
			if( $data_array['it_logo_multilng'] == 1 ) {
				$wt_language->update_language_table($sql_logo_data_array,TABLE_MOD_STRUCTURE_ITEMS_DESC,'it_id',$iID);
			} else {
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_DESC, $sql_logo_data_array, 'update', "it_id = '" . (int)$iID . "' AND language_id = '".$data_array['language_id']."' LIMIT 1");
			}
		}


		if (wt_is_valid($data_array['image'],'array')) {
			foreach ($data_array['image'] as $fi_id => $image_data) {
				if( wt_is_valid($fi_id, 'int', '0') ) {
					$data_array['fi'][$fi_id] = wt_parse_params_for_db($image_data);
				}
			}
		}

		if (wt_is_valid($data_array['to_delete'],'array') && $wt_language->languages_count == 1) {
			foreach($data_array['to_delete'] as $fi_id => $image_list) {
				if( wt_is_valid($fi_id, 'int', '0') ) {
					foreach ($image_list as $image) {
						@unlink(CFGF_DIR_FS_MEDIA.$upload_dir.'fi_'.$fi_id.DIRECTORY_SEPARATOR.$image);
					}
				}
			}
		}

		if(wt_is_valid($data_array['image'],'array')) {
			foreach ($data_array['image'] as $fi_id => $images) {
				if (wt_is_valid($fi_id,'int','0')) {
				  //	$tmp_image_dir = CFGF_DIR_FS_MEDIA . 'mod_structure' . DIRECTORY_SEPARATOR . '_tmp' . DIRECTORY_SEPARATOR . $fi_id . DIRECTORY_SEPARATOR . $wt_session->id . DIRECTORY_SEPARATOR;
					$image_dir = CFGF_DIR_FS_MEDIA.$upload_dir.'fi_'.$fi_id.DIRECTORY_SEPARATOR;
					if(!is_dir($image_dir)) {
						wt_create_dir_structure($image_dir);
					}
					$i=1;
					$ble = $fi_id;
					$idata = array();

					foreach ($images as $image_data) {

					  if(file_exists(CFGF_DIR_FS_MEDIA.$image_data['file']))	{
					  		if(file_exists($image_dir.$image_data['file']))	{
								@unlink($image_dir.$image_data['file']);
							}
							$filedata = pathinfo($image_data['file']);
							$new_filename = $i.'.'.$filedata['extension'];
							copy(CFGF_DIR_FS_MEDIA.$image_data['file'],$image_dir.basename($image_data['file']));
							$tmp_image_dir[] = dirname(CFGF_DIR_FS_MEDIA.$image_data['file']);
					  }
					  $image_data['file'] = basename($image_data['file']);
					  $idata[$i] = $image_data;
					  $i++;
					}
					$data_array['fi'][$fi_id] = wt_parse_params_for_db($idata);
				}
			}
		}
		if($action == 'add' && wt_is_valid($tmp_image_dir,'array')) {
			foreach($tmp_image_dir as $d) {
		 	//	wt_rmdir(array('dirname' => $d));
			}
		}

		if (wt_is_valid($data_array['files_to_delete'],'array') && $wt_language->languages_count == 1) {
			foreach($data_array['files_to_delete'] as $fi_id => $file) {
				if( wt_is_valid($fi_id, 'int', '0') ) {
					@unlink(CFGF_DIR_FS_MEDIA.$upload_dir.'fi_'.$fi_id.DIRECTORY_SEPARATOR.$file);
				}
			}
		}

		if (wt_is_valid($data_array['file'],'array')) {

			foreach ($data_array['file'] as $fi_id => $file) {
				if (wt_is_valid($fi_id,'int','0')) {
				  //	$tmp_image_dir = CFGF_DIR_FS_MEDIA . 'mod_structure' . DIRECTORY_SEPARATOR . '_tmp' . DIRECTORY_SEPARATOR . $fi_id . DIRECTORY_SEPARATOR . $wt_session->id . DIRECTORY_SEPARATOR;

					$image_dir_fs = CFGF_DIR_FS_MEDIA.$upload_dir.'fi_'.$fi_id.DIRECTORY_SEPARATOR;
					$image_dir_ws = $upload_dir.'fi_'.$fi_id.DIRECTORY_SEPARATOR;
					if(!is_dir($image_dir_fs)) {
						wt_create_dir_structure($image_dir_fs);
					}
					$i=1;
					if(file_exists(CFGF_DIR_FS_MEDIA.$file))	{
						/*
if(file_exists($image_dir_fs.basename($file)))	{
							@unlink($image_dir_fs.basename($file));
						}
*/
						$filedata = pathinfo($file);
						@copy(CFGF_DIR_FS_MEDIA.$file,$image_dir_fs.basename($file));
						if($action == 'add' && $data_array['submit_type'] == 'save_close') {
							wt_rmdir(array('dirname' => dirname(CFGF_DIR_FS_MEDIA.$file)));
						}

					}
					//$idata['filename'] = $file;
					}
				$data_array['fi'][$fi_id] = $image_dir_ws.basename($file);
			}
		}


	 //	wt_rmdir(array('dirname' => $tmp_image_dir));
		$this->saveFieldsToItem($data_array['fi'], $iID, $data_array['language_id'], $action);
if($action == 'add') {
	$it_type_params = wt_unserialize($it_type_data['params']);
	if($it_type_params['autoAddChildren'] == '1' && wt_not_null($it_type_data['itt_children_only'])) {
		$types_to_create = explode(",",$it_type_data['itt_children_only']);

		if(wt_is_valid($types_to_create,'array')) {
			foreach($types_to_create as $itt) {
				if(wt_not_null($itt)) {
					$itP = array();
					$itP['where'] = "itt_key = '".trim($itt)."'";
					$itP['limit'] = 1;
					$itP['get_array'] = true;
					$itP['disable_root_check'] = true;
					$item_to_add_type_data = $this->get_items_types(null,$itP);
					if(wt_is_valid($item_to_add_type_data,'array') && wt_is_valid($item_to_add_type_data['itt_id'],'int','0')) {

					$item_to_add_type_params = wt_unserialize($item_to_add_type_data['params']);
					if(wt_not_null($item_to_add_type_params['autoAddedName'])) {
						$names = explode("\n",$item_to_add_type_params['autoAddedName']);
					} else {
						$names = array($item_to_add_type_data['itt_name']);
					}
						foreach($names as $name) {
							if(wt_not_null($name)) {
								$auto_add_item_data = array('parent_id' => $iID,
															'it_type' => $item_to_add_type_data['itt_id'],
															'status' => (isset($item_to_add_type_params['autoAddedStatus']) ? $item_to_add_type_params['autoAddedStatus'] : $data_array['status']),
															'sort_order' => $item_to_add_type_params['autoAddedSortOrder'],
															'languages_status' => $data_array['languages_status'],
															'language_id' => $data_array['language_id'],
															'it_name' => $name);
								$this->saveItem($auto_add_item_data);
							}
						}
					}
				}
			}
		}
	}
}

	global $wt_message_stack;
 	 if( $action == 'add' ) {
		$wt_message_stack->add_session(ucfirst($it_type_data['it_name']) . ' dodany pomyślnie', '', 'ok');
		$wt_session->set('lastAddediID',$iID);
		$iIDs = $wt_session->value('lastAddediIDs');
		$iIDs[] = $iID;
		$wt_session->set('lastAddediIDs',$iIDs);
	  } elseif( $action == 'save' ) {
	  	$wt_message_stack->add_session(ucfirst($it_type_data['it_name']) . ' zapisano pomyślnie', '', 'ok');
		$wt_session->set('lastSavediID',$iID);
		$iIDs = $wt_session->value('lastSavediIDs');
		$iIDs[] = $iID;
		$wt_session->set('lastSavediIDs',$iIDs);
	  }

		$this->del_cache('item',$iID);
		$this->del_cache('items');


	wt_plugins::run_action($this->module_key, 'saveItem', $action, $iID);

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

			if(wt_not_null($data_array['_return2'])) {
				$site_url = wt_href_link('mod_structure_manager', '', wt_parse_sefu_string_to_url($data_array['_return2']));
			} else {
				$site_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('m', 'cPath') ) . 'cPath='.$data_array['cPath']);
			}


			$wt_session->set('site_url', $site_url);

			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action . '&dRT=' . !$data_array['tree_fields_changed'] . '&dRL=' . !$data_array['list_fields_changed'].'&_formType='.$data_array['_formType'].'&_return2='.$data_array['_return2']));

		}
	}

function generate_media_path($data) {
	return implode(DIRECTORY_SEPARATOR,str_split($data));
}

function saveType($data = array()) {
		global $wt_sql, $wt_session, $wt_user, $wt_template;

		$outside_action = false;
		if(wt_is_valid($data, 'array')) {
			$data_array = $data;
			$outside_action = true;
			unset($data);
		} else {
			$data_array = $_REQUEST;
			unset($_REQUEST);
		}

		$data_array = $wt_sql->db_prepare_input($data_array);

		if(wt_is_valid($data_array['tID'],'int','0')) {
			if($data_array['action_save'] == 'save_as_new') {
          $action = 'add';
          } else {
			 $tID = $data_array['tID'];
			 $action = 'save';
			 }
		} else {
			$action = 'add';
		}

		if(!wt_is_valid($data_array['itt_children_only_tree'], 'array')) {
			$data_array['itt_children_only_tree'] = array();
		}
		if(!wt_is_valid($data_array['itt_children_only'], 'array')) {
			$data_array['itt_children_only'] = array();
		}
		if(!wt_is_valid($data_array['itt_children_without'], 'array')) {
			$data_array['itt_children_without'] = array();
		}

		$sql_data_array = array(
								'itt_name' => $data_array['itt_name'],
								'itt_key' => $data_array['itt_key'],
								'itt_desc' => $data_array['itt_desc'],
								'itt_ico' => $data_array['itt_ico'],
								'itt_nochildren' => $data_array['itt_nochildren'],
								'itt_children_only_tree' => implode(',',$data_array['itt_children_only_tree']),
								'itt_children_only' => implode(',',$data_array['itt_children_only']),
								'itt_children_without' => implode(',',$data_array['itt_children_without']),
								'itt_root_show' => $data_array['itt_root_show'],
								'itt_root_edit' => $data_array['itt_root_edit'],
								'itt_root_addchildren' => $data_array['itt_root_addchildren'],
								'itt_sefu_id' => $data_array['itt_sefu_id'],
								'itt_sefu_ignore' => $data_array['itt_sefu_ignore'],
								'itt_sefu_treat_as_file' => $data_array['itt_sefu_treat_as_file'],
								'itt_mod_structure_add_show' => $data_array['itt_mod_structure_add_show'],
								'itt_disable_languages' => $data_array['itt_disable_languages'],
								'params' => wt_parse_params_for_db($data_array['params']),
		);

		if($action == 'add') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_TYPE, $sql_data_array);
			$tID = $wt_sql->db_insert_id();
		}

		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS_TYPE, $sql_data_array, 'update', " itt_id = '" . (int)$tID . "' LIMIT 1 ");

			if(wt_is_valid($data_array['fields'], 'array', 0)) {
				foreach($data_array['fields'] as $fID => $field) {
					if(wt_is_valid($fID, 'int', 0)) {
						$sql_data_array = array(
							'params_add' => wt_parse_params_for_db($field['params_add']),
						);
						$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG, $sql_data_array, 'update', " fi_id = '" . (int)$fID . "' LIMIT 1 ");
					}
				}
			}

		}

	global $wt_message_stack;
 	 if( $action == 'add' ) {
		$wt_message_stack->add_session('Typ dodany pomyślnie', '', 'ok');
	  } elseif( $action == 'save' ) {
	  	$wt_message_stack->add_session('Typ zapisany pomyślnie', '', 'ok');
	  }

		$this->del_cache('all');

		wt_plugins::run_action($this->module_key, 'saveType', $action, $tID);

		if($outside_action === true)   {
			return $tID;
		} else {

if( $data_array['submit_type'] == 'save_close' ) {
		switch($data_array['action_after']) {
       	case 'add_new':
					$action = 'add';
					$data_array['submit_type'] = 'save';
       			$form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't') ) . 'm=types&t=addType&action_after=' . $data_array['action_after']);
					$wt_session->set('form_url', $form_url);
       			break;
       	case 'edit':
       			$action = 'add';
					$data_array['submit_type'] = 'save';
       			$form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'iID') ) . 'm=types&t=addType&tID=' . $tID . '&action_after=' . $data_array['action_after']);
					$wt_session->set('form_url', $form_url);
       			break;
       }
	} else {
		if( $action == 'add'  ) {
       	 $form_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('a', 'm', 't', 'iID') ) .  'm=types&t=addType&tID=' . $tID);
			 $wt_session->set('form_url', $form_url);
		}
	}
			$site_url = wt_href_link('mod_structure_manager', '', wt_get_all_get_params( array('m') ) . 'm=types');
			$wt_session->set('site_url', $site_url);

			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action . '&dRT=' . !$data_array['tree_fields_changed'] . '&dRL=' . !$data_array['list_fields_changed']));

		}
	}

	function saveMoveItem($data = array(), $params = array()) {
		global $wt_sql, $wt_session;

		$outside_action = false;
		if( wt_is_valid($data, 'array') ) {
			$outside_action = true;
		} else {
			$data = $_REQUEST;
		}
		$tmp_gid = explode(',',$data['iID']);
     	$wt_sql->prepare_data($tmp_gid);
     	$data['iID']=$tmp_gid;
     	unset($tmp_gid);
     	$i=0.0;
     	foreach($data['iID'] as $iID) {
			if( wt_is_valid( $iID, 'int', '0' ) && wt_is_valid( $data['parent_id'], 'int' ,'-1')  && $iID != $data['parent_id'] ) {
				$item_data = $this->get_items($iID);
				$sql_data_array = array('parent_id' => (int)$data['parent_id'],
							'sort_order' => $data['sort_order']+$i,);
				$i+=1.0;
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS, $sql_data_array, 'update', "it_id = '" . (int)$iID . "' LIMIT 1");
				$this->update_item_cPath($iID);
				$this->update_item_has_children($item_data['parent_id']);
				if (wt_is_valid($item_data,'array')) {
					$params = array();
					$params['tbl_key'] = 'it_id';
					$params['tbl'] = TABLE_MOD_STRUCTURE_ITEMS;
					$params['where'] = "parent_id = '" . (int)$item_data['parent_id'] . "' ";
					$params['op_where'] = "parent_id = '" . (int)$item_data['parent_id'] . "' ";
					wt_fix_sort_order($params);
					$this->del_cache('item',$iID);
				}
			}
     	}

		$this->update_item_has_children($data['parent_id']);
     	$params = array();
		$params['tbl_key'] = 'it_id';
		$params['tbl'] = TABLE_MOD_STRUCTURE_ITEMS;
		$params['where'] = "parent_id = '" . (int)$data['parent_id'] . "' ";
		$params['op_where'] = "parent_id = '" . (int)$data['parent_id'] . "' ";
		wt_fix_sort_order($params);
		$this->del_cache('items');

		$site_url = wt_href_link('mod_structure_manager', '', 'cPath=' . $data['cPath'] );
		$wt_session->set('site_url', $site_url);

		wt_plugins::run_action($this->module_key, 'saveMoveItem', null, $data['iID']);

		wt_redirect(wt_href_link('mod_admin_manager', '', 'a=fastFormSaved'));
	}

	function saveFieldsToItem($data, $iID, $language_id = null, $action = '') {
		global $wt_sql,$wt_session,$wt_language;

		if( !wt_is_valid($language_id,'int','0') ) {
			$language_id = $wt_session->value('languages_id');
		}
		$growth = $data['growth'];
	 	unset($data['growth']);

		if( wt_is_valid($data, 'array') &&  wt_is_valid($iID, 'int', '0') ) {
		if($growth != true) {
		  	$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE it_id = '".$iID."' AND language_id = '".$language_id."' ");
		}


			foreach($data as $fi_id => $fi_value) {
				if( wt_is_valid($fi_value, 'array') ) {
					$fi_value = serialize($fi_value);
				}

				$sql_data_array = array('fi_id' => $fi_id,
												'it_id' => $iID,
												'fi_value' =>  $fi_value);
				$field_data = $this->get_config_fields($fi_id);

				if($action == 'add' || $field_data['fi_multi_language'] == 1) {
					$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE it_id = '".$iID."' AND fi_id = '".$fi_id."'");
					$wt_language->update_language_table($sql_data_array,TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS);
				} else {
					//$sql_data_array['language_id'] = $language_id;
					$wt_sql->db_query("INSERT INTO ".TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS." (it_id, language_id, fi_id, fi_value) VALUES ('".$iID."', '".$language_id."', '".$fi_id."', '".$fi_value."') ON DUPLICATE KEY UPDATE fi_value = '".$fi_value."'");
				  //	$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS, $sql_data_array);
				}
			}
		}
	}
	function saveFieldEasy($data = array()) {
		global $wt_sql, $wt_session, $wt_user, $wt_template, $wt_language;

		$outside_action = false;
		if(wt_is_valid($data, 'array')) {
			$data_array = $data;
			$outside_action = true;
		} else {
			$data_array = $_REQUEST;
		}
		$data_array = $wt_sql->db_prepare_input($data_array);
		if(wt_is_valid($data_array['fID'], 'int', '0')) {
			$action = 'save';
			$fID = $data_array['fID'];
		} else {
			$action = 'add';
		}
		$sql_data_array = array('parent_id' => $data_array['parent_id'],
								'fi_gr' => $data_array['fi_gr'],
								'sort_order' => $data_array['sort_order'],
								'fi_related_to' => $data_array['fi_related_to'],
								'fi_type' => $data_array['fi_type']);
		if($action == 'add') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG, $sql_data_array);
			$fID = $wt_sql->db_insert_id();
		}

		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG, array('fi_related_to' => $data_array['fi_related_to']), 'update', "fi_id = '".$fID."' LIMIT 1");
		}

		$sql_data_desc_array = array('language_status' => '1',
									        'fi_name' => $data_array['fi_name'],
											  'fi_desc' => $data_array['fi_desc']);

		if($action == 'add') {
			$sql_data_desc_array['fi_id'] = $fID;
			$wt_language->update_language_table($sql_data_desc_array,TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC);
		}

		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC, $sql_data_desc_array, 'update', " fi_id = '" . (int)$fID . "' AND language_id = '".$data_array['language_id']."' LIMIT 1 ");
		}

		$this->del_cache('fields_config');

		if($outside_action === true)   {
			return $fID;
		} else {
			if( $action == 'save' ) {
				die('ok');
			} else {
				$iP = array();
				$iP['get_depends'] = true;
				$wt_template->assign('field_data', $this->get_config_fields($fID,$iP) );
				$wt_template->display_self = true;
				$wt_template->load_file('saveField');
			}
		}
	}


	function saveField($data = array()) {
		global $wt_sql, $wt_session, $wt_user, $wt_template, $wt_language;

		$outside_action = false;
		if(wt_is_valid($data, 'array')) {
			$data_array = $data;
			$outside_action = true;
		} else {
			$data_array = $_REQUEST;
		}
		$data_array = $wt_sql->db_prepare_input($data_array);
		if(wt_is_valid($data_array['fID'], 'int', '0')) {
			$action = 'save';
			$fID = $data_array['fID'];
		} else {
			$action = 'add';
		}
		$sql_data_array = array('it_type' => $data_array['it_type'],
										'parent_id' => $data_array['parent_id'],
										'has_children' => $data_array['has_children'],
										'fi_gr' => $data_array['fi_gr'],
										'fi_depends_on' => $data_array['fi_depends_on'],
										'fi_related_to' => $data_array['fi_related_to'],
										'fi_type' => $data_array['fi_type'],
										'fi_show_on_short' => $data_array['fi_show_on_short'],
										'fi_multi_language' => $data_array['fi_multi_language'],
										'fi_root_edit' => $data_array['fi_root_edit'],
										'fi_root_show' => $data_array['fi_root_show'],
										'params' => wt_parse_params_for_db($data_array['params']),
										'params_add' => wt_parse_params_for_db($data_array['params_add']),

										);

		if( isset($data_array['import_id']) ) {
			$sql_data_array['import_id'] = $data_array['import_id'];
		}

		if($action == 'add') {
			$sql_data_array['sort_order'] = 100000;
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG, $sql_data_array);
			$fID = $wt_sql->db_insert_id();

			$params = array();
			$params['tbl_key'] = 'fi_id';
			$params['tbl'] = TABLE_MOD_STRUCTURE_FIELDS_CONFIG;
			$params['tbl_val'] = $fID;
			$params['where'] = "parent_id = '".(int)$data_array['parent_id']."' ";
			$params['op_where'] = "parent_id = '".(int)$data_array['parent_id']."' ";
			wt_fix_sort_order($params);
		}

		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG, $sql_data_array, 'update', "fi_id = '".$fID."' LIMIT 1");
		}

		$sql_data_desc_array = array('fi_name' => $data_array['fi_name'],
											  'fi_name_short' => $data_array['fi_name_short'],
											  'fi_desc' => $data_array['fi_desc']);

		if($action == 'add') {
			$sql_data_desc_array['fi_id'] = $fID;
			$wt_language->update_language_table($sql_data_desc_array,TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC);
		}

		if($action == 'save') {
			$wt_sql->db_perform(TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC, $sql_data_desc_array, 'update', " fi_id = '" . (int)$fID . "' AND language_id = '".$data_array['language_id']."' LIMIT 1 ");
		}

	$wt_language->update_item_languages_status($fID,'fi_id',TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC,$wt_sql,$data_array['languages_status']);

   $this->del_cache('all');

		if($outside_action === true)   {
			return $fID;
		} else {

	if( $data_array['submit_type'] == 'save_close' ) {
		switch($data_array['action_after']) {
       	case 'add_new':
					$action = 'add';
					$data_array['submit_type'] = 'save';
       			$form_url = wt_href_link('', '', wt_get_all_get_params( array('a', 'm', 't') ) . 'm=fields&t=addField&action_after=' . $data_array['action_after']);
					$wt_session->set('form_url', $form_url);
       			break;
       	case 'edit':
       			$action = 'add';
					$data_array['submit_type'] = 'save';
       			$form_url = wt_href_link('', '', wt_get_all_get_params( array('a', 'm', 't', 'fID') ) . 'm=fields&t=addField&fID='.$fID.'&action_after='.$data_array['action_after']);
					$wt_session->set('form_url', $form_url);
       			break;
       }
	} else {
		if( $action == 'add'  ) {
       	 $form_url = wt_href_link('', '', wt_get_all_get_params( array('a', 'm', 't', 'fID') ) .  'm=fields&t=addField&fID='.$fID);
			 $wt_session->set('form_url', $form_url);
		}
	}
			$site_url = wt_href_link('', '', wt_get_all_get_params( array('m') ) . 'm=fields');
			$wt_session->set('site_url', $site_url);

			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=formSaved&op=' . $data_array['submit_type'] . '&opA=' . $action . '&dRT=' . !$data_array['tree_fields_changed'] . '&dRL=' . !$data_array['list_fields_changed']));

			}
	}

	function deleteItem() {
		global $wt_template, $wt_sql;

		$wt_template->display_self = true;
		$items_array = array();
		$items_to_delete = array();

		$cid=wt_clear_empty_id($_GET['iID']);
		$it_array = explode(',',$cid);
		foreach($it_array as $iID) {
			if(wt_is_valid($iID, 'int', 'array')) {
				$items_array = $this->get_items($iID);
				$items_to_delete[] = $iID;
				if( $items_array['itt_key'] != 'shortcut' && $items_array['itt_key'] != 'copy' ) {
					$db_items_query = $wt_sql->db_query("SELECT it_id FROM " . TABLE_MOD_STRUCTURE_ITEMS . " WHERE cPath LIKE '".$items_array['cPath']."\_%'");
					while($db_items = $wt_sql->db_fetch_array($db_items_query)) {
						$items_to_delete[] = $db_items['it_id'];
					}
				}
			}
		}
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'deleteItem.php');
	}

	function delType($data = array()) {
		global $wt_sql, $wt_session;

		$outside_action = false;
		if( wt_is_valid( $data, 'array' ) ) {
			$outside_action = true;
		} else {
			$data = $_REQUEST;
		}
		$tID = explode(',', $data['tID']);
		if( wt_is_valid($tID, 'array') ) {
				foreach($tID as $t) {
					if(wt_is_valid($t, 'int', '0')) {
						$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_ITEMS_TYPE . " WHERE itt_id = '" . (int)$t . "' LIMIT 1");
					}
				}
		}
	} //function

	function delItem($data = array()) {
		global $wt_sql, $wt_session;

		wt_set_time_limit(0);
		$outside_action = false;
		if( wt_is_valid( $data, 'array' ) ) {
			$outside_action = true;
		} else {
			$data = $_REQUEST;
		}
		if( wt_is_valid($data, 'array') ) {
			if(wt_is_valid( $data['it_id'], 'array' )) {
				foreach($data['it_id'] as $it_id) {
					if(wt_is_valid($it_id, 'int', '0')) {
						$item_data = $this->get_items($it_id);
						$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_ITEMS . " WHERE it_id = '" . (int)$it_id . "' LIMIT 1");
						$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " WHERE it_id = '" . (int)$it_id . "'");
						$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE it_id = '" . (int)$it_id . "'");
						if (wt_is_valid($item_data,'array')) {
							$params['tbl_key'] = 'it_id';
							$params['tbl'] = TABLE_MOD_STRUCTURE_ITEMS;
							$params['where'] = "parent_id = '" . (int)$item_data['parent_id'] . "' ";
							$params['op_where'] = "parent_id = '" . (int)$item_data['parent_id'] . "' ";
							wt_fix_sort_order($params);
							$this->del_cache('item',$it_id);
						}
						wt_core_log::saveLog(array('ms_type' => 'manager_del', 'ms_title' => 'Usunięto wpis', 'mod_id' => $this->module_key, 'mod_task' => 'dI', 'mod_task_id' => $it_id));

						$item_dir = CFGF_DIR_FS_MEDIA.'mod_structure'.DIRECTORY_SEPARATOR.$this->generate_media_path($it_id).DIRECTORY_SEPARATOR;
						if(is_dir($item_dir)) {
							$d = dir($item_dir);
      					while ($entry = $d->read()) {
					        if(is_file($item_dir.$entry)) {
					          @unlink($item_dir.$entry);
					        }
							  if(is_dir($item_dir.$entry) && substr($entry, 0, 3) == 'fi_') {
					          wt_rmdir(array('dirname' => $item_dir.$entry));
					        }
					      }
						}

					 //	wt_rmdir(array('dirname' => CFGF_DIR_FS_MEDIA . 'mod_structure' . DIRECTORY_SEPARATOR . $it_id . DIRECTORY_SEPARATOR));
					}
				}
				$this->del_cache('items');
			}
		}
		if($outside_action === false)  {

			if(wt_not_null($data['_return2'])) {
				$site_url = wt_href_link('mod_structure_manager', '', wt_parse_sefu_string_to_url($data['_return2']));
			} else {
				$site_url = wt_href_link('mod_structure_manager', '', 'cPath='.$data['cPath']);
			}

			$wt_session->set('site_url', $site_url);
			$mess = 'Wpis usunięty';
			$wt_session->set('mess', $mess);
			wt_redirect(wt_href_link('mod_admin_manager', '', 'a=fastFormSaved'));
		} else {
			return true;
		}
	} //function

	function delField() {
		global $wt_sql;

		$fID = wt_set_task($_REQUEST, 'fID');
		if( wt_is_valid($fID, 'int', '0') ) {
			$dParams = array();
			$dParams['where'] =
			$dParams['where'] = " fc.parent_id = '" . (int)$fID . "' AND ";
			$dParams['get_children'] = true;
			$con_fields = $this->get_config_fields(null, $dParams);
			$fID_t_del = array();
			$fID_t_del[] = $fID;
			foreach($con_fields as $f) {
				$fID_t_del[] = $f['fi_id'];
			}
			$fID_t_del = array_unique($fID_t_del);
			foreach( $fID_t_del as $fi ) {
				if( wt_is_valid($fi, 'int', '0') ) {
					$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " WHERE fi_id = '" . (int)$fi . "' LIMIT 1 ");
					$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE fi_id = '" . (int)$fi . "' ");
					$wt_sql->db_query("DELETE FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " WHERE fi_id = '" . (int)$fi . "' ");
				}
			}
		}
		die('ok');
	}

	function setItemStatus($data = array()) {
		global $wt_sql, $wt_user;

		$change_status_data = array();
		$outside_action = false;
		if(wt_is_valid($data, 'array') ) {
			$change_status_data = $data;
			$outside_action = true;
		} else {
			$change_status_data = $_REQUEST;
		}
		if( wt_is_valid($change_status_data['iID'], 'int', '0') ) {
			$params = array();
			$params['status'] = $change_status_data['status'];
			$params['table'] = TABLE_MOD_STRUCTURE_ITEMS;
			$params['tbl_key'] = 'it_id';
			$params['tbl_val'] = $change_status_data['iID'];
			wt_change_status_base($params);
			$this->del_cache('item',$change_status_data['iID']);
			$this->del_cache('items');
			wt_plugins::run_action($this->module_key, 'setItemStatus', $change_status_data['status'], $change_status_data['iID']);
		}
		die('ok');
	}

	function saveItemsOrder($data = array()) {
		global $wt_sql, $wt_session;

		$outside_action = false;
		if (wt_is_valid($data,'array')) {
			$data_array = $data;
			$outside_action = true;
		} else {
			$data_array = $_REQUEST;
		}
		//wt_print_array($_REQUEST);
		if (wt_is_valid($data_array['ca_id'],'int','0') && wt_is_valid($data_array['fi_id'],'int','0')) {
		//	echo "SELECT * FROM ".TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS." WHERE fi_id='".$data_array['fi_id']."' ORDER BY fi_value ".(wt_is_valid($data_array['order'],'int','0') ? 'DESC' : '')."<br />";
			$db_query = $wt_sql->db_query("SELECT * FROM ".TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS." WHERE fi_id='".$data_array['fi_id']."' ORDER BY fi_value ".(wt_is_valid($data_array['order'],'int','0') ? 'DESC' : ''));
		}
		$i = 1.0;
		//echo "i: ".$i."<br />";
		while($db_field = $wt_sql->db_fetch_array($db_query)) {
			//echo "UPDATE ".TABLE_MOD_STRUCTURE_ITEMS." SET sort_order=".$i." WHERE it_id='".$db_field['it_id']."'<br />";
			$wt_sql->db_query("UPDATE ".TABLE_MOD_STRUCTURE_ITEMS." SET sort_order=".$i." WHERE it_id='".$db_field['it_id']."'");
			$i++;
		}

		if($outside_action === true) {
			return true;
		} else {
	    	$site_url = wt_href_link('mod_structure_manager', '', 'cID=' . $data_array['ca_id']);
			$wt_session->set('site_url', $site_url);
  			$mess = 'Zakończono sortowanie';
			$wt_session->set('mess', $mess);
		 	wt_redirect(wt_href_link('mod_admin_manager', '', 'a=fastFormSaved&dRT=1'));
		}
	}

	function setItemOrder() {
		$iID = wt_set_task($_GET, 'iID');
		if( wt_is_valid($iID, 'int', '0') ) {
			$params = array();
			$params['tbl_key'] = 'it_id';
			$params['tbl'] = TABLE_MOD_STRUCTURE_ITEMS;
			$params['tbl_val'] = $iID;
			$params['sort_order'] = $_GET['sort_order'];
			$params['where'] = "parent_id = '" . $this->current_item_id() . "' ";
			$params['op_where'] = "parent_id = '" . $this->current_item_id() . "' ";
			wt_set_fast_sort_order($params);
			$this->del_cache('item',$iID);
			$this->del_cache('items');
			wt_plugins::run_action($this->module_key, 'setItemOrder', null, $iID);
		}
		die('ok');
	}

	function setFieldOrder() {
		$fID = wt_set_task($_GET, 'fID');
		$pID = wt_set_task($_GET, 'pID',0);
		$tID = wt_set_task($_GET, 'tID',0);
		if( wt_is_valid($fID, 'int', '0') ) {
			$params = array();
			$params['tbl_key'] = 'fi_id';
			$params['tbl'] = TABLE_MOD_STRUCTURE_FIELDS_CONFIG;
			$params['tbl_val'] = $fID;
			$params['sort_order'] = $_GET['sort_order'];
			if(wt_is_valid($tID,'int','0') && !wt_is_valid($pID,'int','0')) {
			$params['where'] = "it_type = '".(int)$tID."' AND parent_id = '0'";
			$params['op_where'] = "it_type = '".(int)$tID."' AND parent_id = '0'";
			} else {
			$params['where'] = "parent_id = '".(int)$pID."' ";
			$params['op_where'] = "parent_id = '".(int)$pID."' ";
			}
			wt_set_fast_sort_order($params);
			wt_fix_sort_order($params);
		}
		die('ok');
	}


	function fieldValues() {
		global $wt_template,$wt_session;

		$language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id'));
		$wt_template->assign('language_id',$language_id);
		$wt_template->display_self = true;
		$fID = wt_set_task($_GET, 'fID');
		$params = array();
		$params['where'] = " fc.parent_id = '".$fID."' AND ";
		$params['language_id'] = $language_id;
		$params['get_depends'] = true;
		$wt_template->assign('fields_listing', $fields_listing = $this->get_config_fields(null, $params) );
		$wt_template->assign('field_data', $field_data = $this->get_config_fields($fID) );
		if(wt_is_valid($field_data['fi_depends_on'],'int','0')) {
			$params = array();
			$params['where'] = " fc.parent_id = '".$field_data['fi_depends_on']."' AND ";
			$params['language_id'] = $language_id;
			$params['group'] = 'fi_id';
			$wt_template->assign('fields_depends', $fields_depends = $this->get_config_fields(null,$params));
			$wt_template->assign('field_data_depends', $this->get_config_fields($field_data['fi_depends_on']));
			unset($_fields_listing,$fields_depends);
		}
			unset($fields_listing,$field_data);
		$wt_template->load_file('fieldValues');
	}

	function addItem() {
		global $wt_template, $wt_session, $wt_language;
		$iID = wt_set_task($_REQUEST, 'iID');
		$itID = wt_set_task($_REQUEST, 'itID');
		$cPath = wt_set_task($_REQUEST, 'cPath');
		$language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id'));
		$wt_template->assign('language_id',$language_id);

		if(!wt_is_valid($itID, 'int', '0') && !wt_is_valid($iID, 'int', '0') ) {

			$cii = $this->current_item_id();
			$tP = array();
			if( wt_is_valid($cii, 'int', '0') ) {
				$wt_template->assign('item_data', $item_data = $this->get_items($cii));
				if( wt_is_valid($item_data['it_type'], 'int', '0') ) {
					$cur_type = $this->get_items_types($item_data['it_type']);

					if($cur_type['itt_children_only']) {
						$alowed_types = explode(',', $cur_type['itt_children_only']);
						wt_clear_empty_array($alowed_types);
						if( wt_is_valid($alowed_types, 'array') ) {
								$tP['where'] .= " ( ";
							foreach($alowed_types as $at) {
								$tP['where'] .= " itt_key = '" . $at . "' OR ";
							}
							$tP['where'] = substr($tP['where'], 0, -4);
							$tP['where'] .= " ) ";
						}
					}
				}
			}

			$wt_template->assign('types_listing', $this->get_items_types(null, $tP));

			if($_REQUEST['_formType'] == 'popup') {
				$wt_template->tFile = 'theme_self_form';
				$wt_template->assign('_formType', $_formType = $_REQUEST['_formType']);
			} else {
				$wt_template->display_self = true;
			}
			$wt_template->load_file('addItemChooseType');

		} else {

	if( wt_is_valid($iID, 'int', '0') ) {
		$action = 'edit';
		$iP = array('language_id' => $language_id);
		$wt_template->assign('item', $item = $this->get_items($iID,$iP));
		$wt_template->assign('item_type', $item_type = $this->get_items_types($item['it_type']));
		$itID = $item['itt_id'];
	} else {
	  	$action = 'add';
		$wt_template->assign('item_type', $item_type = $this->get_items_types($itID));
	}

		if($_REQUEST['_formType'] == 'popup') {
			$wt_template->tFile = 'theme_self_form';
			$wt_template->assign('_formType', $_formType = $_REQUEST['_formType']);
		} else {
			$wt_template->display_self = true;
		}


	  switch( $item_type['itt_key'] ) {
		default:
			  include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addItem.php');
		break;
		case 'shortcut':
		case 'copy':
			  include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addItemCopy.php');
		break;
	  }
	}
} // function

	function addType() {
		global $wt_template;
		$wt_template->display_self = true;
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addType.php');
	}

	function addField() {
		global $wt_template,$wt_language,$wt_session;
		$wt_template->assign('language_id',$language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id')));
		$wt_template->display_self = true;
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addField.php');
	}

	function addImage() {
		global $wt_template;
		$wt_template->display_self = true;
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addImage.php');
	}

	function addFile() {
		global $wt_template;
		$wt_template->display_self = true;
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'addFile.php');
	}

	function moveItem() {
		global $wt_template;
	    $wt_template->display_self = true;
		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'moveItem.php');
	}

	function sortItems() {
		global $wt_template;
    	$wt_template->display_self = true;
        include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'sortItems.php');
	}

	function addNewField() {
		global $wt_template, $wt_session;

		$language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id'));
		$wt_template->display_self = true;
		$parent_id = wt_set_task($_GET, 'parent_id');
		$params = array();
		$params['where'] = " fc.parent_id = '" . $parent_id . "' AND ";
		$params['language_id'] = $language_id;
		$wt_template->assign('fields_listing', $this->get_config_fields(null, $params) );
		$wt_template->assign('field_data', $this->get_config_fields($parent_id) );
		$wt_template->assign('language_id', $language_id);
		$wt_template->load_file('fieldValues');
	}


	function get_config_fields_to_type($itt_id, $params = array()) {
		global $wt_sql, $wt_session;
		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		$cF = array();
		$cF['where'] = " fc.parent_id = '" . (int)$db_data['fi_id'] . "' AND fc.it_type = '" . $itt_id . "' AND ";
		$cF['language_id'] = $language_id;
		$cF['get_children'] = true;
		$cF['group'] = 'fi_id';
		$cF['order'] = 'fc.sort_order';
		return $this->get_config_fields(null, $cF);
	}

	function get_config_fields($fi_id = null, $params = array() ) {
		global $wt_sql,$wt_session,$wt_language;
		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		$data_array = array();
		if( wt_is_valid($fi_id, 'int', '0') ) {
			$db_data_query_raw = "SELECT * FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " fc, " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " fcd WHERE " . ( isset($params['where']) ? '  ' . $params['where'] : '') . " fc.fi_id = '" . (int)$fi_id . "' AND fc.fi_id = fcd.fi_id AND fcd.language_id = '".$language_id."' AND fcd.language_status = '1' LIMIT 1 ";
		} else {
			$db_data_query_raw = "SELECT * FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " fc, " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " fcd WHERE " . ( isset($params['where']) ? '  ' . $params['where'].' ' : '') . " fc.fi_id = fcd.fi_id AND fcd.language_id = '".$language_id."' AND fcd.language_status = '1' ";
			if(wt_not_null($params['order'])) {
				$db_data_query_raw .= " ORDER BY ".$params['order'];
			} elseif(!isset($params['order']) && wt_not_null($this->get_db_sort_order('fields'))) {
				$db_data_query_raw .= " ORDER BY " . $this->get_db_sort_order('fields') . " ";
			} elseif(!isset($params['order']) ) {
				$db_data_query_raw .= " ORDER BY sort_order, fi_name";
			}
			if(wt_not_null($params['limit'])) {
				$db_data_query_raw .= " LIMIT ".$params['limit'];
			}

		}
		$db_data_query = $wt_sql->db_query($db_data_query_raw);
		while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
			if( $params['get_children'] === true ) {
				$fParams = array();
				$fParams['where'] = " fc.parent_id = '" . (int)$db_data['fi_id'] . "' AND ";
				$fParams['get_children'] = true;
				$fParams['language_id'] = $language_id;
				if(wt_not_null($params['group'])) {
					$fParams['group'] = $params['group'];
				}
				if($db_data['fi_type'] == 'select' || $db_data['fi_type'] == 'multi_select') {
					$fParams['order'] = "fcd.fi_name";
				} else {
					$fParams['order'] = "fc.sort_order";
				}
				$db_data['children'] = $this->get_config_fields(null, $fParams);
			}
			if( wt_is_valid($db_data['copy_of'], 'int', '0') ) {
				$cParams = $params;
				unset( $cParams['where'] );
				$db_data = $this->get_config_fields($db_data['copy_of'], $cParams);
			}
			if( $params['get_depends'] == true && wt_is_valid($db_data['fi_related_to'],'int','0') ) {
				$db_data['depends'] = $this->get_config_fields($db_data['fi_related_to']);
			}
			$db_data['languages_status'] = $wt_language->get_item_languages_status($db_data['fi_id'],'fi_id',TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC,$wt_sql);
			$db_data['params_add'] = wt_unserialize($db_data['params_add']);
			if( wt_is_valid($fi_id, 'int', '0') ) {
				$data_array = $wt_sql->db_output_data($db_data);
			} else {
				if(wt_not_null($params['group']) ) {
					$data_array[$db_data[$params['group']]] = $wt_sql->db_output_data($db_data);
				} else {
					$data_array[] = $wt_sql->db_output_data($db_data);
				}

			}
		}
		return $data_array;
	}

	function get_fields_value_to_item($it_id, $params = array()) {
		global $wt_sql,$wt_session;

		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		$data_array = array();
		$db_data_query_raw = "SELECT sf2i.*, sfc.fi_type FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG .' sfc, '. TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " sf2i WHERE " . ( isset($params['where']) ? $params['where'] : '') . " sf2i.fi_id=sfc.fi_id AND sf2i.it_id = '" . (int)$it_id . "' AND sf2i.language_id = '" . (int)$language_id . "' ";
		$db_data_query = $wt_sql->db_query($db_data_query_raw);
		while($db_data = $wt_sql->db_fetch_array($db_data_query)) {

			if($db_data['fi_type'] == 'data_table' || $db_data['fi_type'] == 'user_defined' || $db_data['fi_type'] == 'multi_select' || $db_data['fi_type'] == 'multi_select_item' || $db_data['fi_type']  == 'form') {
				$data_array[$db_data['fi_id']] = wt_unserialize($db_data['fi_value']);
			} elseif ($db_data['fi_type'] == 'files' || $db_data['fi_type'] == 'gallery') {
				$data_array[$db_data['fi_id']] = wt_unserialize($db_data['fi_value']);
				$tmp_array = $data_array[$db_data['fi_id']];
				if (wt_is_valid($tmp_array,'array')) {
					foreach($tmp_array as $k => $file_data) {
						$file = $file_data['file'];
						$src = CFGF_DIR_FS_MEDIA . 'mod_structure' . DIRECTORY_SEPARATOR . $this->generate_media_path($it_id) . DIRECTORY_SEPARATOR . 'fi_'. $db_data['fi_id'] . DIRECTORY_SEPARATOR . $file;
						$data_array[$db_data['fi_id']][$k]['src'] = $src;
						$data_array[$db_data['fi_id']][$k]['size'] = @filesize($src)/(1024*1024);
						$data_array[$db_data['fi_id']][$k]['ext'] = wt_get_file_extension($src);
					}
				}
			} elseif ($db_data['fi_type'] == 'multi_select') {
				$data_array[$db_data['fi_id']][] = $db_data['fi_value'];
			} else {
				$data_array[$db_data['fi_id']] = $db_data['fi_value'];
			}
		}
		return $wt_sql->db_output_data($data_array);
	}

	function parse_options_for_form( $ch = array(), $params = array() ) {
		$options = array();
		if( !isset( $params['dont_add_blank'] ) )	 {
			$options[''] = ' --- wybierz ---';
		}
		if( wt_is_valid($ch, 'array') ) {
			foreach( $ch as $c ) {
				if( wt_is_valid($c['fi_id'], 'int', '0') && wt_not_null($c['fi_name']) ) {
					$options[$c['fi_id']] = $c['fi_name'];
				}
			}
		}
		return $options;
	}


	function get_items_types($itt_id = null, $params = array()) {
		global $wt_sql, $wt_session, $wt_template, $wt_user;

		$types_array = array();
		if(wt_is_valid($itt_id,'int','0')) {
			$db_type_query_raw = "SELECT * FROM " . TABLE_MOD_STRUCTURE_ITEMS_TYPE ." WHERE " . ($params['where'] ? $params['where'] : '') . "  itt_id = '" . $itt_id ."' ORDER BY itt_id";
		} else {

			if( $wt_user->usr_info['usr_id'] != 1 && !isset($params['disable_root_check'])) {
				if( isset($params['where']) ) {
					$params['where'] .= " AND itt_root_edit = '0' ";
				} else {
					$params['where'] = " itt_root_edit = '0' ";
				}
			}

			$db_type_query_raw = "SELECT * FROM " . TABLE_MOD_STRUCTURE_ITEMS_TYPE . ($params['where'] ? " WHERE " . $params['where'] : '');
			if( isset($params['order']) && wt_not_null($params['order']) ) {
				$db_type_query_raw .= " ORDER BY " . $params['order'] . " ";
			} elseif (!isset($params['order']) && wt_not_null($this->get_db_sort_order('types'))) {
					$db_type_query_raw .= " ORDER BY " . $this->get_db_sort_order('types') . " ";
			} else {
				$db_type_query_raw .= " ORDER BY itt_name ";
			}

			if( isset($params['limit']) && wt_not_null($params['limit']) ) {
				$db_type_query_raw .= " LIMIT " . $params['limit'] . " ";
			}
		}

		$db_type_query = $wt_sql->db_query($db_type_query_raw);
		while($db_type = $wt_sql->db_fetch_array($db_type_query)) {

			if( !wt_not_null($db_type['itt_ico']) ) {
				$db_type['itt_ico'] = $db_type['itt_key'];
			}

		if(wt_is_valid($itt_id,'int','0') || $params['get_array'] == true) {
				$types_array = $wt_sql->db_output_data($db_type);
			} else {
				$types_array[] = $wt_sql->db_output_data($db_type);
			}
		}
		return $types_array;


	}

	function get_items($it_id = null, $params = array()) {
		global $wt_sql, $wt_session, $wt_template, $wt_language, $wt_user;

		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

			if( $wt_user->usr_info['usr_id'] != 1 && !isset($params['disable_root_check'])) {
					$params['where'] .= " sit.itt_root_show = '0' AND ";
			}


		$data_array = array();
		if(wt_is_valid($it_id, 'int', '0')) {
			$db_data_query_raw = "SELECT si.*, sid.*, sit.itt_name, sit.itt_id, sit.itt_key, sit.itt_ico, sit.itt_root_edit, sit.itt_root_addchildren, sit.itt_nochildren, sit.itt_children_only_tree, sit.itt_disable_languages, sit.params AS itt_params, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM " . TABLE_MOD_STRUCTURE_ITEMS . " si, " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " sid, ". TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit WHERE " . (isset($params['where']) ? $params['where'] : '') . " si.it_id = '" . $it_id . "' AND si.status > -1 AND si.it_id = sid.it_id AND si.it_type=sit.itt_id AND sid.language_id = '" . $language_id . "'  LIMIT 1";
		} else {
			if (wt_not_null($params['field_order'])) {
				$db_data_query_raw = "SELECT si.it_id, si.it_id2,si.import_id, si.cPath, si.parent_id, si.it_type, si.status, si.has_children, si.sort_order, sid.language_id, sid.it_name, sid.it_name_short, sid.tags, sid.it_desc_short, sid.it_desc, sid.it_logo, sit.itt_name, sit.itt_key, sit.itt_ico, sit.itt_root_edit, sit.itt_root_show, sit.itt_root_addchildren, sit.itt_nochildren, sit.itt_children_only_tree, sit.itt_disable_languages, sit.params AS itt_params IF(sf2i.fi_id IS NULL OR sf2i.fi_value='',1,0) AS isnull, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM (".TABLE_MOD_STRUCTURE_ITEMS." si, ".TABLE_MOD_STRUCTURE_ITEMS_DESC." sid, ".TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit) LEFT JOIN ".TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS." sf2i ON si.it_id=sf2i.it_id AND sf2i.fi_id='".$params['field_order']."' AND sf2i.language_id = '" . $language_id . "' LEFT JOIN ".TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC." sfcd ON sf2i.fi_value=sfcd. fi_id AND sfcd.language_id = '" . $language_id . "' WHERE " . (isset($params['where']) ? $params['where'] : '') . " si.it_id = sid.it_id AND si.it_type=sit.itt_id AND si.status > -1 AND sid.language_id = '" . $language_id . "' GROUP BY si.it_id ORDER BY isnull ASC, sfcd.fi_name ".(isset($params['field_order_desc']) ? 'DESC' : 'ASC');
			} else {
				$db_data_query_raw = "SELECT si.it_id, si.it_id2,si.import_id, si.cPath, si.parent_id, si.it_type, si.status, si.has_children, si.sort_order, sid.language_id, sid.it_name, sid.it_name_short, sid.tags,  sid.it_desc_short, sid.it_desc, sid.it_logo, sit.itt_name, sit.itt_key, sit.itt_ico, sit.itt_root_edit, sit.itt_root_addchildren, sit.itt_root_show, sit.itt_nochildren, sit.itt_children_only_tree, sit.itt_disable_languages, sit.params AS itt_params, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM " . TABLE_MOD_STRUCTURE_ITEMS . " si, " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " sid, ".TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit WHERE " . (isset($params['where']) ? $params['where'] : '') . " si.it_id = sid.it_id AND si.it_type=sit.itt_id AND si.status > -1 AND sid.language_id = '" . $language_id . "'";
				if( isset($params['order']) && wt_not_null($params['order']) ) {
					$db_data_query_raw .= " ORDER BY " . $params['order'] . " ";
				} elseif (!isset($params['order']) && wt_not_null($this->get_db_sort_order('items'))) {
					$db_data_query_raw .= " ORDER BY " . $this->get_db_sort_order('items') . " ";
				}
			}
			if(!isset($params['dsplit'])) {
				$this->split_listing =  new splitPageResults($_GET['page'], MAX_ADMIN_DISPLAY_SEARCH_RESULTS, $db_data_query_raw, $this->db_items_query_numrows, '*', $wt_sql);
			}
		}
		$db_data_query = $wt_sql->db_query($db_data_query_raw);
		$mod_structure = wt_module::singleton('mod_structure');
		while($db_data = $wt_sql->db_fetch_array($db_data_query)) {

			if( wt_is_valid($db_data['it_id2'], 'int', '0') ) {
				$db_data['source_id'] = $db_data['it_id2'];
				$source_data = $this->get_items($db_data['it_id2']);
				if( !wt_is_valid($source_data, 'array') )	{
					continue;
				}
				if( $db_data['itt_key'] == 'shortcut' ) {
					if( wt_not_null($db_data['it_name']) ) {
						 $db_data['it_name2'] = $source_data['it_name'];
					} else {
						$db_data['it_name'] = $source_data['it_name'];
					}
					 $db_data['it_desc'] = $source_data['it_desc'];
					 $db_data['it_desc_short'] = $source_data['it_desc_short'];
					 $db_data['it_logo'] = $source_data['it_logo'];
					 $db_data['cPath'] = $source_data['cPath'];
				}
				if( $db_data['itt_key'] == 'copy' ) {
					$_db_data = $db_data;
					$db_data = $source_data;
					$db_data['it_id2']	= $_db_data['it_id'];
					$db_data['it_id']	= $_db_data['it_id'];
					$db_data['itt_key']	= $_db_data['itt_key'];
					$db_data['itt_name']	= $_db_data['itt_name'];
					$db_data['itt_ico']	= $_db_data['itt_ico'];
				}
			} else {
				$db_data['source_id'] = $db_data['it_id'];
			}

				$db_data['media_path'] = $this->generate_media_path($db_data['source_id']);

		 if($params['get_fields'] === true) {
				$fParams = array();
				$fParams['show_on_short'] = true;
				$fParams['group'] = true;
				$fParams['language_id'] = $language_id;

				if($params['dgroup_fields'] === true) {
					$db_data['fields'] =	$mod_structure->get_fields_to_item($db_data['it_id'], $fParams);
				} else {

					$db_data['fields'] =	$mod_structure->set_group_fields($mod_structure->get_fields_to_item($db_data['it_id'], $fParams));
				}

		 }

		 if($params['count_children'] == true ) {
				if($db_data['has_children']) {
					$db_count_query = $wt_sql->db_query("SELECT count(si.it_id) AS total FROM ".TABLE_MOD_STRUCTURE_ITEMS." si, ".TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit WHERE si.cPath LIKE '".$db_data['cPath']."_%' AND sit.itt_id = si.it_type AND sit.itt_nochildren = '1'");
					$db_count = $wt_sql->db_fetch_array($db_count_query);
					$db_data['count_children'] = $db_count['total'];

					$db_count_query = $wt_sql->db_query("SELECT count(it_id) AS total FROM ".TABLE_MOD_STRUCTURE_ITEMS." WHERE cPath LIKE  '".$db_data['cPath']."_%'");
					$db_count = $wt_sql->db_fetch_array($db_count_query);
					$db_data['count_children_recursive'] = $db_count['total'];
				} else {
					$db_data['count_children'] = 0;
				}
		 }


			$db_data['_aCC'] = wt_encrypt_password($db_data['it_id'].SITE_NAME.CFGF_HTTP_SERVER.CFG_SECRET_PHRASE.$db_data['cPath']);

			$db_data['status_text'] = wt_return_item_status_easy($db_data['status']);
			$db_data['params_array'] = wt_unserialize($db_data['params']);
			$db_data['itt_params_array'] = wt_unserialize($db_data['itt_params']);


			if (wt_not_null($db_data['itt_params_array']['itemPage_theme'])) {
				$asdasd = $db_data['itt_params_array']['itemPage_theme'];
				$file_name = substr($asdasd,strpos($asdasd,'---')+3);
				$db_data['page_theme'] = 'itemPage_'.$db_data['itt_key']."/".$file_name.".tpl";
			} else {
				$db_data['page_theme'] = 'itemPage_'.$db_data['itt_key'].".tpl";
			}
			if (wt_not_null($db_data['itt_params_array']['itemList_theme'])) {
				$asdasd = $db_data['itt_params_array']['itemList_theme'];
				$file_name = substr($asdasd,strpos($asdasd,'---')+3);
				$db_data['list_theme'] = 'itemList_'.$db_data['itt_key']."/".$file_name.".tpl";
			} else {
				$db_data['list_theme'] = 'itemList_'.$db_data['itt_key'].".tpl";
			}

			if( !wt_not_null($db_data['itt_ico']) ) {
				$db_data['itt_ico'] = $db_data['itt_key'];
			}
				$db_data['level'] = count(explode('_', $db_data['cPath']));
				$db_data['languages_status'] = $wt_language->get_item_languages_status($db_data['it_id'],'it_id',TABLE_MOD_STRUCTURE_ITEMS_DESC,$wt_sql);

			if(wt_is_valid($it_id, 'int', '0')) {
				$data_array = $wt_sql->db_output_data($db_data);
			} else {
				wt_prepare_item_desc($db_data['it_desc_short'], $db_data['it_desc']);
				unset($db_data['it_desc']);
				$data_array[] = $wt_sql->db_output_data($db_data);
			}
		}

		return $data_array;

	}



	function getItemsForAutocompletion() {
   		global $wt_template;

   		$params = array();
   		$params['dsplit'] = true;
   		$params['order'] = 'sid.it_name';
   		$products=array();
   		if (wt_not_null($_REQUEST['item'])) {
   			$params['where'] = " (sid.it_name LIKE '%".$_REQUEST['item']."%') AND ";
   			$items = $this->get_items(null,$params);
   			if (wt_is_valid($items,'array')) {
   				$items_tmp = array();
   				foreach ($items as $key => $it) {
   					$it['reverse_path'] = implode(' &raquo ',$this->get_item_path_reverse($it['it_id']));;
   					$items_tmp[$key] = $it;
   				}
   				$items = $items_tmp;
   			}
   		}
   		$wt_template->display_self=true;
   		$wt_template->assign('items',$items);
	   	$wt_template->load_file('sub/autocompletion_list.tpl');
	}

	function getSortList() {
		global $wt_template;

		$parent_id = wt_set_task($_GET,'iID');
		$params = array();
		$params['where'] = " si.parent_id = '" . (int)$parent_id . "' AND ";
		$params['dsplit'] = true;
		$it_array = $this->get_items(null, $params);
		$sort_order = array();
		$sort_order[-1000] = 'Pierwszy';
		if( wt_is_valid( $it_array, 'array' ) ) {
			foreach( $it_array as $it ) {
				$sort = $it['sort_order']+0.5;
				$sort_order["$sort"] = '   Po: ' . $it['it_name'];
			}
			$sort_order[10000] = 'Ostatni';
		}
		$wt_template->display_self = true;
		$wt_template->assign('sort_order',$sort_order);
		$wt_template->load_file('sub/sortOrder_list.tpl');
	}



	function parse_category_patch($path = array()) {
		if( wt_is_valid($path, 'array') ) {
			return implode('_', $path);
		}
		return '';
	}

	function get_item_path_reverse($it_id) {
		global $wt_sql, $wt_session;

		$items_data = array();
		$it_data = $this->get_items($it_id);
		$cPath_array = explode('_', $it_data['cPath']);
		krsort($cPath_array);
		foreach($cPath_array as $it_id) {
			$it_data = $this->get_items($it_id);
			$items_data[] = $it_data['it_name'];
		}
		return $items_data;
	}


	function get_item_new_path($it_id, $cPath = array()) {
		global $wt_sql;

		$db_cPath_query = $wt_sql->db_query("SELECT it_id, parent_id FROM " . TABLE_MOD_STRUCTURE_ITEMS . " WHERE it_id = '" . $it_id . "'");
		while($db_cPath = $wt_sql->db_fetch_array($db_cPath_query)) {
			$cPath[] = $db_cPath['it_id'];
			if($db_cPath['it_id'] != '0') {
				$cPath = $this->get_item_new_path($db_cPath['parent_id'], $cPath);
			}
		}
		krsort($cPath);
		return $cPath;
	}

	function get_item_path($it_id = null) {
	    global $wt_sql;
		if( wt_is_valid( $it_id, 'int', '0' ) ) {
			$db_cPath_query = $wt_sql->db_query("SELECT cPath FROM " . TABLE_MOD_STRUCTURE_ITEMS . " WHERE it_id = '" . $it_id . "' LIMIT 1");
			$db_cPath = $wt_sql->db_fetch_array($db_cPath_query);
			return $db_cPath['cPath'];
	   	}
	  	return '';
	}

	function current_item_id($cPath = '') {
		if( !wt_not_null($cPath) ) {
			$cPath = wt_set_task($_REQUEST, 'cPath');
		}
		$_cPath = explode('_', $cPath);
		return (int)$_cPath[count($_cPath)-1];
	}

	function update_item_cPath($it_id) {
		global $wt_sql, $wt_user;

		if( wt_is_valid($it_id, 'int', '0') ) {
			$cPath = $this->parse_category_patch($this->get_item_new_path((int)$it_id));
			$oldPath = $this->get_item_path($it_id);
			$this->del_cache('item',$it_id);
			$this->del_cache('items');
			if( $cPath != $oldPath ) {
				$sql_data_array = array('cPath' => $cPath,
										'last_modified' => 'now()',
										'modified_by' => $wt_user->usr_info['usr_id']);
				$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS, $sql_data_array, 'update', "it_id='" . (int)$it_id . "' LIMIT 1");
				$cParams = array();
				$cParams['where'] = " si.cPath LIKE '" . $oldPath . "\_%' AND ";
				$cParams['dsplit'] = true;
				$items_data = $this->get_items(null, $cParams);
				if( wt_is_valid($items_data, 'array') ) {
					foreach( $items_data as $i ) {
						$sql_data_array = array('cPath' => str_replace($oldPath, $cPath, $i['cPath']),
												'last_modified' => 'now()',
												'modified_by' => $wt_user->usr_info['usr_id']);
						$wt_sql->db_perform(TABLE_MOD_STRUCTURE_ITEMS, $sql_data_array, 'update', "it_id='" . (int)$i['it_id'] . "' LIMIT 1");
					}
					unset($cat_data);
				}
			}
		}
	}

	function update_item_has_children($it_id = null) {
		global $wt_sql;

		if( wt_is_valid($it_id, 'int', 0) ) {
			$Ccparams = array();
			$Ccparams['where'] = " si.parent_id = '" . $it_id . "' AND ";
			$Ccparams['limit'] = '1';
			$check_item_children = $this->get_items(null, $Ccparams);
			$this->del_cache('item',$it_id);
			$this->del_cache('items');

			if(wt_is_valid($check_item_children, 'array')) {
				$wt_sql->db_query("UPDATE " . TABLE_MOD_STRUCTURE_ITEMS . " SET has_children = '1' WHERE it_id = '" . (int)$it_id . "' LIMIT 1");
			} else {
				$wt_sql->db_query("UPDATE " . TABLE_MOD_STRUCTURE_ITEMS . " SET has_children = '0' WHERE it_id = '" . (int)$it_id . "' LIMIT 1");
			}
		}


	}

	function _mod_menu($params = array(), $admin = false ) {
		$menu_data[] = array('mod_ico' => true,
		'href' => wt_href_link('mod_structure_manager'),
		'ico' => $this->module_key  );
		if( $admin === true ) {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu_admin.php');
		} else {
			include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . '_mod_menu.php');
		}
		return $menu_data;
	}

	function _structureJSTree($data = false) {
		global $wt_template;

		$structure = array();
		if( $data === true ) {

			$structure['children'] = $this->get_structure_tree(0);

		} else {
			$structure = array('title' => 'Katalogi',
				'ico' => '',
				'link' => wt_href_link('mod_structure_manager'),
				'target' => 'site',
				'url' => wt_href_link('mod_structure_manager') );
		}
		return $structure;
	}

	function get_structure_tree($parent_id = 0, $params = array() ) {

		$items = array();
		$Cparams = array();
		$Cparams['where'] = " si.parent_id = '" . (int)$parent_id . "' AND ";
		if( isset($params['where']) && wt_not_null($params['where']) ) {
			$Cparams['where'] .= $params['where'];
		}
		$Cparams['dsplit'] = true;
		$Cparams['order'] = 'si.sort_order';
		$items_data = $this->get_items(null, $Cparams);
		if (wt_is_valid($items_data,'array')) {
			foreach($items_data as $it) {
				//	if($cat['has_children'] == '1') {
				$item = array();
				$name = '';
				if( $it['itt_key'] == 'shortcut' ) {
					$name .= '<small>skrót:</small> ';
				}
				if( $it['itt_key'] == 'copy' ) {
					$name .= '<small>kopia:</small> ';
				}
					$name .= $it['it_name'];



					$item = array('type' => 'folder',
								'ico' => $it['itt_ico'] . '_s.gif',
								'status' => $it['status'],
								'name' => $name,
								'url' => wt_href_link('mod_structure_manager', '', 'cPath=' . $it['cPath'] . ($it['itt_key'] == 'shortcut' ? '&from=shortcut' : '') ));
							$cP = array();

				 if(wt_not_null($it['itt_children_only_tree']) && $it['itt_children_only_tree'] != 'none' ) {
						$childrens_type = explode(',', $it['itt_children_only_tree']);
						wt_clear_empty_array($childrens_type);

						if( wt_is_valid($childrens_type, 'array') ) {
							$childres_query = ' (';
							foreach($childrens_type as $ct) {
								$childres_query .= " sit.itt_key = '" . $ct . "' OR ";
							}
							$childres_query = substr($childres_query, 0, -4);
							$childres_query .= ") AND ";
							$cP['where'] = $childres_query;
						}
				  	}

			 if( $it['has_children'] == '1' && $it['itt_children_only_tree'] != 'none' ) {
					$item['children'] = $this->get_structure_tree($it['it_id'], $cP);
			 }
					  //	$it['itt_children_only_tree'];

				//		}
				$items[] = $item;
			}
		}
		return $items;
	}

	function wt_navigationbar() {
		global $wt_template, $wt_navigationbar;

			$cPath_array = explode('_', wt_set_task($_REQUEST, 'cPath'));
			if(wt_is_valid($cPath_array, 'array')) {
				foreach($cPath_array as $it_id) {
					if( wt_is_valid($it_id, 'int', '0') ) {
						$it = $this->get_items($it_id);
						if( wt_is_valid($it, 'array') ) {
							$wt_navigationbar->add($it['it_name'], wt_href_link('mod_structure_manager', '', 'cPath=' . $it['cPath']));
						}
					}
				}
			}

						if( $this->mode == 'types') {
							$wt_navigationbar->add('Typy wpisów', wt_href_link('mod_structure_manager', '', 'm=types'));
						}

			$tID = wt_set_task($_REQUEST, 'tID');
			if(wt_is_valid($tID, 'int','0')) {
						$it = $this->get_items_types($tID);
						if( wt_is_valid($it, 'array') ) {
							$wt_navigationbar->add('Typy wpisów', wt_href_link('mod_structure_manager', '', 'm=types'));
							$wt_navigationbar->add($it['itt_name'], wt_href_link('mod_structure_manager', '', 'm=fields&tID='.$it['itt_id']));
						}
			}

	  //	}
	} // function


		function get_items_tree($parent_id = 0, $params = array(), $items_tree_array = array()) {
		global $wt_sql, $wt_session;

		$iP = array();
		$iP['dsplit'] = true;
		$iP['order'] = 'si.sort_order ASC';
		$iP['where'] = "si.parent_id = '" . $parent_id . "' AND ";
		$db_items = $this->get_items(null, $iP);
		foreach ($db_items as $it) {

			if( $it['itt_nochildren'] == '1' && $it['parent_id'] != '0' ) {
				continue;
			}

				$level = count(explode('_', $it['cPath']));
				$it['level'] = $level;
				$it['it_name_formated'] = str_repeat('&nbsp;&nbsp;&nbsp;', $level-1) . $it['it_name'];
				$items_tree_array[] = $it;
		if( $it['has_children'] == '1' ) {
			$items_tree_array = $this->get_items_tree($it['it_id'], $params, $items_tree_array);
		  }
		}
		return $items_tree_array;
	}

	function get_items_tree_for_form($params = array()) {
		$items_tree_for_dropdown_menu = $this->get_items_tree(0);
		$dropdown_array = array();
		$_params = array('id_type' => 'it_id');
				$dropdown_array['0'] = ' --- root --- ';
		$params = array_merge($_params, $params);
			foreach($items_tree_for_dropdown_menu as $it) {
				if( $it['itt_type'] != 'shortcut' ) {
				$dropdown_array[$it[$params['id_type']]] = $it['it_name_formated'];
				}
			}
		return $dropdown_array;
	}

	function get_items_type_for_form($params = array()) {
	$_itt_array = $this->get_items_types();
	$itt_array = array();
	if( wt_is_valid($_itt_array, 'array') ) {
		foreach($_itt_array as $it) {
			$itt_array[$it['itt_key']] = $it['itt_name'].' ['.$it['itt_key'].']';
		}
	}
		return $itt_array;
	}

	function get_cpath_to_items_tree($it_id = null) {
		global $wt_sql;

		if(wt_is_valid($it_id,'int','0')) {
		$db_check_query = $wt_sql->db_query("SELECT si1.cPath AS cPath_parent, si2.cPath AS cPath_current, sit1.itt_children_only_tree, sit2.itt_key FROM  ".TABLE_MOD_STRUCTURE_ITEMS." si1, ".TABLE_MOD_STRUCTURE_ITEMS." si2, ".TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit1, ".TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit2 WHERE si2.it_id = '".$it_id."' AND si1.it_id = si2.parent_id AND si1.it_type = sit1.itt_id AND si2.it_type = sit2.itt_id LIMIT 1");
		$db_check = $wt_sql->db_fetch_array($db_check_query);
		$children = explode(',',$db_check['itt_children_only_tree']);
		if(in_array($db_check['itt_key'],$children) || in_array('',$children) ) {
			return $db_check['cPath_current'];
		} else {
			return $this->get_cpath_to_items_tree($this->current_item_id($db_check['cPath_parent']));
		}

	}

	}

	function scan_import_dir($dir=null) {
		if(!wt_not_null($dir)) {
			$dir = $this->import_dir;
		}
		$files = array();
		if($d = @dir($dir)) {
      	while ($entry = $d->read()) {
	        if ($entry != '..' && $entry != '.' && $entry != 'index.html' && is_file($dir.$entry) === true) {
	          $files[] = $entry;
	        }
	      }
		}

		return $files;
	} // function


} // class
?>
