<?php
if (!get_cfg_var('safe_mode')) {
      set_time_limit(0);
      ini_set('memory_limit', '150M');
      ini_set('session.use_trans_sid', '0');
    }

error_reporting(E_ALL ^ E_NOTICE);

function getmicrotime() {
	 $temparray=split(" ",microtime());
    $returntime=$temparray[0]+$temparray[1];
    return $returntime;
}
$sstime=getmicrotime();
define('DEVELOPERS_MODE', 'true');
define('ADMIN_DEVELOPERS_MODE', 'false');
define('DISABLE_CACHE', 'false');
define('DEBUG', 'false');
define('CFG_USE_SMARTY_CACHE', 'false');
define('CFG_USE_TEMPLATE_BLOCK_CACHE', 'false');
define('CFGDB_RUN_CORE_LOG', 'false');

include_once('inc/core.inc.php');

/*
echo '<div style="float: left; clear: both; width: 100%"  />';
echo 'zapytań' . $wt_sql->q_count;
echo '<br  />';
$etime = getmicrotime();
echo '<br>Czas wygenerowania: ' . $ftime=round($etime-$sstime,6) . ' s<br>';
echo $_SERVER['REQUEST_URI'];
echo '</div>';
*/


wt_shutdown();
function wt_shutdown() {
unset( $GLOBALS['wt_sql'], $GLOBALS['wt_language'], $GLOBALS['wt_user'], $GLOBALS['wt_navigation'], $GLOBALS['wt_plugins'], $GLOBALS['shopping_cart'], $GLOBALS['wt_template'], $GLOBALS['wt_module'], $GLOBALS['wt_block'], $GLOBALS['form_output'], $GLOBALS['wt_tax'], $GLOBALS['wt_currencies'], $GLOBALS['wt_navigationbar'], $GLOBALS['wt_session'], $GLOBALS['wt_message_stack'], $GLOBALS['wt_config'] );
}

?>
