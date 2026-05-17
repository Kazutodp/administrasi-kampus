<?php
include '../koneksi.php';

$id_edit = isset($_GET['id']) ? $_GET['id'] : '';
$data = ['Id_Nilai' => '', 'Id_KRS' => '', 'Nilai_angka' => '', 'Nilai_Huruf' => ''];

if ($id_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM nilai WHERE Id_Nilai = '$id_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Nilai Mahasiswa";
    $tombol = "Update Nilai";
    $readonly = "readonly"; 
} else {
    $judul = "Input Nilai Mahasiswa";
    $tombol = "Simpan Nilai";
    $readonly = "";
}

$list_krs = mysqli_query($koneksi, "SELECT krs.Id_KRS, mahasiswa.Nama_Mahasiswa, matakuliah.Nama_Matakuliah 
            FROM krs
            INNER JOIN mahasiswa ON krs.NIM = mahasiswa.NIM
            INNER JOIN jadwal ON krs.Id_Jadwal = jadwal.Id_Jadwal
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
                <td>ID Nilai</td>
                <td><input type="text" name="id_nilai" value="<?= $data['Id_Nilai']; ?>" <?= $readonly; ?> required placeholder="Contoh: NLI-01"></td>
            </tr>
            <tr>
                <td>Kontrak KRS Mahasiswa</td>
                <td>
                    <select name="id_krs" required>
                        <option value="">-- Pilih Kontrak Mahasiswa --</option>
                        <?php while($k = mysqli_fetch_array($list_krs)) { 
                            $select = ($data['Id_KRS'] == $k['Id_KRS']) ? 'selected' : '';
                            echo "<option value='".$k['Id_KRS']."' $select>".$k['Nama_Mahasiswa']." - ".$k['Nama_Matakuliah']." (ID: ".$k['Id_KRS'].")</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nilai Angka</td>
                <td><input type="number" name="nilai_angka" value="<?= $data['Nilai_angka'] != '' ? number_format($data['Nilai_angka'], 0) : ''; ?>" required placeholder="0 - 100" min="0" max="100"></td>
            </tr>
            <tr>
                <td>Nilai Huruf</td>
                <td>
                    <select name="nilai_huruf" required>
                        <option value="">-- Pilih Nilai Huruf --</option>
                        <?php 
                        $huruf_arr = ['A', 'B', 'C', 'D', 'E'];
                        foreach($huruf_arr as $h) {
                            $select = ($data['Nilai_Huruf'] == $h) ? 'selected' : '';
                            echo "<option value='$h' $select>$h</option>";
                        }
                        ?>
                    </select>
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