<?php 

if( wt_is_valid($params['cID'], 'int', '0') ) {
$menu_data[] = array('name' => 'dodaj',
										 'href' => wt_href_link('mod_catalog2_manager', '', 't=addItem&cID=' . $params['cID']),
										 'action_form_large' => true,
										 'awt' => 'Nowy wpis',
										 'ico' => 'add_content'  );	
}  
?>