{input name="action"} 
{input name="submit_type"}
{if $action == "edit"}
{input name="uID"}
{input name="old_status"}
{/if}


<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/content.gif" align="absmiddle" alt="" /> #{$item_data.usr_id} {$item_data.usr_first_name} {$item_data.usr_last_name} {$item_data.usr_email} 
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/content.gif" align="absmiddle" /> NOWY UŻYTKOWNIK
			{/if}
			</div>
			<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}</div>
		</td>
	</tr>

<tr>

<td class="eL_nav"><a href="#" class="offtab" onClick="addUserTab.cycleTab(this.id); return false" id="tab1">Podstawowe dane</a>{if $adm_params.admshow_usr_company || $adm_params.admshow_usr_company_vat_id}<a href="#" class="offtab" onClick="addUserTab.cycleTab(this.id); return false" id="tab2">Firma</a>{/if}
{if $adm_params.admshow_usr_groups || $__isRoot__}<a href="#" class="offtab" onClick="addUserTab.cycleTab(this.id); return false" id="tab4">Grupy</a>{/if}

</td>

<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">

<div class="hide" id="page1">
<h1>[PODSTAWOWE DANE]</h1>

{label for="status"}{input name="status"}
{if $action == "edit"}
<span id="send_active_email_con" style="display:none;">
{label for="send_active_email"}{input name="send_active_email"}
</span>
<script type="text/javascript">
{literal}
Event.observe('status','change', function() { 
  updateStatusActiveEmail();
});
updateStatusActiveEmail = function() {
	if($('status').value == '1') {
		$('send_active_email_con').show();
	} else {
		$('send_active_email_con').hide();
	}
}
{/literal}
</script>
{/if}



{if $adm_params.admshow_usr_first_name}
{label for="usr_first_name"}{input name="usr_first_name"}
{/if}
{if $adm_params.admshow_usr_last_name}
{label for="usr_last_name"}{input name="usr_last_name"}
{/if}
{if $adm_params.admshow_usr_nick}
{label for="usr_nick"}{input name="usr_nick"}
{/if}
{if $adm_params.admshow_usr_login}
{label for="usr_login"}{input name="usr_login"}
{/if}
{if $adm_params.admshow_usr_gender}
{label for="usr_gender"}{input name="usr_gender"}
{/if}
{if $adm_params.admshow_usr_dob}
{label for="usr_dob"}{input name="usr_dob"}
{/if}
{if $adm_params.admshow_usr_email}
{label for="usr_email"}{input name="usr_email"}
{/if}
{if $adm_params.admshow_usr_password}
{label for="usr_password"}{input name="usr_password"}
{label for="usr_password_confirm"}{input name="usr_password_confirm"}
{/if}
{if $adm_params.admshow_usr_image}
{label for="usr_image"}{input name="usr_image"}
{/if}


{if $adm_params.admshow_usr_post_code || $adm_params.admshow_usr_city || $adm_params.admshow_usr_address || $adm_params.admshow_usr_state || $adm_params.admshow_usr_country || $adm_params.admshow_usr_phone || $adm_params.admshow_usr_fax || $adm_params.admshow_usr_mobile || $adm_params.admshow_usr_gg || $adm_params.admshow_usr_tlen || $adm_params.admshow_usr_skype || $adm_params.admshow_usr_www || $adm_params.admshow_usr_other_contact}
<h1>[ADRES UŻYTKOWNIKA]</h1>
{if $adm_params.admshow_usr_post_code}
{label for="usr_post_code"}{input name="usr_post_code"}
{/if}
{if $adm_params.admshow_usr_city}
{label for="usr_city"}{input name="usr_city"}
{/if}
{if $adm_params.admshow_usr_address}
{label for="usr_address"}{input name="usr_address"}
{/if}
{if $adm_params.admshow_usr_state}
{label for="usr_state"}{input name="usr_state"}
{/if}
{if $adm_params.admshow_usr_country}
{label for="usr_country"}{input name="usr_country"}
{/if}
<h1>[DANE KONTAKTOWE UŻYTKOWNIKA]</h1>
{if $adm_params.admshow_usr_phone}
{label for="usr_phone"}{input name="usr_phone"}
{/if}
{if $adm_params.admshow_usr_fax}
{label for="usr_fax"}{input name="usr_fax"}
{/if}
{if $adm_params.admshow_usr_mobile}
{label for="usr_mobile"}{input name="usr_mobile"}
{/if}
{if $adm_params.admshow_usr_gg}
{label for="usr_gg"}{input name="usr_gg"}
{/if}
{if $adm_params.admshow_usr_tlen}
{label for="usr_tlen"}{input name="usr_tlen"}
{/if}
{if $adm_params.admshow_usr_skype}
{label for="usr_skype"}{input name="usr_skype"}
{/if}
{if $adm_params.admshow_usr_www}
{label for="usr_www"}{input name="usr_www"}
{/if}
{if $adm_params.admshow_usr_other_contact}
{label for="usr_other_contact"}{input name="usr_other_contact"}
{/if}

{/if}
</div>

<div class="hide" id="page2">
<h1>[FIRMA]</h1>
{if $adm_params.admshow_usr_company}
{label for="usr_company"}{input name="usr_company"}
{/if}
{if $adm_params.admshow_usr_company_vat_id}
{label for="usr_company_vat_id"}{input name="usr_company_vat_id"}
{/if}

{if $adm_params.admshow_usr_company_address}
{label for="usr_company_address"}{input name="usr_company_address"}
{/if}

{if $adm_params.admshow_usr_company_post_code}
{label for="usr_company_post_code"}{input name="usr_company_post_code"}
{/if}

{if $adm_params.admshow_usr_company_city}
{label for="usr_company_city"}{input name="usr_company_city"}
{/if}

{if $adm_params.admshow_usr_company_state}
{label for="usr_company_state"}{input name="usr_company_state"}
{/if}

<h1>[DANE KONTAKTOWE FIRMY]</h1>
{if $adm_params.admshow_usr_company_phone}
{label for="usr_company_phone"}{input name="usr_company_phone"}
{/if}

{if $adm_params.admshow_company_fax}
{label for="company_fax"}{input name="company_fax"}
{/if}

{if $adm_params.admshow_usr_company_email}
{label for="usr_company_email"}{input name="usr_company_email"}
{/if}

{if $adm_params.admshow_usr_company_www}
{label for="usr_company_www"}{input name="usr_company_www"}
{/if}
</div>

<div class="hide" id="page4">
<h1>[GRUPY]</h1>

<table width="100%">
{foreach from=$groups_tree item=gr}
<tr class="dTR" onmouseover="this.style.backgroundColor='#FFF';" onmouseout="this.style.backgroundColor='';" >
<td onClick="if(document.addUser.groups_{$gr.group_id}.checked == true) {literal} { {/literal} document.addUser.groups_{$gr.group_id}.checked=false;  this.style.backgroundColor='#F0F1F1'; {literal} } {/literal} else {literal} { {/literal} document.addUser.groups_{$gr.group_id}.checked=true; this.style.backgroundColor='#A6FFA6'; {literal} } {/literal}" style="border-bottom: 1px #c0c0c0 solid; cursor: pointer;">{$gr.group_name}</td>
<td width="10" style="border-bottom: 1px #c0c0c0 solid;">{input name=groups_`$gr.group_id`}</td>
</tr>
{/foreach}
</table>

</div>


</div></div></td>

</tr>

<tr>
	<td colspan="2" class="addItemMetaData">#{$item_data.usr_id|default:"nowy"} | Dodano: {$item_data.date_added|date_format:"%a, %d %b %Y @ %T"},  przez: --- | Modyfikowano: {$item_data.last_modified|date_format:"%a, %d %b %Y @ %T"|default:"nigdy"}, przez: ---</td>
</tr>

</table>