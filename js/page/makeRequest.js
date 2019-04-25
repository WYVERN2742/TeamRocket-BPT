let supplierID;

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
addLoadEvent(function () {

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
				url: "api/budgetCode/getBudgetCodeOwner.php",
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
				url: "api/supplier/getSupplier.php",
				contentType: "application/json",
				data: JSON.stringify(inputS.val()),

				success: function (row) {
					window.console.log(row);
					$("#supplierSpinner").removeClass("spinner-border");
					$("#supplierSpinner").removeClass("spinner-border-sm");

					$("#inputSupplierName").text(row.name);
					$("#inputSupplierAddress1").text(row.addressLine1);
					$("#inputSupplierAddress2").text(row.addressLine2);
					$("#inputSupplierAddressPostcode").text(row.postcode);
					$("#inputSupplierAddressCity").text(row.city);
					supplierID = row.supplierId;
				},

				error: function (xhr, resp, text) {
					$("#supplierSpinner").removeClass("spinner-border");
					$("#supplierSpinner").removeClass("spinner-border-sm");

					window.console.log(text);
				}
			});
		} else {
			response.text("Not Found! - Pre-approved Supplier Required");
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
		url: "api/supplier/getSupplierList.php",
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
		url: "api/budgetCode/getBudgetCodeList.php",
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

	$("#buttonSubmit").on("click", function() {
		if ($(".is-invalid").length > 0) {
			return;
		}

		if (typeof supplierID === "undefined") {
			// State should technically be impossible
			// Invalidate entered supplier incase
			$("#inputSupplier").addClass("is-invalid");
			return;
		}

		let request = {budgetCode:$("#inputBudgetCode").val(),
			supplier:supplierID,
			draft:false,
			recurring:window.document.getElementById("inputRecurring").checked,
			items:[]
		};

		let table = window.document.getElementById("tableItems");

		// eslint-disable-next-line no-cond-assign

		for (var i = 1; table.rows[i]; i++) {
			// We need to check if all the rows in the table contain values

			let id = request.items.length + 1;
			let description = $("#inputItem"+i+"Description");
			let cost = $("#inputItem"+i+"Cost");
			let quantity = $("#inputItem"+i+"Quantity");

			let state = 0;

			if (description.val() === "") {
				state++;
			}

			if (cost.val() === "") {
				state++;
			}

			if (quantity.val() === "") {
				state++;
			}

			if (state === 3) {
				// Ignore the row as it's empty
				continue;

			} else if (state !== 0) {
				// One or more columns are empty

				if (description.val() === "") {
					description.addClass("is-invalid");
					description.on("input", function(){
						$(this).removeClass("is-invalid");
					});
				}

				if (cost.val() === "") {
					cost.addClass("is-invalid");
					cost.on("input", function(){
						$(this).removeClass("is-invalid");
					});
				}

				if (quantity.val() === "") {
					quantity.addClass("is-invalid");
					quantity.on("input", function(){
						$(this).removeClass("is-invalid");
					});
				}

				// Stop creating the response, as we know at least
				// one row is invalid
				return;
			}

			let item = {
				itemNumber:id,
				name:description.val(),
				price:cost.val(),
				quantity:quantity.val()
			};

			request.items.push(item);
		}

		if (request.items.length === 0) {
			// Mark first row as invalid when table is empty
			$("#inputItem1Description").addClass("is-invalid");
			$("#inputItem1Description").on("input", function(){
				$(this).removeClass("is-invalid");
			});

			$("#inputItem1Cost").addClass("is-invalid");
			$("#inputItem1Cost").on("input", function(){
				$(this).removeClass("is-invalid");
			});

			$("#inputItem1Quantity").addClass("is-invalid");
			$("#inputItem1Quantity").on("input", function(){
				$(this).removeClass("is-invalid");
			});
			return;
		}

		window.console.log(JSON.stringify(request));

		$.ajax({
			type: "POST",
			url: "api/request/submitRequest.php",
			contentType: "application/json",
			data: JSON.stringify(request),

			success: function () {
				window.console.log("success");
				window.location.href = "index.php";
			},
			error: function (resp) {
				window.console.log(resp);
			}
		});
	});


});
