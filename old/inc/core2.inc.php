<?php
/**
* @package core
*/
define('CFGF_DOCUMENT_FS_ROOT', substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), 'inc')));
define('CFGF_DIR_FS_INCLUDES',  CFGF_DOCUMENT_FS_ROOT . 'inc' . DIRECTORY_SEPARATOR);
function getmicrotime()
{    $temparray=split(" ",microtime());
    $returntime=$temparray[0]+$temparray[1];
    return $returntime;
}

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
define('DEVELOPERS_MODE', 'true');
define('ADMIN_DEVELOPERS_MODE', 'true');


include_once(CFGF_DIR_FS_INCLUDES.'core_log.inc.php');
$wt_core_log = new wt_core_log();
include_once(CFGF_DIR_FS_INCLUDES.'compatybility.php');

include_once(CFGF_DIR_FS_INCLUDES.'paths_info.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'cache.inc.php');

include_once(CFGF_DIR_FS_INCLUDES.'db_tables_name.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'general_func.inc.php');

include_once(CFGF_DIR_FS_INCLUDES.'drivers/db/my_sql.drv.php');
$wt_sql = new wt_sql(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, NULL, DB_USE_SILENT_MODE_CONNECT, USE_PCONNECT);


include_once(CFGF_DIR_FS_INCLUDES.'language.inc.php');
$wt_language = new wt_language();

include_once(CFGF_DIR_FS_INCLUDES.'params.inc.php');

if(isset($_GET['CT']) && $_GET['CT'] == '1') {
  wt_rm_thumbs();
 }

include_once(CFGF_DIR_FS_INCLUDES.'lib.inc.php');
include_once(CFGF_DIR_FS_INCLUDES.'split_page_results.inc.php');
//include_once('inc/html_func.inc.php');
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


include_once(CFGF_DIR_FS_INCLUDES.'user.inc.php');
$wt_user = new wt_user();
$wt_plugins->action_after_user();


$wt_navigationbar = new wt_breadcrumb();

include_once(CFGF_DIR_FS_INCLUDES.'set_params.inc.php');

include_once(CFGF_DIR_FS_INCLUDES.'block.inc.php');
$wt_block = new wt_block();
$wt_plugins->action_after_block();
include_once(CFGF_DIR_FS_INCLUDES.'menu.inc.php');


$wt_template->get_template_variable();

$wt_language->wt_load_languages();

$wt_plugins->action_before_load();
?>
