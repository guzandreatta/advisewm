<!DOCTYPE html>
<html>
<head>
    <title>Advise Wealth Management</title>

     <?php header('Content-Type: text/html; charset=iso-8859-1'); ?>
	 
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

    <!-- Advise CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/set2.css" />

</head>
	<script type="text/javascript">
		$(document).ready(function() {    
			$(".menuItem").removeClass("menuActive");
			$(".aboutus").addClass("menuActive");
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
        <h1>{{ __('messages.about_us_title') }}</h1>
        <p class="firmaQuote"><br>Miguel Sulichin <br>CEO @ADVISE WM</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 pageContent">
        <section>
            <h1>  {{ __('messages.about_us') }}  </h1>
            <p class="sectionTxt left alignLeft">
                {!! __('messages.about_us_description') !!}
            </p>
            <img src="img/sections/about.png">
        </section>
        <section>
            <h1>  {{ __('messages.about_us_message_from_CEO') }}  </h1>
            <p class="sectionTxt right alignRight">                
				{!! __('messages.about_us_message_from_CEO_body') !!}
            </p>
            <img src="img/sections/ceo.png">
        </section>
        <section>
            <h1> {{ __('messages.about_us_strategic_partners') }}  </h1>
            <h2 class="alignLeft">GWM</h2>
            <p class="sectionTxt full alignLeft">
               {{ __('messages.about_us_GWM') }}
            </p>
            <h2 class="alignLeft">PROCAPITAL</h2>
            <p class="sectionTxt full alignLeft">
			{{ __('messages.about_us_ProCapital') }}                
            </p>
            <h2 class="alignLeft">INVERTAX</h2>
            <p class="sectionTxt full alignLeft">
                {!! __('messages.about_us_Invertax') !!}
            </p>
        </section>
    </div>
</div>
@include('footer')	 

</body>
</html>
