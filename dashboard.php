<?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    }

    $mhs    = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mahasiswa");
    $row_mhs = mysqli_fetch_assoc($mhs);

    $dsn    = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dosen");
    $row_dsn = mysqli_fetch_assoc($dsn);

    $mk     = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM matakuliah");
    $row_mk = mysqli_fetch_assoc($mk);

    $jdw    = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal");
    $row_jdw = mysqli_fetch_assoc($jdw);
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - SIAKAD Modern</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                overflow-x: hidden;
            }

            .sidebar { 
                min-height: 100vh; 
                background-color: #1e293b; 
                padding-top: 25px; 
                box-shadow: 4px 0 10px rgba(0,0,0,0.05);
            }
            .sidebar a { 
                color: #94a3b8; 
                text-decoration: none; 
                padding: 12px 20px; 
                display: block; 
                border-radius: 8px; 
                margin: 6px 15px; 
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s ease;
            }
            .sidebar a:hover { 
                background-color: #334155; 
                color: #f8fafc; 
                transform: translateX(3px);
            }
            .sidebar a.active { 
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
                color: white; 
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .card-stat { 
                border: none; 
                border-radius: 14px; 
                background-color: #ffffff;
                color: #1e293b; 
                padding: 24px;
                box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04); 
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card-stat:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            }
            .card-stat h5 {
                font-size: 14px;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 5px;
                font-weight: 600;
            }
            .card-stat h2 {
                font-size: 32px;
                font-weight: 700;
                color: #0f172a;
                margin: 0;
            }

            .card-stat::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 4px;
            }
            .border-mhs::after { background-color: #3b82f6; }
            .border-dsn::after { background-color: #10b981; }
            .border-mk::after { background-color: #f59e0b; }
            .border-jdw::after { background-color: #ef4444; }

            .top-navbar {
                background-color: #ffffff;
                padding: 15px 30px;
                border-radius: 12px;
                box-shadow: 0 2px 12px rgba(0,0,0,0.02);
                margin-bottom: 30px;
            }

            .top-navbar, .card-stat {
                animation: fadeIn 0.6s ease-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 px-0 sidebar">
                <h4 class="text-center mb-1 text-white fw-bold" style="letter-spacing: 1px;">SIAKAD KAMPUS</h4>
                <p class="text-center text-muted small mb-4">Dashboard Admin</p>
                <hr class="mx-3" style="border-color: #334155;">
                
                <a href="#" class="active">🏠 Dashboard</a>
                <a href="Prodi/index.php">🏢 Data Program Studi</a>
                <a href="Mahasiswa/Tampilan.php">👨‍🎓 Data Mahasiswa</a>
                <a href="Dosen/index.php">👩‍🏫 Data Dosen</a>
                <a href="Matakuliah/index.php">📚 Data Mata Kuliah</a>
                <a href="Jadwal/index.php">📅 Jadwal Perkuliahan</a>
                <a href="KRS/index.php">📝 Kontrak KRS</a>
                <a href="Nilai/index.php">📊 Nilai Akademik</a>
                
                <div class="px-3 mt-4">
                    <a href="logout.php" class="btn btn-danger w-100 fw-bold text-white text-center m-0 py-2" 
                        style="border-radius: 8px;" onclick="return confirm('Yakin ingin keluar dari sistem?')">
                        🚪 Keluar Sistem
                    </a>
                </div>
            </div>

            <div class="col-md-10 p-4">

                <div class="top-navbar d-flex justify-content-end align-items-center">
                    
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-secondary small fw-medium"><?= date('l, d F Y'); ?></span>
                        
                        <div class="vertical-line" style="border-left: 1px solid #e2e8f0; height: 20px;"></div>
                        
                        <span class="fw-bold text-dark">
                            👤 <span class="text-primary" style="text-transform: capitalize;"><?= isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></span>
                        </span>
                    </div>
                    
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark" style="font-size: 28px;">Selamat Datang di Portal Utama</h2>
                    <p class="text-muted">Kelola data operasional perkuliahan, data mahasiswa, dan verifikasi akademik secara terpusat.</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card-stat border-mhs">
                            <h5>Total Mahasiswa</h5>
                            <h2><?= $row_mhs['total']; ?> <span style="font-size: 16px; color: #64748b; font-weight: normal;">Orang</span></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat border-dsn">
                            <h5>Dosen Aktif</h5>
                            <h2><?= $row_dsn['total']; ?> <span style="font-size: 16px; color: #64748b; font-weight: normal;">Dosen</span></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat border-mk">
                            <h5>Mata Kuliah</h5>
                            <h2><?= $row_mk['total']; ?> <span style="font-size: 16px; color: #64748b; font-weight: normal;">Matkul</span></h2>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat border-jdw">
                            <h5>Jadwal Kuliah</h5>
                            <h2><?= $row_jdw['total']; ?> <span style="font-size: 16px; color: #64748b; font-weight: normal;">Kelas</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card-stat" style="border-bottom: 4px solid #f59e0b;">
                            <h5>Program Studi</h5>
                            <h2>
                                <?php 
                                    $q_prd = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM prodi");
                                    $row_prd = mysqli_fetch_assoc($q_prd);
                                    echo $row_prd['total'];
                                ?> 
                                <span style="font-size: 16px; color: #64748b; font-weight: normal;">Prodi</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>