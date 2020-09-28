<!DOCTYPE html>
@if(Session::has('usuario'))		
	<script type="text/javascript">
		window.location = "{{ url('admin/inicio') }}";
	</script>
@endif
<html>
<head>
    <title>Advise Wealth Management</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Von-Studio">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap Core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	    <!-- Advise CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/set2.css') }}" />

	<script type="text/javascript">
		$(document).ready(function() {    
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(".alert-email").hide();
			$('#olvidoClave').on('click', function(e){
				e.preventDefault();				
				var email = $('input[name=correoelectronico]').val();
				var url = '{{url("olvidoclave")}}';
				$.ajax({
					type: "POST",
					url: url,
					data: JSON.stringify(email),
					dataType: "json",
					success: function( msg ) {		
						$(".alert-email").hide();				
						if(msg.email_error != null){
							$(".alert-email-danger").show();
							$("#email_error").text(msg.email_error);	
						}else{
							$(".alert-email-success").show();
							$("#email_sent").text(msg.email_sent);		
						}
					}
				});	
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
		<div class="alert alert-success alert-email alert-email-success">
			<span id="email_sent"></span>
		</div>
		<div class="alert alert-danger alert-email alert-email-danger">
			<span id="email_error"></span>
		</div>
	<form class="navbar-form navbar-right login" role="login" action="login" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="correoelectronico">{{ __('messages.email') }}:</label>
          <input type="text" class="form-control" name="correoelectronico">
        </div>
        <div class="form-group">
          <label for="contrasena">{{ __('messages.password') }}:</label>
          <input type="password" class="form-control" name="contrasena">
        </div>
        <a id="olvidoClave" href="">{{ __('messages.forgot_password') }}</a>
		<button type="submit" class="loginAdminBtn">
              {{ __('messages.login') }}
		</button>
		@if (isset($errorLogin) && $errorLogin <> '')
			<div class="alert alert-danger">
				<ul>
					<li>{{ $errorLogin }}</li>
				</ul>
			</div>
		@endif

		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</form>
  </div>
</body>
</html>
