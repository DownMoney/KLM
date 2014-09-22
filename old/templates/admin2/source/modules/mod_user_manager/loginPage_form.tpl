{input name="action"}
<table width="100%" align="center" height="100%">
	<tr>
		<td align="center">
<table width="500" align="center" cellpadding="5">
	<tr>
		<td colspan="2" align="center"><img src="{$__imageRoot__}/logo.gif" alt="" /></td>
	</tr>
	{if $lP_login_error}
	<tr>
		<td align="center" colspan="2" id="errorMessage">{$lP_login_error}</td>
	</tr>
	{/if}
	<tr>
		<td><label id="usr_email_label" >{$lP_login_type.login_name}: </label></td>
		<td>{input name="`$lP_login_type.tbl_key`"}</td>
	</tr>
	<tr>
		<td><label for="usr_pass" id="usr_pass_label" >Hasło:</label></td>
		<td>{input name="usr_pass"}</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" name="submit_button" value="Zaloguj mnie" id="submit_button" />	</td>
	</tr>
	<tr>
		<td align="right" colspan="2"><a class="fPass" href="{wt_href_tpl_link mod_key="mod_user" parameters="t=rP"}" title=" przypomnienie hasła ">zapomniane hasło &raquo;</a></td>
	</tr>
</table>
<br />
<br />
</td>
	</tr>
</table>
