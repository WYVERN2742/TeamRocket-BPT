<?php
include "webphp/session.php";

$title = "Test Page | Procurement";
$page = "test";

include "pageSections/head.php";
include "pageSections/header.php";
?>

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
					<div class="col col-4">
						<div class="card">
							<div class="card-header">
								Budget Code Owner <div id="budgetCodeSpinner"></div>
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
					<div class="col col-4">
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
					<div class="col col-4">
						<div class="card">
							<div class="card-header">
								Overview
							</div>
							<div class="card-body text-center">
								<h1 class="card-title" id="labelCost">£8.53</h1>
								<small id="labelAmount">(3 items)</small>
							</div>
							<div class="card-footer">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="inputRecurring" id="inputRecurring" disabled  >
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
											<th>ID</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>(Total)</th>
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
					<button type="button" class="btn btn-outline-success" data-dismiss="modal">Accept Request</button>
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Deny Request</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "pageSections/scripts.php" ?>
<script src="js/page/testPage.js"></script>
<?php include "pageSections/footer.php" ?>
