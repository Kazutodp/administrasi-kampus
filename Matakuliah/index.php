<?php
include '../koneksi.php';

$semester_terpilih = isset($_GET['semester']) ? $_GET['semester'] : 'semua';

if ($semester_terpilih == 'semua') {
    $query = mysqli_query($koneksi, "SELECT * FROM matakuliah ORDER BY semester ASC, Kode_Matakuliah ASC");
} else {
    $sem_int = intval($semester_terpilih);
    $query = mysqli_query($koneksi, "SELECT * FROM matakuliah WHERE semester = $sem_int ORDER BY Kode_Matakuliah ASC");
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Mata Kuliah - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
                margin: 0; 
                padding: 40px; 
                color: #1e293b;
            }
            .container {
                max-width: 1100px;
                margin: 0 auto;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                border: 1px solid #e2e8f0;
            }
            .btn-back {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                margin-bottom: 20px;
            }
            .header-section {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
            }
            h2 { margin: 0; font-size: 24px; color: #0f172a; font-weight: 700; }
            .btn-add {
                text-decoration: none;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 10px 20px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
            }

            .filter-container {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-bottom: 25px;
                padding-bottom: 15px;
                border-bottom: 1px solid #e2e8f0;
            }
            .filter-tab {
                text-decoration: none;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 13px;
                font-weight: 600;
                color: #64748b;
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                transition: all 0.2s ease;
            }
            .filter-tab:hover {
                background-color: #e2e8f0;
                color: #0f172a;
            }
            .filter-tab.active {
                background-color: #1e4ed8;
                color: #ffffff;
                border-color: #1e4ed8;
                box-shadow: 0 2px 8px rgba(30, 78, 216, 0.2);
            }

            table { width: 100%; border-collapse: collapse; margin-top: 10px; text-align: left; }
            th { 
                background-color: #f8fafc; 
                color: #64748b; 
                font-weight: 600; 
                font-size: 13px;
                text-transform: uppercase;
                padding: 14px 16px;
                border-bottom: 2px solid #e2e8f0;
            }
            td { padding: 14px 16px; font-size: 14px; color: #334155; border-bottom: 1px solid #edf2f7; }
            tr:hover { background-color: #f8fafc; }
            .badge {
                padding: 4px 8px;
                border-radius: 6px;
                font-weight: 600;
                font-size: 12px;
            }
            .badge-sks { background-color: #e0f2fe; color: #0369a1; }
            .badge-wajib { background-color: #fee2e2; color: #991b1b; }
            .badge-pilihan { background-color: #fef3c7; color: #92400e; }
            .action-links a { text-decoration: none; font-weight: 600; font-size: 14px; margin-right: 10px; }
            .link-edit { color: #2563eb; }
            .link-hapus { color: #ef4444; }
            .empty-state { text-align: center; padding: 40px; color: #94a3b8; font-style: italic; }
        </style>
    </head>
    
    <body>
        <div class="container">
            <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
            
            <div class="header-section">
                <h2>Daftar Mata Kuliah Aktif</h2>
                <a href="tambah.php" class="btn-add">[+] Tambah Mata Kuliah</a>
            </div>

            <div class="filter-container">
                <a href="index.php?semester=semua" class="filter-tab <?= ($semester_terpilled_atau_aktif == 'semua' || $semester_terpilih == 'semua') ? 'active' : ''; ?>">Semua</a>
                <?php for($s = 1; $s <= 8; $s++) { ?>
                    <a href="index.php?semester=<?= $s; ?>" class="filter-tab <?= ($semester_terpilih == $s) ? 'active' : ''; ?>">Semester <?= $s; ?></a>
                <?php } ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Sifat</th>
                        <th>Jenis</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_array($query)) { 
                    ?>
                    <tr>
                        <td style="font-weight: 600; color: #0f172a;"><?= $row['Kode_Matakuliah']; ?></td>
                        <td><?= $row['Nama_Matakuliah']; ?></td>
                        <td><span class="badge badge-sks"><?= $row['SKS']; ?> SKS</span></td>
                        <td>Semester <?= $row['semester']; ?></td>
                        <td>
                            <?php if($row['Sifat_Matakuliah'] == 'Wajib') { ?>
                                <span class="badge badge-wajib">Wajib</span>
                            <?php } else if($row['Sifat_Matakuliah'] == 'Pilihan') { ?>
                                <span class="badge badge-pilihan">Pilihan</span>
                            <?php } else { ?>
                                <span style="color: #94a3b8;">-</span>
                            <?php } ?>
                        </td>
                        <td><?= $row['Jenis_Matakuliah'] ?: '<span style="color: #94a3b8;">-</span>'; ?></td>
                        <td class="action-links" style="text-align: right; white-space: nowrap;"> 
                            <a href="tambah.php?kode=<?= $row['Kode_Matakuliah']; ?>" class="link-edit">Edit</a>
                            <a href="hapus.php?kode=<?= $row['Kode_Matakuliah']; ?>" class="link-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                    <tr>
                        <td colspan="7" class="empty-state">Tidak ada mata kuliah di Semester <?= htmlspecialchars($semester_terpilih); ?>.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>
</html>