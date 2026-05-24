<?php
include '../koneksi.php';

if (!isset($_GET['nim'])) {
    header("Location: index.php");
    exit;
}

$nim = $_GET['nim'];

$query_mhs = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim'");
$mhs = mysqli_fetch_array($query_mhs);

if (!$mhs) {
    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$query_nilai = mysqli_query($koneksi, "SELECT nilai.*, matakuliah.Nama_Matakuliah, matakuliah.Semester, krs.Tahun_Akademik
        FROM nilai
        INNER JOIN krs ON nilai.Id_KRS = krs.Id_KRS
        INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
        INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
        WHERE krs.NIM = '$nim'
        ORDER BY matakuliah.Semester ASC");

$total_matkul = mysqli_num_rows($query_nilai);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Nilai - <?= $mhs['Nama_Mahasiswa']; ?></title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; margin: 0; padding: 40px; color: #1e293b; }
        .container { max-width: 950px; margin: 0 auto; }
        
        .header-area { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-back { text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; transition: color 0.2s; }
        .btn-back:hover { color: #0f172a; }
        
        .btn-add-specific { text-decoration: none; background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(37,99,235,0.2); transition: background 0.2s; }
        .btn-add-specific:hover { background-color: #1d4ed8; }

        .profile-card { background: white; border-radius: 12px; padding: 24px; margin-bottom: 25px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        .profile-card h3 { margin: 0 0 15px 0; color: #0f172a; font-size: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; }
        .profile-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; font-size: 15px; }
        .profile-label { color: #64748b; font-weight: 500; }
        .profile-value { color: #0f172a; font-weight: 600; }

        .table-container { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f8fafc; color: #64748b; font-weight: 600; padding: 16px 20px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 16px 20px; color: #334155; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        tr:hover td { background-color: #f8fafc; }
        
        .text-center { text-align: center; }
        
        .badge-grade { display: inline-block; padding: 4px 12px; border-radius: 6px; font-weight: 700; font-size: 13px; }
        .grade-A { background-color: #dcfce7; color: #15803d; }
        .grade-B { background-color: #dbeafe; color: #1d4ed8; }
        .grade-C { background-color: #fef9c3; color: #a16207; }
        .grade-D { background-color: #ffedd5; color: #c2410c; }
        .grade-E { background-color: #fee2e2; color: #b91c1c; }

        .btn-edit { text-decoration: none; color: #3b82f6; font-weight: 600; margin-right: 12px; }
        .btn-edit:hover { color: #1d4ed8; }
        .btn-delete { text-decoration: none; color: #ef4444; font-weight: 600; }
        .btn-delete:hover { color: #b91c1c; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-area">
            <a href="index.php" class="btn-back">⬅ Kembali ke Daftar Utama</a>
            <a href="tambah.php?nim_mhs=<?= $mhs['NIM']; ?>" class="btn-add-specific">➕ Tambah Nilai Matkul</a>
        </div>

        <div class="profile-card">
            <h3>Kartu Hasil Studi (KHS) Mahasiswa</h3>
            <div class="profile-grid">
                <div>
                    <span class="profile-label">Nama Mahasiswa:</span><br>
                    <span class="profile-value"><?= $mhs['Nama_Mahasiswa']; ?></span>
                </div>
                <div>
                    <span class="profile-label">NIM Mahasiswa:</span><br>
                    <span class="profile-value"><?= $mhs['NIM']; ?></span>
                </div>
                <div>
                    <span class="profile-label">Total Mata Kuliah:</span><br>
                    <span class="profile-value">📚 <?= $total_matkul; ?> Terinput</span>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th>Mata Kuliah</th>
                        <th class="text-center" style="width: 120px;">Semester</th>
                        <th style="width: 180px;">Tahun Akademik</th>
                        <th class="text-center" style="width: 100px;">Nilai Angka</th>
                        <th class="text-center" style="width: 100px;">Nilai Huruf</th>
                        <th class="text-center" style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no_detail = 1;
                    if ($total_matkul == 0) {
                    ?>
                        <tr>
                            <td colspan="7" style="text-align: center; color: #94a3b8; padding: 30px;">Mahasiswa ini belum memiliki riwayat nilai mata kuliah.</td>
                        </tr>
                    <?php 
                    } else {
                        while($row = mysqli_fetch_array($query_nilai)) { 
                            $grade_upper = strtoupper($row['Nilai_Huruf']);
                            $grade_class = "grade-" . $grade_upper;
                    ?>
                    <tr>
                        <td class="text-center" style="font-weight: 600; color: #64748b;"><?= $no_detail++; ?></td>
                        <td style="font-weight: 500; color: #334155;">📚 <?= $row['Nama_Matakuliah']; ?></td>
                        <td class="text-center" style="font-weight: 600; color: #2563eb;">Smstr <?= $row['Semester']; ?></td>
                        <td style="color: #64748b; font-weight: 500;"><?= $row['Tahun_Akademik']; ?></td>
                        <td class="text-center" style="font-weight: 700; color: #0f172a;"><?= number_format($row['Nilai_angka'], 0); ?></td>
                        <td class="text-center">
                            <span class="badge-grade <?= $grade_class; ?>"><?= $grade_upper; ?></span>
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                            <a href="tambah.php?id=<?= $row['Id_Nilai']; ?>" class="btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['Id_Nilai']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data nilai matkul ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>