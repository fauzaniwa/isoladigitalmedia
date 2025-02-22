<?php
// Include database connection
include 'koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the ID of the record to be deleted
    $id = $_POST['id'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT file_surat FROM surat WHERE id_nosurat = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($file_surat);

    if ($stmt->num_rows === 1) {
        // Fetch the file name
        $stmt->fetch();
        $stmt->close();

        // Define the file path
        $uploadDir = '../public/src/filesurat/';
        $filePath = $uploadDir . $file_surat;

        // Delete the file if it exists
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM surat WHERE id_nosurat = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Success message
            header("Location: ../public/nomor_surat?status=success_delete");
        } else {
            // Error message
            header("Location: ../public/nomor_surat?status=error_delete");
        }

        // Close the statement
        $stmt->close();
    } else {
        // Record not found
        header("Location: ../public/nomor_surat?status=error_delete");
    }
} else {
    // Redirect back to the form or another page if not a POST request
    header("Location: ../public/nomor_surat?status=error_delete");
}

// Close the database connection
$conn->close();
exit();
?>
