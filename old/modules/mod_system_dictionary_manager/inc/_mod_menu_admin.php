<?php 
if (!isset($params['m']) || $params['m'] == '' || $params['m'] == 'dictionary'){
	$menu_data[] = array('name' => 'dodaj',
						 'href' => wt_href_link('mod_system_dictionary_manager', '', wt_get_all_get_params(array('m','t'),$params).'m=dictionary&t=addDefinition'),
						 'action_form_large' => true,
						 'awt' => 'Nowy wpis',
						 'ico' => 'add_content');
}
?>