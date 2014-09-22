<?php 

/************ Strona kategorii ****************/ 
$parameters[] = array('name' => '',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
'fi_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ID pola galerii',)),	
							 
'it_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ID galerii',)),
							 
'parent_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'parent_id',)),							 
				                       
'cPath' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'LABEL' => 'cPath',)),
												
												
'limit' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ilość',)),
							 
'random' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobieraj losowo',))
                 ),
								 									 );								 
?>