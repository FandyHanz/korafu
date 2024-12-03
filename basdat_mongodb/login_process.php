<?php

use MongoDB\Operation\FindOne;

session_start();
include 'db.php'; 
$db = connectToMongoDB();
$usersCollection = $db->user; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

   $query = array("username" => $username, "password" => $password);
   $result = $usersCollection -> findOne($query);

    if ($result) {
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
        header('Location: index_admin.php');
    } else {
        $error = "Invalid username or password.";
    }
}
?>