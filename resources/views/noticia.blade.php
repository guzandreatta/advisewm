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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
  <!-- Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../css/animate.css" rel="stylesheet" />

  <!-- Advise CSS -->
  <link href="../css/styles.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="../css/set2.css" />

</head>
<script type="text/javascript">
	$(document).ready(function() {    
		$(".menuItem").removeClass("menuActive");
	});
</script>
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
        <h1>{{$noticia -> Titulo}}</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 pageContent">
        <section class="noticiaSection">
            <p class="sectionTxt full alignLeft">{!!$noticia -> Texto!!}</p>
		</section>
	</div>
</div>
@include('footer')	

</body>
</html>
