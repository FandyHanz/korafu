<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KoraNews - Detail Berita</title>
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
        <?php
        include 'db.php';
        $db = connectToMongoDB();
        $newsCollection = $db->news;

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $article = $newsCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

        if ($article) {
            echo '<h1>' . $article['title'] . '</h1>';
            echo '<p><small>' . $article['date']->toDateTime()->format('Y-m-d') . '</small></p>';
            echo '<p>' . $article['content'] . '</p>';
        } else {
            echo '<h1>Berita tidak ditemukan.</h1>';
        }
        ?>
    </div>
</body>

</html>