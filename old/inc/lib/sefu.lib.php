<?php

if(!defined('CFG_SEFU_SEPARATOR')) {
	define('CFG_SEFU_SEPARATOR', '-');
}
if(!defined('CFG_SEFU_CAPITALIZE')) {
	define('CFG_SEFU_CAPITALIZE', 'lower');
}
if(!defined('CFG_SEFU_PAGE_TEXT')) {
	define('CFG_SEFU_PAGE_TEXT', 'strona-');
}
if(!defined('CFG_SEFU_SORT_TEXT')) {
	define('CFG_SEFU_SORT_TEXT', 'sort-');
}

class wt_sefu_urls {
	var $sefus_ids = array();

	function wt_sefu_urls() {
		global $wt_module,$wt_sql;

		$cache = new wt_cache('file');
		$cache_key = array();
		$cache_key['groups'] = array('core', 'modules');
		$cache_key['name'] = 'sefu_id';
		$cache_key['dont_add_gr_key'] = true;
		if(!$cache->read($cache_key)) {
			$db_modules_query = $wt_sql->db_query("SELECT md.sefu_id, m.mod_key, md.language_id FROM " . TABLE_MODULES_DESCRIPTION." md LEFT JOIN ".TABLE_MODULES." m ON m.mod_id = md.md_id WHERE md.sefu_id != '' AND m.mod_type='local'");
			while($db_modules = $wt_sql->db_fetch_array($db_modules_query)) {
				$this->sefus_ids[$db_modules['language_id']][$db_modules['sefu_id']] = $db_modules['mod_key'];
			}
		$cache->writeBuffer($this->sefus_ids);
		} else {
		$this->sefus_ids = $cache->getCache();
		}
	unset($cache);
	}

	function &singleton() {
		static $instance;
		if(!isset($instance) || !is_object($instance)) {
			$instance = new wt_sefu_urls();
		}
		return $instance;
	}

	function parse_url() {
		global $wt_language, $wt_session;

		if( wt_not_null($_SERVER['REQUEST_URI']) ) {
			$parse_uri = $_SERVER['REQUEST_URI'];

			if(false != $get_data_string_pos = strpos($parse_uri, '?')) {
				$get_data_string = substr($parse_uri, $get_data_string_pos+1);
				$parse_uri = substr($parse_uri, 0, $get_data_string_pos);
			}

			$parse_uri = substr($parse_uri, strlen(CFGF_DIR_WS_HTTP_CATALOG));
			$parse_uri = urldecode($parse_uri);
			$working = explode('/', $parse_uri);
		}

		if( !wt_not_null($parse_uri) ) {
			return false;
		}

		if($wt_language->languages_count > 1) {
			if($key=array_search($working,'language')) {
				$lang=$working[$key+1];
			} elseif(strlen($working[0]) == 2) {
				$lang = $working[0];
			} elseif(strlen($working[1]) == 2) {
			  	$lang = $working[1];
			}

			if($wt_language->exists($lang)) {
				$wt_language->set_language($lang);
			}

		} else {
			  $wt_language->get_browser_language();
		}

		$home = false;
		if( array_key_exists($working[0], $this->sefus_ids[$wt_language->language['id']]) ) {
			$this->working_module = $this->sefus_ids[$wt_language->language['id']][$working[0]];
			$parse_uri = substr($parse_uri, strlen($working[0] . '/'));
		} elseif ( array_key_exists('home', $this->sefus_ids[$wt_language->language['id']]) ) {
			$home = true;
			$this->working_module = $this->sefus_ids[$wt_language->language['id']]['home'];
		} else {
			return false;
		}

		$_real_data = array();
		$real_data = array();

	 	$urls = $this->get_sefu_mod_urls($this->working_module, $wt_language->language['id'], 'in');


		if( !wt_not_null($parse_uri) && $home === false ) {
			$real_data['mod'] = $this->working_module;
		} else {
		global $wt_module;

		$static_tmp = explode('/',$parse_uri);
		$parse_uri = array();
		foreach($static_tmp as $st) {
			if(preg_match('/'.CFG_SEFU_PAGE_TEXT.'[0-9]/', $st)) {
				$page = str_replace(CFG_SEFU_PAGE_TEXT,'',$st);
				continue;
			}
			if(preg_match('/'.CFG_SEFU_SORT_TEXT.'[0-9][ad]/', $st)) {
				$sort = str_replace(CFG_SEFU_SORT_TEXT,'',$st);
				continue;
			}
				$parse_uri[] = $st;
		}
		$parse_uri = implode('/',$parse_uri);
		$uric = crc32($parse_uri);

	   if(!wt_not_null($parsed_url = $urls[$uric])) {
			global $wt_template;
			$wt_template->load_404 = true;
			return false;
		}
		unset($urls);
		$real_data_url_string = 'mod=' . $wt_module->get_module_id($this->working_module) . '';
		$real_data_url_string .= '&'.$parsed_url.((isset($page) && wt_is_valid($page,'int',0)) ? '&page='.$page : '').((isset($sort) && wt_not_null($sort)) ? '&sort='.$sort : '');


			while (strstr($real_data_url_string, '&&')) {
				$real_data_url_string = str_replace('&&', '&', $real_data_url_string);
			}
			parse_str($real_data_url_string, $real_data);
		}


		if( wt_is_valid($real_data, 'array') || wt_is_valid($_real_data, 'array') ) {
			$_REQUEST = array_merge($_REQUEST, $real_data, $_real_data);
			$_GET = array_merge($_GET, $real_data, $_real_data);
			return true;
		}


		return false;
	}

	function get_sefu_mod_urls($mod_key, $language_id = null, $type = 'out') {
		global $wt_session;
		if( !wt_is_valid($language_id,'int','0') ) {
			$language_id = $wt_session->value('languages_id');
		}
		if($type == 'in') {
			$cache = new wt_cache('file');
	   	$ck = array();
			$ck['groups'] = array('sefu');
			$ck['dont_add_gr_key'] = true;
			$ck['name'] = $mod_key.'-in-'.$language_id;
			if(!$cache->read($ck)) {
				$this->make_sefu_mod_urls($mod_key);
				return $this->get_sefu_mod_urls($mod_key, $language_id, 'in');
			}
			return $cache->getCache($ck);
		}

		if( !isset($this->sefu_output_urls[$mod_key]) )	{
		$cache = new wt_cache('file');
	   $ck = array();
		$ck['groups'] = array('sefu');
		$ck['dont_add_gr_key'] = true;
		$ck['name'] = $mod_key.'-out-'.$language_id;
		$cache->read($ck);
		if(!$cache->read($ck)) {
				$this->make_sefu_mod_urls($mod_key);
		}
		$this->sefu_output_urls[$mod_key] = $cache->getCache($ck);
		unset($cache);
		}
	}

	function make_sefu_link($mod_key, $url, $language_id = null) {
			$this->get_sefu_mod_urls($mod_key, $language_id);

			$_url = explode('&',$url);
			$url = array();
			foreach($_url as $u) {
				if(strpos($u, 'page=') !== false) {
					$page = explode('=',$u);
					$page = $page[1];
					continue;
				}
				if(strpos($u,'sort=') !== false) {
					$sort = explode('=',$u);
					$sort = $sort[1];
					continue;
				}
				if(wt_not_null($u)) {
					$url[] = $u;
				}
			}
			sort($url);
			$url = implode('&',$url);
			$urlc = crc32($url);
		 //	wt_print_array($url);
	  //	wt_print_array($this->sefu_output_urls[$mod_key]);

		if( wt_is_valid($this->sefu_output_urls[$mod_key], 'array') && isset($this->sefu_output_urls[$mod_key][$urlc]) && wt_not_null($this->sefu_output_urls[$mod_key][$urlc]) ) {
				return $this->sefu_output_urls[$mod_key][$urlc].((isset($page) && wt_is_valid($page,'int',0)) ? CFG_SEFU_PAGE_TEXT.$page.'/' : '').((isset($sort) && wt_not_null($sort)) ? CFG_SEFU_SORT_TEXT.$sort.'/' : '');
		}
		return false;
	}


	function make_sefu_mod_urls($mod = null) {
		global $wt_plugins, $wt_language, $wt_module;

			$mods = $wt_plugins->load_module_plugins('sefu', $mod);
			if( !wt_is_valid($mods, 'array') ) {
					return;
			}

		if( wt_is_valid($mods, 'array') ) {
			$cache = new wt_cache('file');
	   	$ck = array();
			$ck['groups'] = array('sefu');
			$ck['dont_add_gr_key'] = true;

		$run_sefu = false;
		$last_runed = array();
		$previous_run = new wt_cache('file');
		$cache_key = array();
		$cache_key['groups'] = array('config');
		$cache_key['name'] = 'sefu_cron';
		$cache_key['dont_add_gr_key'] = true;
		if ($previous_run->read($cache_key)) {
			$last_runed = $previous_run->getCache();
		}

if(!wt_not_null($mod)) {
		$last_runed = array();
}
foreach($wt_language->catalog_languages as $lng) {
	if($lng['skip_sefu'] == 1) {
		continue;
	}
			foreach($mods as $m) {
				if(wt_not_null($m)) {
					$run_sefu = false;
					$class_name = $m . '_sefu_plug';
					$class_instance =  new $class_name;

					if( !isset($last_runed[$m]) || !wt_not_null($last_runed[$m]) || $class_instance->check_to_run_sefu($last_runed[$m]) || !file_exists(CFGF_DIR_FS_WORK . 'query_cache'.DIRECTORY_SEPARATOR.'sefu'.DIRECTORY_SEPARATOR.$m.'-'.$lng['id'].'.cache') ) {
						$run_sefu = true;
					}

					if( $run_sefu !== true ) {
						continue;
					}

					$class_instance->get_sefu_urls($lng);
					if($wt_module->is_installed('mod_sefu_manager')) {
						$mod_sefu_manager = wt_module::singleton('mod_sefu_manager');
				   	$class_instance->sefu_output_urls = $class_instance->sefu_output_urls+$mod_sefu_manager->get_sefus_for_sefu_lib($m,$lng['id']);
					}
					if (wt_is_valid($class_instance->sefu_output_urls,'array')) {
							$_sefu_in = array();
							$_sefu_out = array();
						foreach($class_instance->sefu_output_urls as $key => $val) {
							if(!wt_not_null($val) || !is_string($val) || !wt_not_null($key) || !is_string($key)) {
								continue;
							}
							$url = explode('&',$key);
							sort($url);
							unset($class_instance->sefu_output_urls[$key]);
							$_sefu_in[crc32($val)] = implode('&',$url);
							$_sefu_out[crc32(implode('&',$url))] = $val;
						}
						$ck['name'] = $m.'-in-'.$lng['id'];
						$cache->read($ck);
						$cache->writeBuffer($_sefu_in);
						$ck['name'] = $m.'-out-'.$lng['id'];
						$cache->read($ck);
						$cache->writeBuffer($_sefu_out);
					}
					unset($class_instance);
					$last_runed[$m] = time();
					$previous_run->writeBuffer($last_runed);
				}
		}
} // foreach($wt_language->catalog_languages as $lng) {
			unset($cache, $ck,$previous_run);
}
	}

	function prepare_url($url = null) {
		if( wt_not_null($url) )	{

			$url = wt_clear_string($url);
			$url = wt_pl_to_iso($url);
			$url = trim($url);
			if(CFG_SEFU_CAPITALIZE == 'lower') {
				$url = mb_strtolower($url, 'UTF-8');
			}
			if(CFG_SEFU_CAPITALIZE == 'upper') {
				$url = mb_strtoupper($url, 'UTF-8');
			}
			$url = str_replace(
						array('?', '.', '&', ',', '%', '=', '-_', '_-', ':', ';', '%', '\\', '[', ']', '(', ')', '!', '_', '@', '#', '$', '^', '*', '{', '}', '|', "'", '"'),
						array('', CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, '', CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, '', '', '', '', '', CFG_SEFU_SEPARATOR,'','','','','','','','','',''),
						$url);


			$url = $url . '/';
			while (strstr($url, '//')) {
				$url = str_replace('//', '/', $url);
			}
			while (strstr($url, ' ')) {
				$url = str_replace(' ', CFG_SEFU_SEPARATOR, $url);
			}
			while (strstr($url, '-_')) {
				$url = str_replace('-_', CFG_SEFU_SEPARATOR, $url);
			}
			while (strstr($url, '_-')) {
				$url = str_replace('_-', CFG_SEFU_SEPARATOR, $url);
			}
			while (strstr($url, '--')) {
				$url = str_replace('--', CFG_SEFU_SEPARATOR, $url);
			}
			$url = trim($url, CFG_SEFU_SEPARATOR);
			$url = trim($url, '_');

		}
		return $url;
	}

	function prepare_index_file($index_file = null,$ext = '.html') {
		if( wt_not_null($index_file) )	{

			$index_file = wt_clear_string($index_file);
			$index_file = trim(wt_pl_to_iso($index_file));
			if(CFG_SEFU_CAPITALIZE == 'lower') {
				$index_file = mb_strtolower($index_file, 'UTF-8');
			}
			if(CFG_SEFU_CAPITALIZE == 'upper') {
				$index_file = mb_strtoupper($index_file, 'UTF-8');
			}

			$index_file = str_replace(
						array('?', '.', '&', ',', '=', '+', '__', '-_', '_-', ':', ';', '%', '\\', '[', ']', '(', ')', '!', '_', '@', '#', '$', '^', '*', '{', '}', '|', "'", '"', '/', '/\/'),
						array('', CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, '', CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, CFG_SEFU_SEPARATOR, '', '', '', '', '', CFG_SEFU_SEPARATOR,'','','','','','','','','','',CFG_SEFU_SEPARATOR,CFG_SEFU_SEPARATOR),
						$index_file);

			while (strstr($index_file, ' ')) {
				$index_file = str_replace(' ', CFG_SEFU_SEPARATOR, $index_file);
			}
			while (strstr($index_file, '-_')) {
				$index_file = str_replace('-_', CFG_SEFU_SEPARATOR, $index_file);
			}
			while (strstr($index_file, '_-')) {
				$index_file = str_replace('_-', CFG_SEFU_SEPARATOR, $index_file);
			}
			while (strstr($index_file, '--')) {
				$index_file = str_replace('--', CFG_SEFU_SEPARATOR, $index_file);
			}

		  $index_file = trim($index_file, CFG_SEFU_SEPARATOR);
		  $index_file = trim($index_file, '_');

			$index_file .= $ext;
		}

		return $index_file;
	}

	function make_key($key) {
		return sprintf('%u', crc32($key));
	}

}

?>
