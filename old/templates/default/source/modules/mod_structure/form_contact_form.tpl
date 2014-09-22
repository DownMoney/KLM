<div class="well contact_form">
{input name="_t"}
{input name="form_name"}
{input name="contact_form_fi_id"}
		<h2>Formularz kontaktowy</h2>
		<p>
		Aby w łatwy i szybki sposób się z nami skontaktować, wypełnij poniższy formularz. Pola oznaczone kolorem <span class="request">czerwonym</span> są wymagane.</p>
{foreach from=$item.fields_group.contact_form.n.form item="ff" name="fields"}
	{if $smarty.foreach.fields.first || $smarty.foreach.fields.iteration%2 == 0}
	<div class="row">{/if}
	<div class="{if $ff.type == "textarea"}span6{else}span3{/if}">
		{if $ff.type == "radio"}
			{label for="contact_form_`$ff.field_form_name`"}
			{foreach from=$ff.options item="ro"}
				{label for="contact_form_`$ff.field_form_name`_`$ro`"}
				{input name="contact_form_`$ff.field_form_name`_`$ro`" CLASS="span3"}
			{/foreach}
		{elseif $ff.type == "textarea"}
			{label for="contact_form_`$ff.field_form_name`"}
			{input name="contact_form_`$ff.field_form_name`" CLASS="span6"}
		{else}
			{label for="contact_form_`$ff.field_form_name`"}
			{input name="contact_form_`$ff.field_form_name`" CLASS="span3"}
		{/if}
		</div>

	{if $smarty.foreach.fields.last || $smarty.foreach.fields.iteration%2 == 1}</div>{/if}
{/foreach}
		<div class="row" style="text-align: center;">
			{input name="submit_button" CLASS="btn btn-large btn-inverse"}
		</div>
</div>
<style type="text/css">
{foreach from=$item.fields_group.contact_form.n.form item="ff" name="fields"}
{if $ff.required == "1"}#contact_form_{$ff.field_form_name}_label, {/if}
{/foreach}
#aaa {ldelim} color: #E00; {rdelim}
</style>
