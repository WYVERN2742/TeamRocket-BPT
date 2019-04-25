
let requestID = JSON.stringify("1");

$.ajax({
	type: "POST",
	url: "api/request/getRequestInfo.php",
	contentType: "application/json",
	data: requestID,

	success: function (data) {
		window.console.log(data);

		$("#supplierName").html(data.supplier.name);
		$("#supplierAddress1").html(data.supplier.addressLine1);
		$("#supplierAddress2").html(data.supplier.addressLine2);
		$("#supplierAddressPostcode").html(data.supplier.postcode);
		$("#supplierAddressCity").html(data.supplier.city);
		$("#requestHeader").html("Request #" + data.procurementInfo.procurementId);

		$("#supplierName").html("<strong>" + data.supplier.name + "</strong>");
		$("#supplierAddress1").html(data.supplier.addressLine1);
		$("#supplierAddress2").html(data.supplier.addressLine2);
		$("#supplierAddressPostcode").html(data.supplier.postcode);
		$("#supplierAddressCity").html(data.supplier.city);

		$("#budgetCode").html("<strong>" + data.procurementInfo.budgetCode + "</strong>");

		// Load budget code owner info
		$.ajax({
			type: "POST",
			url: "api/budgetCode/getBudgetCodeOwner.php",
			contentType: "application/json",
			data: JSON.stringify(data.procurementInfo.budgetCode),

			success: function (data) {
				if (data == "false") {
					$("#budgetCodeName").html("Unknown Owner");
				}
				window.console.log(data);
				$("#budgetCodeName").html(data.firstName + " " + data.lastName);
				$("#budgetCodeRoom").html(data.roomNo);
				$("#budgetCodeNum").html(data.telephoneNo);
				$("#budgetCodeEmail").html(data.email);
			}

		});

		let total = 0.00;
		window.console.log("before");
		data.items.forEach(element => {
			window.console.log("during");
			let sub = element.quantity * element.price;
			total += sub;
			$("#requestModalTable tr:last").after("<tr>" +
				"<td> " + element.itemNumber + " </td>" +
				"<td> " + element.name + " </td>" +
				"<td> " + element.quantity + " </td>" +
				"<td> " + element.price + " </td>" +
				"<td> £" + sub + " </td>" +
				"</tr>");

		});

		$("#labelAmount").html("(" + data.items.length + " item" + (data.items.length === 1 ? "" : "s") + ")");
		$("#labelCost").html("£" + total);

		let recurring = data.procurementInfo.recurring === "1";

		window.document.getElementById("inputRecurring").checked = recurring;

		// Show Modal To User
		$("#requestModal").modal();

	},

	error: function (xhr, resp, text) {
		window.console.log(text);
		// $("#budgetCodeSpinner").removeClass("spinner-border");
		// $("#budgetCodeSpinner").removeClass("spinner-border-sm");
	}
});
