<?php
include '../koneksi.php';

$semester_terpilih = isset($_GET['semester']) ? $_GET['semester'] : 'semua';

$sql = "SELECT jadwal.*, matakuliah.Nama_Matakuliah, matakuliah.semester, dosen.Nama_Dosen 
        FROM jadwal
        INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
        INNER JOIN dosen ON jadwal.NIDN_Pengampu = dosen.NIDN";

if ($semester_terpilih != 'semua') {
    $sem_int = intval($semester_terpilih);
    $sql .= " WHERE matakuliah.semester = $sem_int";
}

$sql .= " ORDER BY FIELD(jadwal.Hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), jadwal.Jam ASC";

$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jadwal Kuliah - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
                margin: 0; 
                padding: 30px;
                color: #1e293b;
            }
            .container {
                max-width: 1300px; 
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
                background-color: #2563eb;
                color: #ffffff;
                border-color: #2563eb;
                box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
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
                white-space: nowrap;
            }
            td { 
                padding: 14px 16px; 
                font-size: 14px; 
                color: #334155; 
                border-bottom: 1px solid #edf2f7;
                white-space: nowrap;
            }
            td.expandable {
                white-space: normal !important; 
            }
            tr:hover { background-color: #f8fafc; }
            .badge {
                padding: 4px 8px;
                border-radius: 6px;
                font-weight: 600;
                font-size: 12px;
                display: inline-block;
            }
            .badge-id { background-color: #f1f5f9; color: #475569; }
            .badge-hari { background-color: #ecfdf5; color: #047857; }
            .badge-ruang { background-color: #fff7ed; color: #c2410c; }
            .badge-semester { background-color: #e0f2fe; color: #0369a1; }
            
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
                <h2>Jadwal Perkuliahan Kampus</h2>
                <a href="tambah.php" class="btn-add">[+] Tambah Jadwal</a>
            </div>

            <div class="filter-container">
                <a href="index.php?semester=semua" class="filter-tab <?= ($semester_terpilih == 'semua') ? 'active' : ''; ?>">Semua Jadwal</a>
                <?php for($s = 1; $s <= 8; $s++) { ?>
                    <a href="index.php?semester=<?= $s; ?>" class="filter-tab <?= ($semester_terpilih == $s) ? 'active' : ''; ?>">Semester <?= $s; ?></a>
                <?php } ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th> <th>ID Jadwal</th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Dosen Pengampu</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruang</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($query) > 0) {
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) { 
                    ?>
                    <tr>
                        <td><?= $no++; ?>.</td> <td><span class="badge badge-id"><?= $row['Id_Jadwal']; ?></span></td>
                        <td class="expandable" style="font-weight: 600; color: #0f172a;"><?= $row['Nama_Matakuliah']; ?> <span style="font-weight: normal; color: #94a3b8; font-size: 12px;">(<?= $row['Kode_Matakuliah']; ?>)</span></td>
                        <td><span class="badge badge-semester">S<?= $row['semester']; ?></span></td>
                        <td class="expandable"><?= $row['Nama_Dosen']; ?></td>
                        <td><span class="badge badge-hari"><?= $row['Hari']; ?></span></td>
                        <td style="font-weight: 500; color: #475569;"><?= $row['Jam']; ?> WITA</td>
                        <td><span class="badge badge-ruang"><?= $row['Ruangan']; ?></span></td>
                        <td class="action-links" style="text-align: right; white-space: nowrap;"> 
                            <a href="tambah.php?id=<?= $row['Id_Jadwal']; ?>" class="link-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['Id_Jadwal']; ?>" class="link-hapus" onclick="return confirm('Yakin mau hapus jadwal ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else { 
                    ?>
                    <tr>
                        <td colspan="8" class="empty-state">Tidak ada jadwal kuliah untuk Semester <?= htmlspecialchars($semester_terpilih); ?>.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>