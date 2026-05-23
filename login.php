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
    <style>
        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card-login {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            text-align: center;
        }

        .card-login h3 {
            margin: 0 0 10px 0;
            color: #203a43;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .card-login p {
            font-size: 13px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .alert-danger {
            background-color: #ffeef0;
            color: #d9383a;
            border: 1px solid #fecdd3;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 22px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background-color: #f9fbfb;
        }

        .form-control:focus {
            border-color: #203a43;
            box-shadow: 0 0 0 4px rgba(32, 58, 67, 0.15);
            outline: none;
            background-color: #ffffff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #203a43 0%, #2c5364 100%);
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(32, 58, 67, 0.3);
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #1c333b 0%, #203a43 100%);
            box-shadow: 0 6px 16px rgba(32, 58, 67, 0.4);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>

<div class="card-login">
    <h3>SIAKAD LOGIN</h3>
    <p>Masukkan akun administrasi untuk mengakses sistem</p>

    <?php if (isset($error)) { ?>
        <div class="alert-danger">
            Username atau Password salah!
        </div>
    <?php } ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Contoh: admin" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" name="login" class="btn-submit">Masuk ke Sistem</button>
    </form>
</div>

</body>
</html>