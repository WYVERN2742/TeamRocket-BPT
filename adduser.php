<?php
include "webphp/session.php";
?>
<!doctype html>
<html lang="en">

<head>
	<title>New User | Dev</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<main class="container">
		<h1 class="display-1">
				New User
		</h1>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">DEVELOPMENT - New User</h4>
				<!-- Change Form Submit action -->
				<form action="OrderServlet" method="post" class="col-10">
					<!-- ^^^^^^^^^^^^^^^^^^ -->
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control col-sm-9" placeholder="password" required autofocus>
					</div>
					<div class="form-group row">
						<label for="firstName" class="col-sm-3 col-form-label">First Name</label>
						<input type="text" name="firstName" id="firstName" class="form-control col-sm-9" placeholder="Code" required>
					</div>
					<div class="form-group row">
						<label for="roomNumber" class="col-sm-3 col-form-label">Room Number</label>
						<input type="number" name="roomNumber" id="roomNumber" class="form-control col-sm-3" placeholder="103" required>
					</div>
					<fieldset class="form-group">
						<div class="row">
							<legend class="col-form-label col-sm-3 pt-0">Role</legend>
							<div class="col-sm-9">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="role1" value="1" checked>
									<label class="form-check-label" for="role1">
										Admin
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="role2" value="2" checked>
									<label class="form-check-label" for="role2">
										Finance
									</label>
								</div>
								<div class="form-check disabled">
									<input class="form-check-input" type="radio" name="role" id="role3" value="3">
									<label class="form-check-label" for="role3">
										Root
									</label>
								</div>
							</div>
						</div>
					</fieldset>
					<div class="form-group row">
						<label for="telephone" class="col-sm-3 col-form-label">Telephone Number</label>
						<input type="text" name="telephone" id="telephone" class="form-control col-sm-9" placeholder="telephone" required>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-3 col-form-label">Email</label>
						<input type="email" name="email" id="email" class="form-control col-sm-9" placeholder="email" required>
					</div>
					<button type="submit" class="btn btn-success col-sm-4">New User</button>
					<button type="reset" class="btn btn-outline-danger col-sm-2">Cancel</button>
				</form>
			</div>
		</div>
	</main>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
