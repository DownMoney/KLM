{if $item}
<table width="100%">
	<tr>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Nazwa grupy:</td>
					<td>{$item.gr_name}</td>
				</tr>
				<tr>
					<td class="infoTableL">Opis:</td>
					<td>{$item.gr_desc}</td>
				</tr>
				<tr>
					<td class="infoTableL">Liczba reklam:</td>
					<td>{$item.count_advertise}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O GRUPIE
{/if}