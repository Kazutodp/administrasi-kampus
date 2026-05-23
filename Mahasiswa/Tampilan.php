<?php
include '../koneksi.php';

$query = "SELECT mahasiswa.*, prodi.Nama_Prodi 
        FROM mahasiswa 
        JOIN prodi ON mahasiswa.Id_Prodi = prodi.Id_Prodi";

$tampil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Mahasiswa - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
                margin: 0; 
                padding: 40px; 
                color: #1e293b;
            }

            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }

            .header-container h2 {
                margin: 0 0 4px 0;
                font-size: 26px;
                font-weight: 700;
                color: #0f172a;
            }

            .header-container p {
                margin: 0;
                font-size: 14px;
                color: #64748b;
            }

            .btn-back {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                margin-bottom: 16px;
                transition: color 0.2s ease;
            }

            .btn-back:hover {
                color: #0f172a;
            }

            .btn-add {
                text-decoration: none;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: #ffffff;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 700;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
                transition: all 0.3s ease;
            }

            .btn-add:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
                transform: translateY(-1px);
            }

            .table-container {
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                overflow: hidden;
                border: 1px solid #e2e8f0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            th {
                background-color: #f8fafc;
                color: #475569;
                font-size: 13px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                padding: 16px 24px;
                border-bottom: 2px solid #e2e8f0;
            }

            td {
                padding: 16px 24px;
                font-size: 14px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
            }

            tr:hover td {
                background-color: #f8fafc;
            }

            .no-col {
                text-align: center;
                color: #64748b;
                font-weight: 600;
                width: 50px;
            }

            .nim-col {
                font-weight: 600;
                color: #3b82f6;
            }

            .name-col {
                font-weight: 500;
                color: #0f172a;
            }

            .action-col {
                text-align: right;
            }

            .action-link {
                text-decoration: none;
                font-size: 14px;
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .link-edit {
                color: #2563eb;
            }

            .link-edit:hover {
                color: #1d4ed8;
                text-decoration: underline;
            }

            .link-delete {
                color: #ef4444;
            }

            .link-delete:hover {
                color: #dc2626;
                text-decoration: underline;
            }

            .divider {
                color: #cbd5e1;
                margin: 0 8px;
            }
        </style>
    </head>
    <body>

        <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>

        <div class="header-container">
            <div>
                <h2>Daftar Mahasiswa Aktif</h2>
                <p>Manajemen data profil, nomor induk mahasiswa, beserta program studi terkait.</p>
            </div>
            <a href="tambah.php" class="btn-add">[+] Tambah Mahasiswa</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th class="action-col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_array($tampil)) { 
                    ?>
                    <tr>
                        <td class="no-col"><?= $no++; ?></td>
                        <td class="nim-col"><?= $row['NIM']; ?></td>
                        <td class="name-col"><?= $row['Nama_Mahasiswa']; ?></td>
                        <td><?= $row['Nama_Prodi']; ?></td> 
                        <td><?= $row['Jenis_Kelamin'] == 'L' ? 'Laki-laki' : ($row['Jenis_Kelamin'] == 'P' ? 'Perempuan' : $row['Jenis_Kelamin']); ?></td>
                        <td style="color: #64748b;"><?= $row['Alamat']; ?></td>
                        
                        <td class="action-col" style="white-space: nowrap;"> 
                            <a href="tambah.php?id=<?= $row['NIM']; ?>" class="action-link link-edit">Edit</a>
                            <span class="divider">|</span>
                            <a href="hapus.php?id=<?= $row['NIM']; ?>" class="action-link link-delete" onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>