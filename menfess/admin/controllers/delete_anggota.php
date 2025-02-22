<?php
// Include the database connection file
include 'koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID from POST request
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Prepare a delete statement
    $sql = "DELETE FROM anggota WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the ID parameter
        $stmt->bind_param('i', $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the previous page or a specific page after successful deletion
            header("Location: ../public/anggota?status=success_delete");
            exit();
        } else {
            // Handle execution error
            header("Location: ../public/draft?status=error_delete");
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle prepare statement error
        header("Location: ../public/draft?status=error_delete");
    }

    // Close the connection
    $conn->close();
} else {
    // If not POST request, redirect or show an error
    header("Location: ../public/draft?status=error_delete");
}
?>
