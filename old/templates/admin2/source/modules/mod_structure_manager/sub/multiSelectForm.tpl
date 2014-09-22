<style type="text/css">
{literal}
	.multiSelect { width: 300; height:80px; overflow-y: auto; background: #efefef; border: 1px solid #333333; padding: 3px 0; }
	.multiSelect TABLE { width: 280px; }
	.multiSelect TABLE TD { vertical-align: top; padding: 2px 5px; }
	.multiSelect TABLE .row2 { background: #FFF; }
	.multiSelect .sel { background: #FFFF97; }
	.multiSelect .ch { width: 15px; padding: 3px 0 3px 5px; }
	.multiSelect .sel { background: #bafab6 !important;}
	.multiSelect .row2 { background: #ccc;}
	.multiSelect td { border-bottom: 1px solid #fff; cursor: pointer; }
	.multiSelect INPUT { border: 0; margin:0; padding:0; vertical-align: middle; }
{/literal}
</style>

{literal}
<script type="text/javascript">
selectItem2Item{/literal}{$fic.fi_id}{literal} = function(elem) {
	if($(elem).checked) {
		$(elem).up('tr').addClassName('sel');
	} else {
		$(elem).up('tr').removeClassName('sel');
	}
}
setIt2ItRowClick{/literal}{$fic.fi_id}{literal} = function (elem) {
	//if(elem).
	
	if($(elem).tagName.toLowerCase()=='tr') {
		checkBox = $(elem).down('input[type="checkbox"]');
	} else {
		checkBox = $(elem);
	}
	if( $(checkBox).checked == true ) {
		$(checkBox).checked = false; 
	} else {
		$(checkBox).checked = true;
	}
	setIt2ItRowChecked{/literal}{$fic.fi_id}{literal}(elem);
}
setIt2ItRowChecked{/literal}{$fic.fi_id}{literal} = function (elem) {
	//xshow(elem);
	if($(elem).tagName.toLowerCase()=='tr') {
		checkBox = $(elem).down('input[type="checkbox"]');
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

}
</script>
{/literal}

{*wt_print_array a=$fields_value[$fic.fi_id]*}
<div style="width: 320px; float:left;">
<h2 style="text-transform: uppercase; ">{$fic.fi_name}{if ($fic.fi_root_edit == 1 && $__isRoot__) || $fic.fi_root_edit == 0} <a style="text-transform: lowercase;" href="#" onClick="fieldValues('{$fic.fi_id}'); return false">[ dodaj / zmień / usuń ]</a>{/if}</h2>
{assign var=fiid value=$fic.fi_id}
<div class="multiSelect" id="fi_edit_{$fic.fi_id}">
<table cellspacing="0" cellpadding="0">
{foreach from=$fic.children item="fit"}
	<tr onclick="setIt2ItRowClick{$fic.fi_id}(this);" class="{cycle values="row1,row2"} {if (is_array($fields_value.$fiid) && in_array($fit.fi_id, $fields_value.$fiid))} sel{/if}">
		<td class="ch">
				<input type="checkbox"  onclick="setIt2ItRowClick{$fic.fi_id}(this); setIt2ItRowChecked{$fic.fi_id}(this);" name="fi[{$fic.fi_id}][]" value="{$fit.fi_id}" {if is_array($fields_value.$fiid) && in_array($fit.fi_id, $fields_value.$fiid)} checked="checked"{/if} />
		</td>
		<td class="d">{$fit.fi_name}</td>
	</tr>
{foreachelse}
	<tr class="row2"><td colspan="2" align="center">--- brak opcji ---</td></tr>
{/foreach}
</table>
</div>
</div>