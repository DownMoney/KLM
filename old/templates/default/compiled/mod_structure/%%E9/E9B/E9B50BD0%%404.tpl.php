<?php /* Smarty version 2.6.16, created on 2013-04-25 13:24:56
         compiled from 404.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', '404.tpl', 7, false),)), $this); ?>
<?php if ($_GET['mod'] == 6 && $this->_tpl_vars['__userInfo__']):  if ($_GET['t'] == 'nPP'): ?>
<h1>BRAK DOSTĘPU DO TEJ CZĘŚCI STRONY</h1>
<p>Nie masz uprawnień do przeglądania tej części strony.</p>
<?php else: ?>
	<script type="text/javascript">
		document.location.href = '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_admin_manager'), $this);?>
';
	</script>
<?php endif;  else: ?>
<h1>Błąd 404 - nie można odnaleźć strony</h1>
Przepraszamy ale nie możemy wyświetlić żądanej strony.<br />
Prawdopodobnie podstrona o tym adresie została wyłączona lub nie istnieje, przejdź na <a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'home'), $this);?>
">stronę główną</a> serwisu i tam sprawdź odpowiednią nawigację. 
<?php endif; ?>