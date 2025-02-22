<?php
// Include database connection
include_once 'koneksi.php';

// Initialize variables and set default values
$nama_draft = $_POST['nama_draft'] ?? '';
$ket_draft = $_POST['ketdraft'] ?? '';
$file_draft = ''; // Default value if no file is uploaded
$link_draft = $_POST['linkdraft'] ?? ''; // Default value if no link is provided
$kategori_draft = $_POST['kategori'] ?? '';
$created_at = date('Y-m-d H:i:s');
$updated_at = $created_at;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        // Define upload directory
        $uploadDir = '../public/src/filedraft/';
        
        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique file name using timestamp and original file name
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $timestamp = time();
        $newFileName = $timestamp . '_' . basename($fileName, '.' . $fileExtension) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        // Move file to the upload directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $file_draft = $destPath;
        } else {
            // File upload failed
            header("Location: ../public/draft?status=error");
            exit;
        }
    }

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO draft (nama_draft, ket_draft, file_draft, link_draft, kategori_draft, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        // Error preparing statement
        header("Location: ../public/draft?status=error");
        exit;
    }

    // Bind parameters and execute statement
    $stmt->bind_param("sssssss", $nama_draft, $ket_draft, $file_draft, $link_draft, $kategori_draft, $created_at, $updated_at);
    if ($stmt->execute()) {
        // Success
        header("Location: ../public/draft?status=success");
    } else {
        // Error executing statement
        header("Location: ../public/draft?status=error");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    header("Location: ../public/draft?status=error");
}
