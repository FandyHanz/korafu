<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KoraNews</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src='main.js'></script>
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
            <a href="logout.php" class="btn btn-primary text-decoration-none nav-item">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            <h1>KoraNews</h1>
            <h4>Sumber Berita Terpercaya</h4>
            <h5>you are logged in as admin</h5>
            
        </div><br>
        <form action="search.php" method="GET" class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Cari berita...">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form><br>
        <h2>Daftar Berita</h2>
        <div class="list-group">
            <?php
            include 'db.php';
            $db = connectToMongoDB();
            $newsCollection = $db->news;

            $news = $newsCollection->find([], ['sort' => ['date' => -1]]);
            foreach ($news as $article) {
                echo '<a href="news.php?id=' . $article['_id'] . '" class="list-group-item list-group-item-action">';
                echo '<h5 class="mb-1">' . $article['judul'] . '</h5>';
                echo '<p class="mb-1">' . $article['sinopsis'] . '</p>';
                echo '</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>