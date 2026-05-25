<?php
include '../koneksi.php';

$nidn_edit = isset($_GET['NIDN']) ? $_GET['NIDN'] : '';

$data = ['NIDN' => '', 'Nama_Dosen' => '', 'Jurusan' => '', 'Jenis_Kelamin' => '', 'Email' => ''];

if ($nidn_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM dosen WHERE NIDN = '$nidn_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Data Dosen";
    $tombol = "Update Dosen";
    $readonly = "readonly";
} else {
    $judul = "Tambah Data Dosen";
    $tombol = "Simpan Dosen";
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
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
                margin: 0; 
                padding: 40px; 
                color: #1e293b;
            }

            .form-wrapper {
                max-width: 550px;
                margin: 0 auto;
            }

            .btn-back {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                color: #64748b;
                font-size: 14px;
                font-weight: 600;
                margin-bottom: 20px;
                transition: color 0.2s ease;
            }

            .btn-back:hover {
                color: #0f172a;
            }

            .form-container {
                background-color: #ffffff;
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                border: 1px solid #e2e8f0;
            }

            .form-container h2 {
                margin: 0 0 8px 0;
                font-size: 22px;
                font-weight: 700;
                color: #0f172a;
            }

            .form-container p {
                margin: 0 0 24px 0;
                font-size: 14px;
                color: #64748b;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-size: 14px;
                font-weight: 600;
                color: #475569;
                margin-bottom: 8px;
            }

            .form-control {
                width: 100%;
                padding: 12px 14px;
                font-size: 14px;
                border-radius: 8px;
                border: 1px solid #cbd5e1;
                box-sizing: border-box;
                font-family: inherit;
                background-color: #ffffff !important;
                color: #0f172a !important;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
                background-color: #ffffff !important;
                color: #0f172a !important;
            }

            .form-control option {
                background-color: #ffffff !important; 
                color: #0f172a !important; 
                font-family: inherit;
                padding: 12px;
            }

            .form-control option:disabled,
            .form-control option[value=""] {
                color: #94a3b8 !important;
                background-color: #ffffff !important;
            }

            .form-control:read-only {
                background-color: #f8fafc;
                color: #94a3b8;
                cursor: not-allowed;
                border-color: #e2e8f0;
            }

            .button-group {
                display: flex;
                gap: 12px;
                margin-top: 25px;
            }

            .btn-submit {
                flex: 1;
                padding: 12px;
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: #ffffff;
                border: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 700;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
                transition: all 0.3s ease;
            }

            .btn-submit:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            }

            .btn-cancel {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                text-decoration: none;
                padding: 12px 24px;
                background-color: #ffffff;
                color: #64748b;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                transition: all 0.2s ease;
            }

            .btn-cancel:hover {
                background-color: #f8fafc;
                color: #0f172a;
                border-color: #94a3b8;
            }
        </style>
    </head>
    <body>
        <div class="form-wrapper">
            <a href="index.php" class="btn-back">⬅ Kembali ke Daftar Dosen</a>

            <div class="form-container">
                <h2><?= $judul; ?></h2>
                <p>Silakan isi informasi data diri dosen pengampu akademik di bawah ini secara lengkap.</p>

                <form action="proses_tambah.php" method="POST">
                    
                    <div class="form-group">
                        <label for="nidn">NIDN Dosen</label>
                        <input type="hidden" name="nidn" value="<?= $data['NIDN']; ?>">
                        <input type="text" id="nidn_display" class="form-control" value="<?= $data['NIDN']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_dosen">Nama Lengkap Dosen</label>
                        <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" placeholder="Contoh: Dr. Ahmad Subarjo, M.T." value="<?= $data['Nama_Dosen']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Program Studi (Prodi)</label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php
                            $q_prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
                            while($p = mysqli_fetch_array($q_prodi)) {
                                $selected = ($data['Id_Prodi'] == $p['Id_Prodi']) ? 'selected' : '';
                                echo "<option value='".$p['Id_Prodi']."' $selected>".$p['Nama_Prodi']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" <?= ($data['Jenis_Kelamin'] != '' && $data['Jenis_Kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($data['Jenis_Kelamin'] != '' && $data['Jenis_Kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email Resmi</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Contoh: ahmad.subarjo@kampus.ac.id" value="<?= $data['Email']; ?>" required>
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