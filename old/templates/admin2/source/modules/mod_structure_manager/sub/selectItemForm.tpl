{php}
	$iP = unserialize($this->_tpl_vars['fic']['params']);
	if(wt_is_valid($iP,'array')) {
		$mod_structure_manager = wt_module::singleton('mod_structure_manager');
		$this->assign('field_items',$mod_structure_manager->get_items(null,$iP));
	}
	$iP = array();
	$iP['where'] = " si.parent_id = '927' AND ";
	$iP['dsplit'] = true;
  //	echo serialize($iP);
  //	wt_print_array($this->_tpl_vars['fields_value']);
{/php}

<style type="text/css">
{literal}
	.selectItem { width: 98%; height:300px; overflow-y: auto; background: #efefef; border: 1px solid #CCCCCC; }
	.selectItem TABLE { width: 96%; }
	.selectItem TABLE TD { vertical-align: top; padding: 5px; }
	.selectItem TABLE .row2 { background: #FFF; }
	.selectItem small { font-size: 9px; color: #808080; }
	.selectItem .sel { background: #FFFF97; }
	.selectItem .ch { width: 15px; }
	.selectItem .l { width: 50px; }
	.sel { background: #bafab6 !important;}
	.row2 { background: #ccc;}
	.selectItem td { border-bottom: 1px solid #fff;}
	.selectItem .lng IMG { margin: 4px 4px 0 0;  }
{/literal}
</style>
{literal}
<script type="text/javascript">
selectItem2Item = function(elem) {
	if($(elem).checked) {
		$(elem).up('tr').addClassName('sel');
	} else {
		$(elem).up('tr').removeClassName('sel');
	}
}
setIt2ItRowClick = function (elem) {
	//if(elem).
	
	if($(elem).tagName.toLowerCase()=='tr') {
		checkBox = $(elem).down('input[type="{/literal}{if $fic.fi_type == "multi_select_item"}checkbox{else}radio{/if}{literal}"]');
	} else {
		checkBox = $(elem);
	}
	if( $(checkBox).checked == true ) {
		$(checkBox).checked = false; 
	} else {
		$(checkBox).checked = true;
	}
	setIt2ItRowChecked(elem);
}
setIt2ItRowChecked = function (elem) {
	//xshow(elem);
	if($(elem).tagName.toLowerCase()=='tr') {
		checkBox = $(elem).down('input[type="{/literal}{if $fic.fi_type == "multi_select_item"}checkbox{else}radio{/if}{literal}"]');
		row = $(elem);
	} else {
		checkBox = $(elem);
		row = $(elem).up('tr');
	}
	
	if( checkBox.checked == true ) {
		row.addClassName('sel');
	} else {
		row.removeClassName('sel');
	}
	Interface.enableFormSubmitFields();
}
</script>
{/literal}

<h2>{$fic.fi_name}</h2>
{assign var=fiid value=$fic.fi_id}
<div class="selectItem" {if !$field_items}style="height: auto"{/if}>
<table cellspacing="0" cellpadding="0">
{foreach from=$field_items item="fit"}
	<tr onclick="setIt2ItRowClick(this);" class="{cycle values="row1,row2"} {if (is_array($fields_value.$fiid) && in_array($fit.it_id, $fields_value.$fiid)) || $fit.it_id == $fields_value.$fiid} sel{/if}">
		<td class="ch">
			{if $fic.fi_type == "multi_select_item"}
				<input type="checkbox"  onclick="setIt2ItRowClick(this); setIt2ItRowChecked(this);" name="fi[{$fic.fi_id}][]" value="{$fit.it_id}" {if is_array($fields_value.$fiid) && in_array($fit.it_id, $fields_value.$fiid)} checked="checked"{/if} />
			{elseif $fic.fi_type == "select_item"}
				<input type="radio" name="fi[{$fic.fi_id}]" value="{$fit.it_id}" {if $fit.it_id == $fields_value.$fiid} checked="checked"{/if} />
			{/if}
		</td>
		<td class="l">{wt_thumb_image 	
		src="mod_structure/`$fit.source_id`/`$fit.it_logo`"  
		width="50"
		height="40"
		compress="75"
		scale="10"
		show_blank="1"}</td>
		<td class="d">
			{if $fit.it_name2}<b>{$fit.it_name}</b><br />{/if} {if $fit.itt_key == "shortcut"}<small>Skrót do: </small>{elseif $fit.itt_key == "copy"}<small>Kopia: </small>{/if} {if $fit.it_name2} <b>{$fit.it_name2}</b> {else} <b>{$fit.it_name}</b> {/if}<br />
<small>{$fit.it_desc_short|strip_tags|truncate:100}</small>
{if $__languages__ && $fit.itt_disable_languages != "1"}<div class="lng">{foreach from=$fit.languages_status key=i item=s}<img src="{$__imageRoot__}/flags/{$__languagesid__.$i.code}.gif" alt="{$__languagesid__.$i.name}" align="absmiddle"  {if $s == 0}class="ld"{/if} />{/foreach}</div>{/if}
		</td>
	</tr>
{foreachelse}
	<tr class="row2"><td colspan="3" align="center">nie znaleziono wartości dla pola: {$fic.fi_name}</td></tr>
{/foreach}
</table>
</div>
