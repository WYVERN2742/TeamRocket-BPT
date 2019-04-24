// Postpone javascript execution until window is loaded
addLoadEvent(function () {

	// Link Search box to search function
	$("#searchTableRequests").on("keyup", function () { search("tableRequests", $("#searchTableRequests").val()); });

	// Load Budget Code Information
	$.ajax({
		type: "GET",
		url: "api/request/getUserRequests.php",
		contentType: "application/json",

		success: function (rows) {
			const numRows = rows.length;
			let showAmount = 5;

			const viewMore = $("#viewInput");
			let count = 0;
			const dt = dynamicTable().config("tableRequests",
				["procurementId", "budgetCode", "requesterId", "status"], null, "No requests");

			if (numRows < 5) {
				showAmount = numRows;
			}

			for (let i = 0; i < showAmount; i++) {
				dt.load([rows[count++]], true);
			}

			viewMore.click(function () {
				for (let i = 0; i < 5; i++) {
					if (count < numRows) {
						dt.load([rows[count++]], true);
						viewMore.html("View More (" + count + "/" + numRows + ")");
					} else {
						viewMore.remove();
						break;
					}
				}

				search("tableRequests");
			});

			viewMore.html("View More (" + count + "/" + numRows + ")");
		},

		error: function (xhr, resp, text) {
			window.console.log(text);
		}
	});

});
