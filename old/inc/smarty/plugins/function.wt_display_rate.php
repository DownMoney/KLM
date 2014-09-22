<?php 
function smarty_function_wt_display_rate($p, &$smarty) {
	global $wt_module, $wt_template;
	$mod_comments = wt_module::singleton('mod_comments');
	
	/*
	
	przykładowe wywołanie funkcji:
	
	{wt_display_rate cm_id=$c.cm_id} - wyświetla oceny jakie zostały wystawione razem z komentarzem
	
	{wt_display_rate t="iP" i=`$item.it_id`}
	{wt_display_rate m="id_modulu" t="iP" i=`$item.it_id` rate_type="lok"} - wyświetla oceny do konkretnego wpisu (lokal, artykuł, strona)
	
	*/
	
	if( wt_is_valid($p['cm_id'], 'int', 0) ) {
		//oceny do komentarza
		$rP = array();
		$rP['where'] = " cm_id = '".(int)$p['cm_id']."' AND ";
		$rP['dsplit'] = true;
		$rP['order'] = " sort_order ";
		$rates = array();
		$rates['list'] = $mod_comments->get_rates_for_comment(null, $rP);
		$r_count = 0;
		$r_total = 0;
		if(wt_is_valid($rates['list'], 'array', 0)) {
			foreach($rates['list'] as $rate) {
				++$r_count;
				$r_total += $rate['cr_value'];
			}
			$rates['total']['rate'] = $r_total / $r_count;
			$rates['total']['rate_f'] = round($rates['total']['rate'], 1);
			$rates['total']['r_count'] = $r_count;
		}
		global $wt_template;
		$wt_template->assign('rates', $rates);
		if(!wt_not_null($p['tpl'])) {
			$p['tpl'] = 'comment_rates.tpl';
		}
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . 'mod_comments' . DIRECTORY_SEPARATOR.'sub' . DIRECTORY_SEPARATOR, '', 'mod_comments');
		$r = $smarty->fetch($p['tpl']);
		$wt_template->SetTemplateDir();
		return $r;
	} else {
		//oceny do itema
		if(!wt_not_null($p['rate_type'])) {
			return 'Błąd: Brak typu ocen [rate_type]';
		}
		global $wt_module;
		if( !isset($p['m']) ) {
			$mID = $wt_module->module_info['mod_id'];
		} else {
			$mID = $wt_module->get_module_id($p['m']);
		}
		$mod_id = $mID;
		$mod_task = $p['t'];
		$mod_task_id = $p['i'];

		$cP = array();
		$cP['where'] = '';
		if(wt_is_valid($mod_id,'int','0')) {
			$cP['where'] .= "mod_id = '".$mod_id."' AND ";
		}
		if(wt_not_null($mod_task)) {
			$cP['where'] .= "mod_task = '".$mod_task."' AND ";
		}
		if(wt_not_null($mod_task_id)) {
			$cP['where'] .= "mod_task_id = '".$mod_task_id."' AND ";
		}
		$cP['order'] = ' cm_id ';
		$cP['dsplit'] = true;
		$cP['get'] = 'cm_id';
		
		//wt_print_array($cP);
		
		$comments = $mod_comments->get_comments(null,$cP);
		unset($cP);
		
		//wt_print_array($comments);
		
		$rtP = array();
		$rtP['where'] = " crt_key = '".$p['rate_type']."' AND ";
		$rtP['limit'] = 1;
		$rtP['dsplit'] = true;
		$rtP['get_array'] = true;
		
		$rate_type = $mod_comments->get_rate_types(null, $rtP);
		
		$cf_types = array();
		
		if($rate_type['crt_type']==1) {
			if($p['show_deteils']) {
				$rtP = array();
				$rtP['where'] = " parent_id = '".(int)$rate_type['crt_id']."' AND ";
				$rtP['dsplit'] = true;
				$rtP['get'] = 'crt_id';
				$cf_types = $mod_comments->get_rate_types(null, $rtP);
				$group_results = true;
				$get_type = true;
			} else {
				$rtP = array();
				$rtP['where'] = " parent_id = '".(int)$rate_type['crt_id']."' AND ";
				$rtP['dsplit'] = true;
				$rtP['get'] = 'crt_id';
				$cf_types = $mod_comments->get_rate_types(null, $rtP);
				$get_type = false;
			}
		} else {
			$cf_types[] = $rate_type;
			$get_type = true;
		}
		
//		wt_print_array($cf_types);
		
		$rP = array();
		if(wt_is_valid($comments, 'array', 0)) {
			$rP['where'] .= " cm_id IN (";
			foreach($comments as $com) {
				$rP['where'] .= $com['cm_id'].', ';
			} 
			$rP['where'] = substr($rP['where'], 0, -2);
			$rP['where'] .= ') AND ';
		} else {
			$rP['not_finded'] = true;
		}

		if(wt_is_valid($cf_types, 'array', 0)) {
			$rP['where'] .= " crt_id IN ( ";
			$rP['order'] = "FIELD(crt_id, ";
			foreach($cf_types as $rt) {
				$rP['where'] .= $rt['crt_id'].', ';
				$rP['order'] .= $rt['crt_id'].', ';
			}
			$rP['where'] = substr($rP['where'], 0, -2);
			$rP['where'] .= ') AND ';
			$rP['order'] = substr($rP['order'], 0, -2);
			$rP['order'] .= ') ';
		} else {
			$rP['not_finded'] = true;
		}
		
		if($group_results===true) {
			$rP['group_by'] = ' crt_id ';
		}
		$rP['get_type'] = $get_type;
		if(!$rP['not_finded']===true) {
			$rate_values = $mod_comments->get_rates_value(null, $rP);
			if($get_type===false && wt_is_valid($rate_values,'array')) {
				//jeśli jest typ zlozony to musimy mieć nazwe zlozonego typu
				foreach($rate_values as $k => $v) {
					$rate_values[$rate_type['crt_key']] = $rate_values[$k];
					$rate_values[$rate_type['crt_key']]['rate_type'] = $rate_type;
					unset($rate_values[$k]);
				}
			}
		} else {
			$rate_values = array();
			if(!isset($rP['group_by'])) {
				$rate_values[$rate_type['crt_key']] = array(
					'crt_id' => $rate_type['crt_id'],
					'avg_rate' => 0,
					'avg_rate_f' => '0.0',
					'rate_type' => $rate_type,
				);
			} else {
				if(wt_is_valid($cf_types, 'array', 0)) {
					foreach($cf_types as $rt) {
						$a = $mod_comments->get_rate_types($rt['crt_id']);
						$rate_values[$a['crt_key']] = array(
							'crt_id' => $rt['crt_id'],
							'avg_rate' => 0,
							'avg_rate_f' => '0.0',
							'rate_type' => $a,
						);
					}
				}
			}
			
		}
		
//		wt_print_array($rate_values);
		
		global $wt_template;
		$wt_template->assign('rate_values', $rate_values);
		if(!wt_not_null($p['tpl'])) {
			$p['tpl'] = 'rate_values.tpl';
		}
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . 'mod_comments' . DIRECTORY_SEPARATOR.'sub' . DIRECTORY_SEPARATOR, '', 'mod_comments');
		$r = $smarty->fetch($p['tpl']);
		$wt_template->SetTemplateDir();
		return $r;
		
	}
}
?>