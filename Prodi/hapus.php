<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_prodi = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE Id_Prodi = '$id_prodi'");

    if ($hapus) {
        echo "<script>alert('Data Prodi Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus data prodi: " . mysqli_error($koneksi);
    }
}
?>