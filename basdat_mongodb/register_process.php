<?php
include 'db.php'; // Include your MongoDB connection

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the database
    $db = connectToMongoDB();
    $usersCollection = $db->users; // Change 'users' to your actual collection name

    // Check if the username already exists
    $existingUser  = $usersCollection->findOne(['username' => $username]);
    if ($existingUser ) {
        echo '<script>alert("Username already exists."); window.location.href="register.php";</script>';
    } else {
        // Insert the new user
        $usersCollection->insertOne([
            'username' => $username,
            'password' => $hashedPassword
        ]);
        echo '<script>alert("Registration successful! You can now log in."); window.location.href="login.php";</script>';
    }
}
?>