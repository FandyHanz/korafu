<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connectToMongoDB();
    $collection = $db->news;
    $query = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi'],
        'tema' => $_POST['tema'],
        'sinopsis' => $_POST['sinopsis'],
        'author' => $_POST['author'],
        'createdAt' => new MongoDB\BSON\UTCDateTime(new DateTime()),
        'updatedAt' => new MongoDB\BSON\UTCDateTime(new DateTime())
    ];

    $result = $db->news->insertOne($query);

    if (!$result) {
        echo "Error creating post: " . $result->getErrorMessage();
    } else {
        header('Location: crud.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buat Postingan Baru</title>
    <link rel="stylesheet" href="css/creator.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Buat Postingan Baru</h1>
        <form method="POST" action="">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" placeholder="Judul" required>

            <label for="tema">Tema:</label>
            <select id="tema" name="tema" class="form-control" required>
                <option value="Sejarah">Sejarah</option>
                <option value="Politik">Politik</option>
                <option value="Budaya">Budaya</option>
            </select>

            <label for="isi">Isi:</label>
            <textarea id="isi" name="isi" placeholder="Isi" required></textarea>

            <label for="sinopsis">Sinopsis:</label>
            <input type="text" id="sinopsis" name="sinopsis" placeholder="Sinopsis" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" placeholder="Author" required>

            <button type="submit" class="btn btn-success">Buat</button>
        </form>
        <a href="index_admin.php" class="btn btn-danger">Kembali ke Daftar Postingan</a>
    </div>
</body>

</html>