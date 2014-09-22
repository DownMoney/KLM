<?php 
function smarty_function_wt_comments_list($p, &$smarty) {
global $wt_module, $wt_template;
//wt_print_array($p);
$mod_comments = wt_module::singleton('mod_comments');
if( !isset($p['m']) ) {
$mID = $wt_module->module_info['mod_id'];
} else {
$mID = $wt_module->get_module_id($p['m']);
}

if(!isset($p['tpl'])) {
$p['tpl'] = 'comments_list.tpl';
}

		$cP = array();
		$cP['mod_key'] = $mID;
		$cP['mod_task'] = $p['t'];
		$cP['mod_task_id'] = $p['i'];
		if(wt_not_null($p['redirect_url'])) {
			$cP['redirect_url'] = $p['redirect_url'];
	  	} else {
			$cP['redirect_url'] = wt_href_link('', '', wt_get_all_get_params(), '', 'NONSSL', false, false);
		}
		
		if(isset( $p['rate_type'] )) {
			$cP['rate_type'] = $p['rate_type'];
			if(isset( $p['comment_not_required'] )) {
		 		$cP['comment_not_required'] = $p['comment_not_required'];
			} else {
				if(isset( $p['rate_not_required'] )) {
					$cP['rate_not_required'] = $p['rate_not_required'];
				}
			}
		}
		$mod_comments->addComment($cP);	
		$clP = $p;
		unset($clP['t'],$clP['i'],$clP['tpl']);
		
		if( ! ( wt_not_null($clP['split']) || wt_not_null($clP['dsplit'] ) ) ) {
			$clP['dsplit'] = true;
		}
			
		$wt_template->assign('comments_list', $mod_comments->get_comments_to_item($mID, $p['t'],$p['i'],$clP));
		
		
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . 'mod_comments' . DIRECTORY_SEPARATOR.'sub'.DIRECTORY_SEPARATOR, '', 'mod_comments');	
	$r = $smarty->fetch($p['tpl']);
	$wt_template->SetTemplateDir();		
	return $r;
}
?>