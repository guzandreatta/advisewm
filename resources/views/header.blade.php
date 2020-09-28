<header><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <div class="row">
           
			 <div class="col-sm-2 topMenu">
                <div class="logoMenu">
                    <a href="{{URL::to('/')}}"><img src="{{URL::asset('/img/logoMenu.png')}}" alt="logo para el menú"></a>
                </div>
            </div>
			<div>
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
			</div>
            <div class="col-sm-10 topMenu menuRight">
                <div class="buttonsContainer">
                    <ul class="menuHolder">
					<li class="menuItem home menuActive"><a href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
					<li class="menuItem aboutus"><a href="{{ url('/aboutus') }}">{{ __('messages.about_us') }}</a></li>
					<li class="menuItem assetmanagement"><a href="{{ url('/assetmanagement') }}">{{ __('messages.asset_management') }}</a></li>
					<li class="menuItem fiduciaryadvice"><a href="{{ url('/fiduciaryadvice') }}">{{ __('messages.fiduciary_advice') }}</a></li>
					<li class="menuItem taxadvice"><a href="{{ url('/taxadvice') }}">{{ __('messages.tax_advice') }}</a></li>
					<li class="menuItem contact"><a href="{{ url('/contact') }}">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
            </div>
			
        </div>
    </header>