<?php
// Include database connection
include 'koneksi.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $visi = isset($_POST['visi']) ? trim($_POST['visi']) : '';
    $misi = isset($_POST['misi']) ? trim($_POST['misi']) : '';

    // Validate form data
    if (empty($visi) || empty($misi)) {
        header("Location: ../public/visimisi?status=error");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO visi_misi (visi_text, misi_text, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
    $stmt->bind_param("ss", $visi, $misi);

    // Execute the query
    if ($stmt->execute()) {
        // Success message
        header("Location: ../public/visimisi?status=success");
        exit();
    } else {
        // Error message
        header("Location: ../public/visimisi?status=error");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request method is not POST, redirect with an error status
    header("Location: ../public/visimisi?status=error");
    exit();
}

// Close the database connection
$conn->close();
exit();
?>
