<?php
include "webphp/session.php";

$title = "Homepage | Procurement";
$page = "home";

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
									<h4 class="display-4">Pending<br> Requests</h4>
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
									<div class="spinner-border" role="status" id="draftSpinner"></div>
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
						<input type="text" class="form-control" id="searchTableRequests" placeholder="Search">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="searchTableRequests"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<table class="table table-sm table-bordered table-hover table-responsive-md text-center" id="tableRequests">
						<thead class="thead-dark">
							<tr>
								<th width=100>ID</th>
								<th width=150>Budget Code</th>
								<th width=150>Date</th>
								<th>Requester</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="5">
									<div class="spinner-border" role="status"></div>
								</td>
							</tr>
						</tbody>
					</table>
					<button type="button" name="viewInput" id="viewInput" class="btn btn-primary btn-lg btn-block">Loading...</button>
				</div>
			</div>
		</div>
	</div>
</main>

<!-- Request Modal -->
<div class="modal fade fullscreen" id="requestModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="requestHeader">Request #</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col col-3">
						<div class="card">
							<div class="card-header">
								Budget Code <div id="budgetCodeSpinner"></div>
							</div>
							<div class="card-body">
								<div class="card-text">
									<div id="budgetCode"><br></div>
									<div id="budgetCodeName"><br></div>
									<div id="budgetCodeRoom"><br></div>
									<div id="budgetCodeNum"><br></div>
									<div id="budgetCodeEmail"><br></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col col-3">
						<div class="card">
							<div class="card-header">
								Requestor <div id="RequestorSpinner"></div>
							</div>
							<div class="card-body">
								<div class="card-text">
									<div id="requestorName"><br></div>
									<div id="requestorRoom"><br></div>
									<div id="requestorNum"><br></div>
									<div id="requestorEmail"><br></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col col-3">
						<div class="card">
							<div class="card-header">
								Supplier <div id="supplierSpinner"></div>
							</div>
							<div class="card-body">
								<div class="card-text">
									<div id="supplierName"><br> </div>
									<div id="supplierAddress1"><br> </div>
									<div id="supplierAddress2"><br> </div>
									<div id="supplierAddressPostcode"><br> </div>
									<div id="supplierAddressCity"><br> </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col col-3">
						<div class="card">
							<div class="card-header">
								Overview
							</div>
							<div class="card-body text-center">
								<h1 class="card-title" id="labelCost">£0.00</h1>
								<small id="labelAmount">(p items)</small>
							</div>
							<div class="card-footer">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="inputRecurring" id="inputRecurring" disabled>
										Recurring Order
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="modal-body">
							<div class="container-fluid">
								<table class="table table-bordered table-hover table-responsive-md text-center" id="requestModalTable">
									<thead class="thead-dark">
										<tr>
											<th width=100>ID</th>
											<th class="text-left">Description</th>
											<th width=100>Quantity</th>
											<th width=100>Price</th>
											<th width=100>(Total)</th>
										<tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col">
					<button type="button" id="acceptRequest" class="btn btn-outline-success" data-dismiss="modal" disabled="true">Accept Request</button>
					<button type="button" id="denyRequest" class="btn btn-outline-danger" data-dismiss="modal" disabled="true">Deny Request</button>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include "pageSections/scripts.php" ?>
<script src="js/page/index.js"></script>
<?php include "pageSections/footer.php" ?>
