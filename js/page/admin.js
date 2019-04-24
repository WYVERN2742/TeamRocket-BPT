let adminSelectedRow;

/**
 * Populate the admin user table.
 * Also creates and binds events the rows.
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
				adminSelectedRow = $(this);
				let cols = adminSelectedRow.children("td");
				// Switch colours
				adminSelectedRow.addClass("bg-info").siblings().removeClass("bg-info");

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

						adminEnableEdit();

						$("#adminUserDeleteAlertInfo").html("Selected user: <strong>" + user.firstName + " " + user.lastName +
						"</strong> <br> <italic> " + user.email + "</italic> ("+user.telephoneNo+")");
						resetDeleteState();

					},

					error: function (xhr, resp, text) {
						adminUserAlert("<strong> Failed to load user</strong> Response was '" + text + "'","danger");
						$("#budgetCodeSpinner").removeClass("spinner-border");
						$("#budgetCodeSpinner").removeClass("spinner-border-sm");
						resetDeleteState();
					}
				});

			}));
		},

		error: function (xhr, resp, text) {
			window.console.log(text);
		}
	});
}

/**
 * Resets the checkbox and button state of the delete confirmation
 * dialogue.
 */
function resetDeleteState() {
	window.document.getElementById("adminUserDeleteCheckbox").checked = false;
	window.document.getElementById("adminUserDeleteButton").disabled = true;
}

/**
 * Enable the user editing form.
 */
function adminDisableEdit() {
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
	resetDeleteState();

}

/**
 * Disable the user editing form.
 */
function adminEnableEdit() {
	window.document.getElementById("adminUserEditFirstName").disabled = false;
	window.document.getElementById("adminUserEditLastName").disabled = false;
	window.document.getElementById("adminUserEditRoomNumber").disabled = false;
	window.document.getElementById("adminUserEditEmail").disabled = false;
	window.document.getElementById("adminUserEditTelephone").disabled = false;
	window.document.getElementById("adminUserEditRole").disabled = false;
	window.document.getElementById("adminUserEditPassword").disabled = false;
	window.document.getElementById("adminUserEditSubmit").disabled = false;
	window.document.getElementById("adminUserEditFirstName").disabled = false;
	window.document.getElementById("adminUserEditClear").disabled = false;

	// Enable delete checkbox
	window.document.getElementById("adminUserDeleteCheckbox").disabled = false;
	resetDeleteState();
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

	$("#adminUserAlerts").append("<div class=\"alert alert-"+type+" alert-dismissible fade show\" role=\"alert\">" +
	message +
	"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
	"<span aria-hidden=\"true\">&times;</span></button></div>");
}

// Postpone javascript execution until window is loaded
addLoadEvent(function () {
	// Link search to admin table
	$("#adminSearchUser").on("keyup", function () {
		search("adminTableUsers", $("#adminSearchUser").val());
	});

	$("#adminUserEditClear").on("click", function() {
		// Reset edit window
		window.document.getElementById("adminFormUserEdit").reset();
		adminDisableEdit();
		$("#adminTableUsers tbody tr").removeClass("bg-info");

		// Reset delete window
		$("#adminUserDeleteAlertInfo").html("Please select a user from the table above");

		resetDeleteState();
		window.document.getElementById("adminUserDeleteCheckbox").disabled = true;
	});

	$("#adminUserDeleteCheckbox").on("click", function() {
		window.document.getElementById("adminUserDeleteButton").disabled = !window.document.getElementById("adminUserDeleteCheckbox").checked;
	});

	$("#adminUserDeleteButton").on("click", function () {
		resetDeleteState();
		if (adminSelectedRow === undefined) {
			// Somehow a row isn't selected?
			adminDisableEdit();
			adminUserAlert("<strong>Broken state</strong> No User selected for deletion");
			return;
		}

		$.ajax({
			type: "POST",
			url: "api/user/deleteUser.php", //php to post to
			data: adminSelectedRow.children("td")[0].textContent
		})
			.done(function (response) { //successful function
				window.console.log(response);
				if (response === true) {
					adminUserAlert("<strong>User Deleted!</strong> Deleted user successfully","success");
					adminLoadUsers();
					window.document.getElementById("adminUserDeleteForm").reset();
					adminDisableEdit();
				} else {
					adminUserAlert("<strong>Failed to delete user!</strong> An error was encountered while trying to delete the user","danger");
				}
			})
			.fail(function (response) {
				window.console.log(response);
				if (response.responseJSON.message) {
					adminUserAlert("<strong>Failed to delete user!</strong> " + response.responseJSON.message,"danger");
				} else {
					adminUserAlert("<strong>Failed to delete user!</strong> Unable to send request to server.<br> Response:'"+response.statusText+"'","danger");
				}
			});

		// to prevent refreshing the whole page page
		return false;

	});

	// Fix unreported bootstrap text color issue on modals
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

	// document.getElementById(adminLinkBudgetCodeCreate) = function(){ }
	// document.getElementById(adminLinkBudgetCodeEdit) = function(){ }
	// document.getElementById(adminLinkBudgetCodeDelete) = function(){ }

	adminLoadUsers();

	$("#adminFormUserNew").submit(function () {

		$.ajax({
			type: "POST",
			url: "api/user/newUser.php", //php to post to
			data: $(this).serializeObject() //serializes all the form data to be sent as a post
		})
			.done(function (response) { //successful function
				window.console.log(response);
				if (response === true) {
					adminUserAlert("<strong>User Created!</strong> Created a new user successfully","success");
					window.document.getElementById("adminFormUserNew").reset();
					adminLoadUsers();
				} else {
					adminUserAlert("<strong>Failed to create user!</strong> An error was encountered while trying to create a new user","danger");
				}
			})
			.fail(function (response) {
				//failure function
				adminUserAlert("<strong> Failed to create user</strong> Unable to send request to server.<br> Response:'"+response+"'","danger");
			});

		// to prevent refreshing the whole page page
		return false;

	});
});
