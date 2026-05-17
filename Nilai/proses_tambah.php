<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $id_nilai    = $_POST['id_nilai'];
    $id_krs      = $_POST['id_krs'];
    $nilai_angka = $_POST['nilai_angka'];
    $nilai_huruf = $_POST['nilai_huruf'];

    $cek = mysqli_query($koneksi, "SELECT * FROM nilai WHERE Id_Nilai = '$id_nilai'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE nilai SET 
                Id_KRS='$id_krs', 
                Nilai_angka='$nilai_angka', 
                Nilai_Huruf='$nilai_huruf' 
                WHERE Id_Nilai='$id_nilai'";
        $pesan = "Data Nilai Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO nilai (Id_Nilai, Id_KRS, Nilai_angka, Nilai_Huruf) VALUES ('$id_nilai', '$id_krs', '$nilai_angka', '$nilai_huruf')";
        $pesan = "Data Nilai Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses data Nilai! Error: " . mysqli_error($koneksi);
    }
}
?>