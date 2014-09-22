<?php 
		
$parameters[] = array('name' => 'structure_add',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(

'stradd_default_status' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nieaktywny', '1' => 'aktywny'),
                       'LABEL' => 'domyślny status ')),
								 

'stradd_add_it_name' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj nazwę ')),
 
'stradd_add_it_name_required' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj nazwę - wymagane ')),
								
'stradd_add_tags' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj tagi ')),
								
'stradd_add_tags_required' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj tagi - wymagane ')),
																								
'stradd_add_it_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj opis ')),
								
'stradd_add_it_desc_required' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj opis - wymagane ')),
								

'stradd_add_it_logo' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj logo/zdjęcie ')),
								
'stradd_add_it_logo_required' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'dodaj logo/zdjęcie - wymagane ')),				  
 													                      
'stradd_add_it_logo_maxsize' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
							 'STYLE' => 'width: 75px;',
                      'LABEL' => 'logo/zdjęcie max rozmiar w MB',)),
),                      
                      
);
			
?>