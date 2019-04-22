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
				<div class="col-2">
					<h5 class="modal-title" id="usersModalLabel">Configure Users</h5>
				</div>
				<div class="col-9">
					<div class="input-group">
						<input type="text" class="form-control" id="adminSearchUser" placeholder="Search">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="adminSearchUserButton"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
				<div class="col-1">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<table class="table table-bordered table-hover table-responsive-md text-center" id="adminTableUsers">
								<thead class="thead-dark">
									<tr>
										<th width=100>User ID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th width=200>Role</th>
										<th>Email Address</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="8">
											<div class="spinner-border" role="status"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col">
					<div class="row" >
						<div class="col" id="adminUserAlerts">

						</div>
					</div>
					<div class="row">
						<div class="col">
							<nav>
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#adminUserNew" id="adminLinkUserNew">New User</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#adminUserEdit" id="adminLinkUserEdit">Edit User</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#adminUserDelete" id="adminLinkUserDelete">Delete User</a></li>
								</ul>
							</nav>
							<div class="tab-content">
								<div id="adminUserNew" role="tabpanel" class="tab-pane fade show active">
									<form id="adminFormUserNew" method="post">
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
													<label for="roomNumber">Room #</label>
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
														<option value="REQUESTER">Requester</option>
														<option value="REQUISITION_OFFICER">Requisition Officer</option>
														<option value="CENTRAL_FINANCE">Central Finance</option>
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
												<button type="submit" class="btn btn-success col-sm-4">Create New User</button>
											</div>
										</div>
									</form>
								</div>
								<div id="adminUserEdit" role="tabpanel" class="tab-pane fade">
									<form id="adminUserForm" method="post">
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
												<button type="submit" class="btn btn-success col-sm-4">Create New User</button>
												<button type="reset" class="btn btn-outline-danger col-sm-2">Cancel</button>
											</div>
										</div>
									</form>
								</div>
								<div id="adminUserDelete" role="tabpanel" class="tab-pane fade">
									<div class="display-1">
										DELETE USER!‽‽‽‽?‽?
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
				<div class="input-group">
					<input type="text" class="form-control" id="adminSearchBudgetCodes" placeholder="Search">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" id="adminSearchBudgetCodesButton"><i class="fa fa-search"></i></button>
					</div>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
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
										<td colspan="8">
											<div class="spinner-border" role="status"></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times "></i> Cancel</button>
				<button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save changes</button>
			</div>
		</div>
	</div>
</div>
