<div id="adm_menu" style="position:absolute; visibility:hidden;">
{literal}
<style type="text/css">
.adm_menu_links {
border-right: 1px solid #888;
padding: 5px 15px;
vertical-align: top;
}
.adm_menu_links STRONG {
font-size: 11px;
}

.adm_menu_links UL {
margin:0;
padding-left: 5px;
list-style: none;
}

.adm_menu_links LI {
font-size: 10px;
padding-bottom: 2px;
}

A.adm_menu_header {
font-size: 11px;
font-weight: 600;
color: #000;
text-decoration: none;
}

A.adm_menu_header:hover {
text-decoration: underline;
}

</style>
{/literal}
<table bgcolor="#F1F3F5" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td id="adm_menu_tab" class="pagetext">

<table class="main" cellspacing="0" cellpadding="0">
<tr>
<td bgcolor="#c0c0c0" style="padding: 5px 10px;"><a class="adm_menu_header" href="{wt_href_tpl_link mod_key="mod_admin_manager"}" target="_blank">MENU ADMINISTRACYJNE</a></td>
<td style="padding: 5px 10px;">widzisz to menu ponieważ jeste¶ zalogowany jako administrator strony</td>
</tr>
<tr>
<td style="padding: 5px 20px;" colspan="2">
<table >
<tr></tr>
{foreach from=$admin_menu item="section"}
<td class="adm_menu_links"><strong>{$section.name}</strong>
<ul>
{foreach from=$section.items item="item"}
{if $item.popup}
<li>&bull;&nbsp;&nbsp;<a href="{$item.link}" onClick="popupWindow(this.href, 'adm_menu', '', '', 'yes'); return false;" target="_blank">{$item.name}</a></li>
{else}
<li>&bull;&nbsp;&nbsp;<a href="{$item.link}" target="_blank">{$item.name}</a></li>
{/if}
{/foreach}
</ul>
</td>

{/foreach}
</table>
</td>
</tr>

</table>


</td>
</tr>
<tr>
<td align="center" height="7" bgcolor="#D4D0C8" style="border-bottom: 1px solid #000;"><a href="#" onClick="wt_toggleObject2('adm_menu_tab'); return true;"><img src="{$__imageRoot__}/toogle_poz-LC.gif" alt="" border="0"></a></td>
   
</tr>
</table>

</div>

<script type="text/javascript">
placeIt('adm_menu', '0');
showIt('adm_menu');
</script>
{if $smarty.cookies.adm_menu_tab == "1"}
   <script type="text/javascript">
   	wt_toggleObject2('adm_menu_tab');
   </script>
{/if}