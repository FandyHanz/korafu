<?php
require 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $db = connectToMongoDB();
    $collection = $db -> news;
    $query = array('judul' => $_POST['judul'], 'isi' => $_POST['isi'],
    'tema' => $_POST['tema'], 'sinopsis' => $_POST['sinopsis'], 'author' => $_POST['author']);
    $result = $db -> news -> insertOne($query);
    if($result){
        header('Location: index_admin.php');
        exit();
    } else {
        echo "erorr";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Postingan Baru</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Buat Postingan Baru</h1>
    <form method="POST" action= "">
        <input type="text" name="judul" placeholder="Judul" required>
        <input type="text" name="tema" placeholder="Tema" required>
        <textarea name="isi" placeholder="isi"
        required></textarea>
        <input type="text" name="sinopsis" placeholder="sinopsis" required>
        <input type="text" name="author" placeholder="author" required>
        <button type="submit">Buat</button>
    </form>
    <a href="index_admin.php">Kembali ke Daftar Postingan</a>
</body>

</html>