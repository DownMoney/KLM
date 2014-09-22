{if $item.it_logo || $item.it_desc}
	<div class="mDesc">
		<div class="phone">
		Call: {$smarty.const.TEXT_PHONE}
		<span>E-mail: {mailto address=$smarty.const.TEXT_MAIL encode="hex"}</span>
		</div>
		<div class="mDesc_div">
		{wt_thumb_image
		src="mod_structure/`$item.media_path`/`$item.it_logo`"
		width="240"
		class="logoPds"
		compress="85"
		show_blank="0"
		alt="`$item.it_name`"}{$item.it_desc}
		</div>
	</div>
{/if}
