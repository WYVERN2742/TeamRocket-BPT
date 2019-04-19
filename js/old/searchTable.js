function search(tableID) {
	var value = $("#search").val();

	$("table#" + tableID + " tbody tr").each(function (index) {
		$row = $(this);
		let showRow = false;

		$row.find('td').each(function () {
			showRow = $(this).text().includes(value);
		});

		if (showRow) {
			$row.show();
		} else {
			$row.hide();
		}
	});
}

$("#search").on("keyup", function () {
	search("requests_table");
});
