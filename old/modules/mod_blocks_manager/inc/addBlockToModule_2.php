<?php 

  $selected_attributes = array();
  $selected_options = array();
  $selected_fields = array();
  $language_id = wt_set_task($_REQUEST, 'language_id', $wt_session->value('languages_id'));	
  $wt_template->assign('language_id',$language_id);
	
if( (wt_not_null($btmID) && $btmID > 0) ) {

 	$action = 'edit';
 
  $db_block = $this->get_blocks_to_modules($btmID);
  
  $db_block['access'] = wt_parse_access($db_block['access']);
  
  $db_main_block = $this->get_blocks($db_block['btm_block_id']);
  
  $wt_template->assign('block_data', $db_block);

} else {
   $action = 'add';
   $db_block['status'] = 1;   
   $db_main_block = $this->get_blocks($block_id);
}  
   
   $wt_template->assign('main_block_data', $db_main_block);

	
	

  $wt_template->assign('action', $action);
  $db_block_params = new wt_params($db_block['params']);
  
  
  
  $form = new form_class();
  $form->NAME = 'addBlockToModule';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link();
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->ONSUBMIT = "select_all( _gebi('btm_view') );";
  //$form->debug = 'error';
  	
  	
  	$parameters = new wt_set_params($db_main_block['block_key'], $db_main_block['block_file'], $db_block_params, false, 'block');
  
 
	
  $parameters->set_form($form); 
  
  $parameters->set_template();
  
  $wt_template->assign('params', $parameters->params_array);
   
  $mod_modules_manager = wt_module::singleton('mod_modules_manager');	
  
  $Mparams = array();
  $Mparams['type'] = 'local';
  $Mparams['add_blank'] = true;
  $Mparams['blank_value'] = '0';
  $Mparams['blank_text'] = 'Wszystkich modułach';
  
  	
  $form->AddInput(array(	
		'TYPE' => 'select',
		'NAME' => 'btm_module_id',
		'ID' => 'btm_module_id',
		'LABEL' => 'Widoczny w modułach',
		'OPTIONS' => $mod_modules_manager->get_modules_for_form($Mparams),
		'CLASS' => 'text_area4',
		'ONCHANGE' => 'updateView();',
	));
	
  	unset($mod_modules_manager);	
	
  $Cparams = array();	
  $Cparams['add_blank'] = true;	
  $Cparams['blank_text'] = '=== WYBIERZ ===';
  

 	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'btm_column',
		'ID' => 'btm_column',
		'LABEL' => 'Kolumna',
		'OPTIONS' => $this->get_columns_for_form($Cparams),
		'VALUE' => $db_block['btm_column'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać kolumnę',
		'CLASS' => 'text_area4',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'text',
		'NAME' => 'sort_order',
		'ID' => 'sort_order',
		'LABEL' => 'Sortowanie',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_block['sort_order']
	));
 
 	
  $form->AddInput(array(	
		'TYPE' => 'text',
		'NAME' => 'btm_mod_mode',
		'ID' => 'btm_mod_mode',
		'LABEL' => 'Sekcja',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_block['btm_mod_mode']
	));
	
  $form->AddInput(array(		
		'TYPE' => 'select',
		'NAME' => 'btm_mod_task',
		'ID' => 'btm_mod_task',
		'LABEL' => 'Widok',
	 	'CLASS' => 'text_area2',
		'OPTIONS' => array(),
		'MULTIPLE' => 1,
		'SIZE' => 9,
		'STYLE' => 'width: 100%', 
	));
	
	$form->AddInput(array(		
		'TYPE' => 'select',
		'NAME' => 'btm_mod_option_id',
		'ID' => 'btm_mod_option_id',
		'LABEL' => 'Element (nazwa=ID)',
	 	'CLASS' => 'text_area2',
		'OPTIONS' => array(),
		'MULTIPLE' => 1,
		'SIZE' => 9,
		'STYLE' => 'width: 100%',
	));
	

	
	$wt_template->assign('btm_view', $this->parse_structure_for_form($db_block['btm_view']) );
	
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'btm_mod_task_add',
		'VALUE' => '+',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addTask();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'btm_view_del',
		'VALUE' => '-',
		'CLASS' => 'button_call',
		'ONCLICK' => 'delView();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'btm_mod_option_id_add',
		'VALUE' => '+',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addOptions();',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'btm_mod_option_id_add_wchildren',
		'VALUE' => '[!]',
		'CLASS' => 'button_call',
		'ONCLICK' => 'addOptions(true);',
	));
	
	$form->AddInput(array(		
		'TYPE' => 'text',
		'NAME' => 'btm_mod_task_dont',
		'ID' => 'btm_mod_task_dont',
		'LABEL' => 'z wyjątkiem widoku',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_block['btm_mod_task_dont']
	));
	
	$form->AddInput(array(		
		'TYPE' => 'text',
		'NAME' => 'btm_mod_option_id_dont',
		'ID' => 'btm_mod_option_id_dont',
		'LABEL' => 'z wyjątkiem elementu (nazwa=ID)',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_block['btm_mod_option_id_dont']
	));
	
	

	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'btm_theme',
		'ID' => 'btm_theme',
		'LABEL' => 'Plik wyświetlania',
		'OPTIONS' => $this->get_theme_files_for_blocks($db_main_block['block_key'], $db_main_block['block_file']),
		'VALUE' => $db_block['btm_theme'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'btm_view_manual',
		'ID' => 'btm_view_manual',
		'LABEL' => 'Ręczne wprowadznie',
		'VALUE' => $db_block['btm_view_manual'],
		'COLS' => 40,
		'ROWS' => 5,
		'CLASS' => 't3'
	));
	
	
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'bd_title',
		'ID' => 'bd_title',
		'MAXLENGTH' => 255,
		'LABEL' => 'Tytuł',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_block['bd_title']
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'access',
		'ID' => 'access',
		'VALUE' => '0',
		'SIZE' => 10,
		'SELECTED' => $db_block['access'],
	   'OPTIONS' => wt_prepare_user_group_array_to_form(),
		'MULTIPLE' => '1',
		'LABEL' => 'Dostęp',
	));
  	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveBlockToModule',
	));
	
  if($action == 'edit') {
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'btm_id',
		'ID' => 'btm_id',
		'VALUE' => $btmID,
	));
 }
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'block_id',
		'ID' => 'block_id',
		'VALUE' => $db_main_block['block_id'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Zapisz &raquo;',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'reset_button',
		'VALUE' => 'Wyczyść',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '[X] Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'window.close();',
	));
	
 if( $action == 'add' ) {	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'prev_button',
		'VALUE' => '&laquo; Wstecz',
		'CLASS' => 'button',
		'ONCLICK' => 'document.location.href=(\'' . wt_href_link('mod_blocks_manager', '', 't=addBlockToModule') . '\');',
	));
	
	}

  $form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_save',
		'ID' => 'action_save',
		'VALUE' => 'save',
		'LABEL' => 'Zapisz',
		'CHECKED' => 1
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_main',
		'VALUE' => 'main',
		'LABEL' => 'Powrót do listy',
		'CHECKED' => 1
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_add_new',
		'VALUE' => 'add_new',
		'LABEL' => 'Dodaj nowy blok',
		'CHECKED' => 0
	));
		
 if( $wt_language->languages_count > 1 ) {
	foreach($wt_language->catalog_languages as $l) {
		$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'languages_status['.$l['id'].']',
			'ID' => 'languages_status_'.$l['id'],
			'LABEL' => $l['code'],
			'VALUE' => '1',
			'CHECKED' => ($action == 'add') ? true : $db_block['languages_status'][$l['id']],
		));
	}
}

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'language_id',
		'VALUE' => $language_id
	));


	if($action == "edit") {
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_save',
		'ID' => 'action_save_as_new',
		'VALUE' => 'save_as_new',
		'LABEL' => 'Dodanie jako nowego bloku',
		'CHECKED' => 0
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_edit',
		'VALUE' => 'edit',
		'LABEL' => 'Powrót edycji tego bloku',
		'CHECKED' => 0
	));
	
	}
	   
	
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addBlockToModule_2_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('addBlockToModule_2_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       
?>