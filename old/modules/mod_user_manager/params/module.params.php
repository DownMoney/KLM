<?php 
/**
* @package mod_order
* @subpackage mod_order_manager
*/

/************ Formularz zamówienia (dane użytkownika) ****************/ 
$parameters[] = array('name' => 'Dane użytkownika (dane użytkownika)',
										 'desc' => 'Czyli jakie dane muszą wypełnić użytkownicy podczas procesu rejestracji i jakie dane będzie zbierał system.',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(

/************ Tryb rejestracji ****************/                   
'register_type' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('usr_confirm' => 'Aktywacja konta przez użytkownika', 'admin_confirm' => 'Aktywacja konta przez administratora', 'no_confirm' => 'Aktywacja bez potwierdzenia', ),
                       'LABEL' => 'Tryb rejestracji',)),
								
'sep'.$i++ => array('type' => 'separator'),
										 
/************ Informuj o rejestracji nowego użytkownia ****************/                   
'inform_user_registartion' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak',),
                       'LABEL' => 'Informuj o rejestracji nowego użytkownia',)),
                       
/************ Wiadomość wysyłaj na ****************/                       
'inform_user_registartion_emails' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => 'oddziel adresy e-mail średnikiem ";" <br>np.: test@test.com<b>;</b>test2@test.com itd.',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Wiadomość wysyłaj na',)),
                       
'sep'.$i++ => array('type' => 'separator'),	

/************ Informuj o modyfikacji danych użytkownia ****************/                   
'inform_user_modify' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak',),
                       'LABEL' => 'Informuj o modyfikacji danych użytkownia',)),
                       
/************ Wiadomość wysyłaj na ****************/                       
'inform_user_modify_emails' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => 'oddziel adresy e-mail średnikiem ";" <br>np.: test@test.com<b>;</b>test2@test.com itd.',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Wiadomość wysyłaj na',)),
                       
'sep'.$i++ => array('type' => 'separator'),


/************ Informuj o usunięciu użytkownia ****************/                   
'inform_user_delete' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak',),
                       'LABEL' => 'Informuj o usunięciu użytkownia',)),
                       
/************ Wiadomość wysyłaj na ****************/                       
'inform_user_delete_emails' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => 'oddziel adresy e-mail średnikiem ";" <br>np.: test@test.com<b>;</b>test2@test.com itd.',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Wiadomość wysyłaj na',)),
                       
'sep'.$i++ => array('type' => 'separator'),


/************ Adresat wiadomości ****************/                       
'email_from' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Adresat wiadomości',)),

/************ E-mail Adresata ****************/                       
'email_from_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'E-mail Adresata',)),
                       
'sep'.$i++ => array('type' => 'separator'),
										 
/************ Używaj jako loginu ****************/                   
'use_as_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('usr_login' => 'Login użytkownika', 'usr_nick' => 'Nick użytkownika', 'usr_email' => 'E-mail użytkownika', 'usr_id' => 'Numer klienta', 'usr_company_vat_id' => 'NIP'),
                       'LABEL' => 'Używaj jako loginu',)),
                       
'sep'.$i++ => array('type' => 'separator'),		
								 
/************ Imię ****************/                   
'usr_first_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Imię',)),
                       
/************ Imię ****************/                   
'required_usr_first_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Imię - wymagane',)),
                       
/************ Imię ****************/                   
'minimum_usr_first_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Imię - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Imię ****************/                   
'admshow_usr_first_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Imię - pokaż w adminie',)),
                       
'sep'.$i++ => array('type' => 'separator'),
                       
/************ Drugie imię ****************/                   
'usr_second_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Drugie imię',)),

/************ Drugie imię - wymagane ****************/                   
'required_usr_second_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Drugie imię - wymagane',)),
                       
/************ Drugie imię - minimalna długość ****************/                   
'minimum_usr_second_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Drugie imię - minimalna długość',
                       'STYLE' => 'width: 50px;')),
 
'admshow_second_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Drugie imię - pokaż w adminie',)),
								                      
'sep'.$i++ => array('type' => 'separator'),
								
/************ Nazwisko ****************/                   
'usr_last_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwisko',)),

/************ Nazwisko - wymagane ****************/                   
'required_usr_last_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwisko - wymagane',)),
                       
/************ Nazwisko - minimalna długość ****************/                   
'minimum_usr_last_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Nazwisko - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwisko - wymagane ****************/                   
'admshow_usr_last_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwisko - pokaż w adminie',)),
                       
'sep'.$i++ => array('type' => 'separator'),

/************ Login ****************/                   
'usr_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Login',)),

/************ Login - wymagane ****************/                   
'required_usr_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Login - wymagane',)),
                       
/************ Login - minimalna długość ****************/                   
'minimum_usr_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Login - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwisko - wymagane ****************/                   
'admshow_usr_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Login - pokaż w adminie',)),
								
'admlabel_usr_login' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Login - label w adminie')),
                       
'sep'.$i++ => array('type' => 'separator'),

/************ Nick ****************/                   
'usr_nick' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nick',)),

/************ Nick - wymagane ****************/                   
'required_usr_nick' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nick - wymagane',)),
                       
/************ Nick - minimalna długość ****************/                   
'minimum_usr_nick' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Nick - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwisko - wymagane ****************/                   
'admshow_usr_nick' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nick - pokaż w adminie',)),
                       
'admlabel_usr_nick' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Nick - label w adminie')),
								                     
'sep'.$i++ => array('type' => 'separator'),

/************ Płeć ****************/                   
'usr_gender' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Płeć',)),

/************ Płeć - wymagane ****************/                   
'required_usr_gender' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Płeć - wymagane',)),
                       
/************ Nazwisko - wymagane ****************/                   
'admshow_usr_gender' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Płeć - pokaż w adminie',)),
                                            
'sep'.$i++ => array('type' => 'separator'),
								
/************ Data urodzenia ****************/                   
'usr_dob' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Data urodzenia',)),

/************ Data urodzenia - wymagane ****************/                   
'required_usr_dob' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Data urodzenia - wymagane',)),
                       
/************ Nazwisko - wymagane ****************/                   
'admshow_usr_dob' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Data urodzenia - pokaż w adminie',)),
                                
                       
'sep'.$i++ => array('type' => 'separator'),
                       
 /************ Nazwa Firmy ****************/ 
   
'usr_company' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwa Firmy',)),

/************ Nazwa Firmy - wymagane ****************/                   
'required_usr_company' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwa Firmy - wymagane',)),
                       
/************ Nazwa Firmy - minimalna długość ****************/                   
'minimum_usr_company' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Nazwa Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwa Firmy - admin ****************/                   
'admshow_usr_company' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Nazwa Firmy - pokaż w adminie',)),
                     
                      
'sep'.$i++ => array('type' => 'separator'),
         
			
			              
 /************ NIP firmy ****************/ 
   
'usr_company_vat_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'NIP firmy',)),

/************ NIP Firmy - wymagane ****************/                   
'required_usr_company_vat_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'NIP Firmy - wymagane',)),
                       
/************ NIP Firmy - minimalna długość ****************/                   
'minimum_usr_company_vat_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'NIP Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

'admshow_usr_company_vat_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'NIP Firmy - pokaż w adminie',)),
                     
                      
                    
'sep'.$i++ => array('type' => 'separator'),
	
	
 /************ Adres Firmy ****************/ 
   
'usr_company_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres Firmy',)),

/************ Nazwa Firmy - wymagane ****************/                   
'required_usr_company_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres Firmy - wymagane',)),
                       
/************ Nazwa Firmy - minimalna długość ****************/                   
'minimum_usr_company_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Adres Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwa Firmy - admin ****************/                   
'admshow_usr_company_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres Firmy - pokaż w adminie',)),
                     
                      
'sep'.$i++ => array('type' => 'separator'),

 /************ Nazwa Firmy ****************/ 
   
'usr_company_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy Firmy',)),

/************ Nazwa Firmy - wymagane ****************/                   
'required_usr_company_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy Firmy - wymagane',)),
                       
/************ Nazwa Firmy - minimalna długość ****************/                   
'minimum_usr_company_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Kod pcoztowy Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Nazwa Firmy - admin ****************/                   
'admshow_usr_company_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy Firmy - pokaż w adminie',)),
                     
                      
'sep'.$i++ => array('type' => 'separator'),

 /************ Miasto Firmy ****************/ 
   
'usr_company_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto Firmy',)),

/************ Miasto Firmy - wymagane ****************/                   
'required_usr_company_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto Firmy - wymagane',)),
                       
/************ Miasto Firmy - minimalna długość ****************/                   
'minimum_usr_company_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Miasto Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Miasto Firmy - admin ****************/                   
'admshow_usr_company_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto Firmy - pokaż w adminie',)),
                     
                      
'sep'.$i++ => array('type' => 'separator'),

 /************ Województwo Firmy ****************/ 
   
'usr_company_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo Firmy',)),

/************ Województwo Firmy - wymagane ****************/                   
'required_usr_company_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo Firmy - wymagane',)),
                       
/************ Województwo Firmy - minimalna długość ****************/                   
'minimum_usr_company_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Województwo Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Województwo Firmy - admin ****************/                   
'admshow_usr_company_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo Firmy - pokaż w adminie',)),
'sep'.$i++ => array('type' => 'separator'),

 /************ E-mail Firmy ****************/ 
   
'usr_company_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail Firmy',)),

/************ E-mail Firmy - wymagane ****************/                   
'required_usr_company_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail Firmy - wymagane',)),
                       
/************ E-mail Firmy - minimalna długość ****************/                   
'minimum_usr_company_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'E-mail Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ E-mail Firmy - admin ****************/                   
'admshow_usr_company_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail Firmy - pokaż w adminie',)),
'sep'.$i++ => array('type' => 'separator'),

 /************ WWW Firmy ****************/ 
   
'usr_company_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'WWW Firmy',)),

/************ WWW Firmy - wymagane ****************/                   
'required_usr_company_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'WWW Firmy - wymagane',)),
                       
/************ WWW Firmy - minimalna długość ****************/                   
'minimum_usr_company_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'WWW Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ WWW Firmy - admin ****************/                   
'admshow_usr_company_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'WWW Firmy - pokaż w adminie',)),
'sep'.$i++ => array('type' => 'separator'),

 /************ Tel Firmy ****************/ 
   
'usr_company_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel Firmy',)),

/************ Tel Firmy - wymagane ****************/                   
'required_usr_company_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel Firmy - wymagane',)),
                       
/************ Tel Firmy - minimalna długość ****************/                   
'minimum_usr_company_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Tel Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Tel Firmy - admin ****************/                   
'admshow_usr_company_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel Firmy - pokaż w adminie',)),
'sep'.$i++ => array('type' => 'separator'),

 /************ Fax Firmy ****************/ 
   
'usr_company_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax Firmy',)),

/************ Fax Firmy - wymagane ****************/                   
'required_usr_company_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax Firmy - wymagane',)),
                       
/************ Fax Firmy - minimalna długość ****************/                   
'minimum_usr_company_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Fax Firmy - minimalna długość',
                       'STYLE' => 'width: 50px;')),

/************ Fax Firmy - admin ****************/                   
'admshow_usr_company_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax Firmy - pokaż w adminie',)),
                     
                      
'sep'.$i++ => array('type' => 'separator'),
								
 /************ Adres ****************/ 
   
'usr_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres',)),

/************ Adres - wymagane ****************/                   
'required_usr_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres - wymagane',)),
                       
/************ Adres - minimalna długość ****************/                   
'minimum_usr_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Adres - minimalna długość',
                       'STYLE' => 'width: 50px;')),

'admshow_usr_address' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Adres - pokaż w adminie',)),
                     
              
                       
'sep'.$i++ => array('type' => 'separator'),
								
 /************ Dzielnica ****************/ 
   
'usr_suburb' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Dzielnica',)),

/************ Dzielnica - wymagane ****************/                   
'required_usr_suburb' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Dzielnica - wymagane',)),
                       
/************ Dzielnica - minimalna długość ****************/                   
'minimum_usr_suburb' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Dzielnica - minimalna długość',
                       'STYLE' => 'width: 50px;')),

'admshow_usr_suburb' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Dzielnica - pokaż w adminie',)),
                     
     
                      
'sep'.$i++ => array('type' => 'separator'),
								
 /************ Miasto ****************/ 
   
'usr_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto',)),

/************ Miasto - wymagane ****************/                   
'required_usr_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto - wymagane',)),
                       
/************ Miasto - minimalna długość ****************/                   
'minimum_usr_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Miasto - minimalna długość',
                       'STYLE' => 'width: 50px;')),
  
'admshow_usr_city' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Miasto - pokaż w adminie',)),
                     
   	
	                     
'sep'.$i++ => array('type' => 'separator'),

/************ Kod pocztowy ****************/ 	
   
'usr_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy',)),

/************ Kod pocztowy - wymagane ****************/                   
'required_usr_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy - wymagane',)),
                       
/************ Kod pocztowy - minimalna długość ****************/                   
'minimum_usr_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Kod pocztowy - minimalna długość',
                       'STYLE' => 'width: 50px;')),
     
'admshow_usr_post_code' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kod pocztowy - pokaż w adminie',)),
                     
		                  
'sep'.$i++ => array('type' => 'separator'),
 
 /************ Województwo ****************/ 
                       
'usr_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo',)),

/************ Województwo - wymagane ****************/                   
'required_usr_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo - wymagane',)),
                       
/************ Województwo - minimalna długość ****************/                   
'minimum_usr_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Województwo - minimalna długość',
                       'STYLE' => 'width: 50px;')),
  
'admshow_usr_state' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Województwo - pokaż w adminie',)),
  
	                     
'sep'.$i++ => array('type' => 'separator'),								
								
								
 /************ Kraj ****************/ 
                       
'usr_country' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kraj',)),

/************ Kraj - wymagane ****************/                   
'required_usr_country' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kraj - wymagane',)),
                       
/************ Kraj - minimalna długość ****************/                   
'minimum_usr_country' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Kraj - minimalna długość',
                       'STYLE' => 'width: 50px;')),
								
'admshow_usr_country' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Kraj - pokaż w adminie',)),
  
	            
	                    
'sep'.$i++ => array('type' => 'separator'),                       

/************ E-mail ****************/ 
                       
'usr_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail',)),

/************ E-mail - wymagane ****************/                   
'required_usr_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail - wymagane',)),
                       
								
'admshow_usr_email' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'E-mail - pokaż w adminie',)),
                        
'sep'.$i++ => array('type' => 'separator'),
                       
/************ Telefon ****************/ 
                       
'usr_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Telefon',)),

/************ Telefon - wymagane ****************/                   
'required_usr_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Telefon - wymagane',)),
                       
/************ Telefon - minimalna długość ****************/                   
'minimum_usr_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Telefon - minimalna długość',
                       'STYLE' => 'width: 50px;')),

'admshow_usr_phone' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Telefon - pokaż w adminie',)),
                        
                       
'sep'.$i++ => array('type' => 'separator'), 
                       
/************ Fax ****************/ 
                       
'usr_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax',)),

/************ Fax - wymagane ****************/                   
'required_usr_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax - wymagane',)),
                       
/************ Fax - minimalna długość ****************/                   
'minimum_usr_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Fax - minimalna długość',
                       'STYLE' => 'width: 50px;')),
 
'admshow_usr_fax' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Fax - pokaż w adminie',)),
                        
   
                       
'sep'.$i++ => array('type' => 'separator'), 
                       
/************ Tel. kom. ****************/ 
                       
'usr_mobile' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel. kom.',)),

/************ Tel. kom. - wymagane ****************/                   
'required_usr_mobile' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel. kom. - wymagane',)),
                       
/************ Tel. kom - minimalna długość ****************/                   
'minimum_usr_mobile' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Tel. kom. - minimalna długość',
                       'STYLE' => 'width: 50px;')),
    
'admshow_usr_mobile' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tel. kom. - pokaż w adminie',)),
                        
  	 
	                    
'sep'.$i++ => array('type' => 'separator'), 
                       
/************ Strona www ****************/ 
                       
'usr_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Strona www',)),

/************ Strona www - wymagane ****************/                   
'required_usr_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Strona www - wymagane',)),

'admshow_usr_www' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Strona www - pokaż w adminie',)),
                        
  
								
'sep'.$i++ => array('type' => 'separator'), 
/************ Gadu-Gadu ****************/ 
                       
'usr_gg' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Gadu-Gadu',)),

/************ Gadu-Gadu - wymagane ****************/                   
'required_usr_gg' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Gadu-Gadu - wymagane',)),                       

'admshow_usr_gg' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Gadu-Gadu - pokaż w adminie',)),
                        
  
									
								
'sep'.$i++ => array('type' => 'separator'), 
/************ Tlen ****************/ 
                       
'usr_tlen' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tlen',)),

/************ Tlen - wymagane ****************/                   
'required_usr_tlen' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tlen - wymagane',)), 

'admshow_usr_tlen' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tlen - pokaż w adminie',)),
                        
  
	
'sep'.$i++ => array('type' => 'separator'), 
/************ ICQ ****************/ 
                       
'usr_icq' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'ICQ',)),

/************ ICQ - wymagane ****************/                   
'required_usr_icq' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'ICQ - wymagane',)),

'sep'.$i++ => array('type' => 'separator'),
/************ Skype ****************/ 
                       
'usr_skype' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Skype',)),

/************ Skype - wymagane ****************/                   
'required_usr_skype' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Skype - wymagane',)),
 
'admshow_usr_skype' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Skype - pokaż w adminie',)),
                        
   
                       
'sep'.$i++ => array('type' => 'separator'),
/************ Inny kontakt ****************/ 
                       
'usr_other_contact' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Inny kontakt',)),

/************ Inny kontakt - wymagane ****************/                   
'required_usr_other_contact' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Inny kontakt - wymagane',)),

'admshow_usr_other_contact' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Inny kontakt - pokaż w adminie',)),
                        
 
		 						
'sep'.$i++ => array('type' => 'separator'),  

'admshow_usr_password' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Hasło - pokaż w adminie',)),
				
'admshow_usr_groups' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Grupy - pokaż w adminie',)),			
			  	
								        
'sep'.$i++ => array('type' => 'separator'),
											
'usr_image' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Zdjęcie',)),
								
'admshow_usr_image' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Zdjęcie - pokaż w adminie',)),
                        
  								
'sep'.$i++ => array('type' => 'separator'),  



             
/************ Zgoda na przetwarzanie danych osobowych ****************/ 
                       
'usr_data_manage' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Zgoda na przetwarzanie danych osobowych',)),

/************ Zgoda na przetwarzanie danych osobowych - wymagane ****************/                   
'required_usr_data_manage' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Zgoda na przetwarzanie danych osobowych - wymagane',)),
'sep'.$i++ => array('type' => 'separator'),                       
/************ Akceptacja warunków użytkowania ****************/ 
                       
'usr_terms_agree' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Akceptacja warunków użytkowania',)),

/************ Akceptacja warunków użytkowania - wymagane ****************/                   
'required_usr_terms_agree' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Akceptacja warunków użytkowania - wymagane',)))
             
                      ); 
                      
unset($mod_content_manager);
?>