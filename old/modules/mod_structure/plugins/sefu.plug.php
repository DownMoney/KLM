<?php

class mod_structure_sefu_plug {
	var $sefu_output_urls = array();

	function check_to_run_sefu($last_sefu_date = '') {
		global $wt_sql;
		$db_check_data_query = $wt_sql->db_query("SELECT it_id FROM " . TABLE_MOD_STRUCTURE_ITEMS . " WHERE date_added > '" . date('Y-m-d H:i:s', $last_sefu_date) . "' OR last_modified > '" . date('Y-m-d H:i:s', $last_sefu_date) . "' LIMIT 1");
		$db_check_data = $wt_sql->db_fetch_array($db_check_data_query);

		if( wt_is_valid($db_check_data['it_id'], 'int', '0') ) {
			 return true;
		}
		return false;
	}

	function get_sefu_urls($language) {
		global $wt_sql,$wt_language;

			$mod_structure = wt_module::singleton('mod_structure');
			$iP = array();
			$iP['no_cache'] = true;
			$iP['clear_data'] = true;
			$iP['get_path'] = true;
			$iP['sefu_path'] = true;
			$iP['order'] = 'si.it_id ASC';
			$iP['language_id'] = $language['id'];
			$items_data = $mod_structure->get_items(null,$iP);

	  if( wt_is_valid($items_data, 'array') ) {
	  			$duplicate = array();
			foreach($items_data as $i) {
				$path = array_map('wt_safe_string',$i['path']);
				$url = 't=iP&cPath='.$i['cPath'];

				if( $i['itt_nochildren'] == '1' ) {

					if(count($path) == 1) {
						$_name = wt_sefu_urls::prepare_index_file($path[0]);
					} else {
						$_path = $path;
						$last = $_path[count($_path)-1];
						unset($_path[count($_path)-1]);
						$_name = wt_sefu_urls::prepare_url(implode('/',$_path)).'/'.wt_sefu_urls::prepare_index_file($last);
						$_name = str_replace('//', '/', $_name);
					}

					if($wt_language->languages_count > 1 && $language['code'] != DEFAULT_LANGUAGE) {
					$name = $language['code'].'/'.$_name;
					} else {
					$name = $_name;
					}
					if(!wt_not_null($name)) {
						continue;
					}

					if(array_search($name,$this->sefu_output_urls) && $i['it_id2'] == '0') {
						$duplicate[$name] += 1;
						$_name = substr($name,0,-5);
						$_name .= (string)$duplicate[$name].'.html';
						$name = $_name;
						unset($_name);
					}
						$this->sefu_output_urls[$url] = $name;
				} else {
					if($wt_language->languages_count > 1 && $language['code'] != DEFAULT_LANGUAGE) {
					$name = wt_sefu_urls::prepare_url($language['code'].'/'.implode('/',$path));
					} else {
					$name = wt_sefu_urls::prepare_url(implode('/',$path));
					}
					if(!wt_not_null($name)) {
						continue;
					}
					if(array_search($name,$this->sefu_output_urls) && $i['it_id2'] == '0') {
						$duplicate[$name] += 1;
						$_name = substr($name,0,-1);
						$_name .= (string)$duplicate[$name].'/';
						$name = $_name;
						unset($_name);
					}
						$this->sefu_output_urls[$url] = $name;

				}
			}
			unset($items_data,$duplicate);
	  }
	}
} // class
?>
