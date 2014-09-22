<?php
  $Mparams = array();
  $Mparams['type'] = 'local';
  $Mparams['add_blank'] = true;
  $Mparams['blank_value'] = '0';
  $Mparams['blank_text'] = '--- wszędzie ---';
$form->AddInput(array(	
		'TYPE' => 'select',
		'NAME' => 'showon_module_id',
		'ID' => 'showon_module_id',
		'LABEL' => 'Część serwisu',
		'OPTIONS' => $mod_modules_manager->get_modules_for_form($Mparams),
		'ONCHANGE' => 'updateView();',
	));

$form->AddInput(array(	
		'TYPE' => 'text',
		'NAME' => 'showon_mod_mode',
		'ID' => 'showon_mod_mode',
		'LABEL' => 'Sekcja',
		'VALUE' => $item['btm_mod_mode']
	));
	
  $form->AddInput(array(		
		'TYPE' => 'select',
		'NAME' => 'showon_mod_task',
		'ID' => 'showon_mod_task',
		'LABEL' => 'Widok',
		'OPTIONS' => array(),
		'MULTIPLE' => 1,
		'SIZE' => 5,
		'STYLE' => 'width: 100%', 
	));
	
	$form->AddInput(array(		
		'TYPE' => 'select',
		'NAME' => 'showon_mod_option_id',
		'ID' => 'showon_mod_option_id',
		'LABEL' => 'Element (nazwa=ID)',
		'OPTIONS' => array(),
		'MULTIPLE' => 1,
		'SIZE' => 15,
		'STYLE' => 'width: 100%',
	));
	
	$wt_template->assign('showon', $mod_modules_manager->parse_showon_data_for_form($item['showon']) );
  //	wt_print_array($mod_modules_manager->parse_showon_data_for_form($item['showon']));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'showon_mod_task_add',
		'VALUE' => '&raquo;',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addTask();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'showon_view_del',
		'VALUE' => '&laquo;',
		'CLASS' => 'button_call',
		'ONCLICK' => 'delView();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'showon_mod_option_id_add',
		'VALUE' => '&raquo;',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addOptions();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'showon_mod_option_id_add_wchildren',
		'VALUE' => '&raquo; !=',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addOptions(true);',
	));
	
?>