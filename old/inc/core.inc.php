<?php
/**
* @package core
*/
define('CFGF_DOCUMENT_FS_ROOT', substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), 'inc')));
error_reporting(E_ALL ^ E_NOTICE);

define('DEFAULT_LANGUAGE', 'pl');
define('DEFAULT_CURRENCY', 'PLN');
define('CFG_USE_SMARTY_CACHE', 'false');
define('CFG_USE_TEMPLATE_BLOCK_CACHE', 'false');
define('MAX_DISPLAY_SEARCH_RESULTS', '20');
define('MAX_ADMIN_DISPLAY_SEARCH_RESULTS', '50');
define('MAX_DISPLAY_ADMIN_SEARCH_RESULTS', '50');
define('NUMERIC_DECIMAL_SEPARATOR', '.');
define('NUMERIC_THOUSANDS_SEPARATOR', ',');
define('ADMIN_HTML_EDITOR', 'fckeditor');




include_once(dirname(__FILE__).'/core_log.inc.php');
$wt_core_log = new wt_core_log();




include_once(dirname(__FILE__).'/compatybility.php');

include_once(dirname(__FILE__).'/paths_info.inc.php');
if(strpos($_SERVER['HTTP_HOST'], str_replace('http://', '', CFGF_HTTP_SERVER)) === false) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:".CFGF_HTTP_SERVER.$_SERVER['REQUEST_URI']);
	header("Connection: close");
	exit();
}
include_once(CFGF_DIR_FS_INCLUDES.'cache.inc.php');

include_once(CFGF_DIR_FS_INCLUDES.'db_tables_name.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'general_func.inc.php');

if(isset($_GET['CLEAR_CACHE']) && wt_not_null($_GET['CLEAR_CACHE'])) {
		$clear_cache = new wt_cache();
      $clear_cache->clear(array($_GET['CLEAR_CACHE']));
 		$clear_cache->clear($_GET['CLEAR_CACHE']);
		unset($clear_cache);
		die('wyczyszczono: '.$_GET['CLEAR_CACHE']);
}

include_once(CFGF_DIR_FS_INCLUDES.'drivers/db/my_sql.drv.php');
$wt_sql = new wt_sql(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, NULL, DB_USE_SILENT_MODE_CONNECT, USE_PCONNECT, 'utf8');



include_once(CFGF_DIR_FS_INCLUDES.'language.inc.php');
$wt_language = new wt_language();
include_once(CFGF_DIR_FS_INCLUDES.'params.inc.php');
if(isset($_GET['CT']) && $_GET['CT'] == '1') {
  wt_rm_thumbs();
 }

include_once(CFGF_DIR_FS_INCLUDES.'lib.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'split_page_results.inc.php');
//include_once(CFGF_DIR_FS_INCLUDES.'html_func.inc.php');
//include_once(DIR_WS_LIBRARY . 'html.lib.php');


include_once(CFGF_DIR_FS_INCLUDES.'config.inc.php');
$wt_config = new wt_config();
$wt_config->load_db_table_definition();


include_once(CFGF_DIR_FS_INCLUDES.'navigation_history.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'message_stack.inc.php');
$wt_message_stack = new wt_message_stack();



include_once(CFGF_DIR_FS_INCLUDES.'plugins.inc.php');
$wt_plugins = new wt_plugins;
$wt_plugins->start_plugins();

include_once(CFGF_DIR_FS_INCLUDES.'template.inc.php');



$wt_template = new wt_template();

include_once(CFGF_DIR_FS_INCLUDES.'module.inc.php');
$wt_module = new wt_module();
$wt_plugins->action_after_module();

include_once(CFGF_DIR_FS_INCLUDES.'module_plugins.inc.php');
$wt_module_plugins = new wt_module_plugins();


include_once(CFGF_DIR_FS_INCLUDES.'user.inc.php');
$wt_user = new wt_user();



$wt_plugins->action_after_user();


$wt_module->_construct();

include_once(CFGF_DIR_FS_INCLUDES.'set_params.inc.php');

include_once(CFGF_DIR_FS_INCLUDES.'block.inc.php');
$wt_block = new wt_block();
$wt_plugins->action_after_block();
include_once(CFGF_DIR_FS_INCLUDES.'menu.inc.php');


$wt_template->get_template_variable();

$wt_language->wt_load_languages();

$wt_navigationbar = new wt_breadcrumb();

if($wt_module->module_info['mod_type'] == 'local') {
$wt_navigationbar->add(TEXT_BREADCRUMP_START, wt_href_link('home'));
} else if($wt_module->module_info['mod_type'] == 'manager') {
$wt_navigationbar->add('Administracja', wt_href_link('mod_admin_manager'));
}



$wt_plugins->action_before_load();


//wt_print_array($wt_plugins);

$wt_template->load();

$wt_plugins->stop_plugins();

$wt_sql->db_close();
?>
