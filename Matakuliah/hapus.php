<?php
include '../koneksi.php';

if (isset($_GET['kode'])) {
    $kode_mk = $_GET['kode'];
    $hapus = mysqli_query($koneksi, "DELETE FROM matakuliah WHERE Kode_Matakuliah = '$kode_mk'");

    if ($hapus) {
        echo "<script>alert('Mata Kuliah Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }
}
?>