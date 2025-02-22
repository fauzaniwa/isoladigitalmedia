<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai sesi untuk menyimpan status
session_start();

// Sertakan file koneksi database
include('koneksi.php');

// Ambil data dari form
$name = $_POST['name'];
$nim = $_POST['nim'];
$tahunangkatan = $_POST['tahunangkatan'];
$programstudi = $_POST['programstudi'];
$instagram = $_POST['instagram'];
$nohp = $_POST['nohp'];
$portfolio = $_POST['portfolio'];
$cv = $_POST['cv'];
$department = $_POST['department'];
$divisi = $_POST['division'];
$optional_department = $_POST['opsi-department'];
$optional_division = $_POST['opsi-divisi'];
$knowledge = $_POST['knowledge'];
$pindahdivisi = $_POST['pindahdivisi'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$setuju = isset($_POST['setuju']) ? $_POST['setuju'] : 'no';

// Cek jika password dan confirm password cocok
if ($password !== $confirm_password) {
    // Redirect jika password tidak cocok
    header("Location: ../public/register?status=password_mismatch");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah header redirect
}

// Periksa apakah NIM, email, atau username sudah ada
$check_query = "SELECT id FROM anggota WHERE nim = ? OR email = ? OR username = ?";
$stmt_check = $conn->prepare($check_query);
$stmt_check->bind_param("sss", $nim, $email, $username);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    // Periksa kolom yang sudah ada
    if ($stmt_check->num_rows > 0) {
        $stmt_check->bind_result($id);
        while ($stmt_check->fetch()) {
            // Sesuaikan dengan kondisi yang relevan
            if ($nim == $nim) {
                header("Location: ../public/register?status=nim_already");
                exit();
            }
            if ($email == $email) {
                header("Location: ../public/register?status=email_already");
                exit();
            }
            if ($username == $username) {
                header("Location: ../public/register?status=username_already");
                exit();
            }
        }
    }
    $stmt_check->close();
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Query untuk menyimpan data
$sql = "INSERT INTO anggota (name, nim, tahunangkatan, programstudi, Instagram, nohp, portfolio, cv, department, divisi, opsi_department, opsi_divisi, knowledge, pindah_divisi, username, password, setuju, email, role, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'anggota', 'pending')";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssssssssssss",
    $name, $nim, $tahunangkatan, $programstudi, $instagram, $nohp, $portfolio, $cv,
    $department, $divisi, $optional_department, $optional_division, $knowledge, $pindahdivisi, $username, $hashed_password, $setuju, $email
);

// Eksekusi query
if ($stmt->execute()) {
    // Redirect jika sukses
    header("Location: ../public/register?status=success");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah header redirect
} else {
    // Redirect jika gagal
    header("Location: ../public/register?status=error");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah header redirect
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
