<?php
require_once 'koneksi.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_photobooth = $_POST['id_photobooth'];
    $order_status = $_POST['order_status'];
    $payment_method = $_POST['payment_method'];
    
    // Query untuk mendapatkan nama file lama dari database
    $sql = "SELECT img_art FROM photobooth WHERE id_photobooth = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_photobooth);
    $stmt->execute();
    $stmt->bind_result($oldFileName);
    $stmt->fetch();
    $stmt->close();

    // Path direktori file
    $uploadDir = '../public/src/filephotobooth/'; // Sesuaikan dengan direktori yang Anda inginkan

    // Proses file upload
    $img_art = null;

    if (isset($_FILES['img_art']) && $_FILES['img_art']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['img_art'];
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
            // Hapus file lama jika ada
            if (!empty($oldFileName) && file_exists($uploadDir . $oldFileName)) {
                unlink($uploadDir . $oldFileName);
            }
            $img_art = $newFileName; // Set nama file baru untuk disimpan ke database
        } else {
            // Debugging error pada upload file
            $error = error_get_last();
            echo "Failed to upload file. Error: " . print_r($error, true);
            exit();
        }
    } else {
        // Jika tidak ada file baru yang diunggah, tetap gunakan nama file lama
        $img_art = $oldFileName;
    }

    // Query untuk mengupdate data photobooth
    $sql = "UPDATE photobooth SET order_status = ?, payment_method = ?, img_art = ?, updated_at = NOW() WHERE id_photobooth = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $order_status, $payment_method, $img_art, $id_photobooth);

    // Eksekusi statement dan redirect berdasarkan hasilnya
    if ($stmt->execute()) {
        // Redirect setelah berhasil menyimpan dengan status sukses
        header("Location: ../public/artbooth?status=success");
    } else {
        // Redirect dengan status gagal
        header("Location: ../public/artbooth?status=error");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    exit();
}
?>
