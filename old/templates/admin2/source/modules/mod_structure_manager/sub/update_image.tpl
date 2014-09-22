<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>

	<script type="text/javascript">
{if $image_name}
var c = '<li id="image_{$image_nr}" class="form_section">'+
			'<input type="hidden" name="image[{$fID}][{$image_nr}][file]" value="{$image_dir}{$image_name}" /><a href="{wt_thumb_image src="`$image_dir``$image_name`" path_return=true}" target="_blank">{wt_thumb_image src="`$image_dir``$image_name`" width="171" height="124" compress="75" nt="1"}</a>'+
			'<table>'+
			'<tr>'+
			'<td align="right"><a href="#" onclick="delImage{$fID}(\'{$image_nr}\'); return false"><img src="{$__imageRoot__}/icons/icon_del.gif" alt="usuń"></a></td>'+
			'</tr>'+
		'<tr>'+
			'<td>'+
				'<b>Nazwa:</b><br />'+
				'<input type="text" name="image[{$fID}][{$image_nr}][name]" /><br />'+
				'<b>Opis:</b><br />'+
				'<textarea name="image[{$fID}][{$image_nr}][desc]" cols="10" rows="2"></textarea>'+
			'</td>'+
		'</tr>'+
	'</table>'+
			'</li>';
	
	{if $smarty.request.add_on == "top"}
	 new parent.Insertion.Top('images_list_{$fID}', c);
	{else}
	 new parent.Insertion.Bottom('images_list_{$fID}', c);
	{/if}
	 
	 
	 parent.Sortable.destroy('images_list_{$fID}');
	 {literal}
	 parent.Sortable.create('images_list_{/literal}{$fID}{literal}', {constraint: false, scroll: 'eL_form' });
	 parent.setActionFormSubmit('Dodano zdjęcie ... możesz dodać następne ...');
	 parent.$('action_window_content').show();	
	 if( parent.$('action_window_buttons') ) {
		parent.$('action_window_buttons').show();	
	 }
 	 parent.$('action_window_title').innerHTML = 'Dodaj zdjęcie';
	 parent.$('fi_image').value = '';
	 parent.$('fi_url').value = '';
	 
	 {/literal}
{/if}

parent.Interface.enableFormSubmitFields();

</script>