<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

echo "<script>alert('Anda telah keluar dari sistem.'); window.location='login.php';</script>";
exit;
?>