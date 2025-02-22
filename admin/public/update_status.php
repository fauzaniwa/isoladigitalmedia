<?php
include '../controllers/koneksi.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login");
    exit();
}

// Mengambil ID admin dari session
$admin_id = $_SESSION['admin_id'];

// Query untuk mengambil nama admin
$sql = "SELECT nama FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$stmt->bind_result($admin_name);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id'] ?? 0;
    $status = $_POST['status'] ?? 'pending';

    // Query untuk mengambil nama anggota dan email berdasarkan id
    $sql_anggota = "SELECT name, email FROM anggota WHERE id = ?";
    $stmt_anggota = $conn->prepare($sql_anggota);
    $stmt_anggota->bind_param("i", $id_anggota);
    $stmt_anggota->execute();
    $stmt_anggota->bind_result($anggota_name, $anggota_email);
    $stmt_anggota->fetch();
    $stmt_anggota->close();

    // Query untuk mengupdate kolom 'status' pada tabel 'anggota'
    $update_sql = "UPDATE `anggota` SET `status` = ? WHERE `id` = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $status, $id_anggota);
    $update_stmt->execute();

    // Jika update berhasil, catat ke tabel history
    $action_type = "Update Status";
    $action_details = "Admin " . $admin_name . " mengupdate status untuk anggota " . $anggota_name . " menjadi '" . $status . "'";
    $created_at = date('Y-m-d H:i:s'); // Waktu saat ini

    $history_query = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
    $history_stmt = $conn->prepare($history_query);
    $history_stmt->bind_param('isss', $admin_id, $action_type, $action_details, $created_at);
    $history_stmt->execute();
    $history_stmt->close();

    // Mengirim email jika status diperbarui
    $to = $anggota_email;
    $subject = "";
    $message = "";
    $headers = "From: info@isoladigitalmedia.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if ($status === 'diterima') {
        $subject = "Selamat, Kamu Diterima!";
        $message = "<p>Halo " . htmlspecialchars($anggota_name) . "! 🎉</p>
                    <p>Kamu berhasil melewati tahap seleksi dan diterima sebagai anggota IDM. Kami sangat senang menyambutmu!</p>
                    <p>Segera akses halaman berikut: <a href='https://register.isoladigitalmedia.com/login'>https://register.isoladigitalmedia.com/login</a> dan masuk grup WhatsApp untuk detail selanjutnya dan persiapan awal.</p>
                    <p>Sampai jumpa di pertemuan berikutnya!</p>";
    } elseif ($status === 'ditolak') {
        $subject = "Maaf, Kamu Belum Berhasil";
        $message = "<p>Halo " . htmlspecialchars($anggota_name) . ",</p>
                    <p>Tetap semangat ya! Jangan menyerah, setiap usaha mendekatkan kita pada kesuksesan. Kami menghargai partisipasimu dan berharap dapat melihatmu lagi di kesempatan berikutnya.</p>
                    <p>Akses halaman berikut: <a href='https://register.isoladigitalmedia.com/login'>https://register.isoladigitalmedia.com/login</a> untuk informasi lainnya.</p>";
    } elseif ($status === 'wawancara') {
        $subject = "Undangan Wawancara IDM";
        $message = "<p>Halo " . htmlspecialchars($anggota_name) . ",</p>
                    <p>Selamat! Kamu telah lolos ke tahap wawancara untuk bergabung dengan IDM. Kami mengundangmu untuk mengikuti sesi wawancara yang akan dilaksanakan pada:</p>
                    <p><strong>Waktu:</strong> 15 - 16 Oktober 2024<br>
                    <p>Mohon pastikan kehadiranmu dan konfirmasi dengan mengunjungi halaman berikut: <a href='https://register.isoladigitalmedia.com/login'>https://register.isoladigitalmedia.com/login</a>.</p>
                    <p>Selain itu, kamu juga diminta untuk bergabung dengan grup WhatsApp kami untuk informasi lebih lanjut: <a href='https://chat.whatsapp.com/Ep2QTLNWRfE2fDUFPaZkkV'>Bergabung ke Grup WhatsApp</a>.</p>
                    <p>Sampai jumpa di sesi wawancara!</p>";
    }

    // Mengirim email jika status adalah diterima, ditolak, atau wawancara
    if (in_array($status, ['diterima', 'ditolak', 'wawancara'])) {
        mail($to, $subject, $message, $headers);
    }

    // Mengirimkan respons ke klien jika diperlukan
    echo "Status updated to " . htmlspecialchars($status);
}


$conn->close();
?>
