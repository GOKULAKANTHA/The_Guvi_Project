$(document).ready(function() {
    // Retrieve email from local storage
    var email = window.localStorage.getItem('email');
    document.getElementById('pemail').value = email;

    // Retrieve user data from MongoDB and set form fields
    $.ajax({
        url: 'profile.php',
        type: 'POST',
        data: {email: email},
        success: function(response) {
            if (response !== '') {
                var userData = JSON.parse(response);
                document.getElementById('pname').value = userData.name;
                document.getElementById('pdob').value = userData.dob;
                document.getElementById('page').value = userData.age;
                document.getElementById('pmobile').value = userData.mobile;
            }
        }
    });

    // Submit form data
    $('#profile-form').submit(function(e) {
        e.preventDefault();
        var name = $('#pname').val();
        var dob = $('#pdob').val();
        var age = $('#page').val();
        var mobile = $('#pmobile').val();
        if (name === '' || dob === '' || age === '' || mobile === '') {
            $('#message').html('Please fill all fields');
        } else {
            $.ajax({
                url: 'profile.php',
                type: 'POST',
                data: {email: email, name: name, dob: dob, age: age, mobile: mobile},
                success: function(response) {
                    $('#message').html(response);
                }
            });
        }
    });
});
