<?php
include('inc/core2.inc.php');

$a = $wt_sql->db_list_tables();
  			
  			for ($i = 0; $i < $wt_sql->db_num_rows($a); $i++) {
  				if(stristr($wt_sql->db_tablename($a, $i), DB_PREFIX) && (substr($wt_sql->db_tablename($a, $i), -11) == 'description' || substr($wt_sql->db_tablename($a, $i), -4) == 'desc' ) )  {
	  		 	$system_tables[] = $wt_sql->db_tablename($a, $i);
	  		 	}
  			}
  			
  			
  			
  			foreach($system_tables as $table) {
  				
  			  $db_data_query = $wt_sql->db_query("SELECT * FROM " . $table . "");
			  $data = array();	
  			  while($db_data = $wt_sql->db_fetch_array($db_data_query) ) {
			  		$db_data = wt_update_data($db_data);
  			  		$data[] = $db_data;
  			  }
		
	 			if( wt_is_valid($data, 'array') ) {	  
					  $wt_sql->db_query("TRUNCATE " . $table . " ");
						  foreach( $data as $d ) {
						  	$wt_sql->db_perform($table, $d);   		
						  }	
				 } 	
			}

	function wt_update_data($data) {
		$data_array = array();
		if( wt_is_valid($data, 'array') ) {	
			foreach($data as $k => $d) {
				$d = str_replace('http://testy.arena.net.pl/', 'http://relacje.barlinek.com.pl/', $d);
				$d = str_replace('/barlinek/media/', '/media/', $d);
				$data_array[$k] = $d;
			}
		}
		return $data_array;
	}
	
	die('ok');
?>