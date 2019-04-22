function adminLoadUsers() {
	$.ajax({
		// Populate admin users table
		type: "GET",
		url: "api/user_management/users.php",
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
		},

		error: function (xhr, resp, text) {
			window.console.log(text);
		}
	});
}

// Postpone javascript execution until window is loaded
addLoadEvent(function () {
	window.console.log("onload");

	// Link search to admin table
	$("#adminSearchUser").on("keyup", function () {
		search("adminTableUsers", $("#adminSearchUser").val());
	});
	window.console.log("onload");

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
			url: "api/user_management/insert_user.php", //php to post to
			data: $(this).serializeObject() //serializes all the form data to be sent as a post
		})
			.done(function (response) { //successful function
				window.console.log(response);
				if (response === true) {
					$("#adminUserAlerts").append("<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">" +
						"<strong>User Created!</strong> You've managed to create the new user successfully." +
						"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
						"<span aria-hidden=\"true\">&times;</span></button></div>");
					window.document.getElementById("adminFormUserNew").reset();
					adminLoadUsers();
				} else {
					$("#adminUserAlerts ").append("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">" +
						"<strong>Error Creating User!</strong> Not able to create the user." +
						"<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
						"<span aria-hidden=\"true\">&times;</span></button></div>");
				}
			})
			.fail(function (response) { //failure function
				window.console.log(response);
			});

		// to prevent refreshing the whole page page
		return false;

	});
});
