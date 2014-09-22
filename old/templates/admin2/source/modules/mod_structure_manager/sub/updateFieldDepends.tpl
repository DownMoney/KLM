<option value="">--- wybierz ---</option>
{foreach from=$fields_listing item=f}
	<option value="{$f.fi_id}">{$f.fi_name}</option>
{/foreach}