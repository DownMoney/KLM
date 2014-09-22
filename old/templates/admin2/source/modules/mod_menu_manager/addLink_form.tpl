{hiddeninput name="action"} 
{if $action == "edit"}
{hiddeninput name="lID"}
{/if}
{hiddeninput name="menu_id"}

<table class="EditTable">
<tr><td class="EditTable-buttons" colspan="3">
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}
</td></tr>
<tr>
<td>
<div id="page1" class="hide">

<table class="EditTable">
<tr>
<td class="EditTable-l">{label for="status"}</td>
<td>{input name="status"}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_parent_id"}</td>
<td>{input name="link_parent_id"}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="sort_order"}</td>
<td>{input name="sort_order"}</td>
</tr>
<tr>
<td class="EditTable-s" colspan="2"></td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_name"}</td>
<td>{input name="link_name"}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_title"}</td>
<td>{input name="link_title"}</td>
</tr>
<tr id="g_link_key_words" style="display: none;">
<td class="EditTable-l">{label for="link_key_words"}</td>
<td>{input name="link_key_words"}</td>
</tr>
<tr id="g_link_index_file" style="display: none;">
<td class="EditTable-l">{label for="link_index_file"}</td>
<td>{input name="link_index_file"}</td>
</tr>
<tr>
<td class="EditTable-s" colspan="2"></td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_type"}</td>
<td>{input name="link_type"}</td>
</tr>
<tr id="g_link_module" style="display: none;">
<td class="EditTable-l">{label for="link_module"}</td>
<td>{input name="link_module"}</td>
</tr>
<tr id="g_link_module_link" style="display: none;">
<td class="EditTable-l">{label for="link_module_link"}</td>
<td>{input name="link_module_link"}</td>
</tr>
<tr id="g_link_link" style="display: none;">
<td class="EditTable-l">{label for="link_link"}</td>
<td>{input name="link_link"}</td>
</tr>

</table>

</div>

<div id="page2" class="hide">

<table class="EditTable">
<tr>
<td class="EditTable-l">{label for="link_image"}</td>
<td>{input name="link_image"}
{if $action == "edit" && $db_link.link_image}
<br />{input name="delete_link_image"} {label for="delete_link_image"}
{input name="previus_link_image"}
{/if}
</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_image_over"}</td>
<td>{input name="link_image_over"}
{if $action == "edit" && $db_link.link_image_over}
<br />{input name="delete_link_image_over"} {label for="delete_link_image_over"}
{input name="previus_link_image_over"}
{/if}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_icon_left"}</td>
<td>{input name="link_icon_left"}
{if $action == "edit" && $db_link.link_icon_left}
<br />{input name="delete_link_icon_left"} {label for="delete_link_icon_left"}
{input name="previus_link_icon_left"}
{/if}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_icon_right"}</td>
<td>{input name="link_icon_right"}
{if $action == "edit" && $db_link.link_icon_right}
<br />{input name="delete_link_icon_right"} {label for="delete_link_icon_right"}
{input name="previus_link_icon_right"}
{/if}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_bg"}</td>
<td>{input name="link_bg"}
{if $action == "edit" && $db_link.link_bg}
<br />{input name="delete_link_bg"} {label for="delete_link_bg"}
{input name="previus_link_bg"}
{/if}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="link_bgover"}</td>
<td>{input name="link_bgover"}
{if $action == "edit" && $db_link.link_bgover}
<br />{input name="delete_link_bgover"} {label for="delete_link_bgover"}
{input name="previus_link_bgover"}
{/if}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="css_id"}</td>
<td>{input name="css_id"}</td>
</tr>

</table>

</div>
</td>
</tr>
<tr><td class="EditTable-buttons" colspan="3">
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}
</td></tr>
</table>
<script type="text/javascript">
sort_order_a = new Array();
{foreach from=$sort_order key=l_id item=l_p} 
sort_order_a[{$l_id}] = new Array();	
{assign var="no" value="0"}
{foreach from=$l_p key=sort item=title}
sort_order_a[{$l_id}][{$no}] = new Array('{$sort}', '{$title|escape:"javascript"|truncate:"100":" ..."}');
{assign var="no" value=$no+1}
{/foreach}
{/foreach}

populate(document.addLink.link_parent_id, document.addLink.elements['sort_order'], sort_order_a);

{literal}
updateAddLinkForm = function() {

	var sv = _gsv('link_type');
	
if( sv == '' ) { 
Element.hide('g_link_module');
Element.hide('g_link_module_link');
Element.hide('g_link_link');
Element.hide('g_link_key_words');
Element.hide('g_link_index_file');
}
 
if( sv == 'mod_link' ) {
Element.show('g_link_module');
Element.show('g_link_module_link');
Element.show('g_link_link');
Element.show('g_link_key_words');
Element.show('g_link_index_file');
} 

if( sv == 'header' || sv == 'separator' || sv == 'outside_link' || sv == 'javascript' ) {
Element.hide('g_link_module');
Element.hide('g_link_module_link');
Element.hide('g_link_key_words');
Element.hide('g_link_index_file');

Element.show('g_link_link');
}

if( sv == 'header' || sv == 'separator') {
Element.hide('g_link_link');
}

}
updateAddLinkForm();

getModStructure = function()	{	
	
 if( _gsv('link_module') != '' )  {		
  new Ajax.Updater('operations', '{/literal}{wt_href_tpl_link mod_key="mod_menu_manager" parameters="a=getStruture&mod_id='+_gsv('link_module')+'"}{literal}', {	
onLoading:function(){
set_progress('uzupełniam formularz ... ');
}, 
onComplete:function(t){
del_progress();
setTimeout('setModStructure()', 50);
}, 
evalScripts:true, 
asynchronous:true
});	

} else {

}

}

setModStructure = function() {

if( this._options != options) {
this._options = options;
_gebi('link_module_link').innerHTML = '';
	for (i=0; i < this._options.length; i++) {
new Insertion.Bottom('link_module_link', '<option value="'+this._options[i][0]+'">'+this._options[i][1]+'</option>');
				}

} else if( !options ) {
_gebi('link_module_link').innerHTML = '';
}

new Effect.Highlight('link_module_link');

}

updateLinkLink = function() {

	if( _gsv('link_module_link') != '' && confirm('Na pewno chcesz ustawić ten link ? \n Pamietaj, że poprzedni zostanie utracony !!!') ) {
		_gebi('link_link').value = _gsv('link_module_link');
		new Effect.Highlight('link_link');
	}
}



{/literal}
</script>