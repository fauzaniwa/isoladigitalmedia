<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FessUp - Browse</title>
  <link rel="icon" href="src/favicon.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Link to Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="stylesmenfess.css">

</head>

<body class="bg-pink-light text-pink-main">



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


  <!-- Header -->
  <?php
  include 'navbar.php'; ?>

  <!-- Create Button -->
  <div class="py-10 mx-6 flex-grow items-center justify-center">
    <button onclick="history.back()" class="p-6 font-semibold">
      <i class="bi bi-arrow-left text-xl"></i> Back / Browse
    </button>
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
          placeholder="Search Name or Username Instagram"
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required />
        <button type="submit"
          class="absolute end-2.5 bottom-2.5  text-sm px-4 py-2 btn-primary rounded-md font-semibold shadow-md hover:shadow-lg">
          Search
        </button>
      </div>
    </form>
  </section>

  <section class="py-20 bg-pink-light">
    <div class="container mx-auto text-center">
      <div class="m-4 flex justify-between items-center">
        <h2 class="text-xl font-extrabold text-center text-pink-main mb-6">Spotify Mutual</h2>
        <a href="mutual" class="btn-primary text-sm px-4 py-2 rounded-md font-semibold shadow-md hover:shadow-lg">
          View More
        </a>
      </div>

      <!-- Horizontal Slider -->
      <div class="flex overflow-x-auto gap-4 scrollbar-hide px-4">
        <?php
        include '../process/koneksi.php';

        // Query to get mutual data from database
        $query = "SELECT * FROM mutual ORDER BY created_at";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
        }

        // Loop through the mutual data
        while ($row = mysqli_fetch_assoc($result)):
          $name = htmlspecialchars($row['name']);
          $caption = htmlspecialchars($row['caption']);
          $link_spotify = htmlspecialchars($row['link_spotify']);

          // Generate random avatar number between 1 and 10
          $random_avatar_number = rand(1, 10);
          $avatar_image = "src/avatar ({$random_avatar_number}).png"; // Construct the image path
          ?>
          <!-- Card 1 -->
          <div class="bg-white rounded-lg shadow-md p-2 w-20 flex-shrink-0">
            <a href="<?php echo $link_spotify; ?>" target="_blank">
              <img src="<?php echo $avatar_image; ?>" alt="Spotify User Profile"
                class="w-14 h-14 rounded-full mx-auto mb-1" />
              <h3 class="text-xs font-semibold text-pink-main"><?php echo $name; ?></h3>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>

  <section class="py-10 bg-white">
    <div class="container mx-auto text-center">
      <div class="m-4 flex justify-between items-center">
        <h2 class="text-xl font-extrabold text-center text-pink-main mb-6">New Menfess</h2>
        <a href="menfess" class="btn-primary text-sm px-4 py-2 rounded-md font-semibold shadow-md hover:shadow-lg">
          View More
        </a>
      </div>
    </div>

    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-[#FBC0D2] p-12 rounded-lg">


      <?php
      include '../process/koneksi.php';

      // Tangkap parameter pencarian
      $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

      // Query untuk mengambil data
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
    ";

      // Tambahkan klausa pencarian jika ada parameter search
      if (!empty($search)) {
        $query .= " WHERE m.name LIKE '%$search%' OR m.usernameig LIKE '%$search%'";
      }

      // Urutkan berdasarkan data terbaru
      $query .= " GROUP BY m.id ORDER BY RAND() LIMIT 10";

      // Eksekusi query
      $result = mysqli_query($conn, $query);

      if (!$result) {
        echo "<p>Error fetching data: " . mysqli_error($conn) . "</p>";
      }

      // Periksa apakah ada data yang ditemukan
      if (mysqli_num_rows($result) > 0):
        while ($row = mysqli_fetch_assoc($result)):
          $id = htmlspecialchars($row['id']);
          // Membatasi panjang judul hingga 15 karakter dan menambahkan "..." jika terlalu panjang
          $name = htmlspecialchars($row['name']);
          $name = strlen($name) > 15 ? substr($name, 0, 15) . "..." : $name;

          $usernameig = htmlspecialchars($row['usernameig'] ?? 'Anonymous');
          $message = htmlspecialchars($row['message']);
          $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;

          $track_url = $row['music'];
          preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
          $track_id = $matches[1] ?? null;
          ?>
          <!-- Card link -->
          <a href="clicked.php?id=<?php echo $id; ?>" class="bg-white shadow-md rounded-md p-6 card-hover">
            <p class="text-lg font-bold"><?php echo $name; ?></p>
            <p class="flex items-center text-gray-600">
              <i class="bi bi-instagram text-xl mr-2"></i><?php echo $usernameig; ?>
            </p>
            <p class="my-4 font-primary text-2xl"><?php echo $display_message; ?></p>

            <?php if (!empty($track_id)): ?>
              <div class="flex items-center">
                <!-- Thumbnail -->
                <div class="w-12 h-12 overflow-hidden rounded-md mr-2">
                  <img id="track-thumbnail-<?php echo htmlspecialchars($track_id); ?>" src="" alt="Track Thumbnail"
                    class="object-cover w-full h-full" />
                </div>
                <!-- Title -->
                <span id="track-title-<?php echo htmlspecialchars($track_id); ?>"
                  class="text-pink-main hover:underline">Loading...</span>
              </div>
              <script>
                // Fetch oEmbed data from Spotify API
                fetch('https://open.spotify.com/oembed?url=<?php echo urlencode("https://open.spotify.com/track/" . $track_id); ?>')
                  .then(response => response.json())
                  .then(data => {
                    // Set the track title and thumbnail dynamically
                    document.getElementById("track-title-<?php echo htmlspecialchars($track_id); ?>").textContent = data.title;
                    document.getElementById("track-thumbnail-<?php echo htmlspecialchars($track_id); ?>").src = data.thumbnail_url;
                  })
                  .catch(error => console.error('Error fetching oEmbed data:', error));
              </script>
            <?php else: ?>
              <p>No track available.</p>
            <?php endif; ?>

            <div class="flex justify-start gap-6 items-center mt-4">
              <span class="flex items-center">
                <i class="bi bi-eye mr-2"></i><?php echo htmlspecialchars($row['views'] ?? 0); ?>
              </span>
              <span class="flex items-center">
                <i class="bi bi-chat-dots mr-2"></i><?php echo htmlspecialchars($row['total_comments'] ?? 0); ?>
              </span>
            </div>
          </a>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-gray-500">Nama atau Username yang dicari tidak ada.</p>
      <?php endif; ?>
    </div>
  </section>
  
<section class="flex items-center justify-center text-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002" crossorigin="anonymous"></script>
    <!-- Ads IDM 1 -->
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-8851872691835002"
        data-ad-slot="3651954529"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
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