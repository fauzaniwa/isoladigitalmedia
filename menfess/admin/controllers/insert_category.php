<?php
// insert_category.php

// Include the database connection file
include_once 'koneksi.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the category name from the POST data
    $nama_kategori = htmlspecialchars(trim($_POST['category']));

    // Check if the category name is not empty
    if (!empty($nama_kategori)) {
        // Check if the category already exists
        $checkSql = "SELECT COUNT(*) FROM kategori_blog WHERE nama_kategori = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $nama_kategori);
        $stmt->execute();
        $stmt->bind_result($categoryExists);
        $stmt->fetch();
        $stmt->close();

        if ($categoryExists > 0) {
            // Redirect if the category already exists
            header("Location: ../public/blog_add?status=already");
            exit();
        } else {
            // Prepare the SQL statement to insert the new category
            $insertSql = "INSERT INTO kategori_blog (nama_kategori) VALUES (?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("s", $nama_kategori);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect with a success status
                header("Location: ../public/blog_add?status=success");
                exit();
            } else {
                // Redirect with an error message if the insert fails
                header("Location: ../public/blog_add?status=error");
                exit();
            }

            $stmt->close();
        }
    } else {
        // Redirect back with an error message if the category name is empty
        header("Location: ../public/blog_add?status=error");
        exit();
    }
} else {
    // Redirect if the request method is not POST
    header("Location: ../public/blog_add?status=error");
    exit();
}

// Close the connection
$conn->close();
