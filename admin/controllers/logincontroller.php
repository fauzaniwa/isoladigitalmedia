<?php
// Include file koneksi.php
include 'koneksi.php';
session_start(); // Memulai sesi

// Mendapatkan data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Menghindari SQL Injection
$email = $conn->real_escape_string($email);

// Menyiapkan query untuk mencari pengguna berdasarkan email
$sql = "SELECT id, nama, email, password, role FROM admins WHERE email=?";
if ($stmt = $conn->prepare($sql)) {
    // Bind parameter email ke pernyataan SQL
    $stmt->bind_param("s", $email);

    // Jalankan pernyataan yang disiapkan
    if ($stmt->execute()) {
        // Ambil hasilnya
        $stmt->bind_result($id, $nama, $email_from_db, $hashed_password, $role);
        if ($stmt->fetch()) {
            // Memeriksa password
            if (password_verify($password, $hashed_password)) {
                // Set variabel sesi
                $_SESSION['logged_in'] = true;
                $_SESSION['admin_id'] = $id;
                $_SESSION['admin_name'] = $nama;
                $_SESSION['admin_role'] = $role;

                // Redirect ke halaman profil setelah login berhasil
                header("Location: ../public/profile");
                exit();
            } else {
                // Password salah, tampilkan pesan kesalahan dengan JavaScript
                echo "<script>
                        alert('Email atau password salah.');
                        window.location.href = '../public/login';
                      </script>";
            }
        } else {
            // Email tidak ditemukan, tampilkan pesan kesalahan dengan JavaScript
            echo "<script>
                    alert('Email tidak ditemukan.');
                    window.location.href = '../public/login';
                  </script>";
        }
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo "<script>
                alert('Error: Could not execute the query.');
                window.location.href = '../public/login';
              </script>";
    }

    // Tutup pernyataan
    $stmt->close();
} else {
    // Jika query tidak bisa disiapkan
    echo "<script>
            alert('Error: Could not prepare the query.');
            window.location.href = '../public/login';
          </script>";
}

// Menutup koneksi
$conn->close();
?>
