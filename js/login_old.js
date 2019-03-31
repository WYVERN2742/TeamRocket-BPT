function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');

	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];

		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}

		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

const jwt = getCookie('jwt');

$.post("api/validate_token.php", JSON.stringify({ jwt: jwt })).done(function (result) {
	location.href = "index.html";
});

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$(document).on('submit', '#login_form', function () {

	// get form data
	const login_form = $(this);
	console.log(login_form);
	const form_data = JSON.stringify(login_form.serializeObject());

	$.ajax({
		type: "POST",
		url: "api/check_login.php",
		contentType: 'application/json',
		data: form_data,
		success: function (result) {

			// store jwt to cookie
			setCookie("jwt", result.jwt, 1);

			//$('#response').html("<div class='alert alert-success'>Successful login.</div>");
			location.href = "index.html";

		},
		error: function (xhr, resp, text) {
			// on error, tell the user login has failed & empty the input boxes
			$('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
			login_form.find('input').val('');
		}
	});

	return false;
});

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