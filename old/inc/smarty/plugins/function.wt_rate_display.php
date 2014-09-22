<?php 
function smarty_function_wt_rate_display($p, &$smarty) {
global $wt_module, $wt_template;
$mod_rates = wt_module::singleton('mod_rates');

if(!isset($p['m'])) {
$mID = $wt_module->module_info['mod_id'];
} else {
$mID = $wt_module->get_module_id($p['m']);
}

if(!isset($p['tpl'])) {
$p['tpl'] = 'rate.tpl';
}
	
$wt_template->assign('rates', $a = $mod_rates->get_rates_for_item($mID, $p['t'], $p['i']));

if(isset($p['rate_form'])) {
	$wt_template->assign('rates_mod_key', $mID);
	$wt_template->assign('rates_mod_task', $p['t']);
	$wt_template->assign('rates_mod_task_id', $p['i']);
	$wt_template->assign('was_rating', $mod_rates->check_vote($mID, $p['t'], $p['i']));
}

	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . 'mod_rates' . DIRECTORY_SEPARATOR.'sub' . DIRECTORY_SEPARATOR, '', 'mod_rates');	
	$r = $smarty->fetch($p['tpl']);
	$wt_template->SetTemplateDir();	
	
	return $r;
}
?>