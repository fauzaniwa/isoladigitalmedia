<?php
// Mulai sesi
session_start();

// Include database connection
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $no_surat = htmlspecialchars(trim($_POST['no_surat']));
    $keterangan = htmlspecialchars(trim($_POST['keterangan']));

    // Ambil informasi admin dari sesi
    $logged_in_admin_id = $_SESSION['admin_id'];
    $logged_in_admin_name = $_SESSION['admin_name'];

    // Handle file upload
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Generate a new file name with timestamp
    $timestamp = time(); // Current timestamp
    $newFileName = $timestamp . "_" . $file_name; // New file name
    $upload_dir = '../public/src/filesurat/';
    $destPath = $upload_dir . basename($newFileName);

    // Allowed file extensions
    $allowed_extensions = array('pdf');

    // Validate file extension
    if (in_array($file_ext, $allowed_extensions)) {
        // Mulai transaksi
        $conn->begin_transaction();

        try {
            // Pindahkan file yang diupload ke direktori upload dengan nama baru
            if (move_uploaded_file($file_tmp, $destPath)) {
                // Siapkan dan bind pernyataan SQL untuk memasukkan data ke tabel surat
                $stmt = $conn->prepare("INSERT INTO surat (no_surat, ket_surat, file_surat) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $no_surat, $keterangan, $newFileName);

                // Eksekusi query
                if ($stmt->execute()) {
                    // Catat tindakan penambahan surat ke tabel history
                    $action_type = "Insert Surat";
                    $action_details = "Admin " . $logged_in_admin_name . " menambahkan surat dengan nomor: " . $no_surat;
                    $created_at = date('Y-m-d H:i:s');
                    $sql_insert_history = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
                    $stmt_insert_history = $conn->prepare($sql_insert_history);
                    $stmt_insert_history->bind_param("isss", $logged_in_admin_id, $action_type, $action_details, $created_at);
                    $stmt_insert_history->execute();
                    $stmt_insert_history->close();

                    // Commit transaksi
                    $conn->commit();

                    // Redirect dengan status sukses
                    header("Location: ../public/nomor_surat?status=success");
                    exit();
                } else {
                    throw new Exception("Error executing insert query.");
                }

                // Tutup pernyataan
                $stmt->close();
            } else {
                throw new Exception("Error uploading file.");
            }
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $conn->rollback();

            // Redirect dengan status error
            header("Location: ../public/nomor_surat?status=error");
            exit();
        } finally {
            // Tutup koneksi
            $conn->close();
        }
    } else {
        // Redirect dengan status error jika ekstensi file tidak valid
        header("Location: ../public/nomor_surat?status=error");
        exit();
    }
}

// Redirect jika bukan request POST
header("Location: ../public/nomor_surat?status=error");
exit();
?>
