<?php 
/**
* @package core
*/



function wt_include_lib($path = CFGF_DIR_FS_LIBRARY) {
    
    if(substr($path, -1) == DIRECTORY_SEPARATOR) {
    $read_dir = substr($path, 0, -1);
    $include_dir = $path;
    } else {
    $read_dir = $path;
    $include_dir = $path . DIRECTORY_SEPARATOR;
    }

   $handle = dir($read_dir);
   while ($file = $handle->read()) {
        if (preg_match("/\.(lib).(php)$/i",$file)) {
            $include_folder_pos =  strpos($file, '.lib.php');
            $include_folder = $path . substr($file, 0, $include_folder_pos);
         
         include_once($include_dir . $file);
        
         if(is_dir($include_folder)) {
         wt_include_lib($include_folder);
         }  // if
            
        } // if
        
        
      } // while
} // function


function if_is_lib($lib) {

   $path = CFGF_DIR_FS_LIBRARY;

    if(substr($path, -1) == DIRECTORY_SEPARATOR) {
    $read_dir = substr($path, 0, -1);
    $include_dir = $path;
    } else {
    $read_dir = $path;
    $include_dir = $path . DIRECTORY_SEPARATOR;
    }
    
    $handle = dir($read_dir);

    while ($file = $handle->read()) {
        if (preg_match("/\.(lib).(php)$/i", $file)) {
            $is_file_pos =  strpos($file, '.lib.php');
            $is_file = $path . substr($file, 0, $include_folder_pos);
         
         if($lib == $is_file) {
         return true;
         }         
        } // if      
      } // while
  
}

wt_include_lib();

?>