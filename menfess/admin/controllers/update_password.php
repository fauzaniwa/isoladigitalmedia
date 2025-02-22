<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../public/login");
    exit();
}

// Mengambil ID admin dari session
$admin_id = $_SESSION['admin_id'];

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $passwordLama = $_POST['passwordLama'];
    $passwordBaru = $_POST['passwordBaru'];
    $passwordKonfirmasi = $_POST['passwordKonfirmasi'];

    // Validasi bahwa password baru dan konfirmasi password cocok
    if ($passwordBaru !== $passwordKonfirmasi) {
        header("Location: ../public/profile?status=error&message=Password%20baru%20dan%20konfirmasi%20tidak%20cocok");
        exit();
    }

    // Ambil password saat ini dari database
    $sql = "SELECT password FROM admins WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $stmt->bind_result($password_hashed);
        $stmt->fetch();
        $stmt->close();

        // Verifikasi password lama
        if (!password_verify($passwordLama, $password_hashed)) {
            header("Location: ../public/profile?status=error&message=Password%20lama%20tidak%20sesuai");
            exit();
        }

        // Hash password baru
        $passwordBaru_hashed = password_hash($passwordBaru, PASSWORD_DEFAULT);

        // Update password di database
        $update_sql = "UPDATE admins SET password = ? WHERE id = ?";
        if ($update_stmt = $conn->prepare($update_sql)) {
            $update_stmt->bind_param("si", $passwordBaru_hashed, $admin_id);

            if ($update_stmt->execute()) {
                header("Location: ../public/profile?status=success&message=Password%20berhasil%20diubah");
                exit();
            } else {
                header("Location: ../public/profile?status=error&message=Terjadi%20kesalahan%20saat%20mengubah%20password");
                exit();
            }
            $update_stmt->close();
        } else {
            header("Location: ../public/profile?status=error&message=Terjadi%20kesalahan%20dalam%20mengupdate%20password");
            exit();
        }
    } else {
        header("Location: ../public/profile?status=error&message=Terjadi%20kesalahan%20dalam%20mengambil%20data");
        exit();
    }
}

// Tutup koneksi
$conn->close();
?>
