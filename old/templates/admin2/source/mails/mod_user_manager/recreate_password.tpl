<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
{literal}
<style type="text/css">
BODY, TD { font-family: verdana, arial, helvetica, sans-serif; font-size: 12px; color: #000; background: #FFF; }
HR { width: 100%; height: 1px; color: #333; }
h4 { font-family: arial; font-size: 16px; color: #000; margin: 0 0 3px 0; }
IMG { border: 0; }
A { color: #015941; }
A:hover { color: #F78129; }
P { margin: 0 0 10px 0; line-height: 18px; }
.foot { border-bottom: 1px solid #999; border-top: 1px solid #999; text-align: center; padding: 5px; color: #999; font-size: 10px; }
.foot A { color: #808080; }
.logo { float: right; clear: none; margin: 0 0 10px 15px; display: inline; }
</style>
{/literal}

</head>
<body>
<table width="600" align="center">
	<tr>
		<td style="padding: 15px;">
<p>Otrzymaliśmy prośbę o zmianę hasła dostępowego do Twojego konta na {$smarty.const.SITE_NAME} (<a href="{wt_href_tpl_link mod_key="home" full_url=true}" target="_blank">{wt_href_tpl_link mod_key="home" full_url=true}</a>).<br />
Poniżej znajduje się nowe losowo wygenerowane hasło dla Twojego konta.</p>
TWOJE NOWE HASŁO: <b>{$new_pass}</b><br />
<br />
<p>Używając powyższego hasła będziesz mógł poprawnie <a href="{wt_href_tpl_link mod_key="mod_admin_manager" parameters="t=lP" full_url=true}" target="_blank">zalogować się</a> do swojej strony WWW.</p>
</td>
</tr>
<tr>
	<td class="foot">
Wiadomość wysłana automatycznie z systemu korespondencyjnego <a href="{wt_href_tpl_link mod_key="home" full_url=true}" target="_blank">{$smarty.const.SITE_NAME}</a>.<br />
Prosimy nie odpowiadać na tego e-maila.
</td>
</tr>
</table>
</body>
</html>  