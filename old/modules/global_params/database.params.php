<?php 
/**
* @package mod_news
* @subpackage mod_news_manager
*/

/************ Strona g³ówna modu³u ****************/ 
$parameters[] = array('name' => 'Ustawienia bazy danych',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
 /************ Tryb cichy ****************/ 
   
'db_us_this_db' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'U¿yj tej bazy danych',)),										 
/************ Host ****************/                   
'db_host' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Host',)),
                       
/************ U¿ytkownik ****************/                   
'db_user' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'U¿ytkownik',)),

/************ Has³o ****************/                   
'db_password' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Has³o',)),
                       
/************ Baza danych ****************/                   
'db_database' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Baza danych',)),
 
/************ Prefiks ****************/                   
'db_prefix' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Prefiks',)),                      
                       
 /************ Tryb cichy ****************/ 
   
'db_silent_mode' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Tryb cichy',)),

 /************ Sta³e po³±czenie ****************/ 
   
'db_persistant' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Sta³e po³±czenie',))),

                             
                             );								 
?>