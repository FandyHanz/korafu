<?php
require 'db.php';

$db = connectToMongoDB();
$collection = $db->news;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);

    //NOT FOUND
    if (!$post) {
        header("Location: index_admin.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);

    $result = $collection->updateOne(
        ['_id' => $id],
        [
            '$set' => [
                'judul' => $_POST['judul'],
                'tema' => $_POST['tema'],
                'isi' => $_POST['isi'],
                'sinopsis' => $_POST['sinopsis'],
                'author' => $_POST['author'],
                'updatedAt' => new MongoDB\BSON\UTCDateTime(new DateTime())
            ]
        ]
    );

    if ($result) {
        header("Location: crud.php");
        exit();
    } else {
        echo "Error updating post: " . $result->getErrorMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="css/creator.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Postingan</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $post['_id']; ?>">
            <input type="text" name="judul" value="<?php echo htmlspecialchars($post['judul']); ?>" required
                placeholder="Judul">
            <select id="tema" name="tema" class="form-control" required>
                <option value="Sejarah">Sejarah</option>
                <option value="Politik">Politik</option>
                <option value="Budaya">Budaya</option>
            </select>
            <textarea name="isi" required placeholder="Isi"><?php echo htmlspecialchars($post['isi']); ?></textarea>
            <input type="text" name="sinopsis" value="<?php echo htmlspecialchars($post['sinopsis']); ?>" required
                placeholder="Sinopsis">
            <input type="text" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required
                placeholder="Penulis" readonly>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </form>
        <a href="index.php" class="btn btn-danger">Kembali ke Daftar Postingan</a>
    </div>
</body>

</html>