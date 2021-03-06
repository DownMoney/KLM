<?php 


$mod_advertise_manager = wt_module::singleton('mod_advertise_manager');

$Gparams = array();
$Gparams['add_id'] = true;

$Aparams = array();
$Aparams['add_id'] = true;

/************ Blok ****************/ 
$parameters[] = array('name' => '',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
                   
/************ Strony do wyświetlenia ****************/                      
'groups' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                      'VALUE' => '',
                      'MULTIPLE' => 1,
                      'SIZE' => 10,
                      'OPTIONS' => $mod_advertise_manager->get_groups_for_form($Gparams),
                      'LABEL' => 'Grupy do wyświetlenia',)),


/************ Strony do wyświetlenia ****************/                      
'advertise' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                       'VALUE' => '',
                       'MULTIPLE' => 1,
                       'SIZE' => 10,
                       'OPTIONS' => $mod_advertise_manager->get_advertises_for_form($Aparams),
                      'LABEL' => 'Lub wybrane reklamy',)),
                  
'no_of_advertise' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Ilość wyświetlanych reklam',
                       'STYLE' => 'width: 50px;')),              

'advertise_per_row' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'text',
                       'VALUE' => '',
                       'LABEL' => 'Reklam w rzędzie',
                       'STYLE' => 'width: 50px;'))),                             
                             );

unset($mod_advertise_manager);										 
?>
