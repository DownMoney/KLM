<?php 

$si = 0;

$mod_structure_manager = wt_module::singleton('mod_structure_manager');


/************ Strona kategorii ****************/ 
$parameters[] = array('name' => '',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
										 
/************ Ilość wyświetlanych produktów ****************/                   
'from' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => $mod_structure_manager->get_items_tree_for_form(array('id_type' => 'cPath')),
                       'LABEL' => 'Pobierz z',)),
								
'get_recursive' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobieraj zagłębiając się',)),														
'types_only' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
							  'MULTIPLE' => 1,
							  'SIZE' => 5,		
                       'OPTIONS' => $mod_structure_manager->get_items_type_for_form(),
                       'LABEL' => 'Typy',)),
				                       
'limit' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ilość',)),
							 
'sort_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('si.date_added' => 'Data dodania', 
							  							'RAND()' => 'Losowo', 	
														'sid.hits' => 'Popularność',
							  							'si.sort_order' => 'Kolejność',
														'sid.it_name' => 'Nazwa',
														'sid.it_desc' => 'Opis',
														'sid.it_logo' => 'Ma logo',
														'sid.it_logo_large' => 'Ma logo duże',
														'order_fi_id' => 'Według ID pola', ),
                       'LABEL' => 'Sortowanie',)),
							  	
'order_fi_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ID pola do sortowania',)),
							 	
'sort_order_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('DESC' => 'Z => A', 
							  							'ASC' => 'A => Z'),
                       'LABEL' => 'Kolejność',)),							

'get_fields' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobierz pola',)),
								
'fi_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'ID pola do warunku pobrania',)),

'fi_value' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'STYLE' => 'width: 50px;',
                      'LABEL' => 'wartość pola',)),
						 
),
								 									 );								 
?>