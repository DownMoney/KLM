<div id="action_window" class="dialogForm">
<h1 id="action_window_title">
<a href="#" onclick="closeEditField(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
{if $smarty.get.t == "addNewField"}
Pola sekcji: {$field_data.fi_name}
{else}
Własności pola: {$field_data.fi_name} {if __languagesid__}- język: {$__languagesid__.$language_id.name}{/if}
{/if}
{if $field_data.fi_depends_on}
<small>to pole zależy od: {$field_data_depends.fi_name}</small>
{/if}
</h1>
<div id="action_window_content" class="dialogForm">

<ul id="fieldValues">
{foreach item=fi from=$fields_listing name="fields_listing"}
<li style="background: {cycle values="#FFF,#F0F0F0"};" id="li_fi_{$fi.fi_id}">
<div>
<a href="#" onclick="editField('{$fi.fi_id}'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="delField('{$fi.fi_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</div>
<span id="fi_{$fi.fi_id}" onDblclick="editField('{$fi.fi_id}');">{$fi.fi_name}</span>
{if $field_data.fi_depends_on}<small style="color:#C0c0c0;margin-left:10px;" id="fi_related_to_text_{$fi.fi_id}">({$fi.depends.fi_name|default:"--- nie przypisano ---"})</small><input type="hidden" id="old_fi_related_to_{$fi.fi_id}" value="{$fi.depends.fi_id}" />{/if}
</li>
{/foreach}
</ul>


<div  class="eL_form eL_formC">
<h1>Nowe pole</h1>
<input type="text" id="new_field_name" class="t4" style="width:300px" />
{if $field_data.fi_depends_on}
należy do: <select name="fi_related_to" id="fi_related_to">
<option value="">--- wybierz ---</option>
{foreach from=$fields_depends item=f}
	<option value="{$f.fi_id}">{$f.fi_name}</option>
{/foreach}
</select>
{/if}

<a href="#" onclick="addField(); return false;" title=" zapisz "><img src="{$__imageRoot__}/save.gif" align="top" alt="" /></a>

<a href="#" onClick="$('new_field_name').value = '';  return false" title=" usuń "><img src="{$__imageRoot__}/cancel.png" align="top" alt="" /></a>
</div>

</div>
</div>
<style type="text/css">
{literal}

#fieldValues {
list-style-type: none;
margin: 0;
padding: 0;
float: left;
clear: both;
height: 350px;
overflow-y: auto;
overflow-x: hidden;
width: 750px;
margin-bottom: 10px;
}

#fieldValues LI {
width: 746px;
float: left;
clear: both;
padding: 3px 2px;
}

#fieldValues DIV {
float: left;
clear: none;
width: 60px;
}

{/literal}
</style>

<script type="text/javascript">
{literal}

Event.observe('new_field_name','keypress', function(evt) {

				switch(evt.keyCode) {
					case 13:
						addField();
					break;
					case 27:
						Element.toggle('new_field');
						$('new_field_name').value = '';
					break;
				}
		}.bindAsEventListener(this));


editField = function(id) {
	val = $('fi_'+id).innerHTML;
	if($('old_fi_related_to_'+id)) {
	fi_related_to = $('old_fi_related_to_'+id).value;
	}
	if( val.indexOf('save.gif') == -1 ) {
	t = '<input type="text" id="fi_name_'+id+'" value="'+val+'" class="t4">';
	t += '<input type="hidden" id="old_val_'+id+'" value="'+val+'">';

	{/literal}
	{if $field_data.fi_depends_on}
	t += 'należy do: <select id="fi_related_to_'+id+'">';
	t += '<option value="">--- wybierz ---</option>';
	{foreach from=$fields_depends item=f}
	t += '<option value="{$f.fi_id}"';
	if(fi_related_to == {$f.fi_id}) {ldelim}
	t += ' selected ';
	{rdelim}
	t += '>{$f.fi_name}</option>';
	{/foreach}
	t += '</select>';
	{/if}
	t += '<a href="#" onClick="saveEdit(\''+id+'\'); return false">';
	t += '<img src="{$__imageRoot__}/save.gif" align="top" alt="" />';
	t += '</a> &nbsp;&nbsp;';
	t += '<a href="#" onClick="cancelEdit(\''+id+'\'); return false">';
	t += '<img src="{$__imageRoot__}/cancel.png" align="top" alt="" />';
	t += '</a>';
{literal}

	$('fi_'+id).innerHTML = t;

		Event.observe('fi_name_'+id,'keypress', function(evt) {

				switch(evt.keyCode) {
					case 13:
					saveEdit(id);
					break;
					case 27:
					cancelEdit(id);
					break;
				}
		}.bindAsEventListener(this));


	} else {
	cancelEdit(id);
	}
}

cancelEdit = function(id) {
	val = $('old_val_'+id).value;
	$('fi_'+id).innerHTML = val;
}

saveEdit = function(id) {
	val = $('fi_name_'+id).value;
	related_to = 0;
 {/literal}
 {if $field_data.fi_depends_on}
 {literal}
	if($('fi_related_to_'+id+'')) {
		related_to = $('fi_related_to_'+id+'').value;
	  	related_text = $('fi_related_to_'+id+'').options[$('fi_related_to_'+id+'').selectedIndex].innerHTML;
	} else {
		related_text = '--- nie przypisano ---';
	}
	$('fi_related_to_text_'+id).innerHTML = '('+related_text+')';
	$('old_fi_related_to_'+id).value = related_to;
  {/literal}
  {/if}
  {literal}
	$('fi_'+id).innerHTML = val;

	new Ajax.Request({/literal}
	'{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=saveFieldEasy&fID='+id+'&fi_name='+val+'&language_id=`$language_id`&fi_related_to='+related_to+'"}',
	{literal}
	{asynchronous:true}
	);

}

delField = function(id) {

if( confirm('Jesteś pewien, że chcesz usunąć tą wartość\nPamiętaj, że te operacja jest NIEODWRACALNA !') ) {
	Element.remove('li_fi_'+id);
	new Ajax.Request({/literal}
	'{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=delField&fID='+id+'&language_id=`$language_id`"}',
	{literal}
	{asynchronous:true}
	);

}

}


closeEditField = function() {

{/literal}
{if $smarty.get.t == "addNewField"}
target = 'operations';
{else}
target = 'fi_edit_{$field_data.fi_id}';
{/if}
{literal}

new Ajax.Updater(
{/literal}
target,
'{wt_href_tpl_link mod_key="mod_structure_manager" parameters="t=updateField&fID=`$field_data.fi_id`&language_id=`$language_id`"}',
{literal}
{
onComplete: function(){
Dialog.closeInfo();
},
asynchronous:true,
evalScripts:true});

}


addField = function() {

		val = $('new_field_name').value;

	if( val == '' ) {
	   new Effect.Highlight('new_field_name', {startcolor:'#FF0000'});
		alert( 'Musisz wypełnić to pole' );
		$('new_field_name').focus();
		return;
	}

{/literal}
{if $smarty.get.t == "addNewField"}
fi_type = 'multi_select';
{else}
fi_type = '';
{/if}

	var related = 0;
{if $field_data.fi_depends_on}
	related = $('fi_related_to').value;
{/if}
{literal}


new Ajax.Updater(
{/literal}
'operations',
'{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=saveFieldEasy&fi_name='+val+'&parent_id=`$field_data.fi_id`&fi_type='+fi_type+'&language_id=`$language_id`&fi_related_to='+related+'"}',
{literal}
{
onLoading: function(){
$('new_field_name').disabled = 'true';
document.style.cursor = 'progress';
},
onComplete: function(){
$('new_field_name').value = '';
$('new_field_name').disabled = '';
$('new_field_name').focus();
document.style.cursor = '';
},
evalScripts: true,
asynchronous:true});

}

{/literal}
</script>
