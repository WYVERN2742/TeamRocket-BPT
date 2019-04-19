<?php
include "webphp/session.php";

$title = "Add User | Procurement";
$page = "addUser";

include "pageSections/head.php";
include "pageSections/header.php";
?>

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


<?php include "pageSections/scripts.php" ?>
<script src="js/addUser.js"></script>
<?php include "pageSections/footer.php" ?>
