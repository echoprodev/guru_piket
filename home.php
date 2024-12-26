<?php
include 'koneksi.php';

// Ambil hari saat ini untuk default
$hariSekarang = date('l');
$hariIndo = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
];
$hariSekarang = $hariIndo[$hariSekarang];

// Jika pengguna memilih hari tertentu, gunakan itu, jika tidak tampilkan semua data
$hariDipilih = isset($_GET['hari']) ? $_GET['hari'] : 'Semua';

// Ambil data dari database
if ($hariDipilih === 'Semua') {
    $query = "SELECT * FROM jadwal_guru";
} else {
    $query = "SELECT * FROM jadwal_guru WHERE hari = '$hariDipilih'";
}
$result = mysqli_query($koneksi, $query);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Piket Guru - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Aplikasi Guru Piket</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jadwal_piket.php">Jadwal Piket</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="logout.php" style="float: right; margin: 10px; color: red;">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="card">
    <div class="card-body">
      <h4>Pilih Hari</h4>
      <!-- Form untuk memilih hari -->
      <form method="GET" action="">
        <div class="row mb-3">
          <div class="col-md-4">
            <select name="hari" class="form-select" onchange="this.form.submit()">
              <option value="Semua" <?= $hariDipilih === 'Semua' ? 'selected' : ''; ?>>Semua Hari</option>
              <?php foreach ($hariIndo as $hariEn => $hariId) : ?>
                <option value="<?= $hariId; ?>" <?= $hariDipilih === $hariId ? 'selected' : ''; ?>>
                  <?= $hariId; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </form>

      <h4>Jadwal Guru Piket<?= $hariDipilih === 'Semua' ? '' : ' untuk Hari: ' . $hariDipilih; ?></h4>
      <table class="table table-bordered" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead class="table-primary text-center">
          <th>ID</th>
          <th>Nama Guru</th>
          <?php if ($hariDipilih === 'Semua') : ?> <!-- Kolom Hari hanya muncul jika tidak ada filter -->
            <th>Hari</th>
          <?php endif; ?>
          <th>Jam Mulai</th>
          <th>Jam Selesai</th>
          <th>Tugas</th>
        </thead>
        <?php if (mysqli_num_rows($result) > 0) : ?>
          <?php 
            $id = 1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
              <td><?= $id++ ?></td>
              <td><?= $row['nama_guru']; ?></td>
              <?php if ($hariDipilih === 'Semua') : ?> <!-- Data Hari hanya muncul jika tidak ada filter -->
                <td><?= $row['hari']; ?></td>
              <?php endif; ?>
              <td><?= $row['jam_mulai']; ?></td>
              <td><?= $row['jam_selesai']; ?></td>
              <td><?= $row['tugas']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">Tidak ada data.</td>
          </tr>
        <?php endif; ?>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
