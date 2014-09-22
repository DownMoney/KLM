<?php 



   function smarty_function_count_column($params, &$smarty) {
    global $block, $module, $core_error;
        
        $column = $params['column'];
        if(is_array($block->blocks_list)) {
            if(!$column) {
                $core_error->error[] = array('file' => __FILE__, 'msg' => 'TEMPLATE::countColumn() failed, $column is empty', 'code' => 'error', 'action' => '');
                $core_error->error_count++;
                return;
            }
            
            if (array_key_exists($column, $block->blocks_list)) {
                return true;
            }
            else {
                return false;
            }
        }
  
   
   }

?>