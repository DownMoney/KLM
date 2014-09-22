<table class="cT">
<tr><td>
<table class="dT" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td width="20">#</td>
<td>Tytuł</td>
<td align="center">Status</td>
<td align="right">Opcje</td>
<td width="17"></td>
</tr>
<tbody id="data_table_content">
{foreach item=i from=$items_listing name="items_listing"}

<tr id="row_{$i.group_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'">
<td width="20"><nobr><a href="#" onClick="tableList.loadRowItemInfo('{$i.group_id}'); return false"><img id="row_make_info_{$i.group_id}" src="{$__imageRoot__}/plus.gif" width="11" height="11" alt="" align="absmiddle" /></a> <img id="row_type_img_{$i.group_id}" src="{$__imageRoot__}/folder.png" width="16" height="16" align="absmiddle" alt="" />&nbsp;[{$i.group_id|default:"&nbsp;"}]&nbsp;</nobr></td>

<td>{$i.group_name}</td>

<td style="text-align: right;">

<a href="{wt_href_tpl_link get_params="gID|t" parameters="t=addTest&gID=`$i.group_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja testu'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>

<a href="#" onClick="tableList.delRowItem('{$i.group_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>

</td>
<td width="17">&nbsp;</td>
</tr>
{/foreach}
</tbody>
</table> 
</td></tr>
<tr class="dTFR">
<td>
<table class="dTFRC">
<tr>
<td>{$number_of_items_text}</td>
<td>{$display_to_display}</td>
<td align="right">{$number_of_items_links}</td>
</tr>
</table>
</td>
</tr>
</table>

<script type="text/javascript">
Interface.setDataTableDim();

Event.observe(window, 'load', new ADM_TableNavigation());

{literal}
var tableList = new ADM_TableList({
{/literal}
imageRoot: '{$__imageRoot__}',
delURL: '{wt_href_tpl_link parameters="a=delTest&from=admin_list&gID="}'
{literal} 
});

changeNewsTopic = function() {
$('newsTopicList').show();
}

hideChangeNewsTopic = function() {
$('newsTopicList').hide();
}

{/literal}




</script>