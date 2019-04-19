<?php
include "webphp/session.php";

$title = "Make a Request | Procurement";
$page = "makeRequest";

include "pageSections/head.php";
include "pageSections/header.php";
?>

<main role="main" class="col-md-12 ml-sm-auto px-4 container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col">
					<div class="form-label-group">
						<input type="text" id="inputBudgetCode" class="form-control" name="inputBudgetCode">
						<label for="inputBudgetCode">Budget Code</label>
						<div class="valid-feedback" id="budget_code_response"></div>
					</div>
				</div>
				<div class="col">
					<div class="form-label-group">
						<input type="text" id="inputSupplier" class="form-control" name="inputSupplier">
						<label for="inputSupplier">Supplier</label>
						<div class="valid-feedback" id="supplier_response"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							Budget Code Owner
						</div>
						<div class="card-body">
							<div class="card-text">
								<strong>Name </strong>
								<div id="budgetCodeName">I.A.Jones</div>
								<strong>Room No. </strong>
								<div id="budgetCodeRoom">115</div>
								<strong>Telephone Number</strong>
								<div id="budgetCodeNum">2727</div>
								<strong>Email</strong>
								<div id="budgetCodeEmail">ijones@bangor.ac.uk</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							Supplier
						</div>
						<div class="card-body">
							<div class="form-group">
								<div class="form-label-group">
									<input type="text" id="inputSupplierName" class="form-control">
									<label for="inputAddress1">Name</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddress1" class="form-control">
									<label for="inputAddress1">Address Line 1</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddress2" class="form-control">
									<label for="inputAddress2">Address Line 2</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddressPostcode" class="form-control">
									<label for="inputAddressPostcode">Postcode</label>
								</div>
								<div class="form-label-group">
									<input type="text" id="inputSupplierAddressCity" class="form-control">
									<label for="inputAddressCity">City / Town</label>
								</div>
							</div>
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
									<input type="checkbox" class="form-check-input" name="inputRecurring" id="inputRecurring" checked>
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
					<button type="button" name="buttonDraft" id="buttonDraft" class="btn btn-primary btn-lg btn-block">Save Draft</button>
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
						<td><input type="text" class="form-control" name="1" id="inputItem1Description" value="6mm DIA ST/STEEL TUBE (437-3683)"></td>
						<td><input type="number" class="form-control" name="inputItem1Quantity" id="inputItem1Quantity" value="5"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control" name="inputItem1Cost" id="inputItem1Cost" value="10.48">
							</div>
						</td>
					</tr>
					<tr>
						<td scope="row">2</td>
						<td><input type="text" class="form-control" name="2" id="inputItem2Description" value="6mm STRAIGHT UNIONS (432-4681)"></td>
						<td><input type="number" class="form-control" name="inputItem2Quantity" id="inputItem2Quantity" value="4"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control" name="inputItem2Cost" id="inputItem2Cost" value="8.99">
							</div>
						</td>
					</tr>
					<tr>
						<td scope="row">3</td>
						<td><input type="text" class="form-control" name="3" id="inputItem3Description" value="6mm → 1/4'' ADAPTER (439-666)"></td>
						<td><input type="number" class="form-control" name="inputItem3Quantity" id="inputItem3Quantity" value="5"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control" name="inputItem3Cost" id="inputItem3Cost" value="2.27">
							</div>
						</td>
					</tr>
					<tr>
						<td scope="row">4</td>
						<td><input type="text" class="form-control" name="4" id="inputItem4Description" value="HOSETAILS (506-7200)"></td>
						<td><input type="number" class="form-control" name="inputItem4Quantity" id="inputItem4Quantity" value="2"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control" name="inputItem4Cost" id="inputItem4Cost" value="1.61">
							</div>
						</td>
					</tr>
					<tr>
						<td scope="row">5</td>
						<td><input type="text" class="form-control" name="5" id="inputItem5Description">
						</td>
						<td><input type="number" class="form-control" name="inputItem5Quantity" id="inputItem5Quantity"></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">£</span></div>
								<input type="text" class="form-control" name="inputItem5Cost" id="inputItem5Cost">
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</main>

<?php include "pageSections/scripts.php"?>
<script src="js/makerequest.js"></script>;
<?php include "pageSections/footer.php"?>
