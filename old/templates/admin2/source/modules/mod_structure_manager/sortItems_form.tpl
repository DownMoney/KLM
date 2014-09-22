{hiddeninput name="action"} 
{hiddeninput name="ca_id"}

<div id="action_window">
	<h1 id="action_window_title">
	<a href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
	Sortowanie</h1>
	<div id="action_window_content">
		<table width="100%">
			<tr>
				<td width="50%"><b>Kolejność</b></td>
				<td><b>{label for="fi_id"}</b></td>
			</tr>
			<tr>
				<td valign="top">{input name="desc"} {label for="desc"}<br />
				{input name="asc"} {label for="asc"}<br /></td>
				<td>{input name="fi_id"}</td>
			</tr>
		</table>
	</div>

	<div id="action_window_buttons">
		{input name="cancel_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
	</div>
</div>