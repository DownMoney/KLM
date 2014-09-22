<table class="adminheading">
{if $action eq "edit"}
<th>Edycja menu #{$db_menu.menu_id} - {$db_menu.menu_name}</th>
{else}
<th>Nowy menu</th>
{/if}
</table>
 

<table cellspacing="0" cellpadding="4" border="0" width="100%" >
  <tr>
    <td width="" class="separator">&nbsp;</td>
    <td id="tab1" class="offtab" onClick="dhtml.cycleTab(this.id)">Ogólne</td>
    <td width="90%" class="separator">&nbsp;</td>
  </tr>
</table>
  
{$addMenu_form}
 
{literal}
<script language="javascript" type="text/javascript"><!--
		dhtml.cycleTab('tab1');
		//--></script> 
{/literal}