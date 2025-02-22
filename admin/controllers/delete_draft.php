<?php
// Include database connection
include 'koneksi.php'; // Adjust the path as necessary

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the ID of the record to be deleted
    $id = $_POST['id'] ?? '';

    // Validate ID
    if (empty($id) || !is_numeric($id)) {
        header("Location: ../public/draft?status=error_delete");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT file_draft FROM draft WHERE id_draft = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($file_draft);

    if ($stmt->num_rows === 1) {
        // Fetch the file path
        $stmt->fetch();
        $stmt->close();

        // Define the upload directory and full file path
        $uploadDir = '../public/src/filedraft/';
        $filePath = $uploadDir . basename($file_draft); // Ensure the filename is safely appended

        // Delete the file if it exists
        if (!empty($file_draft) && file_exists($filePath)) {
            if (unlink($filePath)) {
                // File deleted successfully
            } else {
                // Log error or handle file deletion failure
            }
        }

        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM draft WHERE id_draft = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Success message
            header("Location: ../public/draft?status=success_delete");
        } else {
            // Error message
            header("Location: ../public/draft?status=error_delete");
        }

        // Close the statement
        $stmt->close();
    } else {
        // Record not found
        header("Location: ../public/draft?status=error_delete");
    }
} else {
    // Redirect back to the form or another page if not a POST request
    header("Location: ../public/draft?status=error_delete");
}

// Close the database connection
$conn->close();
exit();
?>
