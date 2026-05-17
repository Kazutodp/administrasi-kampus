<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT nilai.*, 
        mahasiswa.Nama_Mahasiswa, 
        matakuliah.Nama_Matakuliah 
        FROM nilai
        INNER JOIN krs ON nilai.Id_KRS = krs.Id_KRS
        INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
        INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
        INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Nilai Mahasiswa</title>
    <style>
        table { border-collapse: collapse; width: 95%; margin-top: 20px; font-family: sans-serif; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .no-border { border: none !important; background-color: white !important; }
    </style>
</head>
<body>
    <a href="../dashboard.php" style="text-decoration: none; color: #555; font-weight: bold;">⬅ Kembali ke Dashboard</a>
    <h2>Daftar Nilai Akademik Mahasiswa</h2>
    <a href="tambah.php" style="text-decoration: none; background: #2196F3; color: white; padding: 8px 15px; border-radius: 5px;">[+] Input Nilai Baru</a>

    <table>
        <tr>
            <th>ID Nilai</th>
            <th>Nama Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th class="no-border"></th>
        </tr>
        <?php while($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?= $row['Id_Nilai']; ?></td>
            <td><?= $row['Nama_Mahasiswa']; ?></td>
            <td><?= $row['Nama_Matakuliah']; ?></td>
            <td><?= number_format($row['Nilai_angka'], 0); ?></td>
            <td><strong><?= $row['Nilai_Huruf']; ?></strong></td>
            <td class="no-border" style="white-space: nowrap;"> 
                <a href="tambah.php?id=<?= $row['Id_Nilai']; ?>" style="text-decoration: none; color: blue;">Edit</a> | 
                <a href="hapus.php?id=<?= $row['Id_Nilai']; ?>" style="text-decoration: none; color: red;" onclick="return confirm('Yakin ingin menghapus nilai ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>