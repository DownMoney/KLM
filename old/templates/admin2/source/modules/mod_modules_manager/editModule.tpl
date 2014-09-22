<table class="adminheading">
<th>Edycja modu3u #{$mID} - {$mod_name} ({$md_title})</th>
</table>


<table cellspacing="0" cellpadding="4" border="0" width="100%" >
  <tr>
    <td width="" class="separator">&nbsp;</td>
    <td id="tab1" class="offtab" onClick="dhtml.cycleTab(this.id)">Ogí©®í½¥</td>
    <td width="" class="separator">&nbsp;</td>
    <td id="tab2" class="offtab" onClick="dhtml.cycleTab(this.id); init_editor();">Opis</td>
    <td width="" class="separator">&nbsp;</td>
    <td id="tab4" class="offtab" onClick="dhtml.cycleTab(this.id)">Parametry</td>
   
    <td width="" class="separator">&nbsp;</td>
    <td id="tab5" class="offtab" onClick="dhtml.cycleTab(this.id)"><nobr>Meta tagi</nobr></td>
    
    <td width="75%" class="separator">&nbsp;</td>
  </tr>
</table>



<link rel="stylesheet" type="text/css" href="{$__BaseJsRoot__}/calendar/calendar-mos.css" />
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar/calendar.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar/lang/calendar-pl.js"></script>

{$form}
 

{literal}



<script language="javascript" type="text/javascript"><!--
		dhtml.cycleTab('tab1');
		//--></script> 
                 
		
{/literal}