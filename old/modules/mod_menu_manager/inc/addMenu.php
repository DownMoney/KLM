<?php 
  
  $mID = wt_set_task($_REQUEST, 'mID');
  
  if( wt_is_valid($_REQUEST['mID'], 'int', '0')  ) {
  
  $action = 'edit';
  $wt_template->assign('db_menu', $db_menu = $this->get_menus($mID) );
  } else {
  $action = 'add';
  }
  
  $db_menu['access'] = wt_parse_access($db_menu['access']);
  $wt_template->assign('action', $action);
  

$form = new form_class();
  
  $form->NAME = 'addMenu';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 't')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';
  	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'menu_name',
		'ID' => 'menu_name',
		'LABEL' => 'Nazwa',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_menu['menu_name']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'menu_title',
		'ID' => 'menu_title',
		'LABEL' => 'Tytuł',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_menu['menu_title']
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'menu_desc',
		'ID' => 'menu_desc',
		'LABEL' => 'Opis',
	 	'CLASS' => 'text_area4',
	 	'COLS' => 60,
	 	'ROWS' => 5,
		'VALUE' => $db_menu['menu_desc']
	));
	
	
$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'access',
		'ID' => 'access',
		'VALUE' => '0',
		'SIZE' => 10,
		'SELECTED' => $db_menu['access'],
	   'OPTIONS' => wt_prepare_user_group_array_to_form(),
		'MULTIPLE' => '1',
		'LABEL' => 'Dostęp',
	));
	
  	
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
		'LABEL' => 'Dodaj nowy',
		'CHECKED' => 0
	));
   
   $form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_edit',
		'VALUE' => 'edit',
		'LABEL' => 'Edycja bieżącego',
		'CHECKED' => 0
	));

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveMenu'
	));
	
	if($action == 'edit') {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'mID',
		'ID' => 'mID',
		'VALUE' => $mID
	));
	}
	
	
	
  $form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Zapisz >>',
		'CLASS' => 'button',
		'ExtraAttributes' => array('onMouseOver' => "updateInfoBoxStatus('info', 'Zapisz', 'Kliknij aby zapisać.');",
											'onMouseOut' => "updateInfoBoxStatus();"),
		'ONCLICK' => 'lon();',									
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'reset_button',
		'VALUE' => 'Wyczyść',
		'CLASS' => 'button',
		'ExtraAttributes' => array('onMouseOver' => "updateInfoBoxStatus('info', 'Wyczyść zmiany', 'Kliknij aby wyczyścić zmiany w formularzu.');",
											'onMouseOut' => "updateInfoBoxStatus();"),
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '<< Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'lon(); document.location.href=(\'' . wt_href_link('', '', wt_get_all_get_params(array('t'))) . '\');',
		'ExtraAttributes' => array('onMouseOver' => "updateInfoBoxStatus('info', 'Anuluj zmiany', 'Kliknij aby anulować zmiany i powrócić do listy.');",
											'onMouseOut' => "updateInfoBoxStatus();"),
	));

  

	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addMenu_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		
  $wt_template->assign('addMenu_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  		$wt_template->load_file('addMenu');
       
?>
