<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM prodi");
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Program Studi - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
                margin: 0;
                padding: 40px;
                color: #1e293b;
            }

            .btn-back {
                text-decoration: none; 
                color: #64748b; 
                font-weight: 600; 
                font-size: 14px;
                transition: color 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }
            .btn-back:hover {
                color: #1e293b;
            }

            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
                margin-bottom: 25px;
            }
            .header-container h2 {
                margin: 0;
                font-size: 26px;
                font-weight: 700;
                color: #0f172a;
            }

            .btn-add {
                text-decoration: none; 
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
                color: white; 
                padding: 10px 20px; 
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
                transition: all 0.3s ease;
            }
            .btn-add:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
            }

            .table-container {
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
                padding: 10px;
                overflow: hidden;
            }

            table { 
                border-collapse: collapse; 
                width: 100%; 
                font-size: 15px;
            }
            th, td { 
                padding: 16px 20px; 
                text-align: left; 
            }

            th { 
                background-color: #f8fafc; 
                color: #64748b; 
                font-weight: 600;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 2px solid #e2e8f0;
            }

            tr {
                border-bottom: 1px solid #f1f5f9;
                transition: background-color 0.2s ease;
            }
            tr:last-child {
                border-bottom: none;
            }
            tr:hover { 
                background-color: #f8fafc; 
            }

            td.id-col {
                font-weight: 600;
                color: #64748b;
                width: 15%;
            }

            .action-link {
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
                padding: 5px 12px;
                border-radius: 6px;
                transition: all 0.2s ease;
            }
            .link-edit {
                color: #2563eb;
                background-color: #eff6ff;
            }
            .link-edit:hover {
                color: #ffffff;
                background-color: #2563eb;
            }
            .link-delete {
                color: #dc2626;
                background-color: #fef2f2;
            }
            .link-delete:hover {
                color: #ffffff;
                background-color: #dc2626;
            }

            .action-col {
                text-align: right;
                width: 20%;
            }
            .divider {
                color: #cbd5e1;
                margin: 0 4px;
            }
        </style>
    </head>
    <body>

        <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
        
        <div class="header-container">
            <h2>Daftar Program Studi</h2>
            <a href="tambah.php" class="btn-add">[+] Tambah Prodi</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Prodi</th>
                        <th>Nama Program Studi</th>
                        <th>Fakultas</th> <th class="action-col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td class="id-col"><?= $row['Id_Prodi']; ?></td>
                        <td style="font-weight: 500; color: #0f172a;"><?= $row['Nama_Prodi']; ?></td>
                        <td style="color: #475569;"><?= $row['Fakultas']; ?></td>
                        <td class="action-col" style="white-space: nowrap;"> 
                            <a href="tambah.php?id=<?= $row['Id_Prodi']; ?>" class="action-link link-edit">Edit</a>
                            <span class="divider"></span>
                            <a href="hapus.php?id=<?= $row['Id_Prodi']; ?>" class="action-link link-delete" onclick="return confirm('Yakin ingin menghapus prodi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>