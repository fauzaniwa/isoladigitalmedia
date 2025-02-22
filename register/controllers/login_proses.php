<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sertakan file koneksi database
include('koneksi.php');

// Mulai sesi
session_start();

// Ambil data dari formulir
$login = $_POST['login'];
$password = $_POST['password'];

// Tentukan apakah login adalah email atau username
$isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

if ($isEmail) {
    $sql = "SELECT * FROM anggota WHERE email = ?";
} else {
    $sql = "SELECT * FROM anggota WHERE username = ?";
}

// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Redirect ke halaman dashboard atau halaman lain
        header("Location: ../public/pengumuman");
        exit();
    } else {
        // Redirect jika password salah
        header("Location: ../public/login?status=invalid_password");
        exit();
    }
} else {
    // Redirect jika email/username tidak ditemukan
    header("Location: ../public/login?status=email_or_username_not_found");
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
