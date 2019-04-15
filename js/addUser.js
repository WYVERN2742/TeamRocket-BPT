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

$(document).on('submit', '#user_form', function () {

	// get form data
	const login_form = $(this);
	const form_data = JSON.stringify(login_form.serializeObject());

	$.ajax({
		type: "POST",
		url: "api/user_management/user.php",
		contentType: 'application/json',
		data: form_data,
		success: function (result) {

			$('#response').html("<div class='alert alert-success'>Successful login.</div>");
		},
		error: function (xhr, resp, text) {
			// on error, tell the user login has failed & empty the input boxes
			console.log(xhr);
			console.log(resp);
			console.log(text);
			$('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
		}
	});

	return false;
});