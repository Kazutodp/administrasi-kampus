<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $id_prodi   = mysqli_real_escape_string($koneksi, $_POST['id_prodi']);
    $nama_prodi = mysqli_real_escape_string($koneksi, $_POST['nama_prodi']);
    $fakultas   = mysqli_real_escape_string($koneksi, $_POST['fakultas']);

    $query  = "INSERT INTO prodi (Id_Prodi, Nama_Prodi, Fakultas) VALUES ('$id_prodi', '$nama_prodi', '$fakultas')";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script>
                alert('Data Berhasil Ditambahkan!');
                window.location='index.php';
            </script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['update'])) {
    $id_prodi   = mysqli_real_escape_string($koneksi, $_POST['id_prodi']);
    $nama_prodi = mysqli_real_escape_string($koneksi, $_POST['nama_prodi']);
    $fakultas   = mysqli_real_escape_string($koneksi, $_POST['fakultas']);

    $query  = "UPDATE prodi SET Nama_Prodi = '$nama_prodi', Fakultas = '$fakultas' WHERE Id_Prodi = '$id_prodi'";
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