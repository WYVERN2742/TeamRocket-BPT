<?php
include "webphp/session.php";

$title = "Edit Users | Procurement";
$page = "editUsers";

include "pageSections/head.php";
include "pageSections/header.php";
?>

<!-- Page Content-->
<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 container-fluid">
	<!-- <div class="row">
		<div class="col-lg-4">
			<div class="row">
				<div class="col">
					<div class="card text-white bg-primary">
						<div class="card-body">
							<div class="row">
								<div class="col-7">
									<h4 class="display-4">Number of</br> Users</h4>
								</div>
								<div class="col-5">
									<p class="display-1" id="pending_requests">0</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col container-fluid">
					<h1>No of users: </h1>
					<h1 id="pending_requests">0</h1>
				</div>
				<div class="col">
					<div class="input-group">
						<input type="text" class="form-control" id="search" placeholder="Search" aria-label="Recipient's username" aria-describedby="inputSearch">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="inputSearch"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<table class="table table-bordered table-hover table-responsive-md text-center" id="requests_table">
						<thead class="thead-dark">
							<tr>
								<th>User ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Role</th>
								<th>Room Number</th>
								<th>Telephone Number</th>
								<th>Email Address</th>
								<th>Options </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="8">Loading...</td>
							</tr>
						</tbody>
					</table>
					<button type="button" name="inputViewMore" id="inputViewMore" class="btn btn-primary btn-lg btn-block">View More</button>
				</div>
			</div>
		</div>
	</div>
	<!-- This is the ghetto add user button -->
	<div class="row">
		<div class="col-lg-4">
			<div class="row">
				<div class="col">
					<button type="button" onclick="window.location.href='adduser.php'" name="addUser" id="addUser" class="btn btn-success btn-lg btn-block">Add User</button>
				</div>
			</div>
		</div>
	</div>
	</div>
</main>

<?php include "pageSections/scripts.html"?>
<script src="js/editUser.js"></script>;
<?php include "pageSections/footer.php"?>
