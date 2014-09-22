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

{/literal}
</style>

<div id="file_link" {if $file}style="display: none"{/if}><a class="addSubFormItemLink" href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addFile&iID=`$item.it_id`&fID=`$fic.fi_id`"}" onclick="action_form(this.href,'Dodaj plik'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj plik</a></div>

<div id="files_to_delete_{$fic.fi_id}"></div>
<div id="file_input">{if $file}<input type="hidden" name="file[{$fic.fi_id}]" value="{$file}" />{/if}</div>

<div id="file_info">
{if $file}
{$file} <a href="#" onclick="delFile{$fic.fi_id}('{$file}'); return false">usuń</a>
{/if}
</div>

<script language="javascript" type="text/javascript">
{literal}

delFile{/literal}{$fic.fi_id}{literal} = function(k) {
	if( !confirm('Jesteś pewien, że chcesz usunąć plik ?') ) {
		return ;
	}
	new Insertion.Top('files_to_delete_{/literal}{$fic.fi_id}{literal}','<input type="hidden" name="files_to_delete[{/literal}{$fic.fi_id}{literal}]" value="'+k+'"/>');
	$('file_info').update();
	$('file_input').update();
	$('file_link').show();
	Interface.enableFormSubmitFields();
}

delFileTmp = function(k) {
	$('file_info').update();
	$('file_input').update();
	$('file_link').show();
}

{/literal}
</script>