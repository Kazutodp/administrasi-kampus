<?php
include '../koneksi.php';

$judul = "Tambah Kontrak KRS (Multi Mata Kuliah)";
$tombol = "Simpan Semua KRS";

$list_mahasiswa = mysqli_query($koneksi, "SELECT NIM, Nama_Mahasiswa FROM mahasiswa");

$list_jadwal    = mysqli_query($koneksi, "SELECT jadwal.Id_Jadwal, matakuliah.Nama_Matakuliah, jadwal.Hari, jadwal.Jam 
                    FROM jadwal 
                    INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
                    ORDER BY jadwal.Hari ASC, jadwal.Jam ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; margin: 0; padding: 40px; color: #1e293b; }
        .form-wrapper { max-width: 650px; margin: 0 auto; }
        .btn-back { display: inline-flex; align-items: center; text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 20px; }
        .form-container { background-color: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
        .form-container h2 { margin: 0 0 8px 0; font-size: 22px; font-weight: 700; color: #0f172a; }
        .form-container p { margin: 0 0 24px 0; font-size: 14px; color: #64748b; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 14px; font-size: 14px; border-radius: 8px; border: 1px solid #cbd5e1; box-sizing: border-box; font-family: inherit; background-color: #ffffff; color: #0f172a; }

        .checkbox-container { max-height: 250px; overflow-y: auto; border: 1px solid #cbd5e1; border-radius: 8px; padding: 12px; background: #f8fafc; }
        .checkbox-item { display: flex; align-items: center; gap: 10px; padding: 8px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .checkbox-item:last-child { border-bottom: none; }
        .checkbox-item input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }

        .button-group { display: flex; gap: 12px; margin-top: 25px; }
        .btn-submit { flex: 1; padding: 12px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff; border: none; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; }
        .btn-cancel { display: inline-flex; justify-content: center; align-items: center; text-decoration: none; padding: 12px 24px; background-color: #ffffff; color: #64748b; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-weight: 600; }
    </style>
</head>
<body>

    <div class="form-wrapper">
        <a href="index.php" class="btn-back">⬅ Kembali ke Daftar</a>

        <div class="form-container">
            <h2><?= $judul; ?></h2>
            <p>Pilih mahasiswa dan centang semua mata kuliah yang ingin dikontrak sekaligus.</p>

            <form action="proses_tambah.php" method="POST">
                
                <div class="form-group">
                    <label>Pilih Mahasiswa</label>
                    <select name="nim" class="form-control" required style="color: #0f172a;">
                        <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                        <?php while($m = mysqli_fetch_array($list_mahasiswa)) { 
                            echo "<option value='".$m['NIM']."'>".$m['Nama_Mahasiswa']." (".$m['NIM'].")</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Mata Kuliah (Bisa Centang Banyak)</label>
                    <div class="checkbox-container">
                        <?php while($j = mysqli_fetch_array($list_jadwal)) { ?>
                            <div class="checkbox-item">
                                <input type="checkbox" name="id_jadwal[]" value="<?= $j['Id_Jadwal']; ?>" id="jdw_<?= $j['Id_Jadwal']; ?>">
                                <label style="display:inline; font-weight:500; cursor:pointer;" for="jdw_<?= $j['Id_Jadwal']; ?>">
                                    <strong><?= $j['Nama_Matakuliah']; ?></strong> — <?= $j['Hari']; ?> (<?= substr($j['Jam'], 0, 5); ?>)
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" class="form-control" required placeholder="Contoh: 2025/2026 Ganjil" value="2025/2026 Ganjil">
                </div>

                <div class="button-group">
                    <button type="submit" name="proses" class="btn-submit"><?= $tombol; ?></button>
                    <a href="index.php" class="btn-cancel">Batal</a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>