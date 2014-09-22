<?php

class WT_Plugin_sefu {
	var $title = 'Przyjazne URL',
	$description = 'Przyjazne URL.',
	$uninstallable = true,
	$depends,
	$preceeds = 'session';

	function start() {
		global $wt_module;
		return true;
	}

	function action_after_user() {
		return false;
	}

	function check_redirect() {
		$get = $_GET;
		unset($get['mod']);
		$get_string = '';
		if(wt_is_valid($get, 'array')) {
			$get_string = wt_http_build_query($get);
		}
		$parsed_url = wt_href_link($_REQUEST['mod'], null, $get_string);
		if(wt_not_null($parsed_url) && strpos($parsed_url, '?mod=') === false && strpos($parsed_url, '/mod/') === false && basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location:".$parsed_url);
			header("Connection: close");
			exit();
		}
	}

	function action_after_module() {
		global $wt_module;

		if(isset($_REQUEST['mod']) && $wt_module->is_manager($_REQUEST['mod']) )  {
			return true;
		} elseif(wt_is_valid($_REQUEST['mod'], 'int', 0) && !wt_is_valid($_POST, 'array')) {
			WT_Plugin_sefu::check_redirect();
		} elseif(strpos($_SERVER['REQUEST_URI'], '?mod=') === false ) {

		if( strpos($_SERVER['REQUEST_URI'], '/mod/') === false ) {
		  $GLOBALS['wt_sefu_urls'] = new wt_sefu_urls();
		  if($GLOBALS['wt_sefu_urls']->parse_url()) {
			return;
			}
		}

			$a = array();
			$mod_pos = strpos($_SERVER['REQUEST_URI'], '/mod/')+1;
			$app_data_string = substr($_SERVER['REQUEST_URI'], $mod_pos, strlen($_SERVER['REQUEST_URI']));
			$app_data_string = str_replace('%5B','[',$app_data_string);
			$app_data_string = str_replace('%5D',']',$app_data_string);


			if(false != $get_data_string_pos = strpos($app_data_string, '?')) {
				$get_data_string = substr($app_data_string, $get_data_string_pos+1);
				$app_data_string = substr($app_data_string, 0, $get_data_string_pos);
			}
			$app_data_string = trim($app_data_string, '/');

			if( !wt_not_null($app_data_string) )	{
				return;
			}
			$parameters = explode('/', $app_data_string);
			$count_params = count($parameters);
			if(substr($parameters[$count_params-1], -5) == '.html' ) {
				unset($parameters[$count_params-1]);
			}
			$GET_array = array();
			for ($i=0, $n=sizeof($parameters); $i<$n; $i++) {
				if (!isset($parameters[$i+1])) $parameters[$i+1] = '';
				if (strpos($parameters[$i], '[')) {
						parse_str($parameters[$i].'='.$parameters[$i+1], $pv);
				  		$GET_array = WT_Plugin_sefu::array_merge_recursive2($GET_array, $pv);
				} else {
					$_GET[$parameters[$i]] = $parameters[$i+1];
					$_REQUEST[$parameters[$i]] = $parameters[$i+1];
				}
				$i++;
			}
			if(wt_not_null($get_data_string)) {
			 	parse_str($get_data_string, $gdt);
				$GET_array = array_merge($GET_array, $gdt);
			}

			if (sizeof($GET_array) > 0) {
				foreach ($GET_array as $key => $value) {
					$_GET[$key] = $value;
					$_REQUEST[$key] = $value;
				}
			}
			WT_Plugin_sefu::check_redirect();
			//$_REQUEST = array_merge($_REQUEST, $_GET);
		}



	}

	function array_merge_recursive2($array1, $array2) {

    $arrays = func_get_args();
    $narrays = count($arrays);
    $ret = $arrays[0];

    for ($i = 1; $i < $narrays; $i ++) {
        foreach ($arrays[$i] as $key => $value) {
                if (wt_is_valid($value, 'array') && isset($ret[$key])) {
                    $ret[$key] = WT_Plugin_sefu::array_merge_recursive2($ret[$key], $value);
                } else {
                    $ret[$key] = $value;
                }
        	}
    }

    return $ret;
}

	function action_after_block() {
		return false;
	}

	function action_before_load() {
		return false;
	}

	function stop() {
		return true;
	}

	function install() {
		return false;
	}

	function remove() {
		return false;
	}

	function keys() {
		return false;
	}
}
?>
