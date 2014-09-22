<script type="text/javascript">
{literal}

alert('Operacja przeprowadzona pomyślnie');

if( window.opener.self != window.opener.self.top ) {
window.opener._refresh();
} else {
window.opener.site._refresh();
window.opener.focus();
}

window.close();

{/literal}
</script>