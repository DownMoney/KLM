<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<style type="text/css">
{literal}
BODY {background: #fff; }
BODY, TH {vertical-align: top;}
BODY, TD {
 font-family: Arial,Helvetica,Garuda,sans-serif;
	font-size:12px;
	color: #2e2e2e;
	line-height: 130%;
	vertical-align: top;
}
.conMail thead th {text-align: center; padding: 10px;}
.conMail tbody td {text-align: left; padding: 10px; line-height: 150%;}
.conMail tfoot td {text-align: center; padding: 10px; border-top: #e3e3e3 1px solid;}
{/literal}
</style>
</head>
<body>
<table width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" class="conMail">
<thead>
	<tr>
		<th align="center">
			<a href="{wt_href_tpl_link mod_key="home" full_url=true}" title=" {$smarty.const.SITE_NAME} "><img src="{$__imageRoot__}/logo.png" alt="{$smarty.const.SITE_NAME}" border="0" /></a>
		</th>
	</tr>
</thead>
<tbody>
<tr>
	<td>
		Imię i nazwisko: {if $data.imieinazwisko}<strong>{$data.imieinazwisko}</strong><br />{else}---<br />{/if}
		Firma: {if $data.firma}<strong>{$data.firma}</strong><br />{else}---<br />{/if}
		Telefon: {if $data.telefon}<strong>{$data.telefon}</strong><br />{else}---<br />{/if}
		E-mail: {if $data.email}<a href="mailto:{$data.email}"><strong>{$data.email}</strong></a><br />{else}---<br />{/if}
		Wiadomość: {if $data.wiadomosc}{$data.wiadomosc}{else}---{/if}
	</td>
</tr>
</tbody>
<tfoot>
	<tr>
		<td align="center">
			Wiadomość wysłana automatycznie z systemu korespondencyjnego {$smarty.const.SITE_NAME}.<br />
			Prosimy nie odpowiadać na tego e-maila.
		</td>
	</tr>
</tfoot>
</table>
</body>
</html>
