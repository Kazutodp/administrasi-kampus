<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $id_krs         = $_POST['id_krs'];
    $nim            = $_POST['nim'];
    $id_jadwal      = $_POST['id_jadwal'];
    $tahun_akademik = $_POST['tahun_akademik'];

    $cek = mysqli_query($koneksi, "SELECT * FROM krs WHERE Id_KRS = '$id_krs'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE krs SET 
                NIM='$nim', 
                Id_Jadwal='$id_jadwal', 
                Tahun_Akademik='$tahun_akademik' 
                WHERE Id_KRS='$id_krs'";
        $pesan = "Data KRS Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO krs (Id_KRS, NIM, Id_Jadwal, Tahun_Akademik) VALUES ('$id_krs', '$nim', '$id_jadwal', '$tahun_akademik')";
        $pesan = "Data KRS Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('$pesan'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses data KRS! Error: " . mysqli_error($koneksi);
    }
}
?>