<footer>
	<div class="col-sm-6 logoFooter">
		<a href="{{URL::to('/')}}"><img src="{{URL::asset('/img/logoFooter.png')}}" alt="logo para el pie de página"></a>
	</div>
	<div class="col-sm-6 infoFooter">
		<p>
			{{ __('messages.address_office') }}<br>			
			{{ __('messages.address_office_city_postal_code') }}<br>
			{{ __('messages.address_office_country') }}<br>
			(+598) 2600 5200<br>
			
		</p>
		<a href="mailto:info@advisewm.com">info@advisewm.com</a>
		<p class="von">
			{{ __('messages.developed_by') }}: <a href="http://www.von-studio.com" target="_blank">Von Studio</a>
		</p>
	</div>
</footer>