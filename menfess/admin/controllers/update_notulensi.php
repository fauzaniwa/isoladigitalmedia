<?php
require_once 'koneksi.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $idNotulensi = $_POST['id_notulensi'];
    $nomorRapat = $_POST['nomorRapat'];
    $tanggalRapat = $_POST['tanggal'];
    $agenda = $_POST['agenda'];
    $totalHadir = $_POST['totalHadir'];
    $link = isset($_POST['link']) ? $_POST['link'] : null;

    // Query untuk mendapatkan nama file lama dari database
    $sql = "SELECT file FROM notulensi WHERE id_notulensi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idNotulensi);
    $stmt->execute();
    $stmt->bind_result($oldFileName);
    $stmt->fetch();
    $stmt->close();

    // Path direktori file
    $uploadDir = '../public/src/filenotulensi/';

    // Hapus file lama jika ada
    if (!empty($oldFileName) && file_exists($uploadDir . $oldFileName)) {
        unlink($uploadDir . $oldFileName);
    }

    // Proses file upload
    $file = $_FILES['file'];
    $fileName = null;

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $originalFileName = basename($file['name']);
        $timestamp = time(); // Mendapatkan timestamp saat ini
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Mendapatkan ekstensi file
        $newFileName = $timestamp . "_" . $originalFileName; // Membuat nama file baru dengan timestamp
        $destPath = $uploadDir . $newFileName;

        // Pastikan direktori ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Proses upload file baru
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $fileName = $newFileName; // Set nama file baru untuk disimpan ke database
        } else {
            // Debugging error pada upload file
            $error = error_get_last();
            echo "Failed to upload file. Error: " . print_r($error, true);
            exit();
        }
    } else {
        // Jika tidak ada file baru yang diunggah, tetap gunakan nama file lama
        $fileName = $oldFileName;
    }

    // Query untuk mengupdate data notulensi
    $sql = "UPDATE notulensi SET no_rapat = ?, tgl_rapat = ?, agenda = ?, total_hadir = ?, file = ?, link = ?, updated_at = NOW() WHERE id_notulensi = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssissi', $nomorRapat, $tanggalRapat, $agenda, $totalHadir, $fileName, $link, $idNotulensi);

    // Eksekusi statement dan redirect berdasarkan hasilnya
    if ($stmt->execute()) {
        // Redirect setelah berhasil menyimpan dengan status sukses
        header("Location: ../public/notulensi?status=success");
    } else {
        // Redirect dengan status gagal
        header("Location: ../public/notulensi?status=error");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    exit();
}
?>
