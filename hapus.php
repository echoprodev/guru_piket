<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM jadwal_guru WHERE id = $id";
mysqli_query($koneksi, $query);

header("Location: jadwal_piket.php");
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

