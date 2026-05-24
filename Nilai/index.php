<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT 
        MAX(nilai.Id_Nilai) as Id_Nilai,
        krs.NIM,
        mahasiswa.Nama_Mahasiswa, 
        MAX(krs.Tahun_Akademik) as Semester_Aktif
        FROM nilai
        INNER JOIN krs ON nilai.Id_KRS = krs.Id_KRS
        INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
        GROUP BY krs.NIM, mahasiswa.Nama_Mahasiswa
        ORDER BY mahasiswa.Nama_Mahasiswa ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa</title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; margin: 0; padding: 40px; color: #1e293b; }
        .container { max-width: 1100px; margin: 0 auto; }
        .btn-back { display: inline-flex; align-items: center; text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 20px; transition: color 0.2s; }
        .btn-back:hover { color: #0f172a; }
        
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .header-section h2 { margin: 0; font-size: 24px; font-weight: 700; color: #0f172a; }
        
        .btn-add { display: inline-flex; align-items: center; text-decoration: none; background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: white; padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); transition: opacity 0.2s; }
        .btn-add:hover { opacity: 0.9; }

        .table-container { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f8fafc; color: #64748b; font-weight: 600; padding: 16px 20px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 16px 20px; color: #334155; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }

        .text-center { text-align: center; }
        .badge-nim { font-weight: 600; color: #64748b; font-size: 12px; background: #e2e8f0; padding: 3px 8px; border-radius: 4px; }
        
        .btn-view { text-decoration: none; background-color: #3b82f6; color: white; padding: 6px 14px; border-radius: 6px; font-weight: 600; font-size: 13px; transition: background 0.2s; }
        .btn-view:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>

    <div class="container">
        <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
        
        <div class="header-section">
            <h2>Daftar Nilai Akademik Mahasiswa</h2>
            <a href="tambah.php" class="btn-add">➕ Input Nilai Baru</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="width: 120px;">ID Nilai</th>
                        <th>Nama Mahasiswa</th>
                        <th>Semester / Tahun Aktif</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($query) == 0) { 
                    ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #94a3b8; padding: 30px;">Belum ada data nilai yang diinput.</td>
                        </tr>
                    <?php 
                    } else {
                        while($row = mysqli_fetch_array($query)) { 
                    ?>
                    <tr>
                        <td class="text-center" style="font-weight: 600; color: #64748b;"><?= $no++; ?></td>
                        <td style="font-weight: 600; color: #0f172a;"><?= $row['Id_Nilai']; ?></td>
                        <td>
                            <div style="font-weight: 600; color: #0f172a; margin-bottom: 2px;"><?= $row['Nama_Mahasiswa']; ?></div>
                            <span class="badge-nim">NIM: <?= $row['NIM']; ?></span>
                        </td>
                        <td style="color: #64748b; font-weight: 600;">🗓️ <?= $row['Semester_Aktif']; ?></td>
                        <td class="text-center">
                            <a href="detail_nilai.php?nim=<?= $row['NIM']; ?>" class="btn-view">🔍 Lihat Detail Nilai</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>