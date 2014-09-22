<?php 

  $mID = wt_set_task($_REQUEST, 'mID');

    $ed_mod = $this->get_installed_modules($mID);
    
    $ed_mod['access'] = wt_parse_access($ed_mod['access']);
    $wt_template->assign('mID', $mID);
    $wt_template->assign('mod_name', $ed_mod['mod_name']);
    $wt_template->assign('md_title', $ed_mod['md_title']);
    
 $db_module_params = new wt_params($ed_mod['params']);
  
  
  function error($err) {
  echo $err . '<br>';
  }

$form = new form_class();
  
  $form->NAME = 'editModule';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'mID', 't')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
 // $form->encoding = 'ISO-8859-2';
  $form->debug = 'error';
  
  
  if($ed_mod['mod_type'] == 'manager') {
  
  $mod_key = $ed_mod['mod_key'];
  
  } else {
  
  if(is_dir(CFGF_DIR_FS_MODULES . $ed_mod['mod_key'] . DIRECTORY_SEPARATOR . 'params')) {
  $mod_key = $ed_mod['mod_key'];
  } else {
  $mod_key = $ed_mod['mod_key'] . '_manager';
  }
  
  }
  
 
  
  $parameters = new wt_set_params($mod_key, '', $db_module_params, true);
  
  
  $parameters->set_form($form);
  
  $parameters->set_template();
  
  $wt_template->assign('params', $parameters->params_array);
  
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Aktywny: ',
		'ACCESSKEY' => 'P',
		'CHECKED' => $ed_mod['status'],
		'VALUE' => '1'
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'mod_home',
		'ID' => 'mod_home',
		'LABEL' => 'Strona główna: ',
		'ACCESSKEY' => 'P',
		'CHECKED' => $ed_mod['mod_home'],
		'VALUE' => '1'
	));
	
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'mod_title',
		'ID' => 'mod_title',
		'MAXLENGTH' => 255,
		'LABEL' => 'Nazwa nadana',
		'ACCESSKEY' => 'T',
	 	'CLASS' => 'text_area2',
		'VALUE' => $ed_mod['mod_title']
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'meta_keys',
		'ID' => 'meta_keys',
		'LABEL' => 'Słowa kluczowe',
		'ACCESSKEY' => 'S',
		'ROWS' => 5,
		'COLS' => 50,
		'CLASS' => 'text_area3',
		'VALUE' => $ed_mod['meta_keys']
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'meta_desc',
		'ID' => 'meta_desc',
		'LABEL' => 'Opis',
		'ACCESSKEY' => 'O',
		'ROWS' => 5,
		'COLS' => 50,
		'CLASS' => 'text_area3',
		'VALUE' => $ed_mod['meta_desc']
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'access',
		'ID' => 'access',
		'VALUE' => '0',
		'SIZE' => 10,
		'SELECTED' => $ed_mod['access'],
	   'OPTIONS' => wt_prepare_user_group_array_to_form(),
		'MULTIPLE' => '1',
		'LABEL' => 'Dostęp',
		'CLASS' => 'text_area2',
		'ACCESSKEY' => 'D'
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'theme',
		'ID' => 'theme',
	 	'VALUE' => $ed_mod['theme'],
	   'OPTIONS' => $this->parse_theme_list_for_form($ed_mod['mod_key']),
		'LABEL' => 'Szablon',
		'CLASS' => 'text_area2',
		'ACCESSKEY' => 'D'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveModule'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'mID',
		'ID' => 'mID',
		'VALUE' => $mID
	));
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Zapisz >>',
		'ACCESSKEY' => 'D',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'reset_button',
		'VALUE' => 'Wyczyść',
		'ACCESSKEY' => 'W',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '<< Anuluj',
		'ACCESSKEY' => 'W',
		'CLASS' => 'button',
		'ONCLICK' => 'document.location.href=(\'' . wt_href_link('') . '\');',
	));

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'doit',
		'VALUE' => 1
	)); 



	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('editModule_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		
		 $wt_template->assign('onload', $onload);
       $wt_template->assign('error_message', $error_message);
		 $wt_template->assign_by_ref('verify', $verify);
	    $wt_template->assign('doit', $doit);
  
  $wt_template->assign('form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       

  
      
$wt_template->load_file('editModule.tpl');
?>