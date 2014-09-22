<script type="text/javascript" src="{$__jsRoot__}/JSCookMenu.js">
</script>
<link rel="stylesheet" href="{$__mediaRoot__}/jsCookMenu/ThemeOffice/theme.css" type="text/css">
<script type="text/javascript" src="{$__mediaRoot__}/jsCookMenu/ThemeOffice/theme.js"></script>

</script>

<script language="JavaScript" type="text/javascript">
	var adminMenu = 
	[
	{defun name="JSCookMenu" list=$block_menu_tree}
	{foreach item=link from=$list}
	{if $link.type == "separator"}
	_cmSplit,
	{else} 
	['{if $link.icon_left}<img src="{$__imageRoot__}/icons/{$link.icon_left}" alt=" {$link.name} " width="16" height="16">{/if}', '{$link.name}', '{if $link.type == "mod_link"}javascript:loadModule(\'{wt_mod_id m=$link.module}\', \'{$link.name}\');{elseif $link.type == "outside_link"}{$link.link}{elseif $link.type == "javascript"}javascript:{$link.link}{/if}', '', '' {if $link.children}, {fun name="JSCookMenu" list=$link.children} ], {else} ], {/if}
	{/if}
	{/foreach}
	{/defun}
	{if $__isRoot__}
	, ['<img src="{$__imageRoot__}/root_view.gif" width="16" height="16">', '', '', '', '', ['', 'Bloki', 'javascript:loadModule("{wt_mod_id m=mod_blocks_manager}", "Bloki");'], ['', 'Moduły', 'javascript:loadModule("{wt_mod_id m=mod_modules_manager}", "Moduły");'], ['', 'Menu', 'javascript:loadModule("{wt_mod_id m=mod_menu_manager}", "Menu");'], ['', 'Konfiguracja', 'javascript:loadModule("{wt_mod_id m=mod_configuration_manager}", "Konfiguracja");'], ['', 'Użytkownicy', 'javascript:loadModule("{wt_mod_id m=mod_user_manager}", "Użytkownicy");'] ]
	{/if}
	];

</script>

<div id="adminMenu">
</div>

<script type="text/javascript">
	cmDraw ('adminMenu', adminMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
</script>