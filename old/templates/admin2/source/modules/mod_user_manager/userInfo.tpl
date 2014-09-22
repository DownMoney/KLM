{if $item}
<table width="100%">
<tr>
	<td width="33%">
	<table class="infoTable">
<tr>
<td class="infoTableL">NR ID:</td>
<td>{$item.usr_id}</td>
</tr>
<tr>
<td class="infoTableL">Imię:</td>
<td>{$item.usr_first_name}</td>
</tr>
<tr>
<td class="infoTableL">Nazwisko:</td>
<td>{$item.usr_last_name}</td>
</tr>
<tr>
<td class="infoTableL">Pseudonim/ksywka:</td>
<td>{$item.usr_nick}</td>
</tr>
<tr>
<td class="infoTableL">Login:</td>
<td>{$item.usr_login}</td>
</tr>
<tr>
<td class="infoTableL">Płeć:</td>
<td>{$item.user_gender_text}</td>
</tr>
<tr>
<td class="infoTableL">Data urodzenia:</td>
<td>{$item.usr_dob}</td>
</tr>
<tr>
<td class="infoTableL">Firma:</td>
<td>{$item.usr_company}</td>
</tr>
<tr>
<td class="infoTableL">NIP firmy:</td>
<td>{$item.usr_company_vat_id}</td>
</tr>
<tr>
<td class="infoTableL">Kraj:</td>
<td>{$item.usr_country}</td>
</tr>
<tr>
<td class="infoTableL">Województwo:</td>
<td>{$item.usr_state}</td>
</tr>
<tr>
<td class="infoTableL">Miasto:</td>
<td>{$item.usr_city}</td>
</tr>
<tr>
<td class="infoTableL">Kod pocztowy:</td>
<td>{$item.usr_post_code}</td>
</tr>
<tr>
<td class="infoTableL">Adres:</td>
<td>{$item.usr_address}</td>
</tr>
<tr>
<td class="infoTableL">Pełny adres:</td>
<td>
{if $item.usr_company}
<b>{$item.usr_company}<br />
{/if}
{if $item.usr_first_name || $item.usr_last_name}
{$item.usr_last_name} {$item.usr_first_name}<br />
{/if} 
{$item.usr_post_code} {$item.usr_city}<br />
{$item.usr_address}<br />

</td>
</tr>
</table>
	</td>
	<td width="33%">
		<table>
<tr>
<td class="infoTableL">E-mail:</td>
<td><a href="mailto:{$item.usr_email}">{$item.usr_email}</a></td>
</tr>
<tr>
<td class="infoTableL">Telefon:</td>
<td>{$item.usr_phone|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Fax:</td>
<td>{$item.usr_fax|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Telefon kom.:</td>
<td>{$item.usr_mobile|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">GG:</td>
<td>{$item.usr_gg|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Tlen:</td>
<td>{$item.usr_tlen|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Skype:</td>
<td>{$item.usr_skype|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">WWW:</td>
<td>{if $item.usr_www}<a href="http://{$item.usr_www}" target="_blank">{$item.usr_www}</a>{else}---{/if}</td>
</tr>
<tr>
<td class="infoTableL">Inny kontakt:</td>
<td>{$item.usr_other_contact|nl2br|default:"---"}</td>
</tr>
</table>
	</td>
	<td width="33%">
<table>
<tr>
<td class="infoTableL">Numer:</td>
<td>{$item.usr_id}</td>
</tr>
<tr>
<td class="infoTableL">Status:</td>
<td>{$item.status_text.text_on}</td>
</tr>
<tr>
<td class="infoTableL">Dodano:</td>
<td>{$item.date_added}</td>
</tr>
<tr>
<td class="infoTableL">Dodał:</td>
<td>{$item.added_by|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Modyfikowano:</td>
<td>{$item.last_modified|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Modyfikował:</td>
<td>{$item.modified_by|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ostatnie logowanie:</td>
<td>{$item.usr_last_log_date|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ostatnie logowanie IP:</td>
<td>{$item.usr_last_log_ip|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ilość logowań:</td>
<td>{$item.usr_log_count|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ostatnie nieudane logowanie:</td>
<td>{$item.usr_bad_log_date|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ostatnie nieudane logowanie IP:</td>
<td>{$item.usr_bad_log_ip|default:"---"}</td>
</tr>
<tr>
<td class="infoTableL">Ilość nieudanych logowań:</td>
<td>{$item.usr_bad_log_count|default:"---"}</td>
</tr>
</table>
	
	</td>
</tr>
</table>


{else}
NIE ZNALEZIONO INFORMACJI
{/if}