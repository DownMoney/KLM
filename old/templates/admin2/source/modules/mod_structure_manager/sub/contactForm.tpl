<ul id="contactForm_form_list">

	{foreach from=$fields_value[$fic.fi_id].form item=it key=n}
	<li id="thelist_{$n}">
	<table id="rowT_{$n}" width="550">
	<tbody>
	<tr>
	<td class="form_field_Tdesc">
	<span id="label_{$n}" onclick="editField('{$n}'); return false" style="cursor: pointer; {if $it.required == "1"}color: #f00;{/if}" class="form_field_label">{$it.name}</span>
	<span id="desc_{$n}" onclick="editField('{$n}'); return false" style="cursor: pointer;" class="form_field_desc">{$it.desc}</span>
	</td>
	
	<td class="form_field_fields">
		<input name="fi[{$fic.fi_id}][form][{$n}][name]" value="{$it.name}" id="it_value_{$n}_name" type="hidden">
		<input name="fi[{$fic.fi_id}][form][{$n}][desc]" value="{$it.desc}" id="it_value_{$n}_desc" type="hidden">
		<input name="fi[{$fic.fi_id}][form][{$n}][type]" value="{$it.type}" id="it_value_{$n}_type" type="hidden">
		{if $it.required}
			<input name="fi[{$fic.fi_id}][form][{$n}][required]" value="{$it.required}" id="it_value_{$n}_required" type="hidden">
		{/if}
		{if $it.size}
			<input name="fi[{$fic.fi_id}][form][{$n}][size]" value="{$it.size}" id="it_value_{$n}_size" type="hidden">
		{/if}
		{if $it.asEmail}
			<input name="fi[{$fic.fi_id}][form][{$n}][asEmail]" value="{$it.asEmail}" id="it_value_{$n}_asEmail" type="hidden">
		{/if}
		{if $it.cols}
			<input name="fi[{$fic.fi_id}][form][{$n}][cols]" value="{$it.cols}" id="it_value_{$n}_cols" type="hidden">
		{/if}
		{if $it.rows}
			<input name="fi[{$fic.fi_id}][form][{$n}][rows]" value="{$it.rows}" id="it_value_{$n}_rows" type="hidden">
		{/if}
		{if $it.options}
			<input name="fi[{$fic.fi_id}][form][{$n}][options]" value="{$it.options}" id="it_value_{$n}_options" type="hidden">
		{/if}
		<span id="form_field_fields_{$n}">
			{if $it.type == "text"}
				<input type="text" {if $it.size > 0} size="{$it.size}"{/if} id="ncFF_{$n}" />
			{elseif $it.type == "date"}
				<input type="text" {if $it.size > 0} size="{$it.size}"{/if} id="ncFF_{$n}" value="dd-mm-rrrr" /> <img src="{$__imageRoot__}/icons/calendar_add.png" align="absmiddle" alt="" />
			{elseif $it.type == "textarea"}	
				<textarea id="ncFF_{$n}" {if $it.cols > 0} cols="{$it.cols}"{/if} {if $it.rows > 0} rows="{$it.rows}"{/if}></textarea>
			{elseif $it.type == "select"}	
				<select id="ncFF_{$n}">
						<option value="">--- wybierz ---</option>
					{foreach from=$it.options key=index item="opt"}
						<option value="{$index}">{$opt}</option>
					{/foreach}
				</select>
				{foreach from=$it.options key=index item="opt"}
					<input id="it_value_{$n}_options_{$index}" type="hidden" value="{$opt}" name="fi[{$fic.fi_id}][form][{$n}][options][{$index}]" />
				{/foreach}
			{elseif $it.type == "radio"}	
				{foreach from=$it.options key=index item="opt"}
					<input type="radio" name="radio_{$index}" value="{$index}" /> {$opt}<br />
				{/foreach}
				{foreach from=$it.options key=index item="opt"}
					<input id="it_value_{$n}_options_{$index}" type="hidden" value="{$opt}" name="fi[{$fic.fi_id}][form][{$n}][options][{$index}]" />
				{/foreach}
			{elseif $it.type == "checkbox"}	
				{foreach from=$it.options key=index item="opt"}
					<input type="checkbox" name="checkbox_{$index}" value="{$index}" /> {$opt}<br />
				{/foreach}
				{foreach from=$it.options key=index item="opt"}
					<input id="it_value_{$n}_options_{$index}" type="hidden" value="{$opt}" name="fi[{$fic.fi_id}][form][{$n}][options][{$index}]" />
				{/foreach}
			{/if}
		
		</span>
	</td>
	<td class="form_field_Top">
	<a href="#" onclick="move_li('contactForm_form_list', 'thelist_{$n}', 'up'); return false"><img src="{$__imageRoot__}/order_arrow_up.gif"></a>
	<a href="#" onclick="move_li('contactForm_form_list', 'thelist_{$n}', 'down'); return false"><img src="{$__imageRoot__}/order_arrow_down.gif"></a>
	<a href="#" onclick="editField('{$n}'); return false"><img src="{$__imageRoot__}/icons/icon_edit.gif"></a>
	<a href="#" onclick="delField('{$n}'); return false"><img src="{$__imageRoot__}/icons/icon_del.gif"></a>
	
	
	</td>
</tr>
</tbody>
</table>
  </li>	
	{/foreach}
</ul>