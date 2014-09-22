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
'starts_from' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',
'form_fields' => array('TYPE' => 'select',
	'OPTIONS' => $mod_structure_manager->get_items_tree_for_form(),
	'LABEL' => 'Zacznij od',)
	),

'types_only' => array('desc' => '',
'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
	'MULTIPLE' => 1,
	'SIZE' => 5,
	'OPTIONS' => $mod_structure_manager->get_items_type_for_form(),
	'LABEL' => 'Typy',)
	),

'types_without' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
	'MULTIPLE' => 1,
	'SIZE' => 5,
	'OPTIONS' => $mod_structure_manager->get_items_type_for_form(),
	'LABEL' => 'Typy bez',)
	),

'get_hl' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
	'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
	'LABEL' => 'Pobieraj najwyższy poziom',)),

'hl_is' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
	'LABEL' => 'Najwyższy poziom to:',)),

'get_rest' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
	'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
	'LABEL' => 'Pobieraj pozostałe z najwyższego poziomu',)),

'no_of_flat_levels' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
	'STYLE' => 'width: 50px;',
	'LABEL' => 'poziom zagłębienia',)),

'include_parent' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
	'OPTIONS' => array('0' => 'nie', '1' => 'tak'),
	'LABEL' => 'Uwzględniaj nadrzędną',)),

'limit' => array('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
	'LABEL' => 'limit',),

	),

'sort_order' => array ('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array (
	'TYPE' => 'select',
	'OPTIONS' => array('si.date_added' => 'Data dodania',
	'RAND()' => 'Losowo',
	'sid.hits' => 'Popularność',
	'si.sort_order' => 'Kolejność',
	'sid.it_name' => 'Nazwa',
	'sid.it_desc' => 'Opis',
	'sid.it_logo' => 'Ma logo',
	'sid.it_logo_large' => 'Ma logo duże', ),
	'LABEL' => 'Sortowanie',)
	),

'sort_order_desc' => array ('desc' => '',
	'info_icon' => '',
	'warning_message' => '',
	'tip_message' => '',

'form_fields' => array (
	'TYPE' => 'select',
	'OPTIONS' => array(
	'ASC' => 'A => Z',
	'DESC' => 'Z => A', ),
	'LABEL' => 'Kolejność',)
	),

),







);

?>