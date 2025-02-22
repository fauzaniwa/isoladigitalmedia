<?php
//require 'vendor/autoload.php';
include '../admin/pages/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query data dari database
$sql = "SELECT `name`, `nim`, `tahunangkatan`, `programstudi`, `sebagai`, `email` FROM `anggota`";
$result = $conn->query($sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Anggota');

// Menyusun header kolom
$headers = ['Name', 'NIM', 'Tahun Angkatan', 'Program Studi', 'Sebagai', 'Email'];
$sheet->fromArray($headers, NULL, 'A1');

// Memasukkan data
if ($result->num_rows > 0) {
    $row = 2; // Mulai dari baris ke-2 untuk data
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['name']);
        $sheet->setCellValue('B' . $row, $data['nim']);
        $sheet->setCellValue('C' . $row, $data['tahunangkatan']);
        $sheet->setCellValue('D' . $row, $data['programstudi']);
        $sheet->setCellValue('E' . $row, $data['sebagai']);
        $sheet->setCellValue('F' . $row, $data['email']);
        $row++;
    }
}

// Atur header untuk unduhan file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Anggota.xlsx"');
header('Cache-Control: max-age=0');

// Buat file Excel dan unduh
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
