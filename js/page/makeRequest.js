const inputBC = $('#inputBudgetCode');
const inputS = $('#inputSupplier');

var suppliers = []
var budgetCodes = []

$.ajax({
	type: "GET",
	url: "api/suppliers.php",
	contentType: 'application/json',

	success: function (names) {
		suppliers = names;
		$("#supplierIDSpinner").remove();
	},

	error: function (xhr, resp, text) {
	}
});

$.ajax({
	type: "GET",
	url: "api/budget_codes.php",
	contentType: 'application/json',

	success: function (ids) {
		budgetCodes = ids;
		$("#budgetCodeIDSpinner").remove();
	},

	error: function (xhr, resp, text) {
	}
});

inputBC.keyup(function () {

	const response = $('#budget_code_response');

	// Convert all names to lowercase
	let lids = budgetCodes.map(function (elem) { return elem.toLowerCase()});

	if ((lids.includes(inputBC.val().toLowerCase()))) {
		inputBC.val(budgetCodes[lids.indexOf(inputBC.val().toLowerCase())].toUpperCase())
		response.text("Found");
		inputBC.removeClass("form-control is-invalid");
		inputBC.addClass("form-control is-valid");
		response.removeClass("invalid-feedback");
		response.addClass("valid-feedback");

		$("#budgetCodeSpinner").addClass("spinner-border")
		$("#budgetCodeSpinner").addClass("spinner-border-sm")

		$.ajax({
			type: "POST",
			url: "api/budget_code.php",
			contentType: 'application/json',
			data: JSON.stringify(inputBC.val()),

			success: function (row) {

				$("#budgetCodeSpinner").removeClass("spinner-border")
				$("#budgetCodeSpinner").removeClass("spinner-border-sm")

				$('#budgetCodeName').text(row.firstName + " " + row.lastName);
				$('#budgetCodeRoom').text(row.roomNo);
				$('#budgetCodeNum').text(row.telephoneNo);
				$('#budgetCodeEmail').text(row.email);
			},

			error: function (xhr, resp, text) {
				console.log(text);
				$("#budgetCodeSpinner").removeClass("spinner-border")
				$("#budgetCodeSpinner").removeClass("spinner-border-sm")
			}
		});

	} else {
		response.text("Not Found!");
		inputBC.removeClass("form-control is-valid");
		inputBC.addClass("form-control is-invalid");
		response.removeClass("valid-feedback");
		response.addClass("invalid-feedback");

		$('#budgetCodeName').text("Unknown");
		$('#budgetCodeRoom').text("Unknown");
		$('#budgetCodeNum').text("Unknown");
		$('#budgetCodeEmail').text("Unknown");
	}
});

inputS.keyup(function () {
	response = $("#supplier_response")

	// Convert all names to lowercase for comparison
	let lsups = suppliers.map(function (elem) { return elem.toLowerCase()});

	if ((lsups.includes(inputS.val().toLowerCase()))) {
		inputS.val(suppliers[lsups.indexOf(inputS.val().toLowerCase())]);
		response.text("Found");
		inputS.removeClass("form-control is-invalid");
		inputS.addClass("form-control is-valid");
		response.removeClass("invalid-feedback");
		response.addClass("valid-feedback");

		$("#supplierSpinner").addClass("spinner-border")
		$("#supplierSpinner").addClass("spinner-border-sm")

		$.ajax({
			type: "POST",
			url: "api/supplier.php",
			contentType: 'application/json',
			data: JSON.stringify(inputS.val()),

			success: function (row) {
				$("#supplierSpinner").removeClass("spinner-border")
				$("#supplierSpinner").removeClass("spinner-border-sm")

				$('#inputSupplierName').val(row.name);
				$('#inputSupplierAddress1').val(row.addressLine1);
				$('#inputSupplierAddress2').val(row.addressLine2);
				$('#inputSupplierAddressPostcode').val(row.postcode);
				$('#inputSupplierAddressCity').val(row.city);
			},

			error: function (xhr, resp, text) {
				$("#supplierSpinner").removeClass("spinner-border")
				$("#supplierSpinner").removeClass("spinner-border-sm")

				console.log(text);
			}
		});
	} else {
		response.text("Not Found!");
		inputS.removeClass("form-control is-valid");
		inputS.addClass("form-control is-invalid");
		response.removeClass("valid-feedback");
		response.addClass("invalid-feedback");

		// ! Don't clear text boxes, otherwise you cannot create a custom supplier
	}
});
