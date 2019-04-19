/**
 * Search a table by hiding all the values that do not match the entered string.
 * @example $("#search").on("keyup", function (){search("requests_table")});
 * @param {string} tableID Table ID
 */
function search(tableID, value) {
	$("table#" + tableID + " tbody tr").each(function (index) {
		// Loop each row in table

		$row = $(this);
		let showRow = false;

		$row.find('td').each(function () {
			// Loop each column
			if (!showRow) {
				showRow = $(this).text().toLowerCase().includes(value.toLowerCase());
			}
		});

		// Show row if matched, otherwise hide
		showRow ? $row.show() : $row.hide();
	});
}
