<div class="mDesc">
	<div class="mDesc_div">
		<div class="phone">
			Call: {$smarty.const.TEXT_PHONE}
			<span>E-mail: {mailto address=$smarty.const.TEXT_MAIL encode="hex"}</span>
		</div>
		<br clear="all" />
		<h1>{$item.it_name}</h1>
		{foreach from=$items_listing item=it name=items_listing}
		<div class="list {if $smarty.foreach.items_listing.last}listLast{/if}">
			<h2><a href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$it.cPath`"}" title=" Zobacz {$it.it_name|strip_quotas} ">{$it.it_name}</a></h2>
			{if $it._desc_short_from_full}{$it.it_desc_short|strip_tags|truncate:"240"}{else}{$it.it_desc_short}{/if}
			<a class="more" href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$it.cPath`"}" title=" Zobacz {$it.it_name|strip_quotas} ">{$smarty.const.TEXT_MORE} &raquo;</a>
		</div>
		{/foreach}
	</div>
</div>
