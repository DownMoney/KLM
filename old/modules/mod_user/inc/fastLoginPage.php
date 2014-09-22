<?php 

  $form = new form_class();
  $form->NAME = 'fastLoginForm';
  $form->ID = 'fastLoginForm';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 'a=makeLogin&method=fastLogin', '', 'SSL', true);
  $form->ResubmitConfirmMessage = 'Już raz kliknołeś wysłanie formularza,  jesteś pewien, że chcesz zrobić to ponownie ?';
  $form->ONSUBMITTING = 'return checkFastLoginForm() ';

	
   $wt_template->assign('lP_params', $this->module_params->get_array());		
	
  $login_type = $this->get_user_login_type();
  $wt_template->assign('lP_login_type', $login_type);
 
	
 if($login_type['tbl_key'] == 'usr_login' || $login_type['tbl_key'] == 'usr_nick' || $login_type['tbl_key'] == 'usr_id')	{
 
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => $login_type['tbl_key'],
		'ID' => $login_type['tbl_key'],
		'VALUE' => '',
		'LABEL' => $login_type['login_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - ' . $login_type['login_name'] . ' - !',
	));
	
	}
	
 	
if($login_type['tbl_key'] == 'usr_email')	{	
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => $login_type['tbl_key'],
		'ID' => $login_type['tbl_key'],
		'VALUE' => '',
		'LABEL' => $login_type['login_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - ' . $login_type['login_name'] . ' - !',
		'ValidateAsEmail' => 1,
		'ValidateAsEmailErrorMessage' => 'Niepoprawny adres e-mail',
		
	));
	}
	

	$form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_pass',
		'ID' => 'usr_pass',
		'VALUE' => '',
		'LABEL' => 'Hasło',
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Hasło - !',
	));
  
  
  $form->AddInput(array(
		'TYPE' => 'submit',
		'NAME' => 'submit_button',
		'ID' => 'submit_button',
		'CLASS' => 'form1_submit',
		'VALUE' => 'Zaloguj mnie >>',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a', 
		'ID' => 'action',
		'VALUE' => 'makeLogin',
	));
 
 
 
 
  $wt_template->assign_by_ref('form', $form);	
  $wt_template->register_prefilter('smarty_prefilter_form');
  $wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
  $wt_template->fetch('loginPage_form.tpl');
  $wt_template->SetTemplateDir();
  $wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('loginPage_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  
  
?>