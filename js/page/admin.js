
// Postpone javascript execution until window is loaded
window.onload = function () {

	// Link search to admin table
	$("#adminSearchUser").on("keyup", function () {
		search("adminTableUsers", $("#adminSearchUser").val());
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
};
