<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mahasiswa'];
    $prodi = $_POST['id_prodi'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE mahasiswa SET Nama_Mahasiswa='$nama', Id_Prodi='$prodi', Jenis_Kelamin='$jk', Alamat='$alamat' WHERE NIM='$nim'";
        $pesan = "Data Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO mahasiswa (NIM, Nama_Mahasiswa, Id_Prodi, Jenis_Kelamin, Alamat) VALUES ('$nim', '$nama', '$prodi', '$jk', '$alamat')";
        $pesan = "Data Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>