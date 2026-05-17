<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_nilai = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM nilai WHERE Id_Nilai = '$id_nilai'");

    if ($hapus) {
        echo "<script>alert('Data Nilai Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus data nilai: " . mysqli_error($koneksi);
    }
}
?>