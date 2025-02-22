const axios = require('axios');  // Make sure to install axios via npm: npm install axios
const clientID = 'b05c4f4b15bc4e10ac821c4c20eab5eb';  // Your Spotify Client ID
const clientSecret = 'f406c84540e840af887d868c29db6e12';  // Your Spotify Client Secret

// Function to get the access token from Spotify using Client Credentials Flow
async function getAccessToken() {
    const url = 'https://accounts.spotify.com/api/token';
    const headers = {
        'Authorization': 'Basic ' + Buffer.from(clientID + ':' + clientSecret).toString('base64'),
        'Content-Type': 'application/x-www-form-urlencoded'
    };
    const data = 'grant_type=client_credentials';

    try {
        const response = await axios.post(url, data, { headers });
        return response.data.access_token;  // Return the access token
    } catch (error) {
        console.error('Error fetching access token', error);
    }
}

// Function to get track info (title and album thumbnail) by track ID
async function getTrackInfo(trackId) {
    const accessToken = await getAccessToken();
    const url = `https://api.spotify.com/v1/tracks/${trackId}`;

    const headers = {
        'Authorization': `Bearer ${accessToken}`
    };

    try {
        const response = await axios.get(url, { headers });
        const track = response.data;
        const trackName = track.name;
        const albumImage = track.album.images[0].url;  // Get the first image (thumbnail)

        return { trackName, albumImage };
    } catch (error) {
        console.error('Error fetching track info', error);
    }
}

// Example Usage: Get track info for a specific track ID (you will get this from your database)
const trackId = '3n3Pp5plJtiK3r5jNY5p91';  // Replace with actual track ID from the database
getTrackInfo(trackId).then(track => {
    if (track) {
        console.log('Track Name:', track.trackName);
        console.log('Album Thumbnail:', track.albumImage);
    }
});
