<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="pl" />
<meta name="Keywords" content="{$__metaKeys__}" />
<meta name="Description" content="{$__metaDesc__}" />
<meta name="Author" content="ARENA INTERNET (www.arena.net.pl)" />
<meta name="Robots" content="ALL" />
<meta http-equiv="Imagetoolbar" content="NO" />
<link rel="shortcut icon" href="{$__imageRoot__}/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="{$__imageRoot__}/favicon.ico" type="image/x-icon"/>
	<title>{$__siteTitle__}</title>
	<script type="text/javascript" src="{$__jsRoot__}/jquery.js"></script>
	<script type="text/javascript" src="{$__jsRoot__}/jquery.cycle.js"></script>
	<script type="text/javascript" src="{$__jsRoot__}/bootstrap.min.js"></script>
	{*
	<script type="text/javascript" src="{$__jsRoot__}/jquery.nyromodal.js"></script>
	*}
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="{$__jsRoot__}/jquery.nyroModal.custom.js"></script>
	<script type="text/javascript" src="{$__jsRoot__}/coin-slider.min.js"></script>
	<script type="text/javascript" src="{$__jsRoot__}/app.js"></script>
	<!--[if IE 6]>
		<script type="text/javascript" src="js/jquery.nyroModal-ie6.min.js"></script>
	<![endif]-->

	<style type="text/css" media="all">
		@import "{$__cssRoot__}/bootstrap.min.css";
		@import "{$__cssRoot__}/nyroModal.css";
		@import "{$__cssRoot__}/coin-slider-styles.css";
	</style>
	{$__header__}
</head>
<body>
<div class="frame">
<div class="container page">
	<div class="cont mpbg {if $smarty.get.mod == "3" || $smarty.get.mod == ""}{/if}">
		<a class="logo" href="{wt_href_tpl_link mod_key="home"}" title=" {$smarty.const.SITE_NAME} "></a>
		{wt_push_column column="1"}
		{wt_push_module}
	</div>
	{wt_push_column column="2"}
	<img class="footbg" src="{$__imageRoot__}/footbg.jpg" alt="">
</div>
</div>

<script type="text/javascript">
{literal}
$(function() {
  $('.nyroModal').nyroModal();
});
{/literal}
</script>
{$__footer__}{literal}
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-44193491-1', 'klmchauffeurs.com');
  ga('send', 'pageview');
</script>{/literal}
</body>
</html>
