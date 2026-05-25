<?php
include '../koneksi.php';
if (isset($_GET['NIDN'])) {
    $nidn = mysqli_real_escape_string($koneksi, $_GET['NIDN']);
    
    $hapus = mysqli_query($koneksi, "DELETE FROM dosen WHERE NIDN = '$nidn'");

    if ($hapus) {
        echo "<script>
                alert('Data Dosen Berhasil Dihapus!'); 
                window.location.href='index.php';
            </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: index.php");
    exit;
}
?>