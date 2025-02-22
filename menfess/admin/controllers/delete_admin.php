<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login dan memiliki role superadmin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || trim($_SESSION['admin_role']) !== 'superadmin') {
    header("Location: ../public/login");
    exit();
}

// Pastikan ID admin dikirimkan melalui POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $admin_id = intval($_POST['id']);

    // Hubungkan ke database
    require_once '../controllers/koneksi.php';

    // Ambil nama admin yang akan dihapus sebelum dihapus dari tabel
    $sql_admin_name = "SELECT nama FROM admins WHERE id = ?";
    $stmt_admin_name = $conn->prepare($sql_admin_name);
    $stmt_admin_name->bind_param("i", $admin_id);
    $stmt_admin_name->execute();
    $stmt_admin_name->bind_result($admin_name_to_delete);
    $stmt_admin_name->fetch();
    $stmt_admin_name->close();

    // Ambil informasi admin yang sedang melakukan penghapusan dari session
    $logged_in_admin_id = $_SESSION['admin_id'];
    $logged_in_admin_name = $_SESSION['admin_name'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus entri terkait di tabel history
        $sql_history = "DELETE FROM history WHERE admin_id = ?";
        if ($stmt_history = $conn->prepare($sql_history)) {
            $stmt_history->bind_param("i", $admin_id);
            $stmt_history->execute();
            $stmt_history->close();
        } else {
            throw new Exception("Error preparing history delete query.");
        }

        // Hapus admin dari tabel admins
        $sql_admin = "DELETE FROM admins WHERE id = ?";
        if ($stmt_admin = $conn->prepare($sql_admin)) {
            $stmt_admin->bind_param("i", $admin_id);
            $stmt_admin->execute();
            $stmt_admin->close();
        } else {
            throw new Exception("Error preparing admin delete query.");
        }

        // Catat tindakan penghapusan ke tabel history
        $action_type = "Delete Admin";
        $action_details = "Admin " . $logged_in_admin_name . " menghapus admin dengan nama " . $admin_name_to_delete;
        $created_at = date('Y-m-d H:i:s');
        $sql_insert_history = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
        $stmt_insert_history = $conn->prepare($sql_insert_history);
        $stmt_insert_history->bind_param("isss", $logged_in_admin_id, $action_type, $action_details, $created_at);
        $stmt_insert_history->execute();
        $stmt_insert_history->close();

        // Commit transaksi
        $conn->commit();

        // Redirect ke halaman admin dengan status sukses
        header("Location: ../public/admin?status=success_delete");
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();

        // Redirect ke halaman admin dengan status error
        header("Location: ../public/admin?status=error_delete");
    } finally {
        // Tutup koneksi
        $conn->close();
    }
} else {
    // Jika ID admin tidak ada
    header("Location: ../public/admin?status=error_delete");
}
?>
