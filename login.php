<?php
session_start();

if (isset($_SESSION['user'])) {
	header("Location: index.php");
	die();
}

?>

<!doctype html>
<html lang="en">

<head>
	<title>Procurement | Login</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
</head>

<body class="">
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

		<div class="checkbox mb-3 text-center">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block text-center" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted text-center">Bangor University &copy;2019</p>
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/login.js"></script>

</body>

</html>
