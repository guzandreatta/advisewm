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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../css/animate.css" rel="stylesheet" />

  <!-- Advise CSS -->
  <link href="../css/styles.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="../css/set2.css" />

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
  <header>
    <div class="row">
      <div class="col-sm-12 topMenu">
        <div class="logoMenu">
          <img src="../img/logoMenu.png">
        </div>
        <h2 style="text-align:right; margin-right:3%; margin-top:35px;">Administrador de Contenidos</h2>
      </div>
    </div>
  </header>
  <div class="col-sm-12 adminContainer">
    <h2>Subir Informe</h2>
    <div class="form-group">
      <label for="informe">Informe:</label>
      <input type="file" class="form-control" id="informe">
    </div>
    <button class="btnAdmin">UPLOAD</button>
  </div>
</body>
</html>
