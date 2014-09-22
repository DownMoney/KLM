<?php 

	$form = new form_class();
  	$form->NAME = 'addFile';
	$form->ID = 'addFile';
  	$form->METHOD = 'POST';
  	$form->ACTION = wt_href_link('mod_structure_manager');
  	$form->debug = 'wt_print_array';
	$form->TARGET = 'operation2';
	$form->ONSUBMITTING = "setActionFormSubmit('Dodaję plik ... proszę czekać ...')";
  	$form->ENCTYPE = 'multipart/form-data';
    
  	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveFile'
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
		'TYPE' => 'hidden',
		'NAME' => 'multiple',
		'ID' => 'multiple',
		'VALUE' => (wt_is_valid($_GET['multiple'],'int','0') ? $_GET['multiple'] : '0')
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'add_on',
		'ID' => 'add_on',
		'VALUE' => $_GET['add_on']
	));
	
  	$form->AddInput(array(
  		'TYPE' => 'file',
  		'NAME' => 'fi_file',
  		'ID' => 'fi_file',
  		'LABEL' => 'Plik',
   	));
   	
   	$form->AddInput(array(
  		'TYPE' => 'text',
  		'NAME' => 'fi_file_link',
  		'ID' => 'fi_file_link',
  		'LABEL' => 'Link do pliku',
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
		'VALUE' => 'ściągnij plik &raquo;'
	));
	
	$wt_template->assign('addFileChecksum',md5(serialize($_REQUEST)));
	if( get_cfg_var('upload_max_filesize') > get_cfg_var('post_max_size') ) {
		$max_upload_size = (int)get_cfg_var('post_max_size');
	} else {
		$max_upload_size = (int)get_cfg_var('upload_max_filesize');
	}
		$wt_template->assign('max_upload_size',$max_upload_size);
	
  		$wt_template->assign('files_to_import_count',count($this->scan_import_dir()));


   
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addFile_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addFile_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
    $wt_template->load_file('addFile');
?>