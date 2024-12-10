<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connectToMongoDB();
    $collection = $db->comment;
    $nama = $_POST['user'];
    $comment = $_POST['isi'];
    $query = [
        'nama' => $_POST['user'],
        'komentar' => $_POST['isi']
    ];
    $result = $db->comment->insertOne($query);
    if ($result) {
        echo "commentary aded to queque";
        header('Location: news.php');
        exit();
    } else {
        echo "ok";
    }
}
?>
