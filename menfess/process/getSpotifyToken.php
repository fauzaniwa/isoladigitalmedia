

<?php
$clientID = 'b3310414dfb1447286b4e7ebd2389cc1';
$clientSecret = '1d0e82bdc9de4339b822598ed73b831f';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode($clientID . ':' . $clientSecret),
    'Content-Type: application/x-www-form-urlencoded'
]);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);
echo $result;
?>