{if $item_data}
<table id="currentItemInfo" class="currentItemInfo" cellspacing="0">
	<tr>
		<td class="navigationBar">{$__navigationBar__}</td>
	</tr>
	<tr><td class="sep"></td></tr>
	<tr>
		<td>
			<table class="currentItemInfoT" cellspacing="0">
				<tr>
					<td class="currentItemInfoT-d">
						<h3>{$item_data.mod_title}</h3>
					</td>
					<td>&nbsp;</td>
					<td class="currentItemInfoT-t">&nbsp;</td>

					<td class="currentItemInfoT-o">
						<a href="#" onClick="generateFiles({$item_data.mod_id}); return false" onmouseover="parent.displayLeftHint(genFilesHint); return false" onmouseout="parent.hideLeftHint(); return false" title=" generuj "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"> generuj plik</a>
				</tr>
			</table>
		</td>
	</tr>
</table>
{/if}