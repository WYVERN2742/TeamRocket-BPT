/* exported dynamicTable */
/* exported search */
/* exported addLoadEvent */

/**
 * Creates a dynamic table that can be populated in real time
 * @returns Dynamic table
 */
function dynamicTable() {
	let _table;
	// eslint-disable-next-line no-unused-vars
	let _tableId;
	// eslint-disable-next-line no-unused-vars
	let _headers;
	let _fields;
	let _defaultText;

	/**
	 * Builds the row with columns from the specified names.
	 * If the item parameter is specified, the members of the names array will
	 * be used as property names of the item; otherwise they will be directly
	 * parsed as text.
	 */
	function _buildRowColumns(names, item) {
		let row = "<tr>";
		if (names && names.length > 0) {
			$.each(names, function (index, name) {
				let c = item ? item[name + ""] : name;
				switch (c) {
				case "BEFORE_BUDGET_APPROVAL":
					c = "<span class=\"badge badge-primary badge-pill\">Awaiting Budget Code Approval</span>";
					break;
				case "BEFORE_FINANCE_APPROVAL":
					c = "<strong><span class=\"badge badge-info badge-warning\">Awaiting Finance Approval</span></strong>";
					break;
				case "BEFORE_REQ_APPROVAL":
					c = "<strong><span class=\"badge badge-info badge-pill\">Awaiting Requisition Approval</span></strong>";
					break;
				case "DONE":
					c = "<strong><span class=\"badge badge-success badge-pill\">Ordered</span></strong>";
					break;
				case "DENIED":
					c = "<strong><span class=\"badge badge-danger badge-pill\">Denied</span></strong>";
					break;
				}
				row += "<td>" + c + "</td>";
			});
		}
		row += "</tr>";
		return row;
	}

	function _columnCount() {
		let colCount = 0;
		$("tr:nth-child(1) td").each(function () {
			if ($(this).attr("colspan")) {
				colCount += +$(this).attr("colspan");
			} else {
				colCount++;
			}
		});

		return colCount;
	}

	function _setNoItemsInfo() {
		if (_table.length < 1) {
			// not configured.
			return;
		}

		let colspan = "colspan=\"" + _columnCount() + "\"";
		let content = "<tr class=\"no-items\"><td " + colspan + " style=\"text-align:center\">" +
			_defaultText + "</td></tr>";

		if (_table.children("tbody").length > 0) {
			_table.children("tbody").html(content);
		} else {
			_table.append("<tbody>" + content + "</tbody>");
		}
	}

	function _removeNoItemsInfo() {
		let c = _table.children("tbody").children("tr");
		if (c.length === 1 && c.hasClass("no-items")) {
			_table.children("tbody").empty();
		}
	}

	return {
		/** Configures the dynamic table. */
		config: function (tableId, fields, headers, defaultText) {
			_tableId = tableId;
			_table = $("#" + tableId);
			_fields = fields || null;
			_headers = headers || null;
			_defaultText = defaultText || "No items to list...";
			_setNoItemsInfo();
			return this;
		},
		/** Loads the specified data to the table body. */
		load: function (data, append) {
			if (_table.length < 1) {
				return; //not configured.
			}

			_removeNoItemsInfo();

			if (data && data.length > 0) {
				let rows = "";
				$.each(data, function (index, item) {
					rows += _buildRowColumns(_fields, item);
				});
				let mthd = append ? "append" : "html";
				_table.children("tbody")[mthd](rows);
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
}

/**
 * Converts the object into a JSON string.
 * JQuery Extension.
 */
$.fn.serializeObject = function () {
	let o = {};
	let a = this.serializeArray();
	$.each(a, function () {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || "");
		} else {
			o[this.name] = this.value || "";
		}
	});
	return o;
};

/**
 * Search a table by hiding all the values that do not match the entered string.
 * @example $("#search").on("keyup", function (){search("requests_table")});
 * @param {string} tableID Table ID
 */
function search(tableID, value) {
	$("table#" + tableID + " tbody tr").each(function () {
		// Loop each row in table

		let row = $(this);
		let showRow = false;

		row.find("td").each(function () {
			// Loop each column
			if (!showRow) {
				showRow = $(this).text().toLowerCase().includes(value.toLowerCase());
			}
		});

		// Show row if matched, otherwise hide
		if (showRow) {
			row.show();
		} else {
			row.hide();
		}
	});
}

/**
 * Calls the provided function after the window has finished loading.
 * This function stacks callers, so multiple functions will be called
 * after the window has finished loading, rather than overwriting the previous
 * calling function.
 * @param {function} func Function to call after window loads
 */
function addLoadEvent(func) {
	var oldOnLoad = window.onload;
	if (typeof window.onload !== "function") {
		window.onload = func;
	} else {
		window.onload = function() {
			if (oldOnLoad) {
				oldOnLoad();
			}
			func();
		};
	}
}
