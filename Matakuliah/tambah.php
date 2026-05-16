<?php
include '../koneksi.php';

$kode_edit = isset($_GET['kode']) ? $_GET['kode'] : '';
$data = ['Kode_Matakuliah' => '', 'Nama_Matakuliah' => '', 'SKS' => '', 'semester' => ''];

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
<html>
<head><title><?= $judul; ?></title></head>
<body>
    <h2><?= $judul; ?></h2>
    <form action="proses_tambah.php" method="POST">
        <table cellpadding="8">
            <tr>
                <td>Kode Mata Kuliah</td>
                <td><input type="text" name="kode_matakuliah" value="<?= $data['Kode_Matakuliah']; ?>" <?= $readonly; ?> required placeholder="Contoh: INF201"></td>
            </tr>
            <tr>
                <td>Nama Mata Kuliah</td>
                <td><input type="text" name="nama_matakuliah" value="<?= $data['Nama_Matakuliah']; ?>" required size="30"></td>
            </tr>
            <tr>
                <td>SKS</td>
                <td>
                    <select name="sks" required>
                        <option value="">-- Pilih SKS --</option>
                        <?php
                        for ($i=1; $i<=6; $i++) {
                            $select = ($data['SKS'] == $i) ? 'selected' : '';
                            echo "<option value='$i' $select>$i SKS</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>
                    <select name="semester" required>
                        <option value="">-- Pilih Semester --</option>
                        <?php
                        for ($s=1; $s<=8; $s++) {
                            $select_sem = ($data['semester'] == $s) ? 'selected' : '';
                            echo "<option value='$s' $select_sem>Semester $s</option>";
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