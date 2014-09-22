{assign var=fiid value=$fic.fi_id}
<div style="width:100%;padding: 5px 10px; margin:15px 0 5px 0; background: #efefef; float:left; ">
<h1 style="font-size:17px; margin:0 0 5px 0;">{$fic.fi_name}</h1>
<a class="addSubFormItemLink" href="#" onclick="insertDataTableRow{$fic.fi_id}('top'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj wiersz na początku</a>


<div class="dataTableContent">
<table class="dataTable" cellspacing="0">
	<thead>
		<tr>
				<td style="width:4px;"></td>
			{foreach from=$data_table_params.$fiid.data_table_columns_head_array item="ch"}
				<td>{$ch}</td>
			{/foreach}
				<td class="opt"></td>
		</tr>
	</thead>
</table>
{assign var="next" value=0}
<ol id="dataTable_{$fic.fi_id}">
{foreach from=$fields_value.$fiid item="ch" key="k" name="fields_value"}
<li id="dataTableRow_{$fic.fi_id}_{$smarty.foreach.fields_value.iteration}">
<table class="dataTable" cellspacing="0">
	<tbody>
		<tr>
			{foreach from=$data_table_params.$fiid.data_table_columns_key_array item="name" key="k2"}
				{assign var="next" value=$next+1}
				<td><textarea onkeyup="updateItDesc{$fiid}(this);" autocomplete="off" id="data_table_{$fic.fi_id}_{$next}" rows="1" name="fi[{$fic.fi_id}][{$smarty.foreach.fields_value.iteration}][{$name}]" class="t2" style="overflow: hidden; " >{$fields_value.$fiid.$k.$name|escape}</textarea></td>
				
			{/foreach}
				<td class="opt"><a href="#" onClick="Element.remove('dataTableRow_{$fic.fi_id}_{$smarty.foreach.fields_value.iteration}'); Interface.enableFormSubmitFields(); return false" title="usuń wiersz"><img src="{$__imageRoot__}/trash.png" alt="usuń" /></a></td>
		</tr>
	</tbody>
</table>
</li>
{foreachelse}
<li id="no_rows_in_datable{$fic.fi_id}" style="text-align:center; color:#808080; font-weight:bold;"><h3 style="font-size:13px;">Nie dodałeś jeszcze żadnych wierszy w tej tabeli, aby je dodać kliknij odpowiedni przycisk znajdujący się nad i pod tabelą.</h3></li>
{/foreach}
</ol>

<table class="dataTable" cellspacing="0">
	<thead>
		<tr>
				<td style="width:4px;"></td>
			{foreach from=$data_table_params.$fiid.data_table_columns_head_array item="ch"}
				<td>{$ch}</td>
			{/foreach}
				<td class="opt"></td>
		</tr>
	</thead>
</table>

</div>

<a class="addSubFormItemLink" href="#" onclick="insertDataTableRow{$fic.fi_id}('bottom'); return false"><img src="{$__imageRoot__}/icons_large/plus.gif" alt="dodaj" align="absmiddle" /> dodaj wiersz na końcu</a>


</div>

<script type="text/javascript">
{literal}
makeSortable{/literal}{$fic.fi_id}{literal} = function() {
Position.includeScrollOffsets = true;
Sortable.create('dataTable_{/literal}{$fic.fi_id}{literal}', {constraint: false, scroll: 'eL_form', overlap: 'vertical', onChange: function() { Interface.enableFormSubmitFields(); } });
}


insertDataTableRow{/literal}{$fic.fi_id}{literal} = function(where) {
{/literal}


if($('no_rows_in_datable{$fic.fi_id}')) {literal} { {/literal}
	$('no_rows_in_datable{$fic.fi_id}').remove();
{literal} } {/literal}

next = $('dataTable_{$fic.fi_id}').childNodes.length+2;

rowContent = '<li id="dataTableRow_{$fic.fi_id}_'+next+'">'+
'<table class="dataTable" cellspacing="0">'+
'<tbody>'+
'<tr>'+
{foreach from=$data_table_params.$fiid.data_table_columns_key_array item="name" key="k2"}
'<td><textarea onkeyup="updateItDesc{$fic.fi_id}(this);" autocomplete="off" id="data_table_{$fic.fi_id}_'+next+'" rows="1" name="fi[{$fic.fi_id}]['+next+'][{$name}]" class="t2" style="overflow: hidden; " ></textarea></td>'+{/foreach}
'<td class="opt"><a href="#" onClick="Element.remove(\'dataTableRow_{$fic.fi_id}_'+next+'\'); return false"><img src="{$__imageRoot__}/trash.png" alt="usuń" /></a></td>'+
'</tr>'+
'</tbody>'+
'</tbody></table></li>';
{literal}
	if( where == 'top' ) {
		new Insertion.Top('dataTable_{/literal}{$fic.fi_id}{literal}', rowContent);
	} else {
		new Insertion.Bottom('dataTable_{/literal}{$fic.fi_id}{literal}', rowContent);
	}
Interface.enableFormSubmitFields();
makeSortable{/literal}{$fic.fi_id}{literal}();
}

updateItDesc{/literal}{$fic.fi_id}{literal} = function(elem) {
	elem=$(elem);
	Value = elem.value;
	if(elem.id == 'data_table_587_0') {
		alert('aaaa');
	}
	isChrome = navigator.userAgent.indexOf('Chrome') > -1;
	isChrome = isChrome || Prototype.Browser.WebKit;
	//xshow(navigator.userAgent);
	rows = 1; 
	max_chars_per_line = Math.round(elem.getWidth()/10);
	
		for(i=0; i<Value.length; ++i) {
			if((i%max_chars_per_line == 0 && i > 0) || ((Value.charCodeAt(i)==13 || Value[i]=='\n') && (!isChrome || i<Value.length-1))  ) {
			++rows;
			}
			
		}
	if(Prototype.Browser.Opera) {
		rows/=2;
		++rows;
	}

	elem.rows = rows;
} 
{/literal}
{assign var="next" value=0} 
{literal}
Event.observe($('tab_{/literal}{$maintab_field.fi_gr}{literal}'), 'click', function() { 
	setTimeout(function() { {/literal} 
		{foreach from=$fields_value.$fiid item="ch" key="k"}
			{foreach from=$data_table_params.$fiid.data_table_columns_key_array item="name" key="k2" name="data_table_fields"}
				{assign var="next" value=$next+1}			
				updateItDesc{$fiid}($('data_table_{$fic.fi_id}_{$next}')); 
			{/foreach}	
		{/foreach}			
	{literal}			
	}, 50);
} );
{/literal}

makeSortable{$fic.fi_id}();





</script>

<style type="text/css">
{literal}
	
	.dataTable { width: 100%; table-layout: fixed; }
	
	.dataTableContent { width: 100%; float: left; margin: 10px 0; }
	.dataTableContent ol { margin: 5px 0 0 0; padding: 0 0 0 20px; }
	.dataTableContent LI { margin: 0 0 5px 0; }
	.dataTableContent TEXTAREA { width: 100%; }	
	.dataTableContent TD { padding: 3px 15px 3px 0; vertical-align: top;  }
	.dataTableContent TBODY TD {cursor: n-resize;  }
	
	.dataTableContent .opt { width: 20px; }
	.dataTableContent THEAD { font-weight: bold; background: #c0c0c0;  }
	/* .dataTableContent TD.handler { padding: 0 1px; background: #c0c0c0;  width: 10px; border-right: 5px solid #e2e2e2; } */
	
{/literal}
</style>