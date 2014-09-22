<?php


  class wt_sql {
  var $q_count;
  var $debug = array();
  var $link;
  var $server;
  var $username;
  var $password;
  var $database;



  function wt_sql($server, $username, $password, $database, $link = 'db_link', $silent_mode, $persistant, $collate = 'utf8') {
 // global $$link;



  $this->q_count = 0;
  $this->server = $server;
  $this->username = $username;
  $this->password = $password;
  $this->database = $database;


  if ($silent_mode == 'true')	{
    if ($persistant == 'true') {
      $this->link = @mysql_pconnect($server, $username, $password, true) or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()) );
    } else {
      $this->link = @mysql_connect($server, $username, $password, true) or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()));
    }



    if ($this->link) {

     mysql_select_db($database, $this->link) or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()));
}
	$this->set_collate($collate);
    return $this->link;


  } else {

   if ($persistant == 'true') {
      $this->link = mysql_pconnect($server, $username, $password, true)or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()));
    } else {

      $this->link = mysql_connect($server, $username, $password, true)or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()));
    }

    if ($this->link) {

     mysql_select_db($database, $this->link) or wt_core_log::add('db_error', array(mysql_errno(), mysql_error()));
}
	 $this->set_collate($collate);
    return $this->link;
  }

  }

  function db_close() {
    mysql_close();
    return mysql_close($this->link);
  }

  function set_collate($code = null) {
  	if( wt_not_null($code) ) {
    $this->db_query("SET character_set_client = '" . $code . "', character_set_connection = '" . $code . "', character_set_database = '" . $code . "', character_set_results = '" . $code . "', character_set_server = '" . $code . "'");
	}
  }

  function db_single_query($query) {
  			return $this->db_fetch_array($this->db_query($query));
  }

  function db_query($query) {
  	//echo "=============================</br>".$query."<br />=============================</br>";
  	if(DEVELOPERS_MODE == 'true' || DEBUG == 'true' ) {
     $start_time = getmicrotime();
         }
    $result = @mysql_query($query, $this->link)  or wt_core_log::add('db_error', array(mysql_errno($this->link), mysql_error($this->link), $query));
    $blad = mysql_error($this->link);
    $this->q_count++;
    if(DEVELOPERS_MODE == 'true' || DEBUG == 'true' ) {
        $end_time = getmicrotime();

        $this->debug[] = ('Czas: ' . round($end_time-$start_time,6) . $query);

         }
    return $result;
  }

  function db_perform($table, $data, $action = 'insert', $parameters = '', $prepare_data = false) {

	if($prepare_data === true && $action == 'update') {
		$this->prepare_data($data);
		}

    reset($data);
    if ($action == 'insert' || $action == 'insert delayed' || $action == 'insert ignore') {
      $query = $action . ' into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . $this->db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . $this->db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }
    return $this->db_query($query);
  }


  function prepare_data(&$data) {
	$_data = $data;

  	if( wt_is_valid( $_data, 'array') )	{

		foreach( $_data as $k => $v ) {
			if( !wt_not_null($v) ) {
				unset($data[$k]);
			}
		}

	}

  }

  function db_fetch_array($db_query) {
	return @mysql_fetch_array($db_query, MYSQL_ASSOC);
  }

  function db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function db_insert_id() {
    return mysql_insert_id($this->link);
  }

  function db_free_result($res) {
    return mysql_free_result($res);
  }

  function db_fetch_fields($db_query) {
    return mysql_fetch_field($db_query);
  }

  function db_output($string) {
    return stripslashes($string);
  }

  function db_input($string) {
    return addslashes($string);
  }

  function db_output_data($string) {
    if (is_string($string)) {
      return $this->db_output($string);
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = $this->db_output_data($value);
      }
      return $string;
    } else {
      return $string;
    }

  }

  function db_prepare_input($string) {
    if (is_string($string)) {
      return $this->db_input(trim($string));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = $this->db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }

  function db_prepare_input_ajax($string)	{
	if (is_string($string)) {
      return urldecode($string);
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = $this->db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }



  }


  function db_list_tables() {
   return mysql_list_tables($this->database, $this->link);
  }

  function db_tablename($res, $i = 0) {
  return mysql_tablename($res, $i);
  }

  function db_list_fields($table) {
  return mysql_list_fields($this->database, $table, $this->link);
  }

  function db_num_fields($res) {
  return mysql_num_fields($res);
  }

  function db_field_name($res, $i) {
  return mysql_field_name($res, $i);
  }

   function db_field_type($res, $i) {
  return mysql_field_type($res, $i);
  }

  function db_field_flags($res, $i) {
  return mysql_field_flags($res, $i);
  }

}
?>