<script type="text/javascript">
parent.setActionFormSuccess('{$mess}');
{if !$dRT || $dRT != "1"}
parent.setStructureTree();
{/if}
parent.$('mod_content').src = '{$site_url}';
</script>