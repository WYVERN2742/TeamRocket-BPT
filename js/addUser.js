$(document).ready(function () {
	$('#userForm').submit(function () {


		$.ajax({
			type: 'POST',
			url: 'api/user_management/insert_user.php', //php to post to
			data: $(this).serialize() //serializes all the form data to be sent as a post
		})
			.done(function (data) { //successful function
				$('#response').html("successful: " + data);

			})
			.fail(function (data) { //failure function
				$('#response').html("successful: " + data);

			});

		// to prevent refreshing the whole page page
		return false;

	});
});
