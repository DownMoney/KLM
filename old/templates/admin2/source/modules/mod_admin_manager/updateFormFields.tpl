{if $d.v && $d.n && $d.f}
<script type="text/javascript">
	 parent.$('{$d.f}').options[parent.$('{$d.f}').options.length] = new Option('{$d.n}', '{$d.v}');
    parent.$('{$d.f}').selectedIndex = parent.$('{$d.f}').lastChild.index;
  	 parent.setActionFormSuccess('{$d.m}');
</script>
{/if}