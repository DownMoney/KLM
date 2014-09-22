{input name="action"}
{input name="submit_type"} 

{if $action == "edit"}
{input name="cID"}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
		<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}
		</div>
		</td>
	</tr>
	<tr>
		<td class="eL_nav" width="150">
			<a href="#" class="offtab" onClick="addConfigurationTab.cycleTab(this.id); return false" id="tab1">Dane ogólne</a>
		</td>
 		<td class="eL_form" valign="top"><div id="eL_form">
		<div class="eL_formC">
			<div class="hide" id="page1">
				<h1>Dane ogólne</h1>
					{label for="configuration_title"}
					{input name="configuration_title"}
					
					{label for="configuration_key"}
					{input name="configuration_key"}
					
					{label for="configuration_value"}
					{input name="configuration_value"}

					{label for="configuration_description"} 
					{input name="configuration_description"}
			</div>
			
</div></div></td>

</tr>
</table>