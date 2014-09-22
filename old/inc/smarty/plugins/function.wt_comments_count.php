<?php 
function smarty_function_wt_comments_count($p, &$smarty) {
global $wt_module;
$mod_comments = wt_module::singleton('mod_comments');
if( !isset($p['m']) ) {
$mID = $wt_module->module_info['mod_id'];
} else {
$mID = $wt_module->get_module_id($p['m']);
}
echo $mod_comments->count_comments_to_item($mID, $p['t'], $p['i']);
}
?>