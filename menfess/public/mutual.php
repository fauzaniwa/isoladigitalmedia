<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DKVess - Engaging Design</title>
  <link rel="icon" href="src/favicon.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="stylesmenfess.css">


</head>

<body class="bg-pink-light text-pink-main">

  <!-- Header -->
  <?php
  include 'navbar.php'; ?>

  <!-- Create Button -->
  <div class="py-10 mx-6 flex-grow items-center justify-center">
    <button onclick="history.back()" class="p-6 font-semibold">
      <i class="bi bi-arrow-left text-xl"></i> Back / Spotify
    </button>
  </div>

  <!-- Modal -->
  <div id="modalBackgroundInfo"
    class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-700">Info</h2>
      </div>
      <!-- Pesan Dinamis -->
      <p id="modalMessage" class="text-gray-700 mb-4"></p>
      <!-- Close Button -->
      <div class="text-right">
        <button id="closeModalInfo"
          class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
          OK
        </button>
      </div>
    </div>
  </div>


  <!-- Modal Background -->
  <div id="modalBackground" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-700">Add Spotify Profile</h2>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          &times;
        </button>
      </div>
      <!-- Modal Form -->
      <form action="../process/insert_mutual.php" method="POST">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
          <input type="text" id="name" maxlength="10" name="name" required placeholder="Enter your name"
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Caption</label>
          <input type="text" id="caption" maxlength="25" name="caption" required placeholder="Enter your caption"
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>
        <div class="mb-4">
          <label for="spotifyLink" class="block text-gray-700 text-sm font-bold mb-2">Spotify Profile Link</label>
          <input type="url" id="spotifyLink" name="spotifyLink" required placeholder="https://open.spotify.com/user/..."
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
        </div>
        <!-- Submit Button -->
        <div class="text-right">
          <button type="submit"
            class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Floating Button -->
  <div class="floatingtoogle fixed bottom-6 right-6">
    <!-- Parent Button -->
    <button id="toggleMenu"
      class="bg-pink-600 text-white w-16 h-16 md:w-16 md:h-16 rounded-full shadow-lg flex justify-center items-center hover:bg-pink-700">
      <i class="bi bi-pencil-square text-2xl md:text-3xl"></i>
    </button>
    <div id="menuItems" class="hidden flex flex-col items-end gap-2 mt-2">
      <a href="submit" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
        Create Menfess
      </a>
      <a href="submitmutual" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
        Create Mutual
      </a>

    </div>
  </div>
  
  <section class="mt-12 px-4 flex-grow items-center justify-center">
    <form class="max-w-2xl mx-auto" method="GET" action="">
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="search" name="search" id="default-search"
          class="block w-full p-4 ps-10 text-sm text-gray-900 rounded-lg bg-gray-50 border-2 border-gray-300 rounded-lg mb-4"
          placeholder="Search by name or genre" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"/>
        <button type="submit"
          class="absolute end-2.5 bottom-2.5  text-sm px-4 py-2 btn-primary rounded-md font-semibold shadow-md hover:shadow-lg">
          Search
        </button>
      </div>
    </form>
  </section>

  <section class="py-20">
    <div class="container mx-auto">
        <h2 class="text-3xl font-extrabold text-pink-main mb-6 text-center">Spotify Mutuals</h2>
        <p class="text-lg text-gray-700 mb-10 text-center">Find friends with the same favorite music.</p>


        <!-- Hasil Pencarian -->
        <div class="bg-[#FBC0D2] rounded-xl container mx-auto p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            include '../process/koneksi.php';

            // Ambil query pencarian jika ada
            $search_query = "";
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search_query = "%" . trim($_GET['search']) . "%";
            }

            // Query untuk mencari berdasarkan name atau tags
            if ($search_query) {
                $query = "SELECT * FROM mutual WHERE name LIKE ? OR tags LIKE ? ORDER BY created_at DESC";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $search_query, $search_query);
                $stmt->execute();
                $result = $stmt->get_result();
            } else {
                $query = "SELECT * FROM mutual ORDER BY created_at DESC";
                $result = mysqli_query($conn, $query);
            }

            // Menampilkan data
            while ($row = mysqli_fetch_assoc($result)):
                $name = htmlspecialchars($row['name']);
                $caption = htmlspecialchars($row['caption']);
                $tags = explode(',', htmlspecialchars($row['tags']));
                $link_spotify = htmlspecialchars($row['link_spotify']);

                // Generate random avatar
                $random_avatar_number = rand(1, 10);
                $avatar_image = "src/avatar ({$random_avatar_number}).png";
            ?>
                <div class="bg-white shadow-xl rounded-xl p-6 text-center">
                    <img src="<?php echo $avatar_image; ?>" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-bold text-pink-main mb-2"><?php echo $name; ?></h3>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <?php foreach ($tags as $tag): ?>
                            <span class="bg-[#ABD1FA] text-blue-600 text-sm px-3 py-1 rounded-xl">
                                <?php echo $tag; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                    <p class="text-gray-500 mb-4"><?php echo $caption; ?></p>
                    <a href="<?php echo $link_spotify; ?>" target="_blank"
                        class="btn-primary px-6 py-2 rounded-md text-white font-semibold bg-pink-main hover:bg-pink-700">
                        Connect
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Mobile View -->
    </div>
</section>


  <?php
  include 'footer.php';
  ?>

  <script>
    const toggleButton = document.getElementById('toggleMenu');
    const menuItems = document.getElementById('menuItems');

    toggleButton.addEventListener('click', () => {
      // Toggle visibility of child buttons
      menuItems.classList.toggle('hidden');
    });
  </script>
  <!-- JavaScript for Modal -->
  <script>
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const modalBackground = document.getElementById('modalBackground');

    openModalButton.addEventListener('click', () => {
      modalBackground.classList.remove('hidden');
      modalBackground.classList.add('flex');
    });

    closeModalButton.addEventListener('click', () => {
      modalBackground.classList.add('hidden');
    });

    // Close modal when clicking outside the content
    modalBackground.addEventListener('click', (e) => {
      if (e.target === modalBackground) {
        modalBackground.classList.add('hidden');
      }
    });
  </script>
  <script>
    // Cek jika ada pesan di URL
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    if (message) {
      // Tampilkan modal dengan pesan
      document.getElementById('modalBackgroundInfo').classList.remove('hidden');
      document.getElementById('modalMessage').textContent = message;
    }

    // Tutup modal
    document.getElementById('closeModalInfo').addEventListener('click', () => {
      document.getElementById('modalBackgroundInfo').classList.add('hidden');
      // Hapus parameter URL
      const cleanUrl = window.location.origin + window.location.pathname;
      window.history.replaceState(null, null, cleanUrl);
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

</body>

</html>