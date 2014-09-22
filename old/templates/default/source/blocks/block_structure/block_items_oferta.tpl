<div class="bl_offer">
{foreach from=$BL_items item="it" name="BL_items"}
	<div class="bl_offer_div {if $smarty.foreach.BL_items.first}offFirst{/if}">
		<h3><a href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$it.cPath`"}" title=" {$it.it_name|strip_quotas} ">{$it.it_name}</a></h3>
		<a class="bl_{$it.it_id}" href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$it.cPath`"}" title=" {$it.it_name|strip_quotas} "><img src="{$__imageRoot__}/bl_{$it.it_id}.jpg" alt=""></a>
	</div>
{/foreach}
