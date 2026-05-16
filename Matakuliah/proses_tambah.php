<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $kode_mk   = $_POST['kode_matakuliah'];
    $nama_mk   = $_POST['nama_matakuliah'];
    $sks       = $_POST['sks'];
    $semester  = $_POST['semester'];

    $cek = mysqli_query($koneksi, "SELECT * FROM matakuliah WHERE Kode_Matakuliah = '$kode_mk'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE matakuliah SET 
                Nama_Matakuliah='$nama_mk', 
                SKS='$sks', 
                semester='$semester' 
                WHERE Kode_Matakuliah='$kode_mk'";
        $pesan = "Mata Kuliah Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO matakuliah (Kode_Matakuliah, Nama_Matakuliah, SKS, semester) 
                VALUES ('$kode_mk', '$nama_mk', '$sks', '$semester')";
        $pesan = "Mata Kuliah Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses data! Error: " . mysqli_error($koneksi);
    }
}
?>