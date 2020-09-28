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
	<meta name="csrf-token" content="{{ csrf_token() }}" />

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
		
			$("#advancedOptions").hide();	
			$("#hideAdvancedOptions").hide();
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			  			
			$('#summernote').summernote({
			 toolbar: [
				// [groupName, [list of button]]
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']],
				['picture', ['picture']]
			  ],
			  lang: 'es-ES',
			  height:300
			});
			
			$('#articulos').on('change', function(e){
				e.preventDefault();				
				var indexSelectedArticle = $("#articulos").prop('selectedIndex');
				if (indexSelectedArticle == 1){
					$("#subirOrden").prop('disabled', true).css('opacity',0.5);
				} else {
					$("#subirOrden").prop('disabled', false).css('opacity',1);
				}
				if ($("#articulos option:last").is(":selected")){
					$("#bajarOrden").prop('disabled', true).css('opacity',0.5);
				} else {
					$("#bajarOrden").prop('disabled', false).css('opacity',1);
				}
				$("#reorder").show();
				editarArticulo();
			});	
			$("#subirOrden").on('click', function(e){
				
				
				var selectedArticle = $('#articulos').val();				
				var url = '{{url("subirOrdenDeArticulo")}}';
				$.ajax({
					type: "POST",
					url: url,
					dataType: "json",
					data: JSON.stringify(selectedArticle),
					success: function( msg ) {	
						$("#articulos").empty().append(msg.articulos);
						$('#articulos option[value="'+selectedArticle+'"]').prop('selected', true)
						
						var indexSelectedArticle = $("#articulos").prop('selectedIndex');						
						if (indexSelectedArticle == 1){
							$("#subirOrden").prop('disabled', true).css('opacity',0.5);
						} else {
							$("#subirOrden").prop('disabled', false).css('opacity',1);
						}
						if ($("#articulos option:last").is(":selected")){
							$("#bajarOrden").prop('disabled', true).css('opacity',0.5);
						} else {
							$("#bajarOrden").prop('disabled', false).css('opacity',1);
						}
					}
				});	
			});
			
			$("#bajarOrden").on('click', function(e){
				var selectedArticle = $('#articulos').val();				
				var url = '{{url("bajarOrdenDeArticulo")}}';
				$.ajax({
					type: "POST",
					url: url,
					dataType: "json",
					data: JSON.stringify(selectedArticle),
					success: function( msg ) {	
						$("#articulos").empty().append(msg.articulos);
						$('#articulos option[value="'+selectedArticle+'"]').prop('selected', true)
						
						var indexSelectedArticle = $("#articulos").prop('selectedIndex');						
						if (indexSelectedArticle == 1){
							$("#subirOrden").prop('disabled', true).css('opacity',0.5);
						} else {
							$("#subirOrden").prop('disabled', false).css('opacity',1);
						}
						if ($("#articulos option:last").is(":selected")){
							$("#bajarOrden").prop('disabled', true).css('opacity',0.5);
						} else {
							$("#bajarOrden").prop('disabled', false).css('opacity',1);
						}
					}
				});	
			});
			
			$('#idioma').on('change', function(e){
				e.preventDefault();				
				var selectedLanguage = $('#idioma').val();
				$("#reorder").hide();
				$("#editArticle").hide();
				var url = '{{url("obtenerArticulosPorOrden")}}';
				$.ajax({
					type: "POST",
					url: url,
					data: JSON.stringify(selectedLanguage),
					dataType: "json",
					success: function( msg ) {	
						$("#articulos").empty().append(msg.articulos);
					}
				});	
			});	
			
			$("#showAdvancedOptions").on('click', function(e){
				$("#showAdvancedOptions").hide();
				$("#advancedOptions").show();
				$("#hideAdvancedOptions").show();
			});
			
			$("#hideAdvancedOptions").on('click', function(e){
				$("#hideAdvancedOptions").hide();
				$("#advancedOptions").hide();
				$("#showAdvancedOptions").show();
			});
			
        });
		
		function editarArticulo(){
			var selectedArticle = $('#articulos').val();
			
			var url = '{{url("obtenerArticuloPorId")}}';
			$.ajax({
				type: "POST",
				url: url,
				data: JSON.stringify(selectedArticle),
				dataType: "json",
				success: function( msg ) {	
					
					$("#editArticle").show();
					// console.log(msg.articulo[0]);
					// console.log(msg.multimedia);
					$('input[name=id]').val(msg.articulo[0].Id);
					$('input[name=idiomaid]').val(msg.articulo[0].IdiomaId);
					$('input[name=title]').val(msg.articulo[0].Titulo);
					$('input[name=desc]').val(msg.articulo[0].Descripcion);
					$('#summernote').summernote('code', msg.articulo[0].Texto);
					$('select[name=order]').val(msg.articulo[0].Orden);
					$('select[name=active]').val(msg.articulo[0].Activo);
					
					if (msg.articulo[0].FechaInicio != null){
						var initialDate = getDateFromString(msg.articulo[0].FechaInicio);
						if (initialDate != null){
							$('input[name=startdate]').val(initialDate);
						}
					} else {
						$('input[name=startdate]').val(null);
					}
					
					if (msg.articulo[0].FechaFin != null){
						var endDate = getDateFromString(msg.articulo[0].FechaFin);
						if (endDate != null){
							$('input[name=enddate]').val(endDate);
						}
					} else {
						$('input[name=enddate]').val(null);
					}					
					
					if ( msg.multimedia[0])
						$("#currentHomeImage").attr("src", '{{ URL::to("/") }}' +  "/" + msg.multimedia[0].MultimediaRuta);
					
					if ( msg.multimedia[1])
						$("#currentCoverImage").attr("src", '{{ URL::to("/") }}' + "/" + msg.multimedia[1].MultimediaRuta);
				}
			});	
		};
		
		function getDateFromString(dateParam){
				var date1 = new Date (dateParam);
				
				var day = date1.getDate();
				var month = date1.getMonth() + 1;
				var year = date1.getFullYear();
				if (month < 10) month = "0" + month;
				if (day < 10) day = "0" + day;
				
				var finalDate = year + "-" + month + "-" + day;
				
				return finalDate
			};
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
		
	<div id="ajaxResponse"></div>
        <h2>{{ __('messages.edit_article') }}</h2>
		<div class="form-group">
		<label for="idioma">{{ __('messages.language') }}:</label>
		<select class="form-control" id="idioma">
		  <option value="es">{{ __('messages.language_es') }}</option>
		  <option value="en">{{ __('messages.language_en') }}</option>
		</select>
	</div>
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
			<label for="articulos">{{ __('messages.select_article') }}:</label>
			<select class="form-control" id="articulos">
				<?php echo($articulos); ?>
			</select>
		</div>	
		<div class="form-group" id="reorder" style="display:none;">
			<button type="button" id="subirOrden">{{ __('messages.up') }}</button>
			<button type="button" id="bajarOrden">{{ __('messages.down') }}</button>
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
			
	<form id="editArticle" role="editarArticulo" action="subirArticuloEditado" method="POST" enctype="multipart/form-data" style="display:none;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input name="_method" type="hidden" value="PUT">
		<input type="hidden" name="id">
		<input type="hidden" name="idiomaid">
		<div class="form-group">
			  <label for="title">{{ __('messages.title') }}:</label>
			 <input type="text" class="form-control" name="title"> 
		</div>

		  <div class="form-group">
			  <label for="desc">{{ __('messages.description') }}:</label>
			  <input type="text" class="form-control" name="desc" value="{{ old('desc') }}">
		  </div>
		  <div class="form-group">
			  <label for="homeimage">{{ __('messages.home_image') }}:</label>
			  <div>
				<img id="currentHomeImage" alt="Current home image" height="360px">
			  </div>			  
			  <span>{{ __('messages.change_image') }}</span>
			  <input type="file" class="form-control" id="homeimage" name="homeimage" accept="image/*">
		  </div>
		  <div class="form-group">
			  <label for="coverimage">{{ __('messages.cover_image') }}:</label>
			  <div>
				<img id="currentCoverImage" alt="Current cover image" height="360px">
			  </div>
			  <span>{{ __('messages.change_image') }}</span>
			  <input type="file" class="form-control" id="coverimage" name="coverimage" accept="image/*">
		  </div>
		  <div class="form-group">
			  <label for="article">{{ __('messages.article') }}:</label>
			  <br/>
			  <textarea class="form-control" id="summernote" name="article">{{ old('article') }}
				</textarea>
		  </div>
		<div class="form-group">
				<button id="showAdvancedOptions" type="button" class="btn btn-link">{{ __('messages.show_advanced_options') }}</button>
				<button id="hideAdvancedOptions" type="button" class="btn btn-link">{{ __('messages.hide_advanced_options') }}</button>
			</div>
			<div id="advancedOptions">
				<div class="form-group">
					<label for="startdate">{{ __('messages.start_date') }}: </label><input class="form-control" name="startdate" type="date"/>
				</div>
				<div class="form-group">
					<label for="enddate">{{ __('messages.end_date') }}: </label><input class="form-control" name="enddate" type="date"/>
				</div>
			</div> 		
		<div class="form-group">
		  <label for="active">{{ __('messages.active') }}:</label>
		  <select class="form-control" name="active">
				<option value="1">{{ __('messages.yes') }}</option>
				<option value="0">{{ __('messages.no') }}</option>
			</select>
		</div>
		<button type="cancel" class="btnAdmin" onclick="window.location='{{ url("admin/inicio") }}';return false;">{{ __('messages.cancel') }}</button>
		<button class="btnAdmin">{{ __('messages.submit') }}</button>
	</form>
</div>

</body>
</html>
