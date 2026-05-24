<?php
include '../koneksi.php';

if (isset($_POST['proses'])) {
    $nim            = $_POST['nim'];
    $id_jadwal_arr  = isset($_POST['id_jadwal']) ? $_POST['id_jadwal'] : []; 
    $tahun_akademik = $_POST['tahun_akademik'];

    if (empty($id_jadwal_arr)) {
        echo "<script>alert('Gagal! Anda harus memilih minimal satu mata kuliah.'); window.history.back();</script>";
        exit;
    }

    $sukses = 0;
    foreach ($id_jadwal_arr as $id_jadwal) {
        $id_krs = "KRS-" . rand(100, 999) . substr(time(), -4);

        $query = "INSERT INTO krs (Id_KRS, NIM, Id_Jadwal, Tahun_Akademik) VALUES ('$id_krs', '$nim', '$id_jadwal', '$tahun_akademik')";
        
        if (mysqli_query($koneksi, $query)) {
            $sukses++;
        }
    }

    if ($sukses > 0) {
        echo "<script>alert('$sukses Mata Kuliah Berhasil Dikontrak Sekaligus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal memproses data KRS!";
    }
}
?>