<?php
include '../koneksi.php';

$query = "SELECT mahasiswa.*, prodi.Nama_Prodi 
        FROM mahasiswa 
        JOIN prodi ON mahasiswa.Id_Prodi = prodi.Id_Prodi";

$tampil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Data Mahasiswa</title>
        <style>
            table { border-collapse: collapse; width: 90%; margin-top: 20px; font-family: sans-serif; }
            th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Daftar Mahasiswa Aktif</h2>
        <a href="tambah.php" style="text-decoration: none; background: #2196F3; color: white; padding: 8px 15px; border-radius: 5px;">[+] Tambah Mahasiswa</a>

        <style>
            table { border-collapse: collapse; width: 90%; margin-top: 20px; font-family: sans-serif; }
            th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            .no-border {
                border: none !important;
                background-color: white !important; 
            }
        </style>

        <table>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th class="no-border"></th> </tr>
            <?php while($row = mysqli_fetch_array($tampil)) { ?>
            <tr>
                <td><?= $row['NIM']; ?></td>
                <td><?= $row['Nama_Mahasiswa']; ?></td>
                <td><?= $row['Nama_Prodi']; ?></td> 
                <td><?= $row['Jenis_Kelamin']; ?></td>
                <td><?= $row['Alamat']; ?></td>
                
                <td class="no-border" style="white-space: nowrap;"> 
                    <a href="tambah.php?nim=<?= $row['NIM']; ?>" style="text-decoration: none; color: blue;">Edit</a> | 
                    <a href="hapus.php?nim=<?= $row['NIM']; ?>" style="text-decoration: none; color: red;" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>