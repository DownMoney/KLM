<table style="width: 100%">
<tr><td class="subHeading">
{if $mode == "local"}
Modu3y lokalne
{elseif $mode == "manager"}
Modu3y administracyjne
{/if}
<a href="{wt_href_tpl_link parameters="a=updateDBTableInfo"}">przeładuj tabele</a>
<a href="{wt_href_tpl_link parameters="m=man"}">manager</a>

</td></tr>
<tr><td>

<table style="width: 100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width: 75%" valign="top">

<table style="width: 100%" cellpadding="0" cellspacing="0">
<tr><td>

<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr class="dataTableHeadingRow">
<td class="dataTableHeadingContent">#</td>
<td class="dataTableHeadingContent">Nazwa</td>
<td class="dataTableHeadingContent">Nazwa przypisana</td>
<td class="dataTableHeadingContent">Klucz</td>
<td class="dataTableHeadingContent" style="text-align: center;">Status</td>
<td class="dataTableHeadingContent" style="text-align: center;">Systemowy</td>
<td class="dataTableHeadingContent" style="text-align: center;">Szablon</td>
<td class="dataTableHeadingContent" style="text-align: right;">Opcje</td>
</tr>
{foreach item=loc from=$modules_listing}
{assign var="class" value=""}
{if $loc.mod_home == "1"} 
{assign var="class" value="B"}
{/if}

{if $module.mod_id eq $loc.mod_id}

<tr class="dataTableRowSelected" onmouseover="this.style.cursor='pointer'" onclick="document.location.href='{wt_href_tpl_link get_params="mID|t"}&mID={$module.mod_id}&t=editModule'">
{else}
<tr class="dataTableRow{$class}" onmouseover="this.className='dataTableRowOver';this.style.cursor='pointer'" onmouseout="this.className='dataTableRow{$class}'" onclick="document.location.href='{wt_href_tpl_link get_params="mID|t"}&mID={$loc.mod_id}'">
{/if}





<td class="dataTableContent">{$loc.mod_id|default:"&nbsp"}</td>
<td class="dataTableContent">{$loc.mod_name|default:"&nbsp"}</td>
<td class="dataTableContent">{$loc.mod_title|default:"&nbsp"}</td>
<td class="dataTableContent">{$loc.mod_key|default:"&nbsp"}</td>

{assign var="status_id" value=$loc.status_text.id}
{assign var="status_icon" value=$loc.status_text.icon}
{assign var="status_text" value=$loc.status_text.text}

{assign var="system_id" value=$loc.system_text.id}
{assign var="system_icon" value=$loc.system_text.icon}
{assign var="system_text" value=$loc.system_text.text}

<td class="dataTableContent" style="text-align: center;">{html_image file="$__imageRoot__/$status_icon" width="12" height="12" alt="$status_text"}</td>
<td class="dataTableContent" style="text-align: center;">{html_image file="$__imageRoot__/$system_icon" width="12" height="12" alt="$system_text"}</td>


{assign var="mod_theme" value=$loc.theme}
<td class="dataTableContent" style="text-align: center;"><a href="#" {popup caption="$mod_theme" text="<img src=$__BaseTemplate__/$mod_theme/theme.jpg alt=$tem_name align=center>" left="true"}>{html_image file="$__imageRoot__/icon_info.png" width="14" height="14"}</a></td>


<td class="dataTableContent" style="text-align: right;">
<a href="{wt_href_tpl_link get_params="mID|t" parameters="mID=`$loc.mod_id`&t=editModule"}" title=" edytuj "><img src="{$__imageRoot__}/icons/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>

<a href="{wt_href_tpl_link get_params="mID|t|a" parameters="mID=`$loc.mod_id`&a=delModule"}" title=" usu�<img src="{$__imageRoot__}/icons/trash.png" alt=" usu�border="0" width="16" height="16"></a>

{if $module.mod_id eq $loc.mod_id}
<a href="{wt_href_tpl_link}&mID={$module.mod_id}&t=editModule">{html_image file="$__imageRoot__/arrow_right.png" width="16" height="16"}</a></td>
{else} 
<a href="{wt_href_tpl_link}&mID={$loc.mod_id}">{html_image file="$__imageRoot__/icon_info.png" width="16" height="16"}</a>
{/if}
</td>

</tr>
{/foreach}
<tr class="dataTableFooterRow"><td colspan="9" class="dataTableFooterContent">{$modules_count}</td></tr>
</table>

</td></tr>
<tr>
<td>
<table style="width: 100%" cellpadding="2" cellspacing="2">
<tr>
<td>{$number_of_content_text}</td>
<td align="right">{$number_of_content_links}</td>
</tr>
</table>

</td></tr>
<tr><td>

<table style="width: 100%" cellpadding="2" cellspacing="2">
<tr>
<td></td>
<td align="right">
{if $smarty.get.search || $smarty.get.uID_search }
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link}'" value="<< wstecz">

{/if}

<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link parameters="t=addContent"}'" value="dodaj stron蠾&nbsp;
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link}&t=SC'" value="sekcje / kategorie">&nbsp;</td>
</tr>
</table>
</td></tr>
</table>

</td>

<td style="width: 25%" valign="top"> 


{if $content && $smarty.get.t eq "delContent"}
<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading">Usuwanie użytkownika #{$user.usr_id} - {$user.usr_login}</td></tr>
<form action="{wt_href_tpl_link}" method="post">
<input type="hidden" name="a" value="delContent">
<input type="hidden" name="con_id" value="{$content.con_id}">
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><b>Czy na pewno chcesz usuną䟳tron踼/b><br><br>
&nbsp;#{$content.con_id} <br> {$content.con_title}</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><div class="Alert">UWAGA: </div>strona zostanie <span class="Alert">bezpowrotnie usuni鳡</span> z bazy danych.</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>

<tr><td class="infoBoxOptionButtons" align="center">
<input type="button" class="button" onclick="document.location.href='{wt_href_tpl_link get_params="a"}&cID={$content.con_id}'" value="<< anuluj">&nbsp;<input type="submit" class="button" value="usu�">
</td></tr>
</form>
</table>

{/if}

{if $module && $smarty.get.t eq ""}

<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading">#{$module.mod_id} - {$module.mod_name|truncate:30:"..."}</td></tr>
<tr><td class="infoBoxOptionButtons" align="center">
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link parameters="t=editModule"}&mID={$module.mod_id}'" value="edytuj">&nbsp;<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link parameters="t=uninstallModule"}&mID={$module.mod_id}'" value="usu�br><br class="verdana04">
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link parameters="t=moduleInformation"}&mID={$module.mod_id}'" value="informacje">
<input type="button" class="buttonIB" onmouseover="this.className='buttonIBover';this.style.cursor='pointer'" onmouseout="this.className='buttonIB'" onclick="document.location.href='{wt_href_tpl_link parameters="t=moduleBlocks"}&mID={$module.mod_id}'" value="bloki">
</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><b>Numer modu3u:</b><br>
&nbsp;{$module.mod_id}</td></tr>
<tr><td class="infoBoxContent"><b>Nazwa:</b><br>
&nbsp;{$module.mod_name|default:"--"}</td></tr>

<tr><td class="infoBoxContent"><b>Nazwa przypisana:</b><br>
&nbsp;{$module.mod_title|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Klucz:</b><br>
&nbsp;{$module.mod_key|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Opis:</b><br>
&nbsp;{$module.description|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>

<tr><td class="infoBoxContent"><b>Dost鮺</b><br>
<ul>
{foreach item=access_desc from=$module.access_desc}
<li>&bull; {$access_desc.group_name}</li>
{/foreach}
</ul></td></tr>

{assign var="status_text" value=$module.status_text.text}
<tr><td class="infoBoxContent"><b>Status:</b><br>
&nbsp;{$status_text}</td></tr>

<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><b>Dodano:</b><br>
&nbsp;{$module.date_added|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Doda3:</b><br>
{if $module.added_by}
&nbsp;<a href="{wt_href_tpl_link mod_key="mod_user_manager"}&search={$module.added_by}">{$module.added_by}</a>
{else}
&nbsp;--
{/if}
</td></tr>
<tr><td class="infoBoxContent"><b>Modyfikowano:</b><br>
&nbsp;{$module.last_modified|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Modyfikowa3:</b><br>
{if $module.modified_by}
&nbsp;<a href="{wt_href_tpl_link mod_key="mod_user_manager"}&search={$module.modified_by}">{$module.modified_by}</a>
{else}
&nbsp;--
{/if}
</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent"><b>Pod3ączone bloki:</b>
<ul>
{foreach item=blc from=$module.blocks}
<li>&bull; {$blc.block_name}</li>
{/foreach}
</ul>
</td></tr>
<tr><td class="infoBoxContent"><b>Bloki modu3u:</b>
{assign var="blocks_depends" value=$module.blocks_depends}

{if count($blocks_depends) == 0}
--
{else}
<ul>
{foreach item=bld from=$blocks_depends}
<li>&bull; {$bld.block_name}</li>
{/foreach}
</ul>
{/if}
</td></tr>
<tr><td class="infoBoxContent"><b>Wtyczki:</b><br>
&nbsp;{$module.plugins|default:"--"}</td></tr>
<tr><td class="infoBoxContent"><b>Szablon:</b><br>

{assign var="tem_name" value=$module.theme_desc.tem_name}
{assign var="tem_key" value=$module.theme_desc.tem_key}
{assign var="date_add" value=$module.theme_desc.date_add}
{assign var="added_by" value=$module.theme_desc.added_by}
 

&nbsp;<a href="#" {popup caption="$tem_name" text="<img src=$__BaseTemplate__/$tem_key/theme.jpg alt=$tem_name align=center><br><b>Nazwa:</b><br>&nbsp;$tem_name<br><b>Klucz:</b><br>&nbsp;$tem_key<br><b>Dodano:</b><br>&nbsp;$date_add<br><b>Doda3:</b><br>&nbsp;$added_by" left="true" above="true"}>{$module.theme|default:"--"}</a></td></tr>
<tr><td class="infoBoxContent"><b>Szablony modu3u:</b>
<ul>
{foreach item=thm from=$module.themes_for_module}
<li>&bull; {$thm.tem_name}</li>
{/foreach}
</ul>
</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
</table>
{/if}

{if count($module) == 0 && $smarty.get.t eq "" }

<table style="width: 100%" cellpadding="2" cellspacing="0">
<tr><td class="infoBoxHeading" align="center">Nie wybrano strony</td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
<tr><td class="infoBoxContent" align="center"><b>Nie wybrano strony lub żadna nie znajduje si蟷 bazie danych.</b></td></tr>
<tr><td class="infoBoxContent"><br></td></tr>
</table>

{/if}

</td>
</tr>
</table>

</td></tr>

</table>