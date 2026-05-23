<?php
include '../koneksi.php';

$nim_edit = isset($_GET['id']) ? $_GET['id'] : (isset($_GET['nim']) ? $_GET['nim'] : '');
$data = ['NIM' => '', 'Nama_Mahasiswa' => '', 'Id_Prodi' => '', 'Jenis_Kelamin' => '', 'Alamat' => ''];

$is_edit = false;
if ($nim_edit != '') {
    $is_edit = true;
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Data Mahasiswa";
    $sub_judul = "Perbarui profil dan informasi akademik mahasiswa aktif";
    $tombol_name = "update";
    $tombol_text = "Perbarui Data";
    $readonly = "readonly";
} else {
    $judul = "Tambah Mahasiswa";
    $sub_judul = "Masukkan informasi profil mahasiswa baru secara lengkap";
    $tombol_name = "simpan";
    $tombol_text = "Simpan Mahasiswa";
    $readonly = "";
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $judul; ?> - SIAKAD</title>
        <style>
            body {
                background-color: #f1f5f9;
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
                margin: 0;
                padding: 40px 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 80vh;
            }

            .form-container {
                background-color: #ffffff;
                width: 100%;
                max-width: 550px;
                padding: 40px;
                border-radius: 16px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
                border: 1px solid #e2e8f0;
            }

            .form-container h2 {
                margin: 0 0 6px 0;
                font-size: 24px;
                font-weight: 700;
                color: #0f172a;
            }

            .form-container .subtitle {
                margin-bottom: 32px;
                font-size: 14px;
                color: #64748b;
                line-height: 1.5;
            }

            .form-group {
                margin-bottom: 24px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-size: 14px;
                font-weight: 600;
                color: #334155;
            }

            .form-control {
                width: 100%;
                padding: 12px 16px;
                font-size: 14px;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                background-color: #fff;
                color: #334155;
                box-sizing: border-box;
                transition: all 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            }

            textarea.form-control {
                resize: vertical;
                min-height: 100px;
                font-family: inherit;
            }

            .radio-group {
                display: flex;
                gap: 24px;
                margin-top: 4px;
            }

            .radio-label {
                display: flex;
                align-items: center;
                font-size: 14px;
                color: #334155;
                cursor: pointer;
                font-weight: 500 !important;
            }

            .radio-label input {
                margin-right: 8px;
                width: 16px;
                height: 16px;
                accent-color: #3b82f6;
            }

            /* Bagian Aksi Tombol Bawah */
            .action-buttons {
                display: flex;
                justify-content: flex-end;
                gap: 12px;
                margin-top: 36px;
                border-top: 1px solid #f1f5f9;
                padding-top: 24px;
            }

            .btn-cancel {
                text-decoration: none;
                background-color: #fff;
                color: #64748b;
                padding: 12px 24px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                transition: all 0.2s ease;
            }

            .btn-cancel:hover {
                background-color: #f8fafc;
                color: #0f172a;
            }

            .btn-submit {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: #ffffff;
                border: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
                transition: all 0.2s ease;
            }

            .btn-submit:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.2);
            }
        </style>
    </head>
    <body>

        <div class="form-container">
            <h2><?= $judul; ?></h2>
            <div class="subtitle"><?= $sub_judul; ?></div>
            
            <form action="proses_tambah.php" method="POST">
                
                <div class="form-group">
                    <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" id="nim" name="nim" class="form-control" 
                        placeholder="Contoh: 210101001" required autocomplete="off"
                        value="<?= $data['NIM']; ?>" <?= $readonly; ?>
                        <?= $is_edit ? 'style="background-color: #f1f5f9; color: #64748b; cursor: not-allowed;"' : ''; ?>>
                </div>
                
                <div class="form-group">
                    <label for="nama_mahasiswa">Nama Lengkap</label>
                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" 
                        placeholder="Masukkan nama lengkap mahasiswa" required autocomplete="off"
                        value="<?= $data['Nama_Mahasiswa']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="id_prodi">Program Studi</label>
                    <select id="id_prodi" name="id_prodi" class="form-control" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <?php
                        $prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
                        while($p = mysqli_fetch_array($prodi)){
                            $select = ($p['Id_Prodi'] == $data['Id_Prodi']) ? 'selected' : '';
                            echo "<option value='".$p['Id_Prodi']."' $select>".$p['Nama_Prodi']."</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($data['Jenis_Kelamin'] == 'Laki-laki' || $data['Jenis_Kelamin'] == 'L') ? 'checked' : ''; ?> required>
                            Laki-laki
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($data['Jenis_Kelamin'] == 'Perempuan' || $data['Jenis_Kelamin'] == 'P') ? 'checked' : ''; ?>>
                            Perempuan
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat Domisili</label>
                    <textarea id="alamat" name="alamat" class="form-control" placeholder="Tuliskan alamat lengkap rumah..."><?= $data['Alamat']; ?></textarea>
                </div>
                
                <div class="action-buttons">
                    <a href="tampilan.php" class="btn-cancel">Batal</a>
                    <button type="submit" name="<?= $tombol_name; ?>" class="btn-submit"><?= $tombol_text; ?></button>
                </div>
            </form>
        </div>
    </body>
</html>