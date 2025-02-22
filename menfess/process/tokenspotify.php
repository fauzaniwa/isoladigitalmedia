<?php
function getSpotifyTrackInfo($trackId): mixed {
    $accessToken = 'b05c4f4b15bc4e10ac821c4c20eab5eb';  // Replace with your actual token
    $url = "https://api.spotify.com/v1/tracks/{$trackId}";

    $options = [
        "http" => [
            "header" => "Authorization: Bearer {$accessToken}"
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        return null;
    }

    $data = json_decode($response, true);
    return $data;
}
?>
