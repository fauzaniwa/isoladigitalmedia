<?php
require_once '../controllers/koneksi.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    // Ambil ID dari parameter URL
    $id_photobooth = $_GET['id'];

    // Query untuk menghapus data photobooth berdasarkan ID
    $sql = "DELETE FROM photobooth WHERE id_photobooth = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_photobooth);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Redirect setelah berhasil menghapus dengan status sukses
        header("Location: ../public/artbooth?status=deleted");
    } else {
        // Redirect dengan status gagal
        header("Location: ../public/artbooth?status=error");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    // Jika ID tidak ada, redirect dengan status error
    header("Location: ../public/artbooth?status=invalid");
}
exit();
?>
