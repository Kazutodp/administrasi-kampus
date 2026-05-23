<?php
include '../koneksi.php';

$is_edit = false;
$id_prodi = "";
$nama_prodi = "";
$fakultas = "";

if (isset($_GET['id'])) {
    $is_edit = true;
    $id_get = mysqli_real_escape_string($koneksi, $_GET['id']);

    $result = mysqli_query($koneksi, "SELECT * FROM prodi WHERE Id_Prodi = '$id_get'");
    if ($row = mysqli_fetch_assoc($result)) {
        $id_prodi   = $row['Id_Prodi'];
        $nama_prodi = $row['Nama_Prodi'];
        $fakultas   = $row['Fakultas'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $is_edit ? 'Edit' : 'Tambah'; ?> Program Studi - SIAKAD</title>
        <style>
            body { 
                background-color: #f1f5f9; 
                font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
                margin: 0; 
                padding: 0; 
                display: flex; 
                justify-content: center; 
                align-items: center; 
                min-height: 100vh; 
                color: #1e293b;
            }

            .form-container { 
                background-color: #ffffff; 
                padding: 40px; 
                border-radius: 16px; 
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); 
                width: 100%; 
                max-width: 480px; 
                box-sizing: border-box; 
            }

            .form-container h2 { 
                margin: 0 0 8px 0; 
                font-size: 24px; 
                font-weight: 700; 
                color: #0f172a; 
                text-align: center; 
            }

            .form-container .subtitle { 
                font-size: 13px; 
                color: #64748b; 
                text-align: center; 
                margin-bottom: 30px; 
            }

            .form-group { 
                margin-bottom: 20px; 
            }

            .form-group label { 
                display: block; 
                margin-bottom: 8px; 
                font-size: 13px; 
                font-weight: 600; 
                color: #475569; 
                text-transform: uppercase; l
                etter-spacing: 0.5px; 
            }

            .form-control { 
                width: 100%; 
                padding: 12px 16px; 
                border: 1px solid #cbd5e1; 
                border-radius: 8px; 
                font-size: 14px; 
                color: #334155; 
                box-sizing: border-box; 
                background-color: #f8fafc; 
                transition: all 0.3s ease; 
            }

            .form-control:focus { 
                border-color: #3b82f6; 
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15); 
                outline: none; 
                background-color: #ffffff; 
            }

            .form-control:disabled { 
                background-color: #e2e8f0; 
                color: #64748b; 
                cursor: not-allowed; 
            }

            .action-group { 
                display: flex; 
                gap: 12px; 
                margin-top: 30px; 
            }

            .btn-submit { 
                flex: 2; 
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
                color: #ffffff; 
                border: none; 
                padding: 14px; 
                border-radius: 8px; 
                font-size: 14px; 
                font-weight: 700; 
                cursor: pointer; 
                transition: all 0.3s ease; 
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); 
            }

            .btn-submit:hover { 
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); 
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4); 
                transform: translateY(-1px); 
            }

            .btn-cancel { 
                flex: 1; 
                text-decoration: none; 
                background-color: #f1f5f9; 
                color: #64748b; 
                border: 1px solid #e2e8f0; 
                padding: 14px; 
                border-radius: 8px; 
                font-size: 14px; 
                font-weight: 600; 
                text-align: center; 
                transition: all 0.2s ease; 
            }

            .btn-cancel:hover { 
                background-color: #e2e8f0; 
                color: #334155; 
            }
        </style>
    </head>
    <body>

        <div class="form-container">
            <h2><?= $is_edit ? 'Edit Data' : 'Tambah'; ?> Prodi</h2>
            <div class="subtitle"><?= $is_edit ? 'Perbarui informasi detail program studi' : 'Masukkan detail program studi baru secara lengkap'; ?></div>
            
            <form action="proses_tambah.php" method="POST">
                
                <div class="form-group">
                    <label for="id_prodi">ID Prodi</label>
                    <input type="number" id="id_prodi" name="id_prodi" class="form-control" 
                            placeholder="Contoh: 101" required autocomplete="off" 
                            value="<?= $id_prodi; ?>" <?= $is_edit ? 'readonly style="background-color: #e2e8f0; color: #64748b;"' : ''; ?>>
                </div>
                
                <div class="form-group">
                    <label for="nama_prodi">Nama Program Studi</label>
                    <input type="text" id="nama_prodi" name="nama_prodi" class="form-control" 
                            placeholder="Contoh: Teknik Informatika" required autocomplete="off"
                            value="<?= $nama_prodi; ?>">
                </div>
                
                <div class="form-group">
                    <label for="fakultas">Fakultas</label>
                    <input type="text" id="fakultas" name="fakultas" class="form-control" 
                            placeholder="Contoh: Fakultas Teknik" required autocomplete="off"
                            value="<?= $fakultas; ?>">
                </div>
                
                <div class="action-group">
                    <a href="index.php" class="btn-cancel">Batal</a>
                    <?php if ($is_edit) { ?>
                        <button type="submit" name="update" class="btn-submit">Simpan Perubahan</button>
                    <?php } else { ?>
                        <button type="submit" name="simpan" class="btn-submit">Simpan Data</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </body>
</html>