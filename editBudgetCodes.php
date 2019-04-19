<?php
include "webphp/session.php";

$title = "Edit Budget Codes | Procurement";
$page = "editCodes";

include "pageSections/head.php";
include "pageSections/header.php";
?>

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
									<div class="btn-block btn-group btn-group-justified" role="group" aria-label="Draft #1">
										<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
											#1</button>
										<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="btn-block btn-group btn-group-justified" role="group" aria-label="Draft #2">
										<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
											#2</button>
										<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="btn-block btn-group btn-group-justified" role="group" aria-label="Draft #3">
										<button type="button" class="btn btn-outline-primary btn-lg btn-block">Draft
											#3</button>
										<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
					<h1>Budget Codes</h1>
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
								<th>Budget Code</th>
								<th>Owner ID</th>
								<th>Procurement Officer</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3">Loading...</td>
							</tr>
						</tbody>
					</table>
					<button type="button" name="inputViewMore" id="inputViewMore" class="btn btn-primary btn-lg btn-block">View More</button>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include "pageSections/scripts.html"?>
<script src="js/editBudgetCodes.js"></script>
<?php include "pageSections/footer.php"?>
