<!DOCTYPE html>
@if(!Session::has('usuario'))		
	<script type="text/javascript">
		window.location = "{{ url('admin/unauth') }}";
	</script>
@endif
<html>
<head>
    <title>Advise Wealth Management</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Von-Studio">

    <!-- Bootstrap Core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
	<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/summernote-es-ES.js') }}"></script>
	
    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
        <!-- Advise CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/set2.css') }}" />
	
	<script type="text/javascript">
        $(document).ready(function() {    
			$("#newNewsEN").hide();        
			
			$('#idioma').on('change', function(e){
				var selectedLang = $('#idioma').find(":selected").val();
				if (selectedLang == 'en'){
					$("#newNewsES").hide();
					$("#newNewsEN").show();
				}else{
					$("#newNewsEN").hide();
					$("#newNewsES").show();
				}
				
			});	

        });
    </script>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33096624-4', 'auto');
  ga('send', 'pageview');
</script>
	@include('admin.header')	
    <div class="col-sm-12 adminContainer">
        <h2>{{ __('messages.new_report') }}</h2>
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>			
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="form-group">
		<label for="idioma">{{ __('messages.language') }}:</label>
		<select class="form-control" id="idioma">
		  <option value="es">{{ __('messages.language_es') }}</option>
		  <option value="en">{{ __('messages.language_en') }}</option>
		</select>
	</div>
	
	@if(session()->has('message_es'))
		<div class="alert alert-success">
			{{ session()->get('message_es') }}
		</div>
	@endif
	@if(session()->has('message_en'))
		<div class="alert alert-success">
			{{ session()->get('message_en') }}
		</div>
	@endif
	<form id="newNewsES" role="nuevoInforme" action="nuevoInforme" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<input type="hidden" name="languageselected" value="es">
		  <div class="form-group">
			  <label for="title">{{ __('messages.title') }} (ES):</label>
			  <input type="text" class="form-control" name="title" value="{{ old('title') }}"> 
		  </div>		  
		  <div class="form-group">
			  <label for="report">{{ __('messages.report') }} (ES):</label>
			  <input type="file" class="form-control" id="report" name="report" accept="application/pdf">
		  </div>
		<button type="cancel" class="btnAdmin" onclick="window.location='{{ url("admin/inicio") }}';return false;">{{ __('messages.cancel') }}</button>
		<button class="btnAdmin">{{ __('messages.submit') }}</button>
	</form>
	<form id="newNewsEN" role="nuevoInforme" action="nuevoInforme" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="languageselected" value="en">
		  <div class="form-group">
			  <label for="title">{{ __('messages.title') }} (EN):</label>
			  <input type="text" class="form-control" name="title" value="{{ old('title') }}">
		  </div>
		   <div class="form-group">
			  <label for="report">{{ __('messages.report') }} (EN):</label>
			  <input type="file" class="form-control" id="report" name="report" accept="application/pdf">
		  </div>
		<button type="cancel" class="btnAdmin" onclick="window.location='{{ url("admin/inicio") }}';return false;">{{ __('messages.cancel') }}</button>
		<button class="btnAdmin">{{ __('messages.submit') }}</button>				
	</form>		
</div>

</body>
</html>
