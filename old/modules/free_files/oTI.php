<?php 
error_reporting(E_ALL ^ E_NOTICE);

if(substr(PHP_OS, 0, 3) == 'WIN') {
	define('INI_SET_PATH_SEPARATOR', ';');
} else {
	define('INI_SET_PATH_SEPARATOR', ':');
}

ini_set('include_path', get_include_path() . INI_SET_PATH_SEPARATOR . '../' . INI_SET_PATH_SEPARATOR . '../../' . INI_SET_PATH_SEPARATOR . '../../../');
include('inc/core2.inc.php');

require_once $wt_template->_get_plugin_filepath('function','wt_thumb_image');

$Tparams = $_GET;
$Tparams['array_return'] = true;
$params = smarty_function_wt_thumb_image($Tparams, $wt_template);

include(CFGF_DIR_FS_MODULES . 'free_files' . DIRECTORY_SEPARATOR . 'thumbImage.php');

?>