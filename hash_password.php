<?php
// Password asli
$plain_password = "admin123"; // Ganti dengan password yang diinginkan

// Enkripsi password
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Tampilkan hasil
echo "Password asli: " . $plain_password . "<br>";
echo "Password terenkripsi: " . $hashed_password . "<br>";
?>
