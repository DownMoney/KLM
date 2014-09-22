<?php
/**
* @package core
*/
 
  function wt_remove_magic_quotes(&$array) {
    if (!is_array($array) || (sizeof($array) < 1)) {
      return false;
    }

    foreach ($array as $key => $value) {
      if (is_array($value)) {
        wt_remove_magic_quotes($array[$key]);
      } else {
        $array[$key] = stripslashes($value);
      }
    }
  }

  

  if (get_magic_quotes_gpc() > 0) {
    if (isset($_GET)) {
      wt_remove_magic_quotes($_GET);
    }

    if (isset($_POST)) {
      wt_remove_magic_quotes($_POST);
    }

    if (isset($_COOKIE)) {
      wt_remove_magic_quotes($_COOKIE);
    }
	 
	 if (isset($_REQUEST)) {
      wt_remove_magic_quotes($_REQUEST);
    }
  }

  if (!function_exists('constant')) {
    function constant($constant) {
      eval("\$temp=$constant;");

      return $temp;
    }
  }

  if (!function_exists('checkdnsrr')) {
  
    function checkdnsrr($host, $type = 'MX') {
    if(substr(PHP_OS, 0, 3) != 'WIN') {
       if(wt_not_null($host) && wt_not_null($type)) {
        @exec("nslookup -type=$type $host", $output);
        while(list($k, $line) = each($output)) {
          if(eregi("^$host", $line)) {
            return true;
          }
        }
      }
      return false;
      } else {
      return false;
      }
    }
    
  } 

  if (!function_exists('array_unique')) {
    function array_unique($array) {
      $tmp_array = array();

      for ($i=0, $n=sizeof($array); $i<$n; $i++) {
        if (!in_array($array[$i], $tmp_array)) {
          $tmp_array[] = $array[$i];
        }
      }

      return $tmp_array;
    }
  }

  if (!function_exists('array_search')) {
    function array_search($needle, $haystack) {
      $match = false;

      foreach ($haystack as $key => $value) {
        if ($value == $needle) {
          $match = $key;
          break;
        }
      }

      return $match;
    }
  } 
	
  		
	$_GET = wt_filter_globals($_GET);
	$_POST = wt_filter_globals($_POST);
	$_REQUEST = wt_filter_globals($_REQUEST);
	$_COOKIE = wt_filter_globals($_COOKIE);
	$_SESSION = wt_filter_globals($_SESSION);
	
function wt_filter_globals($s = null) {
    if (is_string($s)) {
      $s = strip_tags($s,'<a><b><br><div><em><font><h1><h2><h3><h4><h5><h6><hr><img><li><map><ol><object><embed><param><p><small><span><strike><strong><style><sub><sup><table><tbody><td><tfoot><th><thead><tr><u><ul><map><ins><del><iframe><blockquote><code><abbr><acronym><cite><i>');
      return $s;
    } elseif (is_array($s)) {
      reset($s);
      while (list($k, $v) = each($s)) {
        $s[$k] = wt_filter_globals($v);
      }
      return $s;
    } else {
      return $s;
    }
 }
 
  
?>