<?php
include '../koneksi.php';

$id_edit = isset($_GET['id']) ? $_GET['id'] : '';
$data = ['Id_KRS' => '', 'NIM' => '', 'Id_Jadwal' => '', 'Tahun_Akademik' => ''];

if ($id_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM krs WHERE Id_KRS = '$id_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Kontrak KRS";
    $tombol = "Update KRS";
    $readonly = "readonly"; 
} else {
    $judul = "Tambah Kontrak KRS";
    $tombol = "Simpan KRS";
    $readonly = "";
}

$list_mahasiswa = mysqli_query($koneksi, "SELECT NIM, Nama_Mahasiswa FROM mahasiswa");

$list_jadwal    = mysqli_query($koneksi, "SELECT jadwal.Id_Jadwal, matakuliah.Nama_Matakuliah, jadwal.Hari, jadwal.Jam 
                    FROM jadwal 
                    INNER JOIN matakuliah ON jadwal.Kode_Matakuliah = matakuliah.Kode_Matakuliah");
?>

<!DOCTYPE html>
<html>
<head><title><?= $judul; ?></title></head>
<body>
    <h2><?= $judul; ?></h2>
    <form action="proses_tambah.php" method="POST">
        <table cellpadding="8">
            <tr>
                <td>ID KRS</td>
                <td><input type="text" name="id_krs" value="<?= $data['Id_KRS']; ?>" <?= $readonly; ?> required placeholder="Contoh: KRS-001"></td>
            </tr>
            <tr>
                <td>Pilih Mahasiswa</td>
                <td>
                    <select name="nim" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php while($m = mysqli_fetch_array($list_mahasiswa)) { 
                            $select = ($data['NIM'] == $m['NIM']) ? 'selected' : '';
                            // Perubahan: Panggil key array ['Nama_Mahasiswa']
                            echo "<option value='".$m['NIM']."' $select>".$m['Nama_Mahasiswa']." (".$m['NIM'].")</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Pilih Jadwal Kuliah</td>
                <td>
                    <select name="id_jadwal" required>
                        <option value="">-- Pilih Jadwal Kelas --</option>
                        <?php while($j = mysqli_fetch_array($list_jadwal)) { 
                            $select = ($data['Id_Jadwal'] == $j['Id_Jadwal']) ? 'selected' : '';
                            echo "<option value='".$j['Id_Jadwal']."' $select>".$j['Nama_Matakuliah']." - ".$j['Hari']." (".$j['Jam'].")</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tahun Akademik</td>
                <td>
                    <input type="text" name="tahun_akademik" value="<?= $data['Tahun_Akademik']; ?>" required placeholder="Contoh: 2025/2026 Ganjil" size="25">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="proses"><?= $tombol; ?></button>
                    <a href="index.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>