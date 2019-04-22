<?php
include "webphp/session.php";

$title = "Test Page | Procurement";
$page = "test";

include "pageSections/head.php";
include "pageSections/header.php";
?>

<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 container-fluid">
	<div class="display-1">
		Test Page
	</div>
	<form id="userForm" method="post">
		<div class="row">
			<div class="col">
				<div class="form-label-group">
					<input type="text" name="firstName" id="firstName" class="form-control" placeholder required>
					<label for="firstName">First Name</label>
				</div>
			</div>
			<div class="col">
				<div class="form-label-group">
					<input type="text" name="lastName" id="lastName" class="form-control" placeholder required>
					<label for="lastName">Last Name</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				<div class="form-label-group">
					<input type="number" name="roomNumber" id="roomNumber" class="form-control" placeholder required>
					<label for="roomNumber">Room Number</label>
				</div>
			</div>
			<div class="col-5">
				<div class="form-label-group">
					<input type="email" name="email" id="email" class="form-control" placeholder required>
					<label for="email">Email</label>
				</div>
			</div>
			<div class="col-5">
				<div class="form-label-group">
					<input type="text" name="telephone" id="telephone" class="form-control" placeholder required>
					<label for="telephone">Telephone Number</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<div class="form-label-group">
					<select class="form-control" name="role" id="role">
						<option value="1">Requester</option>
						<option value="2">Requisition Officer</option>
						<option value="3">Central Finance</option>
					</select>
				</div>
			</div>
			<div class="col-9">
				<div class="form-label-group">
					<input type="password" name="password" id="password" class="form-control" placeholder required autofocus>
					<label for="password">Password</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-success col-sm-4">Save Changes</button>
				<button type="reset" class="btn btn-outline-danger col-sm-2">Cancel</button>
			</div>
		</div>
	</form>
</main>

<?php include "pageSections/scripts.php" ?>
<script src="js/testPage.js"></script>
<?php include "pageSections/footer.php" ?>
