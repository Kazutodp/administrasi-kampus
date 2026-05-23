<?php
include '../koneksi.php';

$nim = isset($_GET['id']) ? $_GET['id'] : (isset($_GET['nim']) ? $_GET['nim'] : '');

if ($nim != '') {
    $nim = mysqli_real_escape_string($koneksi, $nim);

    $query = "DELETE FROM mahasiswa WHERE NIM = '$nim'";
    $hapus = mysqli_query($koneksi, $query);

    if ($hapus) {
        echo "<script>
                alert('Data Mahasiswa Berhasil Dihapus!');
                window.location='tampilan.php';
            </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>
            alert('ID / NIM tidak ditemukan!');
            window.location='tampilan.php';
        </script>";
}
?>