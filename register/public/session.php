<?php
// Mulai sesi
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada sesi user_id, redirect ke halaman login
    header("Location: ../public/login.php");
    exit();
}
?>
