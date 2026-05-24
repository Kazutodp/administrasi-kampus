<?php
include '../koneksi.php';

$filter_nim = "";
$is_filtered = false;
if (isset($_GET['nim_mhs'])) {
    $is_filtered = true;
    $nim_terkunci = $_GET['nim_mhs'];
    $filter_nim = "WHERE krs.NIM = '$nim_terkunci'";
}

$mahasiswa_krs = mysqli_query($koneksi, "SELECT krs.Id_KRS, krs.NIM, mahasiswa.Nama_Mahasiswa, matakuliah.Nama_Matakuliah, matakuliah.Semester 
    FROM krs 
    INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
    INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
    INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
    $filter_nim");

$is_edit = false;
$id_nilai = "";
$id_krs_selected = "";
$nilai_angka = "";
$nilai_huruf = "";

if (isset($_GET['id'])) {
    $is_edit = true;
    $id_nilai = $_GET['id'];

    $query_lama = mysqli_query($koneksi, "SELECT * FROM nilai WHERE Id_Nilai = '$id_nilai'");
    $data_lama = mysqli_fetch_array($query_lama);
    
    if ($data_lama) {
        $id_krs_selected = $data_lama['Id_KRS'];
        $nilai_angka = $data_lama['Nilai_angka'];
        $nilai_huruf = $data_lama['Nilai_Huruf'];

        $mahasiswa_krs = mysqli_query($koneksi, "SELECT krs.Id_KRS, krs.NIM, mahasiswa.Nama_Mahasiswa, matakuliah.Nama_Matakuliah, matakuliah.Semester 
            FROM krs 
            INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
            INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
            INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah
            WHERE krs.Id_KRS = '$id_krs_selected'");
    }
}

if (isset($_POST['simpan'])) {
    $id_krs = $_POST['id_krs'];
    $angka = $_POST['nilai_angka'];
    $huruf = $_POST['nilai_huruf'];

    $cari_nim = mysqli_query($koneksi, "SELECT NIM FROM krs WHERE Id_KRS = '$id_krs'");
    $data_krs = mysqli_fetch_array($cari_nim);
    $back_nim = $data_krs['NIM'];

    if ($is_edit) {
        $query_aksi = mysqli_query($koneksi, "UPDATE nilai SET 
            Id_KRS = '$id_krs', 
            Nilai_angka = '$angka', 
            Nilai_Huruf = '$huruf' 
            WHERE Id_Nilai = '$id_nilai'");
        $pesan = "Data nilai berhasil diperbarui!";
    } else {
        $query_aksi = mysqli_query($koneksi, "INSERT INTO nilai (Id_KRS, Nilai_angka, Nilai_Huruf) 
            VALUES ('$id_krs', '$angka', '$huruf')");
        $pesan = "Data nilai baru berhasil ditambahkan!";
    }

    if ($query_aksi) {
        echo "<script>alert('$pesan'); window.location='detail_nilai.php?nim=$back_nim';</script>";
    } else {
        echo "<script>alert('Gagal memproses data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? "Edit" : "Input" ?> Nilai Mahasiswa</title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, sans-serif; padding: 40px; color: #1e293b; }
        .form-card { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        h2 { margin-top: 0; color: #0f172a; font-size: 22px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px; color: #475569; }
        select, input { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-size: 14px; background-color: #fff; }
        select:disabled { background-color: #f8fafc; color: #64748b; cursor: not-allowed; }
        .btn-submit { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-weight: 600; cursor: pointer; margin-top: 10px; }
        .btn-cancel { display: block; text-align: center; text-decoration: none; color: #64748b; font-size: 14px; margin-top: 15px; font-weight: 500; }
    </style>
</head>
<body>

<div class="form-card">
    <h2><?= $is_edit ? "📝 Edit Nilai Akademik" : "➕ Input Nilai Akademik Baru" ?></h2>
    
    <form action="" method="POST">
        <div class="form-group">
            <label>Pilih Mahasiswa & Mata Kuliah</label>
            <select name="id_krs" required>
                <?php if(!$is_filtered && !$is_edit) { ?>
                    <option value="">-- Pilih Mahasiswa --</option>
                <?php } ?>
                
                <?php 
                $count = 0;
                while($krs = mysqli_fetch_array($mahasiswa_krs)) { 
                    $count++;
                ?>
                    <option value="<?= $krs['Id_KRS']; ?>" <?= ($krs['Id_KRS'] == $id_krs_selected || $is_filtered) ? 'selected' : ''; ?>>
                        <?= $krs['NIM']; ?> - <?= $krs['Nama_Mahasiswa']; ?> (Smstr <?= $krs['Semester']; ?> - <?= $krs['Nama_Matakuliah']; ?>)
                    </option>
                <?php } ?>

                <?php if($count == 0) { ?>
                    <option value="">-- Tidak ada pilihan KRS tersedia --</option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Nilai Angka</label>
            <input type="number" name="nilai_angka" min="0" max="100" placeholder="Contoh: 85" value="<?= $nilai_angka; ?>" required>
        </div>

        <div class="form-group">
            <label>Nilai Huruf</label>
            <select name="nilai_huruf" required>
                <option value="">-- Pilih Grade --</option>
                <option value="A" <?= $nilai_huruf == 'A' ? 'selected' : ''; ?>>A</option>
                <option value="B" <?= $nilai_huruf == 'B' ? 'selected' : ''; ?>>B</option>
                <option value="C" <?= $nilai_huruf == 'C' ? 'selected' : ''; ?>>C</option>
                <option value="D" <?= $nilai_huruf == 'D' ? 'selected' : ''; ?>>D</option>
                <option value="E" <?= $nilai_huruf == 'E' ? 'selected' : ''; ?>>E</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn-submit">
            <?= $is_edit ? "Simpan Perubahan" : "Tambahkan Nilai Baru" ?>
        </button>
        
        <a href="javascript:window.history.back();" class="btn-cancel">Batal</a>
    </form>
</div>

</body>
</html>