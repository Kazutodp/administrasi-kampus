<?php
include '../koneksi.php';

$id_edit = isset($_GET['id']) ? $_GET['id'] : '';
$data = ['Id_Jadwal' => '', 'Kode_Matakuliah' => '', 'NIDN_Pengampu' => '', 'Hari' => '', 'Jam' => '', 'Ruangan' => ''];

$v_jam_masuk = "";
$v_jam_keluar = "";

if ($id_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Id_Jadwal = '$id_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Jadwal Kuliah";
    $tombol = "Update Jadwal";
    $readonly = "readonly"; 

    if (!empty($data['Jam'])) {
        $pecah_jam = explode(" - ", $data['Jam']);
        $v_jam_masuk  = isset($pecah_jam[0]) ? trim($pecah_jam[0]) : "";
        $v_jam_keluar = isset($pecah_jam[1]) ? trim($pecah_jam[1]) : "";
    }
} else {
    $judul = "Tambah Jadwal Kuliah";
    $tombol = "Simpan Jadwal";
    $readonly = "";
}

$list_matkul = mysqli_query($koneksi, "SELECT * FROM matakuliah ORDER BY semester ASC, Nama_Matakuliah ASC");
$list_dosen  = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY Nama_Dosen ASC");
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
            .form-control { width: 100%; padding: 12px 14px; font-size: 14px; border-radius: 8px; border: 1px solid #cbd5e1; box-sizing: border-box; font-family: inherit; background-color: #ffffff; color: #0f172a; }
            .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); }
            .form-control:read-only { background-color: #f8fafc; color: #94a3b8; cursor: not-allowed; border-color: #e2e8f0; }

            select.form-control {
                color: #0f172a !important;
            }
            select.form-control option {
                color: #0f172a !important;
                background-color: #ffffff;
            }
            select.form-control option:disabled {
                color: #94a3b8 !important;
            }

            .time-group { display: flex; align-items: center; gap: 10px; }
            .time-group input { width: 120px !important; text-align: center; }
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
                <p>Silakan kelola pembagian waktu perkuliahan di bawah ini.</p>

                <form action="proses_tambah.php" method="POST">
                    
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" name="id_jadwal" class="form-control" value="<?= $data['Id_Jadwal']; ?>" <?= $readonly; ?> required placeholder="Contoh: JDW-01" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()">
                    </div>

                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <select name="kode_matakuliah" class="form-control" required>
                            <option value="" disabled <?= ($data['Kode_Matakuliah'] == '') ? 'selected' : ''; ?>>-- Pilih Mata Kuliah --</option>
                            <?php while($m = mysqli_fetch_array($list_matkul)) { 
                                $select = ($data['Kode_Matakuliah'] == $m['Kode_Matakuliah']) ? 'selected' : '';
                                echo "<option value='".$m['Kode_Matakuliah']."' $select>Semester ".$m['semester']." - ".$m['Nama_Matakuliah']."</option>";
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dosen Pengampu</label>
                        <select name="nidn_pengampu" class="form-control" required>
                            <option value="" disabled <?= ($data['NIDN_Pengampu'] == '') ? 'selected' : ''; ?>>-- Pilih Dosen --</option>
                            <?php while($d = mysqli_fetch_array($list_dosen)) { 
                                $select = ($data['NIDN_Pengampu'] == $d['NIDN']) ? 'selected' : '';
                                echo "<option value='".$d['NIDN']."' $select>".$d['Nama_Dosen']."</option>";
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                            <option value="" disabled <?= ($data['Hari'] == '') ? 'selected' : ''; ?>>-- Pilih Hari --</option>
                            <?php 
                            $hari_arr = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            foreach($hari_arr as $h) {
                                $select = ($data['Hari'] == $h) ? 'selected' : '';
                                echo "<option value='$h' $select>$h</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jam Perkuliahan</label>
                        <div class="time-group">
                            <input type="time" name="jam_masuk" class="form-control" value="<?= $v_jam_masuk; ?>" required>
                            <span style="font-weight: 600; color: #64748b;">s/d</span>
                            <input type="time" name="jam_keluar" class="form-control" value="<?= $v_jam_keluar; ?>" required>
                            <span style="font-weight: 600; color: #475569; font-size: 14px;">WITA</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ruangan Kelas</label>
                        <input type="text" name="ruang" class="form-control" value="<?= $data['Ruangan']; ?>" required placeholder="Contoh: Ruang 302 / Lab Komputer">
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