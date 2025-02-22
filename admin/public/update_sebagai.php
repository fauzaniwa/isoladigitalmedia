<?php
include('../controllers/koneksi.php');
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
    $id = $_POST['id'];
    $sebagai = $_POST['sebagai'];

    // Query untuk mengambil nama anggota berdasarkan id
    $sql_anggota = "SELECT name FROM anggota WHERE id = ?";
    $stmt_anggota = $conn->prepare($sql_anggota);
    $stmt_anggota->bind_param("i", $id);
    $stmt_anggota->execute();
    $stmt_anggota->bind_result($anggota_name);
    $stmt_anggota->fetch();
    $stmt_anggota->close();

    // Query untuk mengupdate kolom 'sebagai' pada tabel 'anggota'
    $query = "UPDATE anggota SET sebagai = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $sebagai, $id);

    if ($stmt->execute()) {
        echo "Sebagai updated successfully!";
        
        // Jika update berhasil, catat ke tabel history
        $action_type = "Update Posisi";
        $action_details = "Admin " . $admin_name . " mengupdate 'sebagai' untuk anggota " . $anggota_name . " menjadi '" . $sebagai . "'";
        $created_at = date('Y-m-d H:i:s'); // Format waktu saat ini

        $history_query = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
        $history_stmt = $conn->prepare($history_query);
        $history_stmt->bind_param('isss', $admin_id, $action_type, $action_details, $created_at);
        $history_stmt->execute();
        $history_stmt->close();
        
    } else {
        echo "Error updating sebagai.";
    }

    $stmt->close();
}

$conn->close();
?>
