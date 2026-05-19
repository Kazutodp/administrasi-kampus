<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT jadwal.*, 
        matakuliah.Nama_Matakuliah, 
        dosen.Nama_Dosen 
        FROM jadwal
        INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
        INNER JOIN dosen ON jadwal.NIDN_Pengampu = dosen.NIDN");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Kuliah</title>
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
    <h2>Jadwal Perkuliahan Kampus</h2>
    <a href="tambah.php" style="text-decoration: none; background: #2196F3; color: white; padding: 8px 15px; border-radius: 5px;">[+] Tambah Jadwal</a>

    <table>
        <tr>
            <th>ID Jadwal</th>
            <th>Mata Kuliah</th>
            <th>Dosen Pengampu</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Ruang</th>
            <th class="no-border"></th>
        </tr>
        <?php while($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?= $row['Id_Jadwal']; ?></td>
            <td><?= $row['Nama_Matakuliah']; ?> (<?= $row['Kode_Matakuliah']; ?>)</td>
            <td><?= $row['Nama_Dosen']; ?></td>
            <td><?= $row['Hari']; ?></td>
            <td><?= $row['Jam']; ?> WITA</td>
            <td><?= $row['Ruangan']; ?></td> <td class="no-border" style="white-space: nowrap;"> 
                <a href="tambah.php?id=<?= $row['Id_Jadwal']; ?>" style="text-decoration: none; color: blue;">Edit</a> | 
                <a href="hapus.php?id=<?= $row['Id_Jadwal']; ?>" style="text-decoration: none; color: red;" onclick="return confirm('Yakin mau hapus jadwal ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>