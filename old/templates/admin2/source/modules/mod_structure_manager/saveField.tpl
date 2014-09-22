<script type="text/javascript">
t = '<li style="background: #DFD;" id="li_fi_{$field_data.fi_id}">';
t += '<div>';
t += '<a href="#" onclick="editField(\'{$field_data.fi_id}\'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a> ';
t += '<a href="#" onClick="delField(\'{$field_data.fi_id}\'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>';
t += '</div>';
t += '<span id="fi_{$field_data.fi_id}" onDblclick="editField(\'{$field_data.fi_id}\');">{$field_data.fi_name}</span>';
{if $field_data.depends}
t += '<small style="color:#C0c0c0;margin-left:10px;" id="fi_related_to_text_{$field_data.fi_id}">({$field_data.depends.fi_name|default:"--- nie przypisano ---"})</small><input type="hidden" id="old_fi_related_to_{$field_data.fi_id}" value="{$field_data.depends.fi_id}" />';
{/if}
t += '</li>';

new Insertion.Top('fieldValues', t);

</script>