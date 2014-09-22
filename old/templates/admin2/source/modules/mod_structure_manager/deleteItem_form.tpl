{input name="action"}
{input name="ca_id"}
{input name="cPath"}
{input name="_return2"}

{if $items_to_delete}
{foreach from=$items_to_delete item=it_id}
{input name=it_id_$it_id}
{/foreach}
{/if}

<div id="action_window">
<a style="float:right;" href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
	<h1 id="action_window_title">
	Usuwanie wpisów</h1>
	<div id="action_window_content">
		<table width="100%">
			<tr>
				<td><span class="Alert">UWAGA: </span><br>
					Usuwając ten wpis usuniesz również wszystkie <b>wpisy, galerie i zdjęcia</b> należące do tego wpisu.
				</td>
			</tr>
			<tr>
				<td><b>Usuniętych zostanie:</b><br>
				- <span class="Alert">{$count_items}</span> wpisów<br>
				</td>
			</tr>
		</table>
	</div>

	<div id="action_window_buttons">
	{input name="cancel_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
	</div>

</div>