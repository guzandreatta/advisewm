<header>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="row">
		<div class="col-sm-12 topMenu">
			<div class="logoMenu">
				<a href="{{URL::to('/admin/inicio')}}"><img src="{{URL::asset('/img/logoMenu.png')}}" alt="logo para el menú"></a>
			</div>
			<h2 style="text-align:right; margin-right:3%; margin-top:35px;">{{ __('messages.content_admin') }}</h2>		
			<li class="dropdown languageDropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					{{ Config::get('languages')[App::getLocale()] }}
				</a>
				<ul class="dropdown-menu">
					@foreach (Config::get('languages') as $lang => $language)
					@if ($lang != App::getLocale())
					<li>
						<a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
					</li>
					@endif
					@endforeach
				</ul>
			</li>
			<div>
				@if(session()->has('usuario'))
				<a href="{{ url('logoff') }}">
					<div class="logoutBtn">
						<i class="fa fa-sign-out fa-lg"></i>  {{ __('messages.log_off') }}
					</div>
				</a>
				@endif			
			</div>
		</div>
	</div>
</header>