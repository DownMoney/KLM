<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="pl" />
<meta name="Author" content="ARENA INTERNET (www.arena.net.pl)" />
<meta name="Robots" content="ALL" />
<meta http-equiv="Imagetoolbar" content="NO" />
<style type="text/css">
{literal}
<!--
body {
	display:block;
	margin: auto;
	width: 100%;
}
FORM {margin:0; padding:0;}

.lp {padding:7px 20px 20px;
width:360px; height: 289px; background: url({/literal}{$__imageRoot__}{literal}/lP_bg.jpg) top no-repeat; font-family: Verdana, Arial, Helvetica, sans-serif;  }
.lp p { font-size:10px; text-align: justify; padding: 0 0 0 90px; margin:0; color: #888; float:right;}
.lp H3 {margin:0 0 1px 0; padding:0; color: #fff; font-family:"Trebuchet MS"; font-size: 21px; text-align: center; width:360px; }
.pola {float: right; width: 288px; } 
#user_ident_label {float: left; color:#0B0100; font-size:13px; font-weight:bold; margin:21px 0 0 0; padding:0 5px 0 0; text-align:right; width:55px; clear: left;}
#user_ident {margin:17px 0 0 0; padding:2px; width:207px; float: left; }
.addUser_sb {float: right; width: 153px; margin: 17px 0 0 0; } 
#submit_button {margin:0; padding:0; background: url({/literal}{$__imageRoot__}{literal}/submit.jpg) no-repeat; width:140px; height: 30px; line-height: 30px; color: #fff; font-weight: bold; cursor: pointer; font-size: 13px; border:0; }
.fP {float: right; width: 351px; color: #da0700; font-size: 11px; border-top: #fff 1px solid; padding: 6px 10px 0 13px; margin: 107px 0 0 0; text-align: right; } 
a.fPass {color: #da0700; text-decoration:none; float: right; margin: 10px 0 0 0;}
a.fPass:hover {color: #000; }
a.arena {float: left; width: 88px; height: 28px; }
#errorMessage { width: 353px; border: 5px solid #F00; padding: 10px; font-size: 14px; color: #F00; font-family:"Trebuchet MS"; margin: 0 0 15px 0; font-weight: bold; }
-->
{/literal}
</style>
<link rel="SHORTCUT ICON" href="{$__imageRoot__}/favicon.ico" /> 
<title>{$smarty.const.SITE_NAME} :: PANEL ADMINISTRACYJNY</title>  
<script type="text/javascript" src="{$__BaseJsRoot__}/general.js"></script>
</head>
<body> 
<table width="100%" align="center" height="100%">
	<tr>
		<td align="center">
			{if $lP_login_error} 
				<div id="errorMessage">{$lP_login_error}</div>
			{/if}
			<div class="lp">
			<h3>Hasło zostało wysłane</h3>			
			<p>Nowe losowo wygenerowane hasło zostało wysłane na podany przez Ciebie adres e-mail. Odbierz swoją pocztę i zaloguj się używając nowego hasła.</p>
			<div class="pola">
						  		
			</div>
			
				<div class="fP">
					<a class="arena" href="http://www.arena.net.pl/" target="_blank" title=" firmowe strony www, sklepy internetowe, multimedia, po prostu Internet od A do Z " ></a>
					<a class="fPass" href="{wt_href_tpl_link mod_key="mod_admin_manager"}" title=" przypomnienie hasła ">logowanie administratora &raquo;</a>
				</div>
			</div>
		</div>
		</td>
	</tr>
</table>
</body>
</html>