<?php
include '../koneksi.php';

$nim = $_GET['nim'];

$query = "DELETE FROM mahasiswa WHERE NIM = '$nim'";
$hapus = mysqli_query($koneksi, $query);

if ($hapus) {
    echo "<script>
            alert('Data Berhasil Dihapus!');
            window.location='tampilan.php';
        </script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>