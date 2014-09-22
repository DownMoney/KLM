<?php 

function mod_user__check_email($email_address = '') {
			$mod_user = wt_module::singleton('mod_user');
     		return $mod_user->check_email($email_address);   		
     }

function mod_user__check_login($login = '') {
			if(!wt_not_null($login)) {
				return true;
			}
			$mod_user = wt_module::singleton('mod_user');
     		return $mod_user->check_login($login);   		
     }

function mod_user__check_nick($nick = '') {
     		return true;   		
     }	
	  	
     
function mod_user__check_vat_id($nip = '') {
	$mod_user = wt_module::singleton('mod_user');	
	if($mod_user->check_vat_id($nip) == false) {
		return false;
	}	
	if($mod_user->login_key == 'usr_company_vat_id' && $mod_user->check_login($login) == false) {
		return false;
	}
	return true;
}    

function mod_user__check_password($pass) {
			$mod_user = wt_module::singleton('mod_user');
			return $mod_user->check_password($pass);
} 

function debug($error) {

echo $error . '<br>';

}

	global $wt_user;
	
	if($wt_user->is_user()) {
	$db_info = $wt_user->usr_info; 
	$wt_template->assign('usr_params_array', $db_info['usr_params_array']);
	$wt_template->assign('db_info', $db_info);
	$action = 'edit';
	} else {
	$action = 'add';
	$db_info = $_POST;
	}

  $wt_template->assign('action', $action);


  $form = new form_class();
  
  $form->NAME = 'newUser';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 't=newUser');
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';	
  $form->ENCTYPE = 'multipart/form-data';

  //	wt_print_array($this->module_params);
	
	if($this->module_params->get('usr_first_name'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_first_name',
		'ID' => 'usr_first_name',
		'LABEL' => 'Imię',
		'VALUE' => $db_info['usr_first_name'],
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_first_name')) ? $this->module_params->get('required_usr_first_name') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Imię - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_usr_first_name')) ? $this->module_params->get('minimum_usr_first_name') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Imię -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_first_name') . ' znaków !',
	));
	}
	
	if($this->module_params->get('usr_second_name'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_second_name',
		'ID' => 'usr_second_name',
		'LABEL' => 'Drugie imię',
		'VALUE' => $db_info['usr_second_name'],		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_second_name')) ? $this->module_params->get('required_usr_second_name') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Drugie imię - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_second_name')) ? $this->module_params->get('minimum_usr_second_name') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Drugie imię -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_second_name') . ' znaków !',
	));
	}
	
	
	if($this->module_params->get('usr_last_name'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_last_name',
		'ID' => 'usr_last_name',
		'LABEL' => 'Nazwisko',
		'VALUE' => $db_info['usr_last_name'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_last_name')) ? $this->module_params->get('required_usr_last_name') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Nazwisko - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_lastname')) ? $this->module_params->get('minimum_usr_last_name') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Nazwisko -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_last_name') . ' znaków !',
	));
	}
	
	
 if($this->module_params->get('usr_nick'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_nick',
		'ID' => 'usr_nick',
		'LABEL' => 'Nick',
		'VALUE' => $db_info['usr_nick'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_nick')) ? $this->module_params->get('required_usr_nick') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Nick - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_nick')) ? $this->module_params->get('minimum_usr_nick') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Nick -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_nick') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_nick',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie - Nick - istnieje już w naszej bazie danych. Podaj inny - Nick -.',
	));
	}
	
 if($this->module_params->get('usr_login'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_login',
		'ID' => 'usr_login',
		'LABEL' => 'Login',
		'VALUE' => $db_info['usr_login'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_login')) ? $this->module_params->get('required_usr_login') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Login - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_nick')) ? $this->module_params->get('minimum_usr_login') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Login -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_login') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_login',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie - Login - istnieje już w naszej bazie danych. Podaj inny - Login -.',
	));
	}
	
	
	if($this->module_params->get('usr_gender'))  {	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_gender',
		'ID' => 'usr_gender',
		'LABEL' => 'Płeć',
		'VALUE' => $db_info['usr_gender'],
		'OPTIONS' => $this->usr_gender,
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_gender')) ? $this->module_params->get('required_usr_gender') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać pole - Płeć - !',
 
	));
	}
	

	
  if($this->module_params->get('usr_dob'))  {	
  
  $year_start = date('Y')-18;		
  $start_date = '1900-01-01';
  $end_date = date("Y-m-d");
  
	$form->AddInput(array(
		'TYPE' => 'custom',
		'NAME' => 'usr_dob',
		'ID' => 'usr_dob',
		'LABEL' => 'Data urodzenia',
		'CLASS' => 'form1_select',
		'CustomClass' => 'form_date_class',
	 	'VALUE' => (!wt_not_null($db_info['usr_dob']) || $db_info['usr_dob'] == '0000-00-00') ? null : $db_info['usr_dob'],
		'Format' => '{day}/{month}/{year}',
		'Months' => array(
			'01' => 'Styczeń',
			'02' => 'Luty',
			'03' => 'Marzec',
			'04' => 'Kwiecień',
			'05' => 'Maj',
			'06' => 'Czerwiec',
			'07' => 'Lipiec',
			'08' => 'Sierpień',
			'09' => 'Wrzesień',
			'10' => 'Październik',
			'11' => 'Listopad',
			'12' => 'Grudzień'
		),
		'ValidationStartDate' => $start_date,
		'ValidationStartDateErrorMessage' => 'Podano nie poprawną datę urodzenia !',
		'ValidationEndDate' => $end_date,
		'ValidationEndDateErrorMessage' => 'Podano nie poprawną datę urodzenia !',
		'Optional' => true,
		
	));
 }	
	
	if($this->module_params->get('usr_company'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company',
		'ID' => 'usr_company',
		'LABEL' => 'Nazwa firmy',
		'VALUE' => $db_info['usr_company'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company')) ? $this->module_params->get('required_usr_company') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Nazwa firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company')) ? $this->module_params->get('minimum_usr_company') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Nazwa firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company') . ' znaków !',
	));
	}
	
	
	if($this->module_params->get('usr_company_vat_id'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_vat_id',
		'ID' => 'usr_company_vat_id',
		'LABEL' => 'NIP',
		'VALUE' => $db_info['usr_company_vat_id'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_vat_id')) ? $this->module_params->get('required_usr_company_vat_id') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - NIP firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_vat_id')) ? $this->module_params->get('minimum_usr_company_vat_id') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - NIP firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_vat_id') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_vat_id',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie numer NIP firmy, jest niepoprawny'.(($this->login_key == 'usr_company_vat_id') ? ' LUB taki numer NIP zarejestrowany jest już w naszym systemie dla innej firmy' : ''),
	));
	}
	
	if($this->module_params->get('usr_company_address'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_address',
		'ID' => 'usr_company_address',
		'LABEL' => 'Adres firmy',
		'VALUE' => $db_info['usr_company_address'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_address')) ? $this->module_params->get('required_usr_company_address') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Adres firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_address')) ? $this->module_params->get('minimum_usr_company_address') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Adres firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_address') . ' znaków !',
	));
	}
	
	if($this->module_params->get('usr_company_post_code'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_post_code',
		'ID' => 'usr_company_post_code',
		'LABEL' => 'Kod pocztowy',
		'VALUE' => $db_info['usr_company_post_code'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_post_code')) ? $this->module_params->get('required_usr_company_post_code') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Kod pocztowy firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_post_code')) ? $this->module_params->get('minimum_usr_company_post_code') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Kod pocztowy firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_post_code') . ' znaków !',	
		'ValidateRegularExpression' => '^([0-9]{2}-[0-9]{3})$',
		'ValidateRegularExpressionErrorMessage' => 'Zły format kodu pocztowego, kod pocztowy proszę podać w formacie xx-xxx',
	));
	}
	
	if($this->module_params->get('usr_company_city'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_city',
		'ID' => 'usr_company_city',
		'LABEL' => 'Miasto',
		'VALUE' => $db_info['usr_company_city'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_city')) ? $this->module_params->get('required_usr_company_city') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Miasto firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_city')) ? $this->module_params->get('minimum_usr_company_city') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Miasto firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_city') . ' znaków !',
	));
	}
	
	if($this->module_params->get('usr_company_state'))  {	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_company_state',
		'ID' => 'usr_company_state',
		'LABEL' => 'Województwo',
		'VALUE' => ($db_info['usr_company_state']) ? $db_info['usr_company_state'] : '',
		'OPTIONS' => $this->zones_array,
		'CLASS' => 'form1_select',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_state')) ? $this->module_params->get('required_usr_company_state') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać pole - Województwo - !',
 
	));
	}
	
	if($this->module_params->get('usr_company_email'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_email',
		'ID' => 'usr_company_email',
		'LABEL' => TEXT_MOD_USER_LABEL_EMAIL,
		'VALUE' => $db_info['usr_company_email'],
		
		'ValidateAsEmail' => ($this->module_params->get('required_usr_company_email')) ? $this->module_params->get('required_usr_company_email') : NULL,
		'ValidateAsEmailErrorMessage' => 'Nie poprawny adres E-mail',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_email')) ? $this->module_params->get('required_usr_company_email') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - E-mail firmy - !',
		'Capitalization' => 'lowercase',
	));
	}
	
	if($this->module_params->get('usr_company_www'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_www',
		'ID' => 'usr_company_www',
		'LABEL' => 'WWW',
		'VALUE' => $db_info['usr_company_www'],
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_www')) ? $this->module_params->get('required_usr_company_www') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Adres WWW firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_www')) ? $this->module_params->get('minimum_usr_company_www') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - WWW firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_www') . ' znaków !',
	));
	}
	
	if($this->module_params->get('usr_company_phone'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_phone',
		'ID' => 'usr_company_phone',
		'LABEL' => 'Telefon',
		'VALUE' => $db_info['usr_company_phone'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_phone')) ? $this->module_params->get('required_usr_company_phone') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Telefon firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_phone')) ? $this->module_params->get('minimum_usr_company_phone') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Telefon firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_phone') . ' znaków !',
	));
	}
	
	if($this->module_params->get('usr_company_fax'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_fax',
		'ID' => 'usr_company_fax',
		'LABEL' => 'Fax',
		'VALUE' => $db_info['usr_company_fax'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_company_fax')) ? $this->module_params->get('required_usr_company_fax') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Fax firmy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_company_fax')) ? $this->module_params->get('minimum_usr_company_fax') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Fax firmy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_company_fax') . ' znaków !',
	));
	}
		
	if($this->module_params->get('usr_address'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_address',
		'ID' => 'usr_address',
		'LABEL' => 'Adres',
		'VALUE' => $db_info['usr_address'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_address')) ? $this->module_params->get('required_usr_address') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Adres - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_address')) ? $this->module_params->get('minimum_usr_address') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Adres -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_address') . ' znaków !',
	));
	}
	
  	if($this->module_params->get('usr_city'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_city',
		'ID' => 'usr_city',
		'LABEL' => 'Miasto',
		'VALUE' => $db_info['usr_city'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_city')) ? $this->module_params->get('required_usr_city') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Miasto - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_city')) ? $this->module_params->get('minimum_usr_city') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Miasto -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_city') . ' znaków !',
	));
	}
	
	
	if($this->module_params->get('usr_post_code'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_post_code',
		'ID' => 'usr_post_code',
		'LABEL' => 'Kod pocztowy',
		'SIZE' => '6',
		'VALUE' => $db_info['usr_post_code'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_post_code')) ? $this->module_params->get('required_usr_post_code') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Kod pocztowy - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_post_code')) ? $this->module_params->get('minimum_usr_post_code') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Kod pocztowy -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_post_code') . ' znaków !',		
		'ValidateRegularExpression' => '^([0-9]{2}-[0-9]{3})$',
		'ValidateRegularExpressionErrorMessage' => 'Zły format kodu pocztowego, kod pocztowy proszę podać w formacie xx-xxx',
	));
	}
	
	
  if($this->module_params->get('usr_state'))  {	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_state',
		'ID' => 'usr_state',
		'LABEL' => 'Województwo',
		'VALUE' => ($db_info['usr_state']) ? $db_info['usr_state'] : '',
		'OPTIONS' => $this->zones_array,
		'CLASS' => 'form1_select',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_state')) ? $this->module_params->get('required_usr_state') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać pole - Województwo - !',
 
	));
	}
	
	
	if($this->module_params->get('usr_country'))  {	
	
	
	
	
  global $wt_module; 
  if( $wt_module->is_installed('mod_zones_manager') )	{
  $mod_zones_manager = wt_module::singleton('mod_zones_manager');
  $cP = array();
  $cP['for_user'] = true;
  $cP['add_blank'] = true;  
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_country_id',
		'ID' => 'usr_country_id',
		'LABEL' => TEXT_MOD_USER_NU_COUNTRY,
		'VALUE' => ($action == 'add') ? 170 : $db_info['usr_country_id'],
		'OPTIONS' => $mod_zones_manager->get_countries_for_form($cP),
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_country')) ? $this->module_params->get('required_usr_country') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać - Kraj - !',
	));
	$wt_template->assign('is_country_id', '1');
	
  } else {
  		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_country',
		'ID' => 'usr_country',
		'LABEL' => TEXT_MOD_USER_NU_COUNTRY,
		'VALUE' => $db_info['usr_country'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_country')) ? $this->module_params->get('required_usr_country') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Kraj - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_country')) ? $this->module_params->get('minimum_usr_country') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Kraj -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_country') . ' znaków !',
	));
  		
	}
	
	}
	
	
		if($this->module_params->get('usr_email'))  {	
		

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_email',
		'ID' => 'usr_email',
		'LABEL' => TEXT_MOD_USER_LABEL_EMAIL,
		'VALUE' => $db_info['usr_email'],
		
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
		'NAME' => 'usr_email_check',
		'ID' => 'usr_email_check',
		'LABEL' => TEXT_MOD_USER_NU_EMAIL_REPEAT,
		
		'VALUE' => $db_info['usr_email'],
		'ValidateAsEmail' => ($this->module_params->get('required_usr_email')) ? $this->module_params->get('required_usr_email') : NULL,
		'ValidateAsEmailErrorMessage' => 'Nie poprawny adres r-mail w polu  - Powtórz e-mail - ',
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_email')) ? $this->module_params->get('required_usr_email') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Powtórz e-mail - !',
		'Capitalization' => 'lowercase',
		'ValidateAsEqualTo' => 'usr_email',
		'ValidateAsEqualToErrorMessage' => 'Powtórz e-mail musi być takie same jak E-mail !',
	)); 
	}
	 
 if($this->module_params->get('usr_phone'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_phone',
		'ID' => 'usr_phone',
		'LABEL' => 'Telefon',
		'VALUE' => $db_info['usr_phone'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_phone')) ? $this->module_params->get('required_usr_phone') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Telefon - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_phone')) ? $this->module_params->get('minimum_usr_phone') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Telefon -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_phone') . ' znaków !',
	));
	}
	
	
 if($this->module_params->get('usr_fax'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_fax',
		'ID' => 'usr_fax',
		'LABEL' => 'Fax',
		'VALUE' => $db_info['usr_fax'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_fax')) ? $this->module_params->get('required_usr_fax') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Fax - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_fax')) ? $this->module_params->get('minimum_usr_fax') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Fax -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_fax') . ' znaków !',
	));
	}
  
if($this->module_params->get('usr_mobile'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_mobile',
		'ID' => 'usr_mobile',
		'LABEL' => 'Tel. kom.',
		'VALUE' => $db_info['usr_mobile'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_mobile')) ? $this->module_params->get('required_usr_mobile') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Tel. kom. - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_gsm')) ? $this->module_params->get('minimum_usr_mobile') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Tel. kom. -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_mobile') . ' znaków !',
	));
	}

 if($this->module_params->get('usr_gg'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_gg',
		'ID' => 'usr_gg',
		'LABEL' => 'Gadu-Gadu',
		'VALUE' => $db_info['usr_gg'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_gg')) ? $this->module_params->get('required_usr_gg') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Gadu-Gadu - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_gg')) ? $this->module_params->get('minimum_usr_gg') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Gadu-Gadu -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_gg') . ' znaków !',
	));
	}
  
 
  if($this->module_params->get('usr_icq'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_icq',
		'ID' => 'usr_icq',
		'LABEL' => 'ICQ',
		'VALUE' => $db_info['usr_icq'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_icq')) ? $this->module_params->get('required_usr_icq') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - ICQ - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_icq')) ? $this->module_params->get('minimum_usr_icq') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - ICQ -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_icq') . ' znaków !',
	));
	}
  
  if($this->module_params->get('usr_tlen'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_tlen',
		'ID' => 'usr_tlen',
		'LABEL' => 'Tlen',
		'VALUE' => $db_info['usr_tlen'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_tlen')) ? $this->module_params->get('required_usr_tlen') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Tlen - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_tlen')) ? $this->module_params->get('minimum_usr_tlen') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Tlen -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_tlen') . ' znaków !',
	));
	}
  
 
  if($this->module_params->get('usr_skype'))  {	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_skype',
		'ID' => 'usr_skype',
		'LABEL' => 'Skype',
		'VALUE' => $db_info['usr_skype'],
		
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_skype')) ? $this->module_params->get('required_usr_skype') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Skype - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_skype')) ? $this->module_params->get('minimum_usr_skype') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Skype -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_skype') . ' znaków !',
	));
	}
 
 
 if($this->module_params->get('usr_www'))  {	  
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_www',
		'ID' => 'usr_www',
		'LABEL' => 'Adres www',
		'MAXLENGTH' => 255,
		
		'VALUE' => $db_info['usr_www'],
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_www')) ? $this->module_params->get('required_usr_www') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Adres www - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_www')) ? $this->module_params->get('minimum_usr_www') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Adres www -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_www') . ' znaków !',
	));
	

  }	
  
 if($this->module_params->get('usr_other_contact'))  {	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'usr_other_contact',
		'ID' => 'usr_other_contact',
		'LABEL' => 'Inny kontakt',
		'VALUE' => $db_info['usr_other_contact'],
		
		'COLS' => 40,
		'ROWS' => 10,
		'ValidateAsNotEmpty' => ($this->module_params->get('required_usr_other_contact')) ? $this->module_params->get('required_usr_other_contact') : NULL,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Inny kontakt - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_other_contact')) ? $this->module_params->get('minimum_usr_other_contact') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Inny kontakt -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_other_contact') . ' znaków !',
	));
	}	
	
 if($this->module_params->get('usr_image'))  {	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'usr_image',
		'ID' => 'usr_image',
		'LABEL' => 'Zdjęcie'
	));
	
	if( $action == 'edit' ) {
	
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'previus_usr_image',
		'ID' => 'previus_usr_image',
		'VALUE' => $db_info['usr_image']
  		));
		
		$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_usr_image',
		'ID' => 'delete_usr_image',
		'LABEL' => 'usuń zdjęcie',
		'VALUE' => '1'
  		));
		
	}
	
	}	
	
	if($action == 'add' && $wt_template->_tpl_vars['_klub'] == 'polecam') {
	
		$mod_user_manager = wt_module::singleton('mod_user_manager');
		$gP = array();
		$gP['where'] = " parent_id = '61' AND group_id != '63' ";	
		$_groups = $mod_user_manager->get_groups(null, $gP);
		
		foreach($_groups as $gr) {
			$groups[$gr['group_id']] = $gr['group_name'];
		} 
		
		
		$form->AddInput(array(
			'TYPE' => 'select',
			'NAME' => 'group_id',
			'ID' => 'group_id',
			'LABEL' => 'Stanowisko',
			'VALUE' => $db_info['group_id'],
			'OPTIONS' => $groups,
			'ValidateAsNotEmpty' => true,
			'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać - Stanowisko - !',
		));
	
	}
 
 $form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_password',
		'ID' => 'usr_password',
		'LABEL' => TEXT_MOD_USER_LABEL_PASSWORD,
		
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - Hasło - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_password')) ? $this->module_params->get('minimum_usr_password') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Hasło -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_password') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_password',
		'ValidationServerFunctionErrorMessage' => 'Podane przez Ciebie hasło jest nieprawidłowe.',
	));


if($action == 'add') {	

 
 $form->AddInput(array(	
		'TYPE' => 'password',
		'NAME' => 'usr_password_confirm',
		'ID' => 'usr_password_confirm',
		'LABEL' => 'Powtórz hasło',
		
		'ValidateAsEqualTo' => 'usr_password',
		'ValidateAsEqualToErrorMessage' => 'Potwierdzenie hasła musi być takie same jak hasło !',
	));


if($this->module_params->get('usr_data_manage'))  {	  
   $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'usr_data_manage',
		'ID' => 'usr_data_manage',
		'LABEL' => 'a',
		'ValidateAsSet' => ($this->module_params->get('required_usr_data_manage')) ? $this->module_params->get('required_usr_data_manage') : NULL,
		'ValidateAsSetErrorMessage' => 'Musisz wyrazić zgodę na  przetwarzanie swoich danych osobowych',
	)); 
}

if($this->module_params->get('usr_terms_agree'))  {		
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'usr_terms_agree',
		'ID' => 'usr_terms_agree',
		'LABEL' => 'Akceptuję ogólne warunki użytkowania serwisu',
		'ValidateAsSet' => ($this->module_params->get('required_usr_terms_agree')) ? $this->module_params->get('required_usr_terms_agree') : NULL,
		'ValidateAsSetErrorMessage' => 'Musisz zaakceptować regulamin',
	)); 
}

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'usr_terms_agree2',
		'ID' => 'usr_terms_agree2',
		'LABEL' => 'Akceptuję ogólne warunki użytkowania serwisu',
		'ValidateAsSet' => true,
		'ValidateAsSetErrorMessage' => 'Musisz wyrazić zgodę na otrzymywanie informacji handlowych',
	)); 
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'usr_terms_agree3',
		'ID' => 'usr_terms_agree3',
		'LABEL' => 'Akceptuję ogólne warunki użytkowania serwisu',
		'ValidateAsSet' => true,
		'ValidateAsSetErrorMessage' => 'Musisz wyrazić zgodę na  przetwarzanie swoich danych osobowych',
	)); 

}

	if($action == 'edit') {
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'usr_id',
		'ID' => 'usr_id',
		'VALUE' => $wt_user->usr_info['usr_id'],
	));
	
	
	}
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'newUser_submit_button',
		'VALUE' => ($action == 'add') ? 'rejestruj' : 'zapisz',
		'CLASS' => 'form1_button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'newUser_reset_button',
		'VALUE' => 'wyczyść',
		'CLASS' => 'form1_button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'newUser_cancel_button',
		'VALUE' => '&laquo; powrót',
		'CLASS' => 'form1_button',
		'ONCLICK' => 'document.location.href=(\'' . wt_href_link('mod_user') . '\');',
	));
	
 

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 't',
		'NAME' => 't',
		'VALUE' => 'newUser'
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
		
			$form->GetFileValues('usr_image', $fd);
		
			if($this->module_params->get('usr_image') && wt_is_valid($fd, 'array')  && wt_is_valid($fd['size'], 'int', '0') )  {	
					
			if( substr($fd['type'], 0, 6) != 'image/' ) {
				$error_message = 'Niepoprawny format zdjęcia. Obsługiwane formaty to JPG, GIF, PNG';
				$doit = 0;
					} elseif( $fd['size'] > 1572864 ) {
				$error_message = 'Zdjęcie przekracza maksymalny rozmiar pliku. Pamiętaj wynosi do 1,5MB (1536kB).';
				$doit = 0;
				} else {
				$doit = 1;	
				}	
							
			} else {
				$doit = 1;	
			}	
				
				
	 	} else {
	 	$doit = 0;
	 	}		
  } else	{
  		$error_message = '';
		$doit = 0;
  }
  
  if($doit) {
  	$this->saveUser();
  }
	
	
	
	
	   
	   $wt_template->assign_by_ref('form', $form);
	   $wt_template->assign('error_message', $error_message);
		$wt_template->assign_by_ref('verify', $verify);
		$wt_template->assign('doit', $doit);
	   
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('newUser_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('newUser_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
         
?>