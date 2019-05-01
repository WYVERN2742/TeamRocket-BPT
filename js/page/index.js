// Postpone javascript execution until window is loaded
addLoadEvent(function () {

	// Link Search box to search function
	$("#searchTableRequests").on("keyup", function () { search("tableRequests", $("#searchTableRequests").val()); });

	// Load Budget Code Information
	loadRequests();
	function loadRequests() {
		$.ajax({
			type: "GET",
			url: "api/request/getUserRequests.php",
			contentType: "application/json",

			success: function (rows) {
				const numRows = rows.length;
				$("#pending_requests")[0].innerHTML = numRows;
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
				$("#tableRequests tbody tr").on("click", (function () {
					// Show Modal To User
					$("#requestModal").modal();

					const acceptButton = $("#acceptRequest");
					const denyButton = $("#denyRequest");
					acceptButton.attr("disabled", "true");
					denyButton.attr("disabled", "true");

					$.ajax({
						type: "POST",
						url: "api/request/getRequestInfo.php",
						contentType: "application/json",
						data: JSON.stringify($(this).children("td")[0].textContent),

						success: function (data) {

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
									$("#budgetCodeName").html(data.firstName + " " + data.lastName);
									$("#budgetCodeRoom").html(data.roomNo);
									$("#budgetCodeNum").html(data.telephoneNo);
									$("#budgetCodeEmail").html(data.email);
								}

							});

							$.ajax({
								type: "POST",
								url: "api/user/getUser.php",
								contentType: "application/json",
								data: JSON.stringify(data.procurementInfo.requesterId),

								success: function (data) {
									if (data == "false") {
										$("#requestorName").html("Unknown Requestor");
									}
									window.console.log(data);
									$("#requestorName").html("<strong>" + data.firstName + " " + data.lastName + "</strong>");
									$("#requestorRoom").html(data.roomNo);
									$("#requestorNum").html(data.telephoneNo);
									$("#requestorEmail").html(data.email);
								}

							});

							$.ajax({
								type: "POST",
								url: "api/request/canApprove.php",
								contentType: "application/json",
								data: JSON.stringify({status: data.procurementInfo.status,
									budgetCode: data.procurementInfo.budgetCode}),

								success: function() {
									acceptButton.removeAttr("disabled");
									denyButton.removeAttr("disabled");
								}
							});

							// ACCEPT AND DENY REQUESTS
							acceptButton.off("click");
							acceptButton.on("click", function() {
								window.console.log("clicked");
								window.console.log(data.procurementInfo.procurementId);
								$.ajax({
									type: "POST",
									url: "api/request/updateRequestStatus.php",
									contentType: "application/json",
									data: JSON.stringify({
										procurementId: data.procurementInfo.procurementId,
										status: data.procurementInfo.status
									}),

									success: function () {
										loadRequests();
									}
								});
							});

							denyButton.off("click");
							denyButton.on("click", function () {
								$.ajax({
									type: "POST",
									url: "api/request/updateRequestStatus.php",
									contentType: "application/json",
									data: JSON.stringify({
										procurementId: data.procurementInfo.procurementId,
										status: "DECLINED"
									}),

									success: function () {
										loadRequests();
									}
								});

							});


							let total = 0.00;
							let totalQuant = 0;

							window.console.log("before");
							$("#requestModalTable tbody").html("<tr></tr>");
							data.items.forEach(element => {
								window.console.log("during");
								let sub = element.quantity * element.price;
								total += sub;
								totalQuant += element.quantity * 1;
								$("#requestModalTable tr:last").after("<tr>" +
									"<td> " + element.itemNumber + " </td>" +
									"<td class=\"text-left\"> " + element.name + " </td>" +
									"<td> " + element.quantity + " </td>" +
									"<td> " + element.price + " </td>" +
									"<td> £" + parseFloat(sub).toFixed(2) + " </td>" +
									"</tr>");

							});

							$("#labelAmount").html("(" + totalQuant + " item" + (totalQuant === 1 ? "" : "s") + ")");
							$("#labelCost").html("£" + total.toFixed(2));

							let recurring = data.procurementInfo.recurring === "1";

							window.document.getElementById("inputRecurring").checked = recurring;


						},

						error: function (xhr, resp, text) {
							window.console.log(text);
						}
					});

				}));

				$("#draftSpinner").removeClass("spinner-border");
				$("#draftSpinner").text("No Saved Drafts");

				if (count < numRows) {
					viewMore.html("View More (" + count + "/" + numRows + ")");
				} else {
					viewMore.remove();
				}
			},

			error: function (xhr, resp, text) {
				window.console.log(text);
			}
		});
	}
});
