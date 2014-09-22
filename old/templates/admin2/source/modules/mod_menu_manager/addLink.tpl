<h1>
{if $action eq "edit"}
Edycja linku #{$db_link.link_id} - {$db_link.link_name}
{else}
Nowy link
{/if}
</h1>
 <a href="#" id="tab1" class="offtab" onClick="tab.cycleTab(this.id); return false">Ogólne</a>
 <a href="#" id="tab2" class="offtab" onClick="tab.cycleTab(this.id); return false">Wygląd</a>  
{$addLink_form} 
{literal}
<script language="javascript" type="text/javascript">
		tab = new tabs();
		tab.cycleTab('tab1');
</script> 
{/literal}