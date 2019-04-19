// Requires jquery
// Requires ../search.js
// Requires ../dynamicTable.js

// Populate admin users table
$.ajax({
	type: "GET",
	url: "api/user_management/users.php",
	contentType: "application/json",

	success: function (rows) {
		const numRows = rows.length;

		var count = 0;
		const dt = dynamicTable().config('adminTableUsers',
			['userId', 'firstName', 'lastName', 'role', 'email'], null, 'No users');

		for (var i = 0; i < numRows; i++) {
			// Add all rows to table
			dt.load([rows[count++]], true);
		}
	},

	error: function (xhr, resp, text) {
		console.log(text);
	}
});

// Link search to admin table
$("#adminSearchUser").on("keyup", function () { search("adminTableUsers", $("#adminSearchUser").val()) });
