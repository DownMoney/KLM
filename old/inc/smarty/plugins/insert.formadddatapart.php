<?php
function smarty_insert_formadddatapart($params, &$smarty)
{
	if(method_exists($smarty,'get_template_vars'))
	{
		$tpl_vars=&$smarty->get_template_vars();
		$form=&$tpl_vars['form'];
	} else {
	$form=&$smarty->_tpl_vars['form'];
	}
	if( is_object($form)  ) {
	$form->AddDataPart($params['data']);
	}
	return '';
}

?>