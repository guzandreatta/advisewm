<!DOCTYPE html>
@if(!Session::has('usuario'))		
<script type="text/javascript">
window.location = "{{ url('admin/unauth') }}";
</script>
@endif
@if(Request::is('login'))		
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

	<!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://use.fontawesome.com/0f0205eea6.css">

	<!-- Advise CSS -->
	<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('css/set2.css') }}" />

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
</div>
</span>
<div class="col-sm-12 adminContainer">
	<div class="btnAdmin">
		<a href="{{ url('admin/articulo/nuevo') }}">{{ __('messages.new_article') }}</a>
	</div>
	<div class="btnAdmin">
		<a href="{{ url('editarArticulo') }}">{{ __('messages.edit_article') }}</a>
	</div>
	<div class="btnAdmin">
		<a href="{{ url('admin/noticia/nuevo') }}">{{ __('messages.new_news') }}</a>
	</div>
	<div class="btnAdmin">
		<a href="{{ url('editarNoticia') }}">{{ __('messages.edit_news') }}</a>
	</div>
	<div class="btnAdmin">
		<a href="{{ url('admin/informe/nuevo') }}">{{ __('messages.upload_report') }}</a>
	</div>
</div>


</body>
</html>
