<?php 
if ( (!$params['cPath'] && wt_is_root()) || $params['cPath'] ) {
$mod_structure_manager = wt_module::singleton('mod_structure_manager');
$iID = $mod_structure_manager->current_item_id($params['cPath']);
if( wt_is_valid($iID, 'int', '0') ) {
$it = $mod_structure_manager->get_items($iID);
}

if( (wt_is_valid($it, 'array') && $it['itt_nochildren'] == '0' && ($it['itt_root_addchildren'] == '0' || (wt_is_root() && $it['itt_root_addchildren'] == '1')  )) || (!$params['cPath'] && wt_is_root()) ) {
		$menu_data[] = array('name' => 'dodaj',
												 'href' => wt_href_link('mod_structure_manager', '', 'm=items&t=addItem&cPath='.$params['cPath']),
												 'action_form_large' => true,
												 'awt' => 'Nowy wpis',
												 'ico' => 'add_content',
												 'class' => 'add'  );	
} elseif( $it['itt_nochildren'] == '1' ) {
		$menu_data[] = array('name' => 'edytuj',
												 'href' => wt_href_link('mod_structure_manager', '', 'm=items&t=addItem&cPath='.$it['cPath'].'&iID='.$it['it_id']),
												 'action_form_large' => true,
												 'awt' => 'Edycja wpisu',
												 'ico' => 'add_content'  );	
}

if( wt_is_root() ) {
	 $menu_data[] = array('sep' => true);
	 $menu_data[] = array('name' => 'zarzadzaj typami',
							 'href' => wt_href_link('mod_structure_manager', '', 'm=types'),
							 'action_form_large' => false,
							 'awt' => 'Zarządzaj typami',
							 'ico' => 'switch_mode',
							 'target' => 'mod_content',
							 'type' => 'switch' );
	
												 
	$menu_data[] = array('name' => 'dodaj typ',
												 'href' => wt_href_link('mod_structure_manager', '', 'm=types&t=addType'),
												 'action_form_large' => true,
												 'awt' => 'Nowy typ',
												 'ico' => 'add_content',
												 'class' => 'add');
												 
if ($params['m'] == 'fields') {	
	$menu_data[] = array('sep' => true);
	$menu_data[] = array('name' => 'dodaj pole',
												 'href' => wt_href_link('mod_structure_manager', '', wt_get_all_get_params(array('m','t'),$params).'m=fields&t=addField'),
												 'action_form_large' => true,
												 'awt' => 'Nowe pole',
												 'ico' => 'add_content',
												 'class' => 'add');
}
}
												 
												 
		/*$menu_data[] = array('name' => 'sortuj',
							 'href' => wt_href_link('mod_catalog2_manager', '', 'm=items&t=sortItems&cID=' . $params['cID']),
							 'action_form' => true,
							 'awt' => 'Sortuj',
							 'ico' => 'switch_mode'  );	*/

}
?>