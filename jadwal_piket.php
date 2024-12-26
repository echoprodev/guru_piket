<?php
include 'koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM jadwal_guru";
$result = mysqli_query($koneksi, $query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Piket Guru - Jadwal Piket</title>
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
                        <a class="nav-link" href="#">Jadwal Piket</a>
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
            <!-- Tombol Tambah Data -->
            <button class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Jadwal</button>

            <table class="table table-bordered" cellpadding="10" cellspacing="0" style="width: 100%;">
                <thead class="table-primary text-center">
                    <th>ID</th>
                    <th>Nama Guru</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tugas</th>
                    <th>Aksi</th>
                </thead>
                <?php 
                $id = 1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $id++ ?></td>
                        <td><?= $row['nama_guru']; ?></td>
                        <td><?= $row['hari']; ?></td>
                        <td><?= $row['jam_mulai']; ?></td>
                        <td><?= $row['jam_selesai']; ?></td>
                        <td><?= $row['tugas']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>">Edit</button>
                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="edit.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel<?= $row['id']; ?>">Edit Jadwal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="nama_guru" class="form-label">Nama Guru</label>
                                            <input type="text" class="form-control" name="nama_guru" value="<?= $row['nama_guru']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hari" class="form-label">Hari</label>
                                            <select class="form-select" name="hari" required>
                                                <option value="Senin" <?= $row['hari'] === 'Senin' ? 'selected' : ''; ?>>Senin</option>
                                                <option value="Selasa" <?= $row['hari'] === 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
                                                <option value="Rabu" <?= $row['hari'] === 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
                                                <option value="Kamis" <?= $row['hari'] === 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
                                                <option value="Jumat" <?= $row['hari'] === 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
                                                <option value="Sabtu" <?= $row['hari'] === 'Sabtu' ? 'selected' : ''; ?>>Sabtu</option>
                                                <option value="Minggu" <?= $row['hari'] === 'Minggu' ? 'selected' : ''; ?>>Minggu</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                            <input type="time" class="form-control" name="jam_mulai" value="<?= $row['jam_mulai']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                            <input type="time" class="form-control" name="jam_selesai" value="<?= $row['jam_selesai']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tugas" class="form-label">Tugas</label>
                                            <input type="text" class="form-control" name="tugas" value="<?= $row['tugas']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="tambah.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control" name="nama_guru" required>
                        </div>
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" name="hari" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" name="jam_mulai" required>
                        </div>
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" name="jam_selesai" required>
                        </div>
                        <div class="mb-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="text" class="form-control" name="tugas" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>