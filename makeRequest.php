<?php
include "webphp/session.php";

$title = "Make a Request | Procurement";
$page = "makeRequest";

include "pageSections/head.php";
include "pageSections/header.php";
?>

<datalist id="listSuppliers"></datalist>
<datalist id="listBudgetCodes"></datalist>

<main role="main" class="col-md-12 ml-sm-auto px-4 container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col">
					<div class="form-label-group">
						<input type="text" id="inputBudgetCode" class="form-control is-invalid" name="inputBudgetCode" list="listBudgetCodes">
						<label for="inputBudgetCode">
							<div id="budgetCodeIDSpinner" class="spinner-border spinner-border-sm"></div> Budget Code
						</label>
						<div class="invalid-feedback" id="budget_code_response">Not Found! - Valid Budget Code Required</div>
					</div>
				</div>
				<div class="col">
					<div class="form-label-group">
						<input type="text" id="inputSupplier" class="form-control is-invalid" name="inputSupplier" list="listSuppliers">
						<label for="inputSupplier">
							<div id="supplierIDSpinner" class="spinner-border spinner-border-sm"></div> Supplier
						</label>
						<div class="invalid-feedback" id="supplier_response">Not Found! - Valid Pre-approved Supplier Required</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							Budget Code Owner <div id="budgetCodeSpinner"></div>
						</div>
						<div class="card-body">
							<div class="card-text">
								<strong>Name </strong>
								<div id="budgetCodeName"><br> </div>
								<strong>Room No. </strong>
								<div id="budgetCodeRoom"><br> </div>
								<strong>Telephone Number</strong>
								<div id="budgetCodeNum"><br> </div>
								<strong>Email</strong>
								<div id="budgetCodeEmail"><br> </div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							Supplier <div id="supplierSpinner"></div>
						</div>
						<div class="card-body">
							<div class="card-text">
								<strong>Name </strong>
								<div id="inputSupplierName"><br> </div>
								<strong>Address Line 1 </strong>
								<div id="inputSupplierAddress1"><br> </div>
								<strong>Address Line 2</strong>
								<div id="inputSupplierAddress2"><br> </div>
								<strong>Postcode</strong>
								<div id="inputSupplierAddressPostcode"><br> </div>
								<strong>City / Town</strong>
								<div id="inputSupplierAddressCity"><br> </div>
							</div>
							<!-- <div class="form-group">
								<div class="form-label-group">
									<input type="text" id="inputSupplierName" class="form-control">
									<label for="inputSupplierName">Name</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddress1" class="form-control">
									<label for="inputSupplierAddress1">Address Line 1</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddress2" class="form-control">
									<label for="inputSupplierAddress2">Address Line 2</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddressPostcode" class="form-control">
									<label for="inputSupplierAddressPostcode">Postcode</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddressCity" class="form-control">
									<label for="inputSupplierAddressCity">City / Town</label>
								</div>
							</div> -->
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
							<h2 class="card-title" id="labelCost">£0.00</h2>
						</div>
						<div class="card-footer">
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" name="inputRecurring" id="inputRecurring">
									Recurring Order
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col align-self-start">
					<button type="button" name="buttonSubmit" id="buttonSubmit" class="btn btn-success btn-lg btn-block">Submit</button>
				</div>
				<div class="col align-self-end">
					<button type="button" name="buttonDraft" id="buttonDraft" class="btn btn-primary btn-lg btn-block" disabled>Save Draft</button>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<table class="table table-bordered table-hover table-responsive-md text-center" id="tableItems">
				<caption>For more rows, fill in current entries.</caption>
				<thead class="thead-dark">
					<tr>
						<th width="75">Item</th>
						<th>Description</th>
						<th width="150">Quantity</th>
						<th width="150">Cost (Each)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td scope="row">1</td>
						<td><input type="text" class="form-control" name="inputItem1Description" id="inputItem1Description"></td>
						<td><input type="number" class="form-control quantity" name="inputItem1Quantity" id="inputItem1Quantity"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control cost" name="inputItem1Cost" id="inputItem1Cost">
							</div>
						</td>
					</tr>
					<tr>
						<td scope="row">2</td>
						<td><input type="text" class="form-control" name="inputItem2Description" id="inputItem2Description"></td>
						<td><input type="number" class="form-control quantity" name="inputItem2Quantity" id="inputItem2Quantity"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control cost" name="inputItem2Cost" id="inputItem2Cost">
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</main>

<?php include "pageSections/scripts.php" ?>
<script src="js/page/makeRequest.js"></script>
<?php include "pageSections/footer.php" ?>
