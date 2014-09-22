<?php 

	$form = new form_class();
  	$form->NAME = 'addImage';
	$form->ID = 'addImage';
  	$form->METHOD = 'POST';
  	$form->ACTION = wt_href_link('mod_structure_manager', '', wt_get_all_get_params(array('a','iID','fID','m','t')));
  	$form->debug = 'wt_print_array';
	$form->TARGET = 'operation2';
	$form->ONSUBMIT = "setActionFormSubmit('Dodaję zdjęcie ... proszę czekać ...')";
  	$form->ENCTYPE = 'multipart/form-data';
    
  	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveImage'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'iID',
		'ID' => 'iID',
		'VALUE' => $_GET['iID']
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'fID',
		'ID' => 'fID',
		'VALUE' => $_GET['fID']
	));
		
  	$form->AddInput(array(
  		'TYPE' => 'file',
  		'NAME' => 'fi_image',
  		'ID' => 'fi_image',
  		'LABEL' => 'Plik',
		'ONCHANGE' => 'setActionFormSubmit(\'Dodaję zdjęcie ... proszę czekać ...\'); this.form.submit()'
   	));
		
	  	$form->AddInput(array(
  		'TYPE' => 'text',
  		'NAME' => 'fi_url',
  		'ID' => 'fi_url',
  		'LABEL' => 'Adres WWW zdjęcia',
  		'CLASS' => 't3',
   	));
  	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'close_button',
		'NAME' => 'close_button',
		'VALUE' => '&laquo; zamknij',
		'ONCLICK' => 'hide_action_form(); return false;'
	));
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button_aw',
		'NAME' => 'submit_button_aw',
		'VALUE' => 'dodaj zdjęcie &raquo;'
	));
  
   
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addImage_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addImage_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
    $wt_template->load_file('addImage');
?>