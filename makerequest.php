<?php
include "webphp/session.php"
?>

<!doctype html>
<html lang="en">

<head>
	<title>Procurement | Make a Request</title>
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
			<a href="index.php"><img src="img/bangor_logo_c2_flush.svg" alt="Bangor University" , height="50em"></a>
			<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navBar"
				aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation"></button>
			<div class="collapse navbar-collapse" id="navBar">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Homepage
							</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="makerequest.php"><i class="fa fa-pen-fancy" aria-hidden="true"></i>
							Make Request<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdownAdmin" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false"> <i class="fa fa-wrench"
								aria-hidden="true"></i>Admin</a>
						<div class="dropdown-menu" aria-labelledby="dropdownAdmin">
							<a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i> Edit
								Users</a>
							<a class="dropdown-item" href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Edit
								BudgetCodes</a>
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
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i
								class="fa fa-times "></i> Cancel</button>
						<form action="login.html">
							<button type="submit" class="btn btn-danger"><i
									class="fa fa-door-closed"></i>Logout</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main role="main" class="col-md-12 ml-sm-auto px-4 container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col">
						<div class="form-label-group">
							<input type="text" id="inputBudgetCode" class="form-control is-valid"
								placeholder="Budget Code" required value="R24-W21">
							<label for="inputBudgetCode">Budget Code</label>
							<div class="valid-feedback">Budget code exists!</div>
						</div>
					</div>
					<div class="col">
						<div class="form-label-group">
							<input type="text" id="inputSupplier" class="form-control" placeholder="Budget Code"
								required value="R.H. Components">
							<label for="inputSupplier">Supplier</label>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								Budget Code: R24-W21
							</div>
							<div class="card-body">
								<p class="card-text">
									<strong>Name </strong> I.A.Jones <br />
									<strong>Room No. </strong> 115 <br />
									<strong>Telephone Number</strong> 2727 <br />
									<strong>Email</strong> IJones@bangor.ac.uk <br />
								</p>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card">
							<div class="card-header">
								Supplier: R.H. Components
							</div>
							<div class="card-body">
								<p class="card-text">
									Address:
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="inputAddress1" class="form-control"
												placeholder="Budget Code" required value="R.H. Components Warehouse">
											<label for="inputAddress1">Address Line 1</label>
										</div>
										<div class="form-label-group">
											<input type="text" id="inputAddress2" class="form-control"
												placeholder="Budget Code" required value="Baglan Industrial Park">
											<label for="inputAddress2">Address Line 2</label>
										</div>
										<div class="form-label-group">
											<input type="text" id="inputAddressPostcode" class="form-control"
												placeholder="Budget Code" required value="SA12 7DJ">
											<label for="inputAddressPostcode">Postcode</label>
										</div>
										<div class="form-label-group">
											<input type="text" id="inputAddressCity" class="form-control"
												placeholder="Budget Code" required value="Port Talbot">
											<label for="inputAddressCity">City / Town</label>
										</div>
									</div>
								</p>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
								Total Cost
							</div>
							<div class="card-body">
								<h2 class="card-title">£102.93</h2>
							</div>
							<div class="card-footer">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="inputRecurring"
											id="inputRecurring" checked>
										Recurring Order
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col align-self-start">
						<button type="button" name="buttonSubmit" id="buttonSubmit"
							class="btn btn-success btn-lg btn-block">Submit</button>
					</div>
					<div class="col align-self-end">
						<button type="button" name="buttonDraft" id="buttonDraft"
							class="btn btn-primary btn-lg btn-block">Save Draft</button>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<table class="table table-bordered table-hover table-responsive-md text-center">
					<caption>Table of Items - For more rows, fill in current entries.</caption>
					<thead class="thead-dark">
						<tr>
							<th>Item</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Cost (Each)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td scope="row">1</td>
							<td><input type="text" class="form-control" name="1" id="inputItem1Description"
									value="6mm DIA ST/STEEL TUBE (437-3683)"></input></td>
							<td><input type="number" class="form-control" name="inputItem1Quantity"
									id="inputItem1Quantity" value="5"></input></td>
							<td>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text">£</span></div>
									<input type="text" class="form-control" name="inputItem1Cost" id="inputItem1Cost"
										value="10.48"></input>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row">2</td>
							<td><input type="text" class="form-control" name="2" id="inputItem2Description"
									value="6mm STRAIGHT UNIONS (432-4681)"></input></td>
							<td><input type="number" class="form-control" name="inputItem2Quantity"
									id="inputItem2Quantity" value="4"></input></td>
							<td>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text">£</span></div>
									<input type="text" class="form-control" name="inputItem2Cost" id="inputItem2Cost"
										value="8.99"></input>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row">3</td>
							<td><input type="text" class="form-control" name="3" id="inputItem3Description"
									value="6mm → 1/4'' ADAPTER (439-666)"></input></td>
							<td><input type="number" class="form-control" name="inputItem3Quantity"
									id="inputItem3Quantity" value="5"></input></td>
							<td>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text">£</span></div>
									<input type="text" class="form-control" name="inputItem3Cost" id="inputItem3Cost"
										value="2.27"></input>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row">4</td>
							<td><input type="text" class="form-control" name="4" id="inputItem4Description"
									value="HOSETAILS (506-7200)"></input></td>
							<td><input type="number" class="form-control" name="inputItem4Quantity"
									id="inputItem4Quantity" value="2"></input></td>
							<td>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text">£</span></div>
									<input type="text" class="form-control" name="inputItem4Cost" id="inputItem4Cost"
										value="1.61"></input>
								</div>
							</td>
						</tr>
						<tr>
							<td scope="row">5</td>
							<td><input type="text" class="form-control" name="5" id="inputItem5Description"></input>
							</td>
							<td><input type="number" class="form-control" name="inputItem5Quantity"
									id="inputItem5Quantity"></input></td>
							<td>
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text">£</span></div>
									<input type="text" class="form-control" name="inputItem5Cost"
										id="inputItem5Cost"></input>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
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
