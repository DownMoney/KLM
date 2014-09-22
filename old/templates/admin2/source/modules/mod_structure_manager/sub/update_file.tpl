<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>

	<script type="text/javascript">
{if $file_name}
var c = '<input type="hidden" name="file[{$fID}]" value="{$file_dir}{$file_name}" />';
		

	 parent.$('file_link').hide();
	 parent.$('file_info').update('{$file_name} <a href="#" onclick="delFileTmp(); return false">usuń</a>')
	 new parent.Insertion.Bottom('file_input', c);
	 parent.setActionFormSuccess('Dodano plik ...');

	 {literal}
	 /*parent.$('action_window_content').show();	
	 if( parent.$('action_window_buttons') ) {
		parent.$('action_window_buttons').show();	
	 }*/
	 {/literal}
{else}
parent.setActionFormSuccess('Nie udało się dodać pliku ...');
{/if}

parent.Interface.enableFormSubmitFields();
</script>