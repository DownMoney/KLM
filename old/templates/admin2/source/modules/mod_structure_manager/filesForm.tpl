<a class="addSubFormItemLink" href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addFile&iID=`$item.it_id`&fID=`$fic.fi_id`&multiple=1&add_on=top"}" onclick="action_form(this.href,'Dodaj plik'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj plik na początku</a>
<br style="clear:both;" />

<style type="text/css">
{literal}

.form_section {
	background-color:#FFF;
	border: 1px solid #E0E0E0;
	padding: 5px;
}
.images_list {				
	list-style: none;
	margin: 15px 0;
	padding: 0;
}

.images_list LI {				
	margin: 0 7px 7px 0;
	cursor: move;
	width: 175px;
	float: left; 
	clear:none;
}

.images_list TABLE {				
	height: 165; display: inline;
}

.images_list LI TD {				
	vertical-align: top;	
 font-size: 10px;
}

.images_list INPUT {				
 width: 168px;
 padding: 2px;
 font-size: 10px;
 margin: 0 0 3px 0;
}

.images_list TEXTAREA {				
 width: 168px;
 height: 75px;
 font-size: 11px;
}
.images_list DIV {				
 float:left;width:170px;overflow: hidden;height:12px;cursor:help;
}

{/literal}
</style>


<div id="files_to_delete_{$fic.fi_id}"></div>
<ul id="files_list_{$fic.fi_id}" class="images_list">
{assign var=fiid value=$fic.fi_id}
{foreach from=$files.$fiid item=file key=k}

	<li id="file_{$k}" class="form_section">
	<input type="hidden" name="image[{$fic.fi_id}][{$k}][file]" value="{$file.file}" />
	
	<table>
		<tr><td align="right"><a href="#" onclick="delFile{$fic.fi_id}({$k}); return false"><img src="{$__imageRoot__}/icons/icon_del.gif" alt="usuń" style="float:right;"></a></td></tr>
		<tr>
			<td align="center">
			{wt_getimagesize file="`$smarty.const.CFGF_DIR_FS_TEMPLATES`admin2/media/images/files_large/`$file.ext`.jpg" assign=im_info}
			{if $im_info}
			<img src="{$__imageRoot__}/files_large/{$file.ext}.jpg" />
			{else}
			<img src="{$__imageRoot__}/files_large/empty.jpg" />
			{/if}
			</td>
		</tr>
		<tr>
			<td style="">
			<b>Oryginalna nazwa:</b><br />
			<div title="{$file.file}">{$file.file|truncate:29:"(...)"}</div><br />
			<b>Typ pliku:</b><br />
			{$file.ext}<br />
			<b>Rozmiar pliku:</b><br />
			{$file.size|wt_noformat:3:",":""} MB<br />
			<b>Nazwa:</b><br />
			<input type="text" name="image[{$fic.fi_id}][{$k}][name]" value="{$file.name}" /><br />
			<b>Opis:</b><br />
			<textarea name="image[{$fic.fi_id}][{$k}][desc]" cols="10" rows="2">{$file.desc}</textarea>
				
			</td>
		</tr>
	</table>
	</li>
{/foreach}
</ul>


<script language="javascript" type="text/javascript">
{literal}
Position.includeScrollOffsets = true;
Sortable.create('files_list_{/literal}{$fic.fi_id}{literal}', {constraint: false, scroll: 'eL_form'});

delFile{/literal}{$fic.fi_id}{literal} = function(k) {

	if( !confirm('Jesteś pewien, że chcesz usunąć ten obraz ?') ) {
		return ;
	}

	var el = $('file_'+k).down().value;

	new Insertion.Top('files_to_delete_{/literal}{$fic.fi_id}{literal}','<input type="hidden" name="to_delete[{/literal}{$fic.fi_id}{literal}][]" value="'+el+'"/>');
	$('file_'+k).remove();
	parent.Interface.enableFormSubmitFields();
}
{/literal}
</script>

<a class="addSubFormItemLink" href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addFile&iID=`$item.it_id`&fID=`$fic.fi_id`&multiple=1&add_on=bottom"}" onclick="action_form(this.href,'Dodaj plik'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj plik na końcu</a>