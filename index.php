<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() {
	?>
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>SwitchCover</title>

		
		<link rel="stylesheet" type="text/css" href="libs/fancybox/source/jquery.fancybox.css">
		<link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="libs/css3-social-signin-buttons/auth-buttons.css">
		
		<link rel="stylesheet" type="text/css" href="libs/app/css/style.css">
		
		<script type="text/javascript" src="libs/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="libs/fancybox/source/jquery.fancybox.js"></script>
		<script type="text/javascript" src="libs/app/js/main.js"></script>

	</head>
	<body>

		<nav class="navbar navbar-default navbar-static-top" role="navigation">
  			<center> <h1><span class="glyphicon glyphicon-retweet"></span> SwitchCover</h1></center>
		</nav>
			
		
		
		<div class="only_login">

			<center>
				<img src="libs/app/img/user.png" alt="" >
				<br><br>
				<a class="btn-auth btn-facebook" href="#">
				    Sign in with <b>Facebook</b>
				</a>
			</center>

		</div>

	<div class="row">
	  <div id="content" class="col-md-9 col-md-push-3">
	  	
	  </div>

	  <div id="menu" class="col-md-3 col-md-pull-9">

		<ul class="nav nav-pills nav-stacked page-list">
			
		</ul>

	  </div>
	</div>


	</body>
	</html>
	<?php
});



$app->post('/', function() use ($app){
	$req = $app->request();
	do_change($req->post('data'));

	//echo json_encode($req->post('data'));
});

$app->post('/switchcover/', function() use ($app){
	$req = $app->request();
	do_change($req->post('data'));

	//echo json_encode($req->post('data'));
});

function do_change($obj) {

	$facebook = new Facebook(array('appId' => '251485768337071', 'secret' => '44f8d89d886bec79a98e738a93a519b1'));

		//$obj->date
		//$obj->time

	try {
		$facebook->setAccessToken($obj['access_token']);
 		$token = $facebook->setExtendedAccessToken();
		$response = $facebook->api('/'.$obj['page'].'/?cover='.$obj['pid'],'POST');
		echo json_encode(array($response));

	} catch(FacebookApiException $e) {}
   



}


$app->run();