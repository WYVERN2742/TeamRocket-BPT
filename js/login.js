$.fn.serializeObject = function () {

	var o = {};
	var a = this.serializeArray();
	$.each(a, function () {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};

$(document).on('submit', '#login_form', function () {

	// get form data
	const login_form = $(this);
	const form_data = JSON.stringify(login_form.serializeObject());

	$.ajax({
		type: "POST",
		url: "api/check_login.php",
		contentType: 'application/json',
		data: form_data,
		success: function (result) {

			$('#response').html("<div class='alert alert-success'>Successful login.</div>");
			location.href = "index.php";
		},
		error: function (xhr, resp, text) {
			// on error, tell the user login has failed & empty the input boxes

			if (text = "Internal Server Error") {
				$('#response').html("<div class='alert alert-danger'>Internal Server Error<br> Contact System Administrators.</div>");
			} else {
				$('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
			}

			login_form.find('input').val('');
		}
	});

	return false;
});
