<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $db = connectToMongoDB();
    $collection = $db->news;
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $deleteResult = $collection->deleteOne(['_id' => $id]);
    if ($deleteResult) {
        header("Location: index_admin.php");
        exit();
    } else {
        echo "error";
    }
}
