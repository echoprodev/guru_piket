<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: index.php"); // Arahkan ke halaman login
exit;
?>
<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css"> <!-- Menghubungkan CSS -->
</head>
<body>
    <h1>Anda telah berhasil logout</h1>
    <form action="login.php" method="get">
        <button type="submit">Kembali ke Login</button>
    </form>
</body>
</html>
