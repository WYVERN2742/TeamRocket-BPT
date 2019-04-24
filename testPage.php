<?php
include "webphp/session.php";

$title = "Test Page | Procurement";
$page = "test";

include "pageSections/head.php";
include "pageSections/header.php";
?>

<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 container-fluid">
	<div class="col">
		<div id="adminUserEdit" role="tabpanel" class="tab-pane fade show active">
			<form id="adminFormUserNew" method="post">
				<div class="row">
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Name</span></div>
							<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required>
							<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-3">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Room #</span></div>
							<input type="number" name="roomNumber" id="roomNumber" class="form-control" placeholder="404" required>
						</div>
					</div>
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
							<input type="email" name="email" id="email" class="form-control" placeholder="user@bangor.ac.uk" required>
						</div>
					</div>
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Telephone</span></div>
							<input type="text" name="telephone" id="telephone" class="form-control" placeholder="01234 567890" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Role</span></div>
							<select class="form-control" name="role" id="role">
								<option value="REQUESTER">Requester</option>
								<option value="REQUISITION_OFFICER">Requisition Officer</option>
								<option value="CENTRAL_FINANCE">Central Finance</option>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text">Password</span></div>
							<input type="password" name="password" id="password" class="form-control" placeholder required autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-success col-sm-4">Update User</button>
						<button type="reset" class="btn btn-outline-danger col-sm-4">Clear</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>

<?php include "pageSections/scripts.php" ?>
<script src="js/testPage.js"></script>
<?php include "pageSections/footer.php" ?>
