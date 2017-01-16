<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	# Stop Hacking attempt
	define('__APP__', TRUE);
	
	# Start session
    session_start();
	
	# Database connection
	include "dbconn.php";
		
	# Variables MUST BE INTEGERS
	if(!isset($_GET['menu'])) { $_GET['menu'] =  1; $menu = (int)$_GET['menu']; }
	if(!isset($_GET['id']))   { $_GET['id'] =  1; $id = (int)$_GET['id']; }
	if(!isset($_GET['edit'])) { $_GET['edit'] =  1; $edit = (int)$_GET['edit']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = 'FALSE';  }
print '<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Rosenbauer Hrvatska</title>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html" />
		<meta name="description" content="Rosenbauer Hrvatska - vatrogasna vozila" />
		<meta name="keywords" content="vatrogasci, rocro, vozila" />
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<!-- Customizacija style.css -->
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header">
				<!--  Div + logo -->
				<div class="logo">
					<h1><img src="images/logo2.png" alt="Rosenbauer Hrvatska- logo"></h1>
				</div>
				';
					include "navigation.php";
			print '
			</header>';
			if ($_GET['menu'] == 1) { include "home.php"; }
			else if ($_GET['menu'] == 2) { include "onama.php"; }
			else if ($_GET['menu'] == 3) { include "proizvodi.php"; }
			else if ($_GET['menu'] == 4) { include "dojmovi.php"; }
			else if ($_GET['menu'] == 5) { include "contact.php"; }
			else if ($_GET['menu'] == 6) { include "signup.php"; }
			else if ($_GET['menu'] == 7) { include "signin.php"; }
			else if ($_GET['menu'] == 8) { include "dojmovnik.php"; }
			
			
			# Admin Control Panel
			else if ($_GET['menu'] >= 100 && $_GET['menu'] <= 105) { include "users.php"; }
			else if ($_GET['menu'] >= 110 && $_GET['menu'] <= 115) { include "control.php"; }
				include "footer.php";

	print '
	
	</body>
</html>';
