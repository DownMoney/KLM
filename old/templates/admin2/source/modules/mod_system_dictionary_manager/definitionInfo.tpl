{if $item}
<table width="100%">
	<tr>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Nazwa:</td>
					<td>{$item.dc_name}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Opis:</td>
					<td>{$cat.dc_desc}</td>
				</tr>
				<tr>
					<td class="infoTableL">Klucz:</td>
					<td>{$item.dc_key}</td>
				</tr>
				<tr>
					<td class="infoTableL">Dział:</td>
					<td>{$item.dc_section}</td>
				</tr>
				<tr>
					<td class="infoTableL">Moduł:</td>
					<td>{$item.mod_key}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O WPISIE
{/if}