<?php
// Include database connection
include_once '../controllers/koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id_draft = $_POST['id_draft'];
    $nama_draft = $_POST['nama_draft'];
    $ket_draft = $_POST['ketdraft'];
    $kategori = $_POST['kategori'];
    $link_draft = $_POST['linkdraft'];
    
    // Handle file upload
    $uploadDir = '../public/src/filedraft/';
    $file_draft = null;
    
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Get file information
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Check if file is a PDF
        if ($fileExtension === 'pdf') {
            // Define new file name with timestamp
            $file_draft = time() . '_' . $fileName;
            $dest_path = $uploadDir . $file_draft;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Get the old file name from the database
                $stmt = $conn->prepare("SELECT file_draft FROM draft WHERE id_draft = ?");
                $stmt->bind_param("i", $id_draft);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($old_file_draft);
                $stmt->fetch();
                $stmt->close();

                // Delete old file if it exists
                if ($old_file_draft && file_exists($uploadDir . $old_file_draft)) {
                    unlink($uploadDir . $old_file_draft);
                }
            } else {
                // Error in file upload
                header("Location: ../public/draft?status=error_update");
                exit();
            }
        } else {
            // Not a PDF file
            header("Location: ../public/draft?status=error_update");
            exit();
        }
    } else {
        // No file was uploaded, use existing file
        $file_draft = $_POST['existing_file_draft'];
    }

    // Prepare and execute update statement
    $stmt = $conn->prepare("UPDATE draft SET nama_draft = ?, ket_draft = ?, kategori_draft = ?, file_draft = ?, link_draft = ? WHERE id_draft = ?");
    $stmt->bind_param("sssssi", $nama_draft, $ket_draft, $kategori, $file_draft, $link_draft, $id_draft);

    if ($stmt->execute()) {
        // Success message
        header("Location: ../public/draft?status=success_update");
    } else {
        // Error message
        header("Location: ../public/draft?status=error_update");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the form or another page if not a POST request
    header("Location: ../public/draft?status=error_update");
}

// Ensure the script ends after redirect
exit();
?>
