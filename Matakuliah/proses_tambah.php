<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $kode_mk   = strtoupper(mysqli_real_escape_string($koneksi, trim($_POST['kode_matakuliah'])));
    $nama_mk   = mysqli_real_escape_string($koneksi, trim($_POST['nama_matakuliah']));
    $sks       = intval($_POST['sks']);
    $semester  = intval($_POST['semester']);
    $sifat_mk  = mysqli_real_escape_string($koneksi, $_POST['sifat_matakuliah']);
    $jenis_mk  = mysqli_real_escape_string($koneksi, $_POST['jenis_matakuliah']);

    if ($sks < 1 || $sks > 6 || $semester < 1 || $semester > 8) {
        echo "<script>alert('Data SKS atau Semester tidak valid!'); window.history.back();</script>";
        exit;
    }

    $cek = mysqli_query($koneksi, "SELECT * FROM matakuliah WHERE Kode_Matakuliah = '$kode_mk'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE matakuliah SET 
                Nama_Matakuliah='$nama_mk', 
                SKS='$sks', 
                semester='$semester',
                Sifat_Matakuliah='$sifat_mk',
                Jenis_Matakuliah='$jenis_mk'
                WHERE Kode_Matakuliah='$kode_mk'";
        $pesan = "Mata Kuliah Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO matakuliah (Kode_Matakuliah, Nama_Matakuliah, SKS, semester, Sifat_Matakuliah, Jenis_Matakuliah) 
                VALUES ('$kode_mk', '$nama_mk', '$sks', '$semester', '$sifat_mk', '$jenis_mk')";
        $pesan = "Mata Kuliah Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses data! Error: " . mysqli_error($koneksi);
    }
}
?>