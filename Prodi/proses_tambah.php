<?php
include '../koneksi.php';

if (isset($_POST['update'])) {
    $id_prodi   = $_POST['id_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    $fakultas   = $_POST['fakultas'];

    $query = "UPDATE prodi SET 
                Nama_Prodi = '$nama_prodi', 
                Fakultas = '$fakultas' 
                WHERE Id_Prodi = '$id_prodi'";

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo "<script>
                alert('Data Berhasil Diperbarui!');
                window.location='index.php';
            </script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>