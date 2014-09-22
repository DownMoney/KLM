<table width="200" height="100%" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top" height="100%" id="sT"></td>
</tr>
{if $structure_modules}
<tr>
	<td class="sM">
	{foreach from=$structure_modules item=m name="structure"}
		<a href="#" onClick="loadModule('{wt_mod_id m=$m.k}', '{$m.n}'); return false" title=" {$m.n|strip_quotas} "><img src="{$__imageRoot__}/modules/{$m.k}_s.gif" align="absmiddle" alt="">{$m.n}</a>
	{/foreach}
	<span style="float:left;" class="czyIExplorerJestNieNormalny"><b></b></span>
	</td> 
</tr>
{/if}
</table>