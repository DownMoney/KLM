<?php

function smarty_modifier_wt_count($a)
{	 
   if( wt_is_valid($a, 'array') ) {
        return count($a);
    }
}
?>