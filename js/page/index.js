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
			let showAmount = 15;

			const viewMore = $("#viewInput");
			let count = 0;
			const dt = dynamicTable().config("tableRequests",
				["procurementId", "budgetCode", "date", "requesterEmail", "status"], null, "No requests");

			if (numRows < showAmount) {
				showAmount = numRows;
			}

			for (let i = 0; i < showAmount; i++) {
				dt.load([rows[count++]], true);
			}

			viewMore.click(function () {
				for (let i = 0; i < showAmount; i++) {
					if (count < numRows) {
						dt.load([rows[count++]], true);
						viewMore.html("View More (" + count + "/" + numRows + ")");
						search("tableRequests", $("#searchTableRequests").val());
					} else {
						viewMore.remove();
						search("tableRequests", $("#searchTableRequests").val());
						break;
					}
				}

				search("tableRequests");
			});
			$("#draftSpinner").removeClass("spinner-border");
			$("#draftSpinner").text("No Saved Drafts");
			viewMore.html("View More (" + count + "/" + numRows + ")");
		},

		error: function (xhr, resp, text) {
			window.console.log(text);
		}
	});

});
