<?php
include '../koneksi.php';

if (isset($_GET['nidn'])) {
    $nidn = mysqli_real_escape_string($koneksi, $_GET['nidn']);
    
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