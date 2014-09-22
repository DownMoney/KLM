<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty string_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     string_format<br>
 * Purpose:  format strings via sprintf
 * @link http://smarty.php.net/manual/en/language.modifier.string.format.php
 *          string_format (Smarty online manual)
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_wt_base64($string, $ac)
{
	switch($ac) {
		case 'encode':
			return base64_encode($string);
		break;
		case 'decode':
			return base64_decode($string);
		break;
	}
}

/* vim: set expandtab: */

?>
