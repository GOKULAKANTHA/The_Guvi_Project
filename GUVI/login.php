<?php
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'guvi';

    // create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // check connection
    if (mysqli_connect_errno()) {
        die('Connect error: (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }

    // prepare statement
    $SELECT = "SELECT remail FROM register1 WHERE remail = ? AND rpassword = ?";
    $stmt = $conn->prepare($SELECT);

    // bind parameters and execute
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($remail);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum == 1) {
    // Set the user details in local storage
        echo "Login successful.";
        echo "<script>window.localStorage.setItem('email', '$email');</script>";
        echo "<script>window.localStorage.setItem('name', '$password');</script>";
        echo "<scrip>window.location.href='profile.html';</script>";
        exit;
}

    else{
        echo "Invalid login credentials";
    }

    // close statement and connection
    $stmt->close();
    $conn->close();
} 
else {
    echo "Email and password are required fields.";
    die();
}
?>
