<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" href="#" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-wrench" aria-hidden="true"></i> Admin</a>
	<div class="dropdown-menu" aria-labelledby="dropdownAdmin">
		<a class="dropdown-item" data-toggle="modal" data-target="#usersModal"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
		<a class="dropdown-item" data-toggle="modal" data-target="#budgetCodesModal"><i class="fa fa-wrench" aria-hidden="true"></i> Budget Codes</a>
	</div>
</li>

<datalist id="userEmails"></datalist>
<datalist id="officerEmails"></datalist>

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
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#adminUserEdit" id="adminLinkUserEdit"> Edit User</a></li>
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
								<div id="adminUserEdit" role="tabpanel" class="tab-pane fade show">
									<form id="adminFormUserEdit" method="post">
										<div class="row">
											<div class="col col-3">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">ID </span></div>
													<input type="text" name="ID" id="adminUserEditID" class="form-control" placeholder="Select From Table" disabled required>
													<div class="input-group-append"><span class="input-group-text">
															<div id="adminUserEditSpinner"></div>
														</span></div>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Name</span></div>
													<input type="text" name="firstName" id="adminUserEditFirstName" class="form-control" placeholder="First Name" disabled required>
													<input type="text" name="lastName" id="adminUserEditLastName" class="form-control" placeholder="Last Name" disabled required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col col-3">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Room #</span></div>
													<input type="number" name="roomNumber" id="adminUserEditRoomNumber" class="form-control" placeholder="404" disabled required>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
													<input type="email" name="email" id="adminUserEditEmail" class="form-control" placeholder="user@bangor.ac.uk" disabled required>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Telephone</span></div>
													<input type="text" name="telephone" id="adminUserEditTelephone" class="form-control" placeholder="01234 567890" disabled required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Role</span></div>
													<select class="form-control" name="role" id="adminUserEditRole" disabled>
														<option value="REQUESTER">Requester</option>
														<option value="REQUISITION_OFFICER">Requisition Officer</option>
														<option value="CENTRAL_FINANCE">Central Finance</option>
													</select>
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">Password</span></div>
													<input type="password" name="password" id="adminUserEditPassword" class="form-control" placeholder disabled>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<button type="submit" class="btn btn-success col-sm-4" id="adminUserEditSubmit" disabled>Update User</button>
												<button type="reset" class="btn btn-outline-danger col-sm-4" id="adminUserEditClear" disabled>Clear</button>
											</div>
										</div>
									</form>
								</div>
								<!-- Delete User -->
								<div id="adminUserDelete" role="tabpanel" class="tab-pane fade">
									<div class="col">
										<div class="alert alert-info" id="adminUserDeleteAlertInfo" role="alert">
											Please select a user from the table above
										</div>
										<div class="alert alert-danger" role="alert">
											<h4 class="alert-heading">Danger!</h4>
											<p>You are about to delete a user, deleting a user cannot be reversed! The deleted user will lose ownership of all budget codes, and procurement requests. Please ensure the user you have selected is correct.</p>
											<hr>
											<form id="adminUserDeleteForm">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" name="adminUserDeleteCheckbox" id="adminUserDeleteCheckbox" value="1" disabled required> I Understand the Risks
													</label>
												</div>
												<button type="button" class="btn btn-primary" id="adminUserDeleteButton" disabled>Delete User</button>
											</form>
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
</div>

<!-- Budget Codes Modal -->
<div class="modal fade fullscreen" id="budgetCodesModal" tabindex="-1" role="dialog" aria-labelledby="budgetCodesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="col-2">
					<h5 class="modal-title" id="usersModalLabel">Configure Budget Codes</h5>
				</div>
				<div class="col-9">
					<div class="input-group">
						<input type="text" class="form-control" id="adminSearchBudgetCodes" placeholder="Search">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="adminSearchBudgetCodesButton"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<table class="table table-sm table-bordered table-hover table-responsive-md text-center" id="adminTableBudgetCodes">
								<thead class="thead-dark">
									<tr>
										<th width="200">Budget Code</th>
										<th>Owner</th>
										<th>Procurement Officer</th>
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
						<div class="col" id="adminBudgetCodeAlerts"></div>
					</div>
					<div class="row">
						<div class="col">
							<nav>
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#adminBudgetCodeNew" id="adminLinkBudgetCodeNew">New Budget Code</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#adminBudgetCodeEdit" id="adminLinkBudgetCodeEdit"> Edit Budget Code</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#adminBudgetCodeDelete" id="adminLinkBudgetCodeDelete">Delete Budget Code</a></li>
								</ul>
							</nav>
							<div class="tab-content">
								<!-- New Budget Code -->
								<div id="adminBudgetCodeNew" role="tabpanel" class="tab-pane fade show active">
									<form id="adminFormBudgetCodeNew" method="post">
										<div class="row">
											<div class="col">
												<div class="row">
													<div class="col">
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">ID</span></div>
															<input type="text" name="id" id="adminBudgetCodeNewID" class="form-control" placeholder="XX######" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<button type="submit" name="adminBudgetCodeNewButton" id="adminBudgetCodeNewButton" class="btn btn-primary btn-lg btn-block">Create Budget Code</button>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card">
													<div class="card-header">
														Budget Code Owner
													</div>
													<div class="card-body">
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
															<input type="email" list="userEmails" class="form-control" name="email" id="adminBudgetCodeNewOwnerEmail" required>
															<div class="input-group-append"><span class="input-group-text">
																	<div id="adminBudgetCodeNewOwnerEmailSpinner"></div>
																</span></div>
															<div class="valid-feedback is-valid" id="adminBudgetCodeNewOwnerEmailResponse"></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card">
													<div class="card-header">
														Procurement Officer
													</div>
													<div class="card-body">
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">Email</span></div>
															<input type="email" list="officerEmails" class="form-control" name="email" id="adminBudgetCodeNewOfficerEmail" required>
															<div class="input-group-append"><span class="input-group-text">
																	<div id="adminBudgetCodeNewOfficerEmailSpinner"></div>
																</span></div>
															<div class="valid-feedback is-valid" id="adminBudgetCodeNewOfficerEmailResponse"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- Edit Budget Code -->
								<div id="adminBudgetCodeEdit" role="tabpanel" class="tab-pane fade">
									<form id="adminFormBudgetCodeEdit" method="post">
										<div class="display-1">Edit Budget Code</div>
									</form>
								</div>
								<!-- Delete Budget Code -->
								<div id="adminBudgetCodeDelete" role="tabpanel" class="tab-pane fade">
									<div class="col">
										<div class="alert alert-info" id="adminBudgetCodeDeleteAlertInfo" role="alert">
											Please select a budget code from the table above
										</div>
										<div class="alert alert-danger" role="alert">
											<h4 class="alert-heading">Danger!</h4>
											<p>You are about to delete a budget code, deleting a budget code cannot be reversed! Please ensure the budget code you have selected is correct.</p>
											<hr>
											<form id="adminBudgetCodeDeleteForm">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="checkbox" name="adminBudgetCodeDeleteCheckbox" id="adminBudgetCodeDeleteCheckbox" value="1" disabled required> I Understand the Risks
													</label>
												</div>
												<button type="button" class="btn btn-primary" id="adminBudgetCodeDeleteButton" disabled>Delete Budget Code</button>
											</form>
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
</div>
