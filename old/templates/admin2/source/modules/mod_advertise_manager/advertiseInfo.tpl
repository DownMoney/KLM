{if $item}
<table >
<tr>
<td><b>Adres URL:</b></td>
<td><a href="http://{$item.ad_url}" target="_blank">{$item.ad_url|truncate:"30":"..."}</a></td>
</tr>
<tr>
<td><b>Otwiera w:</b></td>
<td>{$item.ad_target_text}</td>
</tr>
<tr>
<td><b>Wyświetleń:</b></td>
<td>{$item.display_count}</td>
</tr>
<tr>
<td><b>Kliknięć:</b></td>
<td>{$item.hits_count}</td>
</tr>
<tr>
<td><b>Skuteczność:</b></td>
<td>{if $item.display_count > 0}{$item.hits_count/$item.display_count|string_format:"%.3f"} {else} 0{/if}%</td>
</tr>
<tr>
<td colspan="2"><div style="height: 200px; width: 500px; overflow:auto;">{$item.display_code}</div></td>
</tr>
</table>

{else}
NIE ZNALEZIONO INFORMACJI
{/if} 