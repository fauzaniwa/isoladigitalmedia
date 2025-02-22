<?php
// insert_notulensi.php

// Mulai sesi
session_start();

// Include the database connection file
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi input form
    $agenda = htmlspecialchars(trim($_POST['agenda']));
    $nomorRapat = htmlspecialchars(trim($_POST['nomorRapat']));
    $tanggal = htmlspecialchars(trim($_POST['tanggal']));
    $totalHadir = intval($_POST['totalHadir']);
    $link = isset($_POST['link']) ? htmlspecialchars(trim($_POST['link'])) : null;

    // Ambil informasi admin dari sesi
    $logged_in_admin_id = $_SESSION['admin_id'];
    $logged_in_admin_name = $_SESSION['admin_name'];

    // Handle file upload
    $uploadDir = '../public/src/filenotulensi/';
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Generate a new filename with timestamp
    $newFileName = time() . '_' . $fileName;

    // Set the target path for the uploaded file
    $dest_path = $uploadDir . $newFileName;

    // Check if the file is a valid PDF
    if ($fileExtension !== 'pdf') {
        // Redirect with an error status if the file is not a PDF
        header("Location: ../public/notulensi?status=invalid_file");
        exit();
    }

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Pindahkan file ke direktori target
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Siapkan pernyataan SQL untuk memasukkan data ke tabel notulensi
            $sql = "INSERT INTO notulensi (no_rapat, tgl_rapat, agenda, total_hadir, file, link, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssiss", $nomorRapat, $tanggal, $agenda, $totalHadir, $newFileName, $link);

            // Eksekusi pernyataan dan cek jika berhasil
            if ($stmt->execute()) {
                // Catat tindakan penambahan notulensi ke tabel history
                $action_type = "Insert Notulensi";
                $action_details = "Admin " . $logged_in_admin_name . " menambahkan notulensi dengan agenda: " . $agenda;
                $created_at = date('Y-m-d H:i:s');
                $sql_insert_history = "INSERT INTO history (admin_id, action_type, action_details, created_at) VALUES (?, ?, ?, ?)";
                $stmt_insert_history = $conn->prepare($sql_insert_history);
                $stmt_insert_history->bind_param("isss", $logged_in_admin_id, $action_type, $action_details, $created_at);
                $stmt_insert_history->execute();
                $stmt_insert_history->close();

                // Commit transaksi
                $conn->commit();

                // Redirect dengan status sukses
                header("Location: ../public/notulensi?status=success");
                exit();
            } else {
                throw new Exception("Error executing insert query.");
            }

            $stmt->close();
        } else {
            throw new Exception("Error uploading file.");
        }
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();

        // Redirect dengan status error
        header("Location: ../public/notulensi?status=error");
        exit();
    } finally {
        // Tutup koneksi
        $conn->close();
    }
} else {
    // Redirect dengan status invalid request jika bukan POST
    header("Location: ../public/notulensi?status=invalid_request");
    exit();
}
?>
