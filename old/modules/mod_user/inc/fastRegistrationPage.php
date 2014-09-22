<?php 

function mod_user__check_email($email_address = '') {
			$mod_user = wt_module::singleton('mod_user');
     		return $mod_user->check_email($email_address);   		
     }

function mod_user__check_login($login = '') {
			$mod_user = wt_module::singleton('mod_user');
     		return $mod_user->check_login($login);   		
     }
     
function mod_user__check_password($pass) {
			$mod_user = wt_module::singleton('mod_user');
			return $mod_user->check_password($pass);
} 

  
  $wt_template->assign('action', $action);

  $form = new form_class();
  $form->NAME = 'fastRegistrationForm';
  $form->ID = 'fastRegistrationForm';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 'a=saveFastRegistration');
  $form->debug = 'wt_print_array';
  $form->ONSUBMITTING = 'return checkFastRegisterForm() ';	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_first_name',
		'ID' => 'usr_first_name',
		'LABEL' => 'Imię',
		'VALUE' => $db_info['usr_first_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_first_name')) ? $this->module_params->get('required_usr_first_name') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Imię - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_usr_first_name')) ? $this->module_params->get('minimum_usr_first_name') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Imię -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_first_name') . ' znaków !',
	));
	

$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_last_name',
		'ID' => 'usr_last_name',
		'LABEL' => 'Nazwisko',
		'VALUE' => $db_info['usr_last_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_last_name')) ? $this->module_params->get('required_usr_last_name') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Nazwisko - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_lastname')) ? $this->module_params->get('minimum_usr_last_name') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Nazwisko -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_last_name') . ' znaków !',
	));

 
$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_email',
		'ID' => 'usr_email',
		'LABEL' => 'E-mail',
		'VALUE' => $db_info['usr_email'],
		'CLASS' => 'form1_text',
		'ValidateAsEmail' => ($this->module_params->get('required_usr_email')) ? $this->module_params->get('required_usr_email') : NULL,
		'ValidateAsEmailErrorMessage' => 'Nie poprawny adres E-mail',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_email')) ? $this->module_params->get('required_usr_email') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - E-mail - !',
		'ValidationServerFunction' => 'mod_user__check_email',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie adres e-mail istnieje już w naszej bazie danych. Podaj inny adres e-mail.',
		'Capitalization' => 'lowercase', 
	));

	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company',
		'ID' => 'usr_company',
		'LABEL' => 'Nazwa firmy',
		'VALUE' => '',
	));
	
	
		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_vat_id',
		'ID' => 'usr_company_vat_id',
		'LABEL' => 'NIP',
		'VALUE' => '',
	));
	
	
		$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_address',
		'ID' => 'usr_address',
		'LABEL' => 'Aders',
		'VALUE' => '',
	));
	
	
	
	
		$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_city',
		'ID' => 'usr_city',
		'LABEL' => 'Miasto',
		'VALUE' => '',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_post_code',
		'ID' => 'usr_post_code',
		'LABEL' => 'Kod pocztowy',
		'VALUE' => '',
	));
	
	
	
 $form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_password',
		'ID' => 'usr_password',
		'LABEL' => 'Hasło',
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Hasło - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_password')) ? $this->module_params->get('minimum_usr_password') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Hasło -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_password') . ' znaków !',
	));
 
 $form->AddInput(array(	
		'TYPE' => 'password',
		'NAME' => 'usr_password_confirm',
		'ID' => 'usr_password_confirm',
		'LABEL' => 'Powtórz hasło',
		'CLASS' => 'form1_text',
		'ValidateAsEqualTo' => 'usr_password',
		'ValidateAsEqualToErrorMessage' => 'Potwierdzenie hasła musi być takie same jak hasło !',
	));
 
 
  	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'NAME' => 'submit_button',
		'VALUE' => 'REJESTRUJ KONTO STAŁEGO KLIENTA &raquo;',
	));
		
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; powrót',
		'ONCLICK' => 'Dialog.closeInfo();',
	));
	
 

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'a',
		'NAME' => 'a',
		'VALUE' => 'saveFastRegistration'
	));
	
	 $form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'doit',
		'NAME' => 'doit',
		'VALUE' => '1'
	));
	 
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->assign('doit', $doit);
	   
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('fastRegistrationPage_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('fastRegistrationPage_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
         
      

?>