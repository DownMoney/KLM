<table width="100%">
<tr><td align="right">
{wt_check_permission perm_key="menu_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="mID|t|m" parameters="m=menus&t=addMenu"}'" value="dodaj &raquo;">
{/wt_check_permission}&nbsp;&nbsp;</td>
</tr>
<tr>
<td>

<table class="dT">
<tr class="dTH">
<td>#</td>
<td>Nazwa</td>
<td>Opis</td>
<td align="center">Linków</td>
<td align="right">Opcje</td>
</tr>
{foreach item=mn from=$menu_listing}
 
<tr class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="document.location.href='{wt_href_tpl_link mod_key="mod_menu_manager" parameters="m=links&mID=`$mn.menu_id`"}'">
 
<td width="25"><nobr><img src="{$__imageRoot__}/folder.png" alt="" width="16" height="16" align="absmiddle">&nbsp;[{$mn.menu_id|default:"&nbsp"}]&nbsp;</nobr></td>

<td>{$mn.menu_name|default:"---"}</td>
<td>{$mn.menu_desc|nl2br|default:"---"}</td>
<td align="center">{$mn.count_links|default:"0"}</td>
<td align="right">
<a href="{wt_href_tpl_link get_params="mID|t|m" parameters="m=menus&t=addMenu&mID=`$mn.menu_id`"}" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>

<a href="{wt_href_tpl_link parameters="a=delMenu&mID=`$mn.menu_id`"}" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń " border="0" width="16" height="16"></a>
</td>

</tr>
{/foreach}
</table> 
</td></tr>
<tr class="dTFR">
<td>
Wszystkich menu:{$count_links}
</td>
</tr>
<tr><td align="right">
{wt_check_permission perm_key="menu_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="mID|t|m" parameters="m=menus&t=addMenu"}'" value="dodaj &raquo;">
{/wt_check_permission}&nbsp;&nbsp;</td>
</tr>
</table>