<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="right">
<br />

<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="lID|t|m" parameters="m=menus&mID=`$smarty.get.mID`"}'" value="&laquo; wstecz">
{wt_check_permission perm_key="link_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="lID|t|m" parameters="m=links&t=addLink"}'" value="dodaj &raquo;">
{/wt_check_permission}

&nbsp;
<br /><br />
</td>
</tr>
<tr>
<td>

<table class="dT">
<tr class="dTH">
<td>Nazwa</td>
<td align="center">Typ</td>
<td align="center">Status</td>
<td align="center">Kolejność</td>
<td align="right">Opcje</td>
</tr>
{foreach item=ln from=$links_listing name="links_listing"}

<tr class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'">

<td>{if $ln.link_type == "separator"}{$ln.link_name}<em>SEPARATOR</em>{elseif $ln.link_type == "header"}<strong>{$ln.link_name}</strong>{else}{$ln.link_name}{/if}</td>

{assign var="status_id" value=$ln.status_text.id}
{assign var="status_icon" value=$ln.status_text.icon}
{assign var="status_text" value=$ln.status_text.text}
{assign var="change_to" value=$ln.status_text.change_to}
{assign var="date_up" value=$ln.date_up|default:"Natychmiast"}
{assign var="date_down" value=$ln.date_down|default:"Nigdy"}
<td align="center">
{$ln.type_text}
</td> 

<td align="center">
 
{wt_check_permission perm_key="link_activ"}

<a href="{wt_href_tpl_link get_params="lID|t|a|m|status" parameters="&m=links&lID=`$ln.link_id`&a=setLinkStatus&status=`$change_to`"}">
{/wt_check_permission}
<img border="0" src="{$__imageRoot__}/{$status_icon}" width="12" height="12" {popup caption="$status_text" text="<b>`$smarty.const.TEXT_DATE_UP`:</b> <br>&nbsp;$date_up <br><b>`$smarty.const.TEXT_DATE_DOWN`:</b> <br>&nbsp;$date_down"}>
{wt_check_permission perm_key="link_activ"}
</a>
{/wt_check_permission}
</td>

<td style="text-align: center;">
 
{if $smarty.foreach.links_listing.total > 1}

{if $smarty.foreach.links_listing.iteration != $count_links}
<a href="{wt_href_tpl_link get_params="lID|a|m|sort|t" parameters="m=links&a=downLinkOrder&lID=`$ln.link_id`&parent_id=`$ln.link_parent_id`&sort=`$ln.sort_order`"}"><img src="{$__imageRoot__}/listing_down_arrow.png" width="12" height="12" alt="przesuń w dół" border="0" /></a>&nbsp;
{/if}{if $ln.sort_order > 1}
<a href="{wt_href_tpl_link get_params="lID|a|m|sort|t" parameters="m=links&a=upLinkOrder&lID=`$ln.link_id`&parent_id=`$ln.link_parent_id`&sort=`$ln.sort_order`"}"><img src="{$__imageRoot__}/listing_up_arrow.png" width="12" height="12" alt="przesuń w górę" border="0" /></a>
{/if}
{else}
---
{/if}
</td>

<td style="text-align: right;">
<a href="{wt_href_tpl_link get_params="lID|t|m" parameters="&m=links&t=addLink&lID=`$ln.link_id`"}" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="{wt_href_tpl_link parameters="a=delLink&lID=`$ln.link_id`&mID=`$ln.menu_id`"}" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń " border="0" width="16" height="16"></a>
</td>

</tr>
{/foreach}
</table> 
</td></tr>
<tr class="dTFR">
<td>
Wszystkich linków:{$count_links}
</td>
</tr>
<tr>
<td align="right">
<br />

<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="lID|t|m" parameters="m=menus&mID=`$smarty.get.mID`"}'" value="&laquo; wstecz">
{wt_check_permission perm_key="link_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link get_params="lID|t|m" parameters="m=links&t=addLink"}'" value="dodaj &raquo;">
{/wt_check_permission}

&nbsp;</td>
</tr>
</table>