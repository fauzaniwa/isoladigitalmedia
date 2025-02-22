<?php
include '../process/koneksi.php';

if (isset($_POST['id'])) {
    $menfess_id = $_POST['id'];

    // Update views
    $query = "UPDATE menfess SET views = views + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $menfess_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Ambil jumlah views terbaru
        $query_views = "SELECT views FROM menfess WHERE id = ?";
        $stmt_views = mysqli_prepare($conn, $query_views);
        mysqli_stmt_bind_param($stmt_views, 'i', $menfess_id);
        mysqli_stmt_execute($stmt_views);
        $result_views = mysqli_stmt_get_result($stmt_views);
        $row_views = mysqli_fetch_assoc($result_views);

        echo json_encode(['success' => true, 'new_views' => $row_views['views']]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
