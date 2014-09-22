<?php
/**
* @package core
*/

class wt_config {
    
    
    function wt_config() {
    global $wt_sql;
    
    
    
  $config_cache = new wt_cache();
  $cache_key = array();
  $cache_key['groups'] = array('config');
  $cache_key['name'] = 'config_cache';
  $cache_key['dont_add_gr_key'] = true;
  
  if(!$config_cache->read($cache_key)) {
  
  $db_configuration_query = $wt_sql->db_query("SELECT configuration_key, configuration_value FROM " . TABLE_CONFIGURATION);
            while ($db_configuration = $wt_sql->db_fetch_array($db_configuration_query)) {
            $db_configuration = $wt_sql->db_output_data($db_configuration);
            $conf_data[] = array('cfg_key' => $db_configuration['configuration_key'],
            							'cfg_value' => $db_configuration['configuration_value']);
                
        }
  
  
  $config_cache->writeBuffer($conf_data);
  } else {
  $conf_data = $config_cache->getCache();
  }
  unset($config_cache);
  
  if(is_array($conf_data) && wt_not_null($conf_data)) {
  
  		reset($conf_data);
  		
  	while(list(, $cfg) = each($conf_data)) {
  	
  			define($cfg['cfg_key'], $cfg['cfg_value']);
  		}
  		
  }
    
            
    } // function
    
    function load_db_table_definition() {
    		global $wt_sql, $wt_language, $wt_module;
    		
    	  $file_string = '';
    	  $file_string .= '<?php ' . "\n";
  	
  if(!@include(CFGF_DIR_FS_WORK . 'sys_db_tables.php')) {
  		
		$db_tables_query = $wt_sql->db_query("SELECT m.mod_id, m.mod_key, m.mod_db_tables, md.params FROM (" . TABLE_MODULES . " m) LEFT JOIN " . TABLE_MODULES_DESCRIPTION . " md ON m.mod_id = md.md_id AND md.language_id = '".$wt_language->language['id']."' WHERE m.status = '1' AND mod_db_tables != '' ORDER BY m.mod_type");
		
            while ($db_tables = $wt_sql->db_fetch_array($db_tables_query)) {
            
            $tables_array = array();
            $tables_array = unserialize($db_tables['mod_db_tables']);		
			  	$params = unserialize($db_tables['params']);	
			
            if(wt_not_null($params['db_prefix'])) {
					$db_prefix = $params['db_prefix'];
				} else {
					$db_prefix = DB_PREFIX;
				}
				
				if(wt_not_null($params['db_database'])) {
					$db_prefix = $params['db_database'].'.'.$db_prefix;
				} 
				
					
              $file_string .= '//[' . $db_tables['mod_key'] . ']' . "\n";
       if( wt_is_valid($tables_array, 'array') )  {    
            foreach($tables_array as $table) {
            	$file_string .= 'define("' . $table['key'] . '", "'.$db_prefix.$table['name'].'"); ' . "\n";
            }  
       }
             
                           
        }
  
  $file_string .= '?>';
  
  $db_tables_file = fopen(CFGF_DIR_FS_WORK . 'sys_db_tables.php', 'w');
  flock($db_tables_file, 2); // LOCK_EX
  fputs($db_tables_file, $file_string);
  flock($db_tables_file, 3); // LOCK_UN
  
  include(CFGF_DIR_FS_WORK . 'sys_db_tables.php');
  
  } 
  
    		
    		
    }
    
} //classs

?>