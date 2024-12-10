<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connectToMongoDB();
    $collection = $db->comments;

    // Menambahkan komentar baru
    $query = [
        'post_id' => $_POST['post_id'], // ID berita yang dikomentari
        'name' => $_POST['name'], // Nama pengomentar
        'comment' => $_POST['comment'], // Isi komentar
        'reply_to' => isset($_POST['reply_to']) ? $_POST['reply_to'] : null, // ID komentar yang dibalas (jika ada)
        'date' => $_POST['updatedAt']->toDateTime()->format('Y-m-d')
    ];
    $result = $collection->insertOne($query);

    if ($result) {
        header("Location: komentar.php?post_id=" . $_POST['post_id']);
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan komentar.";
    }
}

if (isset($_GET['post_id'])) {
    $db = connectToMongoDB();
    $collection = $db->comments;
    $post_id = $_GET['post_id'];

    // Mengambil komentar berdasarkan post_id
    $comments = $collection->find(['post_id' => $post_id])->toArray();
} else {
    die("Post ID tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Komentar Berita</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Komentar Berita</h1>

    <!-- Form untuk komentar baru -->
    <form method="POST" action="">
        <input type="hidden" name="post_id" value="<?= $_GET['post_id'] ?>">
        <input type="text" name="name" placeholder="Nama Anda" required>
        <textarea name="comment" placeholder="Tulis komentar Anda di sini..." required></textarea>
        <button type="submit">Kirim Komentar</button>
    </form>

    <hr>

    <!-- Menampilkan komentar -->
    <h2>Daftar Komentar</h2>
    <?php if (count($comments) > 0): ?>
        <?php foreach ($comments as $comment): ?>
            <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 10px;">
                <p><strong><?= htmlspecialchars($comment['name']) ?>:</strong></p>
                <p><?= htmlspecialchars($comment['comment']) ?></p>
                <form method="POST" action="" style="margin-top: 10px;">
                    <input type="hidden" name="post_id" value="<?= $_GET['post_id'] ?>">
                    <input type="hidden" name="reply_to" value="<?= $comment['_id'] ?>">
                    <textarea name="comment" placeholder="Balas komentar ini..." required></textarea>
                    <button type="submit">Balas</button>
                </form>
                <!-- Menampilkan balasan -->
                <?php
                $replies = $collection->find(['reply_to' => $comment['_id']])->toArray();
                if (count($replies) > 0):
                    foreach ($replies as $reply): ?>
                        <div style="margin-left: 20px; margin-top: 10px; border-left: 2px solid #ddd; padding-left: 10px;">
                            <p><strong><?= htmlspecialchars($reply['name']) ?>:</strong></p>
                            <p><?= htmlspecialchars($reply['comment']) ?></p>
                        </div>
                    <?php endforeach;
                endif;
                ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada komentar.</p>
    <?php endif; ?>
</body>

</html>
