{if $smarty.get.mod == 6 && $__userInfo__}
{if $smarty.get.t == "nPP"}
<h1>BRAK DOSTĘPU DO TEJ CZĘŚCI STRONY</h1>
<p>Nie masz uprawnień do przeglądania tej części strony.</p>
{else}
	<script type="text/javascript">
		document.location.href = '{wt_href_tpl_link mod_key="mod_admin_manager"}';
	</script>
{/if}
{else}
<h1>Błąd 404 - nie można odnaleźć strony</h1>
Przepraszamy ale nie możemy wyświetlić żądanej strony.<br />
Prawdopodobnie podstrona o tym adresie została wyłączona lub nie istnieje, przejdź na <a href="{wt_href_tpl_link mod_key="home"}">stronę główną</a> serwisu i tam sprawdź odpowiednią nawigację. 
{/if}