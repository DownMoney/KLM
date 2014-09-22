<?php 




   class mod_main_page {
   
   function mod_main_page() {
   $this->module_dir = dirname(__FILE__);
   }
   
   
   	function __construct() {

         $class_name = __CLASS__;
    	  	$this->$class_name();

    	  	}

    	function _init() {
   
     $this->task = wt_set_task($_REQUEST, 't');
     $this->action = wt_set_task($_REQUEST, 'a');
     $this->mode = wt_set_task($_REQUEST, 'm');
     
     
     switch($this->action) {
     default: 
     $this->main_page();
     
     }
     
   
   }
   
   function main_page() {
   global $wt_template, $wt_sql, $wt_session;
    

if(wt_is_valid($_GET['install_language'],'int','0')) {
 	$mod_modules_manager = wt_module::singleton('mod_modules_manager');
	 $mod_modules_manager->update_language_tables($_GET['install_language']);
	 die('ok');
}
	 
   $wt_template->load_file('index.tpl');
        
   }
   
  
   
   }

?>