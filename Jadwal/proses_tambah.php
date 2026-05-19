<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $id_jadwal       = $_POST['id_jadwal'];
    $kode_matakuliah = $_POST['kode_matakuliah'];
    $nidn_pengampu   = $_POST['nidn_pengampu'];
    $hari            = $_POST['hari'];
    $ruang           = $_POST['ruang'];

    $jam_masuk  = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];

    $jam = $jam_masuk . " - " . $jam_keluar;
    // -------------------------

    $cek = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE Id_Jadwal = '$id_jadwal'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE jadwal SET 
                Kode_Matakuliah='$kode_matakuliah', 
                NIDN_Pengampu='$nidn_pengampu', 
                Hari='$hari', 
                Jam='$jam', 
                Ruangan='$ruang' 
                WHERE Id_Jadwal='$id_jadwal'";
        $pesan = "Jadwal Kuliah Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO jadwal (Id_Jadwal, Kode_Matakuliah, NIDN_Pengampu, Hari, Jam, Ruangan) VALUES ('$id_jadwal', '$kode_matakuliah', '$nidn_pengampu', '$hari', '$jam', '$ruang')";
        $pesan = "Jadwal Kuliah Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses jadwal! Error: " . mysqli_error($koneksi);
    }
}
?>