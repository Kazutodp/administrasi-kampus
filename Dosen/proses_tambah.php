<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $nidn          = mysqli_real_escape_string($koneksi, $_POST['nidn']);
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama_dosen']);
    $jurusan       = mysqli_real_escape_string($koneksi, $_POST['jurusan']); // Ini adalah Id_Prodi
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']); 
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);

    $cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE NIDN = '$nidn'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE dosen SET 
                    Nama_Dosen='$nama', 
                    Id_Prodi='$jurusan', 
                    Jenis_Kelamin='$jenis_kelamin', 
                    Email='$email' 
                WHERE NIDN='$nidn'";
        $pesan = "Data Dosen Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO dosen (NIDN, Nama_Dosen, Id_Prodi, Jenis_Kelamin, Email) 
                VALUES ('$nidn', '$nama', '$jurusan', '$jenis_kelamin', '$email')";
        $pesan = "Data Dosen Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>