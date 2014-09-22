{foreach from=$advertise_data item="ad"}
<fieldset class="adminInfo">
<legend class="adminInfo">#{$ad.ad_id} - {$ad.ad_name}</legend>
<table width="100%">
<tr>
<td align="left" valign="top" {if $ad.image_width}width="{$ad.image_width}"{else}width="25%"{/if}>{$ad.display_code}</td>
<td valign="top">

<table bgcolor="#EFEFEF" width="100%">
<tr><td>

<table class="main">
<tr>
<td><b>ID:</b></td>
<td>{$ad.ad_id}</td>
</tr>
<tr>
<td><b>Nazwa:</b></td>
<td>{$ad.ad_name}</td>
</tr>
<tr>
<td><b>Plik:</b></td>
<td>{$ad.ad_image|default:"---"}</td>
</tr>
<tr>
<td><b>Tytu3:</b></td>
<td>{$ad.ad_title|default:"---"}</td>
</tr>
<tr>
<td><b>Typ:</b></td>
<td>{$ad.ad_type_text}</td>
</tr>
<tr>
<td><b>Status:</b></td>
<td>{$ad.status_text.text}</td>
</tr>
<tr>
<td valign="top"><b>Dost鮺</b></td>
<td valign="top">
<ul>
{foreach item=access_desc from=$ad.access_desc}
<li>&bull; {$access_desc.group_name}</li>
{/foreach}
</ul>
</td>
</tr>
</table>
</td>

<td>

<table class="main">
<tr>
<td><b>URL:</b></td>
<td><a href="{$ad.ad_url}" target="_blank">{$ad.ad_url}</a></td>
</tr>
<tr>
<td><b>Otwieraj w:</b></td>
<td>{$ad.ad_target_text}</td>
</tr>
<tr>
<td><b>Wygasa po:</b></td>
<td>{$ad.ad_expire_clicks} klikni颩ach (0 = nigdy)</td>
</tr>
<tr>
<td><b>Wygasa po:</b></td>
<td>{$ad.ad_expire_display} wy¶wietleniach (0 = nigdy)</td>
</tr>
<tr>
<td><b>Obecnie klikni뤺</b></td>
<td>{$ad.ad_clicks}</td> 
</tr>
<tr>
<td><b>Obecnie wy¶wietle�b></td>
<td>{$ad.ad_display}</td> 
</tr>

</table>
</td>

</tr>
</table>


</td>
</tr>
</table>


</fieldset><br>
{/foreach}
