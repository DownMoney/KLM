<?

class mod_structure {
	var $task;
	var $action;
	var $mode;
	var $module_dir;
	var $module_class;
	var $module_key;
	var $module_params;
	var $split_listing;

	function mod_structure() {
		global $wt_module;
		$this->module_dir = dirname(__FILE__);
		$this->module_class = get_class($this);
		$this->module_key = basename($this->module_dir);
		$this->module_params = $wt_module->get_module_params($this->module_key);
		$this->sort_order_filter = explode("\n",$this->module_params->get('sort_order_filters'));
	}

	function get_module_path() {
		return $this->module_dir;
	}

	function get_module_class() {
		return $this->module_class;
	}

	function get_module_key() {
		return $this->module_key;
	}

	function __construct() {
		$class_name = __CLASS__;
		$this->$class_name();

	}

	function _init() {
		global $wt_module;


		$this->task = wt_set_task($_REQUEST, 't');
		$this->action = wt_set_task($_REQUEST, 'a');
		$this->mode = wt_set_task($_REQUEST, 'm');

		if(!wt_not_null($this->action))  {
			$this->wt_navigationbar();
			switch($this->task) {
				default:
				case 'mP':
				case 'mainPage':
					$this->mainPage();
					break;
				case 'iP':
				case 'itemPage':
					$this->itemPage();
					break;
				case 'fP':
				case 'fieldPage':
					$this->fieldPage();
					break;
				case 'dF':
				case 'downloadFile':
					$this->downloadFile();
					break;
				case 'sF':
				case 'sendForm':
					$this->sendForm();
					break;
			}
		}
	}

	function downloadFile() {
		global $wt_template;
		$fi = wt_set_task($_GET, 'fi');
		$iID = wt_set_task($_GET, 'iID');
		$fID = wt_set_task($_GET, 'fID');
		if( wt_not_null($fi) && wt_is_valid($iID, 'int', '0')) {
		$item = $this->get_items($iID, array('group_fields' => true));

		$file_name = '';
		foreach($item['fields_group'] as $f) {
			if( $f['i'] == $fID ) {
				foreach($f['n'] as $_f) {
					if($_f['file'] == $fi) {
						if( wt_not_null($_f['name']) ) {
							$file_name .= $_f['name'].' ';
						}
						break 2;
					}
				}
			}
		}
		if(!wt_not_null($file_name)) {
			$file_name = basename($fi, wt_get_file_extension($fi)).' ';
		}

		$file_name .= $item['it_name'];
		$file_src = CFGF_DIR_FS_MEDIA.'mod_structure'.DIRECTORY_SEPARATOR.$item['media_path'].DIRECTORY_SEPARATOR.'fi_'.$fID.DIRECTORY_SEPARATOR.$fi;
		if(!file_exists($file_src)) {
			die('brak pliku');
		}
		ob_start();
		$headers = array();
		$headers['Cache-Control'] = 'no-cache, must-revalidate';
		$headers['Expires'] = 'Mon, 26 Jul 1997 05:00:00 GMT';
		$headers['Content-Type'] = 'application/'.wt_get_file_extension($fi).'; charset=UTF-8;';
		$headers['Content-Length'] = @filesize($file_src);
		$headers['Content-Disposition'] = 'attachment; filename=' . substr(wt_safe_string($file_name).'-'.wt_safe_string(SITE_NAME),0,64).'.'.wt_get_file_extension($fi);
		$headers['Content-Transfer-Encoding'] = 'binary';
      $wt_template->set_headers($headers, true);
		$wt_template->load_headers();
		ob_end_clean();
		readfile($file_src);
	  	die();
		}
	}


	/*
function set_sort_order($table = 'products', $default = '0d') {
  		global $wt_session, $wt_template;
		$sort = wt_set_task($_GET, 'sort');
		$sort_orders = $wt_session->value('sort_orders');
		if( !wt_not_null($sort_orders[$this->module_key][$table]) ) {
			$sort_orders[$this->module_key][$table] = $default;
		}


		if( wt_not_null($sort) && wt_not_null( $this->sort_order_filter[(int)$sort] ) )	{
			$sort_orders[$this->module_key][$table] = $sort;
		}
		$wt_session->set('sort_orders', $sort_orders);
		$wt_template->assign('sort_orders',$sort_orders[$this->module_key]);

  	}
*/

	function get_db_sort_order($table = 'items') {
		global $wt_session;
		$sort_orders = $wt_session->value('sort_orders');
	 	return 	wt_get_sort_order_for_items_to_db($this->sort_order_filter, null, null);
  	}

	function fieldPage() {
		global $wt_template, $wt_sql;

		$fID = wt_set_task($_GET, 'fID');
		$cID = wt_set_task($_GET, 'cID');
		$iID = wt_set_task($_GET, 'iID');
		$vfID = wt_set_task($_GET, 'vfID');
		if( wt_is_valid($fID, 'int', '0') && wt_is_valid($cID, 'int', '0') && wt_is_valid($iID, 'int', '0') ) {
			$wt_template->assign('item_data', $item_data =  $this->get_items($iID) );
			$fP = array();
			$fP['where'] = " sf2i.it_id = '" . (int)$iID . "' AND sf2i.fi_id = '" . (int)$fID . "' ";
			$_fd = $this->get_fields(null, $fP);
			if( wt_is_valid($_fd[0], 'array') ) {
				$wt_template->assign('field_data', $fd = $_fd[0]);

				if( wt_not_null($vfID) && wt_is_valid($fd['fi_value'], 'array')  ) {
					foreach($fd['fi_value'] as $k => $fv) {
						if($fv['file'] == $vfID) {
							$wt_template->assign('field_value_prev', $fd['fi_value'][$k-1]);
							$wt_template->assign('field_value', $fv);
							$wt_template->assign('field_value_next', $fd['fi_value'][$k+1]);
						}
					}
				}
			}
			$wt_template->load_file($item_data['itt_key'] .  '_fieldPage');
		}
	}

	function current_item_id($cPath = '') {
		if( !wt_not_null($cPath) ) {
			$cPath = wt_set_task($_REQUEST, 'cPath');
		}
		if(wt_not_null($cPath)) {
			$_cPath = explode('_', $cPath);
			$iID = $_cPath[count($_cPath)-1];
		} else {
			$iID = wt_set_task($_REQUEST,'iID');
		}
		return (int)$iID;
	}

	function itemPage() {
		global $wt_template, $wt_sql;

		$cPath = wt_set_task($_GET,'cPath');
		$iSearch = wt_set_task($_REQUEST, 'iSearch');
		$iID = $this->current_item_id();

  if( wt_is_valid($iID, 'int', '0') ) {
	 $iP = array();
	 $iP['group_fields'] = true;
	 $iP['ndel_fields'] = true;
	 $iP['get_path'] = true;

	 if(wt_set_task($_REQUEST, '_aCI') == '1' && wt_validate_password($iID.SITE_NAME.CFGF_HTTP_SERVER.CFG_SECRET_PHRASE.$cPath, wt_set_task($_REQUEST, '_aCC')) ) {
	 	$iP['admin_call'] = true;
	 }


		$wt_template->assign('item', $item_data = $this->get_items($iID, $iP) );

if( wt_is_valid($item_data, 'array') ) {


			if (wt_is_valid($item_data['fields']['form']['children'],'array')) {

					foreach ($item_data['fields']['form']['children'] as $key => $child) {

						if ($child['fi_type'] == 'form') {
							$item_form = $child['fi_value'];

							include($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'generateItemForm.php');
						}
					}
			 }

		if( wt_is_valid($item_data['parent_id'], 'int', '0') ) {
			$wt_template->assign('parent_item', $parent_item = $this->get_items($item_data['parent_id']));
		}
			$itt_params = new wt_params($item_data['itt_params']);

		if ($item_data['has_children']=='1' || wt_is_valid($iSearch,'array') ) {
			$params = array();
		  	if($iP['admin_call'] === true) {
				$params['admin_call'] = true;
			}

			if( $itt_params->get('get_children', '1') == '1' ) {

			if( !isset($iSearch['cPath']) ) {
				if($itt_params->get('get_recursive', '0') == '1') {
				$params['where'] = " si.cPath LIKE '".$item_data['cPath']."\_%' AND ";
				} else {
				$params['where'] = " si.parent_id='".$iID."' AND ";
				}
			}
			if (wt_is_valid($itt_params->get('list_only_children'), 'array')) {
					$params['where'] .= " ( ";
					foreach($itt_params->get('list_only_children') as $at) {
						$params['where'] .= " itt_key = '" . $at . "' OR ";
					}
					$params['where'] = substr($params['where'], 0, -4);
					$params['where'] .= " ) AND ";
			}

			if (wt_not_null($itt_params->get('sort_order'))) {

				if(wt_not_null($itt_params->get('sort_order_type'))) {
					$params['order'] = "CONVERT(".$itt_params->get('sort_order').",".$itt_params->get('sort_order_type').") ";
				} else {
					$params['order'] = $itt_params->get('sort_order');
				}
				if (wt_not_null($itt_params->get('sort_order_desc'))) {
				$params['order'] .= " ".$itt_params->get('sort_order_desc');
				}
			}

			if (wt_is_valid($itt_params->get('sort_order_fi_id'),'int','0')) {
				$params['order_fi_id'] = $itt_params->get('sort_order_fi_id');
				$params['sort_order_fi_id_type'] = $itt_params->get('sort_order_fi_id_type');
				if (wt_not_null($itt_params->get('sort_order_fi_id_desc'))) {
				$params['order_fi_id_desc'] = $itt_params->get('sort_order_fi_id_desc');
				}
			}

			$params['get_fields'] = true;
			$params['group_fields'] = true;
			$params['del_fields'] = true;
			$params['split'] = $itt_params->get('split_children', '0');
			$params['limit'] = $itt_params->get('children_limit');

			if( wt_is_valid($iSearch, 'array') ) {
				$this->parse_search_params($params, $iSearch);
				$params['order'] = '';
			}

			if(wt_not_null($sort = $this->get_db_sort_order('items'))) {
				if(substr($sort,0,5) == 'fi_id') {
					$params['order_fi_id'] = (int)substr($sort,6);
					$sort_desc = explode(' ',$sort);
					$params['order_fi_id_desc'] = $sort_desc[1];
				} else {
					$params['order'] = $sort;
				}
			}

			$wt_template->assign('sort_orders',wt_set_task($_REQUEST,'sort'));
			if( !isset($params['not_finded']) ) {
				$wt_template->assign('items_listing', $items_listing = $this->get_items(null,$params));
			}

	  if( $params['split'] == true && wt_is_valid($this->split_listing, 'object'))	{
			$NAV_t = $this->split_listing->display_count($this->db_query_numrows, $this->module_params->get($cID . 'limit', MAX_DISPLAY_SEARCH_RESULTS), $_GET['page'], TEXT_SPLITPAGE_FROM . ' <b>%s</b> '.TEXT_SPLITPAGE_TO.' <b>%s</b> ('.TEXT_SPLITPAGE_FROM_TOTAL.' %s)');
			$wt_template->assign('NAV_t', $NAV_t);
			$NAV_tl = $this->split_listing->display_text_links(MAX_DISPLAY_PAGE_LINKS);
			$wt_template->assign('NAV_tl', $NAV_tl);
			$wt_template->assign('total_items_listing', $this->db_query_numrows);
	  }
}

	if( $itt_params->get('get_childrencat', '0') == '1' ) {
				$params = array();

				if($itt_params->get('get_childrencat_recursive', '0') == '1') {
				$params['where'] = " si.cPath LIKE '".$item_data['cPath']."\_%' AND ";
				} else {
				$params['where'] = " si.parent_id='".$iID."' AND ";
				}

			if (wt_is_valid($itt_params->get('childrencat_types'), 'array')) {
					$params['where'] .= " ( ";
					foreach($itt_params->get('childrencat_types') as $at) {
						$params['where'] .= " itt_key = '" . $at . "' OR ";
					}
					$params['where'] = substr($params['where'], 0, -4);
					$params['where'] .= " ) AND ";
			}

			if (wt_not_null($itt_params->get('childrencat_sort_order'))) {
				$params['order'] = $itt_params->get('childrencat_sort_order');
				if (wt_not_null($itt_params->get('childrencat_sort_order_desc'))) {
				$params['order'] .= " ".$itt_params->get('childrencat_sort_order_desc');
				}
			}

			$params['get_fields'] = true;
			$params['group_fields'] = true;
			$params['del_fields'] = true;
			$wt_template->assign('itemscat_listing', $itemscat_listing = $this->get_items(null,$params));
	 }
	}



		if(wt_is_valid($item_data, 'array') ) {
			wt_update_item_hits(TABLE_MOD_STRUCTURE_ITEMS_DESC, 'it_id', $iID);
			global $wt_plugins;
			if($wt_plugins->is_started('system_stats')) {
				global $wt_system_stats;
				$wt_system_stats->add_hit(NULL, 'iIP', $iID);
			}

		}
  //


  	if( wt_set_task($_GET, '__show_data') == '1' ) {
		echo '<b>{$item.</b>';
		wt_print_array( $item_data );
		echo '<b>{$items_listing.</b>';
		wt_print_array( $items_listing );
		echo '<b>{$parent_item.</b>';
		wt_print_array( $parent_item );
		echo '<b>{$itemscat_listing.</b>';
		wt_print_array( $itemscat_listing );
	}
	$this->build_item_meta_tags($item_data,$items_listing,$parent_item);
  	$wt_template->load_file($item_data['page_theme']);
	unset($item_data,$items_listing,$parent_item,$itemscat_listing);
  }
 }
	}



	function mainPage() {
		global $wt_template, $wt_sql;

	 $iP = array();
	 $iP['group_fields'] = true;
	 $iP['ndel_fields'] = true;
	 $iP['where'] = " sit.itt_key = 'mainpage' AND ";
	 $iP['limit'] = 1;
	 $iP['get_array'] = true;
	 $_it = $this->get_items(null, $iP);
	 if( wt_is_valid($_it['it_id'], 'int', '0') ) {
	 $iP = array();
	 $iP['group_fields'] = true;
	 $iP['ndel_fields'] = true;
	 $wt_template->assign('item', $item_data = $this->get_items($_it['it_id'], $iP));
	 }
	 unset($_it);

  	if( wt_set_task($_GET, '__show_data') == '1' ) {
		echo '<b>{$item.</b>';
		wt_print_array( $item_data );
	}

	if( wt_is_valid($item_data, 'array') ) {
  		$wt_template->load_file($item_data['page_theme']);
	} else {
		$wt_template->load_file('mainPage');
	}
}


	function get_fields_to_item($it_id, $params = array()) {
		global $wt_session,$wt_sql;

		$fields_data = array();
		if(wt_is_valid($it_id,'int',0)) {
 	  		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

			$fParams = array();
			$fParams['where'] = " sf2i.it_id = '" . (int)$wt_sql->db_input($it_id) . "' AND sfc.parent_id = '0' ";
			if( isset($params['show_on_short']) ) {
				$fParams['where'] .= " AND sfc.fi_show_on_short = '1' ";
			}
			$fParams['get_children'] = true;
			$fParams['it_id'] = $it_id;
			$fParams['group'] = true;
			$fParams['language_id'] = $language_id;

			$fields_data = $this->get_fields(null, $fParams);
		}
		return $fields_data;
	}

	function get_config_fields($fi_id = null, $params = array() ) {
		global $wt_sql,$wt_session;
		$data_array = array();
		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		if( wt_is_valid($fi_id, 'int', '0') ) {
			$db_data_query_raw = "SELECT fc.fi_id, fc.fi_gr, fc.fi_type, fcd.fi_name, fcd.fi_desc FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " fc, " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " fcd WHERE " . ( isset($params['where']) ? '  ' . $params['where'].' AND ' : '') . " fc.fi_id = '" . (int)$wt_sql->db_input($fi_id) . "' AND fc.fi_id = fcd.fi_id AND fcd.language_id = '".$language_id."' AND fcd.language_status = '1' LIMIT 1 ";
		} else {
			$db_data_query_raw = "SELECT fc.fi_id, fc.fi_gr, fc.fi_type, fcd.fi_name, fc.fi_depends_on, fc.fi_related_to FROM " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " fc, " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " fcd WHERE " . ( isset($params['where']) ? '  ' . $params['where'].' AND ' : '') . " fc.fi_id = fcd.fi_id AND fcd.language_id = '".$language_id."' AND fcd.language_status = '1' ";
			if(wt_not_null($params['order'])) {
				$db_data_query_raw .= " ORDER BY ".$params['order'];
			} elseif(!isset($params['order']) ) {
				$db_data_query_raw .= " ORDER BY sort_order, fi_name";
			}
			if(wt_not_null($params['limit'])) {
				$db_data_query_raw .= " LIMIT ".$params['limit'];
			}
		}

		$cache = new wt_cache();
		$cache_key = array();
		$cache_key['groups'] = array('mod_structure','fields_config');
		$cache_key['name'] = 'fi'.md5(serialize($db_data_query_raw).serialize($params));


if(!$cache->read($cache_key, $params['cache_lifetime']) || isset($params['no_cache'])) {

		$db_data_query = $wt_sql->db_query($db_data_query_raw);
		while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
			if( $params['get_children'] === true ) {
				$fParams = array();
				$fParams['where'] = " parent_id = '" . (int)$db_data['fi_id'] . "' ";
				$fParams['get_children'] = true;
				$fParams['no_cache'] = true;
				$fParams['language_id'] = $language_id;
				$db_data['children'] = $this->get_config_fields(null, $fParams);
			}
			if( wt_is_valid($db_data['copy_of'], 'int', '0') ) {
				$cParams = $params;
				unset( $cParams['where'] );
				$db_data = $this->get_config_fields($db_data['copy_of'], $cParams);
			}
			if(!wt_is_valid($db_data['fi_depends_on'],'int','0')) {
				unset($db_data['fi_depends_on']);
			}
			if(!wt_is_valid($db_data['fi_related_to'],'int','0')) {
				unset($db_data['fi_related_to']);
			}

			if( wt_is_valid($fi_id, 'int', '0') ) {
				$data_array = $wt_sql->db_output_data($db_data);
			} elseif(wt_not_null($db_data['fi_gr'])) {
				$data_array[$db_data['fi_gr']] = $wt_sql->db_output_data($db_data);
			} else {
				$data_array[$db_data['fi_id']] = $wt_sql->db_output_data($db_data);
			}
			unset($db_data);
		}
			if( !isset($params['no_cache']) ) {
				$cache->writeBuffer($data_array);
			}
		} else {
			$data_array = $cache->getCache();
		}

		return $data_array;
	}

	function get_fields($fi_id = null, $params = array() ) {
		global $wt_sql, $wt_session;

		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		$db_data_query_raw = "SELECT sfc.fi_id, sfc.copy_of, sfc.fi_gr, sfc.fi_type, sfcd.fi_name, sfc.has_children, sf2i.fi_value, sf2i.it_id FROM (" . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " sf2i) LEFT JOIN " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG . " sfc ON sf2i.fi_id = sfc.fi_id OR sf2i.fi_id = sfc.copy_of LEFT JOIN " . TABLE_MOD_STRUCTURE_FIELDS_CONFIG_DESC . " sfcd ON sf2i.fi_id = sfcd.fi_id AND sfcd.language_id = '".$wt_session->value('languages_id')."' AND sfcd.language_status = '1' WHERE " . ( isset($params['where']) ? $params['where'].' AND ' : '') . " sf2i.language_id = '".$language_id."' ORDER BY sfc.sort_order, sfcd.fi_name, sf2i.fi_value ";

			$db_data_query = $wt_sql->db_query($db_data_query_raw);
			while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
				if( isset($db_data['copy_of']) && wt_is_valid($db_data['copy_of'], 'int', '0') ) {
					$db_data = array_merge($db_data, $this->get_config_fields($db_data['copy_of']));
				}
				if($db_data['fi_type'] == 'multi_select' && wt_not_null($db_data['fi_value']) )  {
					$_v = wt_unserialize($db_data['fi_value']);
					if( wt_is_valid($_v, 'array') ) {
						$vParams = array();
						$vParams['where'] = " fc.fi_id IN (" . implode(',', $_v) . ") ";
						$vParams['language_id'] = $language_id;
						$db_data['children'] = $this->get_config_fields(null, $vParams);
						unset($db_data['fi_value']);
					}
				} elseif($db_data['fi_type'] == 'select' && wt_is_valid($db_data['fi_value'], 'int', 0)) {
					$db_data['fi_value'] = $this->get_config_fields($db_data['fi_value'], array('language_id' => $language_id));
				} elseif($db_data['fi_type'] == 'data_table' && wt_not_null($db_data['fi_value'])) {
					$db_data['fi_value'] = wt_unserialize($db_data['fi_value']);
				} elseif($db_data['fi_type'] == 'user_defined' && wt_not_null($db_data['fi_value'])) {
					$db_data['fi_value'] = wt_unserialize($db_data['fi_value']);
				} elseif($db_data['fi_type'] == 'form') {
					$db_data['fi_value'] = wt_unserialize($db_data['fi_value']);
					if (wt_is_valid($db_data['fi_value']['form'],'array')) {
						$tmp_fields = $db_data['fi_value']['form'];
						foreach ($tmp_fields as $k => $field) {
							$db_data['fi_value']['form'][$k]['field_form_name'] = wt_pl_to_iso(eregi_replace('[^a-zA-Z0-9_ęóąśłżźćń]','',strtolower($field['name'])));
						}
					}
				} elseif($db_data['fi_type'] == 'multi_select_item') {
					$val = wt_unserialize($db_data['fi_value']);
					if(wt_is_valid($val,'array')) {
						$iP = array();
						$iP['get_fields'] = true;
						$iP['group_fields'] = true;
						$iP['del_fields'] = true;
						$iP['where'] = " si.it_id IN(".implode(',',$val).") AND ";
						$db_data['fi_value'] = $this->get_items(null,$iP);
					}
				} elseif($db_data['fi_type'] == 'select_item') {
					if(wt_is_valid($db_data['fi_value'],'int','0')) {
						$iP = array();
						$iP['get_fields'] = true;
						$iP['group_fields'] = true;
						$iP['del_fields'] = true;
						$db_data['fi_value'] = $this->get_items($db_data['fi_value'],$iP);
					}
				} elseif(($db_data['fi_type'] == 'files' || $db_data['fi_type'] == 'gallery') && wt_not_null($db_data['fi_value'])) {
				  //	$fi_value = wt_unserialize($db_data['fi_value']);
					$tmp_array = wt_unserialize($db_data['fi_value']);
					unset($db_data['fi_value']);
					if (wt_is_valid($tmp_array,'array')) {

						foreach($tmp_array as $k => $file_data) {
							$src = CFGF_DIR_FS_MEDIA . 'mod_structure' . DIRECTORY_SEPARATOR . $this->generate_media_path($db_data['it_id']) . DIRECTORY_SEPARATOR . 'fi_'. $db_data['fi_id'] . DIRECTORY_SEPARATOR . $file_data['file'];
							$db_data['fi_value'][$k] = $file_data;
							$db_data['fi_value'][$k]['src'] = $src;
							$db_data['fi_value'][$k]['size'] = @filesize($src)/(1024*1024);
							$db_data['fi_value'][$k]['ext'] = wt_get_file_extension($src);
						}
					}
				} elseif($db_data['fi_type'] == 'file') {
					$file = 	$db_data['fi_value'];
					$db_data['fi_value'] = array();
					$db_data['fi_value']['file'] = $file;
					$db_data['fi_value']['src'] = CFGF_DIR_FS_MEDIA. $db_data['fi_value']['file'];
					$db_data['fi_value']['size'] = @filesize($db_data['fi_value']['src'])/(1024*1024);
					$db_data['fi_value']['ext'] = wt_get_file_extension($db_data['fi_value']['src']);
				} elseif($db_data['fi_type'] == 'video') {
					$db_data['fi_value'] = $this->parse_video_link($db_data['fi_value']);
				}
				if( isset($params['get_children']) && $db_data['has_children'] == '1' ) {
					$fParams = array();
					$fParams['where'] = " sfc.parent_id = '" . (int)$db_data['fi_id'] . "' ";
					if( isset($params['it_id']) ) {
						$fParams['where'] .= " AND  sf2i.it_id = '" . (int)$params['it_id'] . "' ";
						$fParams['it_id'] = $params['it_id'];
					}
					$fParams['get_children'] = true;
					$fParams['group'] = true;
					$fParams['language_id'] = $language_id;
					$db_data['children'] = $this->get_fields(null, $fParams);
				}
				if( isset($params['group']) && wt_not_null($db_data['fi_gr'] )  ) {
					$data_array[$db_data['fi_gr']] = $wt_sql->db_output_data($db_data);
				} else {
					$data_array[] = $wt_sql->db_output_data($db_data);
				}
				if($params['get_array'] === true) {
					$data_array = $wt_sql->db_output_data($db_data);
				}
			}

		return $data_array;
	}

	function get_items($it_id = null, $params = array()) {
		global $wt_sql, $wt_session;

		$data_array = array();
		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));


		if(wt_is_valid($it_id, 'int', '0')) {
			$db_data_query_raw = "SELECT si.*, sid.*, sit.itt_name, sit.itt_key, sit.itt_nochildren, sit.itt_sefu_id, sit.params as itt_params, u.usr_id, u.usr_login, ui.usr_first_name, ui.usr_last_name,  ui.usr_email, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM (" . TABLE_MOD_STRUCTURE_ITEMS . " si, " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " sid, ". TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit) LEFT JOIN " . TABLE_USERS . " u ON si.added_by = u.usr_id LEFT JOIN " . TABLE_USERS_INFO . " ui ON u.usr_id = ui.usr_id WHERE " . ( isset($params['where']) ? $params['where'] : '') . " si.it_id = '" . (int)$wt_sql->db_input($it_id) . "' AND si.it_id = sid.it_id AND " . ( ($params['admin_call'] === true) ? '' : " si.status = '1' AND ") . " si.it_type=sit.itt_id AND sid.language_id = '".$language_id."' AND sid.language_status = '1' LIMIT 1";
		} else {
				if(wt_is_valid($params['order_fi_id'],'int','0')) {
				$db_data_query_raw = "SELECT DISTINCT(si.it_id), si.it_id2, si.parent_id, si.cPath, si.has_children, sid.it_logo, si.date_added, si.date_up, si.added_by, sid.it_name, sid.it_name_short, sid.it_desc_short, sid.it_desc, sid.hits, sid.tags, sid.params, sit.itt_name, sit.itt_key, sit.itt_nochildren, sit.itt_sefu_id, sit.itt_sefu_treat_as_file, sit.params as itt_params, u.usr_id, u.usr_login, ui.usr_first_name, ui.usr_last_name, ui.usr_email, IF(sf2i.fi_id IS NULL OR sf2i.fi_value='',1,0) AS isnull, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM (".TABLE_MOD_STRUCTURE_ITEMS." si, ".TABLE_MOD_STRUCTURE_ITEMS_DESC." sid, ". TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit) LEFT JOIN ".TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS." sf2i ON si.it_id=sf2i.it_id AND sf2i.fi_id='".$params['order_fi_id']."'  LEFT JOIN " . TABLE_USERS . " u ON si.added_by = u.usr_id LEFT JOIN " . TABLE_USERS_INFO . " ui ON u.usr_id = ui.usr_id WHERE " . (isset($params['where']) ? $params['where'] : '') . " si.it_id=sid.it_id AND " . ( ($params['admin_call'] === true) ? '' : " si.status = '1' AND ") . " si.it_type=sit.itt_id AND sid.language_id = '".$language_id."' AND sid.language_status = '1' ORDER BY isnull ASC, ";
				if(wt_not_null($params['sort_order_fi_id_type'])) {
					$db_data_query_raw .= "CONVERT(sf2i.fi_value,".$params['sort_order_fi_id_type'].") ";
				} else {
					$db_data_query_raw .= "sf2i.fi_value";
				}
				$db_data_query_raw .= " ".$params['order_fi_id_desc'];

				if(isset($params['order']) && wt_not_null($params['order'])) {
					$db_data_query_raw .= ", ".$params['order'];
				}
			}
			if (!wt_is_valid($params['order_fi_id'],'int','0')) {
				$db_data_query_raw = "SELECT DISTINCT(si.it_id), si.it_id2, si.parent_id, si.cPath, si.has_children, sid.it_logo, si.date_added, si.date_up, si.added_by, sid.it_name, sid.it_name_short, sid.it_desc_short, sid.it_desc, sid.hits, sid.tags, sid.params, sit.itt_name, sit.itt_key, sit.itt_nochildren, sit.itt_sefu_id, sit.itt_sefu_treat_as_file, sit.params as itt_params, u.usr_id, u.usr_login, ui.usr_first_name, ui.usr_last_name, ui.usr_email, IF(si.date_up IS NOT NULL AND si.date_up != '0000-00-00 00:00:00',si.date_up,si.date_added) AS publish_date FROM (" . TABLE_MOD_STRUCTURE_ITEMS . " si, " . TABLE_MOD_STRUCTURE_ITEMS_DESC . " sid, ". TABLE_MOD_STRUCTURE_ITEMS_TYPE." sit) LEFT JOIN " . TABLE_USERS . " u ON si.added_by = u.usr_id LEFT JOIN " . TABLE_USERS_INFO . " ui ON u.usr_id = ui.usr_id WHERE " . ( isset($params['where']) ? $params['where'] : '') . " si.it_id = sid.it_id AND " . ( ($params['admin_call'] === true) ? '' : " si.status = '1' AND ") . " si.it_type=sit.itt_id AND sid.language_id = '".$language_id."' AND sid.language_status = '1' ";
				if(!isset($params['order'])) {
					$db_data_query_raw .= " ORDER BY si.sort_order, sid.it_name";
				}
				if(isset($params['order']) && wt_not_null($params['order'])) {
					$db_data_query_raw .= " ORDER BY " . $params['order'];
				}
			}
			if(isset($params['limit']) && wt_is_valid($params['limit'],'int','0') && !isset($params['split'])) {
				$db_data_query_raw .= " LIMIT 0, " . $params['limit'];
			}
			if(isset($params['split'])) {
				$this->split_listing =  new splitPageResults($_GET['page'], isset($params['limit']) ? $params['limit'] : MAX_DISPLAY_SEARCH_RESULTS, $db_data_query_raw, $this->db_query_numrows,'si.it_id', $wt_sql, array('cache_groups' => array('mod_structure','items')));
			}
		}
		$cache = new wt_cache();
		$cache_key = array();
		if(wt_is_valid($it_id, 'int', '0')) {
			$cache_key['groups'] = array('mod_structure','item',$it_id);
			$cache_key['name'] = 'it'.md5(serialize($db_data_query_raw) . serialize($params));
		} else {
			$cache_key['groups'] = array('mod_structure','items');
			$cache_key['name'] = md5(serialize($db_data_query_raw) . serialize($params));
		}

		if(strpos(strtoupper(trim($params['order'])),'RAND()') !== false) {
			$params['no_cache'] = true;
		}

		if(!$cache->read($cache_key, $params['cache_lifetime']) || isset($params['no_cache'])) {
			$db_data_query = $wt_sql->db_query($db_data_query_raw);
			while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
				if( wt_is_valid($db_data['it_id2'], 'int', '0') ) {
						$db_data['source_id'] = $db_data['it_id2'];
						$source_data = $this->get_items($db_data['it_id2']);
						if( !wt_is_valid($source_data, 'array') )	{
							continue;
						}
						if( $db_data['itt_key'] == 'shortcut' ) {
							 	 $db_data['source_parent_id'] = $source_data['parent_id'];
								 if( !wt_not_null($db_data['it_name']) ) {
								 	$db_data['it_name'] = $source_data['it_name'];
								 }

								 $db_data['it_desc'] = $source_data['it_desc'];
								 $db_data['it_desc_short'] = $source_data['it_desc_short'];
								 $db_data['it_logo'] = $source_data['it_logo'];
								 $db_data['cPath'] = $source_data['cPath'];
								 $db_data['itt_key'] = $source_data['itt_key'];
								 $db_data['tags'] = $source_data['tags'];
								 $db_data['params'] = $source_data['params'];
								 $db_data['has_children'] = $source_data['has_children'];
								 $db_data['itt_nochildren'] = $source_data['itt_nochildren'];
						}

						if( $db_data['itt_key'] == 'copy' ) {
								$_db_data = $db_data;
								$db_data = $source_data;
								$db_data['it_id2']	= $_db_data['it_id'];
								$db_data['it_id']	= $_db_data['it_id'];
								$db_data['cPath']	= $_db_data['cPath'];
						}

				} else {
					$db_data['source_id'] = $db_data['it_id'];
				}
					$db_data['media_path'] = $this->generate_media_path($db_data['source_id']);

				$db_data['level'] = count(explode('_', $db_data['cPath']));
				$db_data['cPath_array'] = explode('_', $db_data['cPath']);
				$db_data['tags_array'] = explode(' ', $db_data['tags']);
				$db_data['params_array'] = wt_unserialize($db_data['params']);
				if (wt_not_null($db_data['params_array']['itemPage_theme'])) {
					$asdasd = $db_data['params_array']['itemPage_theme'];
					$file_name = substr($asdasd,strpos($asdasd,'---')+3);
					$db_data['page_theme'] = 'itemPage_'.$db_data['itt_key']."/".$file_name.".tpl";
				} else {
					$db_data['page_theme'] = 'itemPage_'.$db_data['itt_key'].".tpl";
				}
				if (wt_not_null($db_data['params_array']['itemList_theme'])) {
					$asdasd = $db_data['params_array']['itemList_theme'];
					$file_name = substr($asdasd,strpos($asdasd,'---')+3);
					$db_data['list_theme'] = 'itemList_'.$db_data['itt_key']."/".$file_name.".tpl";
				} else {
					$db_data['list_theme'] = 'itemList_'.$db_data['itt_key'].".tpl";
				}
				if( isset($params['get_fields']) || wt_is_valid($it_id, 'int', '0') ) {
					$fParams = array();

					if(!wt_is_valid($it_id, 'int', '0') && !isset($params['show_all_fields']) ) {
						$fParams['show_on_short'] = true;
					}
					$fParams['group'] = true;
					$fParams['language_id'] = $language_id;

					$db_data['fields'] = $this->get_fields_to_item($db_data['source_id'], $fParams);

					if( isset($params['group_fields']) && $params['group_fields'] === true && wt_is_valid($db_data['fields'], 'array') ) {
						$db_data['fields_group'] =	$this->set_group_fields($db_data['fields']);
						if( !isset($params['ndel_fields']) ) {
							unset( $db_data['fields'] );
						}
					}
				}

				wt_prepare_item_desc($db_data['it_desc_short'],$db_data['it_desc'],$db_data);

				if( $params['get_path'] === true ) {
					$sp = array();
					$sp['return'] = 'array';
					$sp['sefu_path'] = $params['sefu_path'];
					$sp['path_all'] = $params['path_all'];
					$sp['language_id'] = $language_id;
					$db_data['path'] = $this->get_item_path($db_data['cPath'],$sp);
				}

				if( wt_is_valid($it_id, 'int', '0') ) {
					if(!isset($params['get_desc_short'])) {
						unset($db_data['it_desc_short']);
					}
					$data_array = $wt_sql->db_output_data($db_data);
				} else {
					if(!isset($params['get_desc'])) {
						unset($db_data['it_desc']);
					}
					if(  wt_not_null($params['group_array_by']) ) {
						$data_array[$db_data[$params['group_array_by']]] = $wt_sql->db_output_data($db_data);
					} else {
						if( $params['get_array'] === true ) {
							$data_array = $wt_sql->db_output_data($db_data);
						} else {
							$data_array[$db_data['it_id']] = $wt_sql->db_output_data($db_data);
						}
					}
				}

				unset($db_data);
			}
			if( !isset($params['no_cache']) ) {
				$cache->writeBuffer($data_array);
			}
		} else {
			$data_array = $cache->getCache();
		}

		return $data_array;
	}

	function generate_media_path($data) {
		return implode(DIRECTORY_SEPARATOR,str_split($data));
	}

	function get_item_path($cPath_array = array(), $params = array()) {
		global $wt_sql, $wt_session, $wt_plugins;
		$key_words = array();
		$language_id = ((isset($params['language_id']) && wt_is_valid($params['language_id'],'int','0')) ? $params['language_id'] : $wt_session->value('languages_id'));

		$params['return'] = 'array';
		$sp['sefu_path'] = $params['sefu_path'];
		$sp['path_all'] = $params['path_all'];

		if( !wt_is_valid($cPath_array, 'array') && wt_not_null($cPath_array) ) {
			$cPath_array = explode('_', $cPath_array);
		}
		if( !wt_is_valid($cPath_array, 'array') ) {
			return false;
		}

		$iP = array();
		$iP['where'] = " si.it_id IN (".implode(',',$cPath_array).") AND ";
		$iP['order'] = " FIELD(si.it_id, ".implode(',',$cPath_array).") ";
		$iP['language_id'] = $language_id;

		$items = $this->get_items(null,$iP);

			foreach($items as $it_name) {

			if($params['path_all'] === true) {
				$key_words[] = $it_name['it_name'];
				continue;
			}

			if($it_name['itt_sefu_id'] == 'none') {
			} elseif(wt_not_null($it_name['itt_sefu_id'])) {
				$key_words[] = $wt_sql->db_output_data($it_name['itt_sefu_id']);
			} else {
				if($params['sefu_path'] == true && wt_not_null($it_name['sefu_link'])) {
					$key_words[] = $wt_sql->db_output_data($it_name['sefu_link']);
				} else {
					$key_words[] = $wt_sql->db_output_data($it_name['it_name']);
				}
			}
		}
		switch($params['return']) {
			case 'string':
				return implode(',', $key_words);
				break;
			default:
			case 'array':
				return $key_words;
				break;
			case 'separator':
				return implode('/', $key_words);
				break;
		}
	}

	function get_items_tree($parent_id = 0, $params = array(), $items_tree = array()) {
		global $wt_sql;

			$iP = array();
			$iP['where'] = " si.parent_id = '" . $parent_id . "' AND ";
			if(isset($params) && wt_not_null($params['where'])) {
			$iP['where'] .= $params['where'];
			}
			$iP['dsplit'] = true;
			$iP['order'] = 'si.sort_order';
			$iP['get_path'] = $params['get_path'];
			$iP['path_all'] = $params['path_all'];
			$iP['sefu_path'] = $params['sefu_path'];
			$iP['admin_call'] = $params['admin_call'];
			$iP['no_cache'] = $params['no_cache'];

			$db_items = $this->get_items(null, $iP);
		if (wt_is_valid($db_items,'array')) {
			foreach ($db_items as $it) {
					$it['level'] = count(explode('_', $it['cPath']));
					$it['name_formated'] = str_repeat('&nbsp;&nbsp;&nbsp;', $it['level']-1) . $it['it_name'];
					$items_tree[] = $it;
					if($it['has_children'] == '1') {
						$items_tree = $this->get_items_tree($it['it_id'], $params, $items_tree);
					}
			}
		}
		return $items_tree;
	}

	function set_group_fields($fields = array()) {
		$fields_group = array();
		if( wt_is_valid($fields, 'array') ) {
			foreach( $fields as $f1 ) {
				if($f1['fi_type'] == 'multi_select_group') {
				 	 	$fields_group[$f1['fi_gr']] = $this->set_group_fields(array(array('children' => $f1['children'])));
						continue;
				}

				if( wt_is_valid($f1['children'], 'array') ) {

					foreach( $f1['children'] as $_key => $f2 ) {
						$key = $f2['fi_id'];
						if(wt_not_null($f2['fi_gr'])) {
						   $key = $f2['fi_gr'];
						}

						if($key === null) { continue; }
							if( isset($f2['children']) ) {
								$fields_group[$key]['n'] = $this->minimize_field($f2['children']);
								$fields_group[$key]['i'] = $f2['fi_id'];
								$fields_group[$key]['fn'] = $f2['fi_name'];
								$fields_group[$key]['t'] = $f2['fi_type'];
							} else {
								if(wt_is_valid($f2['fi_value'], 'array') && wt_is_valid($f2['fi_value']['fi_id'], 'int', 0)) {
								 $fields_group[$key] = array('i' => $f2['fi_id'], 'n' => $this->minimize_field($f2['fi_value']), 't' => $f2['fi_type'], 'fn' => $f2['fi_name']);
								} elseif(wt_not_null($f2['fi_value'])) {
									$fields_group[$key] = array('i' => $f2['fi_id'], 'n' => $f2['fi_value'], 't' => $f2['fi_type'], 'fn' => $f2['fi_name']);
								}
							}
					}
				}
			}
		}
		return $fields_group;
	}

	function minimize_field($fields = array()) {
		if(wt_is_valid($fields['fi_id'], 'int', 0)) {
			return array('i' => $fields['fi_id'], 'fn' => $fields['fi_name']);
		} else {
			$_fields = array();
			foreach($fields as $f) {
				$_fields[$f['fi_id']] = array('i' => $f['fi_id'], 'fn' => $f['fi_name']);
			}
			return $_fields;
		}
	}

	function wt_navigationbar() {
		global $wt_template, $wt_navigationbar;

			$cPath_array = explode('_', wt_set_task($_REQUEST, 'cPath'));

			if(wt_is_valid($cPath_array, 'array')) {
				foreach($cPath_array as $it_id) {
					if( wt_is_valid($it_id, 'int', '0') ) {
						$it = $this->get_items($it_id);
						if( wt_is_valid($it, 'array') ) {//add_to_breadcrumb
							$itt_params = new wt_params($it['itt_params']);
								if( $itt_params->get('add_to_breadcrumb', '1') == '1' && $it['itt_nochildren'] == 0) {
								$wt_navigationbar->add($it['it_name'], wt_href_link('mod_structure', '', 't=iP&cPath=' . $it['cPath']));
							}
							unset($itt_params, $it);
						}
					}
				}
			}
	  //	}
	} // function


	function BCMS_get_categories_tree($parent_id = 0, $max_level = 0, $params = array(), $level = 0 ) {
   global $wt_sql, $wt_session;

 $current = explode('_', $_REQUEST['cPath']);

 if( !wt_is_valid( $current, 'array' ) ) {
 	$current = array();
 }
 if( !wt_is_valid( $params['not_include'], 'array' ) ) {
 	$params['not_include'] = array();
 }
 if( !wt_is_valid( $params['not_list'], 'array' ) ) {
 	$params['not_list'] = array();
 }


 $Cparams = array();
 if(wt_is_valid($parent_id, 'array') && $params['include_parent'] == false) {
 $parent_id = $parent_id[0];
 $Cparams['where'] = " si.parent_id = '" . $parent_id . "' AND ";
 } else {
 $Cparams['where'] = " si.parent_id = '" . $parent_id . "' AND ";
 }

 $categories_data = array();

 if(wt_is_valid($params['types_only'], 'array') ) {
						wt_clear_empty_array($params['types_only']);
						if( wt_is_valid($params['types_only'], 'array') ) {
							$childres_query = ' (';
							foreach($params['types_only'] as $ct) {

								$childres_query .= " sit.itt_key = '" . $ct . "' OR ";
							}
							$childres_query = substr($childres_query, 0, -4);
							$childres_query .= ") AND ";
							$Cparams['where'] .= $childres_query;
						}
 }

 if(wt_is_valid($params['types_without'], 'array') ) {
						wt_clear_empty_array($params['types_without']);
						if( wt_is_valid($params['types_without'], 'array') ) {
							$childres_query = ' (';
							foreach($params['types_without'] as $ct) {
								$childres_query .= " sit.itt_key != '" . $ct . "' AND ";
							}
							$childres_query = substr($childres_query, 0, -4);
							$childres_query .= ") AND ";
							$Cparams['where'] .= $childres_query;
						}
 }

 if(wt_is_valid($params['limit'][$level], 'int', '0')) {
 	$Cparams['limit'] = $params['limit'][$level];
 }
 if(wt_not_null($params['order'])) {
 	$Cparams['order'] = $params['order'];
 }

 $categories_data = $this->get_items(null, $Cparams);

 if($params['include_parent'] == true && wt_is_valid($parent_id, 'array')) {

 $CUparams = array();
 $CUparams['where'] = " si.it_id IN(" . implode(',', $parent_id) . ") AND  ";
 $categories_data = $this->get_items(null, $CUparams);
 unset($params['include_parent']);
 } else if($params['include_parent'] == true && wt_is_valid($parent_id, 'int', '0')) {
 	$CUparams = array();
 	$CUparams['where'] = " si.it_id = '" . (int)$parent_id . "' AND  ";
 	$categories_data = $this->get_items(null, $CUparams);
	unset($params['include_parent']);
 }



 $current_category_id = $this->current_item_id();


 foreach($categories_data as $db_cat) {

 if( wt_is_valid($params['not_include'], 'array') && (in_array($db_cat['it_id'], $params['not_include']) || in_array($db_cat['it_id2'], $params['not_include']) )) {
 	continue;
 }

 if( wt_is_valid($db_cat['it_id2'], 'int', '0') ) {
 	$it_id = $db_cat['it_id2'];
	$parent_id = $db_cat['source_parent_id'];
 } else {
 	$it_id = $db_cat['it_id'];
	$parent_id = $db_cat['parent_id'];
 }


 if($level < $max_level && (!in_array($parent_id, $current) ) ) {
 //echo $it_id.' - '.$parent_id.' - '.$db_cat['has_children'].' <br />';
 //echo "$it_id, $max_level, $params, $level+1 <br />";
     $cat_tree_array[$db_cat['it_id']] = $db_cat;
	  if( $db_cat['has_children'] == '1' ) {
	  $cat_tree_array[$db_cat['it_id']]['children'] = $this->BCMS_get_categories_tree($it_id, $max_level, $params, $level+1);
	  }

    } else if(in_array($parent_id, $current) ) {

    $cat_tree_array[$db_cat['it_id']] = $db_cat;
	 	if( $db_cat['has_children'] == '1' ) {
		 $cat_tree_array[$db_cat['it_id']]['children'] = $this->BCMS_get_categories_tree($it_id, $max_level, $params, $level+1);
		 }
    }

  }

   return $cat_tree_array;
 }

 function prepare_search_array(&$a) {
 	if( wt_is_valid($a, 'array') ) {
		foreach( $a as $k => $_a ) {
			wt_clear_empty_array($a[$k]);
		}
		wt_clear_empty_array($a);
	}
 }

 function parse_search_params(&$params, $search = array() ) {
 	global $wt_sql;
		$it_ids = array();

		if( !wt_is_valid($search, 'array') ) {
			$search = wt_set_task($_REQUEST, 'iSearch');
		}
		$search = wt_string_user_safe_array($search);

 if( wt_is_valid($search, 'array') ) {

			$this->prepare_search_array($search['fID']);
		//wt_print_array($search);
		if( wt_is_valid($search['fID'], 'array') ) {

			foreach($search['fID'] as $fID => $search_data) {
				if(wt_is_valid($search_data, 'int', 0)) {
					$search_data = array($search_data);
				}
				//wt_print_array($search_data);
				if(wt_not_null($search_data['any_op'])) {
					if(wt_is_valid($search_data['any_op'], 'int', 0)) {
						$search_data['any_op'] = array($search_data['any_op']);
					}
					if(wt_is_valid($search_data['any_op'], 'array', 0)) {
						$params['where'] .= " ( ";
						foreach($search_data['any_op'] as $fi_value) {
							$fid_itids = $this->get_items_id_by_field_value($fi_value, $_is_ids, $fID);
							if(wt_is_valid($fid_itids, 'array', 0)) {
								$params['where'] .= " si.it_id IN (".implode(',', $fid_itids).") OR ";
							} else {
								$params['where'] .= " si.it_id IN (0) OR ";
							}
						}

						$params['where'] = substr($params['where'], 0, -3);
						$params['where'] .= "  ) AND ";
					}
				} else {
					// wszystkie warunki musza być spelnione
					if(wt_is_valid($search_data, 'array', 0)) {
						$params['where'] .= " ( ";
						foreach($search_data as $fi_value) {
							$fid_itids = $this->get_items_id_by_field_value($fi_value, $_is_ids, $fID);
							if(wt_is_valid($fid_itids, 'array', 0)) {
								$params['where'] .= " si.it_id IN (".implode(',', $fid_itids).") AND ";
							} else {
								$params['where'] .= " si.it_id IN (0) AND ";
								$params['not_finded'] = true;
								break;
							}
						}
						$params['where'] = substr($params['where'], 0, -4);
						$params['where'] .= "  ) AND ";
					}
				} //if(wt_not_null($search_data['any_op']))
				if($params['not_finded'] === true) {
					return;
				}
			} //foreach
		}

		//dorzucone, żeby na końcu nie uwzględniło pól znalezionych po fID bo wszystko jest już dorzucone w zapytaniu
		unset($fid_itids);

		$this->prepare_search_array($search['fText']);
		if( wt_is_valid($search['fText'], 'array') ) {
			$ftext_itids = $this->get_items_id_by_field_text($search['fText']);
			if( !wt_is_valid($ftext_itids, 'array') ) {
				$params['not_finded'] = true;
				return;
			}
		}

		$this->prepare_search_array($search['fFrom']);
		if(wt_is_valid($search['fFrom'], 'array')) {
			foreach($search['fFrom'] as $fi_id => $val) {
				$search['fFromTo'][$fi_id] = $val.'---';
				if(wt_is_valid($search['fTo'][$fi_id], 'int', 0)) {
					$search['fFromTo'][$fi_id] .= $search['fTo'][$fi_id];
				}
			}
		}

		$this->prepare_search_array($search['fTo']);
		if(wt_is_valid($search['fTo'], 'array')) {
			foreach($search['fTo'] as $fi_id => $val) {
				$search['fFromTo'][$fi_id] = '---'.$val;
				if(wt_is_valid($search['fFrom'][$fi_id], 'int', 0)) {
					$search['fFromTo'][$fi_id] = $search['fFrom'][$fi_id].$search['fFromTo'][$fi_id];
				}
			}
		}

		$this->prepare_search_array($search['fFromTo']);
if( wt_is_valid($search['fFromTo'], 'array') ) {
			$ffromto_itids = $this->get_items_id_by_from_to_value($search['fFromTo']);

			if( !wt_is_valid($ffromto_itids, 'array') ) {
				$params['not_finded'] = true;
				return;
			}
		}

		$this->prepare_search_array($search['fDateFrom']);
if( wt_is_valid($search['fDateFrom'], 'array') ) {
			$fdatefrom_itids = $this->get_items_id_by_from_date_value($search['fDateFrom']);

			if( !wt_is_valid($fdatefrom_itids, 'array') ) {
				$params['not_finded'] = true;
				return;
			}
		}

		$this->prepare_search_array($search['fDateTo']);
if( wt_is_valid($search['fDateTo'], 'array') ) {
			$fdateto_itids = $this->get_items_id_by_to_date_value($search['fDateTo']);

			if( !wt_is_valid($fdateto_itids, 'array') ) {
				$params['not_finded'] = true;
				return;
			}
		}


		$items_id = array();
		$search_count = 0;

		if( wt_is_valid($ftext_itids, 'array') ) {
				foreach( $ftext_itids as $i ) {
					$items_id[$i] += 1;
				}
				$search_count++;
		}

		if( wt_is_valid($fid_itids, 'array') ) {
				foreach( $fid_itids as $i ) {
					$items_id[$i] += 1;
				}
				$search_count++;
		}

		if( wt_is_valid($ffromto_itids, 'array') ) {
				foreach( $ffromto_itids as $i ) {
					$items_id[$i] += 1;
				}
				$search_count++;
		}
		if( wt_is_valid($fdatefrom_itids, 'array') ) {
				foreach( $fdatefrom_itids as $i ) {
					$items_id[$i] += 1;
				}
				$search_count++;
		}
		if( wt_is_valid($fdateto_itids, 'array') ) {
				foreach( $fdateto_itids as $i ) {
					$items_id[$i] += 1;
				}
				$search_count++;
		}


		if(wt_is_valid($items_id, 'array') ) {
			$items_id = array_keys($items_id, $search_count);
			if(!wt_is_valid($items_id, 'array') ) {
				$params['not_finded'] = true;
				return;
			}
		}

		if( wt_is_valid($items_id, 'array') ) {
			 $params['where'] .= " si.it_id IN (" . implode(',', $items_id) . ") AND ";
		}

		$this->prepare_search_array($search['cPath']);
		if( wt_is_valid($search['cPath'], 'array') ) {
				$params['where'] .= " ( ";
				$query_add = '';
			 foreach($search['cPath'] as $cPath) {
			 	$query_add .= " si.cPath LIKE '" . $wt_sql->db_input($cPath) . "\_%' OR ";
			 }
			 $query_add = substr($query_add, 0, -4);
			 $params['where'] .= $query_add;
			 $params['where'] .= " ) AND ";
		}

		$this->prepare_search_array($search['type']);
		if( wt_is_valid($search['type'], 'array') ) {
				$params['where'] .= " ( ";
				$query_add = '';
			 foreach($search['type'] as $t) {
			 	$query_add .= " sit.itt_key = '" . $wt_sql->db_input($t) . "' OR ";
			 }
			 $query_add = substr($query_add, 0, -4);
			 $params['where'] .= $query_add;
			 $params['where'] .= " ) AND ";
		}

		if( wt_not_null($search['it_name']) ) {
			 wt_parse_search_string($search['it_name'], $sq);
			 $params['where'] .= wt_parse_array_to_query($sq, array('sid.it_name') ) . ' AND ';
		}

		if( wt_not_null($search['tags']) ) {
			 wt_parse_search_string($search['tags'], $sq);
			 $params['where'] .= wt_parse_array_to_query($sq, array('sid.tags') ) . ' AND ';
		}

		if( wt_not_null($search['text']) ) {
				 wt_parse_search_string($search['text'], $sq);
				if( wt_is_valid($sq, 'array') ) {
				$params['where'] .= wt_parse_array_to_query($sq, array('sid.it_name', 'sid.tags', 'sid.it_desc', 'sid.it_desc_short') ) . ' AND ';
				}
		}


		if( wt_not_null($search['globaltext']) ) {
				 wt_parse_search_string($search['globaltext'], $sq);
				if( wt_is_valid($sq, 'array') ) {
				$params['where'] .= ' (('.wt_parse_array_to_query($sq, array('si.it_id', 'si.import_id', 'sid.it_name', 'sid.tags', 'sid.it_desc', 'sid.it_desc_short') ) . ') ';
				$this->prepare_search_array($search['globaltext']);
	  				if(wt_not_null($search['globaltext']) ) {
						$ftext_itids = $this->get_items_id_by_field_globaltext($search['globaltext']);
						if(wt_is_valid($ftext_itids, 'array')) {
						  $params['where'] .= " OR (si.it_id IN (".implode(',',$ftext_itids).")) ";
						}
					}
				$params['where'] .= ") AND ";
				}
		}

			$this->prepare_search_array($search['iID']);
		if( wt_is_valid($search['iID'], 'array') ) {
			  $params['where'] .= " si.it_id IN (" . implode(',', $search['iID']) . ") AND ";
		}

			$this->prepare_search_array($search['usr_id']);
		if( wt_is_valid($search['usr_id'], 'array') ) {
				 $params['where'] .= " si.added_by IN (" . implode(',', $search['usr_id']).") AND ";
		}

		$this->prepare_search_array($search['user']);
		if(wt_is_valid($search['user'], 'array')) {
			if(wt_parse_search_string($search['user'], $parsed_string)) {
				$params['where'] .= '('.wt_parse_array_to_query($parsed_string, array('ui.usr_first_name', 'ui.usr_last_name', 'ui.usr_company', 'ui.usr_company_vat_id', 'ui.usr_email')).") AND ";
			}
		}

}

	}

	function get_items_id_by_field_text($search) {
		global $wt_sql;
		$ids = array();
		wt_clear_empty_array($search);
		foreach($search as $i => $t) {
			if( wt_is_valid($i, 'int', '0') && wt_not_null($t) ) {
			wt_parse_search_string($t, $sq);
			$_id_query = $wt_sql->db_query("SELECT DISTINCT it_id FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE fi_id = '" . $wt_sql->db_input($i) . "' AND " . wt_parse_array_to_query($sq, array('fi_value') ) );
			while($_id = $wt_sql->db_fetch_array($_id_query)) {
				$ids[$_id['it_id']] += 1;
	  		}
			}
		}

	return array_keys($ids, count($search));
	}

	function get_items_id_by_field_globaltext($search) {
		global $wt_sql;
		$ids = array();

			if(wt_not_null($search)) {
			wt_parse_search_string($search, $sq);
			$_id_query = $wt_sql->db_query("SELECT DISTINCT it_id FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE " . wt_parse_array_to_query($sq, array('fi_value')));

				while($_id = $wt_sql->db_fetch_array($_id_query)) {
					$ids[$_id['it_id']] += 1;
		  		}
			}

	return array_keys($ids);
	}





	function get_items_id_by_from_to_value($search) {
		global $wt_sql;
		$ids = array();
		wt_clear_empty_array($search);
		foreach($search as $i => $t) {
			if( wt_is_valid($i, 'int', '0') && wt_not_null($t) ) {
			$_arr = explode('---', $t);
			$from = (int)$_arr[0];
			$to = (int)$_arr[1];

			$query = "SELECT DISTINCT it_id, fi_value FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE fi_id = '" . $wt_sql->db_input($i) . "'  ";
			if( wt_not_null($from) ) {
				$query .= " AND CONVERT(fi_value, UNSIGNED) >= " . $wt_sql->db_input($from) . "  ";
			}
			if( wt_not_null($to) ) {
				$query .= " AND CONVERT(fi_value, UNSIGNED) <= " . $wt_sql->db_input($to) . "  ";
			}

		 //	wt_print_array($query);
			$_id_query = $wt_sql->db_query($query);
			while($_id = $wt_sql->db_fetch_array($_id_query)) {
				$ids[$_id['it_id']] += 1;
	  		}
			}
		}

	return array_keys($ids, count($search));
	}

	function get_items_id_by_from_date_value($search) {
		global $wt_sql;
		$ids = array();
		wt_clear_empty_array($search);
		foreach($search as $i => $t) {
			if( wt_is_valid($i, 'int', '0') && wt_not_null($t) ) {
			$_id_query = $wt_sql->db_query("SELECT DISTINCT it_id, fi_value FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE fi_id = '".$wt_sql->db_input($i)."' AND CONVERT(fi_value, DATE) >= '".$wt_sql->db_input($t)."' ");

				while($_id = $wt_sql->db_fetch_array($_id_query)) {
					$ids[$_id['it_id']] += 1;
		  		}
			}
		}

	return array_keys($ids, count($search));
	}

	function get_items_id_by_to_date_value($search) {
		global $wt_sql;
		$ids = array();
		wt_clear_empty_array($search);
		foreach($search as $i => $t) {
			if( wt_is_valid($i, 'int', '0') && wt_not_null($t) ) {
			$_id_query = $wt_sql->db_query("SELECT DISTINCT it_id, fi_value FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE fi_id = '".$wt_sql->db_input($i)."' AND CONVERT(fi_value, DATE) <= '".$wt_sql->db_input($t)."' ");
				while($_id = $wt_sql->db_fetch_array($_id_query)) {
					$ids[$_id['it_id']] += 1;
		  		}
			}
		}

	return array_keys($ids, count($search));
	}

	function get_items_id_by_field_value($fID, &$_is_ids, $key = null) {
		global $wt_sql, $wt_session;

		$data_array = array();
		$add_query = '';
		if( wt_is_valid($fID, 'array') ) {
			$ids = array();
			foreach($fID as $k => $id) {

					if( wt_is_valid($id, 'int', '0') ) {
					$_id = $this->get_items_id_by_field_value($id, $aaa, $k);
					$_is_ids = true;

					if( wt_is_valid($_id, 'array') ) {
						foreach($_id as $_i) {
						$ids[$_i] += 1;
						}
					}

					} elseif(wt_is_valid($id, 'array')) {
						$_idms = array();
						foreach($id as $_idma) {
							$_idm = $this->get_items_id_by_field_value($_idma, $aaa, $k);
							if( wt_is_valid($_idm, 'array') ) {
								foreach($_idm as $_id) {
								$_idms[$_id] += 1;
								}
							}
						}

						$found_multiple = array_keys($_idms, count($id));
						if(wt_is_valid($found_multiple, 'array') ) {
							foreach($found_multiple as $_i) {
								$ids[$_i] += 1;
							}
						}
					} //elseif(wt_is_valid($id, 'array')) {

			}

		return array_keys($ids, count($fID));

		} elseif(wt_is_valid($key, 'int', '0')) {
				$add_query = " fi_id = '".(int)$wt_sql->db_input($key)."' AND fi_value != '' AND ( fi_value = '" . $wt_sql->db_input($fID) . "' OR fi_value LIKE '%\"".$wt_sql->db_input($fID)."\"%' OR fi_value LIKE '%i:".$wt_sql->db_input($fID).";%') ";
		} else {
				$add_query = " fi_id = '".(int)$wt_sql->db_input($fID)."' AND fi_value != '' ";
		}

		if( !wt_not_null($add_query) ) {
			return array();
		}

	 	$db_data_query_raw = "SELECT DISTINCT it_id FROM " . TABLE_MOD_STRUCTURE_FIELDS_TO_ITEMS . " WHERE " . $add_query . " AND  language_id = '".$wt_session->value('languages_id')."' ";

     $db_data_query = $wt_sql->db_query($db_data_query_raw);

     while($db_data = $wt_sql->db_fetch_array($db_data_query)) {
			$data_array[] = $wt_sql->db_output_data($db_data['it_id']);
	  }

		return $data_array;
	}

 function parse_video_link($link) {
	if( !wt_not_null($link) ) {
		return false;
	}
	if( strpos($link, 'http://') === false ) {
		return false;
	}


	$r = array();
	if( strpos($link, 'youtube.') !== false ) {
		$r['type'] = 'youtube';
		if( strpos($link, '&') !== false ) {
			preg_match('!youtube.com/watch.*v=(.*)&!', $link, $matches);
		} else {
			preg_match('!youtube.com/watch.*v=(.*)!', $link, $matches);
		}
		if( !wt_not_null($matches[1]) ) {
		return false;
		}
		$r['code'] = $matches[1];
	}

	if( wt_is_valid($r, 'array') ) {
		$r['link'] = $link;
		return $r;
	} else {
		return false;
	}


	}

		function build_item_meta_tags($it = array(),$itch = array(),$itpa = array()) {
	  global $wt_template;
			if( wt_is_valid($it, 'array') ) {
				if(wt_not_null($it['meta_title'])) {
					$wt_template->add_site_title($it['meta_title'].' :: ');
				} elseif(wt_is_valid($it['path'],'array')) {
					krsort($it['path']);
					$wt_template->add_site_title(implode(' / ',$it['path']).' :: ');
				}
			} else {
				$wt_template->add_site_title(TEXT_SITE_404_HEAD_TITLE.' :: ');
			}
			if(wt_not_null($it['meta_desc'])) {
				$wt_template->add_meta_desc($it['meta_desc']);
			} else {
				$meta_desc = $it['it_name'];
				if(wt_is_valid($itpa,'array')) {
					$meta_desc .= ' - '.$itpa['it_name'];
				}
				$meta_desc .= '. '.substr(strip_tags($it['it_desc']),0,150);
				if(wt_is_valid($itch,'array')) {
					foreach($itch as $i) {
						$meta_desc .= $i['it_name'];
							if($i == 8) {
								break;
							}
						$meta_desc .= ', ';
					}
				}
				$wt_template->add_meta_desc($meta_desc);
			}
			if(wt_not_null($it['meta_keys'])) {
				$wt_template->add_meta_keys($it['meta_keys']);
			} else {
			if(wt_is_valid($it['path'],'array')) {
			$meta_keys = implode(', ',$it['path']);
			} else {
			$meta_keys = $it['it_name'];
			}
			if(wt_is_valid($itch,'array')) {
			rsort($itch);
			$meta_keys .= ', ';
					foreach($itch as $it) {
						$meta_keys .= $it['it_name'];
							if($i == 10) {
								break;
							}
						$meta_keys .= ', ';
					}
				}
			$meta_keys .= ' '.META_KEYS;
			$wt_template->add_meta_keys($meta_keys);
			}

	  $wt_template->add_to_header('<link rel="canonical" href="'.wt_href_link('mod_structure', '', wt_get_all_get_params(array('t','cPath')).'t=iP&cPath='.$it['cPath'],'','NONSSL', false, false, array('full_url' => true)).'" />');

	  unset($it,$itch,$itpa);
	}

	function sendForm() {
		global $wt_template;


		$data = wt_string_user_safe_array($_REQUEST);
		$form_name = $data['form_name'];

		if (wt_is_valid($data[$form_name],'array') && wt_is_valid($this->current_item_id(), 'int', 0) && wt_is_valid($data[$form_name]['fi_id'], 'int', 0)) {
			$form = $data[$form_name];

			$fP = array();
			$fP['where'] = " sf2i.fi_id = '".$data[$form_name]['fi_id']."' AND sf2i.it_id = '".$this->current_item_id()."' ";
			$fP['get_array'] = true;
			$form_data = $this->get_fields(null, $fP);
			if(!wt_is_valid($form_data['fi_value'], 'array')) {
				die('ERROR');
			}

			if (wt_validate_email(trim($form_data['fi_value']['email_addresses']))) {
				$wt_template->assign('data',$form);
				$mail = array('subject' => $form_data['fi_value']['email_title'],
							  'template' => 'form_'.$form_name.'.tpl'
				);
				$email = new email();
				$result = $email->send_email('mod_structure', SITE_NAME, trim($form_data['fi_value']['email_addresses']), SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, $mail);
			}
		}
		wt_redirect(wt_href_link('', '', wt_get_all_get_params(array('t')).'t=iP&form_sended='.(int)$result));
	}

} //class

?>
