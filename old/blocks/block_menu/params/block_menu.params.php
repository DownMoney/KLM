<?php 
/**
* @package mod_Cgalleries
* @subpackage mod_Cgalleries_manager
*/

$mod_menu_manager = wt_module::singleton('mod_menu_manager');

$params = array();
$params['add_blank'] = true;

/************ Strona galerii ****************/ 
$parameters[] = array('name' => '',
										 'desc' => '',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
                   
/************ Maksymalna szeroko¶䟯brazu ****************/                      
'menu_id' => array('desc' => '',
												'info_icon' => '',
												'warning_message' => '',
												'tip_message' => '',

'form_fields' => array('TYPE' => 'select',
                      'VALUE' => '',
                      'OPTIONS' => $mod_menu_manager->get_menus_for_form($params),
                      'LABEL' => 'Menu do wyświetlenia',
                      'ValidateAsNotEmpty' => 1,
							 'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać menu które ma byś wyświetlane',)))
                             
                             );
										 
?>
