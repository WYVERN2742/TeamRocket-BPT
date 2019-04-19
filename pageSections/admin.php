<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" href="#" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-wrench" aria-hidden="true"></i> Admin</a>
	<div class="dropdown-menu" aria-labelledby="dropdownAdmin">
		<a class="dropdown-item" data-toggle="modal" data-target="#usersModal"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
		<a class="dropdown-item" data-toggle="modal" data-target="#budgetCodesModal"><i class="fa fa-wrench" aria-hidden="true"></i> Budget Codes</a>
	</div>
</li>

<!-- Users Modal -->
<div class="modal fade fullscreen" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
	<div class="modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="usersModalLabel">Configure Users</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="input-group">
							<input type="text" class="form-control" id="adminSearchUser" placeholder="Search">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" id="adminSearchUserButton"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<table class="table table-bordered table-hover table-responsive-md text-center" id="adminTableUsers">
								<thead class="thead-dark">
									<tr>
										<th>User ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Role</th>
										<th>Email Address</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="8"><div class="spinner-border" role="status"></div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<!-- Budget Codes Modal -->
<div class="modal fade fullscreen" id="budgetCodesModal" tabindex="-1" role="dialog" aria-labelledby="budgetCodesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="budgetCodesModalLabel">Configure Budget Codes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="input-group">
							<input type="text" class="form-control" id="adminSearchBudgetCodes" placeholder="Search">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" id="adminSearchBudgetCodesButton"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<table class="table table-bordered table-hover table-responsive-md text-center" id="adminTableBudgetCodes">
								<thead class="thead-dark">
									<tr>
										<th>Budget Code</th>
										<th>Owner</th>
										<th>Procurement Officer</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="8"><div class="spinner-border" role="status"></div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success">Save changes</button>
			</div>
		</div>
	</div>
</div>
