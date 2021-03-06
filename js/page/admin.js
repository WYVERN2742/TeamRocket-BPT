let adminSelectedUserRow;
let adminSelectedBudgetCodeRow;
let adminUserEmails;
let adminOfficerEmails;

/**
 * Populate the admin user table.
 * Also creates and binds events to the rows.
 */
function adminLoadUsers() {
	$.ajax({
		// Populate admin users table
		type: "GET",
		url: "api/user/getAllUsers.php",
		contentType: "application/json",

		success: function (rows) {
			const numRows = rows.length;

			let count = 0;
			const dt = dynamicTable().config("adminTableUsers",
				["userId", "firstName", "lastName", "role", "email"], null, "No users");

			for (let i = 0; i < numRows; i++) {
				// Add all rows to table
				dt.load([rows[count++]], true);
			}

			$("#adminTableUsers tbody tr").on("click", (function () {
				adminSelectedUserRow = $(this);
				let cols = adminSelectedUserRow.children("td");
				// Switch colours
				adminSelectedUserRow.addClass("bg-info").siblings().removeClass("bg-info");

				$("#adminUserEditSpinner").addClass("spinner-border");
				$("#adminUserEditSpinner").addClass("spinner-border-sm");

				// Populate edit fields
				$.ajax({

					type: "POST",
					url: "api/user/getUser.php",
					contentType: "application/json",
					data: JSON.stringify(cols[0].textContent),

					success: function (user) {
						if (user.userId != cols[0].textContent) {
							// Ensure the currently selected user is the received ajax
							// In some cases where the request is slow, the user could've clicked
							// another user before we receive the data
							return;
						}

						$("#adminUserEditSpinner").removeClass("spinner-border");
						$("#adminUserEditSpinner").removeClass("spinner-border-sm");

						// Populate edit fields
						$("#adminUserEditID").val(user.userId);
						$("#adminUserEditFirstName").val(user.firstName);
						$("#adminUserEditLastName").val(user.lastName);
						$("#adminUserEditRoomNumber").val(user.roomNo);
						$("#adminUserEditTelephone").val(user.telephoneNo);
						$("#adminUserEditEmail").val(user.email);
						$("#adminUserEditRole").val(user.role);

						adminUserEnableEdit();

						$("#adminUserDeleteAlertInfo").html("Selected user: <strong>" + user.firstName + " " + user.lastName +
							"</strong> <br> <italic> " + user.email + "</italic> (" + user.telephoneNo + ")");
						resetUserDeleteState();

					},

					error: function (xhr, resp, text) {
						adminUserAlert("<strong> Failed to load user</strong> Response was '" + text + "'", "danger");
						$("#budgetCodeSpinner").removeClass("spinner-border");
						$("#budgetCodeSpinner").removeClass("spinner-border-sm");
						resetUserDeleteState();
					}
				});

			}));
		},
	});
}

/**
 * Populate the admin budget codes table.
 * Also creates and binds events to the rows.
 */
function adminLoadBudgetCodes() {
	$.ajax({
		type: "GET",
		url: "api/budgetCode/getAllBudgetCodeEmails.php",
		contentType: "application/json",

		success: function (rows) {
			const numRows = rows.length;
			let count = 0;
			const dt = dynamicTable().config("adminTableBudgetCodes",
				["budgetCode", "ownerEmail", "procurementOfficerEmail"], null, "No budget codes");

			for (let i = 0; i < numRows; i++) {
				// Add all rows to table
				dt.load([rows[count++]], true);
			}

			$("#adminTableBudgetCodes tbody tr").on("click", (function () {
				adminSelectedBudgetCodeRow = $(this);
				let cols = adminSelectedBudgetCodeRow.children("td");

				// Switch colours
				adminSelectedBudgetCodeRow.addClass("bg-info").siblings().removeClass("bg-info");

				$("#adminBudgetCodeEditSpinner").addClass("spinner-border");
				$("#adminBudgetCodeEditSpinner").addClass("spinner-border-sm");
				adminBudgetCodeDisableEdit();

				// Populate edit fields
				$.ajax({

					type: "POST",
					url: "api/budgetCode/getBudgetCode.php",
					contentType: "application/json",
					data: JSON.stringify({ budgetCode: cols[0].textContent }),

					success: function (budgetCode) {
						$.ajax({
							type: "Post",
							url: "api/budgetcode/getBudgetCodeOwner.php",
							contentType: "application/json",
							data: JSON.stringify(budgetCode.budgetCode),

							success: function (owner) {
								$.ajax({
									type: "Post",
									url: "api/budgetcode/getBudgetCodeOfficer.php",
									contentType: "application/json",
									data: JSON.stringify(budgetCode.budgetCode),

									success: function (officer) {
										if (budgetCode.budgetCode != cols[0].textContent) {
											// Ensure the currently selected BudgetCode is the received ajax
											// In some cases where the request is slow, the user could've clicked
											// another BudgetCode before we receive the data
											return;
										}

										$("#adminBudgetCodeDeleteAlertInfo").html("Selected Budget Code: <strong>" + budgetCode.budgetCode + "</strong>"
											+ "<br>" + owner.firstName + " " + owner.lastName + "  <i>(" + owner.email + ")</i>"
											+ "<br>" + officer.firstName + " " + officer.lastName + "  <i>(" + officer.email + ")</i>");

										resetBudgetCodeDeleteState();

										$("#adminBudgetCodeEditSpinner").removeClass("spinner-border");
										$("#adminBudgetCodeEditSpinner").removeClass("spinner-border-sm");

										// Populate edit fields
										$("#adminBudgetCodeEditID").val(budgetCode.budgetCode);
										$("#adminBudgetCodeEditOwnerEmail").val(owner.email);
										$("#adminBudgetCodeEditOfficerEmail").val(officer.email);

										adminBudgetCodeEnableEdit();
									}
								});
							},
						});
					}
				});
			}));
		}
	});
}

/**
 * Resets the checkbox and button state of the delete confirmation
 * dialogue.
 */
function resetUserDeleteState() {
	window.document.getElementById("adminUserDeleteCheckbox").checked = false;
	window.document.getElementById("adminUserDeleteButton").disabled = true;
}

/**
 * Enable the user editing form.
 */
function adminUserDisableEdit() {
	window.document.getElementById("adminUserEditFirstName").disabled = true;
	window.document.getElementById("adminUserEditLastName").disabled = true;
	window.document.getElementById("adminUserEditRoomNumber").disabled = true;
	window.document.getElementById("adminUserEditEmail").disabled = true;
	window.document.getElementById("adminUserEditTelephone").disabled = true;
	window.document.getElementById("adminUserEditRole").disabled = true;
	window.document.getElementById("adminUserEditPassword").disabled = true;
	window.document.getElementById("adminUserEditSubmit").disabled = true;
	window.document.getElementById("adminUserEditFirstName").disabled = true;
	window.document.getElementById("adminUserEditClear").disabled = true;

	// Reset delete window
	$("#adminUserDeleteAlertInfo").html("Please select a user from the table above");
	window.document.getElementById("adminUserDeleteButton").disabled = true;
	resetUserDeleteState();

}

/**
 * Disable the user editing form.
 */
function adminUserEnableEdit() {
	window.document.getElementById("adminUserEditFirstName").disabled = false;
	window.document.getElementById("adminUserEditLastName").disabled = false;
	window.document.getElementById("adminUserEditRoomNumber").disabled = false;
	window.document.getElementById("adminUserEditEmail").disabled = false;
	window.document.getElementById("adminUserEditTelephone").disabled = false;
	window.document.getElementById("adminUserEditRole").disabled = false;
	window.document.getElementById("adminUserEditPassword").disabled = false;
	window.document.getElementById("adminUserEditFirstName").disabled = false;

	window.document.getElementById("adminUserEditSubmit").disabled = false;
	window.document.getElementById("adminUserEditClear").disabled = false;

	// Enable delete checkbox
	window.document.getElementById("adminUserDeleteCheckbox").disabled = false;
	resetUserDeleteState();
}

/**
 * Resets the checkbox and button state of the delete confirmation
 * dialogue.
 */
function resetBudgetCodeDeleteState() {
	window.document.getElementById("adminBudgetCodeDeleteCheckbox").checked = false;
	window.document.getElementById("adminBudgetCodeDeleteButton").disabled = true;
}

/**
 * Enable the BudgetCode editing form.
 */
function adminBudgetCodeDisableEdit() {
	window.document.getElementById("adminBudgetCodeEditID").disabled = true;
	window.document.getElementById("adminBudgetCodeEditOwnerEmail").disabled = true;
	window.document.getElementById("adminBudgetCodeEditOfficerEmail").disabled = true;

	window.document.getElementById("adminBudgetCodeEditSubmit").disabled = true;
	window.document.getElementById("adminBudgetCodeEditClear").disabled = true;

	// Reset delete window
	$("#adminBudgetCodeDeleteAlertInfo").html("Please select a budget code from the table above");
	window.document.getElementById("adminBudgetCodeDeleteButton").disabled = true;
	resetBudgetCodeDeleteState();


	// Remove spinners and validation messages
	$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border");
	$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border-sm");

	$("#adminBudgetCodeEditOwnerEmailResponse").removeClass("valid-feedback");
	$("#adminBudgetCodeEditOwnerEmailResponse").removeClass("invalid-feedbac");
	$("#adminBudgetCodeEditOwnerEmailResponse").html("");
	$("#adminBudgetCodeEditOwnerEmail").val("");
	$("#adminBudgetCodeEditOwnerEmail").removeClass("is-valid");
	$("#adminBudgetCodeEditOwnerEmail").removeClass("is-invalid");

	$("#adminBudgetCodeEditOfficerEmailResponse").removeClass("valid-feedback");
	$("#adminBudgetCodeEditOfficerEmailResponse").removeClass("invalid-feedbac");
	$("#adminBudgetCodeEditOfficerEmailResponse").html("");
	$("#adminBudgetCodeEditOfficerEmail").val("");
	$("#adminBudgetCodeEditOfficerEmail").removeClass("is-valid");
	$("#adminBudgetCodeEditOfficerEmail").removeClass("is-invalid");
}

/**
 * Disable the BudgetCode editing form.
 */
function adminBudgetCodeEnableEdit() {
	window.document.getElementById("adminBudgetCodeEditID").disabled = false;
	window.document.getElementById("adminBudgetCodeEditOwnerEmail").disabled = false;
	window.document.getElementById("adminBudgetCodeEditOfficerEmail").disabled = false;

	window.document.getElementById("adminBudgetCodeEditSubmit").disabled = false;
	window.document.getElementById("adminBudgetCodeEditClear").disabled = false;

	// Enable delete checkbox
	window.document.getElementById("adminBudgetCodeDeleteCheckbox").disabled = false;


	validateEditBudgetCodeOfficerEmail();
	validateEditBudgetCodeOwnerEmail();
	resetBudgetCodeDeleteState();
}


/**
 * Create an alert on the admin user page.
 * @param {String} message Message to display
 * @param {String} type Type of alert <https://getbootstrap.com/docs/4.0/components/alerts/>
 */
function adminUserAlert(message, type) {
	if (type === undefined) {
		type = "info";
	}

	$("#adminUserAlerts").append("<div class=\"alert alert-" + type + " alert-dismissible fade show\" role=\"alert\">" +
		message +
		"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
		"<span aria-hidden=\"true\">&times;</span></button></div>");
}

/**
 * Create an alert on the admin budget code page.
 * @param {String} message Message to display
 * @param {String} type Type of alert <https://getbootstrap.com/docs/4.0/components/alerts/>
 */
function adminBudgetCodeAlert(message, type) {
	if (type === undefined) {
		type = "info";
	}

	$("#adminBudgetCodeAlerts").append("<div class=\"alert alert-" + type + " alert-dismissible fade show\" role=\"alert\">" +
		message +
		"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
		"<span aria-hidden=\"true\">&times;</span></button></div>");
}

/**
 * Fix issue with bootstrap tab text colors
 * on modals.
 */
function bindLinkFix() {
	window.document.getElementById("adminLinkUserNew").onclick = function () {
		$("#adminLinkUserNew").addClass("text-secondary");
		$("#adminLinkUserNew").removeClass("text-primary");

		$("#adminLinkUserEdit").removeClass("text-secondary");
		$("#adminLinkUserEdit").addClass("text-primary");

		$("#adminLinkUserDelete").removeClass("text-secondary");
		$("#adminLinkUserDelete").addClass("text-primary");
		return false;
	};

	window.document.getElementById("adminLinkUserEdit").onclick = function () {
		$("#adminLinkUserNew").removeClass("text-secondary");
		$("#adminLinkUserNew").addClass("text-primary");

		$("#adminLinkUserEdit").addClass("text-secondary");
		$("#adminLinkUserEdit").removeClass("text-primary");

		$("#adminLinkUserDelete").removeClass("text-secondary");
		$("#adminLinkUserDelete").addClass("text-primary");
		return false;
	};

	window.document.getElementById("adminLinkUserDelete").onclick = function () {
		$("#adminLinkUserNew").removeClass("text-secondary");
		$("#adminLinkUserNew").addClass("text-primary");

		$("#adminLinkUserEdit").removeClass("text-secondary");
		$("#adminLinkUserEdit").addClass("text-primary");

		$("#adminLinkUserDelete").addClass("text-secondary");
		$("#adminLinkUserDelete").removeClass("text-primary");
		return false;
	};

	$("#adminLinkUserNew").addClass("text-secondary");
	$("#adminLinkUserNew").removeClass("text-primary");

	$("#adminLinkUserEdit").removeClass("text-secondary");
	$("#adminLinkUserEdit").addClass("text-primary");

	$("#adminLinkUserDelete").removeClass("text-secondary");
	$("#adminLinkUserDelete").addClass("text-primary");

	// Fix unreported bootstrap text color issue on modals
	window.document.getElementById("adminLinkBudgetCodeNew").onclick = function () {
		$("#adminLinkBudgetCodeNew").addClass("text-secondary");
		$("#adminLinkBudgetCodeNew").removeClass("text-primary");

		$("#adminLinkBudgetCodeEdit").removeClass("text-secondary");
		$("#adminLinkBudgetCodeEdit").addClass("text-primary");

		$("#adminLinkBudgetCodeDelete").removeClass("text-secondary");
		$("#adminLinkBudgetCodeDelete").addClass("text-primary");
		return false;
	};

	window.document.getElementById("adminLinkBudgetCodeEdit").onclick = function () {
		$("#adminLinkBudgetCodeNew").removeClass("text-secondary");
		$("#adminLinkBudgetCodeNew").addClass("text-primary");

		$("#adminLinkBudgetCodeEdit").addClass("text-secondary");
		$("#adminLinkBudgetCodeEdit").removeClass("text-primary");

		$("#adminLinkBudgetCodeDelete").removeClass("text-secondary");
		$("#adminLinkBudgetCodeDelete").addClass("text-primary");
		return false;
	};

	window.document.getElementById("adminLinkBudgetCodeDelete").onclick = function () {
		$("#adminLinkBudgetCodeNew").removeClass("text-secondary");
		$("#adminLinkBudgetCodeNew").addClass("text-primary");

		$("#adminLinkBudgetCodeEdit").removeClass("text-secondary");
		$("#adminLinkBudgetCodeEdit").addClass("text-primary");

		$("#adminLinkBudgetCodeDelete").addClass("text-secondary");
		$("#adminLinkBudgetCodeDelete").removeClass("text-primary");
		return false;
	};

	$("#adminLinkBudgetCodeNew").addClass("text-secondary");
	$("#adminLinkBudgetCodeNew").removeClass("text-primary");

	$("#adminLinkBudgetCodeEdit").removeClass("text-secondary");
	$("#adminLinkBudgetCodeEdit").addClass("text-primary");

	$("#adminLinkBudgetCodeDelete").removeClass("text-secondary");
	$("#adminLinkBudgetCodeDelete").addClass("text-primary");
}

function validateEditBudgetCodeOwnerEmail() {
	let response = $("#adminBudgetCodeEditOwnerEmailResponse");
	let emailInput = $("#adminBudgetCodeEditOwnerEmail");

	// Make all emails lowercase for comparison
	let lEmail = adminUserEmails.map(function (elem) { return elem.toLowerCase(); });

	if ((lEmail.includes(emailInput.val().toLowerCase()))) {
		response.text("Loading info...");
		emailInput.addClass("is-valid");
		emailInput.removeClass("is-invalid");
		response.removeClass("invalid-feedback");
		response.addClass("valid-feedback");

		$("#adminBudgetCodeEditOwnerID").html("");
		$("#adminBudgetCodeEditOwnerEmailSpinner").addClass("spinner-border");
		$("#adminBudgetCodeEditOwnerEmailSpinner").addClass("spinner-border-sm");

		$.ajax({
			type: "POST",
			url: "api/user/getUserFromEmail.php",
			contentType: "application/json",
			data: JSON.stringify(emailInput.val()),

			success: function (row) {
				$("#adminBudgetCodeEditOwnerEmailSpinner").removeClass("spinner-border");
				$("#adminBudgetCodeEditOwnerEmailSpinner").removeClass("spinner-border-sm");
				response.html("<strong>" + row.firstName + " " + row.lastName + "</strong>\n" + row.email);
				$("#adminBudgetCodeEditOwnerID").html(row.userId);

			},

			error: function () {
				$("#adminBudgetCodeEditOwnerEmailSpinner").removeClass("spinner-border");
				$("#adminBudgetCodeEditOwnerEmailSpinner").removeClass("spinner-border-sm");
			}
		});

	} else {
		response.text("Not Found! - Existing User Email Required");
		emailInput.removeClass("is-valid");
		emailInput.addClass("is-invalid");
		response.removeClass("valid-feedback");
		response.addClass("invalid-feedback");
	}
}

function validateEditBudgetCodeOfficerEmail() {
	let response = $("#adminBudgetCodeEditOfficerEmailResponse");
	let emailInput = $("#adminBudgetCodeEditOfficerEmail");

	// Make all emails lowercase for comparison
	let lEmail = adminOfficerEmails.map(function (elem) { return elem.toLowerCase(); });

	if ((lEmail.includes(emailInput.val().toLowerCase()))) {
		response.text("Loading info...");
		emailInput.addClass("is-valid");
		emailInput.removeClass("is-invalid");
		response.removeClass("invalid-feedback");
		response.addClass("valid-feedback");

		$("#adminBudgetCodeEditOfficerID").html("");
		$("#adminBudgetCodeEditOfficerEmailSpinner").addClass("spinner-border");
		$("#adminBudgetCodeEditOfficerEmailSpinner").addClass("spinner-border-sm");

		$.ajax({
			type: "POST",
			url: "api/user/getUserFromEmail.php",
			contentType: "application/json",
			data: JSON.stringify(emailInput.val()),

			success: function (row) {
				$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border");
				$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border-sm");
				response.html("<strong>" + row.firstName + " " + row.lastName + "</strong>\n" + row.email);
				$("#adminBudgetCodeEditOfficerID").html(row.userId);
			},

			error: function () {
				$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border");
				$("#adminBudgetCodeEditOfficerEmailSpinner").removeClass("spinner-border-sm");
			}
		});

	} else {
		response.text("Not Found! - Existing User Email Required");
		emailInput.removeClass("is-valid");
		emailInput.addClass("is-invalid");
		response.removeClass("valid-feedback");
		response.addClass("invalid-feedback");
	}
}

// Postpone javascript execution until window is loaded
addLoadEvent(function () {
	// Link search to admin table
	$("#adminSearchUser").on("keyup", function () {
		search("adminTableUsers", $("#adminSearchUser").val());
	});

	$("#adminUserEditClear").on("click", function () {
		// Reset edit window
		window.document.getElementById("adminFormUserEdit").reset();
		adminUserDisableEdit();
		$("#adminTableUsers tbody tr").removeClass("bg-info");

		// Reset delete window
		$("#adminUserDeleteAlertInfo").html("Please select a user from the table above");

		resetUserDeleteState();
		window.document.getElementById("adminUserDeleteCheckbox").disabled = true;
	});

	$("#adminBudgetCodeEditClear").on("click", function () {
		// Reset edit window
		window.document.getElementById("adminFormBudgetCodeEdit").reset();
		adminBudgetCodeDisableEdit();
		$("#adminTableBudgetCodes tbody tr").removeClass("bg-info");

		// Reset delete window
		$("#adminBudgetCodeDeleteAlertInfo").html("Please select a budget code from the table above");

		resetBudgetCodeDeleteState();
		window.document.getElementById("adminBudgetCodeDeleteCheckbox").disabled = true;
	});


	$("#adminFormUserEdit").submit(function () {

		let form = document.forms.namedItem("adminFormUserEdit");

		let data = JSON.stringify({
			userId: form.elements["userId"].value,
			firstName: form.elements["firstName"].value,
			lastName: form.elements["lastName"].value,
			password: form.elements["password"].value,
			roomNumber: form.elements["roomNumber"].value,
			telephone: form.elements["telephone"].value,
			email: form.elements["email"].value,
			role: form.elements["role"].value
		});

		$.ajax({
			type: "POST",
			url: "api/user/editUser.php",
			contentType: "application/json",
			data: data
		})
			.done(function (response) {
				if (response === true) {
					adminUserAlert("<strong>User Updated!</strong> User was updated successfully", "success");
					adminLoadUsers();

					// Clear the edit box
					$("#adminUserEditClear").click();
				} else {
					adminUserAlert("<strong>Failed to update user!</strong> An error was encountered while trying to update the user", "danger");
				}
			})
			.fail(function (response) {
				try {
					adminUserAlert("<strong>Failed to update user!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminUserAlert("<strong>Failed to update user!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// to prevent refreshing the whole page page
		return false;
	});

	$("#adminUserDeleteCheckbox").on("click", function () {
		window.document.getElementById("adminUserDeleteButton").disabled = !window.document.getElementById("adminUserDeleteCheckbox").checked;
	});

	$("#adminUserDeleteButton").on("click", function () {
		resetUserDeleteState();
		if (adminSelectedUserRow === undefined) {
			// Somehow a row isn't selected?
			adminUserDisableEdit();
			adminUserAlert("<strong>Broken state</strong> No User selected for deletion");
			return;
		}

		$.ajax({
			type: "POST",
			url: "api/user/deleteUser.php", //php to post to
			data: adminSelectedUserRow.children("td")[0].textContent
		})
			.done(function (response) { //successful function
				if (response === true) {
					adminUserAlert("<strong>User Deleted!</strong> Deleted user successfully", "success");
					adminLoadUsers();
					window.document.getElementById("adminUserDeleteForm").reset();
					adminUserDisableEdit();
				} else {
					adminUserAlert("<strong>Failed to delete user!</strong> An error was encountered while trying to delete the user", "danger");
				}
			})
			.fail(function (response) {
				try {
					adminUserAlert("<strong>Failed to delete user!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminUserAlert("<strong>Failed to delete user!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// to prevent refreshing the whole page page
		return false;

	});

	$("#adminBudgetCodeDeleteCheckbox").on("click", function () {
		window.document.getElementById("adminBudgetCodeDeleteButton").disabled = !window.document.getElementById("adminBudgetCodeDeleteCheckbox").checked;
	});

	$("#adminBudgetCodeDeleteButton").on("click", function () {
		// resetBudgetCodeDeleteState();
		if (adminSelectedBudgetCodeRow === undefined) {
			// Somehow a row isn't selected?
			// adminBudgetCodeDisableEdit();
			adminBudgetCodeAlert("<strong>Broken state</strong> No Budget Code selected for deletion");
			return;
		}

		$.ajax({
			type: "POST",
			url: "api/budgetCode/deleteBudgetCode.php", //php to post to
			data: JSON.stringify({ budgetCode: adminSelectedBudgetCodeRow.children("td")[0].textContent })
		})
			.done(function (response) { //successful function
				if (response === true) {
					adminBudgetCodeAlert("<strong>Budget Code Deleted!</strong> Deleted Budget Code successfully", "success");
					adminLoadBudgetCodes();
					window.document.getElementById("adminBudgetCodeDeleteForm").reset();
					// adminBudgetCodeDisableEdit();
				} else {
					adminBudgetCodeAlert("<strong>Failed to delete Budget Code!</strong> An error was encountered while trying to delete the Budget Code", "danger");
				}
			})
			.fail(function (response) {
				try {
					adminBudgetCodeAlert("<strong>Failed to delete Budget Code!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminBudgetCodeAlert("<strong>Failed to delete Budget Code!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// to prevent refreshing the whole page page
		return false;

	});

	// Fix unreported bootstrap text color issue on modals
	bindLinkFix();

	$("#adminFormUserNew").submit(function () {

		$.ajax({
			type: "POST",
			url: "api/user/newUser.php", //php to post to
			data: $(this).serializeObject() //serializes all the form data to be sent as a post
		})
			.done(function (response) { //successful function
				if (response === true) {
					adminUserAlert("<strong>User Created!</strong> Created a new user successfully", "success");
					window.document.getElementById("adminFormUserNew").reset();
					adminLoadUsers();
				} else {
					adminUserAlert("<strong>Failed to create user!</strong> An error was encountered while trying to create a new user", "danger");
				}
			})
			.fail(function (response) {
				//failure function
				try {
					adminUserAlert("<strong>Failed to create user!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminUserAlert("<strong>Failed to create user!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// to prevent refreshing the whole page page
		return false;

	});

	$("#adminFormBudgetCodeNew").submit(function () {
		// Validation
		if (!$("#adminBudgetCodeNewOwnerEmail").hasClass("is-valid")) {
			return false;
		}

		if (!$("#adminBudgetCodeNewOfficerEmail").hasClass("is-valid")) {
			return false;
		}

		let data = {
			budgetCode: $("#adminBudgetCodeNewID").val(),
			ownerId: $("#adminBudgetCodeNewOwnerID").html(),
			procurementOfficer: $("#adminBudgetCodeNewOfficerID").html(),
		};

		$.ajax({
			type: "POST",
			url: "api/budgetCode/newBudgetCode.php",
			contentType: "application/json",
			data: JSON.stringify(data)  //serializes all the form data to be sent as a post
		})
			.done(function (response) { //successful function
				if (response === true) {
					adminBudgetCodeAlert("<strong>Budget Code Created!</strong> Created a new budget code successfully", "success");
					window.document.getElementById("adminFormBudgetCodeNew").reset();
					adminLoadBudgetCodes();
				} else {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> An error was encountered while trying to create a new budget code", "danger");
				}
			})
			.fail(function (response) {
				// failure function
				try {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// Prevent redirect
		return false;
	});

	$("#adminBudgetCodeNewOwnerEmail").on("input", function () {
		let response = $("#adminBudgetCodeNewOwnerEmailResponse");
		let emailInput = $("#adminBudgetCodeNewOwnerEmail");

		// Make all emails lowercase for comparison
		let lEmail = adminUserEmails.map(function (elem) { return elem.toLowerCase(); });

		if ((lEmail.includes(emailInput.val().toLowerCase()))) {
			response.text("Loading info...");
			emailInput.addClass("is-valid");
			emailInput.removeClass("is-invalid");
			response.removeClass("invalid-feedback");
			response.addClass("valid-feedback");

			$("#adminBudgetCodeNewOwnerID").html("");
			$("#adminBudgetCodeNewOwnerEmailSpinner").addClass("spinner-border");
			$("#adminBudgetCodeNewOwnerEmailSpinner").addClass("spinner-border-sm");

			$.ajax({
				type: "POST",
				url: "api/user/getUserFromEmail.php",
				contentType: "application/json",
				data: JSON.stringify(emailInput.val()),

				success: function (row) {
					$("#adminBudgetCodeNewOwnerEmailSpinner").removeClass("spinner-border");
					$("#adminBudgetCodeNewOwnerEmailSpinner").removeClass("spinner-border-sm");
					response.html("<strong>" + row.firstName + " " + row.lastName + "</strong>\n" + row.email);
					$("#adminBudgetCodeNewOwnerID").html(row.userId);

				},

				error: function () {
					$("#adminBudgetCodeNewOwnerEmailSpinner").removeClass("spinner-border");
					$("#adminBudgetCodeNewOwnerEmailSpinner").removeClass("spinner-border-sm");
				}
			});

		} else {
			response.text("Not Found! - Existing User Email Required");
			emailInput.removeClass("is-valid");
			emailInput.addClass("is-invalid");
			response.removeClass("valid-feedback");
			response.addClass("invalid-feedback");
		}
	});

	$("#adminBudgetCodeNewOfficerEmail").on("input", function () {
		let response = $("#adminBudgetCodeNewOfficerEmailResponse");
		let emailInput = $("#adminBudgetCodeNewOfficerEmail");

		// Make all emails lowercase for comparison
		let lEmail = adminOfficerEmails.map(function (elem) { return elem.toLowerCase(); });

		if ((lEmail.includes(emailInput.val().toLowerCase()))) {
			response.text("Loading info...");
			emailInput.addClass("is-valid");
			emailInput.removeClass("is-invalid");
			response.removeClass("invalid-feedback");
			response.addClass("valid-feedback");

			$("#adminBudgetCodeNewOfficerID").html("");
			$("#adminBudgetCodeNewOfficerEmailSpinner").addClass("spinner-border");
			$("#adminBudgetCodeNewOfficerEmailSpinner").addClass("spinner-border-sm");

			$.ajax({
				type: "POST",
				url: "api/user/getUserFromEmail.php",
				contentType: "application/json",
				data: JSON.stringify(emailInput.val()),

				success: function (row) {
					$("#adminBudgetCodeNewOfficerEmailSpinner").removeClass("spinner-border");
					$("#adminBudgetCodeNewOfficerEmailSpinner").removeClass("spinner-border-sm");
					response.html("<strong>" + row.firstName + " " + row.lastName + "</strong>\n" + row.email);
					$("#adminBudgetCodeNewOfficerID").html(row.userId);
				},

				error: function () {
					$("#adminBudgetCodeNewOfficerEmailSpinner").removeClass("spinner-border");
					$("#adminBudgetCodeNewOfficerEmailSpinner").removeClass("spinner-border-sm");
				}
			});

		} else {
			response.text("Not Found! - Existing User Email Required");
			emailInput.removeClass("is-valid");
			emailInput.addClass("is-invalid");
			response.removeClass("valid-feedback");
			response.addClass("invalid-feedback");
		}
	});

	$("#adminFormBudgetCodeEdit").submit(function () {
		// Validation
		if (!$("#adminBudgetCodeEditOwnerEmail").hasClass("is-valid")) {
			return false;
		}

		if (!$("#adminBudgetCodeEditOfficerEmail").hasClass("is-valid")) {
			return false;
		}

		let data = {
			budgetCode: adminSelectedBudgetCodeRow.children("td")[0].textContent,
			newBudgetCode: $("#adminBudgetCodeEditID").val(),
			ownerId: $("#adminBudgetCodeEditOwnerID").html(),
			procurementOfficer: $("#adminBudgetCodeEditOfficerID").html(),
		};

		$.ajax({
			type: "POST",
			url: "api/budgetCode/editBudgetCode.php",
			contentType: "application/json",
			data: JSON.stringify(data) //serializes all the form data to be sent as a post
		})
			.done(function (response) { //successful function
				if (response === true) {
					adminBudgetCodeAlert("<strong>Budget Code Created!</strong> Created a edit budget code successfully", "success");
					window.document.getElementById("adminFormBudgetCodeEdit").reset();
					adminLoadBudgetCodes();
				} else {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> An error was encountered while trying to create a edit budget code", "danger");
				}
			})
			.fail(function (response) {
				// failure function
				try {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> " + response.responseJSON.message, "danger");
				} catch (TypeError) {
					adminBudgetCodeAlert("<strong>Failed to create budget code!</strong> Unable to send request to server.<br> Response: <strong>" + response.status + "</strong>: '" + response.statusText + "'", "danger");
				}
			});

		// Prevent redirect
		return false;
	});

	$("#adminBudgetCodeEditOwnerEmail").on("input", function () {
		validateEditBudgetCodeOwnerEmail();
	});

	$("#adminBudgetCodeEditOfficerEmail").on("input", function () {
		validateEditBudgetCodeOfficerEmail();
	});

	$.ajax({
		type: "GET",
		url: "api/user/getAllUserEmails.php",
		contentType: "application/json",

		success: function (emails) {
			adminUserEmails = emails;

			// Populate user option list
			let list = $("#userEmails");
			emails.forEach(element => {
				let option = window.document.createElement("option");
				option.value = element;
				list.append(option);
			});
		},
	});

	$.ajax({
		type: "GET",
		url: "api/user/getAllOfficerEmails.php",
		contentType: "application/json",

		success: function (emails) {
			adminOfficerEmails = emails;

			// Populate user option list
			let list = $("#officerEmails");
			emails.forEach(element => {
				let option = window.document.createElement("option");
				option.value = element;
				list.append(option);
			});
		},
	});

	adminLoadUsers();
	adminLoadBudgetCodes();
});
