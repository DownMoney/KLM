<?php
function wt_parse_sefu_string_to_url($s = null) {
	if(!wt_not_null($s)) {
		return;
	}
	$parameters = explode('/', $s);
	$count_params = count($parameters);
	$string_array = array();
	for ($i=0, $n=sizeof($parameters); $i<$n; $i++) {
		if (!isset($parameters[$i+1])) $parameters[$i+1] = '';
		if (strpos($parameters[$i], '[')) {
				parse_str($parameters[$i].'='.$parameters[$i+1], $pv);
		  		$string_array = wt_array_merge_recursive($string_array, $pv);
		} else {
			$string_array[$parameters[$i]] = $parameters[$i+1];
		}
		$i++;
	}
		if(wt_is_valid($string_array, 'array')) {
			return wt_http_build_query($string_array);
		}

		return null;
}

function wt_array_merge_recursive($array1, $array2) {
    $arrays = func_get_args();
    $narrays = count($arrays);
    $ret = $arrays[0];

    for ($i = 1; $i < $narrays; $i ++) {
        foreach ($arrays[$i] as $key => $value) {
                if (wt_is_valid($value, 'array') && isset($ret[$key])) {
                    $ret[$key] = wt_array_merge_recursive($ret[$key], $value);
                } else {
                    $ret[$key] = $value;
                }
        	}
    }
    return $ret;
}

function wt_get_ids_from_array($key, $array) {
	$ids = array();
	foreach($array as $a) {
		if(wt_is_valid($a[$key], 'int', 0)) {
			$ids[] = $a[$key];
		}
	}
	return $ids;
}

function wt_unserialize($str) {
		return unserialize(preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", stripslashes($str)));
	}

function wt_showon_query($prefix='') {
	global $wt_module;
	$mod_id = $wt_module->module_info['mod_id'];
	$query = " ( ";
	$query .= " (".$prefix."showon = '' OR ".$prefix."showon = NULL) OR ";
	$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|t=all;%') OR ";
	$task = wt_set_task($_GET, 't');

	if(!wt_not_null($task) || $task == 'mP' || $task == 'mainPage') {
		$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|t=mP;%') OR ";
	} elseif(wt_not_null($task)) {
		$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|t=".$task.";%') OR ";
	}

	$cPath = wt_set_task($_GET, 'cPath');
	if(wt_not_null($cPath)) {
		//$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|op=cPath=".$cPath."') OR ";
		$cPath_a = explode('_',$cPath);
			$_cpath = '';
		foreach($cPath_a as $cp) {
			$_cpath .= $cp;
			$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|op=cPath=".$_cpath.";%') OR ";
			$_cpath .= '_';
		}
	}




	if(wt_is_valid($_GET,'array')) {
		foreach($_GET as $k => $v) {
				if($k != 't' && $k != 'cPath' && $k != 'mod' && wt_not_null($k) && wt_not_null($v)) {
				$query .= " (".$prefix."showon LIKE '%mod=".$mod_id."|op=".$k."=".$v.";%') OR ";
				}
		}
	}
	$query = substr($query,0,-4);
	$query .= ")";
	return $query;
}

function wt_parse_showon_for_db($a = array()) {
	if( wt_is_valid($a, 'array') ) {
       $a = array_unique($a);
   	 $s = ";";
       return implode($s, $a).';';
   } else {
       return '';
   }
}

function wt_change_language_status($p = array()) {
	global $wt_sql;
  if( isset($p['db']) && wt_is_valid($p['db'], 'object') ) {
	$db = $p['db'];
  } else {
	$db = $wt_sql;
  }

  if(!wt_is_valid($p['tbl_val'],'array'))	{
  		$p['tbl_val'] = explode(',',$p['tbl_val']);
  }
  wt_clear_empty_array($p['tbl_val']);

if(wt_is_valid($p['tbl_val'],'array') && wt_is_valid($p['language_id'],'int','0')) {
         $db->db_query("UPDATE " . $p['table'] . " set language_status = '".(int)$p['status']."'  WHERE ".$p['tbl_key']." IN (".implode(',',$p['tbl_val']).") AND language_id = '".$p['language_id']."' ");
        }

}

function wt_is_root() {
	global $wt_user;
	if( $wt_user->usr_info['usr_id'] == 1 ) {
		return true;
	} else {
		return false;
	}
}

function wt_split_str_over($str,$length,$ins = '...', $ef = null) {
         $r = $str;
			if( strlen($str) > $length ) {
				if( !wt_is_valid($ef, 'int', '0') ) {
					$ef = round($length/2)-3;
				}

				$r = substr($str, 0, $ef);
				$r .= $ins;
				$r .= substr($str, (($length-$ef)*-1));
			}
        return $r;
    }

function parse_dates_diffrents($start_date, $end_date) {

  	 $return = array();

	 if( wt_not_null($start_date) && $start_date != '0000-00-00 00:00:00' && $start_date != '0000-00-00' && wt_not_null($end_date) && $end_date != '0000-00-00 00:00:00' && $end_date != '0000-00-00' ) {
		$start_date = strtotime($start_date)/86400;
		$end_date = strtotime($end_date)/86400;
		$now = time()/86400;
		$return['days'] = round($end_date-$now);
		$return['diffrent'] = round($end_date-$start_date);
		if ($return['diffrent']==0) {
			$return['percent']=100;
		} else {
			$return['percent'] = round((($return['diffrent'] - $return['days']) / $return['diffrent']) * 100);
		}
	 }
	return $return;
	}

function wt_translate($in, $out, $s) {
	if (is_string($s)) {
      $s = iconv($in, $out, $s);
      return $s;
    } elseif (is_array($s)) {
      reset($s);
      while (list($k, $v) = each($s)) {
        $s[$k] = wt_translate($in, $out, $v);
      }
      return $s;
    } else {
      return $s;
    }
}

function wt_string_user_safe_array($s = null) {

    if (is_string($s)) {
      $s = trim(strip_tags($s));
      return $s;
    } elseif (is_array($s)) {
      reset($s);
      while (list($k, $v) = each($s)) {
        $s[$k] = wt_string_user_safe_array($v);
      }
      return $s;
    } else {
      return $s;
    }

 }

 function wt_update_item_hits($t, $k, $i, $db = null) {
 	global $wt_sql, $wt_session;

	if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }

	if( wt_not_null($t) && wt_not_null($k) && wt_is_valid($i, 'int', '0') ) 	{
 		$db->db_query("UPDATE " . $t . " SET hits=hits+1 WHERE $k = '" . (int)$i . "' AND language_id = '" . (int)$wt_session->value('languages_id') . "' LIMIT 1");
		}
 }

 function wt_get_file_extension($file) {
	$ext = '';
	if( wt_not_null($file) ) {
		$info = pathinfo($file);
      $ext = $info['extension'];
	}
	return $ext;
}

 function wt_parse_array_to_query($search, $keys) {
	global $wt_sql;

	 	$query = " (";
      for ($i=0, $n=sizeof($search); $i<$n; $i++ ) {
        switch ($search[$i]) {
          case '(':
          case ')':
          case 'AND':
          case 'OR':
            $query .= " " . $search[$i] . " ";
            break;
          default:
$query .= " ( ";
foreach($keys as $k) {
$query .= $k . " LIKE '%" . $wt_sql->db_input($search[$i]) . "%' OR ";
}
$query = substr($query, 0, -4);
$query .= " ) ";

            break;
        }
	}

		$query .= " ) ";

		return $query;

 }

  function wt_parse_search_string($search_str = '', &$objects, $params = array() ) {
    $search_str = trim(strtolower(urldecode($search_str)));

    $pieces = split('[[:space:]]+', $search_str);
    $objects = array();
    $tmpstring = '';
    $flag = '';

	 $_params = array('skip_short' => 4);
	 $params = array($_params, $params);
for ($k=0, $cp = count($pieces); $k<$cp; $k++) {

	 if( strlen($pieces[$k]) < $params['skip_short'] ) {
	 	continue;
	 }
	 	$pieces[$k] = str_replace( array('(', ')'), array('', ''), $pieces[$k]);

      while (substr($pieces[$k], 0, 1) == '(') {
        $objects[] = '(';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 1);
        } else {
          $pieces[$k] = '';
        }
      }

      $post_objects = array();

      while (substr($pieces[$k], -1) == ')')  {
        $post_objects[] = ')';
        if (strlen($pieces[$k]) > 1) {
          $pieces[$k] = substr($pieces[$k], 0, -1);
        } else {
          $pieces[$k] = '';
        }
      }



      if ( (substr($pieces[$k], -1) != '"') && (substr($pieces[$k], 0, 1) != '"') ) {
        $objects[] = trim($pieces[$k]);

        for ($j=0; $j<count($post_objects); $j++) {
          $objects[] = $post_objects[$j];
        }
      } else {

        $tmpstring = trim(ereg_replace('"', ' ', $pieces[$k]));


        if (substr($pieces[$k], -1 ) == '"') {
          $flag = 'off';
          $objects[] = trim($pieces[$k]);
          for ($j=0; $j<count($post_objects); $j++) {
            $objects[] = $post_objects[$j];
          }

          unset($tmpstring);
          continue;
        }

        $flag = 'on';
        $k++;

        while ( ($flag == 'on') && ($k < count($pieces)) ) {
          while (substr($pieces[$k], -1) == ')') {
            $post_objects[] = ')';
            if (strlen($pieces[$k]) > 1) {
              $pieces[$k] = substr($pieces[$k], 0, -1);
            } else {
              $pieces[$k] = '';
            }
          }

          if (substr($pieces[$k], -1) != '"') {
            $tmpstring .= ' ' . $pieces[$k];
            $k++;
            continue;
          } else {

            $tmpstring .= ' ' . trim(ereg_replace('"', ' ', $pieces[$k]));
            $objects[] = trim($tmpstring);

            for ($j=0; $j<count($post_objects); $j++) {
              $objects[] = $post_objects[$j];
            }

            unset($tmpstring);
            $flag = 'off';
          }
        }
      }
    }

    $temp = array();
    for($i=0; $i<(count($objects)-1); $i++) {
      $temp[sizeof($temp)] = $objects[$i];

      if ( ($objects[$i] != 'AND') &&
           ($objects[$i] != 'OR') &&
           ($objects[$i] != '(') &&
           ($objects[$i] != ')') &&
           ($objects[$i+1] != 'AND') &&
           ($objects[$i+1] != 'OR') &&
           ($objects[$i+1] != '(') &&
           ($objects[$i+1] != ')') ) {
        $temp[sizeof($temp)] = 'AND';
      }
    }
    $temp[sizeof($temp)] = $objects[$i];
    $objects = $temp;

    $keyword_count = 0;
    $operator_count = 0;
    $balance = 0;
    for($i=0; $i<count($objects); $i++) {
      if ($objects[$i] == '(') $balance --;
      if ($objects[$i] == ')') $balance ++;
      if ( ($objects[$i] == 'AND') || ($objects[$i] == 'OR') ) {
        $operator_count ++;
      } elseif ( ($objects[$i]) && ($objects[$i] != '(') && ($objects[$i] != ')') ) {
        $keyword_count ++;
      }
    }

    if ( ($operator_count < $keyword_count) && ($balance == 0) ) {
      return true;
    } else {
      return false;
    }
  }


function wt_translate_to_utf($string, $in_encoding = '') {

if( wt_not_null($in_encoding) && $in_encoding != "UTF-8") {

    if (is_string($string)) {
      return iconv($in_encoding, 'UTF-8', $string);
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = wt_translate_to_utf($value, $in_encoding);
      }
      return $string;
    } else {
      return $string;
    }

	 } else {
	 return $string;
	 }

  }


function wt_is_admin_mode() {
	if( isset($_COOKIE['adminMode']) && $_COOKIE['adminMode'] == '1') {
		return true;
	}
		return false;
}

function wt_br2nl($text)
{
	$char = "\n";
   return  preg_replace('/<br\\s*?\/??>/i', $char, $text);
}

function wt_translate_country_id($cn_id) {
	$mod_zones_manager = wt_module::singleton('mod_zones_manager');
	return $mod_zones_manager->get_country_name($cn_id);
}


function move_uploaded_media_file($params = array()) {
	if( !wt_is_valid($params, 'array') ) {
		return false;
	}
	if(!isset($params['dir'], $params['file']) ) {
		return false;
	}
	$params2 = array();
	$params2 = wt_get_uploaded_file($params['file']);

	if(!wt_not_null($params2['tmp_name'])) {
		return false;
	}
	$create_dir = CFGF_DIR_FS_MEDIA . $params['dir'];
	if(!is_dir($create_dir)) {
		wt_create_dir_structure($create_dir);
		wt_create_blank_files($create_dir);
	}
	if(!is_dir($create_dir)) {
		return false;
	}
	$path_parts = pathinfo($params2['name']);
	$extension = strtolower($path_parts['extension']);

	if(!wt_not_null($params['file_name'])) {
		$params['file_name'] = wt_safe_string(basename($path_parts['basename'],'.'.$extension));
	}

	if($params['replace'] === false) {
		$i = 0;
		$base_name = $params['file_name'];
		while(file_exists($create_dir.DIRECTORY_SEPARATOR.$params['file_name'].'.'.$extension)) {
			$i++;
			$params['file_name'] = $base_name.'('.$i.')';
		}
	}

	if(move_uploaded_file($params2['tmp_name'], $create_dir . DIRECTORY_SEPARATOR . $params['file_name'] . '.' . $extension)) {
		@chmod($create_dir . DIRECTORY_SEPARATOR . $params['file_name'] . '.' . $extension, CFG_NEW_FILE_CHMOD);
		return $params['file_name'] . '.' . $extension;
	}
	return false;
}


function wt_update_last_modified($params, $db = null) {
	global $wt_sql, $wt_user;
	if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }
	$db->db_query("UPDATE " . $params['table'] . " SET last_modified = NOW(), modified_by = '" . $wt_user->usr_info['usr_id'] . "' WHERE " . $params['key'] . " = '" . $params['val'] . "' LIMIT 1");

}

function wt_is_valid($mixed, $type, $min = null, $safe = true) {

	if( !isset($mixed)  ) {
		return false;
	}
		switch($type) {
		  case 'array':
		  	if(!isset($min)) {
			  	return (is_array($mixed) && wt_not_null($mixed) );
			  } else {
				return (is_array($mixed) && wt_not_null($mixed) && count($mixed) > $min);
			  }
		  break;
		  case 'int':
		   if(isset($min) && (is_numeric($min) || is_int($min)) && (is_numeric($mixed) || is_int($mixed))  ) {
		   return ($mixed > $min);
		   } else {
		   return (is_numeric($mixed) || is_int($mixed));
		   }
		  break;
		  case 'email':
		  	return wt_validate_email($mixed);
		  break;
		  case 'object':
		  	return is_object($mixed);
		  break;
		  case 'string':
		  	if(!isset($min)) {
			  	return (is_string($mixed) && wt_not_null($mixed) );
			  } else {
				return (is_string($mixed) && wt_not_null($mixed) && strlen($mixed) > $min);
			  }
		  break;
		  case 'datetime':
		  	if(!isset($min)) {
			  	return (wt_not_null($mixed) && $mixed != '0000-00-00 00:00:00');
			  } else {
				return (wt_not_null($mixed) && $mixed != '0000-00-00 00:00:00' && strtotime($mixed) > strtotime($min));
			  }
		  break;
		  case 'date':
		  	if(!isset($min)) {
			  	return (wt_not_null($mixed) && $mixed != '0000-00-00');
			  } else {
				return (wt_not_null($mixed) && $mixed != '0000-00-00' && strtotime($mixed) > strtotime($min));
			  }
		  break;
		}
return false;
}

function wt_js_string_save($string) {

		$string = str_replace('"', "'", $string);

	return $string;
}

function wt_get_sort_order_for_items_to_db($db_fields = array(), $default = '', $sort = '') {


	  if(!wt_not_null($sort))	{
		$sort = wt_set_task($_REQUEST, 'sort');
	  }

	if(!wt_not_null($sort))	{
		$sort = $default;
	  }

  if ( (isset($sort, $db_fields)) && (ereg('[0-9][ad]', $sort)) && is_array($db_fields) && wt_not_null($db_fields) ) {

				$sort_col = substr($sort, 0 , 1);
            $sort_order = substr($sort, 1);

				if(isset($db_fields[$sort_col]) ) {

					switch($sort_order) {
						default:
						case 'a':
							return $db_fields[$sort_col];
						break;
						case 'd':
							return $db_fields[$sort_col] . ' DESC';
						break;
					}
				}
		  }

		return null;

	} // function


 function wt_display_sort_order($sort_list = array(), $default = '', $current = '') {
 		global $wt_template;

 	 $dir_ws_images =	CFGF_DIR_WS_TEMPLATES . $wt_template->theme . '/media/images/';

 	 if(!wt_not_null($current)) {
 	 	$current = wt_set_task($_REQUEST, 'sort');
 	 }

 	 if(!wt_not_null($current)) {
 	 	$current = $default;
 	 }

 $string = '<table>';
 $string .= '<tr>';

 $string .= '<td><b>Sortuj według:</b></td>';


  foreach($sort_list as $key => $name) {
   $string .= '<td>';
   if($current == $key . 'a' || $current == $key . 'd') {
  	$string .= '<b>' . $name . '</b>&nbsp;';
  	} else {
  	$string .= '' . $name . '&nbsp;';
  	}
  	$string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('sort') ) . 'sort=' . $key . 'a') . '" title=" ' . $name . ' [A-Z] ">';

  			if($current == $key . 'a') {
  			$string .= '<img src="' . $dir_ws_images . 'sort_arrow_a_selected.gif" alt=" ' . $name . ' [A-Z] " border="0" align="absmiddle">';
  			} else {
  				$string .= '<img src="' . $dir_ws_images . 'sort_arrow_a.gif" alt=" ' . $name . ' [A-Z] " border="0" align="absmiddle">';
  			}

   $string .= '</a>';
 /***** sort D **********/
  	$string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('sort') ) . 'sort=' . $key . 'd') . '" title=" ' . $name . ' [Z-A] ">';

  			if($current == $key . 'd') {
  			$string .= '<img src="' . $dir_ws_images . 'sort_arrow_d_selected.gif" alt=" ' . $name . ' [Z-A] " border="0" align="absmiddle">';
  			} else {
  				$string .= '<img src="' . $dir_ws_images . 'sort_arrow_d.gif" alt=" ' . $name . ' [Z-A] " border="0" align="absmiddle">';
  			}

   $string .= '</a>';
  	$string .= '</td>';
  }

 $string .= '</tr>';
 $string .= '</table>';

 return $string;

 }

 function wt_parse_access_to_array($access = '', $true_access = true) {

 	if(wt_not_null($access)) {

 		$access = substr($access, 1, strlen($access));
 		$access = substr($access, 0, strlen($access)-1);
 		$access = str_replace('||', '|', $access);
 		$access = str_replace('||', '|', $access);
 		$access = str_replace('||', '|', $access);
 		$parsed_access = explode('|', $access);
 	}

 	if(wt_is_valid($parsed_access, 'array')) {
 	 return $parsed_access;
 	} elseif($true_access === true) {
 	 return array('0', '2');
 	} else {
 	 return array();
 	}

 }

 function wt_safe_string($string) {
 	 	$string = urldecode($string);
		$string = wt_pl_to_iso($string);
		$string = wt_clear_string($string);
		$string = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $string);
		$string = str_replace('%', '', $string);
		$string = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $string);
		$string = preg_replace('/&.+?;/', '', $string); // kill entities
		$string = preg_replace('/[^%a-zA-Z0-9 _-]/', '', $string);
		$string = preg_replace('/\s+/', '_', $string);
		$string = preg_replace('|-+|', '_', $string);
		$string = trim($string, '_');
 		return $string;
 }

 function wt_pl_to_iso($string) {

   $iso88592 = array('ę','ó','ą','ś','ł','ż','ź','ć','ń','Ę','Ó','Ą','Ś','Ł','Ż','Ź','Ć','Ń');

 $pl = array('e','o','a','s','l','z','z','c','n','E','O','A','S','L','Z','Z','C','N');
  return str_replace($iso88592,$pl, $string);
}

 function wt_clear_string($string = null) {

    if (is_string($string)) {
      $string = trim(strip_tags($string));
  		$string = str_replace('"', '', $string);
  		$string = str_replace("'", "", $string);
      return $string;
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = wt_clear_string($value);
      }
      return $string;
    } else {
      return $string;
    }

 }


 function wt_random_array($array = array(), $count = 1) {

 $return_array = array();

 if(wt_not_null($array) && is_array($array)) {

  	if(sizeof($array) < $count) {

 // 	$count = sizeof($array);
  	$return_array = $array;
  	shuffle($return_array);
  	} else {

  	$random_array = array_rand($array, $count);

  	if(is_array($random_array) && wt_not_null($random_array)) {

  	foreach($random_array as $rand) {

  	$return_array[$rand] = $array[$rand];

  	}
  	} else {

  	$return_array[$random_array] = $array[$random_array];

  	}

  	}


  	}


  return $return_array;

 }


 function wt_rm_thumbs($params = array())
{


   if(!isset($params['dirname'])) { $params['dirname'] =  CFGF_DIR_FS_MEDIA; }
   if(!isset($params['level'])) { $params['level'] = 1; }
   if(!isset($params['exp_time'])) { $params['exp_time'] = null; }

   if($_handle = @opendir($params['dirname'])) {

        while (false !== ($_entry = readdir($_handle))) {
            if ($_entry != '.' && $_entry != '..') {
                if (@is_dir($params['dirname'] . DIRECTORY_SEPARATOR . $_entry)) {
                    $_params = array(
                        'dirname' => $params['dirname'] . DIRECTORY_SEPARATOR . $_entry,
                        'level' => $params['level'] + 1,
                        'exp_time' => $params['exp_time']
                    );

                    wt_rm_thumbs($_params);
                }
                else if(substr(basename($_entry), 0, 3) == 'th_' || substr(basename($_entry), 0, 7) == '.thumb_') {
                @unlink($params['dirname'] . DIRECTORY_SEPARATOR . $_entry);
                }
            }
        }
        closedir($_handle);
   }


   return (bool)$_handle;

}


  function wt_prepare_item_desc(&$item_short, &$item_full, &$db_data = array()) {


  if(strlen($item_short) == strlen(strip_tags($item_short))) {
      $item_short = nl2br($item_short);
      }

     if(strlen($item_full) == strlen(strip_tags($item_full))) {
      $item_full = nl2br($item_full);
      }

      if(strlen(str_replace('&nbsp;', '', trim($item_short))) < 10) {
      $item_short = strip_tags($item_full);
		$db_data['_desc_short_from_full'] = true;
		if( strlen($item_short) > 400 ) {
			$item_short = substr($item_short, 0, 400) . ' ...';
		}
      }

      if(strlen(str_replace('&nbsp;', '', trim($item_full))) < 10) {
      $item_full = $item_short;
		$db_data['_desc_full_from_short'] = true;
      }


   if(strlen($item_short) < 10) {
      $item_short = null;
		unset($db_data['_desc_short_from_full']);
   }

   if(strlen($item_full) < 10) {
      $item_full = null;
		unset($db_data['_desc_full_from_short']);
   }



  }

function wt_parse_access_for_db($access, $true_access = true) {

  $parsed_access = '|';
 if(is_array($access) && wt_not_null($access)) {
 $parsed_access .= implode('|', $access);
 } elseif($true_access === true) {
 $parsed_access .= '0|2';
 }
 $parsed_access .= '|';

 if($true_access != true && strlen($parsed_access) == 2) {
 	$parsed_access = null;
 }

 return $parsed_access;
}

function wt_access_query($access_prefix = '') {



  global $wt_user;
  $access_query = '';
  if(wt_is_valid($wt_user->usr_group, 'array')) {
    if(array_key_exists('1', $wt_user->usr_group)) {
    return '';
  }

   $user_acces = array_keys($wt_user->usr_group);
   $access_query = '';
   $access_parse = (wt_not_null($access_prefix) ? $access_prefix . '.' : '') . 'access = \'\' OR ( ';

     // wt_print_array($user_acces);

     foreach($user_acces as $access) {
     	$access_parse .= "(" . (wt_not_null($access_prefix) ? $access_prefix . '.' : '') . "access LIKE '%|" . $access . "|%') OR ";
     }
     $access_parse = substr($access_parse, 0, -4);

     $access_parse .= " ) ";



    if(wt_not_null($access_parse)) {
    $access_query = " AND ( " . $access_parse . " ) ";
    }

  }

  return $access_query;
}

function wt_sort_order_text($action = 'add') {

	$sort_order = array();

	switch($action) {
		default:
		case 'add':
			$sort_order = array('-1' => 'przesuń początek',
								  '99999999' => 'przesuń na koniec');
			break;
	   case 'edit':
			$sort_order = array('' => 'nie rób nic',
							        '-1' => 'przesuń początek',
								     '99999999' => 'przesuń na koniec',);
			break;

	}

 return $sort_order;
}


function wt_http_build_query($formdata, $numeric_prefix = null)
    {
        // If $formdata is an object, convert it to an array
        if (is_object($formdata)) {
            $formdata = get_object_vars($formdata);
        }

        // Check we have an array to work with
        if (!is_array($formdata)) {
            user_error('http_build_query() Parameter 1 expected to be Array or Object. Incorrect value given.',
                E_USER_WARNING);
            return false;
        }

        // If the array is empty, return null
        if (empty($formdata)) {
            return;
        }

        // Argument seperator
        $separator = ini_get('arg_separator.output');

        // Start building the query
        $tmp = array ();
        foreach ($formdata as $key => $val) {
            if (is_integer($key) && $numeric_prefix != null) {
                $key = $numeric_prefix . $key;
            }

            if (is_scalar($val)) {
                array_push($tmp, urlencode($key).'='.urlencode($val));
                continue;
            }

            // If the value is an array, recursively parse it
            if (is_array($val)) {
                array_push($tmp, wt__http_build_query($val, urlencode($key)));
                continue;
            }
        }

        return implode($separator, $tmp);
    }

    // Helper function
    function wt__http_build_query ($array, $name)
    {
        $tmp = array ();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                array_push($tmp, wt__http_build_query($value, sprintf('%s[%s]', $name, $key)));
            } elseif (is_scalar($value)) {
                array_push($tmp, sprintf('%s[%s]=%s', $name, urlencode($key), urlencode($value)));
            } elseif (is_object($value)) {
                array_push($tmp, wt__http_build_query(get_object_vars($value), sprintf('%s[%s]', $name, $key)));
            }
        }

        // Argument seperator
        $separator = ini_get('arg_separator.output');

        return implode($separator, $tmp);
    }

function wt_change_status_full($params, $db = null) {
  global $wt_user, $wt_sql;
  if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }

  $modified_by = isset($params['modified_by']) ? $params['modified_by'] : $wt_user->usr_info['usr_login'];


  if(!wt_is_valid($params['tbl_val'],'array'))	{
  		$params['tbl_val'] = explode(',',$params['tbl_val']);
  }
  wt_clear_empty_array($params['tbl_val']);

if(!wt_is_valid($params['tbl_val'],'array')) {
return;
}

if($params['status'] == '1') {
         $db->db_query("UPDATE " . $params['table'] . " set status = '" . $params['status'] . "', last_modified = now(), date_up = now(),   modified_by = '" . $modified_by . "'" . (!isset($params['dreset_date']) ? ",date_down = NULL" : ' ') . "  WHERE " . $params['tbl_key'] . " IN (".implode(',',$params['tbl_val']).") ");
        } else if($params['status'] == '0') {
         $db->db_query("UPDATE " . $params['table'] . " set status = '" . $params['status'] . "',  last_modified = now(), date_down = now(),  modified_by = '" . $modified_by . "'" . (!isset($params['dreset_date']) ? ",date_up = NULL" : ' ') . "  WHERE " . $params['tbl_key'] . " IN (".implode(',',$params['tbl_val']).") ");
         }

}

function wt_change_status_base($params, $db = null) {
  global $wt_user, $wt_sql;

  if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }

if(!wt_is_valid($params['tbl_val'],'array'))	{
  		$params['tbl_val'] = explode(',',$params['tbl_val']);
  }
  wt_clear_empty_array($params['tbl_val']);

if(!wt_is_valid($params['tbl_val'],'array')) {
return;
}

if($params['status'] == '1') {
         $db->db_query("UPDATE " . $params['table'] . " set ". (isset($params['status_name']) ? $params['status_name'] : 'status')." = '" . $params['status'] . "', last_modified = now(), modified_by = '" . $wt_user->usr_info['usr_login'] . "' WHERE " . $params['tbl_key'] . " IN (".implode(',',$params['tbl_val']).") ");
        } elseif($params['status'] == '0') {
         $db->db_query("UPDATE " . $params['table'] . " set ". (isset($params['status_name']) ? $params['status_name'] : 'status')." = '" . $params['status'] . "', last_modified = now(),  modified_by = '" . $wt_user->usr_info['usr_login'] . "' WHERE " . $params['tbl_key'] . " IN (".implode(',',$params['tbl_val']).") ");
        }

}

function wt_parse_params_for_db($params = '') {
 return serialize($params);

}


function wt_fix_sort_order($params, $db = null) {
          global $wt_sql;
        $tbl_key = $params['tbl_key'];
        $tbl = $params['tbl'];
        $tbl_val = $params['tbl_val'];
        $where = $params['where'];
        $op_where = $params['op_where'];
        $tables = $params['tables'];

if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }

       $db_items_query = $db->db_query("SELECT " . $tbl_key. " FROM " . ($tables ? " $tables" : "$tbl") . " " . ($where ? "WHERE $where" : '') . " ORDER BY " . ($sort_order ? "$sort_order" : 'sort_order') . " ASC ");
       $i = 1;
       while($db_items = $db->db_fetch_array($db_items_query)) {

       $db->db_query("UPDATE " . $tbl . " SET sort_order = '" . $i . "' WHERE " . $tbl_key . " = '" . $db_items[$tbl_key] . "' LIMIT 1");

       $i++;
       }


        }

function wt_set_fast_sort_order($params, $db = null) {
         global $wt_sql;

	if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }
        if(wt_is_valid( $params, 'array' ) ) {
        	$db->db_query("UPDATE " . $params['tbl'] . " SET sort_order = '" . $params['sort_order'] . "' WHERE " . $params['tbl_key'] . " = '" . $params['tbl_val'] . "' LIMIT 1");
	  			wt_fix_sort_order( $params );

        }

		return true;

        }

function wt_set_sort_order($dirn, $params, $db = null) {
         global $wt_sql;

        $tbl_key = $params['tbl_key'];
        $tbl_keys = $params['tbl_keys'];
        $tbl = $params['tbl'];
        $tbl_val = $params['tbl_val'];
        $sort = $params['sort'];
        $where = $params['where'];
        $tables = $params['tables'];
        $op_where = $params['op_where'];

   if( !isset($db) || !is_object($db) ) {
	$db = $wt_sql;
  }


        if($dirn > 0) {

       $db_next_item_query = $db->db_query("SELECT " . ($tbl_keys ? " $tbl_keys" : "$tbl_key, sort_order") . " FROM " . ($tables ? " $tables" : "$tbl") . " WHERE " . ($sort_order ? "$sort_order" : 'sort_order') . " > '" . $sort . "' " . ($where ? " AND $where" : '') . " ORDER BY " . ($sort_order ? "$sort_order" : 'sort_order') . " LIMIT 1");

       if($db->db_num_rows($db_next_item_query)) {

      $db_next_item = $db->db_fetch_array($db_next_item_query);

        $db->db_query("UPDATE " . $tbl . " SET sort_order = '" . $sort . "' WHERE " . $tbl_key . " = '" . $db_next_item[$tbl_key] . "' " . ($op_where ? " AND $op_where" : '') . "");
        $db->db_query("UPDATE " . $tbl . " SET sort_order = '" . $db_next_item['sort_order'] . "' WHERE " . $tbl_key . " = '" . $tbl_val . "' " . ($op_where ? " AND $op_where" : '') . "");
        }


        } else if($dirn < 0) {

        $db_prev_item_query = $db->db_query("SELECT " . $tbl_key. ", sort_order FROM " . $tbl . " WHERE sort_order < " . $sort . " " . ($where ? " AND $where" : '') . " ORDER BY sort_order DESC LIMIT 1");

       if($db->db_num_rows($db_prev_item_query)) {

      $db_prev_item = $db->db_fetch_array($db_prev_item_query);

        $db->db_query("UPDATE " . $tbl . " SET sort_order = '" . $sort . "' WHERE " . $tbl_key . " = '" . $db_prev_item[$tbl_key] . "'");
        $db->db_query("UPDATE " . $tbl . " SET sort_order = '" . $db_prev_item['sort_order'] . "' WHERE " . $tbl_key . " = '" . $tbl_val . "'");

        }


        }

		return true;

        }


function wt_not_null($value) {
	 if(is_object($value)) {
	 	return true;
	 }
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } elseif(is_numeric($value)) {
	 	if($value != 0) {
			return true;
		}
	 		return false;
	 } elseif(is_string($value)) {
      if (($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    } elseif(is_bool($value)) {
        return $value;
    } elseif(isset($value)) {
	 	 return true;
	 } else {
	 	return false;
	 }
  }

function wt_create_dir_structure($params) {

    if (!file_exists($params)) {
        $_open_basedir_ini = ini_get('open_basedir');

        if (DIRECTORY_SEPARATOR == '/') {
            $_dir = $params;
            $_dir_parts = preg_split('!/+!', $_dir, -1, PREG_SPLIT_NO_EMPTY);
            $_new_dir = ($_dir{0}=='/') ? '/' : getcwd().'/';
            if($_use_open_basedir = !empty($_open_basedir_ini)) {
                $_open_basedirs = explode(':', $_open_basedir_ini);
            }

        } else {
            $_dir = str_replace('\\','/', $params);
            $_dir_parts = preg_split('!/+!', $_dir, -1, PREG_SPLIT_NO_EMPTY);
            if (preg_match('!^((//)|([a-zA-Z]:/))!', $_dir, $_root_dir)) {
                $_new_dir = $_root_dir[1];
                if (isset($_root_dir[3])) array_shift($_dir_parts);

            } else {
                $_new_dir = str_replace('\\', '/', getcwd()).'/';

            }

            if($_use_open_basedir = !empty($_open_basedir_ini)) {
                $_open_basedirs = explode(';', str_replace('\\', '/', $_open_basedir_ini));
            }

        }
        foreach ($_dir_parts as $_dir_part) {
            $_new_dir .= $_dir_part;

            if ($_use_open_basedir) {
                $_make_new_dir = false;
                foreach ($_open_basedirs as $_open_basedir) {
                    if (substr($_new_dir, 0, strlen($_open_basedir)) == $_open_basedir) {
                        $_make_new_dir = true;
                        break;
                    }
                }
            } else {
                $_make_new_dir = true;
            }

            if ($_make_new_dir && !file_exists($_new_dir) && !@mkdir($_new_dir, CFG_NEW_DIR_CHMOD) && !is_dir($_new_dir)) {
                return false;
            }
            @chmod($_new_dir, CFG_NEW_DIR_CHMOD);
            $_new_dir .= '/';
        }
    }
}

  function wt_exit() {
  global $wt_session;
  $wt_session->close();
  exit();
  }

  function wt_redirect($url) {

    header('Location: ' . $url);

    wt_exit();
  }

  function wt_break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }

 function wt_get_all_get_params($exclude_array = '', $get_array = array()) {
   global $wt_session;

    if (!is_array($exclude_array)) {
     $exclude_array = array();
}
	if(!is_array($get_array) || !wt_not_null($get_array)) {
	$get_array = $_GET;
	}

	$dont_include = array($wt_session->name, 'error', 'x', 'y', 'mod', 'f', 'display_self', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content');
	$exclude_array = array_merge($exclude_array, $dont_include);

	foreach($exclude_array as $key => $val) {
		if(strpos($val,'[') != false) {
			parse_str($val, $parsed);
			foreach($parsed as $k1 => $v1) {
				if(wt_is_valid($v1,'array')) {
					foreach($v1 as $k2 => $v2) {
						if(wt_is_valid($v2,'array')) {
							foreach($v2 as $k3 => $v3) {
					  			if(wt_is_valid($v3,'array')) {
									foreach($v3 as $k4 => $v4) {
					  					if(wt_is_valid($v4,'array')) {
											foreach($v4 as $k5 => $v5) {
					  							if(wt_is_valid($v5,'array')) {

												} else {
													unset($get_array[$k1][$k2][$k3][$k4][$k5]);
												}
											}
										} else {
											unset($get_array[$k1][$k2][$k3][$k4]);
										}
									}
								} else {
									unset($get_array[$k1][$k2][$k3]);
								}
							}
						} else {
							unset($get_array[$k1][$k2]);
						}
					}
				} else {
					unset($get_array[$k1]);
				}
			}
		} else {
			unset($get_array[$val]);
		}

	}

	if(isset($get_array['page']) && ($get_array['page'] == '1' || $get_array['page'] == '0')) {
  	unset($get_array['page']);
	}
    return wt_http_build_query($get_array) . '&';
  }


  function wt_get_ip_address() {

    if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
    } else {
      if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
      } elseif (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
      } else {
        $ip = getenv('REMOTE_ADDR');
      }
    }

    return $ip;
  }

function wt_rand($min = null, $max = null) {
    static $seeded;

    if (!isset($seeded)) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

 function wt_create_random_value($length, $type = 'mixed') {
    if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;

    $rand_value = '';
    while (strlen($rand_value) < $length) {
      if ($type == 'digits') {
        $char = wt_rand(0,9);
      } else {
        $char = chr(wt_rand(0,255));
      }
      if ($type == 'mixed') {
        if (eregi('^[a-z0-9]$', $char)) $rand_value .= $char;
      } elseif ($type == 'chars') {
        if (eregi('^[a-z]$', $char)) $rand_value .= $char;
      } elseif ($type == 'digits') {
        if (ereg('^[0-9]$', $char)) $rand_value .= $char;
      }
    }

    return $rand_value;
  }

function wt_validate_password($plain, $encrypted) {

    if (wt_not_null($plain) && wt_not_null($encrypted)) {

      $stack = explode(':', $encrypted);

      if (sizeof($stack) != 2) {
      return false;
      }

      if (md5($stack[1] . $plain) == $stack[0]) {
        return true;
      }

    }

    return false;
  }


  function wt_encrypt_password($plain) {
    $password = '';

    for ($i=0; $i<5; $i++) {
      $password .= wt_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }

function wt_setcookie($name, $value = '', $expire = 0, $path = '/', $domain = '', $secure = '0') {
    setcookie($name, $value, $expire, $path, (wt_not_null($domain) ? $domain : ''), $secure);
  }

  function wt_print_array($array, $type = 'print_r') {

  echo '<pre>';
  switch($type){
  default:
  case 'print_r';
  print_r( $array );
  break;
  case 'var_dump';
  var_dump( $array );
  break;
  case 'var_export';
  var_export( $array );
  break;
  }
  echo '</pre>';

  }

function wt_check_access( $item_access = '' ) {
   global $wt_user, $wt_session;

   $user_acces = $wt_user->usr_group;

   if(!wt_not_null($item_access)) {
   return true;
   }



    if(is_array($user_acces)) {

    if(array_key_exists('1', $user_acces)) {
    return true;
    }


    $item_access = substr($item_access, 0, -1);
    $item_access = substr($item_access, 1, strlen($item_access));

    $item_access_array = explode('|', $item_access);

    if(in_array('2', $item_access_array)) {
    return true;
    }



    foreach ($user_acces as $key => $access) {
     //   echo $key . '<Br>';
    if(in_array($key, $item_access_array)) {
    return true;
    }
    }

    }

	 return false;
}

function wt_parse_access($access = '', $true_access = true) {
 return wt_parse_access_to_array($access, $true_access);
}

function wt_return_item_status($status_id, $select_all = false) {

  if($status_id == '0' || $select_all) {

  $status_array = array('id' => '0',
  						        'icon' => 'statusLF_0.gif',
  								  'text' => 'Nie opublikowano',
  							  	  'change_to' => '1',
  							  	  'change_to_text' => 'Aktywuj');
  }

  if($status_id == '1' || $select_all) {

   $status_array = array('id' => '1',
  									'icon' => 'statusLF_1.gif',
  									'text' => 'Opublikowano',
  									'change_to' => '0',
  							  	  'change_to_text' => 'Deaktywuj');

  }

  if($status_id == '2' || $select_all) {

   $status_array = array('id' => '2',
  									'icon' => 'publish_y.gif',
  									'text' => 'Oczekuje na publikacje',
  									'change_to' => '1',
  							  	  'change_to_text' => 'Aktywuj');

  }

  if($status_id == '3' || $select_all) {

   $status_array[] = array('id' => '3',
  									'icon' => 'publish_r.gif',
  									'text' => 'Przeterminowane',
  									'change_to' => '1',
  							  	  'change_to_text' => 'Aktywuj');
  }

  return $status_array;
}

function wt_return_item_status_easy($status_id, $select_all = false) {

  if($status_id == '0' || $select_all) {

  $status_array = array('id' => '0',
  						      'icon' => 'statusL_0.gif',
  								'text' => 'Aktywuj',
  								'text_on' => 'Nie aktywny',
  								'change_to' => '1');
  }

  if($status_id == '1' || $select_all) {

   $status_array = array('id' => '1',
  						       'icon' => 'statusL_1.gif',
  								 'text' => 'Deaktywuj',
  								 'text_on' => 'Aktywny',
  								 'change_to' => '0');

  }

  return $status_array;
}

function wt_return_item_yes_or_no($status_id, $select_all = false) {

  if($status_id == '0' || $select_all) {

  $status_array = array('id' => '0',
  						      'icon' => 'publish_x.png',
  								'text' => 'W3ącz',
  								'change_to' => '1');
  }

  if($status_id == '1' || $select_all) {

   $status_array = array('id' => '1',
  									'icon' => 'tick.png',
  									'text' => 'Wy3ącz',
  									'change_to' => '0');

  }

  return $status_array;
}


function wt_get_access_desc($groups_array, $type = 'array') {

$mod_user_manager = wt_module::singleton('mod_user_manager');
    return $mod_user_manager->wt_get_access_desc($groups_array, $type);


}


function wt_get_user_group_tree($parent_id = '0', $spacing = '', $exclude = '', $group_tree_array = '', $include_itself = false) {

    $mod_user_manager = wt_module::singleton('mod_user_manager');
    return $mod_user_manager->wt_get_user_group_tree($parent_id, $spacing, $exclude, $group_tree_array, $include_itself);
  }

  function wt_prepare_user_group_array_to_form() {

  $mod_user_manager = wt_module::singleton('mod_user_manager');

  return $mod_user_manager->wt_prepare_user_group_array_to_form();
  }

  function wt_return_item_date($date_added, $date_up) {

  if(wt_not_null($date_up)) {
  return $date_up;
  } else {
  return $date_added;
  }

  }

  function wt_return_item_author($added_by, $author_alias) {
  if(wt_not_null($author_alias)) {
  return $author_alias;
  } else {
  return $added_by;
  }

  }

  function wt_set_task(&$arr, $name, $def = null, $safe = false) {
   if($safe == true) {
	return isset( $arr[$name] ) ? wt_string_user_safe_array($arr[$name]) : $def;
	} else {
	return isset( $arr[$name] ) ? $arr[$name] : $def;
	}

  }

  function wt_parse_publish_date_desc($date = '', $type = 'up') {
  if(!wt_not_null($date) || $date == '0000-00-00 00:00:00') {

    if($type == 'up') {
    return TEXT_IMMEDIATELLY;
    }

    if($type == 'down') {
    return TEXT_NEVER;
    }


  } else {
  return $date;
  }
  }


 function wt_check_permission($mod = '', $perm_key, $redirect = false) {
   global $wt_sql, $wt_module, $wt_user, $wt_session;

 //  return true;

      $user_acces = $wt_user->usr_group;



    if(is_array($user_acces)) {

    if(array_key_exists('1', $user_acces)) {
    return true;
    }

    }

     if(!wt_not_null($mod)) {
      $mod_id = $wt_module->module_info['mod_id'];
     } else {
      $mod_info = $wt_module->get_module_info('', $mod);
     	$mod_id = $mod_info['mod_id'];
     }



   if(isset($wt_user->usr_permission[$mod_id][$perm_key])) {
   return true;
   } else {

   if($redirect) {
   return wt_redirect(wt_href_link('mod_user', '', 't=no_permission'));
   }
   return false;
   }
 }

  function wt_get_uploaded_file($filename) {
  $uploaded_file = NULL;
    if (isset($_FILES[$filename]) && (wt_not_null($_FILES[$filename]['tmp_name'])) && ($_FILES[$filename]['tmp_name'] != 'none')) {
      $uploaded_file = array('name' => $_FILES[$filename]['name'],
                             'type' => $_FILES[$filename]['type'],
                             'size' => $_FILES[$filename]['size'],
                             'tmp_name' => $_FILES[$filename]['tmp_name']);
    } elseif (isset($GLOBALS['HTTP_POST_FILES'][$filename]) && (wt_not_null($GLOBALS['HTTP_POST_FILES'][$filename]['tmp_name'])) && ($GLOBALS['HTTP_POST_FILES'][$filename]['tmp_name'] != 'none')) {
      global $HTTP_POST_FILES;

      $uploaded_file = array('name' => $HTTP_POST_FILES[$filename]['name'],
                             'type' => $HTTP_POST_FILES[$filename]['type'],
                             'size' => $HTTP_POST_FILES[$filename]['size'],
                             'tmp_name' => $HTTP_POST_FILES[$filename]['tmp_name']);
    }


    return $uploaded_file;
  }


  function wt_copy_uploaded_file($filename, $target) {
    if (substr($target, -1) != DIRECTORY_SEPARATOR) $target .= DIRECTORY_SEPARATOR;

    $target .= $filename['name'];

    move_uploaded_file($filename['tmp_name'], $target);
  }

   function wt_rmdir($params)
{
   if(!isset($params['level'])) { $params['level'] = 1; }
   if(!isset($params['exp_time'])) { $params['exp_time'] = null; }
   if(!isset($params['dirname']) && !wt_is_valid($params, 'array') && wt_not_null($params) ) { $params['dirname'] = $params; }


	if(!wt_not_null($params['dirname']) || !@is_dir($params['dirname']) ) {
		return false;
	}

  	if(substr($params['dirname'],0,strlen(CFGF_DOCUMENT_FS_ROOT)) != CFGF_DOCUMENT_FS_ROOT || $params['dirname'] == CFGF_DOCUMENT_FS_ROOT) {
		return false;
	}

   if($_handle = @opendir($params['dirname'])) {

        while (false !== ($_entry = @readdir($_handle))) {
            if ($_entry != '.' && $_entry != '..') {
                if (@is_dir($params['dirname'] . DIRECTORY_SEPARATOR . $_entry)) {
                    $_params = array(
                        'dirname' => $params['dirname'] . DIRECTORY_SEPARATOR . $_entry,
                        'level' => $params['level'] + 1,
                        'exp_time' => $params['exp_time']
                    );

                    wt_rmdir($_params);
                }
                else {
                @unlink($params['dirname'] . DIRECTORY_SEPARATOR . $_entry);
                }
            }
        }
        @closedir($_handle);
   }

   if ($params['level']) {
       return @rmdir($params['dirname']);
   }
   return (bool)$_handle;

}


function wt_create_blank_files($params)
{
	if(!wt_is_valid($params, 'array') && wt_not_null($params)) {
		$params = array('level' => 1,
							 'exp_time' => null,
							 'dirname' => $params);
	}

   if($_handle = @opendir($params['dirname'])) {

        while (false !== ($_entry = readdir($_handle))) {
            if ($_entry != '.' && $_entry != '..') {
                if (@is_dir($params['dirname'] . DIRECTORY_SEPARATOR . $_entry)) {
                    $_params = array(
                        'dirname' => $params['dirname'] . DIRECTORY_SEPARATOR . $_entry,
                        'level' => $params['level'] + 1,
                        'exp_time' => $params['exp_time']
                    );

                    wt_create_blank_files($_params);
                }

            }
        }
        closedir($_handle);
   }

   if ($params['level']) {

   if(!file_exists($params['dirname'] . DIRECTORY_SEPARATOR . $_entry . DIRECTORY_SEPARATOR . 'index.html')) {
   $create_file = @fopen($params['dirname'] . DIRECTORY_SEPARATOR . $_entry . DIRECTORY_SEPARATOR . 'index.html', 'w');
    return  @fclose($create_file);
    }
   }
   return (bool)$_handle;
}



function wt_set_time_limit($limit) {
    if (!get_cfg_var('safe_mode')) {
      set_time_limit($limit);
    }
  }

 function wt_check_email($email) {

 		if( !wt_not_null($email) ) {
 			return true;
 		} else {
 		  return wt_validate_email($email);
 		}

 }

 function wt_validate_email($email) {
    $valid_address = true;

    $mail_pat = '^(.+)@(.+)$';
    $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
    $atom = "$valid_chars+";
    $quoted_user='(\"[^\"]*\")';
    $word = "($atom|$quoted_user)";
    $user_pat = "^$word(\.$word)*$";
    $ip_domain_pat='^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
    $domain_pat = "^$atom(\.$atom)*$";

    if (eregi($mail_pat, $email, $components)) {
      $user = $components[1];
      $domain = $components[2];
      // validate user
      if (eregi($user_pat, $user)) {
        // validate domain
        if (eregi($ip_domain_pat, $domain, $ip_components)) {
          // this is an IP address
          for ($i=1;$i<=4;$i++) {
            if ($ip_components[$i] > 255) {
              $valid_address = false;
              break;
            }
          }
        }
        else {
          // Domain is a name, not an IP
          if (eregi($domain_pat, $domain)) {
            /* domain name seems valid, but now make sure that it ends in a valid TLD or ccTLD
               and that there's a hostname preceding the domain or country. */
            $domain_components = explode(".", $domain);
            // Make sure there's a host name preceding the domain.
            if (sizeof($domain_components) < 2) {
              $valid_address = false;
            } else {
              $top_level_domain = strtolower($domain_components[sizeof($domain_components)-1]);
              // Allow all 2-letter TLDs (ccTLDs)
              if (eregi('^[a-z][a-z]$', $top_level_domain) != 1) {
                $tld_pattern = '';
                // Get authorized TLDs from text file
                $tlds = file(CFGF_DIR_FS_INCLUDES . 'tld.txt');
                while (list(,$line) = each($tlds)) {
                  // Get rid of comments
                  $words = explode('#', $line);
                  $tld = trim($words[0]);
                  // TLDs should be 3 letters or more
                  if (eregi('^[a-z]{3,}$', $tld) == 1) {
                    $tld_pattern .= '^' . $tld . '$|';
                  }
                }
                // Remove last '|'
                $tld_pattern = substr($tld_pattern, 0, -1);
                if (eregi("$tld_pattern", $top_level_domain) == 0) {
                    $valid_address = false;
                }
              }
            }
          }
          else {
            $valid_address = false;
          }
        }
      }
      else {
        $valid_address = false;
      }
    }
    else {
      $valid_address = false;
    }
    if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
      if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
        $valid_address = false;
      }
    }
    return $valid_address;
  }

  function wt_clear_empty_id($id) {

  	$id=ereg_replace(',{2,}',',',$id);
  	$id=trim($id,',');
  	if (eregi('^(([0-9]+,)*[0-9]+)$',$id) === false) {
     		return false;
    } else {
    	return $id;
    }
  }

  function wt_convert_price($price) {
		//$price = ereg_replace(',','.',$price);
		$price_tmp = $price;
		//echo "old price: ".$price."<br />";
		$price_tmp = split('(,|\.)',$price);
		//echo "price table: ".wt_print_array($price_tmp);
		$size = count($price_tmp);
		//echo "size: ".$size."<br />";
		if ($size>1) {
			$new_price = '';
			for($i=0;$i<$size-1;$i++) {
				$new_price .= $price_tmp[$i];
			}
			//$i++;
			$new_price.='.'.$price_tmp[$i];
			unset($price);
			$price = $new_price;
		}
		//echo "new price: ".$price;
		return (float)$price;
	}

 function wt_clear_empty_array(&$a) {
	if( wt_is_valid($a, 'array') ) {
		$_a = $a;
		foreach($_a as $k => $v) {
			if( !wt_not_null($v) ) {
				unset($a[$k]);
			}
		}
	}
 }



?>
