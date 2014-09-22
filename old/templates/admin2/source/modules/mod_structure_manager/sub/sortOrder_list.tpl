<ul id="sort_order_list">
	{foreach from=$sort_order key=k item=so}	
		<li id="so_{$k}" onclick="selectSO({$k}); return false" style="background-color: #F7F7F7;">
			{$so}
		</li>
		{/foreach}
</ul>


<script language="javascript" type="text/javascript">
{literal}
var selected_of;

selectSO = function(so) {
	if ($('so_'+so)) {
		if (selected_of!=so && selected_of!=undefined) {
			$('so_'+selected_of).style.backgroundColor = '#F7F7F7';
		}
		$('so_'+so).style.backgroundColor = '#FFFFD7';
		selected_of = so;
		$('sort_order').value=so;
	}
}
if ($('sort_order').value!=undefined && $('sort_order').value!='') {
	selectSO($('sort_order').value);
} else {
	selectSO(-1000);
}
{/literal}
</script>