{input name="action"}
{input name="submit_type"} 

{if $action == "edit"}
{input name="dID"}
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
			<a href="#" class="offtab" onClick="addDefinitionTab.cycleTab(this.id); return false" id="tab1">Dane ogólne</a>
		</td>
 		<td class="eL_form" valign="top"><div id="eL_form">
		<div class="eL_formC">
			<div class="hide" id="page1">
				<h1>Dane ogólne</h1>
					{label for="dc_name"}
					{input name="dc_name"}
					
					{label for="dc_key"}
					{input name="dc_key"}
					
					{label for="dc_section"}
					{input name="dc_section"}	
					
					{label for="mod_key"}
					{input name="mod_key"}	
					
					{label for="dc_desc"} 
					{input name="dc_desc"}
					<div class="eL_tao">
						<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('dc_desc', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('dc_desc', '-'); return false">mniej</a> miejsca</div>
			</div>
			
</div></div></td>

</tr>
</table>