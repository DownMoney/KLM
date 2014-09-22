<?php 
/**
* @package core
*/

 



class wt_params {
      var $_default;
      var $_array;
function wt_params( $text, $path = '', $type = '', $default_object_params = '' ) {
          
       $this->_default = $default_object_params;
       
	    $this->_params = $this->parse( $text, $type );
	    $this->_raw = $text;
	    $this->_path = $path;
	    $this->_type = $type;
	    
	}


    
   function set( $key, $value='' ) {
		$this->_params[$key] = $value;
		return $value;
	}

	 
	function def( $key, $value='' ) {
	    return $this->set( $key, $this->get( $key, $value ) );
	}

	 
	function get( $key, $default='' ) {

	if((!isset($this->_params[$key]) || !wt_not_null($this->_params[$key])) && !wt_not_null($default)) {
	       return $this->_default->_params[$key];       
	       }
	       
	    if (isset( $this->_params[$key] )) {
	        
	    
	        return $this->_params[$key] === '' ? $default : $this->_params[$key];
	       
		} else {
		    return $default;
		}
	}
	
	function get_array() {
	 return $this->_params;
	}

	 
	function parse( $txt, $type = '') {
	global $wt_template;
	
	
	
	if(wt_not_null($txt) && isset($txt)) {
	  	$temp = unserialize($txt);	
	}	else {
	   $temp = array();
	}
	
		
	   $default = array();
		$default = ($this->_default->_params) ? $this->_default->_params : array();
		
	
		
		if(wt_is_valid($default, 'array')) {
		
		foreach ($default as $def_key => $def_val) {
		
		$params[$def_key] = $def_val;
		
		if(isset($temp[$def_key]) && $temp[$def_key] != '' ) {
		$params[$def_key] = $temp[$def_key];
		}
		
		}
		if(wt_is_valid($temp, 'array')) {
		foreach( $temp as $key => $val ) {
			if( !isset($params[$key]) ) {
				$params[$key] = $val;
			}
		}
		}
		
		} else {
		$params = $temp;
		} 
		
	 //	$params = array_merge($default, $temp);
		
	  /*	
		if(is_array($temp)) {
	  foreach($temp as $param_key => $param_val) {
	  
	    $params[$param_key] = $param_val;
	   if(!wt_not_null($param_val)) {
	    $params[$param_key] = $this->_default->_params[$param_key];
	   } 
	  
	  }
		} else {
		$params = $this->_default->_params;
		}
		 */
	 // $params = array_merge($default, $temp);
		

		
	  return	$this->_params = $params;
	}

}

 
?>
