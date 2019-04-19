$.ajax({
	type: "GET",
	url: "api/procurement/requests.php",
	contentType: 'application/json',

	success: function (rows) {
		const numRows = rows.length;

		const viewMore = $("#viewInput");
		let count = 0;
		const dt = dynamicTable().config('tableRequests',
			['procurementId', 'budgetCode', 'requesterId', 'status'], null, 'No requests');

		for (let i = 0; i < 5; i++) {
			dt.load([rows[count++]], true);
		}

		viewMore.click(function () {
			for (let i = 0; i < 5; i++) {
				if (count < numRows) {
					dt.load([rows[count++]], true);
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
		console.log(text);
	}
});

$("#searchTableRequests").on("keyup", function () { search("tableRequests", $("#searchTableRequests").val()) });
