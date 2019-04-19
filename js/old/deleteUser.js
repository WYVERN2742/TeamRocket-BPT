//* https://codepedia.info/jquery-get-table-cell-td-value-div/
$(document).ready(function () {

	// code to read selected table row cell data (values).
	$("#requests_table").on('click', '.userDelete', function () {
		// get the current row
		var currentRow = $(this).closest("tr");

		var col1 = currentRow.find("td:eq(0)").text(); //retrieves userId from table row

		if (confirm("Are you sure you would like to delete this user?")) {
			$.ajax({
				type: 'POST',
				url: 'api/user_management/delete_user.php', //post to php delete script
				data: { userId: col1 } //submits col1 as userId
			})
				.done(function (data) { //successful function
					$('#response').html("successful: " + data);
					alert("Successfully deleted");
				})
				.fail(function (data) { //failure function
					//still need to add functionality for when a user tries to delete a user who is in charge of a budget code. This threw an error.
					$('#response').html("successful: " + data);

				});
		}

		var data = col1

		console.log(data);
		// to prevent refreshing the whole page page
		return false;
	});
});
//*
