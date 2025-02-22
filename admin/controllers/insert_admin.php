<?php
// Include file koneksi.php
include './koneksi.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login");
    exit();
}

// Mengambil ID admin dari session
$admin_id = $_SESSION['admin_id'];

// Query untuk mengambil nama admin yang sedang login
$sql_admin = "SELECT nama FROM admins WHERE id = ?";
$stmt_admin = $conn->prepare($sql_admin);
$stmt_admin->bind_param("i", $admin_id);
$stmt_admin->execute();
$stmt_admin->bind_result($admin_name);
$stmt_admin->fetch();
$stmt_admin->close();

// Mendapatkan data dari form
$nama = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Menghindari SQL Injection
$nama = $conn->real_escape_string($nama);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
$role = $conn->real_escape_string($role);

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Mendapatkan timestamp untuk created_at dan updated_at
$created_at = date('Y-m-d H:i:s');
$updated_at = $created_at;

// Menyimpan data ke database
$sql = "INSERT INTO admins (nama, email, password, role, created_at, updated_at) 
        VALUES ('$nama', '$email', '$hashed_password', '$role', '$created_at', '$updated_at')";

if ($conn->query($sql) === TRUE) {
    // Jika penyimpanan berhasil, catat ke tabel history
    $action_type = "Add Admin";
    $action_details = "Admin " . $admin_name . " menambahkan admin baru dengan nama " . $nama . " dan peran " . $role;
    $history_query = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
    $history_stmt = $conn->prepare($history_query);
    $history_stmt->bind_param('isss', $admin_id, $action_type, $action_details, $created_at);
    $history_stmt->execute();
    $history_stmt->close();

    header("Location: ../public/admin?status=success");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
