$(document).ready(function () {
		$('#login-form').submit(function (event) {
			event.preventDefault(); 
        // Get the values of the email and password fields
        var email = $('#email').val();
        var password = $('#password').val();

        // Validate the fields
        if (email == '' || password == '') {
            $('#message').html('<div class="alert alert-danger">Please fill in all fields</div>');
        } else {
            $.ajax({
                url: 'login.php',
                type: "POST",
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
						$('#message').html(response);
                        if (response.indexOf('Login successful') >= 0) {
                        window.location.href = 'profile.html';
					}

                }
            });
        }
    });
});