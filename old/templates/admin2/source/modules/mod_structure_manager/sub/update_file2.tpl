<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>

	<script type="text/javascript">
	parent.Interface.enableFormSubmitFields();

{foreach from=$uploaded_files item="fi"}
{if $fi.file_name}
var c = '<li id="file{$fID}_{$fi.file_nr}" class="form_section">'+
			'<input type="hidden" name="image[{$fID}][{$fi.file_nr}][file]" value="{$fi.file_dir}{$fi.file_name}" />'+
			'<table>'+
			'<tr>'+
			'<td align="right"><a href="#" onclick="delFile{$fID}(\'{$fi.file_nr}\'); return false"><img src="{$__imageRoot__}/icons/icon_del.gif" alt="usuń"></a></td>'+
			'</tr>'+
			'<tr>'+
			'<td align="center" height="124" valign="middle">'+
			{if $fi.file_ext == "jpg" || $fi.file_ext == "gif" || $fi.file_ext == "png" || $fi.file_ext == "jpeg"}
			'<a href="{wt_thumb_image src="`$fi.file_dir``$fi.file_name`" path_return=true}" target="_blank">{wt_thumb_image src="`$fi.file_dir``$fi.file_name`" width="171" height="124" compress="75" nt="1"}</a>'+
			{else}
			{wt_getimagesize file="`$smarty.const.CFGF_DIR_FS_TEMPLATES`admin2/media/images/files_large/`$fi.file_ext`.jpg" assign=im_info}
			{if $im_info}
			'<img src="{$__imageRoot__}/files_large/{$fi.file_ext}.jpg" />'+
			{else}
			'<img src="{$__imageRoot__}/files_large/empty.jpg" />'+
			{/if}
			{/if}

			'</td>'+
			'</tr>'+
		'<tr>'+
			'<td>'+
				'<b>Oryginalna nazwa:</b><br />'+
				'<div title="{$file.file}">{$fi.file_name|truncate:29:"(...)"}</div><br />'+
				'<b>Typ pliku:</b><br />'+
				'{$fi.file_ext}<br />'+
				'<b>Rozmiar pliku:</b><br />'+
				'{$fi.file_size|wt_noformat:3:",":""} MB<br />'+
				'<b>Nazwa:</b><br />'+
				'<input type="text" name="image[{$fID}][{$fi.file_nr}][name]" /><br />'+
				'<b>Opis:</b><br />'+
				'<textarea name="image[{$fID}][{$fi.file_nr}][desc]" cols="10" rows="2"></textarea>'+
			'</td>'+
		'</tr>'+
	'</table>'+
			'</li>';

	{if $smarty.request.add_on == "top"}
	 new parent.Insertion.Top('files_list_{$fID}', c);
	{else}
	 new parent.Insertion.Bottom('files_list_{$fID}', c);
	{/if}
	{assign var="files_added" value="1"}
{/if}
{/foreach}
{if $files_added == "1"}
	parent.Sortable.destroy('files_list_{$fID}');
	 {literal}
	 parent.Sortable.create('files_list_{/literal}{$fID}{literal}', {constraint: false, scroll: 'eL_form' });
	// parent.setActionFormSubmit('Dodano plik ... możesz dodać następne ...');
	 {/literal}
	// setTimeout(function() {ldelim} parent.action_form('{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addFile&iID=`$smarty.get.iID`&fID=`$smarty.get.fID`&multiple=`$smarty.get.multiple`&add_on=`$smarty.get.add_on`"}','Dodaj pliki'); {rdelim}, 500);
{/if}
</script>
