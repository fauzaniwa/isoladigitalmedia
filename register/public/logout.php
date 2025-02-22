<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus sesi
session_destroy();

// Redirect ke halaman login
header("Location: ../public/login.php");
exit();
?>
