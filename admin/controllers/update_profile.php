<?php
// Mulai sesi untuk menangani session data
session_start();

// Hubungkan ke database
require_once 'koneksi.php';

// Periksa apakah metode permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']); // Hanya untuk validasi; tidak akan diubah
    $updated_at = date('Y-m-d H:i:s'); // Mendapatkan waktu saat ini untuk updated_at

    // Validasi input
    if (empty($name) || empty($email)) {
        $_SESSION['error'] = "Nama dan Email tidak boleh kosong!";
        header("Location: ../public/profile?status=error&message=Data%20profile%20gagal%20diubah.");
        exit;
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid!";
        header("Location: ../public/profile?status=error&message=Data%20profile%20gagal%20diubah.");
        exit;
    }

    // ID admin saat ini (misalnya disimpan dalam session)
    $admin_id = $_SESSION['admin_id'];

    // Update query
    $sql = "UPDATE admins SET nama = ?, email = ?, updated_at = ? WHERE id = ? AND role = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind variabel ke pernyataan sebagai parameter
        $stmt->bind_param("sssis", $name, $email, $updated_at, $admin_id, $role);

        if ($stmt->execute()) {
            header("Location: ../public/profile?status=success&message=Data%20profile%20berhasil%20diubah.");
            exit;
        } else {
            header("Location: ../public/profile?status=error&message=Data%20profile%20gagal%20diubah.");
            exit;
        }

        $stmt->close();
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika metode bukan POST, kembalikan ke halaman form
    header("Location: ../public/editprofile");
    exit;
}
?>
