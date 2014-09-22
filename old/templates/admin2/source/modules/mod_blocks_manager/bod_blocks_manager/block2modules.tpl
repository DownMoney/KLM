<table width="100%">
<tr>
<td class="subHeading">Strony wyszukiwania</td>
</tr>
<tr><td valign="top">
<table width="100%" cellpadding="0" cellspacing="0">
{*<tr>
<td colspan="2">
<form action="{wt_href_tpl_link mod_key="mod_products_manager" get_params="cos"}" method="POST" name="adminForm">
&nbsp;&nbsp;{html_image file="$__imageRoot__/arrow_ldr.gif" width="19" height="15"}
<select name="a" onChange="if(this.value != '' && confirm('Czy na pewno chcesz wykonaäŸ¯peracje ?')) submit(this.form);">
<option value="">Zaznaczone:</option>
<option value="massActiv">aktywuj</option>
<option value="massDeactiv">deaktywuj</option>
<option value="massMove">przenieÂ¶</option>
</select>
</td></tr>
<tr><td colspan="2" height="3">{html_image file="$__imageRoot__/pixel_trans.gif" width="1" height="3"}</td></tr>*}
<tr>
<td width="75%" valign="top">

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td>

<table width="100%" cellpadding="2" cellspacing="0">
<tr class="dataTableHeadingRow">
{*<td class="dataTableHeadingContent" width="5">
{assign var=cbAll value=$all_groups_count+$all_specials_count+1}
<input type="checkbox" name="toggle" value="" onClick="checkAll({$cbAll});"></td>*}
<td class="dataTableHeadingContent" width="40">#</td>
<td class="dataTableHeadingContent">Tytu3</td>
<td class="dataTableHeadingContent" align="center">Status</td>
<td class="dataTableHeadingContent" align="center">KolejnoÂ¶äº¯td>
<td class="dataTableHeadingContent" align="center">Kryterii</td>
<td class="dataTableHeadingContent" align="right">Opcje</td>
</tr>

{*******************		STRONY   	*****************************}

{foreach item=pg from=$pages_listing name=pages_listing}
{*<tr class="dataTableRow">
<td rowspan="2" class="dataTableContent2" width="5"><input type="checkbox" id="cb{$cb}" name="sp[]" value="{$pg.pg_id}"></td>
</tr>*}
{if $page.pg_id eq $pg.pg_id}

<tr class="dataTableRowSelected" onmouseover="this.style.cursor='pointer'" onclick="document.location.href='{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=addPage&pID=`$page.pg_id`"}'">

{else}

<tr class="dataTableRow" onmouseover="this.className='dataTableRowOver';this.style.cursor='pointer'" onmouseout="this.className='dataTableRow{$class}'" onclick="document.location.href='{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&pID=`$pg.pg_id`"}'" ondblclick="document.location.href='{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=addPage&pID=`$pg.pg_id`"}'">

{/if} 





<td class="dataTableContent" width="40"><nobr>{html_image file="$__imageRoot__/icons/document.png" width="16" height="16" align="absmiddle"}&nbsp;[{$pg.pg_id|default:"&nbsp"}]</nobr></td>
<td class="dataTableContent">{$pg.pg_title|default:"---"}</td>

{assign var="status_id" value=$pg.status_text.id}
{assign var="status_icon" value=$pg.status_text.icon}
{assign var="status_text" value=$pg.status_text.text}
{assign var="change_to" value=$pg.status_text.change_to}
{assign var="date_up" value=$pg.date_up|default:"Natychmiast"}
{assign var="date_down" value=$pg.date_down|default:"Nigdy"}


<td class="dataTableContent" align="center">
 
{wt_check_permission perm_key="pg_activ"}

<a href="{wt_href_tpl_link get_params="pID|t|a|m|status|gID" parameters="m=pages&a=setPageStatus&pID=`$pg.pg_id`&status=`$change_to`"}">
{/wt_check_permission}
<img border="0" src="{$__imageRoot__}/{$status_icon}" width="12" height="12" {popup caption="$status_text" text="<b>Rozpoczé¢©e wyÂ¶wietlania:</b> <br>&nbsp;$date_up <br><b>Zakoí¡‹í¹¥nie wyÂ¶wietlania:</b> <br>&nbsp;$date_down"}>
{wt_check_permission perm_key="pg_activ"}
</a>
{/wt_check_permission}
</td>

<td class="dataTableContent" align="center">
 
{if $smarty.foreach.pages_listing.total > 1}

{if $smarty.foreach.pages_listing.iteration != $all_pages_count}
<a href="{wt_href_tpl_link get_params="pID|a|m|sort|t" parameters="m=pages&a=downPageOrder&pID=`$pg.pg_id`&sort=`$pg.sort_order`"}">{html_image file="$__imageRoot__/listing_down_arrow.png" width="12" height="12" alt="przesuï¿½dí®†í±½</a>&nbsp;
{/if}{if $pg.sort_order > 1}
<a href="{wt_href_tpl_link get_params="pID|a|m|sort|t" parameters="m=pages&a=upPageOrder&pID=`$pg.pg_id`&sort=`$pg.sort_order`"}">{html_image file="$__imageRoot__/listing_up_arrow.png" width="12" height="12" alt="przesuï¿½gíªŽí¸¢}
</a>{/if}
{else}
---
{/if}
</td>

<td class="dataTableContent" align="center">{$pg.count_config|default:"0"}</td>

<td class="dataTableContent" align="right">
<a href="{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=addPage&pID=`$pg.pg_id`"}" title=" edytuj stronèž¢><img src="{$__imageRoot__}/icons/edit.png" alt=" edytuj stronèž¢ width="16" height="16" border="0"></a>

<a href="{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=deletePage&pID=`$pg.pg_id`"}" title=" usuï¿½ronèž¢><img src="{$__imageRoot__}/icons/trash.png" alt=" usuï¿½ronèž¢ width="16" height="16" border="0"></a>

{if $page.pg_id eq $pg.pg_id}
<a href="{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=addPage&pID=`$page.pg_id`"}">{html_image file="$__imageRoot__/arrow_right.png" width="16" height="16"}</a>
{else} 
<a href="{wt_href_tpl_link get_params="pID|t|m" parameters="m=pages&t=addPage&pID=`$pg.pg_id`"}">{html_image file="$__imageRoot__/icon_info.png" width="16" height="16"}</a>
{/if}
</td>

</tr>
{assign var=cb value=$cb+1}
{/foreach}

{*</form>*}

</table> 
</td></tr>
<tr class="dataTableFooterRow">
<td class="dataTableFooterContent">
<table style="width: 100%" cellpadding="2" cellspacing="2">
<tr>
<td class="dataTableFooterContentB" width="33%">{$number_of_pages_text}</td>
<td class="dataTableFooterContentB" align="center" width="33%">{$display_to_display}</td>
<td align="right" class="dataTableFooterContentB" width="33%">{$number_of_pages_links}</td>
</tr>
</table>

</td></tr> 
<tr><td>

<table style="width: 100%" cellpadding="2" cellspacing="2">
<tr>
<td align="right" valign="top">
{wt_check_permission perm_key="pg_add"}
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link get_params="gID|t|m|pID|a" parameters="m=pages&t=addPage"}'" value="dodaj stronèž¾>">
{/wt_check_permission}
&nbsp;</td>
</tr>
</table>
</td></tr>
</table>

</td>

<td width="25%" valign="top"> 

{if $smarty.get.t eq "deletePage"}
<table width="100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading">
Usuwanie #{$page.pg_id} - {$page.pg_title|truncate:30:"..."}
</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent">
{wt_check_permission perm_key="pg_delete" text="true"}
<span class="Alert">UWAGA: </span><br>
Strona wyszukiwania zostanie <span class="Alert">bezpowrotnie usunié³¡</span> z bazy danych.<br><br>
{/wt_check_permission}
</td></tr>
<tr><td class="infoBoxOptionButtons" align="center">
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link get_params="t"}'" value="<< anuluj">&nbsp;
{wt_check_permission perm_key="spe_delete"}
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="if (confirm('JesteÂ¶ pewien, Å¼e chcesz usunÂ±äŸ³tronèž¿?\n\n#{$page.pg_id} - {$page.pg_title|strip_quotas}\n\nPamié³¡j, Å¼e strona zostanie fizycznie usunié³¡ z serwera i nie bé£ºiesz juÅ¼ mí©Ÿí± korzystaäŸº jej danych !')) document.location.href='{wt_href_tpl_link get_params="t|pID|a|m" parameters="m=groups&a=delPage&pID=`$page.pg_id`"}'" value="usuï¿½">
{/wt_check_permission}
</tr></td>
</table>



{/if}


{if $page && $smarty.get.t eq ""}

<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading">#{$page.pg_id} - {$page.pg_title|truncate:30:"..."}</td></tr>
<tr><td class="infoBoxOptionButtons" align="center">

{wt_check_permission perm_key="pg_edit"}
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link get_params="t|pID|m" parameters="m=pages&t=addPage&pID=`$page.pg_id`"}'" value="edytuj">
{/wt_check_permission} 

{wt_check_permission perm_key="pg_edit"}
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link get_params="t|pID|m|a" parameters="m=pages&t=deletePage&pID=`$page.pg_id`"}'" value="usuï¿½
{/wt_check_permission}

</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><b>#:</b>{$page.pg_id}</td></tr>
<tr><td class="infoBoxContent"><b>Tytu3:</b><br>
&nbsp;{$page.pg_title}</td></tr>
<tr><td class="infoBoxContent"><b>Skrí©Ší¾®y tytu3:</b><br>
&nbsp;#{$page.pg_title_short|default:"---"}</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
{assign var="status_text" value=$page.status_text.text}
<tr><td class="infoBoxContent"><b>Status:</b><br>
&nbsp;{$status_text}</td></tr>
<tr><td class="infoBoxContent"><b>Dosté®º</b><br>
<ul>
{foreach item=access_desc from=$page.access_desc}
<li>&bull; {$access_desc.group_name}</li>
{/foreach}
</ul></td></tr>
<tr><td class="infoBoxContent"><br></td></tr>

<tr><td class="infoBoxContent"><b>Dodano:</b><br>
&nbsp;{$page.date_added|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Doda3:</b><br>
{if $page.added_by}
&nbsp;<a href="{wt_href_tpl_link mod_key="mod_user_manager"}&search={$page.added_by}">{$page.added_by}</a>
{else}
&nbsp;--
{/if}
</td></tr>
<tr><td class="infoBoxContent"><b>Modyfikowano:</b><br>
&nbsp;{$page.last_modified|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Modyfikowa3:</b><br>
{if $page.modified_by}
&nbsp;<a href="{wt_href_tpl_link mod_key="mod_user_manager"}&search={$page.modified_by}">{$page.modified_by}</a>
{else}
&nbsp;--
{/if}
</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
</table>
{/if}

{if $smarty.get.t eq "" && count($page) == 0 }

<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading" align="center">Nie wybrano rekordu</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent" align="center"><b>Nie wybrano rekordu lub Å¼aden nie znajduje sièŸ· bazie danych.</b></td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
</table> 

{/if}

</td>
</tr>
</table>

</td></tr>

</table>