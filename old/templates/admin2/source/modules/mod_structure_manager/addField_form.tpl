{input name="action"} 
{input name="submit_type"}
{input name="list_fields_changed"}
{input name="tree_fields_changed"}
{input name="language_id"}




{if $action == "edit"}
{input name="fID"} 
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/content.gif" align="absmiddle" alt="" /> {$item.fi_name}
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/content.gif" align="absmiddle" /> NOWE POLE
			{/if}
			</div>
			<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}</div>
		</td>
	</tr>
	<tr> 
	<td colspan="2" class="eL_formOptions">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="eL_formOptions-lng">
					{if $__languages__}
					Publikuj w języku:
					{foreach from=$__languages__ item="l" key="k"}
					
					{input name="languages_status_`$l.id`"}					
					<a {if $language_id == $l.id}class="cl"{/if} href="{wt_href_tpl_link get_params="language_id" parameters="language_id=`$l.id`"}" onClick="action_form_large(this.href, '{if $action == "edit"}Edycja wpisu{else}Nowy wpis{/if} - język: {$l.name}'); return false"><img src="{$__imageRoot__}/flags/{$l.code}.gif" alt="{$l.name}" align="absmiddle" />{$l.code}</a>
					{/foreach} 
					{/if}
				</td>
				<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right">najpierw {input name="action_save"} potem {input name="action_after"}</td>
			</tr>
		</table>
	</td>
	</tr>
	<tr>
		<td class="eL_nav">
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab1">Ustawienia</a>
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab2">Parametry</a>
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab3">Params Add</a>
		</td>
		<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">
			<div class="hide" id="page1">
				<h1>[TREŚĆ]</h1>
				{label for="fi_name"}
				{input name="fi_name"}
				
				{label for="fi_name_short"}
				{input name="fi_name_short"}
				
				{label for="fi_gr"}
				{input name="fi_gr"}
				
				{label for="fi_type"}
				{input name="fi_type"}
												
				<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td>{label for="fi_show_on_short"}</td>
					<td style="background: #F0F0F0;">{label for="fi_multi_language"}</td>
					<td>{label for="fi_root_edit"}</td>
					<td style="background: #F0F0F0;">{label for="fi_root_show"}</td>
				</tr>
				<tr>
					<td align="center">{input name="fi_show_on_short"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="fi_multi_language"}</td>
					<td align="center">{input name="fi_root_edit"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="fi_root_show"}</td>
				</tr>
			 </table>	
			 <br class="c" />
			 <style type="text/css">
			  	{literal}
					.typeOptions { float: left; margin: 10px 0 0 0; clear:both; }
					.typeOptions TD { padding: 0 10px; }
				{/literal}	
			  </style>	
				
				<h1>[USTAWIENIA]</h1>
				
				{label for="it_type"}
				{input name="it_type"}
				
				{label for="parent_id"}
				{input name="parent_id"}
				
				{label for="fi_depends_on"}
				{input name="fi_depends_on"}
				
				{label for="fi_related_to"}
				{input name="fi_related_to"}
				
				{label for="has_children"}
				{input name="has_children"}
				
				{label for="import_id"}
				{input name="import_id"}
				
				{label for="fi_key"}
				{input name="fi_key"}
				
				
	</div>
  
	

	<div class="hide" id="page2">
		<h1>[PARAMETRY]</h1>
		{include file="`$__templateFSRoot__`admin2/source/params.tpl"}
	</div>

	<div class="hide" id="page3">
		{php}
			$params_inputs = array(
				'show',
				'ValidateAsNotEmpty',
				'ValidateAsEmail',
				'ValidateAsInteger',
				'ValidateAsFloat',
				'ValidateMinimumLength',
				'ValidateAsVatId',
				'ValidateDateForm',
				'ValidateDateTo',
				'ValidateFileMinX',
				'ValidateFileMinY',
				'ValidateFileMaxX',
				'ValidateFileMaxY',
				'ValidateFileMaxSize',
				'ValidateFileConfirmedTypes',
				'ValidateFileMinCount',
				'ValidateFileMaxCount',
				//'ValidationLowerLimit',
				//'ValidationUpperLimit',
			);
			$this->assign('params_inputs', $params_inputs);
		{/php}
		<h1>[PARAMS ADD]</h1>
		<table id="add_params_table">
		{foreach from=$params_inputs item="inp"}
		<tr class="{$inp}">
		<td>
		{label for="params_add_`$inp`"}
		</td>
		<td align="right">
		{input name="params_add_`$inp`"}
		</td>
		</tr>
		{/foreach}
		</table>
	</div>
</div></div></td>
</tr>
</table>
{literal}
<style type="text/css">
#add_params_table td { border-bottom: 1px solid #bbb; padding: 4px; }
</style>

<script type="text/javascript">

updateValidate = function(elem) {
	fi_type = $F(elem);
	switch(fi_type) {
		case 'text':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty', 'ValidateAsEmail', 'ValidateAsInteger', 'ValidateAsVatId', 'ValidateAsFloat', 'ValidateRegularExpression', 'ValidateMinimumLength', 'ValidationUpperLimit', 'ValidationLowerLimit' );
			break;
		case 'url':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty' );
			break;
		case 'email':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty' );
			break;
		case 'date':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty', 'ValidateDateForm', 'ValidateDateTo' );
			break;
		case 'datetime':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty', 'ValidateDateForm', 'ValidateDateTo' );
			break;
		case 'textarea':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty', 'ValidateMinimumLength');
			break;
		case 'select':
		case 'select_item':
		case 'multi_select_item':
		case 'multi_select': 
		case 'multi_select_group':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty');
			break;
		case 'checkbox':
			var showValidatesParts = new Array('show', 'ValidateAsNotEmpty' );
			break;
		case 'gallery':
			var showValidatesParts = new Array('show', 'ValidateFileMinX', 'ValidateFileMinY', 'ValidateFileMaxX', 'ValidateFileMaxY', 'ValidateFileMaxSize', 'ValidateFileConfirmedTypes', 'ValidateFileMinCount', 'ValidateFileMaxCount' );
			break;
		case 'files':
		case 'file':
			var showValidatesParts = new Array('show', 'ValidateFileMaxSize', 'ValidateFileConfirmedTypes', 'ValidateFileMinCount', 'ValidateFileMaxCount' );
			break;
		default:
			var showValidatesParts = new Array('show');
			//var showValidatesParts = new Array('show', 'ValidateAsNotEmpty', 'ValidateAsEmail', 'ValidateAsInteger', 'ValidateAsVatId', 'ValidateAsFloat', 'ValidateRegularExpression', 'ValidateMinimumLength', 'ValidateDateForm', 'ValidateDateTo', 'ValidateFileX', 'ValidateFileY', 'ValidateFileMaxSize', 'ValidateFileConfirmedTypes', );
			break;
	}
	$$('#add_params_table tr').invoke('hide');
	for(i=0; i<showValidatesParts.length; ++i) {
		$$('.'+showValidatesParts[i]).invoke('show');
	}
	
}

updateValidateChange = function(eve) {
	elem = Event.element(eve);
	updateValidate(elem);	
}

$('fi_type').observe('change', updateValidateChange);
updateValidate($('fi_type'));
</script>
{/literal}
