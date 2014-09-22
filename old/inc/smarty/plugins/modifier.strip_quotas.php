<?php

function smarty_modifier_strip_quotas($text)
{
 $search = array('"', "'", '\\');
 $replace = array('','','');

    return str_replace($search, $replace, $text);
}

/* vim: set expandtab: */

?>
