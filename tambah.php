<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<h1>Tambah Data</h1>
<form method="POST" action="">
    <label for="nama">Nama Guru</label>
    <input type="text" name="nama" id="nama" required>

    <label for="hari">Hari Piket</label>
    <select name="hari" id="hari">
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jumat</option>
    </select>

    <label for="jam">Jam Piket</label>
    <input type="text" name="jam" id="jam" required>

    <button type="submit">Simpan</button>
</form>

<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_guru = $_POST['nama_guru'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $tugas = $_POST['tugas'];

    $query = "INSERT INTO jadwal_guru (nama_guru, hari, jam_mulai, jam_selesai, tugas) 
              VALUES ('$nama_guru', '$hari', '$jam_mulai', '$jam_selesai', '$tugas')";
    mysqli_query($koneksi, $query);

    header("Location: jadwal_piket.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal</title>
    <link rel="stylesheet" href="style.css"> <!-- Hubungkan dengan CSS -->

</head>

<body>
    <h1>Tambah Jadwal Guru Piket</h1>
    <form method="POST">
        <label>Nama Guru:</label><br>
        <input type="text" name="nama_guru" required><br>
        <label>Hari:</label><br>
        <input type="text" name="hari" required><br>
        <label>Jam Mulai:</label><br>
        <input type="time" name="jam_mulai" required><br>
        <label>Jam Selesai:</label><br>
        <input type="time" name="jam_selesai" required><br>
        <label>Tugas:</label><br>
        <textarea name="tugas" required></textarea><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>