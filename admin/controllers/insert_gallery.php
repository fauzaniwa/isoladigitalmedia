<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uploadDir = '../public/src/gallery/';
        $currentTime = date('Y-m-d H:i:s');

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $judul = $_POST['judul'][$key];
            $fileName = $_FILES['images']['name'][$key];
            $fileTmpName = $_FILES['images']['tmp_name'][$key];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            // Buat nama file baru dengan format timestamp_namafile
            $newFileName = time() . '_' . basename($fileName);
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpName, $uploadFile)) {
                // Query untuk insert ke database
                $stmt = $conn->prepare("INSERT INTO gallery (judul, nama_file, created_at) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $judul, $newFileName, $currentTime);

                if (!$stmt->execute()) {
                    echo "Error saat menyimpan data: " . $stmt->error;
                }
            } else {
                echo "File gagal diupload.";
            }
        }
        header("Location: ../public/gallery?status=success");
        exit();
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage();
    }
}
?>
