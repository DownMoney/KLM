<?php
	function wt_href_link($mod = '', $key_words = '', $parameters = '', $index_file = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true, $params = array()) {
		global $wt_module, $request_type, $wt_session, $SID, $wt_plugins,$wt_language;

	if(isset($params['outside']) && $params['outside'] === true && wt_not_null($params['url'])) {
			if(($add_session_id == true) && ($wt_session->is_started == true)) {
					$_sid = $wt_session->name . '=' . $wt_session->id;
					if($params['sign_session'] === true) {
						$_sid .= '&'.$wt_session->name.'_checksum='.wt_encrypt_password($wt_session->name.$wt_session->id.date('H').$wt_session->id.SESSIONS_SECRET);
					}
			}
				$sep = '?';
			if(strpos($params['url'],'?') !== false) {
				$sep = '&';
			}
			if(strpos($params['url'],'http://') === false && strpos($params['url'],'https://') === false) {
				$params['url'] = 'http://'.$params['url'];
			}
			return $params['url'].(wt_not_null($_sid) ? $sep.$_sid : '');
	}

		if($params['generate_access_code'] === true) {
			$search_engine_safe = false;
		}

		$is_manager = false;
		if($mod == 'home') {
			unset($mod);
		}
		if(substr($mod, 0, 4) == 'mod_' ) {
			$mod = $wt_module->installed_modules_keys[$mod];
		}
		if(isset($mod) && (!wt_not_null($mod) || $mod == '')) {
			$mod = $wt_module->module_info['mod_id'];
		}
		if($wt_module->is_manager($mod)) {
			$is_manager = true;
		}


		if($wt_module->is_secure($mod)) {
			$is_secure = true;
			$connection = 'SSL';
		}



		$rest_server = CFGF_DIR_WS_CATALOG;
		$link = '';

		if(CFGF_REQUEST_TYPE == 'SSL' && $connection == 'NONSSL') {
			$base_link = CFGF_HTTP_SERVER . $rest_server;
			$params['full_url'] = true;
		} elseif(CFGF_REQUEST_TYPE == 'NONSSL' && $connection == 'SSL') {
			$base_link = CFGF_HTTPS_SERVER . $rest_server;
			$params['full_url'] = true;
		} elseif(CFGF_REQUEST_TYPE == 'SSL' && $connection == 'SSL') {
			$base_link = CFGF_HTTPS_SERVER . $rest_server;
		} else {
			$base_link = CFGF_HTTP_SERVER . $rest_server;
		}



		if( isset($params['full_url']) || $wt_session->value('__use_full_urls') === true) {
		} else {
			$base_link = $rest_server;
		}

		if( substr($parameters, 0, 1) == '&' ) {
			$parameters = substr($parameters, 1);
		}


		global $wt_sefu_urls;
		if (!is_object($wt_sefu_urls)) {
			$wt_sefu_urls = wt_sefu_urls::singleton();
		}
		if ($wt_plugins->is_started('sefu') && !$is_manager && is_object($wt_sefu_urls) && wt_is_valid( $wt_module->installed_modules_ids, 'array' )  && $search_engine_safe === true) {
//		if ($wt_plugins->is_started('sefu') && (!$is_manager || $mod==1) && is_object($wt_sefu_urls) && wt_is_valid( $wt_module->installed_modules_ids, 'array' ) ) {
			$mod_key = $wt_module->installed_modules_ids[$mod];

			if(in_array($mod_key, $wt_sefu_urls->sefus_ids[$wt_language->language['id']]) ) {
				$sefu_id = array_search($mod_key, $wt_sefu_urls->sefus_ids[$wt_language->language['id']]);

				if($sefu_id == '_off'.$mod) {
					$search_engine_safe = false;
				} else {

					if($sefu_id == 'home') {
						$sefu_id = '';
					} else {
						$sefu_id .= '/';
					}

					$parsed_url = $wt_sefu_urls->make_sefu_link($mod_key, $parameters);

					if( wt_not_null($parsed_url) && $parsed_url !== false ) {
						if( $parsed_url == '/' ) {
						return $base_link . $sefu_id;
						}
						return $base_link . $sefu_id . $parsed_url;
					}
				} //	if($sefu_id == 'off') {
			}
			/*
			if(wt_not_null($key_words)) {
			$link .= '?' . (substr($key_words, -1) == '/') ? substr($key_words, 0, -1) : $key_words;
			}
			*/
		}
		if (wt_not_null($mod)) {
			$link .= (wt_not_null($link) ? '&' : '?') . 'mod=' . $mod;
			$separator =  '&';
		} else {
			$separator = '&';
		}
		if (wt_not_null($plug) && wt_not_null($mod)) {
			$link .= '&f=' . $plug;
			$separator = '&';
		} else if(wt_not_null($plug) && !wt_not_null($mod)) {
			$link .= '?f=' . $plug;
			$separator = '&';
		} else {
			$separator = '&';
		}
		if (wt_not_null($parameters) && (wt_not_null($plug) || wt_not_null($mod))) {
			$link .= '&' . $parameters;
			$separator = '&';
		}
		if (wt_not_null($parameters) && (!wt_not_null($plug) && !wt_not_null($mod))) {
			$link .= '?' . $parameters;
			$separator = '&';
		}
		if (!wt_not_null($parameters) && !wt_not_null($plug) && !wt_not_null($mod)) {
			$separator = '?';
		}
		while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);
		if ( ($add_session_id == true) && ($wt_session->is_started == true) && (PLUGIN_SESSION_FORCE_COOKIE_USAGE == 'False') ) {
			if ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
				if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
				//	$_sid = $wt_session->name . '=' . $wt_session->id;
				}
			}
		}
		while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

			$link = explode('&', $link);
			$link = array_unique($link);
			$link = implode('&', $link);

		if ( ($search_engine_safe == true) && $wt_plugins->is_started('sefu') && !$is_manager) {
			$return_link = $base_link . $link . (wt_not_null($index_file) ? '/' . $index_file : '') ;
			$return_link = str_replace('?', '', $return_link);
			$return_link = str_replace('&', '/', $return_link);
			$return_link = str_replace('=', '/', $return_link);
			$separator = '?';
		} else {
			$return_link = $base_link . $link;
		}
		if (isset($_sid)) {
			$return_link .= $separator . $_sid;
		}
		if( $params['add_amp'] === true ) {
			$return_link = str_replace('&', '&amp;', $return_link);
		}

		if( substr($return_link, -2, 2) == '//' ) {
			$return_link = substr($return_link, 0, -1);
		}

		if($params['generate_access_code'] == true) {
			$access_code = md5(str_replace('?','',$link).'spertajnew3ruiZxhasło');
			$return_link .= $separator.'_aC='.$access_code;
		}

		return $return_link;
	}

?>
