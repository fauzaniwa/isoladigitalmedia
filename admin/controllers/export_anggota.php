<?php
include 'koneksi.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_export.csv');

$output = fopen('php://output', 'w');

// Kolom header untuk CSV
fputcsv($output, array('Name', 'NIM', 'Tahun Angkatan', 'Program Studi', 'Sebagai', 'Email'));

// Query untuk mendapatkan data
$query = "SELECT `name`, `nim`, `tahunangkatan`, `programstudi`, `sebagai`, `email` FROM `anggota`";
$result = $conn->query($query);

// Menuliskan data hasil query ke CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
