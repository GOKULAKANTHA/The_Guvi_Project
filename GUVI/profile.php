<?php
// MongoDB connection
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$collection = $mongoClient->mydb->users;

// Check if email exists in MongoDB and retrieve user data
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userData = $collection->findOne(['email' => $email]);
    if ($userData) {
        echo json_encode($userData);
    } else {
        echo '';
    }
}

// Update or insert user data in MongoDB
if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['dob']) && isset($_POST['age']) && isset($_POST['mobile'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    if ($collection->countDocuments(['email' => $email]) > 0) {
        $result = $collection->updateOne(['email' => $email], ['$set' => ['name' => $name, 'dob' => $dob, 'age' => $age, 'mobile' => $mobile]]);
        if ($result->getModifiedCount() === 1) {
            echo 'Profile updated successfully';
        } else {
            echo 'Failed to update profile';
        }
    } else {
        $result = $collection->insertOne(['name' => $name, 'dob' => $dob, 'age' => $age, 'email' => $email, 'mobile' => $mobile]);
        if ($result->getInsertedCount() === 1) {
            echo 'Profile saved successfully';
        } else {
            echo 'Failed to save profile';
        }
    }
}


?>
