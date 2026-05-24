<?php
include '../koneksi.php';
$query = mysqli_query($koneksi, "SELECT dosen.*, prodi.Nama_Prodi 
                                FROM dosen 
                                JOIN prodi ON dosen.Jurusan = prodi.id_prodi");
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Dosen - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
                margin: 0; 
                padding: 40px; 
                color: #1e293b;
            }

            .main-wrapper {
                max-width: 1300px;
                margin: 0 auto;
            }

            .header-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }

            .header-container h2 {
                margin: 0;
                font-size: 26px;
                font-weight: 700;
                color: #0f172a;
            }

            .header-container p {
                margin: 6px 0 0 0;
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
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
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
                padding: 18px 24px;
                border-bottom: 2px solid #e2e8f0;
            }

            td {
                padding: 18px 24px;
                font-size: 14px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
            }

            tr:hover td {
                background-color: #f8fafc;
            }

            .no-col { width: 60px; color: #94a3b8; font-weight: 600; }
            .nidn-col { width: 140px; font-weight: 600; color: #475569; }
            .name-col { width: 280px; font-weight: 600; color: #0f172a; }
            .prodi-col { width: 240px; font-weight: 500; color: #475569; }
            .jk-col { width: 160px; }
            .email-col { font-weight: 500; }

            .jk-badge {
                display: inline-block;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                text-align: center;
            }

            .jk-l { background-color: #e0f2fe; color: #0369a1; }
            .jk-p { background-color: #fce7f3; color: #be185d; }

            .email-link {
                color: #3b82f6;
                text-decoration: none;
            }

            .email-link:hover { text-decoration: underline; }
            .action-col { text-align: right; width: 130px; }
            .action-link { text-decoration: none; font-size: 14px; font-weight: 600; }
            .link-edit { color: #2563eb; }
            .link-delete { color: #ef4444; }
            .divider { color: #cbd5e1; margin: 0 8px; }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>

            <div class="header-container">
                <div>
                    <h2>Daftar Dosen Pengampu</h2>
                    <p>Manajemen data informasi dosen universitas, NIDN, program studi, jenis kelamin, serta email resmi.</p>
                </div>
                <a href="tambah.php" class="btn-add">[+] Tambah Dosen</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="no-col">No</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th class="action-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) { 
                            $jk = $row['Jenis_Kelamin'];
                            $jk_class = ($jk == 'Laki-laki' || $jk == 'L') ? 'jk-l' : 'jk-p';
                            $jk_text = ($jk == 'Laki-laki' || $jk == 'L') ? '♂ Laki-laki' : '♀ Perempuan';
                        ?>
                        <tr>
                            <td class="no-col"><?= $no++; ?>.</td>
                            <td class="nidn-col"><?= $row['NIDN']; ?></td>
                            <td class="name-col"><?= $row['Nama_Dosen']; ?></td>
                            
                            <td class="prodi-col"><?= $row['Nama_Prodi']; ?></td>
                            
                            <td class="jk-col">
                                <span class="jk-badge <?= $jk_class; ?>"><?= $jk_text; ?></span>
                            </td>
                            <td class="email-col">
                                <a href="mailto:<?= $row['Email']; ?>" class="email-link"><?= $row['Email']; ?></a>
                            </td>
                            
                            <td class="action-col" style="white-space: nowrap;"> 
                                <a href="tambah.php?NIDN=<?= $row['NIDN']; ?>" class="action-link link-edit">Edit</a>
                                <span class="divider">|</span>
                                <a href="hapus.php?NIDN=<?= $row['NIDN']; ?>" class="action-link link-delete" onclick="return confirm('Yakin ingin menghapus data dosen ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>