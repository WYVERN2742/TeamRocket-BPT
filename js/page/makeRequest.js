/**
 * Update the total cost of the request
 * Will break of there are an unbalanced amount of `cost` and `quantity`
 * classes within the document.
 */
function updateTotal() {
	let costs = window.document.getElementsByClassName("cost");
	let quantities = window.document.getElementsByClassName("quantity");

	// Ensure balanced costs and quantity
	if (costs.length !== quantities.length) {
		window.console.log("Unbalanced cost and quantity values");
		return;
	}

	let total = 0;

	for (let index = 0; index < costs.length; index++) {
		let cost = costs[index].value;
		let quantity = quantities[index].value;
		let add = (cost * quantity);

		if (isNaN(add)) {
			return;
		}

		total += add;
	}

	$("#labelCost").text(total.toFixed(2));
}

/**
 * Ensures the caller has a valid number greater than 0.
 * if not, adds the is-Invalid class.
 */
function verifyNumericEvent() {
	let elm = $(this);
	if (elm === undefined) {
		window.document.console.log("verifyNumericEvent Not called from jquery event");
		return;
	}

	if (elm.val() === undefined) {
		// If value is empty, don"t mark as invalid
		elm.removeClass("is-invalid");
		return;
	}

	if ((parseFloat(elm.val()) > 0)) {
		elm.removeClass("is-invalid");
	} else {
		elm.addClass("is-invalid");
	}
}

/**
 * Extends the `tableItems` table by one row.
 * This is done by removing the `input` event from the `lastRow` class,
 * then removing the class from the elements in the last row of the table.
 * The table is then extended with elements that contain the `lastRow` class
 * and then the event is reapplied to the `lastRow` class.
 */
function extendItemTable() {
	// Remove event listener
	$(".lastRow").off("input", extendItemTable);

	// Remove class
	$(".lastRow").removeClass("lastRow");

	// Add row to table
	let nid = $("#tableItems").find("tr").length;

	$("#tableItems tr:last").after("<tr><td scope=\"row\">" + nid +
		"</td><td><input type=\"text\" class=\"form-control\" name=\"inputItem" + nid +
		"Description\" id=\"inputItem" + nid +
		"Description\"></td><td><input type=\"number\" class=\"form-control quantity\" name=\"inputItem" + nid +
		"Quantity\" id=\"inputItem" + nid + "Quantity\"></td><td><div class=\"input-group\">" +
		"<div class=\"input-group-prepend\"><span class=\"input-group-text\">£</span></div>" +
		"<input type=\"text\" class=\"form-control cost\" name=\"inputItem" + nid +
		"Cost\" id=\"inputItem" + nid + "Cost\"></div></td></tr>");

	// Add class
	$("#tableItems tr:last").addClass("lastRow");

	// Add event listeners
	$(".lastRow").on("input", extendItemTable);

	// Add misc events
	$(".cost").on("input", updateTotal);
	$(".cost").on("input", verifyNumericEvent);
	$(".quantity").on("input", updateTotal);
	$(".quantity").on("input", verifyNumericEvent);

}

// Postpone javascript execution until window is loaded
window.onload = function () {

	const inputBC = $("#inputBudgetCode");
	const inputS = $("#inputSupplier");

	let suppliers = [];
	let budgetCodes = [];

	inputBC.on("input", (function () {

		const response = $("#budget_code_response");

		// Convert all names to lowercase
		let lids = budgetCodes.map(function (elem) { return elem.toLowerCase(); });

		if ((lids.includes(inputBC.val().toLowerCase()))) {
			inputBC.val(budgetCodes[lids.indexOf(inputBC.val().toLowerCase())].toUpperCase());
			response.text("Found");
			inputBC.removeClass("form-control is-invalid");
			inputBC.addClass("form-control is-valid");
			response.removeClass("invalid-feedback");
			response.addClass("valid-feedback");

			$("#budgetCodeSpinner").addClass("spinner-border");
			$("#budgetCodeSpinner").addClass("spinner-border-sm");

			$.ajax({
				type: "POST",
				url: "api/budget_code.php",
				contentType: "application/json",
				data: JSON.stringify(inputBC.val()),

				success: function (row) {

					$("#budgetCodeSpinner").removeClass("spinner-border");
					$("#budgetCodeSpinner").removeClass("spinner-border-sm");

					$("#budgetCodeName").text(row.firstName + " " + row.lastName);
					$("#budgetCodeRoom").text(row.roomNo);
					$("#budgetCodeNum").text(row.telephoneNo);
					$("#budgetCodeEmail").text(row.email);
				},

				error: function (xhr, resp, text) {
					window.console.log(text);
					$("#budgetCodeSpinner").removeClass("spinner-border");
					$("#budgetCodeSpinner").removeClass("spinner-border-sm");
				}
			});

		} else {
			response.text("Not Found! - Valid Budget Code Required");
			inputBC.removeClass("form-control is-valid");
			inputBC.addClass("form-control is-invalid");
			response.removeClass("valid-feedback");
			response.addClass("invalid-feedback");

			$("#budgetCodeName").val("<br>");
			$("#budgetCodeRoom").val("<br>");
			$("#budgetCodeNum").val("<br>");
			$("#budgetCodeEmail").val("<br>");
		}
	}));

	inputS.on("input", (function () {
		let response = $("#supplier_response");

		// Convert all names to lowercase for comparison
		let lsups = suppliers.map(function (elem) { return elem.toLowerCase();});

		if ((lsups.includes(inputS.val().toLowerCase()))) {
			inputS.val(suppliers[lsups.indexOf(inputS.val().toLowerCase())]);
			response.text("Found");
			inputS.removeClass("form-control is-invalid");
			inputS.addClass("form-control is-valid");
			response.removeClass("invalid-feedback");
			response.addClass("valid-feedback");

			$("#supplierSpinner").addClass("spinner-border");
			$("#supplierSpinner").addClass("spinner-border-sm");

			$.ajax({
				type: "POST",
				url: "api/supplier.php",
				contentType: "application/json",
				data: JSON.stringify(inputS.val()),

				success: function (row) {
					$("#supplierSpinner").removeClass("spinner-border");
					$("#supplierSpinner").removeClass("spinner-border-sm");

					$("#inputSupplierName").val(row.name);
					$("#inputSupplierAddress1").val(row.addressLine1);
					$("#inputSupplierAddress2").val(row.addressLine2);
					$("#inputSupplierAddressPostcode").val(row.postcode);
					$("#inputSupplierAddressCity").val(row.city);
				},

				error: function (xhr, resp, text) {
					$("#supplierSpinner").removeClass("spinner-border");
					$("#supplierSpinner").removeClass("spinner-border-sm");

					window.console.log(text);
				}
			});
		} else {
			response.text("Not Found! - Cannot Autofill Entries");
			inputS.removeClass("form-control is-valid");
			inputS.addClass("form-control is-invalid");
			response.removeClass("valid-feedback");
			response.addClass("invalid-feedback");

			// ! Don"t clear text boxes, otherwise you cannot create a custom supplier
		}
	}));

	$(".cost").on("input", updateTotal);
	$(".cost").on("input", verifyNumericEvent);

	$(".quantity").on("input", updateTotal);
	$(".quantity").on("input", verifyNumericEvent);

	extendItemTable();
	updateTotal();

	$.ajax({
		type: "GET",
		url: "api/suppliers.php",
		contentType: "application/json",

		success: function (names) {
			suppliers = names;
			// Remove supplier spinner
			$("#supplierIDSpinner").remove();

			// Populate suppliers option list
			let list = $("#listSuppliers");
			names.forEach(element => {
				let option = window.document.createElement("option");
				option.value = element;
				list.append(option);
			});
		},
	});

	$.ajax({
		type: "GET",
		url: "api/budget_codes.php",
		contentType: "application/json",

		success: function (ids) {
			budgetCodes = ids;
			$("#budgetCodeIDSpinner").remove();

			// Populate budget code option list
			let list = $("#listBudgetCodes");
			ids.forEach(element => {
				let option = window.document.createElement("option");
				option.value = element;
				list.append(option);
			});
		},
	});
};
