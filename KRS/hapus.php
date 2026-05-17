<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_krs = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM krs WHERE Id_KRS = '$id_krs'");

    if ($hapus) {
        echo "<script>alert('Data KRS Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus data KRS: " . mysqli_error($koneksi);
    }
}
?>