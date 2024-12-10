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
            <a href="login.php" class="btn btn-primary text-decoration-none nav-item">Login</a>
        </div>
    </nav>

    <div>
        <!--Buat row, bagi 12, 2 untuk sidebar, 10 untuk konten. File lain sesuaikn-->
        <div class="row">
            <div class="col-md-2">
                <!--Pindahin ini ke sidebar.php, semua file penting connect ke style.css
                kaya search, index admin, news, dll-->
                <div class="sidebar p-4">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <div class="container mt-5">
                            <h3>Filter Berita</h3>
                            <form method="POST" action="category.php">
                                <div class="form-group">
                                    <label for="category">Pilih Kategori:</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="Sejarah">Sejarah</option>
                                        <option value="Politik">Politik</option>
                                        <option value="Budaya">Budaya</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <br><br>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <p>This web only made by 5 person</p>
                                        <p>Myself, Afrizal,</p>
                                        <p>Nur Ayu, Aryan, and Hayyin</p>
                                    </a></li>
                            </ul>
                            <p class="d-inline-flex gap-1">
                        </div>
                </div>
                <!--stop here-->
            </div>
            <div class="col px-4">
                <div class="container px-5 mt-4 my-auto">
                    <div class="text-center">
                        <h1>KoraNews</h1>
                        <h4>Sumber Berita Terpercaya</h4>
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
                            echo '<p class="mb-1">' . "<b>" . $article['tema'] . "</b>" . '</p>';
                            echo '<p class="mb-1">' . $article['author'] . '</p>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>