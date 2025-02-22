<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FessUp - Submit Menfess</title>
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

<div id="modalSpam" class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-700">Peringatan!</h2>
      </div>
      <p class="text-gray-700 mb-4">Terdeteksi Spam, harap upload menfess dengan maksimal 2x sehari.</p>
      <!-- Close Button -->
      <div class="text-right">
        <button id="closeModalSpam"
          class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
          OK
        </button>
      </div>
    </div>
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
          <button id="closeModalBackground"
            class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
            OK
          </button>
        </a>
      </div>
    </div>
  </div>

  <section class="py-10 rounded-lg w-96 justify-items-center items-center m-4 flex flex-col mx-auto text-center">
    <!-- Peringatan -->
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
      <strong class="font-bold">Message Deletion Not Supported</strong> Currently, we do not support deleting
      messages. Once a message is sent, it cannot be removed. Please make sure your message is appropriate before
      submitting.
    </div>

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
          <a href="#" id="menfessTab"
            class="w-1/2 text-center btn-primary text-white px-4 py-3 font-semibold shadow-md hover:shadow-lg bg-pink-main rounded-l-md">
            Menfess
          </a>
          <a href="submitmutual" id="spotifyTab"
            class="w-1/2 text-center btn-primary text-white px-4 py-3 font-semibold shadow-md hover:shadow-lg bg-gray-500 rounded-r-md">
            Spotify Mutuals
          </a>
        </div>
        <h2 class="text-3xl font-bold text-center text-pink-main mb-8">Submit Your Menfess</h2>

        <!-- Form Start -->
        <form action="../process/insert_menfess.php" method="POST" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Recipient Name*</label>
            <input required type="text" id="name" name="name" placeholder="Enter recipient's name"
              class="w-full p-4 border-2 border-gray-300 rounded-lg mb-4" />
          </div>

          <div class="mb-4">
            <label for="usernameig" class="block text-gray-700 text-sm font-bold mb-2">Username Instagram <span
                class="block text-xs text-gray-500 mt-1">Optional</span></label>

            <input required type="text" id="usernameig" name="usernameig"
              placeholder="Enter username recipient '@username'"
              class="w-full p-4 border-2 border-gray-300 rounded-lg mb-4" />
          </div>

          <div class="mb-4">
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message*</label>
            <textarea required id="message" name="message" placeholder="Write your message here"
              class="w-full p-4 border-2 border-gray-300 rounded-lg mb-4"></textarea>
          </div>

          <!-- Tampilkan pesan alert jika alert=term-->
          <?php if (isset($_GET['alert']) && $_GET['alert'] == 'term'): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
              <strong class="font-bold">Gagal Mengirim Cerita!</strong>
              Pesan kamu terdapat unsur kata kasar "<strong><?php echo htmlspecialchars($_GET['badword']); ?></strong>"
              dan tentu ini melanggar aturan yang berlaku.
            </div>
          <?php endif; ?>

          <div class="mb-4">
            <label for="musicSearch" class="block text-gray-700 text-sm font-bold mb-2">Music*</label>
            <input required type="text" id="musicSearch" placeholder="Type to search music..."
              class="w-full p-4 border-2 border-gray-300 rounded-lg mb-4" oninput="updateDropdown(this.value)">

            <!-- Dropdown container untuk opsi musik dengan gambar -->
            <div id="musicDropdown" class="absolute bg-white border rounded md:w-96 mt-2 shadow-lg hidden">
              <div id="musicOptions"></div>
            </div>

            <p id="resultCount" class="text-gray-600 text-sm mt-2"></p> <!-- Tampilkan jumlah hasil di sini -->
          </div>

          <!-- Input tersembunyi untuk embed link musik yang dipilih -->
          <input type="hidden" id="musicEmbedLink" name="music">

          <!-- Checkbox untuk Allowed Users Comments -->
          <div class="mb-4 flex items-center">
            <input type="checkbox" id="allowedComments" name="allowedComments" checked class="mr-2">
            <label for="allowedComments" class="text-sm text-gray-700">
              Allowed Users Comments
              <span class="block text-xs text-gray-500 mt-1">If you check this, other users can comment on your
                post.</span>
            </label>
          </div>

          <div class="flex items-center justify-between mt-6">
            <button type="submit"
              class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg">
              Submit
            </button>
          </div>
        </form>

        <!-- Form End -->
      </div>
  </section>
  <section class="flex items-center justify-center text-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002"
      crossorigin="anonymous"></script>
    <!-- Ads IDM 1 -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8851872691835002" data-ad-slot="3651954529"
      data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </section>


  <?php
  include 'footer.php';
  ?>

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
  function showModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
  }

  // Fungsi untuk menutup modal
  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('hidden');
  }

  // Mengecek URL untuk parameter status
  window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');  // Ambil nilai parameter 'status'

    // Menampilkan modal berdasarkan status
    if (status === 'success') {
      showModal('modalBackground'); // Tampilkan modalBackground jika status=success
    } else if (status === 'spam') {
      showModal('modalSpam'); // Tampilkan modalSpam jika status=spam
    }
  };

  // Event listener untuk menutup modal
  document.getElementById('closeModalBackground').addEventListener('click', function() {
    closeModal('modalBackground');
  });

  document.getElementById('closeModalSpam').addEventListener('click', function() {
    closeModal('modalSpam');
  });
</script>
</body>

</html>