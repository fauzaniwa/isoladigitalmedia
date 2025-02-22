<?php
// Aktifkan tampilan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai sesi
session_start();

// Menghubungkan ke database
require_once './koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validasi form
if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
    echo '<script>alert("Semua field harus diisi."); window.location.href="../public/createaccount";</script>';
    exit();
}

if ($password !== $confirm_password) {
    echo '<script>alert("Password dan konfirmasi password tidak cocok."); window.location.href="../public/createaccount";</script>';
    exit();
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah email sudah ada di database
$sql = "SELECT id FROM admins WHERE email = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("Email sudah digunakan."); window.location.href="../public/createaccount";</script>';
        $stmt->close();
        exit();
    }
    $stmt->close();
} else {
    echo '<script>alert("Error: Tidak bisa mempersiapkan query."); window.location.href="../public/createaccount";</script>';
    exit();
}

// Masukkan data ke dalam database
$sql = "INSERT INTO admins (nama, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssss", $nama, $email, $hashed_password, $role);
    
    if ($stmt->execute()) {
        echo '<script>alert("Pendaftaran berhasil. Silakan login."); window.location.href="../public/login";</script>';
    } else {
        echo '<script>alert("Error: Tidak bisa mengeksekusi query."); window.location.href="../public/createaccount";</script>';
    }

    $stmt->close();
} else {
    echo '<script>alert("Error: Tidak bisa mempersiapkan query."); window.location.href="../public/createaccount";</script>';
}

$conn->close();
?>
