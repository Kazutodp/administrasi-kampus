<?php
include '../koneksi.php';

if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];
    $hapus = mysqli_query($koneksi, "DELETE FROM dosen WHERE NIDN = '$nidn'");

    if ($hapus) {
        echo "<script>alert('Dosen Berhasil Dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }
}
?>