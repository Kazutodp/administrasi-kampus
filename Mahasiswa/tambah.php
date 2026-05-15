<?php
include '../koneksi.php';
$nim_edit = isset($_GET['nim']) ? $_GET['nim'] : '';
$data = ['NIM' => '', 'Nama_Mahasiswa' => '', 'Id_Prodi' => '', 'Jenis_Kelamin' => '', 'Alamat' => ''];

if ($nim_edit != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim_edit'");
    $data = mysqli_fetch_array($query);
    $judul = "Edit Data Mahasiswa";
    $tombol = "Update Mahasiswa";
    $readonly = "readonly";
} else {
    $judul = "Tambah Data Mahasiswa";
    $tombol = "Simpan Mahasiswa";
    $readonly = "";
}
?>

<!DOCTYPE html>
<html>
<head><title><?= $judul; ?></title></head>
<body>
    <h2><?= $judul; ?></h2>
    <form action="proses_tambah.php" method="POST">
        <table>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" value="<?= $data['NIM']; ?>" <?= $readonly; ?> required></td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td><input type="text" name="nama_mahasiswa" value="<?= $data['Nama_Mahasiswa']; ?>" required></td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>
                    <select name="id_prodi" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php
                        $prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
                        while($p = mysqli_fetch_array($prodi)){
                            $select = ($p['Id_Prodi'] == $data['Id_Prodi']) ? 'selected' : '';
                            echo "<option value='".$p['Id_Prodi']."' $select>".$p['Nama_Prodi']."</option>";
                        }
                        ?>
                    </select>
                </td>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= $data['Jenis_Kelamin'] == 'Laki-laki' ? 'checked' : ''; ?>> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?= $data['Jenis_Kelamin'] == 'Perempuan' ? 'checked' : ''; ?>> Perempuan
                </td>
            </tr>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat"><?= $data['Alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="proses"><?= $tombol; ?></button></td>
            </tr>
        </table>
    </form>
</body>
</html>