<?php

function smarty_function_wt_display_advertise($params, &$smarty)
{
    $mod_advertise = wt_module::singleton('mod_advertise');
    
  //  wt_print_array($params);
    
    return $mod_advertise->display_advertise($params['data']);
    
} 



?>
