<?php
require 'vendor/autoload.php';
require 'db.php';
$db = connectToMongoDB();
$newsCollection = $db->news;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $filter = ['tema' => $category];
    $documents = $newsCollection->find($filter);
    $newsArray = iterator_to_array($documents);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KoraNews - Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container d-flex">
            <a class="navbar-brand text-white justify-content-start" href="index.php">KoraNews</a>
            <form action="search.php" method="GET" class="input-group justify-content-center">
                <input type="text" name="query" class="form-control" placeholder="Cari berita..."
                    style="max-width: 750px;">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>
            <a href="login.php" class="btn btn-primary text-decoration-none nav-item">Login</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Hasil Pengroupan</h1>
        <div class="list-group">

            <?php
            if (count($newsArray) == 0) {
                echo "<li class='list-group-item'>No results found on the " . $category . ".</li>";
            } else {
                foreach ($newsArray as $document) {
                    echo '<a href="news.php?id=' . $document['_id'] . '" class="list-group-item list-group-item-action">';
                    echo '<h5 class="mb-1">' . htmlspecialchars($document['judul']) . '</h5>';
                    echo '<p class="mb-1">' . htmlspecialchars($document['sinopsis']) . '</p>';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>