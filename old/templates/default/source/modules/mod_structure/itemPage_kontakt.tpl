<h1>{$item.it_name}</h1>
{*
<div class="contDesc">
	{$item.it_desc}
	{if $item.fields_group.mail.n || $item.fields_group.tel.n || $item.fields_group.gsm.n}
		<dl class="contDescDane">
			{if $item.fields_group.tel.n}
				 <dt>Tel:</dt>
				 <dd>{$item.fields_group.tel.n}</dd>
			{/if}
			{if $item.fields_group.telfax.n}
				 <dt>Tel./fax:</dt>
				 <dd>{$item.fields_group.telfax.n}</dd>
			{/if}
			{if $item.fields_group.gsm.n}
				<dt>GSM:</dt>
				 <dd>{$item.fields_group.gsm.n}</dd>
			{/if}
			{if $item.fields_group.mail.n}
				<dt>E-mail:</dt>
				<dd>{mailto address=$item.fields_group.mail.n encode="hex"}</dd>
			{/if}
		</dl>
	{/if}
</div>

<div class="conMap">
	<iframe width="400" height="320" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=pl&amp;geocode=&amp;q=polska,+Huta+Nowa&amp;aq=&amp;sll=51.433036,21.341629&amp;sspn=0.333469,0.812302&amp;ie=UTF8&amp;hq=&amp;hnear=Huta+Nowa,+kielecki,+%C5%9Bwi%C4%99tokrzyskie,+Polska&amp;t=m&amp;ll=50.871845,20.986633&amp;spn=0.554641,1.095886&amp;z=9&amp;output=embed"></iframe><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=pl&amp;geocode=&amp;q=polska,+Huta+Nowa&amp;aq=&amp;sll=51.433036,21.341629&amp;sspn=0.333469,0.812302&amp;ie=UTF8&amp;hq=&amp;hnear=Huta+Nowa,+kielecki,+%C5%9Bwi%C4%99tokrzyskie,+Polska&amp;t=m&amp;ll=50.871845,20.986633&amp;spn=0.554641,1.095886&amp;z=9" style="float: right; font-size: 11px;" target="_blank">wyświetl większą mapę &raquo;</a>
</div>
<br clear="all" />
*}
<div class="conformPadd">
	{if !$smarty.get.form_sended}
		{$form_contact_form}
	{else}
		<div class="succes">
			<strong>Twoja wiadomość została wysłana!</strong><br />
			Jeżeli Twoja wiadomość wymaga odpowiedzi, skontaktujemy się z Tobą tak szybko jak to tylko możliwe.
		</div>
	{/if}
	<br clear="all" />
	<a class="back" href="{wt_href_tpl_link mod_key="home"}" title=" powrót na stronę główną ">&laquo; powrót na stronę główną</a>
</div>
