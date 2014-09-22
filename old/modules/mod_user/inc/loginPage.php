<?php 

  $form = new form_class();
  $form->NAME = 'loginPage';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', '', '', 'SSL', true);
  $form->ResubmitConfirmMessage = 'Już raz kliknąłeś wysłanie formularza,  jesteś pewien, że chcesz zrobić to ponownie ?';

  $wt_template->assign('lP_params', $this->module_params->get_array());		
	
  $login_type = $this->get_user_login_type();
  $wt_template->assign('lP_login_type', $login_type);
 
 
 if($login_type['tbl_key'] != 'usr_email')	{
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => $login_type['tbl_key'],
		'ID' => $login_type['tbl_key'],
		'VALUE' => '',
		'LABEL' => $login_type['login_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => $login_type['login_name'].' '.TEXT_MOD_USER_IS_REQUIRED,
	));
  }
	
if($login_type['tbl_key'] == 'usr_email')	{	
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => $login_type['tbl_key'],
		'ID' => $login_type['tbl_key'],
		'VALUE' => '',
		'LABEL' => TEXT_MOD_USER_LABEL_EMAIL,
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => $login_type['login_name'].' '.TEXT_MOD_USER_IS_REQUIRED,
		'ValidateAsEmail' => 1,
		'ValidateAsEmailErrorMessage' => TEXT_MOD_USER_WRONG_EMAIL_FORMAT,
		
	));
	}
	
	$form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_pass',
		'ID' => 'usr_pass',
		'VALUE' => '',
		'LABEL' => TEXT_MOD_USER_LABEL_PASSWORD,
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => TEXT_MOD_USER_LABEL_PASSWORD.' '.TEXT_MOD_USER_IS_REQUIRED,
	));
  
  $form->AddInput(array(
		'TYPE' => 'submit',
		'NAME' => 'submit_button',
		'ID' => 'submit_button',
		'CLASS' => 'form1_submit',
		'VALUE' => 'zaloguj się',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a', 
		'ID' => 'action',
		'VALUE' => 'makeLogin',
	));
 
 
 
 
  $wt_template->assign_by_ref('form', $form);	
  $wt_template->register_prefilter('smarty_prefilter_form');
  if($admin_login == true) {		
  	  $wt_template->set_theme($wt_module->installed_modules['mod_user_manager']['theme']);  		
	  $wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR);  
  } else {
  	  $wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.$this->module_key . DIRECTORY_SEPARATOR);
  }	
  $wt_template->fetch('loginPage_form.tpl');
  $wt_template->SetTemplateDir();
  $wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('loginPage_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  
  
?>
