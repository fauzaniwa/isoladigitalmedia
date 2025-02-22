<?php
// Sertakan koneksi database
include '../process/koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $menfess_id = $_POST['menfess_id'];
    $content = trim($_POST['content']);
    $created_at = date('Y-m-d H:i:s'); // Tanggal dan waktu saat ini
    $ip_sender = $_SERVER['REMOTE_ADDR']; // IP pengguna

    // Generate username acak
    $username = 'user' . rand(10000, 99999);

    // Query untuk menyisipkan komentar ke database
    $query = "
        INSERT INTO comment (menfess_id, username, content, created_at, IP_Sender)
        VALUES (?, ?, ?, ?, ?)
    ";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'issss', $menfess_id, $username, $content, $created_at, $ip_sender);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, kembali ke halaman menfess
        header("Location: clicked.php?id=$menfess_id&success=true");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada request POST, redirect ke halaman utama
    header('Location: index.php');
    exit;
}
?>
