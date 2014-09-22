<ul class="item_list">
{foreach from=$items item=it}
	<li id="{$it.it_id}" class="item_list_element" style="background-color: {cycle values="#F7F7F7,#FFFFFF"} ;">
		<div class="list_image">{wt_thumb_image 	
			src="mod_structure/`$it.it_id`/`$it.it_logo`"
			MAXwidth="50"
			compress="75"
			show_blank="1"
			alt=" `$it.it_name` "
			title=" `$it.it_name` "}</div>
	   	<div class="list_pr_data">
	   		<b><span id="it_name_{$it.it_id}" >{$it.it_name}</span></b><br />
			Typ: <b>{$it.itt_name}</b><br />
	   		Status: <b>{$it.status_text.text}</b><br />
	   		{$it.reverse_path}
		</div>
	</li>
{/foreach}
</ul>