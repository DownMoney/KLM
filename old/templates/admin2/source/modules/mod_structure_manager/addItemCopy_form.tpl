{input name="action"} 
{input name="submit_type"}
{input name="it_type"}
{input name="parent_id"}
{input name="sort_order"}
{input name="list_fields_changed"}
{input name="tree_fields_changed"}
{input name="language_id"}

{if $action == "edit"}
{input name="iID"} 
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/{$item.itt_ico}.gif" align="absmiddle" alt="{$type.itt_name|strip_quotas}" />{if $item.itt_key == "shortcut"}Skrót do:{elseif $item.itt_key == "copy"}Kopia: {/if} {$item.it_name}
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/{$item_type.itt_ico}.gif" align="absmiddle" /> {if $item_type.itt_key == "shortcut"}NOWY SKRÓT{elseif $item_type.itt_key == "copy"}NOWA KOPIA{/if}
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
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab2">Publikacja</a>
		</td>
		<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">
			<div class="hide" id="page1">
				
				<h1>[USTAWIENIA]</h1>
				{label for="it_name"}
			 	{input name="it_name"} <br />
				
				{label for="item"}
			 	{input name="item"} #{input name="it_id2"}
				
		<div id="itemChoices" class="AutoCompleterList"></div>
		<div id="itemChoiceId"></div>		
		<style type="text/css">
					{literal}
				   #it_id2 { width: 75px; }
					#item { width: 350px; }
					{/literal}
		</style>
		
		<script language="javascript" type="text/javascript">
			{literal}
			updateForm = function(i,s) {
				i.value = $('it_name_'+s.id).innerHTML; 
				$('it_id2').value=s.id;
				{literal}
				new Ajax.Updater('sl_div','{/literal}{wt_href_tpl_link parameters="items&t=getSortList&iID='+s.id+'"}{literal}',
					{asynchronous: true, evalScripts: true});
			}
			
			new Ajax.Autocompleter('item', 'itemChoices', '{/literal}{wt_href_tpl_link parameters="m=items&t=getItemsForAutocompletion"}{literal}', {minChars: 3, afterUpdateElement: updateForm});
			{/literal}
			
						
		</script>
						
	</div>
  	
	<div class="hide" id="page2">
	<h1>[PUBLIKACJA]</h1>
		
		{label for="status"}
		{input name="status"}
		
		{label for="date_up"}
		{input name="date_up"}&nbsp;{input name="date_up_call"}
		
		{label for="date_down"}
		{input name="date_down"}&nbsp;{input name="date_down_call"}
		
	</div>
	
	
  
</div></div></td>
</tr>
</table>