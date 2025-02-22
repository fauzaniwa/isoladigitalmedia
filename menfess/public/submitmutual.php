<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DKVess - Engaging Design</title>
    <link rel="icon" href="src/favicon.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="stylesmenfess.css">

</head>

<body class="bg-pink-light text-pink-main">
    <!-- Header -->
    <?php
    include 'navbar.php'; ?>

    <!-- Create Button -->
    <div class="py-10 mx-6 flex-grow items-center justify-center">
        <button onclick="history.back()" class="p-6 font-semibold">
            <i class="bi bi-arrow-left text-xl"></i> Back / Submit
        </button>
    </div>

    <div id="modalBackground" class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-700">Sukses!</h2>
            </div>
            <p class="text-gray-700 mb-4">Cerita berhasil dikirim!</p>
            <!-- Close Button -->
            <div class="text-right">
                <a href="browse">
                    <button id="closeModal"
                        class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
                        OK
                    </button>
                </a>
            </div>
        </div>
    </div>

    <section class="py-10 rounded-lg w-96 justify-items-center items-center m-4 flex flex-col mx-auto text-center">
        <!-- Syarat dan Ketentuan -->
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Read Before Submitting:</strong> By submitting a message, you agree to our
            <a href="terms" class="underline font-semibold hover:text-blue-500">Terms and Conditions</a>.
        </div>
    </section>


    <!-- Detail Section -->
    <section class="bg-pink-light mb-6">
        <div class="mx-auto text-start">
            <div class="mx-auto max-w-lg bg-white p-8 rounded-lg shadow-lg">
                <!-- Pilihan Tab untuk Menfess dan Spotify -->
                <div class="flex mb-6">
                    <a href="submit" id="menfessTab"
                        class="w-1/2 text-center btn-primary text-white px-4 py-3 font-semibold shadow-md hover:shadow-lg bg-gray-500 rounded-l-md">
                        Menfess
                    </a>
                    <a href="#" id="spotifyTab"
                        class="w-1/2 text-center btn-primary text-white px-4 py-3 font-semibold shadow-md hover:shadow-lg bg-pink-main rounded-r-md">
                        Spotify Mutuals
                    </a>
                </div>
                <h2 class="text-3xl font-bold text-center text-pink-main mb-8">Spotify Mutuals</h2>

                <!-- Form Start -->
                <!-- Modal Form -->
                <form action="../process/insert_mutual.php" method="POST">
                    <!-- Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" id="name" maxlength="10" name="name" required placeholder="Enter your name"
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>

                    <!-- Caption Input -->
                    <div class="mb-4">
                        <label for="caption" class="block text-gray-700 text-sm font-bold mb-2">Caption</label>
                        <input type="text" id="caption" maxlength="25" name="caption" required
                            placeholder="Enter your caption"
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>

                    <!-- Spotify Profile Link -->
                    <div class="mb-4">
                        <label for="spotifyLink" class="block text-gray-700 text-sm font-bold mb-2">Spotify Profile
                            Link</label>
                        <input type="url" id="spotifyLink" name="spotifyLink" required
                            placeholder="https://open.spotify.com/user/..."
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>

                    <div class="mb-4">
                        <label for="genres" class="block text-gray-700 text-sm font-bold mb-2">Genres (max 3)</label>
                        <input type="text" id="genres" name="genres" placeholder="Enter genres, separated by commas"
                            required
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <div id="genre-tags" class="flex flex-wrap mt-2"></div>
                        <div class="mt-2" id="genre-buttons-container">
                            <!-- Genre buttons will be dynamically inserted here -->
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div class="text-right">
                        <button type="submit"
                            class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
                            Submit
                        </button>
                    </div>
                </form>


                <!-- Form End -->
            </div>
    </section>


    <?php
    include 'footer.php';
    ?>

    <script></script>


    <script>
        // Fungsi untuk menampilkan genre sebagai tombol
        function displayGenreButtons(genres) {
            const genreButtonsContainer = document.getElementById('genre-buttons-container');
            genreButtonsContainer.innerHTML = ''; // Kosongkan tombol sebelumnya

            genres.forEach(genre => {
                const button = document.createElement('button');
                button.type = 'button';
                button.classList.add('genre-recommendation', 'bg-blue-200', 'text-blue-700', 'px-3', 'py-1', 'rounded-full', 'mr-2', 'mb-2');
                button.textContent = genre.genre_name;
                button.addEventListener('click', () => addGenre(genre.genre_name));
                genreButtonsContainer.appendChild(button);
            });
        }

        // Fungsi untuk menambahkan genre ke input
        function addGenre(genre) {
            const genreInput = document.getElementById('genres');
            let currentGenres = genreInput.value.split(',').map(g => g.trim()).filter(Boolean);

            // Pastikan tidak lebih dari 3 genre
            if (currentGenres.length < 3 && !currentGenres.includes(genre)) {
                currentGenres.push(genre);
                genreInput.value = currentGenres.join(', ');
                updateGenreTags(currentGenres);
                updateGenreButtons(currentGenres);
            }
        }

        // Fungsi untuk menampilkan tag genre yang telah dipilih
        function updateGenreTags(currentGenres) {
            const genreTagsContainer = document.getElementById('genre-tags');
            genreTagsContainer.innerHTML = ''; // Kosongkan tag sebelumnya

            currentGenres.forEach(genre => {
                const tag = document.createElement('span');
                tag.classList.add('bg-blue-100', 'text-blue-700', 'px-2', 'py-1', 'rounded-full', 'mr-2', 'mb-2');
                tag.textContent = genre;
                genreTagsContainer.appendChild(tag);
            });
        }

        // Fungsi untuk memperbarui tombol genre yang tersedia
        function updateGenreButtons(currentGenres) {
            const allGenres = genresList;
            const remainingGenres = allGenres.filter(genre => !currentGenres.includes(genre));
            displayGenreButtons(getRandomGenres(remainingGenres));
        }

        // Mengambil genre dari server menggunakan fetch
        fetch('getGenres.php')  // Ganti dengan path yang sesuai
            .then(response => response.json())
            .then(data => {
                displayGenreButtons(data);  // Menampilkan genre yang didapat dari server
            })
            .catch(error => {
                console.error('Error fetching genres:', error);
            });

    </script>

    <!-- JavaScript for Toggle Navbar -->
    <script>
        const navToggle = document.getElementById('navToggle');
        const navMenuMobile = document.getElementById('navMenuMobile');

        navToggle.addEventListener('click', () => {
            navMenuMobile.classList.toggle('hidden');
        });
    </script>

    <script>
        // Masukkan clientID dan clientSecret Anda
        const clientID = 'b3310414dfb1447286b4e7ebd2389cc1';
        const clientSecret = '1d0e82bdc9de4339b822598ed73b831f';

        let accessToken;

        // Fungsi untuk mendapatkan akses token dari Spotify API
        async function getAccessToken() {
            const response = await fetch('https://accounts.spotify.com/api/token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Authorization': 'Basic ' + btoa(clientID + ':' + clientSecret)
                },
                body: 'grant_type=client_credentials'
            });
            const data = await response.json();
            accessToken = data.access_token;
        }

        // Fungsi untuk mencari musik dari Spotify API
        async function searchMusic(query) {
            if (!accessToken) await getAccessToken(); // Mendapatkan access token jika belum ada

            const response = await fetch(`https://api.spotify.com/v1/search?q=${query}&type=track&limit=10`, {
                headers: {
                    'Authorization': `Bearer ${accessToken}`
                }
            });
            const data = await response.json();
            return data.tracks.items;
        }

        async function updateDropdown(query) {
            if (query.length < 3) return; // Mulai pencarian setelah 3 karakter

            const results = await searchMusic(query);
            const dropdown = document.getElementById('musicDropdown');
            const optionsContainer = document.getElementById('musicOptions');

            optionsContainer.innerHTML = ''; // Reset options sebelumnya
            dropdown.classList.remove('hidden'); // Tampilkan dropdown

            results.forEach(track => {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'flex items-center p-2 hover:bg-gray-100 cursor-pointer';
                optionDiv.onclick = () => selectMusic(track); // Pilih musik saat opsi diklik

                const img = document.createElement('img');
                img.src = track.album.images[0].url;
                img.alt = track.name;
                img.className = 'w-10 h-10 mr-3 rounded';

                const text = document.createElement('span');
                text.className = 'text-gray-700';
                text.textContent = `${track.name} - ${track.artists.map(artist => artist.name).join(', ')}`;

                optionDiv.appendChild(img);
                optionDiv.appendChild(text);
                optionsContainer.appendChild(optionDiv);
            });

            document.getElementById('resultCount').innerText = `${results.length} results found`;
        }

        // Fungsi untuk menangani pemilihan musik
        function selectMusic(track) {
            const embedLink = `https://open.spotify.com/embed/track/${track.id}`;
            document.getElementById('musicSearch').value = `${track.name} - ${track.artists.map(artist => artist.name).join(', ')}`;
            document.getElementById('musicEmbedLink').value = embedLink; // Simpan embed link ke input tersembunyi
            document.getElementById('musicDropdown').classList.add('hidden'); // Sembunyikan dropdown setelah pemilihan
        }




        // Memanggil fungsi getAccessToken saat halaman pertama kali dimuat
        getAccessToken();

    </script>
    <script>
        // Fungsi untuk menampilkan modal
        function showModal() {
            const modal = document.getElementById('modalBackground');
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('modalBackground');
            modal.classList.add('hidden');
        }

        // Mengecek URL untuk parameter success
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            const success = urlParams.get('status');

            // Jika success=true di URL, tampilkan modal
            if (success === 'success') {
                showModal();
            }
        };

        // Event listener untuk menutup modal
        document.getElementById('closeModal').addEventListener('click', closeModal);
    </script>
</body>

</html>