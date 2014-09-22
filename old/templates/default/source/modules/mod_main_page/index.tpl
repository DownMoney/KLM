{php}
global $wt_template;
	$mod_structure = wt_module::singleton('mod_structure');
	$mod_structure->mainPage();
{/php}
{include file="`$__templateFSRoot__`default/source/modules/mod_structure/`$item.page_theme`"}
