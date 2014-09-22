<?php

require_once $smarty->_get_plugin_filepath('shared','make_timestamp');

function smarty_modifier_wt_date($string, $format="b e, Y", $default_date=null)
{	 
    if($string != '') {
        return date($format, smarty_make_timestamp($string));
    } elseif (isset($default_date) && $default_date != '') {
        return date($format, smarty_make_timestamp($default_date));
    } else {
        return;
    }
}

/* vim: set expandtab: */

?>