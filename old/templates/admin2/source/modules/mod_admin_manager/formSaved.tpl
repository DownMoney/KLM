<script type="text/javascript">
{if $_formType == "popup"}
	
	{if $op != "save"}
		{if $smarty.get._return2}
			parent.document.location.href = '{$site_url}';
		{else}
			parent.window.close();
		{/if}
	{/if}

	{if $opA == "add" && $form_url && $op != "save_close" }
		parent.document.location.href = '{$form_url}';
	{/if}

{else}
{if $op != "save"}
parent.hide_action_form_large(1);
{/if}

{if $opA == "add" && $form_url && $op != "save_close" }
tit = parent.$('navTabForm').innerHTML;
parent.action_form_large('{$form_url}', tit.stripTags());
{/if}

parent.set_success();
{if !$dRT || $dRT != "1"}
parent.setStructureTree();
{/if}

{if !$dRL || $dRL != "1"}
parent.updateSite('{$site_url}');
{/if}


{if $system_message}
	parent.$('system_message').update('{$system_message.title}');
	parent.$('system_message').show();
	{literal}
	
	parent.Effect.Pulsate('system_message', {duration: 1, pulses:1});
	setTimeout(function() { parent.Effect.Fade('system_message'); }, 5000);
	{/literal}
{/if}
{/if}
</script>