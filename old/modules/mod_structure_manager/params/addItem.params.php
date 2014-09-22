<?php 

global $wt_template;
$it_type = $GLOBALS['it'];
$theme_params = array();
$theme_params['mod'] = 'mod_structure';
$itemPage_theme = $wt_template->get_item_theme_files('itemPage_'.$it_type, $theme_params);
$itemList_theme = $wt_template->get_item_theme_files('itemList_'.$it_type, $theme_params);
if( wt_is_valid($itemPage_theme['default']['files'], 'array', 1) || wt_is_valid($itemList_theme['default']['files'], 'array', 1) ) {

$item_params = array('mod' => 'mod_structure',
						       'id' => 'i_theme',
                         'for_form' => (bool)true);


/************ Strona wpisu ****************/ 
$parameters[] = array('name' => 'Ustawienia strony wpisu',
										 'desc' => 'Ustawienia strony wpisu.',
										 'image' => '',
										 'icon' => '',
										 'id' => 'aRff',
										 'params' => array(
					
'itemPage_theme' => array('desc' => '',
					'info_icon' => '',
					'warning_message' => '',
					'tip_message' => '',
					'special' => 'theme',
					'values' => $itemPage_theme,
					)));
$parameters[] = array('name' => 'Ustawienia wpisu na liście',
					'desc' => 'Ustawienia wpisu na liś.',
					 'image' => '',
					 'icon' => '',
					 'id' => 'aRff',
					 'params' => array(	
'itemList_theme' => array('desc' => '',
					'info_icon' => '',
					'warning_message' => '',
					'tip_message' => '',
					'special' => 'theme',
					'values' => $itemList_theme
				)
                         
));			
		  }					 
?>