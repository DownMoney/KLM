<?php 
		class mod_main_page_structure_plug {
			var $structure = array();	
			var $mod_structure = array();	
			
				function mod_main_page_structure_plug() {
				
				
			 if( !wt_is_valid($this->mod_structure, 'array') ) {
$this->mod_structure[] = array('key' => 'all',
										 'name' => 'cały moduł');
			 
			 }
			 
			 
					
				}
			
	  
				
		}
?>