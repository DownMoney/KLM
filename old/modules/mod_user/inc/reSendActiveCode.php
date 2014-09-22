<?php 


function mod_user__check_login($login) {
	$mod_user = wt_module::singleton('mod_user');
	return !$mod_user->check_login($login);  
}

  $form = new form_class();
  $form->NAME = 'loginPage';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', '', '', 'SSL', true);
  $form->ResubmitConfirmMessage = 'Już raz kliknołeś wysłanie formularza,  jesteś pewien, że chcesz zrobić to ponownie ?';

	
   $wt_template->assign('lP_params', $this->module_params->get_array());		
	
  $login_type = $this->get_user_login_type();
  $wt_template->assign('resaC_login_type', $login_type);
 
	
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
		'ValidationServerFunction' => 'mod_user__check_login',
		'ValidationServerFunctionErrorMessage' => 'Przykro nam ale podany przez Ciebie ' . $login_type['login_name'] . ' nie jest zarejestrowany w naszym systemie.',
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
		'ValidationServerFunction' => 'mod_user__check_login',
		'ValidationServerFunctionErrorMessage' => 'Przykro nam ale podany przez Ciebie ' . $login_type['login_name'] . ' nie jest zarejestrowany w naszym systemie.',
	));
	}
	
  
  $form->AddInput(array(
		'TYPE' => 'submit',
		'NAME' => 'submit_button',
		'ID' => 'submit_button',
		'CLASS' => 'form1_submit',
		'VALUE' => 'Wyślij kod aktywacyjny >>',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 't', 
		'ID' => 't',
		'VALUE' => 'reSendActiveCodePage',
	));
 
 $form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'doit',
		'NAME' => 'doit',
		'VALUE' => '1'
	));
	 
    
  $form->LoadInputValues($form->WasSubmitted('doit'));
  $verify = array();
  if($form->WasSubmitted('doit'))  {
			
		
		if(($error_message = $form->Validate($verify)) == "")  {
	 			$doit = 1;
	 	} else {
	 	$doit = 0;
	 	}		
  } else	{
  		$error_message = '';
		$doit = 0;
  }
  
  if($doit) {
  	$this->reSendActiveCode();
  }
 
  $wt_template->assign('error_message', $error_message);
  $wt_template->assign_by_ref('form', $form);	
  $wt_template->register_prefilter('smarty_prefilter_form');
  $wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
  $wt_template->fetch('reSendActiveCodePage_form.tpl');
  $wt_template->SetTemplateDir();
  $wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('reSendActiveCodePage_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  
?>
