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
							<table class="table table-bordered table-hover table-responsive-md text-center table-sm " id="adminTableUsers">
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
					<div class="row">
						<div class="col" id="adminUserAlerts"></div>
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
								<!-- New User -->
								<div id="adminUserNew" role="tabpanel" class="tab-pane fade show active">
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
													<input type="number" name="roomNumber" id="roomNumber" class="form-control" required>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
													<input type="email" name="email" id="email" class="form-control" placeholder required>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Telephone</span></div>
													<input type="text" name="telephone" id="telephone" class="form-control" placeholder required>
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
												<button type="submit" class="btn btn-success col-sm-4">Create New User</button>
											</div>
										</div>
									</form>
								</div>
								<!-- Edit User -->
								<div id="adminUserEdit" role="tabpanel" class="tab-pane fade">
									<div id="adminUserEdit" role="tabpanel" class="tab-pane fade show active">
										<form id="adminFormUserEdit" method="post">
											<div class="row">
												<div class="col col-3">
												<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">ID</span></div>
														<input type="text" name="ID" id="ID" class="form-control" placeholder="Select From Table" disabled required>
													</div>
												</div>
												<div class="col">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Name</span></div>
														<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" disabled required>
														<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" disabled required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col col-3">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Room #</span></div>
														<input type="number" name="roomNumber" id="roomNumber" class="form-control" placeholder="404" disabled required>
													</div>
												</div>
												<div class="col">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
														<input type="email" name="email" id="email" class="form-control" placeholder="user@bangor.ac.uk" disabled required>
													</div>
												</div>
												<div class="col">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Telephone</span></div>
														<input type="text" name="telephone" id="telephone" class="form-control" placeholder="01234 567890" disabled required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Role</span></div>
														<select class="form-control" name="role" id="role" disabled>
															<option value="REQUESTER">Requester</option>
															<option value="REQUISITION_OFFICER">Requisition Officer</option>
															<option value="CENTRAL_FINANCE">Central Finance</option>
														</select>
													</div>
												</div>
												<div class="col">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">Password</span></div>
														<input type="password" name="password" id="password" class="form-control" placeholder disabled required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<button type="submit" class="btn btn-success col-sm-4" disabled>Update User</button>
													<button type="reset" class="btn btn-outline-danger col-sm-4" disabled>Clear</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<!-- Delete User -->
								<div id="adminUserDelete" role="tabpanel" class="tab-pane fade">
									<div class="display-1">
										Delete User
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
