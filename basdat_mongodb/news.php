<?php
include 'vendor/autoload.php'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>KoraNews - Detail Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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

    <div class="container mt-5 p-5 main-con">
        <?php
        include 'db.php';
        $db = connectToMongoDB();
        $newsCollection = $db->news;

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $article = $newsCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

        if ($article) {
            echo '<h1>' . $article['judul'] . '</h1>';
            echo '<b>Ditulis oleh ' . $article['author'] . '</b>';
            echo '<p><small>Dibuat pada: ' . $article['createdAt']->toDateTime()->format('Y-m-d') . '</small><br>
            <small>Terakhir diubah pada: ' . $article['updatedAt']->toDateTime()->format('Y-m-d') . '</small></p>';

            echo '<hr>';
            echo '<p>' . $article['isi'] . '</p>';
        } else {
            echo '<h1>Berita tidak ditemukan.</h1>';
        }
        ?>
    </div>

    <div class="container mt-5 p-2">
        <?php 
        if ($article) {
            echo '<h4>Komentar</h4>
            <form action="comment-procces.php" method="post">
                <div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1" name="nama">Nama</span>
                        <input type="text" class="form-control" placeholder="John Doe" aria-label="Username" name="user">
                </div>
                    <textarea class="form-control" name="isi" aria-label="With textarea" style="max-height: 250px; min-height: 50px;"></textarea><br>
                    <button class="btn btn-primary" type="submit">Komentari</button>
                </div>
            </form>
            ';
        }
        ?>
    </div>
</body>

</html>