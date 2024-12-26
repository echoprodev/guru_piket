<?php
include 'koneksi.php';

// Get the day from the AJAX request
$day = isset($_GET['day']) ? $_GET['day'] : '';

// Prepare the SQL query
$query = "SELECT * FROM jadwal_guru";
if ($day) {
    $query .= " WHERE hari = '$day'";
}
$query .= " ORDER BY FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')";

$result = mysqli_query($koneksi, $query);

// Fetch data and return as JSON
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($koneksi);
echo json_encode($data);
