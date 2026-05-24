<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_krs = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM krs WHERE Id_KRS = '$id_krs'");
    
    if ($query) {
        echo "<script>alert('Satu mata kuliah berhasil dibatalkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal membatalkan mata kuliah: " . mysqli_error($koneksi) . "'); window.location='index.php';</script>";
    }
} 

elseif (isset($_GET['nim']) && isset($_GET['tahun'])) {
    $nim = $_GET['nim'];
    $tahun_akademik = urldecode($_GET['tahun']);

    $query = mysqli_query($koneksi, "DELETE FROM krs WHERE NIM = '$nim' AND Tahun_Akademik = '$tahun_akademik'");
    
    if ($query) {
        echo "<script>alert('Semua kontrak KRS mahasiswa tersebut berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus semua KRS: " . mysqli_error($koneksi) . "'); window.location='index.php';</script>";
    }
} 

else {
    header("Location: index.php");
    exit;
}
?>