<?php
include 'koneksi.php';

// Query hitung total data untuk statistik di dashboard
$mhs  = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mahasiswa");
$row_mhs = mysqli_fetch_assoc($mhs);

$dsn  = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dosen");
$row_dsn = mysqli_fetch_assoc($dsn);

$mk   = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM matakuliah");
$row_mk = mysqli_fetch_assoc($mk);

$jdw  = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal");
$row_jdw = mysqli_fetch_assoc($jdw);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #212529; color: white; padding-top: 20px; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; border-radius: 4px; margin: 4px 10px; }
        .sidebar a:hover { background-color: #343a40; color: white; }
        .sidebar a.active { background-color: #0d6efd; color: white; }
        .card-stat { border: none; border-radius: 10px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 px-0 sidebar">
            <h4 class="text-center mb-4 text-white fw-bold">SIAKAD v1.0</h4>
            <hr class="mx-3">
            <a href="#" class="active">🏠 Dashboard</a>
            <a href="Prodi/index.php">🏢 Data Program Studi</a>
            <a href="Mahasiswa/Tampilan.php">👨‍🎓 Data Mahasiswa</a>
            <a href="Dosen/index.php">👩‍🏫 Data Dosen</a>
            <a href="Matakuliah/index.php">📚 Data Mata Kuliah</a>
            <a href="Jadwal/index.php">📅 Jadwal Perkuliahan</a>
            <a href="KRS/index.php">📝 Kontrak KRS</a>
            <a href="Nilai/index.php">📊 Nilai Akademik</a>
        </div>

        <div class="col-md-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Selamat Datang di Portal Administrasi Kampus</h2>
                <span class="badge bg-secondary p-2"><?= date('D, d M Y'); ?></span>
            </div>
            <p class="text-muted">Gunakan menu di sebelah kiri untuk mengelola data operasional kampus secara real-time.</p>
            
            <div class="row mt-4g g-4">
                <div class="col-md-3">
                    <div class="card card-stat bg-primary p-4">
                        <h5>Total Mahasiswa</h5>
                        <h2 class="fw-bold mt-2"><?= $row_mhs['total']; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-success p-4">
                        <h5>Dosen Pengajar</h5>
                        <h2 class="fw-bold mt-2"><?= $row_dsn['total']; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-warning text-dark p-4">
                        <h5>Mata Kuliah</h5>
                        <h2 class="fw-bold mt-2"><?= $row_mk['total']; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-danger p-4">
                        <h5>Jadwal Aktif</h5>
                        <h2 class="fw-bold mt-2"><?= $row_jdw['total']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>