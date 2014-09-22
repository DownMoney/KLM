<?php 
/**
* @package core
*/




  class wt_set_params {
    var $params_array = array();
    var $params_form_fields;
    var $setet_params;
    
   function wt_set_params($mod = '', $section = '', $setet = '', $load_globals = false, $type = 'module') {
    global $wt_module;

	 
	 $parameters = array();
	 
if($type == 'module') {
   
   if(is_object($setet)) {
   $this->setet_params = $setet;
   }
   
   if(!wt_not_null($mod)) {
   $mod = $wt_module->module_info['mod_key'];
   }
   
   $mod_dir = CFGF_DIR_FS_MODULES . $mod;
   
   if(is_array($section) && wt_not_null($section)) {
   
   foreach($section as $sec) {
   
   if(file_exists($mod_dir . DIRECTORY_SEPARATOR . 'params' . DIRECTORY_SEPARATOR . $sec . '.params.php')) {
   include_once($mod_dir . DIRECTORY_SEPARATOR . 'params' . DIRECTORY_SEPARATOR . $sec . '.params.php');
   }
   
   
   }
   } else {
   if(is_dir($mod_dir . DIRECTORY_SEPARATOR . 'params')) {
   
   $dir = dir($mod_dir . DIRECTORY_SEPARATOR . 'params');
   
  while ($file = $dir->read()) {
    if (preg_match("/\.(params.php)$/i", $file)) {
    
    
   include_once($mod_dir . DIRECTORY_SEPARATOR . 'params' . DIRECTORY_SEPARATOR . $file);
        
            }
   
   }
   
   }
   
   }
   
   if($load_globals) {
   
   if(is_dir(CFGF_DIR_FS_MODULES . 'global_params')) {
   
   $dir = dir(CFGF_DIR_FS_MODULES . 'global_params');
   
  while ($file = $dir->read()) {
    if (preg_match("/\.(params.php)$/i", $file)) {
    
    
   include_once(CFGF_DIR_FS_MODULES . 'global_params' . DIRECTORY_SEPARATOR . $file);
        
            }
   
   }
   
   }
   
   }
   
  
   
   $this->params_array = $parameters;
 
 } else if($type == 'block') {
 
 
  if(wt_not_null($setet)) {
   $this->setet_params = $setet;
   }
   
   
   $block_dir = CFGF_DIR_FS_BLOCKS . $mod;
   
   
   if(is_dir($block_dir . DIRECTORY_SEPARATOR . 'params')) {
   
    if(file_exists($block_dir . DIRECTORY_SEPARATOR . 'params' .DIRECTORY_SEPARATOR . $section . '.params.php')) {
    
    
   include_once($block_dir . DIRECTORY_SEPARATOR . 'params' .DIRECTORY_SEPARATOR . $section . '.params.php');
        
      }    
   
   
   
   }
   
  
   
   
   $this->params_array = $parameters;
 
 
 }
 
 
   
   } // wt_load_params
   
   
 
  
  function parse_form_fields($prefix) {
    global $wt_template;
    
    if(is_array($this->params_array)) {
    
     foreach($this->params_array as $group_id => $groups) {
     
       foreach($groups['params'] as $params_name => $params_data) {
       
       if($params_data['type'] == 'separator') {
       continue;
       }
       
       if($params_data['special'] == 'theme') {
        $wt_template->assign($params_name . '_value', $this->setet_params->get($params_name));
       
       }
      
       
$params_data['form_fields']['ID'] = $prefix.'_' . $params_name;
$params_data['form_fields']['NAME'] = $prefix.'[' . $params_name . ']';
if(($params_data['form_fields']['TYPE'] == 'text' || $params_data['form_fields']['TYPE'] == 'select' || $params_data['form_fields']['TYPE'] == 'textarea') && !isset($params_data['form_fields']['CLASS'])) {
//$params_data['form_fields']['CLASS'] = 't4';
}



if($this->setet_params->_params[$params_name] || $this->setet_params->_params[$params_name] == '0') {

$params_data['form_fields']['VALUE'] = $this->setet_params->_params[$params_name];

}

if($params_data['form_fields']['TYPE'] == 'select' && $params_data['form_fields']['MULTIPLE'] == 1) {
$params_data['form_fields']['SELECTED'] = $this->setet_params->_params[$params_name];
}

if(($params_data['form_fields']['TYPE'] == 'checkbox' || $params_data['form_fields']['TYPE'] == 'radio') && isset($this->setet_params->_params[$params_name]) && wt_not_null($this->setet_params->_params[$params_name]) ) {
$params_data['form_fields']['CHECKED'] = true;
}
         $this->params_form_fields[] = $params_data['form_fields'];       
       }
     }
  }
}
  
  function set_form(&$form, $prefix = 'params') {
    global $wt_template;
  
  $this->parse_form_fields($prefix);
 
 if(is_array($this->params_form_fields)) {
  	foreach($this->params_form_fields as $form_fields) {
	  	$form->AddInput($form_fields);
	}
 }
 	
 
  }
  
  function set_template() {
  
  
  }
   
  

  
  
  
  } // class
?>