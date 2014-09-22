<?php 
if (($params['m'] == '' ) || ($params['m']=='configuration')){
	$menu_data[] = array('name' => 'dodaj',
						 'href' => wt_href_link('mod_configuration_manager', '', 'm=configuration&t=addConfiguration'),
						 'action_form_large' => true,
						 'awt' => 'Nowy wpis',
						 'ico' => 'add_content'  );
}
?>