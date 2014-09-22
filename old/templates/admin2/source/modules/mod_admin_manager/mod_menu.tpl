<script type="text/javascript"> 
 setAdminMenu = function() {ldelim}
    		   menu = '<table cellspacing="0" cellpadding="0">';
				menu += '<tr>';
			{if $menu_data}
			
			{foreach from=$menu_data item=m name="menu_data"}
			{if $m.sep}
			menu += '<td class="mm_sep">&nbsp;</td>';
			{*{elseif $m.mod_ico}
			menu += '<td class="mm_mod"><a href="{$m.href}">';
			menu += '<img src="{$__imageRoot__}/modules/{$m.ico}.gif"   /><br />';
			menu += '{$m.name}</a>';
			menu += '</td>';*}
			{else}
			menu += '<td{if $m.class} class="{$m.class}"{/if}>';
			menu += '<a href="{$m.href}" {if $m.action_form}onClick="action_form(this.href, \'{$m.awt}\'); return false;" {elseif $m.action_form_large}onClick="action_form_large(this.href, \'{$m.awt}\'); return false;"{/if} {if $m.target}target="{$m.target}"{/if}><span>';
			{if $m.ico}
			menu += '<img src="{$__imageRoot__}/icons/{$m.ico}.gif" align="absmiddle"   />';
			{/if}
			menu += '{$m.name}</span></a>'
			menu += '</td>';
			{/if}
			{/foreach}
			
			{else}
			menu += "<td>nie zdefiniowano menu</td>";
			{/if}
			menu += '</tr>';
    		menu += '</table>';
			{if $admin_mode}
			$('mod_menu_admin').innerHTML = menu;
			{else}
    		$('mod_menu').innerHTML = menu;
			{/if}
			del_progress();
{rdelim}
setAdminMenu();    		
</script>