<?php /* Smarty version 2.6.16, created on 2014-04-01 21:27:55
         compiled from theme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'theme.tpl', 39, false),array('function', 'wt_push_column', 'theme.tpl', 40, false),array('function', 'wt_push_module', 'theme.tpl', 41, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="pl" />
<meta name="Keywords" content="<?php echo $this->_tpl_vars['__metaKeys__']; ?>
" />
<meta name="Description" content="<?php echo $this->_tpl_vars['__metaDesc__']; ?>
" />
<meta name="Author" content="ARENA INTERNET (www.arena.net.pl)" />
<meta name="Robots" content="ALL" />
<meta http-equiv="Imagetoolbar" content="NO" />
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/favicon.ico" type="image/x-icon"/>
	<title><?php echo $this->_tpl_vars['__siteTitle__']; ?>
</title>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/jquery.cycle.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/jquery.nyroModal.custom.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/coin-slider.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/app.js"></script>
	<!--[if IE 6]>
		<script type="text/javascript" src="js/jquery.nyroModal-ie6.min.js"></script>
	<![endif]-->

	<style type="text/css" media="all">
		@import "<?php echo $this->_tpl_vars['__cssRoot__']; ?>
/bootstrap.min.css";
		@import "<?php echo $this->_tpl_vars['__cssRoot__']; ?>
/nyroModal.css";
		@import "<?php echo $this->_tpl_vars['__cssRoot__']; ?>
/coin-slider-styles.css";
	</style>
	<?php echo $this->_tpl_vars['__header__']; ?>

</head>
<body>
<div class="frame">
<div class="container page">
	<div class="cont mpbg <?php if ($_GET['mod'] == '3' || $_GET['mod'] == ""):  endif; ?>">
		<a class="logo" href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'home'), $this);?>
" title=" <?php echo @SITE_NAME; ?>
 "></a>
		<?php echo smarty_function_wt_push_column(array('column' => '1'), $this);?>

		<?php echo smarty_function_wt_push_module(array(), $this);?>

	</div>
	<?php echo smarty_function_wt_push_column(array('column' => '2'), $this);?>

	<img class="footbg" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/footbg.jpg" alt="">
</div>
</div>

<script type="text/javascript">
<?php echo '
$(function() {
  $(\'.nyroModal\').nyroModal();
});
'; ?>

</script>
<?php echo $this->_tpl_vars['__footer__'];  echo '
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');
  ga(\'create\', \'UA-44193491-1\', \'klmchauffeurs.com\');
  ga(\'send\', \'pageview\');
</script>'; ?>

</body>
</html>