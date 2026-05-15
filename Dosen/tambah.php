<?php
include '../koneksi.php';

$nidn_edit = isset($_GET['nidn']) ? $_GET['nidn'] : '';
$data = ['NIDN' => '', 'Nama_Dosen' => '', 'Email' => ''];

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
<html>
    <head><title><?= $judul; ?></title></head>
    <body>
        <h2><?= $judul; ?></h2>
        <form action="proses_tambah.php" method="POST">
            <table cellpadding="8">
                <tr>
                    <td>NIDN</td>
                    <td><input type="text" name="nidn" value="<?= $data['NIDN']; ?>" <?= $readonly; ?> required></td>
                </tr>
                <tr>
                    <td>Nama Dosen</td>
                    <td><input type="text" name="nama_dosen" value="<?= $data['Nama_Dosen']; ?>" required size="30"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?= $data['Email']; ?>" required size="30"></td>
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