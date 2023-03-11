$(document).ready(function () {
		$('#registration-form').submit(function (event) {
			event.preventDefault();
			var remail = $('#remail').val();
			var rpassword = $('#rpassword').val();
			var cpassword = $('#cpassword').val();
			if (remail == '' || rpassword == '' || cpassword == '') {
				$('#message').html('<div class="alert alert-danger">Please fill in all fields</div>');
			} else if (rpassword != cpassword) {
				$('#message').html('<div class="alert alert-danger">Confirm password is not same</div>');
			} else {
				$.ajax({
					url: 'register.php',
					type: 'POST',
					data: {
						remail: remail,
						rpassword: rpassword
					},
					success: function (response) {
						$('#message').html(response);
					}
				});
			}
		});
	});