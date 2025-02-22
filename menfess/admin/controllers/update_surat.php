<?php
// Include database connection
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $id = $_POST['id_nosurat'];
    $no_surat = $_POST['nosurat'];
    $ket_surat = $_POST['ketsurat'];
    $newFileName = null;

    // Check if a new file is uploaded
    if (isset($_FILES['filesurat']) && $_FILES['filesurat']['error'] === UPLOAD_ERR_OK) {
        // Retrieve file details
        $fileTmpPath = $_FILES['filesurat']['tmp_name'];
        $fileName = $_FILES['filesurat']['name'];
        $fileSize = $_FILES['filesurat']['size'];
        $fileType = $_FILES['filesurat']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Generate a new file name with timestamp
        $timestamp = time();
        $newFileName = $timestamp . "_" . $fileName;

        // Define the upload directory
        $uploadDir = '../public/src/filesurat/';
        $destPath = $uploadDir . $newFileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // File successfully uploaded
        } else {
            // Handle file upload error
            header("Location: ../public/nomor_surat?status=error_edit");
            exit();
        }

        // Prepare to delete the old file
        $stmt = $conn->prepare("SELECT file_surat FROM surat WHERE id_nosurat = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($oldFileName);

        if ($stmt->num_rows === 1) {
            $stmt->fetch();
            $stmt->close();

            // Define the path to the old file
            $oldFilePath = $uploadDir . $oldFileName;

            // Delete the old file if it exists
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        } else {
            $stmt->close();
        }
    } else {
        // If no new file is uploaded, keep the old file name
        $stmt = $conn->prepare("SELECT file_surat FROM surat WHERE id_nosurat = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($oldFileName);
        $stmt->fetch();
        $stmt->close();
        $newFileName = $oldFileName; // Keep old file name
    }

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE surat SET no_surat = ?, ket_surat = ?, file_surat = ? WHERE id_nosurat = ?");
    $stmt->bind_param("sssi", $no_surat, $ket_surat, $newFileName, $id);

    if ($stmt->execute()) {
        // Success message
        header("Location: ../public/nomor_surat?status=success_edit");
    } else {
        // Error message
        header("Location: ../public/nomor_surat?status=error_edit");
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
    exit();
} else {
    // Redirect back to the form or another page if not a POST request
    header("Location: ../public/nomor_surat?status=error_edit");
    exit();
}
?>
