<?php 
$mod_structure_manager = wt_module::singleton('mod_structure_manager');
/************ Strona kategorii ****************/ 
$parameters[] = array('name' => 'Podstawowe ustawienia',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(

'get_children' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('1' => 'tak', '0' => 'nie'),
                       'LABEL' => 'Pobieraj dzieci',)),
										 
'get_recursive' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobierz dzieci rekursywnie',)),
								
'split_children' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Dziel dzieci na strony',)),
								
'add_to_breadcrumb' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('1' => 'tak', '0' => 'nie'),
                       'LABEL' => 'Dodaj do nawigacji (__navigationBar__)',)),
																							                      
'children_limit' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
							 'STYLE' => 'width: 75px;',
                      'LABEL' => 'Ilość dzieci',)),
							 
'list_only_children' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
												
'form_fields' => array('TYPE' => 'select',
                      'VALUE' => '',
                      'OPTIONS' => $mod_structure_manager->get_items_type_for_form(),
                      'MULTIPLE' => 1,
                      'SIZE' => '10',
                      'LABEL' => 'Na strony dziel tylko',)),
							 
'sort_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('si.sort_order' => 'Kolejność',
							  							'si.date_added' => 'Data dodania', 
							  							'RAND()' => 'Losowo', 	
														'sid.hits' => 'Popularność',
														'sid.it_name' => 'Nazwa',
														'sid.it_name_short' => 'Nazwa skrócona',
														'sid.it_desc' => 'Opis',
														'sid.it_logo' => 'Ma logo', 
														'' => 'BRAK - używane przeważnie z ID pola', ),
                       'LABEL' => 'Sortowanie',)),
	
'sort_order_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('ASC' => 'A => Z',
														'DESC' => 'Z => A'),
                       'LABEL' => 'Kolejność',)),		

'sort_order_type' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('' => 'nie konwertuj',
							  							'CHAR' => 'CHAR',
							  							'DATE' => 'DATE', 
							  							'DATETIME' => 'DATETIME', 	
														'DECIMAL' => 'DECIMAL',
														'TIME' => 'TIME',
														'UNSIGNED' => 'UNSIGNED'),
                       'LABEL' => 'Konwertuj sortowanie na',)),
								
'sort_order_fi_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
							 'STYLE' => 'width: 75px;',
                      'LABEL' => 'ID pola sortowania',)),
							 
'sort_order_fi_id_desc' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('ASC' => 'A => Z',
														'DESC' => 'Z => A'),
                       'LABEL' => 'Kolejność pola sortowania',)),						 
 	
'sort_order_fi_id_type' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('' => 'nie konwertuj',
							  							'CHAR' => 'CHAR',
							  							'DATE' => 'DATE', 
							  							'DATETIME' => 'DATETIME', 	
														'DECIMAL' => 'DECIMAL',
														'TIME' => 'TIME',
														'UNSIGNED' => 'UNSIGNED'),
                       'LABEL' => 'Konwertuj sortowane pole na',)),
	
							
'get_childrencat' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
							  'VALUE' => '0',	
                       'OPTIONS' => array('1' => 'tak', '0' => 'nie'),
                       'LABEL' => 'Pobieraj dzieci w kategoriach',)),
										 
'get_childrencat_recursive' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobierz dzieci w kategoriach rekursywnie',)),
  							 
'childrencat_types' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
												
'form_fields' => array('TYPE' => 'select',
                      'VALUE' => '',
                      'OPTIONS' => $mod_structure_manager->get_items_type_for_form(),
                      'MULTIPLE' => 1,
                      'SIZE' => '10',
                      'LABEL' => 'Pobierz dzieci w kategoriach tylko',)),
							 
'childrencat_sort_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('si.sort_order' => 'Kolejność',
							  							'si.date_added' => 'Data dodania', 
							  							'RAND()' => 'Losowo', 	
														'sid.hits' => 'Popularność',
														'sid.it_name' => 'Nazwa',
														'sid.it_desc' => 'Opis',
														'sid.it_logo' => 'Ma logo', ),
                       'LABEL' => 'Sortowanie',)),
	
'childrencat_sort_order_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('ASC' => 'A => Z',
														'DESC' => 'Z => A'),
                       'LABEL' => 'Kolejność',)),						
							 
),                      
                      
);
			
?>