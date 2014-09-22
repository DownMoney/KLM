<?php 
class mod_sitemaps_manager {
	var $_default_folder_freq = 'weekly';
	var $_default_file_freq = 'weekly';
	var $_default_folder_prior = '0.5';
	var $_default_file_prior = '0.5';
	//var $sitemaps_directory = ' '. CFGF_DOCUMENT_FS_ROOT '_sitemaps' .  DIRECTORY_SEPARATOR;
	
   	function mod_sitemaps_manager() {
    	global $wt_module;
      	$this->module_dir = dirname(__FILE__);
	  		$this->module_class = get_class($this);
	  		$this->module_params = $wt_module->get_module_params($this->module_key);
  	} 
	
  		function get_module_path() {
	   		return dirname(__FILE__);
	   	}
	  
	  	function get_module_class() {
	   		return $this->module_class;
	   	} 
	         
	  	function __construct() {
	    	$class_name = __CLASS__;
	    	$this->$class_name();
	  	}

	   function _init() {
			$this->make_sitemaps();
			die();
		}
		
		function make_sitemaps() {
			global $wt_plugins;
			
			$mods = $wt_plugins->load_module_plugins('sitemaps');
			
			if( wt_is_valid($mods, 'array') ) {
				foreach($mods as $m) {
					$class_name = $m . '_sitemaps_plug';
					$instance = new $class_name;
					$instance->get_sitemaps();
					
					if( wt_is_valid($instance->sitemaps_folders, 'array') ) {
						$this->make_sitemap_file($instance, $m, 'folder');
					}
					
					if( wt_is_valid($instance->sitemaps_files, 'array') ) {
						$this->make_sitemap_file($instance, $m, 'files');
					}
				}
			}
			
			if( wt_is_valid($this->sitemap_files, 'array') ) {
				$this->make_sitemap_index($this->sitemap_files);
			}
			
			
		} 
		
		function make_sitemap_file($instance, $m, $t) {
			$items = array();
			if ($t == 'files') {
				$items = $instance->sitemaps_files;
				if (isset($instance->_file_freq)) {
					$freq = $instance->_file_freq;
				} else {
					$freq = $this->_default_file_freq;
				}
				if (isset($instance->_file_prior)) {
					$prior = $instance->_file_prior;
				} else {
					$prior = $this->_default_file_prior;
				}
			} elseif ($t == 'folder') {
				$items = $instance->sitemaps_folders;
				if (isset($instance->_folder_freq)) {
					$freq = $instance->_folder_freq;
				} else {
					$freq = $this->_default_folder_freq;
				}
				if (isset($instance->_folder_prior)) {
					$prior = $instance->_folder_prior;
				} else {
					$prior = $this->_default_folder_prior;
				}			  
			}
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
   			foreach($items as $i) {
 if( wt_not_null($i['l']) ) { 			
				if( !wt_not_null($i['m']) ) {
					$last_mod = date('Y-m-d');
				} else {
					$last_mod = date('Y-m-d', strtotime($i['m']));
				}
				
				
				
				
$xml .= '<url>' .  "\n";
$xml .= '<loc>' . $i['l'] . '</loc>' .  "\n";
$xml .= '<lastmod>' . $last_mod . '</lastmod>' .  "\n";
$xml .= '<changefreq>'.$freq.'</changefreq>' .  "\n";
$xml .= '<priority>'.$prior.'</priority>' .  "\n";
$xml .= '</url>' .  "\n";
}
	
   			}
			$xml.='</urlset> '; 
			$path = CFGF_DOCUMENT_FS_ROOT . 'sitemap_' . $m . '_' . $t . '.xml';
			$file = fopen($path,'w');
			if (fwrite($file,$xml)!= false) {
				$this->sitemap_files[] = array('l' => CFG_WS_FULL_PATH_TO_DOCUMENT_ROOT . 'sitemap_' . $m . '_' . $t . '.xml',
											'm' => date("Y-m-d"));
			}
			fclose($file);
		}
		
		function make_sitemap_index($sitemap_files) {
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
			foreach ($sitemap_files as $sf) {
				$xml.='<sitemap>
      <loc>'.htmlentities($sf['l'],ENT_QUOTES).'</loc>
      <lastmod>'.$sf['m'].'</lastmod>
   </sitemap>'."\n";
			}
   			$xml.='</sitemapindex>';
   			$path = CFGF_DOCUMENT_FS_ROOT . 'sitemap_index.xml';
			$file = fopen($path,'w');
			fwrite($file,$xml);
			fclose($file);
		}
		
		
		
  } // class
  
  
?>