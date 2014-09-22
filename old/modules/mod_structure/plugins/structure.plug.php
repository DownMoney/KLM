<?php 
		class mod_structure_structure_plug {
			var $structure;	
			var $mod_structure;	
			
				function mod_structure_structure_plug() {
				
				
				if( !wt_is_valid($this->structure, 'array') ) {
				
				$mod_structure = wt_module::singleton('mod_structure');
			$iP = array();	
			$iP['get_path'] = true;
			$iP['path_all'] = true;
			$iP['admin_call'] = true;
			$iP['no_cache'] = true;
			$iP['where'] = " sit.itt_nochildren = '0' AND ";
			$structure_array = $mod_structure->get_items_tree(0,$iP);
								
				foreach( $structure_array as $s ) {
				
				$url = 't=iP&cPath='.$s['cPath'];
				krsort($s['path']);
$this->structure[] = array('name' => '' . $s['name_formated'],
										 'status' => $s['status'],
										 'access' => $s['access'],
										 'sort_order' => $s['sort_order'],
										 'mod' => 'mod_structure',
										 'url' => $url,
										 'url_full' => wt_href_link('mod_structure', null, $url, null, 'NONSSL', false),
										 'key' => 'cPath',
										 'val' => $s['cPath'], 
										 'path' => implode(' &laquo; ',$s['path']) );	
										 
				}	
				
			 }		
			 
			 
			 if( !wt_is_valid($this->mod_structure, 'array') ) {
$this->mod_structure[] = array('key' => 'all',
										 'name' => 'cały moduł');
$this->mod_structure[] = array('key' => 'mP',
										 'name' => 'strona główna modułu');
$this->mod_structure[] = array('key' => 'iP',
										 'name' => 'strona wpisu');
			 
			 }
	}
				
}
?>