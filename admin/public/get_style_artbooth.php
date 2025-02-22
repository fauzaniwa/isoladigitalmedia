<?php
require_once '../controllers/koneksi.php'; // Hubungkan ke database

$sql = "SELECT id_style, nama_style, ketersediaan_style FROM style_artbooth";
$result = $conn->query($sql);

$styles = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $styles[] = array(
            "id_style" => $row["id_style"],
            "nama_style" => $row["nama_style"],
            "ketersediaan_style" => $row["ketersediaan_style"] == 1 ? true : false
        );
    }
}

header('Content-Type: application/json');
echo json_encode($styles);

$conn->close();
?>
