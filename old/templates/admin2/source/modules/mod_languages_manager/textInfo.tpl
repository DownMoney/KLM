{if $item}
<table width="100%">
	<tr>
		<td>
			<table class="infoTable infoTableBG">
				<tr>
					<td class="infoTableL">Klucz:</td>
					<td>{$item.txt_key}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Moduł</td>
					<td>{$item.mod_title|default:'Globalny'}</td>
				</tr>
				{foreach from=$languages item=ln}
				<tr>
					<td class="infoTableL">Wartość(<img src="{$__imageRoot__}/flags/{$ln.code}.gif" alt="{$ln.name}" align="absmiddle" />{$ln.code}):</td>
					<td>
					{if $item.values[$ln.id]}
						{$item.values[$ln.id].txt_value}
					{else}
						<b style="color: #F00">...</b>
					{/if}
					</td>
				</tr>
				
				{/foreach}
				
				
			</table>
		</td>
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O WPISIE
{/if}