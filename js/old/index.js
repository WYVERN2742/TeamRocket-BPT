var dynamicTable = (function () {

	var _tableId, _table,
		_fields, _headers,
		_defaultText;

	/** Builds the row with columns from the specified names.
	 *  If the item parameter is specified, the members of the names array will be used as property names of the item; otherwise they will be directly parsed as text.
	 */
	function _buildRowColumns(names, item) {
		var row = '<tr>';
		if (names && names.length > 0) {
			$.each(names, function (index, name) {
				var c = item ? item[name + ''] : name;
				switch (c) {
					case "BEFORE_BUDGET_APPROVAL":
						c = '<span class="badge badge-primary badge-pill">Awaiting Budget Code Approval</span>';
						break;
					case "BEFORE_FINANCE_APPROVAL":
						c = '<strong><span class="badge badge-info badge-warning">Awaiting Finance Approval</span></strong>';
						break;
					case "BEFORE_REQ_APPROVAL":
						c = '<strong><span class="badge badge-info badge-pill">Awaiting Requisition Approval</span></strong>';
						break;
					case "DONE":
						c = '<strong><span class="badge badge-success badge-pill">Ordered</span></strong>';
						break;
					case "DENIED":
						c = '<strong><span class="badge badge-danger badge-pill">Denied</span></strong>';
						break;
				}
				row += '<td>' + c + '</td>';
			});
		}
		row += '</tr>';
		return row;
	}

	function _columnCount() {
		var colCount = 0;
		$('tr:nth-child(1) td').each(function () {
			if ($(this).attr('colspan')) {
				colCount += +$(this).attr('colspan');
			} else {
				colCount++;
			}
		});

		return colCount;
	}

	function _setNoItemsInfo() {
		if (_table.length < 1) return; //not configured.
		var colspan = 'colspan="' + _columnCount() + '"';
		var content = '<tr class="no-items"><td ' + colspan + ' style="text-align:center">' +
			_defaultText + '</td></tr>';
		if (_table.children('tbody').length > 0) {
			_table.children('tbody').html(content);
		} else {
			_table.append('<tbody>' + content + '</tbody>');
		}
	}

	function _removeNoItemsInfo() {
		var c = _table.children('tbody').children('tr');
		if (c.length == 1 && c.hasClass('no-items')) _table.children('tbody').empty();
	}

	return {
		/** Configres the dynamic table. */
		config: function (tableId, fields, headers, defaultText) {
			_tableId = tableId;
			_table = $('#' + tableId);
			_fields = fields || null;
			_headers = headers || null;
			_defaultText = defaultText || 'No items to list...';
			_setNoItemsInfo();
			return this;
		},
		/** Loads the specified data to the table body. */
		load: function (data, append) {
			if (_table.length < 1) return; //not configured.
			_removeNoItemsInfo();
			if (data && data.length > 0) {
				var rows = '';
				$.each(data, function (index, item) {
					rows += _buildRowColumns(_fields, item);
				});
				var mthd = append ? 'append' : 'html';
				_table.children('tbody')[mthd](rows);
			} else {
				_setNoItemsInfo();
			}
			return this;
		},
		/** Clears the table body. */
		clear: function () {
			_setNoItemsInfo();
			return this;
		}
	};
}());

function search() {
	var value = $("#search").val();

	$("table#requests_table tbody tr").each(function (index) {
		$row = $(this);
		let showRow = false;

		$row.find('td').each(function () {
			var id = $(this).text();

			if (id.indexOf(value) == 0) {
				showRow = true;
			}
		});

		if (showRow) {
			$row.show();
		} else {
			$row.hide();
		}
	});
}

$.ajax({
	type: "GET",
	url: "api/procurement/requests.php",
	contentType: 'application/json',

	success: function (rows) {
		const numRows = rows.length;
		$('#pending_requests').html(numRows);

		var count = 0;
		const dt = dynamicTable.config('requests_table',
			['procurementId', 'budgetCode', 'requesterId', 'status'], null, 'No requests');

		for (var i = 0; i < 5; i++) {
			dt.load([rows[count++]], true);
		}

		const viewMore = $('#inputViewMore');

		viewMore.click(function () {
			for (var i = 0; i < 5; i++) {
				if (count < numRows) {
					dt.load([rows[count++]], true);
				}
			}

			search();

			$('#inputViewMore').html("View More (" + count + "/" + numRows + ")");

		});

		viewMore.html("View More (" + count + "/" + numRows + ")");
	},

	error: function (xhr, resp, text) {
		console.log(text);
	}
});

$("#search").on("keyup", function () {
	search();
});

/*$(document).on('submit', '#do_logout', function () {
	console.log("logout");
	$.ajax({
		type: "GET",
		url: "api/logout.php",
		success: function() {
			location.href='login.php';
		}
	});

	return false;
});*/
