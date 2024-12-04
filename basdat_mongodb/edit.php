<?php
require 'db.php';
$db = connectToMongoDB();
$collection = $db->news;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);
}
if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['id'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $result = $collection->updateOne(
        ['_id' => $id],
        ['$set' => ['judul' => $_POST['judul'], 'tema' => $_POST['tema'], 'isi' =>
        $_POST['isi'], 'sinopsis' => $_POST['sinopsis'], 'author' => $_POST['author']]]
    );
    if($result){
        header("Location: index_admin.php");
        exit();
    }else{
        echo "erorr";
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Postingan</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $post['_id']; ?>">
        <input type="text" name="judul" value="<?php echo htmlspecialchars($post['judul']); ?>" required>
        <input type="text" name="tema" value="<?php echo htmlspecialchars($post['tema'])?>">
        <textarea name="isi" required><?php echo htmlspecialchars($post['isi']); ?></textarea>
        <input type="text" name="sinopsis" value="<?php echo htmlspecialchars($post['sinopsis']); ?>" required>
        <input type="text" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>
        <button type="submit">Perbarui</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>

</html>