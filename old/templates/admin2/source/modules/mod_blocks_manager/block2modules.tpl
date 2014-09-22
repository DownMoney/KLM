<table width="100%" cellpadding="0" cellspacing="0">
<tr><td align="right">
<br />

{wt_check_permission perm_key="pg_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link parameters="m=blocks&t=addBlockToModule"}'" value="dodaj blok &raquo;">
{/wt_check_permission}
&nbsp;
<br />
<br />

</td>
</tr>
<tr><td>
<table class="dT">
<tr class="dTH">
<td width="20">#</td>
<td>Nazwa</td>
<td>Tytuł</td>
<td align="center">Status</td>
<td align="center">Kolumna</td>
<td align="center">Kolejność</td>
<td align="right">Opcje</td>
</tr>

{*******************		STRONY   	*****************************}

{foreach item=b2m from=$blocks_listing name=blocks_listing}

<tr class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'">

<td width="40"><nobr><img src="{$__imageRoot__}/doc.png" width="16" height="16" align="absmiddle" alt="" />&nbsp;[{$b2m.btm_id|default:"&nbsp"}]</nobr></td>
<td>{$b2m.block_name|default:"---"}</td>
<td>{$b2m.bd_title|default:"---"}</td>

{assign var="status_id" value=$b2m.status_text.id}
{assign var="status_icon" value=$b2m.status_text.icon}
{assign var="status_text" value=$b2m.status_text.text}
{assign var="change_to" value=$b2m.status_text.change_to}
{assign var="date_up" value=$b2m.date_up|default:"Natychmiast"}
{assign var="date_down" value=$b2m.date_down|default:"Nigdy"}


<td align="center">
 
{wt_check_permission perm_key="b2m_activ"}

<a href="{wt_href_tpl_link get_params="btmID|t|a|m|status" parameters="m=blocks&a=setb2mStatus&btmID=`$b2m.btm_id`&status=`$change_to`"}">
{/wt_check_permission}
<img border="0" src="{$__imageRoot__}/{$status_icon}" width="12" height="12">
{wt_check_permission perm_key="b2m_activ"}
</a>
{/wt_check_permission}
</td>
{assign var="column" value=$b2m.btm_column}

<td align="center">{$b2m.btm_column}</td>

<td align="center">
 {$b2m.sort_order} 
</td>

<td align="right">
<a href="{wt_href_tpl_link get_params="btmID|t|m" parameters="m=blocks&t=addBlockToModule&btmID=`$b2m.btm_id`"}" title=" edytuj blok "><img src="{$__imageRoot__}/edit.png" alt=" edytuj blok " width="16" height="16" border="0"></a>

<a href="{wt_href_tpl_link get_params="btmID|t|m" parameters="m=blocks&t=deleteBlock&btmID=`$b2m.btm_id`"}" title=" usuń blok "><img src="{$__imageRoot__}/trash.png" alt=" usuń blok " width="16" height="16" border="0"></a>

</td>

</tr>
{assign var=cb value=$cb+1}
{/foreach}
</table> 
</td></tr>
<tr class="dTFR">
<td>&nbsp;</td>
</tr> 
<tr><td align="right">
<br />
{wt_check_permission perm_key="pg_add"}
<input type="button" class="ETB" onclick="document.location.href='{wt_href_tpl_link parameters="m=blocks&t=addBlockToModule"}'" value="dodaj blok &raquo;">
{/wt_check_permission}
&nbsp;
</td>
</tr>
</table>