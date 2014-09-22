<?php 
	$iSearch = wt_set_task($_GET, 'iSearch');
    $form = new form_class();
  	$form->NAME = 'searchText';
  	$form->METHOD = 'GET';
  	$form->ACTION = wt_href_link();
  	$form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
   
   	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'mod',
		'ID' => 'mod',
		'VALUE' => 'mod_languages_manager',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'm',
		'ID' => 'm',
		'VALUE' => 'texts',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 't',
		'ID' => 't',
		'VALUE' => 'searchText',
	));
  	global $wt_module;
		
  	$modules_for_form = array();
  	if (wt_is_valid($wt_module->installed_modules_local,'array')) {
  		foreach ($wt_module->installed_modules_local as $mod_key) {
  			$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
  		}
  	}
  	
  	if (wt_is_valid($wt_module->installed_modules_manager,'array') && wt_is_root()) {
  		foreach ($wt_module->installed_modules_manager as $mod_key) {
  			$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
  		}
  	}
  	
  	
  	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[mod_id]',
		'ID' => 'mod_id',
		'OPTIONS' => array('' => 'dowolny','-1' => 'globalne') + $modules_for_form,
		'VALUE' => $iSearch['mod_id'],
		'SELECTED' => $iSearch['mod_id'],
		'LABEL' => 'Moduł',
		'STYLE' => 'width: 100%;'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[txt_value]',
		'ID' => 'txt_value',
		'VALUE' => $iSearch['txt_value'],
		'LABEL' => 'Tekst',
		'CLASS' => 'text_area3'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[txt_key]',
		'ID' => 'txt_key',
		'VALUE' => $iSearch['txt_key'],
		'LABEL' => 'Klucz',
	));
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'szukaj',
	));
	
	$wt_template->assign_by_ref('iSearch', $iSearch);
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('searchText_form.tpl');
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('searchText_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
?>