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

	<!-- Site Header -->
	<header>
		<nav class="navbar navbar-static-top navbar-default navbar-expand-md shadow navbar-dark bg-dark">
			<a href="index.php"><img src="img/bangor_logo_c2_flush.svg" alt="Bangor University",
					height="50em"></a>
			<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navBar"
				aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation"></button>
			<div class="collapse navbar-collapse" id="navBar">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Homepage <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="makerequest.php"><i class="fa fa-pen-fancy" aria-hidden="true"></i> Make Request</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdownAdmin" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false"> <i class="fa fa-wrench" aria-hidden="true"></i>Admin</a>
						<div class="dropdown-menu" aria-labelledby="dropdownAdmin">
							<a class="dropdown-item" href="editUsers.php"><i class="fa fa-user" aria-hidden="true"></i> Edit Users</a>
							<a class="dropdown-item" href="editBudgetCodes.php"><i class="fa fa-wrench" aria-hidden="true"></i> Edit Budget Codes</a>
						</div>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<!-- Trigger logout modal -->
					<button class="btn btn-outline-danger my-2 my-sm-0" type="button" , data-toggle="modal" ,
						data-target="#modelLogout"><i class="fa fa-door-closed"></i>Logout</button>
				</form>
			</div>
		</nav>

		<div class="modal fade" id="modelLogout" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Logging out?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						You are about to log out, are you sure? <br> You will need to log in again to continue using the
						site.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times "></i> Cancel</button>
						<form id="do_logout" action="api/logout.php" method="POST">
							<button type="submit" class="btn btn-danger" name="do_logout"><i class="fa fa-door-closed"></i>Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 container">
		<h1 class="display-1">
				New User
		</h1>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">DEVELOPMENT - New User</h4>
				<!-- Change Form Submit action -->
				<form id="userForm" method="post" class="col-10">
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
						<label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
						<input type="text" name="lastName" id="lastName" class="form-control col-sm-9" placeholder="Code" required>
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
										Requester
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="role2" value="2">
									<label class="form-check-label" for="role2">
										Budget Code Owner
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="role3" value="3">
									<label class="form-check-label" for="role3">
										Central Finance
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="role" id="role4" value="4">
									<label class="form-check-label" for="role4">
										Requisition Officer
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
		<div id='response'></div>
	</main>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/addUser.js"></script>
</body>

</html>
