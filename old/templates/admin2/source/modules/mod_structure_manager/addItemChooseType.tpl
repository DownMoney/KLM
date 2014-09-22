{if count($types_listing) == 1}
<script type="text/javascript">
{if $smarty.get._formType == "popup"}
document.location.href = '{wt_href_tpl_link get_params="m|t|cPath|itID" parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&itID=`$types_listing.0.itt_id`"}';
{else}
action_form_large('{wt_href_tpl_link get_params="m|t|cPath|itID" parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&itID=`$types_listing.0.itt_id`"}', 'Dodaj {$types_listing.0.itt_name|strip_quotas} {if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}');
{/if}
</script>
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td class="eL_form" valign="top">
		<div id="eL_form">
		<div class="eL_formC" style="height: 500px;">
		<h1>Wybierz typ nowego wpisu w <b>{$item_data.it_name}</b>:</h1>
		<table class="chooseType" cellspacing="5">
		<tr>
{foreach from=$types_listing item=type name="types_listing"}
<td class="chooseType-i" onMouseover="this.className='chooseType-io'" onMouseOut="this.className='chooseType-i'" onclick="action_form_large('{wt_href_tpl_link get_params="m|t|cPath|itID" parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&itID=`$type.itt_id`"}', 'Dodaj {$type.itt_name|strip_quotas}{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;">
<img src="{$__imageRoot__}/tree/{$type.itt_ico}.gif" align="absmiddle" alt="{$type.itt_name|strip_quotas}" />
<strong>{$type.itt_name}</strong>
<small></small>
<b>dodaj &raquo;</b>
</td>
{if $smarty.foreach.types_listing.iteration%2 == 0}</tr><tr>{/if}
{/foreach}
</tr>
		</table>


		</div></div></td>
	</tr>
</table>





{literal}
<style type="text/css">
.chooseType { width: 95%; padding: 10px; }
.chooseType-i { width: 50%; padding: 10px; border: 1px solid #CCC; background: #FFF; }
.chooseType-io { width: 50%; padding: 10px; border: 1px solid #AFAFAF; background: #F5F5F5; cursor:pointer; }
.chooseType STRONG { font-size: 17px; }
.chooseType b { color: #276FC9; float:right; }
</style>
<script type="text/javascript">
Interface.setEditFormDim();
</script>
{/literal}