{hiddeninput name="action"} 
<table style="width: 100%;" align="center">
<tr>
<td class="infoBoxContent">
<span class="Alert">UWAGA: </span><br>
Link jak i wszystkie linki podrz�dne do tego linku zostani� <span class="Alert">bezpowrotnie usuni�te</span> z bazy danych.<br><br>

<b>W sumie zostanie usuni�tych: </b><br>
{if $links_to_delete}
{foreach from=$links_to_delete item=link_id}
{hiddeninput name=link_id_`$link_id`}
{/foreach}
<span class="Alert">{$count_links}</span> link�w<br>
{/if}

</td>
</tr>

<td class="infoBoxContent"><br></td>
</tr> 
<tr><td class="infoBoxOptionButtons" style="text-align: center;">
{input name="cancel_button"}&nbsp;{input name="submit_button"}
</td></tr>
</table>
