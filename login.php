<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'");
    
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['Username']; 

        echo "<script>alert('Login Berhasil! Selamat Datang " . $row['Username'] . "'); window.location='dashboard.php';</script>";
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f6f9; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .card-login { 
            width: 400px; 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        }
    </style>
</head>
<body>

<div class="card card-login p-4 bg-white">
    <div class="card-body">
        <h3 class="text-center fw-bold mb-3">SIAKAD LOGIN</h3>
        <p class="text-muted text-center small mb-4">Masukkan akun administrasi untuk mengakses sistem</p>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger text-center small p-2" role="alert">
                Username atau Password salah!
            </div>
        <?php } ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Contoh: admin" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 py-2 fw-bold">Masuk</button>
        </form>
    </div>
</div>

</body>
</html>