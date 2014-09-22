{input name="action"}
{input name="doit"}
<table width="100%" align="center" height="100%">
	<tr>
		<td align="center">
<table width="500" align="center" cellpadding="5">
	<tr>
		<td colspan="2" align="center"><img src="{$__imageRoot__}/logo.gif" alt="" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><h3>Odzyskiwania hasła użytkownika</h3>	</td>
	</tr>
	{if $lP_login_error} 
	<tr>
		<td align="center" colspan="2" id="errorMessage">{$lP_login_error}</td>
	</tr>
	{/if}
	<tr>
		<td>{label for="user_ident"}</td>
		<td>{input name="user_ident"}</td>
	</tr>
	<tr>
		<td align="center" colspan="2">{input name="submit_button"}</td>
	</tr>
	<tr>
		<td align="right" colspan="2"><a class="fPass" href="{wt_href_tpl_link mod_key="mod_admin_manager"}" title=" przypomnienie hasła ">logowanie administratora &raquo;</a></td>
	</tr>		  
</table>
<br />
<br /><br />

</td>
	</tr>		  
</table>