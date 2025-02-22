<?php
include '../process/koneksi.php';

$batch = isset($_GET['batch']) ? intval($_GET['batch']) : 1; // Batch yang diminta (default 1)
$limit = 5; // Limit per batch
$offset = ($batch - 1) * $limit; // Hitung offset
$max_data = 15; // Batas maksimum data
$max_batch = ceil($max_data / $limit); // Hitung jumlah batch maksimum

if ($batch > $max_batch) {
    echo json_encode(['success' => false, 'message' => 'No more data']);
    exit;
}

$query = "
SELECT 
    m.id, 
    m.name, 
    m.usernameig, 
    m.message, 
    m.music, 
    m.views, 
    m.comment, 
    m.created_at,
    COUNT(c.id) AS total_comments
FROM menfess m
LEFT JOIN comment c ON m.id = c.menfess_id
GROUP BY m.id
ORDER BY m.created_at DESC
LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(['success' => true, 'data' => $data, 'maxBatch' => $max_batch]);
?>
