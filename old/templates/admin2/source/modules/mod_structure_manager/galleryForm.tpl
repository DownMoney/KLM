<a class="addSubFormItemLink" href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addImage&iID=`$item.it_id`&fID=`$fic.fi_id`&add_on=top"}" onclick="action_form(this.href,'Dodaj obrazek'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj obraz na początku</a>
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


<div id="images_to_delete_{$fic.fi_id}"></div>
<ul id="images_list_{$fic.fi_id}" class="images_list">
{assign var=fiid value=$fic.fi_id}
{foreach from=$images.$fiid item=image key=k}

	<li id="image_{$k}" class="form_section">
	<input type="hidden" name="image[{$fic.fi_id}][{$k}][file]" value="{$image.file}" />
	<a href="{wt_thumb_image src="mod_structure/`$item.it_id`/`$fic.fi_id`/`$image.file`" path_return=true}" target="_blank">{wt_thumb_image src="mod_structure/`$item.it_id`/`$fic.fi_id`/`$image.file`" width="171" height="124" compress="75" nt="1"}</a>
	
	<table>
		<tr><td align="right"><a href="#" onclick="delImage{$fic.fi_id}({$k}); return false"><img src="{$__imageRoot__}/icons/icon_del.gif" alt="usuń" style="float:right;"></a></td></tr>
		<tr>
			<td>
			<b>Nazwa:</b>
			<br />
				<input type="text" name="image[{$fic.fi_id}][{$k}][name]" value="{$image.name|escape}" />
<br />
	<b>Opis:</b><br />
			<textarea name="image[{$fic.fi_id}][{$k}][desc]" cols="10" rows="2">{$image.desc|escape}</textarea>
				
			</td>
		</tr>
	</table>
	</li>
{/foreach}
</ul>

<script language="javascript" type="text/javascript">
{literal}
Position.includeScrollOffsets = true;
Sortable.create('images_list_{/literal}{$fic.fi_id}{literal}', {constraint: false, scroll: 'eL_form'});

delImage{/literal}{$fic.fi_id}{literal} = function(k) {

	if( !confirm('Jesteś pewien, że chcesz usunąć ten obraz ?') ) {
		return ;
	}

	var el = $('image_'+k).down().value;
		alert(el);
	new Insertion.Top('images_to_delete_{/literal}{$fic.fi_id}{literal}','<input type="hidden" name="to_delete[{/literal}{$fic.fi_id}{literal}][]" value="'+el+'"/>');
	$('image_'+k).remove();
	parent.Interface.enableFormSubmitFields();
}
{/literal}
</script>


<a class="addSubFormItemLink" href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=addImage&iID=`$item.it_id`&fID=`$fic.fi_id`&add_on=bottom"}" onclick="action_form(this.href,'Dodaj obrazek'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj obraz na końcu</a>