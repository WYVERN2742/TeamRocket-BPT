<?php
include "webphp/session.php"
?>

<!doctype html>
<html lang="en">

<head>
	<title>Procurement | Homepage</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- FontAwesome CSS (icons) -->
	<link rel="stylesheet" href="css/fontawesome.min.css">
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
							<a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i> Edit Users</a>
							<a class="dropdown-item" href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Edit BudgetCodes</a>
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
						<form id="do_logout">
							<button type="submit" class="btn btn-danger"><i class="fa fa-door-closed"></i>Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Page Content-->
	<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 container-fluid">
		<div class="row">
			<div class="col-lg-4">
				<div class="row">
					<div class="col">
						<div class="card text-white bg-primary">
							<div class="card-body">
								<div class="row">
									<div class="col-7">
										<h4 class="display-4">Pending</br> Requests</h4>
									</div>
									<div class="col-5">
										<p class="display-1" id="pending_requests">0</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-bordered table-hover table-responsive-md text-center">
							<thead class="thead-dark">
								<tr>
									<th>Drafts</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="btn-block btn-group btn-group-justified" role="group"
											aria-label="Draft #1">
											<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
												#1</button>
											<button type="button" class="btn btn-danger"><i class="fa fa-trash"
													aria-hidden="true"></i></button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-block btn-group btn-group-justified" role="group"
											aria-label="Draft #2">
											<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
												#2</button>
											<button type="button" class="btn btn-danger"><i class="fa fa-trash"
													aria-hidden="true"></i></button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="btn-block btn-group btn-group-justified" role="group"
											aria-label="Draft #3">
											<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
												#3</button>
											<button type="button" class="btn btn-danger"><i class="fa fa-trash"
													aria-hidden="true"></i></button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="row">
					<div class="col container-fluid">
						<h1>Requests</h1>
					</div>
					<div class="col">
						<div class="input-group">
							<input type="text" class="form-control" id="search" placeholder="Search"
								aria-label="Recipient's username" aria-describedby="inputSearch">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" id="inputSearch"><i
										class="fa fa-search" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<table class="table table-bordered table-hover table-responsive-md text-center" id="requests_table">
							<thead class="thead-dark">
								<tr>
									<th>ID</th>
									<th>Budget Code</th>
									<th>Requester</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="4">Loading...</td>
								</tr>
							</tbody>
						</table>
						<button type="button" name="inputViewMore" id="inputViewMore"
							class="btn btn-primary btn-lg btn-block">View More</button>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
		integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
		crossorigin="anonymous"></script>

</body>

</html>
