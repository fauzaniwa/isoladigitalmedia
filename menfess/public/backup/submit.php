<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: "#da373d",
          },
        },
      },
    };
  </script>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Schoolbell&display=swap" rel="stylesheet">
  <script src="script.js"></script>
  <style type="text/tailwindcss">
    .primary-font {
      font-family: "Schoolbell", cursive;
    }
    .spotify-embed iframe {
      border-radius: 8px;
      overflow: hidden;
    }
    .message-gradient {
      position: relative;
      overflow: hidden;
      max-width: 100%;
      white-space: nowrap;
      text-overflow: ellipsis;
      display: inline-block;
      -webkit-mask-image: linear-gradient(
        90deg,
        rgba(0, 0, 0, 1) 70%,
        rgba(0, 0, 0, 0) 100%
      );
      mask-image: linear-gradient(
        90deg,
        rgba(0, 0, 0, 1) 70%,
        rgba(0, 0, 0, 0) 100%
      );
    }
    .text-ellipsis {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    #musicDropdown {
  position: absolute;
  background: white;
  max-height: 200px;
  overflow-y: auto;
  z-index: 1000;
}

.music-option {
  display: flex;
  align-items: center;
  padding: 5px;
  cursor: pointer;
}

.music-option img {
  width: 40px;
  height: 40px;
  margin-right: 10px;
}

.music-option:hover {
  background-color: #f0f0f0;
}

  </style>

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
</head>

<body class="flex flex-col min-h-screen">
  <nav class="p-4 border-b">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <ul class="flex justify-between text-l">
        <a href="home"><img src="src/smile-03.png" class="w-16" alt="" /></a>
        <div class="flex gap-x-7">
          <li><a href="submit">Submit</a></li>
          <li><a href="browse">Browse</a></li>
          <li><a href="https://saweria.co/TellYourStory">Support</a></li>
        </div>
      </ul>
    </div>
  </nav>

  <section class="mt-12 px-4 flex-grow items-center justify-center">
    <div>
      <section class="rounded-lg w-full max-w-md mx-auto justify-center items-center">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold">Message Deletion Not Supported</strong> Currently, we do not support deleting
          messages. Once a message is sent, it cannot be removed. Please make sure your message is appropriate before
          submitting.

        </div>
      </section>

      <div class="bg-white p-8 rounded-lg border w-full max-w-md mx-auto">

        <h1 class="text-2xl font-medium mb-4 text-center bg-black text-white p-2 rounded-full">
          SAMPAIKAN CERITA KAMU.
        </h1>



        <!-- Tampilkan pesan sukses jika status=success -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong> mengirim cerita.
          </div>
        <?php endif; ?>

        <form action="../process/insert_menfess.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Recipient Name</label>
            <input required type="text" id="name" name="name" placeholder="Enter recipient's name"
              class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" />
          </div>

          <div class="mb-4">
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
            <textarea required id="message" name="message" placeholder="Write your message here"
              class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"></textarea>
          </div>

          <div class="mb-4">
            <label for="musicSearch" class="block text-gray-700 text-sm font-bold mb-2">Music</label>
            <input type="text" id="musicSearch" placeholder="Type to search music..."
              class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
              oninput="updateDropdown(this.value)">

            <!-- Dropdown container untuk opsi musik dengan gambar -->
            <div id="musicDropdown" class="absolute bg-white border rounded md:w-96 mt-2 shadow-lg hidden">
              <div id="musicOptions"></div>
            </div>

            <p id="resultCount" class="text-gray-600 text-sm mt-2"></p> <!-- Tampilkan jumlah hasil di sini -->
          </div>

          <!-- Input tersembunyi untuk embed link musik yang dipilih -->
          <input type="hidden" id="musicEmbedLink" name="music">

          <div class="flex items-center justify-between">
            <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded">
              Submit
            </button>
          </div>
        </form>

      </div>
    </div>
  </section>

  <!-- Footer Section -->
<footer class="mt-12 p-4 text-black text-center">
  <p class="text-sm">
    Inspired by <a href="https://sendthesong.xyz" target="_blank" class="text-blue-400 hover:underline">https://sendthesong.xyz</a>
  </p>
</footer>

</body>

</html>