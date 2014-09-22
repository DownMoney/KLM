{input name="action"}
{input name="submit_type"}
{input name="list_fields_changed"}
{input name="tree_fields_changed"}

{if $action == "edit"}
{input name="tID"}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/{$item.itt_ico}.gif" align="absmiddle" alt="{$type.itt_name|strip_quotas}" /> {$item.itt_name}
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/content.gif" align="absmiddle" /> NOWY TYP
			{/if}
			</div>
			<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}</div>
		</td>
	</tr>
	<tr>
	<td colspan="2" id="eL_formSavingOptions" class="eL_formOptions" align="right">najpierw {input name="action_save"} potem {input name="action_after"}</td>
	</tr>
	<tr>
		<td class="eL_nav">
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab1">Ustawienia</a>
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab2">Parametry</a><br /><br />


			&nbsp;&nbsp;structure_add:<br />
			{foreach from=$fields item="fic"}
			<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tabf_{$fic.fi_id}">{$fic.fi_name}</a>
			{/foreach}
		</td>
		<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">
			<div class="hide" id="page1">
				<h1>[TREŚĆ]</h1>
				{label for="itt_name"}
				{input name="itt_name"}

				{label for="itt_key"}
				{input name="itt_key"}
				<table>
					<tr>
						<td>{label for="itt_sefu_id"}</td>
						<td>{label for="itt_sefu_ignore"}</td>
						<td>{label for="itt_sefu_treat_as_file"}</td>
					</tr>
					<tr>
						<td>{input name="itt_sefu_id"}</td>
						<td>{input name="itt_sefu_ignore"}</td>
						<td>{input name="itt_sefu_treat_as_file"}</td>
					</tr>
				</table>

				{label for="itt_ico"}
				{input name="itt_ico"}

				{label for="itt_desc"}
				{input name="itt_desc"}


			 <table cellspacing="0" class="typeOptions">
			 	<tr>
					<td>{label for="itt_nochildren"}</td>
					<td style="background: #F0F0F0;">{label for="itt_root_show"}</td>
					<td>{label for="itt_root_edit"}</td>
					<td style="background: #F0F0F0;">{label for="itt_root_addchildren"}</td>
					<td>{label for="itt_disable_languages"}</td>
					<td style="background: #F0F0F0;">{label for="itt_mod_structure_add_show"}</td>
				</tr>
				<tr>
					<td align="center">{input name="itt_nochildren"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="itt_root_show"}</td>
					<td align="center">{input name="itt_root_edit"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="itt_root_addchildren"}</td>
					<td align="center">{input name="itt_disable_languages"}</td>
					<td align="center">{input name="itt_mod_structure_add_show"}</td>
				</tr>
			 </table>

			  <style type="text/css">
			  	{literal}
					.typeOptions { float: left; margin: 10px 0 0 0; clear:both; }
					.typeOptions TD { padding: 0 10px; }
				{/literal}
			  </style>
<br class="c" />


				<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td>{label for="itt_children_only"}</td>
					<td>{label for="itt_children_only_tree"}</td>
				</tr>
				<tr>
					<td align="center">{input name="itt_children_only"}</td>
					<td align="center">{input name="itt_children_only_tree"}</td>
				</tr>
			 </table>

	</div>



	<div class="hide" id="page2">
		<h1>[PARAMETRY]</h1>
		{include file="`$__templateFSRoot__`admin2/source/params.tpl"}
	</div>

	{foreach from=$fields item="fic"}
	<div class="hide" id="pagef_{$fic.fi_id}">
		<h1>[{$fic.fi_name|upper}]</h1>
		<table cellspacing="0">
		<tr>
			<td>{label for="fields_`$fic.fi_id`_params_add_show"}</td>
			<td>{input name="fields_`$fic.fi_id`_params_add_show"}</td>
		</tr>
		</table>
		{foreach from=$fic.children item="f"}
		<div onclick="Element.toggle('par_{$f.fi_id}');" class="formParamsGroup">{$f.fi_name}</div>
		<div style="display: none;" id="par_{$f.fi_id}" class="formParamsGroupContent">
				<table>
				<tr>
				<td>
				{label for="fields_`$f.fi_id`_params_add_show"}
				</td>
				<td>
				{input name="fields_`$f.fi_id`_params_add_show"}
				</td>
				</tr>
				<tr>
				<td>
				{label for="fields_`$f.fi_id`_params_ValidateAsNotEmpty"}
				</td>
				<td>
				{input name="fields_`$f.fi_id`_params_ValidateAsNotEmpty"}
				</td>
				</tr>
				{if $f.fi_type=="text"}
					{php}
					$f_array = array(
						'ValidateAsEmail',
						'ValidateAsInteger',
						'ValidateAsVatId',
						'ValidateAsFloat',
						'ValidateRegularExpression',
						'ValidateMinimumLength',
					);
					$this->assign('f_array', $f_array);
					{/php}
					{foreach from=$f_array item=ff}
						<tr>
						<td>{label for="fields_`$f.fi_id`_params_add_`$ff`"}{*$ff*}</td>
						<td>{input name="fields_`$f.fi_id`_params_add_`$ff`"}</td>
						</tr>
					{/foreach}
				{elseif $f.fi_type=="date" || $f.fi_type=="datetime"}

					{php}
					$f_array = array(
						'ValidateDateForm',
						'ValidateDateTo',
					);
					$this->assign('f_array', $f_array);
					{/php}
					{foreach from=$f_array item=ff}
						<tr>
						<td>{label for="fields_`$f.fi_id`_params_add_`$ff`"}{*$ff*}</td>
						<td>{input name="fields_`$f.fi_id`_params_add_`$ff`"}</td>
						</tr>
					{/foreach}
				{elseif $f.fi_type=="textarea"}

					{php}
					$f_array = array(
						'ValidateMinimumLength',
					);
					$this->assign('f_array', $f_array);
					{/php}
					{foreach from=$f_array item=ff}
						<tr>
						<td>{label for="fields_`$f.fi_id`_params_add_`$ff`"}{*$ff*}</td>
						<td>{input name="fields_`$f.fi_id`_params_add_`$ff`"}</td>
						</tr>
					{/foreach}
				{elseif $f.fi_type=="gallery" || $f.fi_type=="files"}

					{php}
					$f_array = array(
						'ValidateFileMinX',
						'ValidateFileMinY',
						'ValidateFileMaxX',
						'ValidateFileMaxY',
						'ValidateFileMaxSize',
						'ValidateFileConfirmedTypes',
						'ValidateFileMaxCount',
						'ValidateFileMinCount',
					);
					$this->assign('f_array', $f_array);
					{/php}
					{foreach from=$f_array item=ff}
						<tr>
						<td>{label for="fields_`$f.fi_id`_params_add_`$ff`"}{*$ff*}</td>
						<td>{input name="fields_`$f.fi_id`_params_add_`$ff`"}</td>
						</tr>
					{/foreach}
				{/if}
				</table>
		</div>
		{/foreach}
	</div>
	{/foreach}

</div></div></td>
</tr>
</table>
