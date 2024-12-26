<?php
include 'koneksi.php';

// Validasi data POST
if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_guru = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $hari = mysqli_real_escape_string($koneksi, $_POST['hari']);
    $jam_mulai = mysqli_real_escape_string($koneksi, $_POST['jam_mulai']);
    $jam_selesai = mysqli_real_escape_string($koneksi, $_POST['jam_selesai']);
    $tugas = mysqli_real_escape_string($koneksi, $_POST['tugas']);

    // Query untuk update data
    $query = "UPDATE jadwal_guru SET 
              nama_guru = '$nama_guru', 
              hari = '$hari', 
              jam_mulai = '$jam_mulai', 
              jam_selesai = '$jam_selesai', 
              tugas = '$tugas' 
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: jadwal_piket.php"); // Redirect ke halaman utama
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} else {
    die("Error: ID tidak ditemukan.");
}
