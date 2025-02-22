<?php
// Mengimpor file koneksi
include './koneksi.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $caption = trim($_POST['caption']);
    $link_spotify = trim($_POST['spotifyLink']);
    $genres = trim($_POST['genres']); // Genre yang dipilih oleh pengguna
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Validasi format `link_spotify`
    if (strpos($link_spotify, 'https://open.spotify.com/user') === false) {
        header("Location: ../public/mutual?message=Link Spotify tidak valid! Harus mengandung 'https://open.spotify.com/user'");
        exit();
    }

    // Validasi `link_spotify` sudah ada
    $query_check_link = "SELECT COUNT(*) AS count FROM mutual WHERE link_spotify = ?";
    $stmt_check_link = $conn->prepare($query_check_link);
    $stmt_check_link->bind_param("s", $link_spotify);
    $stmt_check_link->execute();
    $result_check_link = $stmt_check_link->get_result();
    $data_link = $result_check_link->fetch_assoc();

    if ($data_link['count'] > 0) {
        header("Location: ../public/mutual?message=Link Spotify sudah digunakan!");
        exit();
    }

    // Validasi `IP_ADDRESS` dan `link_spotify`
    $query_check_ip = "SELECT COUNT(*) AS count FROM mutual WHERE IP_ADDRESS = ? AND link_spotify = ?";
    $stmt_check_ip = $conn->prepare($query_check_ip);
    $stmt_check_ip->bind_param("ss", $ip_address, $link_spotify);
    $stmt_check_ip->execute();
    $result_check_ip = $stmt_check_ip->get_result();
    $data_ip = $result_check_ip->fetch_assoc();

    if ($data_ip['count'] > 0) {
        header("Location: ../public/mutual?message=IP Address sudah digunakan dengan link Spotify ini!");
        exit();
    }

    // Validasi `name`
    $query_check_name = "SELECT COUNT(*) AS count FROM mutual WHERE name = ?";
    $stmt_check_name = $conn->prepare($query_check_name);
    $stmt_check_name->bind_param("s", $name);
    $stmt_check_name->execute();
    $result_check_name = $stmt_check_name->get_result();
    $data_name = $result_check_name->fetch_assoc();

    if ($data_name['count'] > 0) {
        header("Location: ../public/mutual?message=Name sudah digunakan!");
        exit();
    }

    // Simpan data jika validasi lulus
    $query_insert = "INSERT INTO mutual (name, caption, link_spotify, tags, IP_ADDRESS) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($query_insert);
    $stmt_insert->bind_param("sssss", $name, $caption, $link_spotify, $genres, $ip_address);  // Menyertakan genre dalam insert

    if ($stmt_insert->execute()) {
        header("Location: ../public/mutual?message=Data berhasil disimpan!");
    } else {
        header("Location: ../public/mutual?message=Terjadi kesalahan saat menyimpan data!");
    }

    // Menutup statement
    $stmt_check_link->close();
    $stmt_check_ip->close();
    $stmt_check_name->close();
    $stmt_insert->close();
}

$conn->close();
?>
