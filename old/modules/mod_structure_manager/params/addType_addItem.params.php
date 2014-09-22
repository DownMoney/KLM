<?php 
		
$parameters[] = array('name' => 'Definicja pól w adminie',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(

	 
'itemAdd_it_name_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_name - label',)),

/************************************************/	 
'itemAdd_it_name_short' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_name_short - pokaż')),
								
'itemAdd_it_name_short_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_name_short - label',)),
							 
/************************************************/							 
'itemAdd_tags' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'tags - pokaż')),
								
'itemAdd_tags_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'tags - label',)),
							 
/************************************************/							 
'itemAdd_it_desc_short' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_desc_short - pokaż')),
								
'itemAdd_it_desc_short_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_desc_short - label',)),
							 
/************************************************/							 
'itemAdd_it_desc' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_desc - pokaż')),
								
'itemAdd_it_desc_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_desc - label',)),
							 
/************************************************/							 
'itemAdd_it_logo' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_logo - pokaż')),
								
'itemAdd_it_logo_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_logo - label',)),
							 
/************************************************/							 
'itemAdd_it_logo_large' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'it_logo_large - pokaż')),
								
'itemAdd_it_logo_large_label' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                      'VALUE' => '',
                      'LABEL' => 'it_logo_large - label',)),
							 
/************************************************/							 
'itemAdd_status' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'publikacja - pokaż')), 

/************************************************/							 
'itemAdd_dateupdown' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'data zakończenia i rozpoczęcia - pokaż')), 
								
/************************************************/							 
'itemAdd_parent_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'nadrzędny element')), 
														 
/************************************************/							 
'itemAdd_meta' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'meta - pokaż')), 
/************************************************/						
'itemAdd_sort_order' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1000000',
                       'OPTIONS' => array('-1000' => 'na początku', '1000000' => 'na końcu'),
                       'LABEL' => 'dodawaj nowe pliki w kolejności')), 
								
/************************************************/		
					 
'autoAddChildren' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '0',
                       'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
                       'LABEL' => 'Dodaj dzieci automatycznie')), 
				
'autoAddedName' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'textarea',
                       'VALUE' => '',
                       'LABEL' => 'Nazwa podczas automatycznego tworzenia (nowa linia = nowy wpis)')),	

'autoAddedStatus' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '1',
                       'OPTIONS' => array('0' => 'nie aktywny', '1' => 'aktywny'),
                       'LABEL' => 'Status podczas automatycznego tworzenia')), 
								
'autoAddedSortOrder' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Kolejność podczas automatycznego tworzenia')),							
							
),                      
                      
);
			
?>