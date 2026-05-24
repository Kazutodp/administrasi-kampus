<?php
include '../koneksi.php';

$kode_edit = isset($_GET['kode']) ? $_GET['kode'] : '';
$data = ['Kode_Matakuliah' => '', 'Nama_Matakuliah' => '', 'SKS' => '', 'semester' => '', 'Sifat_Matakuliah' => '', 'Jenis_Matakuliah' => ''];

if ($kode_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM matakuliah WHERE Kode_Matakuliah = '$kode_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Mata Kuliah";
    $tombol = "Update Mata Kuliah";
    $readonly = "readonly"; 
} else {
    $judul = "Tambah Mata Kuliah";
    $tombol = "Simpan Mata Kuliah";
    $readonly = "";
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $judul; ?></title>
        <style>
            body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; margin: 0; padding: 40px; color: #1e293b; }
            .form-wrapper { max-width: 550px; margin: 0 auto; }
            .btn-back { display: inline-flex; align-items: center; text-decoration: none; color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 20px; }
            .form-container { background-color: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; }
            .form-container h2 { margin: 0 0 8px 0; font-size: 22px; font-weight: 700; color: #0f172a; }
            .form-container p { margin: 0 0 24px 0; font-size: 14px; color: #64748b; }
            .form-group { margin-bottom: 20px; }
            .form-group label { display: block; font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px; }
            .form-control { width: 100%; padding: 12px 14px; font-size: 14px; border-radius: 8px; border: 1px solid #cbd5e1; box-sizing: border-box; font-family: inherit; background-color: #ffffff !important; color: #0f172a !important; }
            select.form-control { color: #94a3b8; }
            .form-control option { background-color: #ffffff !important; color: #0f172a !important; padding: 12px; }
            .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); background-color: #ffffff !important; }
            .form-control:read-only { background-color: #f8fafc; color: #94a3b8; cursor: not-allowed; border-color: #e2e8f0; }
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
                <p>Silakan lengkapi informasi mata kuliah akademik di bawah ini.</p>

                <form action="proses_tambah.php" method="POST">
                    
                    <div class="form-group">
                        <label>Kode Mata Kuliah</label>
                        <input type="text" name="kode_matakuliah" class="form-control" value="<?= $data['Kode_Matakuliah']; ?>" <?= $readonly; ?> required placeholder="Contoh: INF201" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" class="form-control" value="<?= $data['Nama_Matakuliah']; ?>" required placeholder="Contoh: Pemrograman Web">
                    </div>

                    <div class="form-group">
                        <label>Bobot SKS</label>
                        <select name="sks" class="form-control" required onchange="this.style.color='#0f172a'" style="<?= ($data['SKS'] != '') ? 'color:#0f172a;' : ''; ?>">
                            <option value="" disabled <?= ($data['SKS'] == '') ? 'selected' : ''; ?>>-- Pilih SKS --</option>
                            <?php
                            for ($i=1; $i<=6; $i++) {
                                $select = ($data['SKS'] == $i) ? 'selected' : '';
                                echo "<option value='$i' $select>$i SKS</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required onchange="this.style.color='#0f172a'" style="<?= ($data['semester'] != '') ? 'color:#0f172a;' : ''; ?>">
                            <option value="" disabled <?= ($data['semester'] == '') ? 'selected' : ''; ?>>-- Pilih Semester --</option>
                            <?php
                            for ($s=1; $s<=8; $s++) {
                                $select_sem = ($data['semester'] == $s) ? 'selected' : '';
                                echo "<option value='$s' $select_sem>Semester $s</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sifat Mata Kuliah</label>
                        <select name="sifat_matakuliah" class="form-control" required onchange="this.style.color='#0f172a'" style="<?= ($data['Sifat_Matakuliah'] != '') ? 'color:#0f172a;' : ''; ?>">
                            <option value="" disabled <?= ($data['Sifat_Matakuliah'] == '') ? 'selected' : ''; ?>>-- Pilih Sifat --</option>
                            <option value="Wajib" <?= ($data['Sifat_Matakuliah'] == 'Wajib') ? 'selected' : ''; ?>>Wajib</option>
                            <option value="Pilihan" <?= ($data['Sifat_Matakuliah'] == 'Pilihan') ? 'selected' : ''; ?>>Pilihan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Mata Kuliah</label>
                        <select name="jenis_matakuliah" class="form-control" required onchange="this.style.color='#0f172a'" style="<?= ($data['Jenis_Matakuliah'] != '') ? 'color:#0f172a;' : ''; ?>">
                            <option value="" disabled <?= ($data['Jenis_Matakuliah'] == '') ? 'selected' : ''; ?>>-- Pilih Jenis --</option>
                            <option value="Teori" <?= ($data['Jenis_Matakuliah'] == 'Teori') ? 'selected' : ''; ?>>Teori</option>
                            <option value="Praktikum" <?= ($data['Jenis_Matakuliah'] == 'Praktikum') ? 'selected' : ''; ?>>Praktikum</option>
                            <option value="Teori & Praktikum" <?= ($data['Jenis_Matakuliah'] == 'Teori & Praktikum') ? 'selected' : ''; ?>>Teori & Praktikum</option>
                        </select>
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