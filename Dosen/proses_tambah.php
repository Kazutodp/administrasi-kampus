<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $nidn   = $_POST['nidn'];
    $nama   = $_POST['nama_dosen'];
    $email  = $_POST['email'];

    $cek = mysqli_query($koneksi, "SELECT * FROM dosen WHERE NIDN = '$nidn'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE dosen SET Nama_Dosen='$nama', Email='$email' WHERE NIDN='$nidn'";
        $pesan = "Data Dosen Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO dosen (NIDN, Nama_Dosen, Email) VALUES ('$nidn', '$nama', '$email')";
        $pesan = "Data Dosen Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>