<?php
// Mengimpor koneksi dari file lain
require_once '../controllers/koneksi.php'; // Pastikan jalur ini sesuai dengan lokasi file koneksi.php Anda

// Ambil data dari permintaan POST
$nama = $_POST['nama'] ?? '';
$whatsapp = $_POST['whatsapp'] ?? '';
$email = $_POST['email'] ?? '';
$style_art = $_POST['style_art'] ?? '';
$frame_type = $_POST['frame_type'] ?? '';
$total_order = $_POST['total_order'] ?? '';
$current_image = $_POST['current_image'] ?? ''; // Menyimpan nama file gambar
$order_status = $_POST['order_status'] ?? 'Pending'; // Status pesanan default
$payment_method = $_POST['payment_method'] ?? ''; // Metode pembayaran
$created_at = date('Y-m-d H:i:s'); // Waktu dibuat
$updated_at = date('Y-m-d H:i:s'); // Waktu diperbarui

// Siapkan pernyataan untuk menyimpan data ke tabel photobooth
$stmt = $conn->prepare("INSERT INTO photobooth (nama, whatsapp, email, style_art, frame_type, total_order, img_real, img_art, order_status, payment_method, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $nama, $whatsapp, $email, $style_art, $frame_type, $total_order, $current_image, $current_image, $order_status, $payment_method, $created_at, $updated_at);

// Eksekusi pernyataan untuk menyimpan data photobooth
if ($stmt->execute()) {
    echo "Data berhasil disimpan!";

    // Mengurangi total_frame jika frame_type ada di tabel frame_artbooth
    $stmtFrame = $conn->prepare("UPDATE frame_artbooth SET total_frame = total_frame - 1 WHERE nama_frame = ?");
    $stmtFrame->bind_param("s", $frame_type);
    $stmtFrame->execute();
    $stmtFrame->close();

} else {
    echo "Kesalahan saat menyimpan data: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
