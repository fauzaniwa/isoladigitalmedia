<?php
// Menghubungkan ke database
require_once '../controllers/koneksi.php';

// Memeriksa apakah ada data 'id' yang dikirimkan melalui POST
if (isset($_POST['id'])) {
    // Mengambil nilai 'id' dari data POST dan melakukan sanitasi
    $id = intval($_POST['id']); // Konversi ke integer untuk keamanan

    // Menyiapkan pernyataan SQL untuk menghapus data
    $sql = "DELETE FROM mutual WHERE id = ?";
    
    // Menyiapkan pernyataan menggunakan prepared statement
    $stmt = $conn->prepare($sql);
    
    // Mengecek apakah pernyataan berhasil disiapkan
    if ($stmt) {
        // Mengikat parameter dan menjalankan pernyataan
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Redirect ke halaman sebelumnya dengan pesan sukses
            header("Location: ../public/mutual.php?status=delete_success");
            exit();
        } else {
            // Redirect ke halaman sebelumnya dengan pesan error
            header("Location: ../public/mutual.php?status=delete_failed");
            exit();
        }
    } else {
        // Redirect ke halaman sebelumnya jika statement gagal disiapkan
        header("Location: ../public/mutual.php?status=delete_error");
        exit();
    }
} else {
    // Redirect ke halaman sebelumnya jika 'id' tidak ditemukan
    header("Location: ../public/mutual.php?status=no_id_provided");
    exit();
}

// Menutup koneksi
$conn->close();
?>
