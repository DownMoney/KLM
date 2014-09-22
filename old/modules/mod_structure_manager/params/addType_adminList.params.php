<?php 
		
$parameters[] = array('name' => 'Lista w adminie',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(

/************************************************/	 
'adminList_show_logo' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'logo - pokaż')),
/************************************************/	 
'adminList_show_it_name' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_name - pokaż')), 
/************************************************/	 
'adminList_it_desc_short' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_desc_short - pokaż')),

'itemAdd_it_desc_short_lenght' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '150',
                      'LABEL' => 'it_desc_short - długość',)),
/************************************************/	 
'adminList_show_languages' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'pokąz ikonki języków')),
/************************************************/	
'adminList_it_type' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_type - pokaż')),
/************************************************/	 
'adminList_sort_order' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'sort_order - pokaż')),
/************************************************/	 
'adminList_status' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'status - pokaż')),
/************************************************/	 
'adminList_date_added' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'data dodania - pokaż')),
/************************************************/	 
'adminList_date_publish' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'data publikacji - pokaż')),
							
/************************************************/	 
'adminList_options' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'options - pokaż')),

/************************************************/	 
'adminList_fields' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'textarea',
							  'COLS' => 30,
							  'ROWS' => 10,		
                       'LABEL' => 'pola na liście (klucz pola=nazwa pola)')),
	
							
/************************************************/	 
'adminList_current_item' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'current item - pokaż')),
/************************************************/	 
'adminList_count_children' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Licz dzieci w dzieciach')),	
/************************************************/	 
'adminList_get_fields' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '-1',
                       'OPTIONS' => array('-1' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Pobierz pola')),	
/************************************************/	 
'adminList_default_where' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'textarea',
							  'COLS' => 30,
							  'ROWS' => 10,		
                       'LABEL' => 'domyślne $params[where]')),
	
/************************************************/	 
'adminList_no_parent_in_where' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'checkbox',
                       'LABEL' => 'no_parent_in_where')),
/************************************************/	
'adminList_order_manual' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'LABEL' => 'Sortowanie ręczne $params[order]',)),
								
'adminList_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('si.sort_order' => 'Kolejność',
							  							'si.date_added' => 'Data dodania', 
							  							'publish_date' => 'Data publikacji', 
							  							'si.last_modified' => 'Ostatnia modyfikacja', 
							  							'RAND()' => 'Losowo', 	
														'sid.hits' => 'Popularność',
														'sid.it_name' => 'Nazwa',
														'sid.it_desc' => 'Opis',
														'sid.it_logo' => 'Ma logo', 
														'' => 'BRAK - używane przeważnie z ID pola', ),
                       'LABEL' => 'Sortowanie',)),
	
'adminList_order_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('ASC' => 'A => Z',
														'DESC' => 'Z => A'),
                       'LABEL' => 'Kolejność',)),		

'adminList_order_type' => array('desc' => '',
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
								
'adminList_field_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',
'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
							 'STYLE' => 'width: 75px;',
                      'LABEL' => 'ID pola sortowania',)),
							 
'adminList_field_order_desc' => array('desc' => '',	
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'OPTIONS' => array('ASC' => 'A => Z',
														'DESC' => 'Z => A'),
                       'LABEL' => 'Kolejność pola sortowania',)),						 
 	
'adminList_field_order_type' => array('desc' => '',
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
/************************************************/	 

'adminList_item_list_theme' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
						     'VALUE' => '',
                       'LABEL' => 'plik do list (item_***.tpl)')),	/************************************************/	 
'adminList_item_add_theme' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
						     'VALUE' => '',
                       'LABEL' => 'plik do edycji/dodawania (addItem_***.tpl)')),	
								
/************************************************/	 
'adminList_item_current_theme' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
						     'VALUE' => '',
                       'LABEL' => 'plik bieżącego elementu (currentItemInfo_***.tpl)')),	
								
/************************************************/	 
'adminList_item_info_theme' => array('desc' => '',
									      'info_icon' => '',
											'warning_message' => '',
											'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
						     'VALUE' => '',
                       'LABEL' => 'plik informacji (itemInfo_***.tpl)')),			
							
),                      
                      
);
			
?>