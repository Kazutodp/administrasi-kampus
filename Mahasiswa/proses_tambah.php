<?php
include '../koneksi.php';

if (isset($_POST['simpan']) || isset($_POST['update'])) {

    $nim    = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_mahasiswa']);
    $prodi  = mysqli_real_escape_string($koneksi, $_POST['id_prodi']);
    $jk     = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE NIM = '$nim'");
    
    if (mysqli_num_rows($cek) > 0) {
        $query = "UPDATE mahasiswa SET 
                    Nama_Mahasiswa='$nama', 
                    Id_Prodi='$prodi', 
                    Jenis_Kelamin='$jk', 
                    Alamat='$alamat' 
                WHERE NIM='$nim'";
        $pesan = "Data Mahasiswa Berhasil Diperbarui!";
    } else {
        $query = "INSERT INTO mahasiswa (NIM, Nama_Mahasiswa, Id_Prodi, Jenis_Kelamin, Alamat) 
                VALUES ('$nim', '$nama', '$prodi', '$jk', '$alamat')";
        $pesan = "Data Mahasiswa Berhasil Disimpan!";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('$pesan'); 
                window.location='Tampilan.php';
            </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: Tampilan.php");
    exit();
}
?>