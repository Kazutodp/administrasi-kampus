<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Program Studi</title>
    </head>
    <body>
        <h2>Tambah Data Program Studi</h2>
        <a href="index.php">  Kembali</a>
        <br><br>

        <form action="proses_tambah.php" method="POST">
            <table>
                <tr>
                    <td>ID Prodi</td>
                    <td><input type="number" name="id_prodi" required></td>
                </tr>
                <tr>
                    <td>Nama Prodi</td>
                    <td><input type="text" name="nama_prodi" required></td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td><input type="text" name="fakultas" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="simpan">Simpan Data</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>