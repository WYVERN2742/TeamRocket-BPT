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
		url: "api/login.php",
		contentType: "application/json",
		data: form_data,

		success: function (response) {
			// Log in successful
			// ? Do we need to show the successful login message since we"re redirecting?

			$("#response").html("<div class=\"alert alert-success\">Successful login.</div>");
			window.console.log(response);
			window.document.location.href = "index.php";
		},

		error: function (xhr, resp, text) {
			// Failed login, tell user why

			if (text === "Internal Server Error") {
				$("#response").html("<div class=\"alert alert-danger\">Internal Server Error<br> Contact System Administrators.</div>");
			} else {
				$("#response").html("<div class=\"alert alert-danger\">Login failed. Email or password is incorrect.</div>");
			}

			// Clear password box
			// ? Should we clear both boxes or just the password?
			login_form.find("inputPassword").val("");
		}
	});

	return false;
});
