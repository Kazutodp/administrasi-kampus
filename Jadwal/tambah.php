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

$list_matkul = mysqli_query($koneksi, "SELECT * FROM matakuliah");
$list_dosen  = mysqli_query($koneksi, "SELECT * FROM dosen");
?>

<!DOCTYPE html>
<html>
<head><title><?= $judul; ?></title></head>
<body>
    <h2><?= $judul; ?></h2>
    <form action="proses_tambah.php" method="POST">
        <table cellpadding="8">
            <tr>
                <td>ID Jadwal</td>
                <td><input type="text" name="id_jadwal" value="<?= $data['Id_Jadwal']; ?>" <?= $readonly; ?> required placeholder="Contoh: JDW-01"></td>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
                <td>
                    <select name="kode_matakuliah" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php while($m = mysqli_fetch_array($list_matkul)) { 
                            $select = ($data['Kode_Matakuliah'] == $m['Kode_Matakuliah']) ? 'selected' : '';
                            echo "<option value='".$m['Kode_Matakuliah']."' $select>".$m['Nama_Matakuliah']."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Dosen Pengampu</td>
                <td>
                    <select name="nidn_pengampu" required>
                        <option value="">-- Pilih Dosen --</option>
                        <?php while($d = mysqli_fetch_array($list_dosen)) { 
                            $select = ($data['NIDN_Pengampu'] == $d['NIDN']) ? 'selected' : '';
                            echo "<option value='".$d['NIDN']."' $select>".$d['Nama_Dosen']."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>
                    <select name="hari" required>
                        <option value="">-- Pilih Hari --</option>
                        <?php 
                        $hari_arr = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        foreach($hari_arr as $h) {
                            $select = ($data['Hari'] == $h) ? 'selected' : '';
                            echo "<option value='$h' $select>$h</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Jam Kuliah</td>
                <td>
                    <input type="time" name="jam_masuk" value="<?= $v_jam_masuk; ?>" style="width: 90px;" required>
                    <strong> s/d </strong>
                    <input type="time" name="jam_keluar" value="<?= $v_jam_keluar; ?>" style="width: 90px;" required>
                </td>
            </tr>
            
            <tr>
                <td>Ruang Kelas</td>
                <td><input type="text" name="ruang" value="<?= $data['Ruangan']; ?>" required placeholder="Contoh: Ruang 302 / Lab"></td>
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