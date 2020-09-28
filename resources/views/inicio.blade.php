<!DOCTYPE html>
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
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" />


 <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

    
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/set2.css" />

    <!-- Advise CSS -->
    <link href="css/styles.css" rel="stylesheet">




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
    @include('header')	 
    <div class="row">
        <div class="col-sm-12 mainBanner">
            <ul class="bannerMsg">              
                <li class="msgItem"> {{ __('messages.experience') }}</li>
                <li class="msgItem"> {{ __('messages.transparency') }}</li>
                <li class="msgItem"> {{ __('messages.proactivity') }}</li>
                <li class="msgItem"> {{ __('messages.integrity') }}</li>
                <li class="msgItem"> {{ __('messages.team_work') }}</li>
            </ul>
            <a href="{{ url('/aboutus') }}">
                <div class="button bannerButton waves-effect waves-light btn-large">{{ __('messages.more_about_us') }}</div>
            </a> 
        </div>
    </div>
    <div class="row">
     @foreach($articulos as $articulo)
     <div class="col-sm-4 article">
        <div class="grid">
            <figure class="effect-ming">	
             @foreach($articulosmultimedias as $articulomultimedia)
             @if ($articulomultimedia -> ArticuloId == $articulo->Id && $articulomultimedia -> TipoMultimediaId == 2)
             <img src="{{$articulomultimedia->MultimediaRuta}}" alt="imagen de página principal del artículo"/>
             @endif						
             @endforeach  
             <figcaption>
                <h2><span>{{ $articulo -> Titulo}}   </h2>
                <p>{{ $articulo -> Descripcion}}</p>
                <a href="{{ url('/articulo') }}/{{ $articulo -> Id}}">{{ __('messages.read') }}</a>
            </figcaption>           
        </figure>
    </div>
</div>

@endforeach       
<div class="col-sm-8 noticiasHolder">
	@foreach($noticias as $noticia)
  <div class="noticia">
   @foreach($noticiasmultimedias as $noticiamultimedia)
   @if ($noticiamultimedia -> NoticiaId == $noticia->Id && $noticiamultimedia -> TipoMultimediaId == 2)
   <img src="{{$noticiamultimedia->MultimediaRuta}}" alt="imagen de página principal de la noticia"/>
   @endif						
   @endforeach  
   <div class="noticiaTitle">
    <a href="{{ url('/noticia') }}/{{ $noticia -> Id}}">{{ $noticia -> Titulo}}</a>
</div>
<div class="noticiaDescription">
	<a href="{{ url('/noticia') }}/{{ $noticia -> Id}}">{{$noticia -> Descripcion}}</a>    
</div>
</div>
@endforeach   
</div>
<div class="col-sm-12 informe">
    <h1>{{ strtoupper(__('messages.daily_market_report')) }}</h1>
    <p>{{ strtoupper(__('messages.daily_market_report_desc')) }}</p>
    <div class="button bannerButton waves-effect waves-light btn-large"><a href="{{ url('bajarInforme') }}">{{ strtoupper(__('messages.download')) }}</a></div>
</div>
</div>
@include('footer')

</body>
</html>
