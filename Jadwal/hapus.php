<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_jadwal = mysqli_real_escape_string($koneksi, $_GET['id']);
    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal WHERE Id_Jadwal = '$id_jadwal'");

    if ($hapus) {
        echo "<script>alert('Jadwal Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus jadwal: " . mysqli_error($koneksi);
    }
}
?>