{if $item}
<table width="100%">
	<tr>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Nazwa parametru:</td>
					<td>{$item.configuration_title}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Opis parametru:</td>
					<td>{$item.configuration_description}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Klucz parametru:</td>
					<td>{$item.configuration_key}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Wartość parametru:</td>
					<td>{$item.configuration_value}</td>
				</tr>	
			</table>
		</td>
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O PARAMETRZE
{/if}