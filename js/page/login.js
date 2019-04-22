/**
 * Log into the Bangor Procurement Tool.
 * Converts the login form into a json string, and uses a POST request
 * for logging in.
 */
$(window.document).on("submit", "#login_form", function () {
	// get form data
	const login_form = $(this);
	const form_data = JSON.stringify(login_form.serializeObject());

	$.ajax({
		// Create post request with login data
		type: "POST",
		url: "api/check_login.php",
		contentType: "application/json",
		data: form_data,

		success: function () {
			// Log in successful

			// ? Do we need to show the successful login message since we"re redirecting?
			$("#response").html("<div class=\"alert alert-success\">Successful login.</div>");
			window.document.location.href = "index.php";
		},

		error: function (xhr, resp, text) {
			// Failed login, tell user why

			if (text === "Internal Server Error") {
				$("#response").html("<div class=\"alert alert-danger\">Internal Server Error<br> Contact System Administrators.</div>");
			} else {
				$("#response").html("<div class=\"alert alert-danger\">Login failed. Email or password is incorrect.</div>");
			}

			// Clear email and password boxes
			login_form.find("input").val("");
		}
	});

	return false;
});
