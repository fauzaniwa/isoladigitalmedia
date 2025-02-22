<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login");
    exit();
}

// Mengambil ID admin dari session
$admin_id = $_SESSION['admin_id'];

// Hubungkan ke database
require_once '../controllers/koneksi.php';

// Persiapkan variabel untuk menyimpan informasi admin
$admin_name = "";
$admin_email = "";
$admin_role = "";

// Ambil data admin dari database berdasarkan ID
$sql = "SELECT nama, email, role FROM admins WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind parameter ID ke pernyataan SQL
    $stmt->bind_param("i", $admin_id);

    // Jalankan pernyataan yang disiapkan
    if ($stmt->execute()) {
        // Ambil hasilnya
        $stmt->bind_result($admin_name, $admin_email, $admin_role);
        $stmt->fetch();

        // Set variabel sesi
        $_SESSION['admin_role'] = $admin_role;
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo "Error: Could not execute the query.";
        exit();
    }

    // Tutup pernyataan
    $stmt->close();
} else {
    // Jika query tidak bisa disiapkan
    echo "Error: Could not prepare the query.";
    exit();
}

// Sekarang variabel $admin_name, $admin_email, dan $admin_role telah diisi dengan data dari database
?>
