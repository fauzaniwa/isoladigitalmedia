<?php
require_once 'koneksi.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID dari form
    $idNotulensi = $_POST['id'];

    // Query untuk mendapatkan nama file dari database
    $sql = "SELECT file FROM notulensi WHERE id_notulensi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idNotulensi);
    $stmt->execute();
    $stmt->bind_result($fileName);
    $stmt->fetch();
    $stmt->close();

    // Path direktori file
    $uploadDir = '../public/src/filenotulensi/';

    // Hapus file dari direktori jika ada
    if (!empty($fileName) && file_exists($uploadDir . $fileName)) {
        if (!unlink($uploadDir . $fileName)) {
            // Jika gagal menghapus file, tampilkan pesan error
            echo "Error: Unable to delete the file.";
            exit();
        }
    }

    // Query untuk menghapus data dari tabel notulensi
    $sql = "DELETE FROM notulensi WHERE id_notulensi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idNotulensi);

    // Eksekusi statement dan redirect berdasarkan hasilnya
    if ($stmt->execute()) {
        // Redirect setelah berhasil menghapus dengan status sukses
        header("Location: ../public/notulensi?status=success_delete");
    } else {
        // Redirect dengan status gagal
        header("Location: ../public/notulensi?status=error_delete");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    exit();
}
?>
