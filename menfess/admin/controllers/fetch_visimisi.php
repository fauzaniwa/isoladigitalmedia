<?php
// Include database connection
include 'koneksi.php';

// Query to fetch data from the visi_misi table
$sql = "SELECT visi_text, misi_text FROM visi_misi ORDER BY id_visimisi DESC LIMIT 1";
$result = $conn->query($sql);

// Check if the query returned a result
if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    $visi_text = $row['visi_text'];
    $misi_text = $row['misi_text'];
} else {
    $visi_text = 'Data Visi tidak ditemukan.';
    $misi_text = 'Data Misi tidak ditemukan.';
}

// Close the database connection
$conn->close();
?>
