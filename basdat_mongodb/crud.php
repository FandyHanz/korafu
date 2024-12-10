<?php
include 'db.php';
include 'vendor/autoload.php';
$db = connectToMongoDB();
$postsCollection = $db->news;
$posts = $postsCollection->find()->toArray();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Postingan Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container d-flex">
            <a class="navbar-brand text-white justify-content-start" href="index.php">KoraNews</a>
            <a href="login.php" class="btn btn-primary text-decoration-none nav-item">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Daftar Postingan Blog</h1>
        <a class="btn btn-success" href="create.php">Buat Postingan Baru</a>
        <hr>
        <?php foreach ($posts as $post): ?>
            <div class="post card">
                <div class="card-header">
                    <h4 class="card-title"><?= htmlspecialchars($post['judul']) ?></h4>
                    <span class="card-title"><?= htmlspecialchars($post['sinopsis']) ?></span>
                </div>
                <?php
                
                ?>
                <div class="card-body">
                <p><?= nl2br(htmlspecialchars($post['isi'])) ?><br>
                Tema: <?= htmlspecialchars($post['tema']) ?><br>
                Penulis: <?= htmlspecialchars($post['author']) ?><br>
                Tanggal Dibuat: <?= htmlspecialchars($post['createdAt']->toDateTime()->format('Y-m-d')) ?><br>
                Tanggal update: <?= htmlspecialchars($post['updatedAt']->toDateTime()->format('Y-m-d')) ?><br><br>
                <a class="btn btn-danger" href="delete.php?id=<?php echo $post['_id']; ?>">Hapus</a>
                <a class="btn btn-primary" href="edit.php?id=<?php echo $post['_id']; ?>">Edit</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</body>

</html>