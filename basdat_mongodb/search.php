<?php
require 'vendor/autoload.php';
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
        <h1>Hasil Pencarian</h1>
        <div class="list-group">
            <?php
           include 'db.php';
           $db = connectToMongoDB();
           $newsCollection = $db->news;
           
           $query = isset($_GET['query']) ? $_GET['query'] : '';
           $articles = [];
           
           // Only perform the search if the query is not empty
           if (!empty($query)) {
               $articles = $newsCollection->find([
                   '$or' => [
                       ['judul' => new MongoDB\BSON\Regex($query, 'i')],
                       ['sinopsis' => new MongoDB\BSON\Regex($query, 'i')]
                   ]
               ]);
           }
           
           // Display the search results
           if ($articles->isDead()) {
               echo '<p>No articles found.</p>';
           } else {
               foreach ($articles as $article) {
                   echo '<a href="news.php?id=' . $article['_id'] . '" class="list-group-item list-group-item-action">';
                   echo '<h5 class="mb-1">' . htmlspecialchars($article['judul']) . '</h5>';
                   echo '<p class="mb-1">' . htmlspecialchars($article['sinopsis']) . '</p>';
                   echo '</a>';
               }
           }
           ?>
        </div>
    </div>
</body>

</html>