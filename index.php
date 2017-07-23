<html>
	<head>
		<!--<link rel="icon" type="image/png" href="images/favicon.png"/>-->

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/flexboxgrid.min.css">

		<meta http-equiv="Refresh" content="5;URL=https://polakosz.000webhostapp.com">
		
		<title>PoLáKoSz's Corp.</title>
	</head>
	
	<body class="row vh-middle">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
			<img src="images/HU_flag.png">

			<h2>Az oldal technikai okok miatt elköltözött!</h2>

			<h3>Az új link az oldalhoz: <a href="https://polakosz.000webhostapp.com">https://polakosz.000webhostapp.com</a></h3>
			<h3>...Pár másodpercen bellül át leszel irányítva...</h3>

			<p>Ha 5 másodpercnél többet vártál és még mindig látod ezt az üzenetet kérlek kattints a fenti linkre! Köszönöm!</p>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
			<img src="images/UK_flag.png">

			<h2>Our Site has moved!</h2>

			<h3>The new web address for this page is <a href="https://polakosz.000webhostapp.com">https://polakosz.000webhostapp.com</a></h3>
			<h3>...You will be transferred to the new site in a moment...</h3>

			<p>If you have waited more than a few seconds and you are still seeing this message, please click on the link above! Thank you.</p>
		</div>

		<div class="fb-like" data-href="https://facebook.com/polakosz" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		</div>
		
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.5";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$.post('Movies/resolution.php',
					{
						width: screen.width,
						height:screen.height,
						URL:   "HomePage",
					}, function(json) {
						/*
						if(json.outcome == 'success') {
							// do something with the knowledge possibly?
						} else {
							alert('Unable to let PHP know what the screen resolution is!');
						}*/
					},'json');
			});
		</script>
	</body>
</html>