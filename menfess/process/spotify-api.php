<?php
// Assuming you use Node.js server to fetch track data
// Using cURL to call your Node.js service or if using a direct API request, replace this part

if (isset($_GET['track_id'])) {
    $trackId = $_GET['track_id'];
    // You can call your Node.js function here or use Spotify API directly
    // Example of calling the Node.js API from PHP (using cURL)

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/getTrackInfo?trackId=" . $trackId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Output the response from Node.js to the frontend
    echo $response;
}
?>
