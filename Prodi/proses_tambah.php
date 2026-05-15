<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {

    $id_prodi   = $_POST['id_prodi'];
    $nama_prodi = $_POST['nama_prodi'];
    $fakultas   = $_POST['fakultas'];

    $query = "INSERT INTO prodi (Id_Prodi, Nama_Prodi, Fakultas) 
            VALUES ('$id_prodi', '$nama_prodi', '$fakultas')";

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>
                alert('Data Berhasil Disimpan!');
                window.location='index.php';
            </script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>