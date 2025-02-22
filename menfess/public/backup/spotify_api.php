<?php
// Data sensitif Spotify API
$clientID = 'b05c4f4b15bc4e10ac821c4c20eab5eb';
$clientSecret = 'f406c84540e840af887d868c29db6e12';

// Mendapatkan akses token dari Spotify API
function getAccessToken() {
    global $clientID, $clientSecret;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic ' . base64_encode($clientID . ':' . $clientSecret)
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['access_token'];
}

// Menangani pencarian musik dari klien
if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $accessToken = getAccessToken();
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=$query&type=track&limit=10");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $accessToken"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    header('Content-Type: application/json');
    echo $response;
    exit;
}
?>
