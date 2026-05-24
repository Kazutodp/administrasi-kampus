<?php
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT 
        krs.NIM,
        mahasiswa.Nama_Mahasiswa AS Nama_Mahasiswa, 
        krs.Tahun_Akademik,
        GROUP_CONCAT(matakuliah.Nama_Matakuliah SEPARATOR '||') AS Semua_Matakuliah,
        GROUP_CONCAT(CONCAT(jadwal.Hari, ' (', SUBSTR(jadwal.Jam, 1, 5), ')') SEPARATOR '||') AS Semua_Waktu,
        GROUP_CONCAT(krs.Id_KRS SEPARATOR '||') AS Semua_Id_KRS
        FROM krs
        INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
        INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
        INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
        GROUP BY krs.NIM, krs.Tahun_Akademik");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KRS Mahasiswa</title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; margin: 0; padding: 40px; color: #1e293b; }
        .container { max-width: 1200px; margin: 0 auto; }
        .btn-back { display: inline-flex; align-items: center; text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 20px; transition: color 0.2s; }
        .btn-back:hover { color: #0f172a; }
        
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .header-section h2 { margin: 0; font-size: 24px; font-weight: 700; color: #0f172a; }
        
        .btn-add { display: inline-flex; align-items: center; text-decoration: none; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2); transition: opacity 0.2s; }
        .btn-add:hover { opacity: 0.9; }

        .table-container { background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background-color: #f8fafc; color: #64748b; font-weight: 600; padding: 16px 20px; border-bottom: 2px solid #e2e8f0; }
        td { padding: 16px 20px; color: #334155; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }

        .text-center { text-align: center; }
        .badge-nim { font-weight: 600; color: #0f172a; }

        details { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 12px; }
        summary { font-weight: 600; color: #3b82f6; cursor: pointer; outline: none; user-select: none; }
        summary:hover { color: #1d4ed8; }
        .matkul-list { margin-top: 8px; padding-left: 0; list-style: none; border-top: 1px solid #e2e8f0; padding-top: 6px; }
        .matkul-list li { padding: 4px 0; font-size: 13px; color: #475569; display: flex; justify-content: space-between; }

        .btn-delete { text-decoration: none; color: #ef4444; font-weight: 600; transition: color 0.2s; }
        .btn-delete:hover { color: #b91c1c; }
    </style>
</head>
<body>

    <div class="container">
        <a href="../dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
        
        <div class="header-section">
            <h2>Kartu Rencana Studi (KRS) Mahasiswa</h2>
            <a href="tambah.php" class="btn-add">➕ Tambah Kontrak KRS</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tahun Akademik</th>
                        <th style="width: 450px;">Mata Kuliah yang Diambil</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($query) == 0) { 
                    ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #94a3b8; padding: 30px;">Belum ada kontrak KRS mahasiswa.</td>
                        </tr>
                    <?php 
                    } else {
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) { 
                            $arr_matkul = explode('||', $row['Semua_Matakuliah']);
                            $arr_waktu  = explode('||', $row['Semua_Waktu']);
                            $arr_id_krs = explode('||', $row['Semua_Id_KRS']);
                            $total_matkul = count($arr_matkul);
                    ?>
                    <tr>
                        <td class="text-center" style="font-weight: 600; color: #64748b;"><?= $no++; ?>.</td>
                        <td><span class="badge-nim"><?= $row['NIM']; ?></span></td>
                        <td style="font-weight: 500; color: #0f172a;"><?= $row['Nama_Mahasiswa']; ?></td>
                        <td><?= $row['Tahun_Akademik']; ?></td>
                        <td>
                            <details>
                                <summary>Lihat <?= $total_matkul; ?> Mata Kuliah</summary>
                                <ul class="matkul-list">
                                    <?php for($i = 0; $i < $total_matkul; $i++) { ?>
                                        <li>
                                            <span>📚 <?= $arr_matkul[$i]; ?> <small style="color:#94a3b8;"></small></span>
                                            <a href="hapus.php?id=<?= $arr_id_krs[$i]; ?>" class="btn-delete" style="font-size:11px;" onclick="return confirm('Batalkan mata kuliah ini?')">Batalkan</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </details>
                        </td>
                        <td class="text-center"> 
                            <a href="hapus.php?nim=<?= $row['NIM']; ?>&tahun=<?= urlencode($row['Tahun_Akademik']); ?>" class="btn-delete" onclick="return confirm('Yakin ingin MENGHAPUS SEMUA kontrak KRS mahasiswa ini di semester ini?')">Hapus Semua</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>