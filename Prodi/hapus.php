<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_prodi = mysqli_real_escape_string($koneksi, $_GET['id']);
    $hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE Id_Prodi = '$id_prodi'");

    if ($hapus) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data prodi: " . mysqli_error($koneksi);
    }
} else {
    header("Location: index.php");
    exit();
}
?>