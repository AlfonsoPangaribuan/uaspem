<?php
include 'cookie_handler.php';

$message = "";

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setCookie'])) {
        $cookieName = $_POST['cookieName'];
        $cookieValue = $_POST['cookieValue'];
        setCustomCookie($cookieName, $cookieValue);
        $message = "Cookie '$cookieName' berhasil disimpan.";
    } elseif (isset($_POST['deleteCookie'])) {
        $cookieName = $_POST['cookieName'];
        deleteCustomCookie($cookieName);
        $message = "Cookie '$cookieName' berhasil dihapus.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cookie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Pengelolaan Cookie</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="cookieName">Nama Cookie:</label>
                <input type="text" id="cookieName" name="cookieName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cookieValue">Nilai Cookie:</label>
                <input type="text" id="cookieValue" name="cookieValue" class="form-control">
            </div>
            <button type="submit" name="setCookie" class="btn btn-primary">Set Cookie</button>
            <button type="submit" name="deleteCookie" class="btn btn-danger">Delete Cookie</button>
        </form>

        <h2 class="mt-5">Daftar Cookie</h2>
        <ul>
            <?php foreach ($_COOKIE as $key => $value): ?>
                <li><strong><?= $key ?>:</strong> <?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
