<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM prodi");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Program Studi</title>
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
    
    <h2 style="margin-top: 15px;">Daftar Program Studi</h2>
    <a href="tambah.php" style="text-decoration: none; background: #2196F3; color: white; padding: 8px 15px; border-radius: 5px;">[+] Tambah Prodi</a>

    <table>
        <tr>
            <th>ID Prodi</th>
            <th>Nama Program Studi</th>
            <th class="no-border"></th>
        </tr>
        <?php while($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?= $row['Id_Prodi']; ?></td>
            <td><?= $row['Nama_Prodi']; ?></td>
            <td class="no-border" style="white-space: nowrap;"> 
                <a href="tambah.php?id=<?= $row['Id_Prodi']; ?>" style="text-decoration: none; color: blue;">Edit</a> | 
                <a href="hapus.php?id=<?= $row['Id_Prodi']; ?>" style="text-decoration: none; color: red;" onclick="return confirm('Yakin ingin menghapus prodi ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>