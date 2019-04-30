<?php
session_start();

if (isset($_SESSION['user'])) {
	header("Location: index.php");
	die();
}

$title = "Login | Procurement";
$page = "login";
?>
<!doctype html>
<html lang="en">

<head>
	<title><?=$title?></title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">

	<!-- FontAwesome CSS (icons) -->
	<link rel="stylesheet" href="css/fontawesome.min.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="favicon.png">
</head>

<form class="form-signin" id="login_form">
	<img class="mb-4" src="img/Bangor_Logo_A1.png" alt="" width="100%" height="100%">
	<h1 class="text-center h3 mb-3 font-weight-normal">TRPT - Online Procurement</h1>

	<div id="response"></div>
	<div class="form-label-group">
		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
		<label for="inputEmail">Email address</label>
	</div>

	<div class="form-label-group">
		<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		<label for="inputPassword">Password</label>
	</div>

	<button class="btn btn-lg btn-primary btn-block text-center" type="submit">Sign in</button>
	<p class="mt-5 mb-3 text-muted text-center">Bangor University &copy;2019</p>
</form>

<?php include "pageSections/scripts.php"?>
<script src="js/page/login.js"></script>
<?php include "pageSections/footer.php"?>
